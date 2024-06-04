<?php
session_start();
if($_SESSION['user_id']){
  header('Location: ./index.php');
  return;
}

require './DbManager.php';

// ポストデータを変数化
$mail = trim($_POST['email']);
$password = trim($_POST['password']);
$gender = trim($_POST['gender']);
$birth_date = trim($_POST['birth_date']);

// エラーチェック、とりあえず空白チェックくらい
$errorMsg = '';
$errorMsg .= !$mail ? 'メールアドレスを入力して下さい。' : '';
$errorMsg .= !$password ? 'パスワードを入力して下さい。' : '';

$db = null;

// メールアドレスが登録済みかを検索
if (!$errorMsg) {
  $db = new DbManager();

  try {
    $ret = $db->select(
      'SELECT * FROM t_users WHERE mail = :mail',
      [new DbParam('mail', $mail, PDO::PARAM_STR)]
    );

    if (count($ret)) {
      $errorMsg .= '指定されたメールアドレスはすでに登録されています。';
    }
  } catch (Exception $e) {
    $errorMsg .= $e->getMessage();
  }
}

$lastInsertedId = null;
// 登録されていなければ登録を実行する
if (!$errorMsg) {
  try {
    $db->insertOrUpdate(
      'INSERT INTO t_users (mail, password, gender, birth_date) VALUES(:mail, :password, :gender, :birth_date)',
      [
        new DbParam('mail', $mail, PDO::PARAM_STR),
        new DbParam('password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR),
        new DbParam('gender', $gender, PDO::PARAM_STR),
        new DbParam('birth_date', $birth_date, PDO::PARAM_STR)
      ]
    );

    $lastInsertedId = $db->lastInsertId();
  } catch (Exception $e) {
    $errorMsg .= $e->getMessage();
  }
}

// ログイン処理を実行する
$_SESSION['user_id'] = $lastInsertedId;

// エラーがあった場合は、元のページに戻す。
if($errorMsg){
  header('Location: ./regist.php?err=' . urlencode($errorMsg));
}else{
  header('Location: ./index.php');
}

?>