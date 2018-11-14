<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/Reporte.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$reporte = new Reporte($db);


// query products
$stmt = $reporte->Pendiente();

if(isset($stmt))
{
    // products array
    $pendiente_arr=array();
    $pendiente_arr["result"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
          $pendiente_item=array(
                "IDUsuario" => $IDUsuario,
                "Nombre" => $Nombre,
                "Apellido" => $Apellido,
                "Correo" => $Correo,
                "Pendiente" => $Pendiente
          );

       array_push($pendiente_arr["result"], $pendiente_item);
    }

    echo json_encode($pendiente_arr);
}
else{
    echo json_encode(
        array("message" => "No records found.")
    );
}
?>
