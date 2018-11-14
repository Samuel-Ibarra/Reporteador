<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/Usuario.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$usuario = new Usuario($db);
 
// query products
$stmt = $usuario->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $usuario_arr=array();
    $usuario_arr["records"]=array();
    $usuario_arr["paging"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $usuario_item=array(
            "IDUsuario" => $IDUsuario,
            "Nombre" => $Nombre,
            "Apellido_Paterno" => $Apellido_Paterno,
            "Apellido_Materno" => $Apellido_Materno,
            "Direccion" => $Direccion,
            "Colonia" => $Colonia,
            "Municipio" => $Municipio,
            "Ciudad" => $Ciudad,
            "Pais" => $Pais,
            "Telefono" => $Telefono,
            "Fecha_Nacimiento" => $Fecha_Nacimiento,
            "Fecha_Alta" => $Fecha_Alta,
            "IDRol" => $IDRol,
            "IDArea" => $IDArea,
            "Estado" => $Estado
        );
 
        array_push($usuario_arr["records"], $usuario_item);
    }
 
 
    // include paging
    $total_rows=$usuario->count();
    $page_url="{$home_url}Usuario/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $encuesta_arr["paging"]=$paging;
 
    echo json_encode($usuario_arr);
}
 
else{
    echo json_encode(
        array("message" => "No usuario found.")
    );
}
?>