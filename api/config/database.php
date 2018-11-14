<?php
class Database{
 
    // specify your own database credentials
    private $host = "Tibs.com.mx";
    private $db_name = "Transaccional_Encuestas";
    private $username = "rootencuestas";
    private $password = "Tibs2018!";
    public $conn;
 
    // get the database connection
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
?>