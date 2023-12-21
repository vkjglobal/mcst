<?php 

/*define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','mcst');
*/

    define('DB_HOST','mcst-rmi.org'); // Host name
    define('DB_USER','mcstrmi_php'); // db user name
    define('DB_PASS','Reubro@2023'); // db user password name
    define('DB_NAME','mcstrmi_php'); // db name


try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>