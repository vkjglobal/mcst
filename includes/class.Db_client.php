<?php
 include_once('includes/dbConnect.php');
 
class Db_client {
   private $conn;

    public function __construct() {
        global $conn; // Use the global connection object from dbconnect.php
        $this->conn = $conn;
    }

    // Function to insert data using prepared statement with PDO
    public function insertData($name, $email) {    // $outerObj->insertDataIntoDB("John Doe", "john@example.com");
        try {
            $stmt = $this->conn->prepare("INSERT INTO your_table (name, email) VALUES (:name, :email)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return false;
        }
    }
    //update====================
    public function update($table, $data, $condition) {
     
        try {
            $fields = array();
            foreach ($data as $key => $value) {
                $fields[] = "{$key} = :{$key}";
            }
            $fields = implode(', ', $fields);
       

            $sql = "UPDATE {$table} SET {$fields} WHERE {$condition}"; 
            $stmt = $this->conn->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindParam(":{$key}", $value);
               
            }
         //   echo $sql;exit;
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Handle the exception or log the error if needed
            die("Error executing query: " . $e->getMessage());
        }
    }
    //================
    public function insertInto($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
       //print_r($placeholders);exit;
       $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    // print_r($data);
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($data);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }

    // Function to get data using prepared statement with PDO
    public function getData($id) {
        try {
            $stmt = $this->conn->prepare("SELECT name, email FROM your_table WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
   
    public function getListData($tableName) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tableName");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //  echo "<pre/>";
       //rint_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }

     public function getLisQuery($query) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
         // echo "<pre/>";
       //rint_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    /*
     // Method to execute a specific query
    public function executePassengerQuery($bookingId, $userId) {
        try {
           
            $stmtpassenger = $this->conn->prepare('SELECT  temp_booking.booking_status,temp_booking.ticket_time_limit,temp_booking.mf_reference ,temp_booking.ticket_status 
                                                    ,temp_booking.fare_type,temp_booking.child_count,temp_booking.void_window,temp_booking.dep_date,temp_booking.arrival_location ,travellers_details.id, travellers_details.first_name, travellers_details.last_name,travellers_details.title,
                                                    travellers_details.passenger_type,travellers_details.e_ticket_number FROM travellers_details 
                                            LEFT JOIN temp_booking ON travellers_details.flight_booking_id = temp_booking.id
                                            WHERE travellers_details.flight_booking_id = :bookingId and temp_booking.user_id = :userId');

            $stmtpassenger->execute(array('bookingId' => $bookingId, 'userId' => $userId));

            $result = $stmtpassenger->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //getting dep date for return trip
     public function executeDepDateQuery($bookingId, $userId,$arrival_location) {
        try {
         
            $stmtpassenger = $this->conn->prepare("SELECT fs.dep_date,fs.flight_no,fs.airline_code,fs.cabin_preference FROM temp_booking AS tb
                    LEFT JOIN flight_segment AS fs ON tb.id = fs.booking_id
                    WHERE tb.id = :bookingId AND  tb.user_id = :userId AND fs.dep_location LIKE '%".$arrival_location."%'");
                   
            $stmtpassenger->execute(array('bookingId' => $bookingId, 'userId' => $userId));
                      $result = $stmtpassenger->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //getting markup percentage for cancellation
    public function executeMarkupQuery($roleId){
        try {
         
            $stmtMarkup = $this->conn->prepare("SELECT commission_percentage FROM markup_commission 
                    WHERE  role_id= :roleId");                   
            $stmtMarkup->execute(array('roleId' => $roleId));
                      $result = $stmtMarkup->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    */
    public function getCount($table, $condition = '') {
        try {
            $sql = "SELECT COUNT(*) FROM {$table}";
            if (!empty($condition)) {
                $sql .= " WHERE {$condition}";
            }
           
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $count = $stmt->fetchColumn();
            return $count;
        } catch (PDOException $e) {
            // Handle the exception or log the error if needed
            die("Error executing query: " . $e->getMessage());
        }
    }
    // Add more functions for other database operations as needed
     public function getProjectTitleCMS($status='',$tablename=''){
         //$tablename = projects;
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tablename  WHERE status = :status");
            $stmt->bindParam(':status', $status);
            $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
          //  $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($result);exit;
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //by menuid
     public function getProjectCMSById($id,$tablename=''){
         //$tablename = projects;
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tablename  WHERE menu_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
          
          //  $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($result);exit;
            return $result['_id'];
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
     public function getDataById($tblname,$id) {
       
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tblname  WHERE _id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
     public function getMenuLists($tblname,$id) {
          if($id == 37)
            {
                $WHERE =   " ORDER BY `menu` ASC";
            }
            else{
                $WHERE =   " ORDER BY `order` ASC";
            }
       
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tblname  WHERE parent_menu_id = :id $WHERE");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                     //   print_r($result); 
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //about us 
    public function getsubMenuLists($tblname,$id) {
         
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tblname  WHERE menu_id = :id ORDER BY `_id` ASC");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
      public function getCmsIdByTitle($tablename,$title,$id) {
       // echo "YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY".$tablename.$title.$id; 
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tablename  WHERE menu_id = :id AND title LIKE '%".$title."%' ORDER BY `_id` ASC");
            $stmt->bindParam(':id', $id);
           // $stmt->bindParam(':title', $title);
            $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
      //   echo "PPPPPPPPPPPPPPPPPPPPPPP"."SELECT * FROM $tablename  WHERE menu_id = $id AND title LIKE '%".$title."%' ORDER BY `_id` ASC"; print_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }

    public function getContentByID($tablename,$id) {
       // echo "YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY".$tablename.$title.$id; 
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tablename  WHERE _id  = :id  ORDER BY `_id` ASC");
            $stmt->bindParam(':id', $id);
           // $stmt->bindParam(':title', $title);
            $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
      //   echo "PPPPPPPPPPPPPPPPPPPPPPP"."SELECT * FROM $tablename  WHERE menu_id = $id AND title LIKE '%".$title."%' ORDER BY `_id` ASC"; print_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
     public function getREfCat($tblname,$id) {
         
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tblname  WHERE parent_category_id = :id ORDER BY `_id` ASC");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    public function getREfLib($tblname,$id) {
         
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tblname  WHERE category_id = :id ORDER BY `_id` ASC");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    
    public function catLsit(){    // echo "mm";exit;  
         try {
          $stmt = $this->conn->prepare("SELECT c1._id AS category_id,c1.category AS category_name, c2._id AS subcategory_id,c2.category AS subcategory_name FROM
    categories c1 LEFT JOIN     categories c2 ON c1._id = c2.parent_category_id  WHERE c1.parent_category_id =1 ORDER BY  c1._id, c2._id"); 
    //=======================

   
//WHERE c1._id = :your_parent_category_id

    //========================
           // $stmt->bindParam(':id', $id);
            $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
       //=====
        public function searchList($searchKeyword,$Where){
            //echo "SELECT * FROM libraries  WHERE title LIKE '%".$searchKeyword."%'";
         //$tablename = projects;
        try {
            $stmt = $this->conn->prepare("SELECT * FROM libraries  $Where ");
           // $stmt->bindParam(':id', $id);
            $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
          //  $result = $stmt->fetch(PDO::FETCH_ASSOC);
           //print_r($result);exit;
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
       
    //====================
    public function getDataByIdImport($tblname,$id) {
       
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tblname  WHERE catid = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }

     public function insertDataImport($params) {    // $outerObj->insertDataIntoDB("John Doe", "john@example.com");
        try {
            $stmt = $this->conn->prepare("INSERT INTO cms (`title`, `content`, `url`, `external_url`, `order`, `menu_id`, `menu__-`,`isSystem`, `isDeleted`, `created_at`, `updated_at`, `__v`) VALUES (:title, :content, :url, :external_url, :order, :menu_id, :menu__, :isSystem, :isDeleted, :created_at, :updated_at, :__v)");


       //   echo "<pre/>";  print_r($params);

            $stmt->bindParam(':title', $params['title']);
            $stmt->bindParam(':content', $params['content']);
             $stmt->bindParam(':url', $params['url']);
            $stmt->bindParam(':external_url', $params['external_url']);
             $stmt->bindParam(':order', $params['order']);
            $stmt->bindParam(':menu_id', $params['menu_id']);
             $stmt->bindParam(':menu__', $params['menu__-']);
            $stmt->bindParam(':isSystem', $params['isSystem']);
              $stmt->bindParam(':isDeleted', $params['isDeleted']);
            $stmt->bindParam(':created_at', $params['created_at']);
              $stmt->bindParam(':updated_at', $params['updated_at']);
            $stmt->bindParam(':__v', $params['__v']);
            

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo  $e->getMessage();
            // Handle the exception (e.g., log the error)
            return false;
        }
    }
    //==========================================
    public function getAllPosts($uid){
       
        try {
            $stmt = $this->conn->prepare("SELECT p.*,u.first_name,u.last_name FROM `posts` AS p LEFT JOIN `users` AS u ON u._id = p.user_id  WHERE p.user_id != :id AND p.mem_hide_status =1");
            $stmt->bindParam(':id', $uid);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //my posts 
        public function getMyPosts($uid){
       
        try {
            $stmt = $this->conn->prepare("SELECT p.*,u.first_name,u.last_name FROM `posts` AS p LEFT JOIN `users` AS u ON u._id = p.user_id  WHERE p.user_id = :id");
            $stmt->bindParam(':id', $uid);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
     public function getPostContentByIDNew($id) {
        
        try {
         $stmt = $this->conn->prepare("SELECT p.*,u.first_name,u.last_name FROM `posts` AS p LEFT JOIN `users` AS u ON u._id = p.user_id  WHERE p.id = :id");

            $stmt->bindParam(':id', $id);
           // $stmt->bindParam(':title', $title);
            $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
      //   echo "PPPPPPPPPPPPPPPPPPPPPPP"."SELECT * FROM $tablename  WHERE menu_id = $id AND title LIKE '%".$title."%' ORDER BY `_id` ASC"; print_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //get comments for a  post 
     public function getPostsCommentsById($id) {
        
     //   echo " c.*,u.first_name,u.last_name FROM `post_comments` AS c LEFT JOIN `users` AS u ON u._id = c.user_id  WHERE c.id = :id";
        try {
         $stmt = $this->conn->prepare("SELECT c.*,u.first_name,u.last_name FROM `post_comments` AS c LEFT JOIN `users` AS u ON u._id = c.user_id  WHERE c.post_id = :id");

            $stmt->bindParam(':id', $id);
           // $stmt->bindParam(':title', $title);
            $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      //   echo "PPPPPPPPPPPPPPPPPPPPPPP"."SELECT * FROM $tablename  WHERE menu_id = $id AND title LIKE '%".$title."%' ORDER BY `_id` ASC"; print_r($result);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //delete
       public function deleteData($table,$id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM $table WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    // elearningfiles links
    public function getFileListData(){
       
        try {
            $stmt = $this->conn->prepare("SELECT p.*,u.first_name,u.last_name FROM `posts` AS p LEFT JOIN `users` AS u ON u._id = p.user_id   WHERE p.`file_public_visible` = 1 ORDER BY `created_at` DESC");
          
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //elearning files by member ids
     // elearningfiles links
    public function getFileListDataByMemId($memId){
       
        try {
            $stmt = $this->conn->prepare("SELECT p.*,u.first_name,u.last_name FROM `posts` AS p LEFT JOIN `users` AS u ON u._id = p.user_id   WHERE p.`file_public_visible` = 1 AND p.user_id = :userID ORDER BY `created_at` DESC");
             $stmt->bindParam(':userID', $memId);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
       public function selectByEmailExist($tableName,$email,$adminid) {         
        $query = "SELECT * FROM $tableName WHERE email = ? AND _id != ?";
        $params = [$email,$adminid];
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
               return $result;
          //  return true; // Password updated successfully
        } catch (PDOException $e) {
          // die("Error executing query: " . $e->getMessage());
           return null;
        }
    }
     public function updateProfile($id,$email,$fname,$lname,$image,$updatepw){
         $query = "UPDATE users SET first_name= ?,last_name= ?,email = ? ,profile_img= ?,passwor = ? WHERE _id = ?";
        $params = [ $fname,$lname,$email,$image,$updatepw,$id];

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return true; // Password updated successfully
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }
    //update post
      public function updatePosts($id,$title,$descriptionValue,$postImage,$fileUploadValue,$fileVisiblePublic,$tableName){
         $query = "UPDATE $tableName SET Title= ?,Image_upload= ?,Description = ? ,file_upload= ?,file_public_visible = ? WHERE id = ?";
        $params = [ $title,$postImage,$descriptionValue,$fileUploadValue,$fileVisiblePublic,$id];

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return true; // Password updated successfully
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }
    //get member emails
    public function getAllMembers($id) {
        try {
            $stmt = $this->conn->prepare("SELECT  CONCAT(first_name, ' ', last_name) AS name, email FROM users WHERE _id != :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    //publish or unpublish posts under mypost 
     public function getMyPostsPublishOrNot($uid,$fileVisible) {
       
        try {
            $stmt = $this->conn->prepare("SELECT p.*,u.first_name,u.last_name FROM `posts` AS p LEFT JOIN `users` AS u ON u._id = p.user_id  WHERE p.user_id = :id AND p.file_public_visible = :file_public_visible");
            $stmt->bindParam(':id', $uid);
            $stmt->bindParam(':file_public_visible', $fileVisible);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error)
            return null;
        }
    }
    // Function to close the database connection
    public function closeConnection() {
        $this->conn = null;
    }

}
?>