<?php
require_once './vendor/autoload.php';
require_once './loadenv.php';

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendMailAdmin($toAddress, $toDispName, $subj, $body)
{
  $from = getenv('MAIL_ADDRESS_ADMIN');
  $subjPrefix = '【おかサポ/管理】';
  $sign =
"

=================================
    おかサポ 管理者
    MAIL: $from
=================================
";

  sendMail(
    getenv('MAIL_PASSWORD_ADMIN'),
    $from,
    getenv('MAIL_DISPNAME_ADMIN'),
    $toAddress,
    $toDispName,
    $subjPrefix. $subj,
    $body . $sign
  );
}

function sendMailService($toAddress, $toDispName, $subj, $body)
{
  $from = getenv('MAIL_ADDRESS_SERVICE');
  $subjPrefix = '【おかサポ】';
  $sign =
"

=================================
    おかサポ サービス
    MAIL: $from
=================================
";

  sendMail(
    getenv('MAIL_PASSWORD_SERVICE'),
    $from,
    getenv('MAIL_DISPNAME_SERVICE'),
    $toAddress,
    $toDispName,
    $subjPrefix . $subj,
    $body . $sign
  );
}

function sendMail($pw, $fromAddress, $fromDispName, $toAddress, $toDispName, $subj, $body)
{
  $phpmailer = new PHPMailer(true);                // PHPMailerのインスタンスを作成。trueを渡すことでexceptionsが有効になります。
  $phpmailer->isSMTP();                            // SMTPを使用してメールを送信する設定にします。
  // $phpmailer->SMTPDebug = SMTP::DEBUG_LOWLEVEL; // SMTPのデバッグ情報を出力するための設定。デバッグレベルは低いものに設定。
  $phpmailer->SMTPAuth   = true;                   // SMTP認証を有効にします。
  $phpmailer->Host       = getenv('MAIL_SMTP_HOST');    // SMTPサーバーのホスト名やIPアドレスを設定。
  $phpmailer->SMTPSecure = getenv('MAIL_SMTP_SECURE');  // セキュリティのためのプロトコルを設定（'tls'または'ssl'）。
  $phpmailer->Port       = getenv('MAIL_SMTP_PORT');    // SMTPサーバーのポート番号を設定。通常は587（TLSの場合）や465（SSLの場合）。
  $phpmailer->Username   = $fromAddress;                  // SMTP認証のためのユーザー名（通常はメールアドレス）を設定。
  $phpmailer->Password   = $pw;  // SMTP認証のためのパスワードを設定。

  $phpmailer->CharSet = 'UTF-8';                  // メールの文字エンコーディングを'UTF-8'に設定します。
  $phpmailer->setFrom($fromAddress, $fromDispName);      // 送信者のメールアドレスと名前を設定します。
  $phpmailer->addAddress($toAddress, $toDispName); // 受信者のメールアドレスと名前を設定します。
  $phpmailer->Subject = $subj;                   // メールの件名を設定します。
  $phpmailer->Body    = $body;               // メールの本文を設定します。

  $phpmailer->send();
}
