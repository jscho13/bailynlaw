<?php
 error_reporting(E_ALL & ~E_NOTICE);
  
  include($_SERVER['DOCUMENT_ROOT'].'/inc/config.php');

 require(DIR_INCLUDES . 'filename.php');  
 require(DIR_INCLUDES . 'define.php');  
 require(DIR_FUNCTIONS . 'general.php');
 require(DIR_FUNCTIONS . 'database.php');
 
 // make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');
?>
