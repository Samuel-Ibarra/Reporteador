<?php
class Reporte{

    // database connection and table name
    private $conn;
    //private $table_name = "Encuesta";

    // object properties
    public $id_usuarioto;
    public $id_encuesta;
    public $id_area;

    public function __construct($db){
        $this->conn = $db;
    }

 // regresa todos los usuarios con todos sus
public function General(){

    //select all data
    $call = 'CALL sp_Get_General()';

    $stmt = $this->conn->prepare($call);

    $stmt->execute();

    return $stmt;
}

public function Pendiente(){

    //select all data
    $query = "select distinct(a.IDUsuario) , u.Nombre, u.Apellido_Paterno as Apellido , u.Correo ,
              (select count(ac.IDUsuario) from Accesso as ac where ac.IDUsuario = a.IDUsuario and ac.IDEstatus = 5) as Pendiente
              from Accesso as a
              inner JOIN Usuario as u
              on u.IDUsuario = a.IDUsuario
              where a.IDEstatus = 5 and a.IDUsuario != 0";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();

    return $stmt;
}

   // create product
function Promedio_General(){

    // Procedure Insert Pregunta
    $call = 'CALL sp_Get_Promedio_General(:iduto)';

    $stmt = $this->conn->prepare($call);

    // sanitize
    $this->id_usuarioto=htmlspecialchars(strip_tags($this->id_usuarioto));

    // bind values
    $stmt->bindParam(":iduto", $this->id_usuarioto);

    // execute query
    $stmt->execute();

    return $stmt;

}
// used when filling up the update product form
function Promedio_Seccion(){

  // Procedure Insert Pregunta
  $call = 'CALL sp_Get_Promedio_Seccion(:iduto,:ide)';

  $stmt = $this->conn->prepare($call);

  // sanitize
  $this->id_usuarioto=htmlspecialchars(strip_tags($this->id_usuarioto));
  $this->id_encuesta=htmlspecialchars(strip_tags($this->id_encuesta));

  // bind values
  $stmt->bindParam(":iduto", $this->id_usuarioto);
  $stmt->bindParam(":ide", $this->id_encuesta);

  // execute query
  $stmt->execute();

  return $stmt;
}
// update the product
function Promedio_Pregunta(){

  // Procedure Insert Pregunta
  $call = 'CALL sp_Get_Promedio_Pregunta(:iduto,:ide,:ida)';

  $stmt = $this->conn->prepare($call);

  // sanitize
  $this->id_usuarioto=htmlspecialchars(strip_tags($this->id_usuarioto));
  $this->id_encuesta=htmlspecialchars(strip_tags($this->id_encuesta));
  $this->id_area=htmlspecialchars(strip_tags($this->id_area));

  // bind values
  $stmt->bindParam(":iduto", $this->id_usuarioto);
  $stmt->bindParam(":ide", $this->id_encuesta);
  $stmt->bindParam(":ida", $this->id_area);

  // execute query
  $stmt->execute();

  return $stmt;
}

}

?>
