<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);


// get posted data
//$data = json_decode(file_get_contents("php://input"));
/*echo($_POST['name'] ? $_POST['name'] : die());
echo "\n";
echo($_POST['lastname1'] ? $_POST['lastname1'] : die());
echo "\n";
echo($_POST['lastname2'] ? $_POST['lastname2'] : die());
echo "\n";
echo($_POST['street'] ? $_POST['street'] : die());
echo "\n";
echo($_POST['colony'] ? $_POST['colony'] : die());
echo "\n";
echo($_POST['municipality'] ? $_POST['municipality'] : die());
echo "\n";
echo($_POST['city'] ? $_POST['city'] : die());
echo "\n";
echo($_POST['county'] ? $_POST['county'] : die());
echo "\n";
echo($_POST['phone'] ? $_POST['phone'] : die());
echo "\n";
echo($_POST['user-email'] ? $_POST['user-email'] : die());
echo "\n";
echo($_POST['user-pw'] ? $_POST['user-pw'] : die());

echo "\n OBJ \n";*/
// set product property values
$usuario->name = $_POST['name'];
$usuario->apellido_paterno = $_POST['lastname1'];
$usuario->apellido_materno = $_POST['lastname2'];
$usuario->direccion = $_POST['street']  . " #" . isset($_POST['number']);
$usuario->colonia = $_POST['colony'];
$usuario->municipio = $_POST['municipality'];
$usuario->ciudad = $_POST['city'];
$usuario->pais = $_POST['county'];
$usuario->telefono = $_POST['phone'];
$usuario->correo = $_POST['user-email'];
$usuario->contraseña = $_POST['user-pw'];

// create the product
if($usuario->create()){
    echo '{';
        echo '"message": "Usuario was created."';
        header('Location: ../../index.html');
        die();
    echo '}';
}

// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create usuario."';
    echo '}';
}
?>
