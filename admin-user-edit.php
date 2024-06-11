<?php
require_once './funcs.php';
checkAuth();

require_once './DbManager.php';
$db = new DbManager();

$errMsg = '';

try{
$db->insertOrUpdate(
  "UPDATE t_users SET is_admin = :is_admin WHERE id = :id",
  [
    new DbParam('is_admin', $_POST['is_admin'] ? 1 : 0, PDO::PARAM_INT),
    new DbParam('id', $_POST['id'], PDO::PARAM_INT)
  ]
);
}catch(Exception $e){
  $errMsg = $e->getMessage();
}

if(!$errMsg){
  require_once './funcs_mail.php';

  $mail = $_POST['mail'];
  $subj = $_POST['is_admin'] ? "管理者権限が付与されました" : "管理者権限が取り消されました";
  $msg = $_POST['is_admin'] ? "管理者権限が付与されました。\r\nログインして確認して下さい。" : "管理者権限が取り消されました。";
  sendMailAdmin(
    $mail,
    '',
    $subj,
"$mail 様

$msg
"
  );
}

//redirect('./admin-user-list.php' . $errMsg ? '?err=' . urlencode($errMsg) : '' );
redirect('./admin-user-list.php' . ($errMsg ? '?err=' . urlencode($errMsg) : ''));