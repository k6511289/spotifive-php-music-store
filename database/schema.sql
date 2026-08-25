-- Public, anonymized schema for the SPOTIFIVE course project.
-- The original phpMyAdmin export is intentionally excluded from Git because
-- it contains historical account, comment, and order data.

CREATE DATABASE IF NOT EXISTS group_17
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE group_17;

CREATE TABLE chinese_album (
  no INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  price INT UNSIGNED NOT NULL,
  description TEXT NOT NULL,
  img VARCHAR(255) NOT NULL DEFAULT '',
  music VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE english_album LIKE chinese_album;
CREATE TABLE japanese_album LIKE chinese_album;

CREATE TABLE logintest (
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(100) NOT NULL,
  authority TINYINT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE comment (
  source VARCHAR(255) NOT NULL,
  username VARCHAR(100) NOT NULL,
  time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE cart (
  user_name VARCHAR(100) NOT NULL,
  language ENUM('chinese', 'english', 'japanese') NOT NULL,
  no INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 1,
  serial VARCHAR(32) NOT NULL,
  INDEX idx_cart_serial (serial),
  INDEX idx_cart_user (user_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Only fictional demonstration records are included in the public version.
INSERT INTO chinese_album (name, price, description)
VALUES ('Demo Mandarin Album', 399, 'Portfolio demonstration data.');

INSERT INTO english_album (name, price, description)
VALUES ('Demo English Album', 459, 'Portfolio demonstration data.');

INSERT INTO japanese_album (name, price, description)
VALUES ('Demo Japanese Album', 499, 'Portfolio demonstration data.');

