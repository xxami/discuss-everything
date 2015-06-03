
/**
 * core sql structure for discuss-everything
 */

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `text` varchar(50) NOT NULL,
  `cats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
