<?php
// DB credentials.
    if ($_SERVER['HTTP_HOST'] == 'localhost:8080') {
        $dbh = new PDO('mysql:host=localhost;dbname=mcstrmi_mcstDb', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $dbh = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

if ($_SERVER['HTTP_HOST'] == 'mcst-rmi.org') {
    define('DB_HOST','mcst-rmi.org'); // Host name
    define('DB_USER_BLOG','mcstrmi_McStUsR'); // db user name
    define('DB_PASS_BLOG','MC7%St0Pw'); // db user password name
    define('DB_NAME_BLOG','mcstrmi_mcstDb'); // db name
    // Establish database connection.
    try
    {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME_BLOG,DB_USER_BLOG, DB_PASS_BLOG);
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }
}
?>