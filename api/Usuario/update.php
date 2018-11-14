<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/Usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$usuario = new Usuario($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$usuario->id_usuario = $data->id_usuario;
 
// set product property values
$usuario->name = $data->name;
$usuario->apellido_paterno = $data->apellido_paterno;
$usuario->apellido_materno = $data->apellido_materno;
$usuario->direccion = $data->direccion;
$usuario->colonia = $data->colonia;
$usuario->municipio = $data->municipio;
$usuario->ciudad = $data->ciudad;
$usuario->pais = $data->pais;
$usuario->telefono = $data->telefono;
$usuario->fecha_nacimiento = $data->fecha_nacimiento;
$usuario->id_rol = $data->id_rol;
$usuario->id_area = $data->id_area;
 
// update the product
if($usuario->update()){
    echo '{';
        echo '"message": "usuario was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update usuario."';
    echo '}';
}
?>