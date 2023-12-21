<?php

class Dbaction
{
    /**
     * Summary of host
     * @var 
     */
    private $host;
    /**
     * Summary of dbname
     * @var 
     */
    private $dbname;
    /**
     * Summary of username
     * @var 
     */
    private $username;
    /**
     * Summary of password
     * @var 
     */
    private $password;
    /**
     * Summary of conn
     * @var 
     */
    private $conn;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        //=================
        if(($_SERVER['HTTP_HOST'] == 'localhost:8080')||($_SERVER['HTTP_HOST'] == 'localhost')) {
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mcstrmi_php";
        }
         if($_SERVER['HTTP_HOST'] == 'mcst-rmi.org') {
            $host = "localhost";
            $username = "mcstrmi";
            $password = "Reubro@2020";
            $dbname = "mcstrmi_php";
        }
        // if($_SERVER['HTTP_HOST'] == 'cosmos.reubrosample.tk') {
        //     $host = "localhost";
        //     $username = "reubrode_cosmos";
        //     $password = "Reubro@2023";
        //     $dbname = "reubrode_cosmos";
        // }

            //===================
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }
    
    /**
     * Summary of connect
     * @return void
     */
    private function connect()
    {
        try
        {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e)
        {
            die("Connection failed: " . $e->getMessage());
        }
    }
    /**
     * Summary of executeQuery
     * @param mixed $sql
     * @param mixed $params
     * @return array
     */
    public function executeQuery($sql, $params = []) {
        //print_r($sql); print_r($params);
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            //print_r($ss);
            // return $stmt->fetchAll(PDO::FETCH_ASSOC);
            $ss = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($ss);
            return $ss;
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }
    public function insertInto($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        // print_r($placeholders);exit;
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        //print_r($query );
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($data);
            //print_r($ss);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }
    public function selectTablevalues($tableName)
    {
        $sql = "SELECT * from $tableName";
        return $this->executeQuery($sql);
    }
    public function selectById($tableName, $id)
    {
        $sql = "SELECT * FROM $tableName WHERE id = ?";
        $params = [$id];
        $ss =  $this->executeQuery($sql, $params);
        //print_r($ss);
        return $ss;
    }
    public function updateDBcmsContent($title,$desc1,$desc2,$image1,$id)
    {
        $tableName = "header_slider";
        $time = date('Y-m-d H:i:s');
        $query = "UPDATE $tableName SET title = ? , image = ?, description = ? , short_desc = ? , updated_at = ?  WHERE id = ?";
        $params = [$title,$image1,$desc1,$desc2,$time,$id];

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return true; //  updated successfully
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }
    public function deleteData($tableName,$id)
    {
        try {      
            $stmt = $this->conn->prepare("DELETE FROM $tableName WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function updateStatus($status, $id)
    {
        $tableName = "header_slider";
        $time = date('Y-m-d H:i:s');
        $query = "UPDATE $tableName SET status = ? , updated_at = ?  WHERE id = ?";
        $params = [$status,$time,$id];

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return true; //  updated successfully
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }
    public function selectCategories($tableName)
    {
        $sql = "SELECT * FROM $tableName";
        return $this->executeQuery($sql);
    }
    public function selectCategoriesNamebyId($tableName,$id)
    {
        $sql = "SELECT * FROM $tableName WHERE _id = ?";
        $params = [$id];
        return $this->executeQuery($sql, $params);
        // print_r($ss);
         
    }
    public function updateCategory($tableName,$name,$id)
    {   
        $time = date('Y-m-d H:i:s');
        $sql = "UPDATE $tableName SET category = ?, cat_dir = ?, updated_at = ? WHERE _id = ?";
        $params = [$name, $name, $time, $id];
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return true; // updated successfully
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }
    public function deleteCategoryData($tableName,$id)
    {
        try {      
            $stmt = $this->conn->prepare("DELETE FROM $tableName WHERE _id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function selectNamebyId($tableName,$parent_id)
    {
        $sql = "SELECT category from $tableName WHERE _id = $parent_id";
        $ss = $this->executeQuery($sql);
        return $ss;
    }
    public function selectDBLibrary($tableName)
    {
        $sql = "SELECT * FROM $tableName";
        return $this->executeQuery($sql);
    }
    public function selectDBLibrarybyId($tableName,$id)
    {
        $sql = "SELECT * from $tableName WHERE _id = $id";
        $ss = $this->executeQuery($sql);
        return $ss;
    }
    public function updateLibrary($tableName, $title, $author, $shortdesc, $longdesc, $file, $changelog, $id)
    {
        $time = date('Y-m-d H:i:s');
        $sql = "UPDATE $tableName SET title = ?, author = ?, updated_at = ?, short_description = ?, long_description = ?, file = ?, changelog = ? WHERE _id = ?";
        $params = [$title, $author, $time, $shortdesc, $longdesc, $file, $changelog, $id];
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return true; // updated successfully
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }
    public function updateCMSstatus($status, $id)
    {
        $tableName = "cms";
        $time = date('Y-m-d H:i:s');
        $query = "UPDATE $tableName SET status = ? , updated_at = ?  WHERE _id = ?";
        $params = [$status,$time,$id];

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return true; //  updated successfully
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }
    // public function fetchParentName($tableName,$id)
    // {
    //     $sql = "SELECT category from $tableName WHERE _id = $id";
    //     $ss = $this->executeQuery($sql);
    //     return $ss;
    // }
    // public function formatBytes($bytes, $precision = 2) {
    //     $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    
    //     $bytes = max($bytes, 0);
    //     $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    //     $pow = min($pow, count($units) - 1);
    
    //     return round($bytes / (1 << (10 * $pow)), $precision) . ' ' . $units[$pow];
    // }
}