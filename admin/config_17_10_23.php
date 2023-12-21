<?php 
define('DB_HOST','mcst-rmi.org');
define('DB_USER','mcstrmi_php');
define('DB_PASS','Reubro@2023');
define('DB_NAME','mcstrmi_php');
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>