PRAGMA foreign_keys=true;

DROP TABLE IF EXISTS comments;

CREATE TABLE comments (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  destination_comment_id INTEGER,
  content TEXT NOT NULL,
  created_at TEXT NOT NULL DEFAULT (DATETIME('now', 'localtime')),
  FOREIGN KEY (destination_comment_id) REFERENCES comments (id)
);