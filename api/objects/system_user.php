<?php
class System_User{
 
    // database connection and table name
    private $conn;
    private $table_name = "system_user";
 
    // object properties
    public $user_id;
    public $full_name;
    public $username;
    public $password;
    public $date_created;
    public $date_modified;
    public $account_status;
    public $profile_picture;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }



    // check if user exist
    function get_user_account(){
        // query to read single record
        $query = "SELECT
                    user_id, full_name, username, account_status, profile_picture
                FROM
                    " . $this->table_name . "
                WHERE
                    username = ?
                AND
                    password = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        $password = hash('sha256',md5($this->password));
        // bind id of product to be updated
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $password);
     
        // execute query
        $stmt->execute();
        
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->user_id = $row['user_id'];
        $this->full_name = $row['full_name'];
        $this->username = $row['username'];
        $this->account_status = $row['account_status'];
        $this->profile_picture = $row['profile_picture'];
    }


    function update(){
     
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    full_name = :full_name";
        if($this->password!=""||empty($this->password)){
            $query .=", password = :password";
        }
        $query .=" WHERE
                    user_id = :user_id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // bind new values
        $stmt->bindParam(':full_name', $this->full_name);
        if($this->password!=""||empty($this->password)){
            $password = hash('sha256',md5($this->password));
            $stmt->bindParam(':password', $password);
        }
        $stmt->bindParam(':user_id', $this->user_id);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}
?>
