
/**
 * core sql structure for discuss-everything
 */

DROP TABLE IF EXISTS post;
CREATE TABLE IF NOT EXISTS post (
id bigint(20) NOT NULL,
  title varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  url varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  content text COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  posted datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS post_channel;
CREATE TABLE IF NOT EXISTS post_channel (
id int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO post_channel VALUES(1, 'news');
INSERT INTO post_channel VALUES(2, 'media');
INSERT INTO post_channel VALUES(3, 'tech');
INSERT INTO post_channel VALUES(4, 'gaming');
INSERT INTO post_channel VALUES(5, 'fun');

DROP TABLE IF EXISTS post_has_channel;
CREATE TABLE IF NOT EXISTS post_has_channel (
id bigint(20) NOT NULL,
  post_id bigint(20) NOT NULL,
  post_channel_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS post_has_tag;
CREATE TABLE IF NOT EXISTS post_has_tag (
id bigint(20) NOT NULL,
  post_id bigint(20) NOT NULL,
  post_tag_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS post_tag;
CREATE TABLE IF NOT EXISTS post_tag (
id int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS post_type;
CREATE TABLE IF NOT EXISTS post_type (
id int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO post_type VALUES(1, 'ask');
INSERT INTO post_type VALUES(2, 'debate');
INSERT INTO post_type VALUES(3, 'casual');

DROP TABLE IF EXISTS test;
CREATE TABLE IF NOT EXISTS test (
  `text` varchar(50) NOT NULL,
  cats int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS `user` (
id int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'anonymous',
  cookie_id varchar(32) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE post
 ADD PRIMARY KEY (id);

ALTER TABLE post_channel
 ADD PRIMARY KEY (id);

ALTER TABLE post_has_channel
 ADD PRIMARY KEY (id), ADD UNIQUE KEY id (id);

ALTER TABLE post_has_tag
 ADD PRIMARY KEY (id);

ALTER TABLE post_tag
 ADD PRIMARY KEY (id);

ALTER TABLE post_type
 ADD PRIMARY KEY (id);

ALTER TABLE user
 ADD PRIMARY KEY (id);


ALTER TABLE post
MODIFY id bigint(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE post_channel
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE post_has_channel
MODIFY id bigint(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE post_has_tag
MODIFY id bigint(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE post_tag
MODIFY id int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE post_type
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE user
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
