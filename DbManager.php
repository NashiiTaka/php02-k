<?php
require './loadenv.php';

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

class DbManager
{
  private PDO $pdo;

  public function __construct()
  {
    // .envファイルに記載。
    $this->pdo = new PDO('mysql:dbname='. getenv('DB_NAME').'; charset=utf8; host='. getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'));
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
  private function prepareAndBindAndExecute(string $sql, array $dbParams = array()){
    $stmt = $this->pdo->prepare($sql);

    // パラメータを設定
    foreach($dbParams as $dbParam){
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
    // PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
    return $this->prepareAndBindAndExecute($sql, $dbParams)->fetchAll(PDO::FETCH_ASSOC);

    // 結果セットを一度に取得し、配列として返す
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // // 結果セットの処理
    // foreach ($rows as $row) {
    //     // $rowには取得した行の連想配列が格納される
    //     echo "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Email: " . $row['email'] . "<br>";
    // }
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
    // PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
    $this->prepareAndBindAndExecute($sql, $dbParams);
  }

  /**
   * 最終登録IDを取得
   *
   * @return void
   */
  public function lastInsertId(){
    return $this->pdo->lastInsertId();
  }

  // デストラクタ
  public function __destruct()
  {
    // PDOには明示的なCloseはない。
    $this->pdo = null;
  }
}
