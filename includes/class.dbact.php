<?php

 include_once('includes/dbConnect.php');
 
class Dbact {
   private $conn;

    public function __construct() {
        global $conn; // Use the global connection object from dbconnect.php
        $this->conn = $conn;
    }

    public function getHSById($tblname,$id) {
        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tblname  WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    public function getcmsById($tblname,$id) {
        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tblname  WHERE _id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    public function getProject_Dbstatus($tableName,$id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tableName  WHERE _id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
}
?>