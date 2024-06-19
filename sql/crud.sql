-- Active: 1717409769039@@localhost@3306@nashii_kaden

INSERT INTO t_chats(
  id,
  thread_id,
  message,
  role,  
  created_at,
  created_by,
  updated_at,
  updated_by
) VALUES(
  NULL,
  :thread_id,
  :message,
  :role,  
  NOW(),
  :by,
  NOW(),
  :by
)
