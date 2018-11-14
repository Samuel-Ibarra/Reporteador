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

 //Parameters
$reporte->id_usuarioto = isset($_POST['iduto']) ? $_POST['iduto'] : die();
$reporte->id_encuesta = isset($_POST['ide']) ? $_POST['ide'] : die();
// query products
$stmt = $reporte->Promedio_Seccion();

// check if more than 0 record found
if(isset($stmt)){

    // products array
    $promedio_arr=array();
    $promedio_arr["result"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
            $promedio_item[]=array(
                "IDArea" => $IDArea,
                "Nombre" => $Nombre,
                "Promedio" => $Promedio
            );
    }

    array_push($promedio_arr["result"], $promedio_item);
    echo json_encode($promedio_arr);
}

else{
    echo json_encode(
        array("message" => "No preguntas found.")
    );
}
?>
