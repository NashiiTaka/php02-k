<?php
require_once './DbManager.php';
require_once './funcs.php';
require_once './funcs_mail.php';

$errorMsgs = [];

// ポストデータを変数化
$wish = trim($_POST['wish']);
$price_ranges = $_POST['price_ranges'] ?? [];
$points = $_POST['points'] ?? [];
$design_tastes = $_POST['design_tastes'] ?? [];
$color_tastes = $_POST['color_tastes'] ?? [];
$other_tastes = $_POST['other_tastes'] ?? [];
$shops = $_POST['shops'] ?? [];
$datas = $_POST['datas'] ?? [];
$types = $_POST['types'] ?? [];
$email = trim($_POST['email']);

// 未入力チェック、とりあえずゆるめに。
if (!$wish) {
  $errorMsgs[] = '欲しいものを教えて下さい。';
}
if (!$email) {
  $errorMsgs[] = 'メールアドレスを入力して下さい。';
}
if (empty($shops)) {
  $errorMsgs[] = '通販サイトを選択してください。';
}

$db = null;

// メールアドレスが登録済みかを検索
if (empty($errorMsgs)) {
  $db = new DbManager();

  try {
    $db->insertOrUpdate(
      "
INSERT INTO t_reqs(
  id,
  email,
  wish,
  price_ranges,
  points,
  design_tastes,
  color_tastes,
  other_tastes,
  shops,
  created_by_user_id,
  created_at,
  updated_by_user_id,
  updated_at
) VALUES(
  NULL,
  :email,
  :wish,
  :price_ranges,
  :points,
  :design_tastes,
  :color_tastes,
  :other_tastes,
  :shops,
  NULL,
  NOW(),
  NULL,
  NOW()
);
      ",
      [
        new DbParam('email', $email, PDO::PARAM_STR),
        new DbParam('wish', $wish, PDO::PARAM_STR),
        new DbParam('price_ranges', join(',', $price_ranges) ?? null, PDO::PARAM_STR),
        new DbParam('points', join(',', $points) ?? null, PDO::PARAM_STR),
        new DbParam('design_tastes', join(',', $design_tastes) ?? null, PDO::PARAM_STR),
        new DbParam('color_tastes', join(',', $color_tastes) ?? null, PDO::PARAM_STR),
        new DbParam('other_tastes', join(',', $other_tastes) ?? null, PDO::PARAM_STR),
        new DbParam('shops', join(',', $shops) ?? null, PDO::PARAM_STR)
      ]
    );

    $req_id = $db->lastInsertId();

    for ($i = 0; $i < count($datas); $i++) {
      $db->insertOrUpdate(
        'INSERT INTO t_req_sup_datas(id, req_id, data, type, created_by_user_id, created_at, updated_by_user_id, updated_at) VALUES(NULL, :req_id, :data, :type, NULL, NOW(), NULL, NOW())',
        [
          new DbParam('req_id', $req_id, PDO::PARAM_INT),
          new DbParam('data', $datas[$i], PDO::PARAM_LOB),
          new DbParam('type', $types[$i], PDO::PARAM_STR)
        ]
      );
    }
  } catch (Exception $e) {
    $errorMsgs[] = 'データベースへの登録に失敗しました。';
  }
}

// エラーがあった場合は、元のページに戻す。
if (!empty($errorMsgs)) {
  session_start();
  $_SESSION['errMes'] = join('<br />', $errorMsgs);
  foreach($_POST as $key => $value){
    $_SESSION[$key] = $value;
  }
  redirect('./index.php?err=y');
} else {
  sendMailService(
    $email,
    '',
    'ご要望ありがとうございました',
"$email 様

ご要望ありがとうございました。
ご満足いただける商品が見つかるよう、調査いたします！

調査が終わりましたら改めてご連絡差し上げます。
ご連絡までしばしおまち下さいませ。
"
  );
  redirect('./thanks.php');
}
