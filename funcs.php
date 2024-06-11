<?php
/**
 * HTML出力用に特殊文字をエスケープする。
 * htmlspecialcharsのラッパー / XSS対応
 * @param string $str
 * @return string
 */
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}

/**
 * ログイン状態をチェックし、ログインされていなければログイン画面に遷移させる。
 *
 * @return void
 */
function checkAuth()
{
  session_start();
  if (!$_SESSION['user_id']) {
    redirect('./login.php');
    exit;
  }
}

/**
 * ログアウトを実行する
 *
 * @param boolean $needsSessStartn session_startを実行する必要がある場合、true
 * @return void
 */
function logout($needsSessStart = true)
{
  if ($needsSessStart) {
    session_start();
  }
  //SESSIONを初期化（空っぽにする）
  $_SESSION = array();
  //Cookieに保存してある"SessionIDの保存期間を過去にして破棄
  if (isset($_COOKIE[session_name()])) { //session_name()は、セッションID名を返す関数
    setcookie(session_name(), '', time() - 42000, '/');
  }
  //サーバ側での、セッションIDの破棄
  session_destroy();
}

/**
 * リダイレクトを実行する。
 * リダイレクト後はexit()でレスポンスを強制終了する。
 *
 * @param string $to
 * @return void
 */
function redirect($to)
{
  header("Location: " . $to);
  exit();
}
