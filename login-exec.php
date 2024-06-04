<?php
session_start();
if($_SESSION['user_id']){
  header('Location: ./index.php');
  return;
}

require './DbManager.php';

// ポストデータを変数化
$mail = trim($_POST['email']);
$pwd = trim($_POST['password']);

// エラーチェック、とりあえず空白チェックくらい
$errorMsg = '';
$errorMsg .= !$mail ? 'メールアドレスを入力して下さい。' : '';
$errorMsg .= !$pwd ? 'パスワードを入力して下さい。' : '';

$db = null;

// メールアドレスが登録済みかを検索
if (!$errorMsg) {
  $db = new DbManager();

  try {
    $ret = $db->select(
      'SELECT * FROM t_users WHERE mail = :mail',
      [
        new DbParam('mail', $mail, PDO::PARAM_STR)
      ]
    );

    if (count($ret) && password_verify($pwd, $ret[0]['password'])) {
      $_SESSION['user_id'] = $ret[0]['id'];
    }else{  
      $errorMsg .= 'ログインできませんでした。';
    }
  } catch (Exception $e) {
    $errorMsg .= $e->getMessage();
  }
}

// エラーがあった場合は、元のページに戻す。
if($errorMsg){
  header('Location: ./login.php?err=' . urlencode($errorMsg) . '&mail=' . urlencode($mail));
}else{
  header('Location: ./index.php');
}

?>