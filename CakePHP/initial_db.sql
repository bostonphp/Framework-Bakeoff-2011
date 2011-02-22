-- Database setup for CakePHP demo by Andrew Drane 

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `company_name` varchar(64) NOT NULL,
  `contact_email` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `short_description` varchar(140) NOT NULL,
  `description` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `is_admin` tinyint(4) DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
