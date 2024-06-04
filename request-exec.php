<?php
session_start();
if (!$_SESSION['user_id']) {
  header('Location: ./index.php');
  return;
}

require './DbManager.php';

// ポストデータを変数化
$wish = trim($_POST['wish']);
$shops = $_POST['shops'] ?? [];
$datas = $_POST['datas'] ?? [];
$types = $_POST['types'] ?? [];


// エラーチェック、とりあえず空白チェックくらい
$errorMsg = '';
$errorMsg .= !$wish ? '商品イメージを入力して下さい。' : '';

$db = null;

// メールアドレスが登録済みかを検索
if (!$errorMsg) {
  $db = new DbManager();

  try {
    $db->insertOrUpdate(
      'INSERT INTO t_reqs(id, user_id, wish) VALUES(NULL, :user_id, :wish)',
      [
        new DbParam('user_id', $_SESSION['user_id'], PDO::PARAM_INT),
        new DbParam('wish', $wish, PDO::PARAM_STR)
      ]
    );

    $req_id = $db->lastInsertId();

    for ($i = 0; $i < count($shops); $i++) {
      $db->insertOrUpdate(
        'INSERT INTO t_req_link_shops(id, req_id, shop_id) VALUES(NULL, :req_id, :shop_id)',
        [
          new DbParam('req_id', $req_id, PDO::PARAM_INT),
          new DbParam('shop_id', $shops[$i], PDO::PARAM_INT),
        ]
      );
    }

    for ($i = 0; $i < count($datas); $i++) {
      $db->insertOrUpdate(
        'INSERT INTO t_req_sup_datas(id, req_id, data, type) VALUES(NULL, :req_id, :data, :type)',
        [
          new DbParam('req_id', $req_id, PDO::PARAM_INT),
          new DbParam('data', $datas[$i], PDO::PARAM_LOB),
          new DbParam('type', $types[$i], PDO::PARAM_STR)
        ]
      );
    }
  } catch (Exception $e) {
    $errorMsg .= $e->getMessage();
  }
}

// ログイン処理を実行する

// エラーがあった場合は、元のページに戻す。
if ($errorMsg) {
  header('Location: ./request.php?err=' . urlencode($errorMsg));
} else {
  header('Location: ./index.php');
}
