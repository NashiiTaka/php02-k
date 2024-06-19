-- Active: 1717409769039@@localhost@3306@nashii_kaden

drop table if exists t_chats;

create table t_chats (
    id INT NOT NULL AUTO_INCREMENT,
    thread_id VARCHAR(256) NOT NULL,
    role VARCHAR(32) NOT NULL,
    message TEXT NOT NULL,
    created_by VARCHAR(32) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_by VARCHAR(32) NOT NULL,
    updated_at DATETIME NOT NULL,
    primary key (id),
    key(thread_id)
);