<?php
$url = 'http://localhost:3000/chat';

$data = [];

foreach($_POST as $key => $value){
  $data[$key] = $value;
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
} else {
  // レスポンスの表示
  echo $response;
}

// cURLセッションの終了
curl_close($ch);
?>