<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/Usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$usuario = new Usuario($db);
 
// set ID property of product to be edited
$usuario->id_usuario = isset($_GET['iduto']) ? $_GET['iduto'] : die();
 
// read the details of product to be edited
$usuario->readOne();
 
// create array
$usuario_arr = array(
    "IDUsuario" => $usuario->id_usuario,
    "Nombre" => $usuario->name,
    "Apellido_Paterno" => $usuario->apellido_paterno,
    "Apellido_Materno" => $usuario->apellido_materno,
    "Direccion" => $usuario->direccion,
    "Colonia" => $usuario->colonia,
    "Municipio" => $usuario->municipio,
    "Ciudad" => $usuario->ciudad,
    "Pais" => $usuario->pais,
    "Telefono" => $usuario->telefono,
    "Fecha_Nacimiento" => $usuario->fecha_nacimiento,
    "Fecha_Alta" => $usuario->fecha_alta,
    "IDRol" => $usuario->id_rol,
    "IDArea" => $usuario->id_area,
    "Estado" => $usuario->estado
 
);
 
// make it json format
print_r(json_encode($usuario_arr));
?>