<?php
session_start();
if(!$_SESSION['user_id']){
  header('Location: ./login.php');
  return;
}

$title = 'トップ';
include 'html-header.php';

require './DbManager.php';
$db = new DbManager();
$reqs = $db->select(
  "
  SELECT
  r.id,
  r.wish,
  GROUP_CONCAT(DISTINCT ms.shop_name) shop_names,
  GROUP_CONCAT(DISTINCT rs.`type`) `type`
FROM
  t_reqs r
  left join t_req_link_shops s ON
    r.id = s.req_id
  left join m_shops ms ON 
    s.shop_id = ms.id
  left join t_req_sup_datas rs ON
    r.id = rs.req_id
where
  r.user_id = :user_id
group BY
  r.id
", [new DbParam('user_id', $_SESSION['user_id'], PDO::PARAM_INT)]
);
?>

  THIS IS index.php
  <pre>
    <?= var_dump($reqs); ?>
  </pre>
  <a href="./request.php">要望登録</a>
  <a href="./logout.php">ログアウト</a>

<?php include 'html-header.php'; ?>