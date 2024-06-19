<?php
require_once './DbManager.php';
$db = new DbManager();
$url = 'http://localhost:3000/chat';
$data = [];

$trimmedPostedMessage = $_POST['message'];
$trimmedPostedThreadId = $_POST['thread_id'];

$data['message'] = $trimmedPostedMessage;
$data['thread_id'] = $trimmedPostedThreadId;

/**
 * DBにログを登録する。
 *
 * @param DbManager $db
 * @param string $role
 * @param string $message
 * @return void
 */
function addLogToDb($db, $thread_id, $role, $message)
{
  $db->insertOrUpdate(
    "INSERT INTO t_chats(
      id,
      thread_id,
      message,
      role,  
      created_at,
      created_by,
      updated_at,
      updated_by
    ) VALUES(
      NULL,
      :thread_id,
      :message,
      :role,  
      NOW(),
      :by,
      NOW(),
      :by
    )",
    [
      new DbParam('thread_id', $thread_id, PDO::PARAM_STR),
      new DbParam('message', $message, PDO::PARAM_STR),
      new DbParam('role', $role, PDO::PARAM_STR),
      new DbParam('by', 'passer.php', PDO::PARAM_STR),
    ]
  );
}

// スレッドIDが登録されている場合は、ログを登録する。
// スレッドIDが未発行の場合は、返答取得時に登録する。
if ($trimmedPostedThreadId) {
  addLogToDb($db, $trimmedPostedThreadId, 'user', $trimmedPostedMessage);
}

// データをURLエンコード形式に変換
$postData = http_build_query($data);

// cURLセッションの初期化
$ch = curl_init();

// オプションの設定
curl_setopt($ch, CURLOPT_URL, $url); // リクエストURLを設定
curl_setopt($ch, CURLOPT_POST, true); // POSTリクエストに設定
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // POSTデータを設定
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列として取得
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // タイムアウトを10秒に設定

// リクエストの実行
$response = curl_exec($ch);

// エラーチェック
if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);

  // ユーザーメッセージ未登録の場合は登録する。
  if (!$trimmedPostedThreadId) {
    // スレッドIDは生成されていないので、独自に生成し、ユーザーとボットのエラーの対応関係が取れる様にしておく。
    $trimmedPostedThreadId = uniqid('passer_err_');
    addLogToDb($db, $trimmedPostedThreadId, 'user', $trimmedPostedMessage);
  }

  // ボットメッセージはエラーログを登録する。
  addLogToDb($db, $trimmedPostedThreadId, 'bot', 'Error:' . curl_error($ch));
} else {
  // レスポンスの表示
  echo $response;

  $jsonData = json_decode($response, true);
  $thread_id = $jsonData['thread_id'];

  // ユーザーメッセージ未登録の場合は登録する。
  if (!$trimmedPostedThreadId) {
    addLogToDb($db, $thread_id, 'user', $trimmedPostedMessage);
  }

  // ボットメッセージを登録する。
  addLogToDb($db, $thread_id, 'bot', $response);
}

// cURLセッションの終了
curl_close($ch);
