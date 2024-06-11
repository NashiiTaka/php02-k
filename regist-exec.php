<?php
require_once './DbManager.php';
require_once './funcs.php';
require_once './funcs_mail.php';

// ポストデータを変数化
$mail = trim($_POST['email']);
$password = trim($_POST['password']);

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
      $errorMsg .= '登録に失敗しました。';
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
      'INSERT INTO t_users (mail, password) VALUES(:mail, :password)',
      [
        new DbParam('mail', $mail, PDO::PARAM_STR),
        new DbParam('password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR),
      ]
    );

    $lastInsertedId = $db->lastInsertId();
  } catch (Exception $e) {
    $errorMsg .= $e->getMessage();
  }
}

// エラーがあった場合は、元のページに戻す。
if ($errorMsg) {
  redirect('./regist.php?err=' . urlencode($errorMsg));
} else {
  sendMailAdmin(
    $mail,
    '',
    'ユーザー登録申請内容を確認します',
    "$mail 様

おかサポ管理者です。

登録内容を確認し、問題がない場合は
ユーザー登録処理の完了後にメールでご連絡差し上げます。"
  );
  redirect('./thanks-regist.php');
}
?>