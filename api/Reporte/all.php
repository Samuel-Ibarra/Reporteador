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
$stmt = $reporte->General();

if(isset($stmt))
{
    // products array
    $general_arr=array();
    $general_arr["result"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
          $general_item=array(
                "IDUsuario" => $IDUsuario,
                "Nombre" => $Nombre,
                "Lider" => $Lider,
                "Contestadas_Lider" => $Contestadas_Lider,
                "De_Lider" => $De_Lider,
                "Par" => $Par,
                "Contestadas_Par" => $Contestadas_Par,
                "De_Par" => $De_Par,
                "Subordinado" => $Subordinado,
                "Contestadas_Subordinado" => $Contestadas_Subordinado,
                "De_Subordinado" => $De_Subordinado
          );

       array_push($general_arr["result"], $general_item);
    }

    echo json_encode($general_arr);
}
else{
    echo json_encode(
        array("message" => "No records found.")
    );
}
?>
