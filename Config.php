<?php
/*
 * Config file to store constants to be used
 * in this application.
*/

// DB Connection Details constant
define('DB_NAME', 'ebuyerTest');
define('DB_USER', 'feed');
define('DB_PASSWORD', 'processor');
define('DB_HOST', 'localhost');

// Directory constants
define ("DS", DIRECTORY_SEPARATOR);
define ("workingDir", getCwd());

/*
  Include of files used.
  Ideally I would have used Composer to help with the autoloading.
  However Im having trouble with my version of WAMP being able to installComposer
*/
include workingDir.DS.'Library'.DS.'Db'.DS.'Dao'.DS.'Conn.php';
include workingDir.DS.'Library'.DS.'Db'.DS.'Dao'.DS.'TblProductDataDao.php';
include workingDir.DS.'Library'.DS.'Db'.DS.'Vo'.DS.'TblProductDataVo.php';
include workingDir.DS.'Library'.DS.'FeedProccessor'.DS.'File'.DS.'FileTemplate.php';
include workingDir.DS.'Library'.DS.'FeedProccessor'.DS.'File'.DS.'FileAbstract.php';
include workingDir.DS.'Library'.DS.'FeedProccessor'.DS.'File'.DS.'Format'.DS.'Csv.php';
include workingDir.DS.'Library'.DS.'FeedProccessor'.DS.'FeedProccessorException.php';
include workingDir.DS.'Library'.DS.'FeedProccessor'.DS.'Reader.php';
include workingDir.DS.'Library'.DS.'Validators'.DS.'BetweenValidator.php';
include workingDir.DS.'Library'.DS.'Validators'.DS.'CurrencyValidator.php';
include workingDir.DS.'Library'.DS.'Workers'.DS.'StockCsvProccessor.php';