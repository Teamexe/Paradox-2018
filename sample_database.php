<?php
//copy the contents of this file to `database.php` and update the login credentials.
class Database{
 
    
    private $host = "localhost";
    private $db_name = "database_name";
    private $username = "username";
    private $password = "password";
    public $conn;
 
    
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}

//Google API secret tokens
$sec_client_id = 'secret_client_id_here'; 
$sec_client_secret = 'client_secret_here';
$sec_redirect_uri = 'redirect_uri_here';

?>
