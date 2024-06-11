<?php
require_once './funcs.php';
checkAuth();

require_once './DbManager.php';
$db = new DbManager();

$errMsg = '';

try {
  $db->insertOrUpdate(
    "DELETE FROM t_users WHERE id = :id",
    [new DbParam('id', $_POST['id'], PDO::PARAM_INT)]
  );
} catch (Exception $e) {
  $errMsg = $e->getMessage();
}

//redirect('./admin-user-list.php' . $errMsg ? '?err=' . urlencode($errMsg) : '' );
redirect('./admin-user-list.php' . ($errMsg ? '?err=' . urlencode($errMsg) : ''));
