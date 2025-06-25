/** DATABASES */
CREATE DATABASE IF NOT EXISTS `muffler_api`;

/** GRANTS */
CREATE USER 'muffler_api'@'%' IDENTIFIED BY 'muffler_api';
GRANT ALL PRIVILEGES ON `muffler_api`.* TO 'v'@'%';

# Remove the "ONLY_FULL_GROUP_BY" mode
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));