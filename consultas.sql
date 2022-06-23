-- SQLite
INSERT INTO comments(post_id, user_id, body, created_at, updated_at) VALUES (1, 1, 'LOREM IPSUM', datetime('now'), datetime('now'));

SELECT * FROM comments;
SELECT * FROM posts;

DELETE FROM comments WHERE id=2;

DELETE FROM posts where id=1;

UPDATE comments SET created_at=datetime('now'), updated_at=datetime('now');
