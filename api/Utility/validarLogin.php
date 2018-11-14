<?php

// get database connection
include_once '../config/database.php';


$database = new Database();
$db = $database->getConnection();

private $conn;
 
public function __construct($db){
$this->conn = $db;
}

$arr["records"] = array();

$email = isset($_POST['email']) ? $_POST['email'] : die();
$pass = isset($_POST['pass']) ? $_POST['pass'] : die();

$query = "CALL sp_Login('".$email."','".$pass."')";

$stmt = $this->conn->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

    // create array
$item = array(
    "Exists" =>  $row['Exist'],
    "ID" => $row["ID"]
);

array_push($arr["records"], $item);   
echo(json_encode($arr));

?>