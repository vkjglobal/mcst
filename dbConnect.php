<?php
// DB credentials.
    if ($_SERVER['HTTP_HOST'] == 'localhost:8080') {
    define('DB_HOST','localhost'); // Host name
    define('DB_USER','root'); // db user name
    define('DB_PASS',''); // db user password name
    define('DB_NAME','mcst'); // db name
    // Establish database connection.
    try
    {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }
}
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define('DB_HOST','localhost'); // Host name
    define('DB_USER','root'); // db user name
    define('DB_PASS',''); // db user password name
    define('DB_NAME','mcst'); // db name
    // Establish database connection.
    try
    {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }
}

if ($_SERVER['HTTP_HOST'] == 'mcst-rmi.org') {
    define('DB_HOST','mcst-rmi.org'); // Host name
    define('DB_USER','mcstrmi_php'); // db user name
    define('DB_PASS','Reubro@2023'); // db user password name
    define('DB_NAME','mcstrmi_php'); // db name
    // Establish database connection.
    try
    {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }
}
/*
if ($_SERVER['HTTP_HOST'] == 'bulatrips.com') {
    define('DB_HOST','localhost'); // Host name
    define('DB_USER','bulatrips_db'); // db user name
    define('DB_PASS','Reubro@2023'); // db user password name
    define('DB_NAME','bulatrips_db'); // db name
    // Establish database connection.
    try
    {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }
}
*/
?>