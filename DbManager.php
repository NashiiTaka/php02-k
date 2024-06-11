<?php
require_once './loadenv.php';

/**
 * DBパラメータを管理する。
 */
class DbParam
{
  public string $placeHolderName;
  public mixed $value;
  public int $pdoParamType;

  /**
   * DbParam コンストラクタ
   * @param string $placeHolderName プレースホルダー名、「：」はつけない
   * @param mixed $value 値
   * @param integer $pdoParamType PDO::PARAM〜 のパラメータ値
   */
  public function __construct(string $placeHolderName, mixed $value, int $pdoParamType)
  {
    $this->placeHolderName = $placeHolderName;
    $this->value = $value;
    $this->pdoParamType = $pdoParamType;
  }
}

/**
 * DB接続周りを管理。
 * エラー時は例外を発生させる。例外のメッセージはユーザーに提示可能な文言とする。
 */
class DbManager
{
  public static string $erroMesDbRegError = 'データベースへの登録中にエラーが発生しました。';
  public static string $erroMesDbSelError = 'データベースからデータの取得集にエラーが発生しました。';

  private PDO $pdo;

  public function __construct()
  {
    // .envファイルに記載。
    $this->pdo = new PDO('mysql:dbname=' . getenv('DB_NAME') . '; charset=utf8; host=' . getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'));
    // エラー処理が面倒なので、とりあえず例外発生で受ける。
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  /**
   * SQLを実行する。
   * @param string $sql SQL
   * @param DbParam[] $paramFieldNameAndValue パラメータフィールド名と値の連想配列。
   * @return [<string, mixed>] 行の配列 × 列の連想配列
   * @throws Exception 失敗時は例外を返す
   */
  private function prepareAndBindAndExecute(string $sql, array $dbParams = array())
  {
    $stmt = $this->pdo->prepare($sql);

    // パラメータを設定
    foreach ($dbParams as $dbParam) {
      $stmt->bindValue($dbParam->placeHolderName, $dbParam->value, $dbParam->pdoParamType);
    }

    // 実行
    $stmt->execute();

    return $stmt;
  }

  /**
   * SELECTを実行する
   *
   * @param string $sql SQL
   * @param DbParam[] $paramFieldNameAndValue パラメータフィールド名と値の連想配列。
   * @return [<string, mixed>] 行の配列 × 列の連想配列
   * @throws Exception 失敗時は例外を返す
   */
  public function select(string $sql, array $dbParams = array())
  {
    try {
      return $this->prepareAndBindAndExecute($sql, $dbParams)->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      throw new Exception(DbManager::$erroMesDbSelError, 0, $e);
    }
  }

  /**
   * 登録・更新
   * @param string $sql SQL
   * @param DbParam[] $paramFieldNameAndValue パラメータフィールド名と値の連想配列。
   * @return [<string, mixed>] 行の配列 × 列の連想配列
   * @throws Exception 失敗時は例外を返す
   */
  public function insertOrUpdate(string $sql, array $dbParams = array())
  {
    try {
      $this->prepareAndBindAndExecute($sql, $dbParams);
    } catch (Exception $e) {
      throw new Exception(DbManager::$erroMesDbRegError, 0, $e);
    }
  }

  /**
   * 最終登録IDを取得
   *
   * @return void
   */
  public function lastInsertId()
  {
    return $this->pdo->lastInsertId();
  }

  // デストラクタ
  public function __destruct()
  {
    // PDOには明示的なCloseはない。
    $this->pdo = null;
  }
}
