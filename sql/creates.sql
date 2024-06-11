-- Active: 1717409769039@@localhost@3306@nashii_kaden

-- ★サービスリリースしているので、ドロップはコメントアウト

-- DROP DATABASE IF EXISTS nashii_kaden;
CREATE DATABASE nashii_kaden
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
;

use nashii_kaden;

-- drop table if exists t_reqs;
create table t_reqs (
	id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(256) NOT NULL,
  wish text not null,
  price_ranges VARCHAR(256),
  points VARCHAR(256),
  design_tastes VARCHAR(256),
  color_tastes VARCHAR(256),
  other_tastes VARCHAR(256),
  shops VARCHAR(256),
  status varchar(20),
  primary key(id)
);

-- drop table if exists m_shops;
create table m_shops ( 
  id INT NOT NULL AUTO_INCREMENT,
  shop_name VARCHAR(128),
  shop_url VARCHAR(256),
  list_odr INT NOT NULL,
  primary key(id)
);
TRUNCATE m_shops;
INSERT INTO m_shops VALUES

  (NULL, 'Amazon.co.jp', 'https://www.amazon.co.jp', 1),
  (NULL, '楽天市場', 'https://www.rakuten.co.jp', 2),
  (NULL, 'Yahoo!ショッピング', 'https://shopping.yahoo.co.jp', 3),
  (NULL, 'ヨドバシカメラ', 'https://www.yodobashi.com', 4),
  (NULL, 'ビックカメラ', 'https://www.biccamera.com', 5),
  (NULL, 'その他', NULL, 6)
  -- (NULL, 'XPRICE', 'https://www.xprice.co.jp/', 6),
  -- (NULL, 'Qoo10', 'https://www.qoo10.jp', 7),
  -- (NULL, 'ヤマダ', 'https://www.yamada-denkiweb.com/', 8),
  -- (NULL, 'ジョーシン', 'https://joshinweb.jp', 9),
  -- (NULL, 'ノジマ', 'https://online.nojima.co.jp/', 10),
  -- (NULL, 'ECカレント', 'https://www.ec-current.com/', 11),
  -- (NULL, 'デジ楽', 'https://www.digiraku.com/', 12)
;

-- drop table if exists t_req_sup_datas;
create table t_req_sup_datas (
	id INT NOT NULL AUTO_INCREMENT,
  req_id INT NOT NULL,
  data MEDIUMBLOB NOT NULL,
  type VARCHAR(64) NOT NULL,
  primary key(id)
);


