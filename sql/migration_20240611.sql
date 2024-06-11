-- Active: 1717409769039@@localhost@3306@nashii_kaden

drop table if exists t_users;
create table t_users (
	id INT NOT NULL AUTO_INCREMENT,
  mail varchar(256) NOT NULL,
  password varchar(256) NOT NULL,
  is_admin TINYINT(1) DEFAULT 0,
  primary key(id)
);

ALTER TABLE t_reqs
ADD COLUMN created_by_user_id INT NULL,
ADD COLUMN created_at DATETIME,
ADD COLUMN updated_by_user_id INT NULL,
ADD COLUMN updated_at DATETIME;

ALTER TABLE t_req_sup_datas
ADD COLUMN created_by_user_id INT NULL,
ADD COLUMN created_at DATETIME,
ADD COLUMN updated_by_user_id INT NULL,
ADD COLUMN updated_at DATETIME;