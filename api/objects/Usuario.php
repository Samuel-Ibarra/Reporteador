<?php
class Usuario{

    // database connection and table name
    private $conn;
    private $table_name = "Usuario";

    // object properties
    public $id_usuario;
    public $name;
    public $apellido_paterno;
    public $apellido_materno;
    public $direccion;
    public $colonia;
    public $municipio;
    public $ciudad;
    public $pais;
    public $telefono;
    public $correo;
    public $contraseña;
    public $fecha_nacimiento;
    public $fecha_alta;
    public $id_rol;
    public $id_area;
    public $estado;
    public $exists;

    public function __construct($db){
        $this->conn = $db;
    }
 // used by select drop-down list
public function read(){

    //select all data
    $query = "SELECT
                IDUsuario, Nombre, Apellido_Paterno, Apellido_Materno, Direccion, Colonia, Municipio, Ciudad, Pais, Telefono, Correo, Fecha_Nacimiento, Fecha_Alta, IDRol, IDArea, Estado
            FROM
                " . $this->table_name . "
            ORDER BY
                Nombre";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();

    return $stmt;
}
   // create product
function create(){

    // Procedure Insert Pregunta
    //$call = 'CALL sp_Alta_Usuario("x",    "x",             "x",    "x",         "x",      "x",       "x",     "x",     "x",      "x",     "x",       "1000-01-01", 4, "0")';
    //$call = 'CALL sp_Alta_Usuario(:nombre, :apellidop, :apellidom, :direccion, :colonia, :municipio, :ciudad, :pais, :telefono, :correo, :contraseña,  "1000-01-01", 4, "0")';
    $call = 'CALL sp_Alta_Usuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,  "1000-01-01", 4, "0")';
    $stmt = $this->conn->prepare($call);

    // sanitize
    $this->name=$this->name;
    $this->apellido_paterno=$this->apellido_paterno;
    $this->apellido_materno=$this->apellido_materno;
    $this->direccion=$this->direccion;
    $this->colonia=$this->colonia;
    $this->municipio=$this->municipio;
    $this->ciudad=$this->ciudad;
    $this->pais=$this->pais;
    $this->telefono=$this->telefono;
    $this->correo=$this->correo;
    $this->contraseña=$this->contraseña;
    $this->fecha_nacimiento="1000-01-01";
    $this->id_rol='4';
    $this->id_area="0";


    $stmt->bindParam(1,  $this->name);
    $stmt->bindParam(2,  $this->apellido_paterno);
    $stmt->bindParam(3,  $this->apellido_materno);
    $stmt->bindParam(4,  $this->direccion);
    $stmt->bindParam(5,  $this->colonia);
    $stmt->bindParam(6,  $this->municipio);
    $stmt->bindParam(7,  $this->ciudad);
    $stmt->bindParam(8,  $this->pais);
    $stmt->bindParam(9,  $this->telefono);
    $stmt->bindParam(10,  $this->correo);
    $stmt->bindParam(11,  $this->contraseña);

/*
    // bind values
    $stmt->bindParam(":nombre", $this->name);
    $stmt->bindParam(":apellidop", $this->apellido_paterno);
    $stmt->bindParam(":apellidom", $this->apellido_materno);
    $stmt->bindParam(":direccion", $this->direccion);
    $stmt->bindParam(":colonia", $this->colonia);
    $stmt->bindParam(":municipio", $this->municipio);
    $stmt->bindParam(":ciudad", $this->ciudad);
    $stmt->bindParam(":pais", $this->pais);
    $stmt->bindParam(":telefono", $this->telefono);
    $stmt->bindParam(":correo", $this->correo);
    $stmt->bindParam(":contraseña", $this->contraseña);/*
    $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
    $stmt->bindParam(":id_rol", $this->id_rol);
    $stmt->bindParam(":id_area", $this->id_area);*/

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}
// used when filling up the update product form
function readOne(){

    // query to read single record
    $query = "SELECT
                 IDUsuario, Nombre, Apellido_Paterno, Apellido_Materno, Direccion, Colonia, Municipio, Ciudad, Pais, Telefono, Correo, Fecha_Nacimiento, Fecha_Alta, IDRol, IDArea, Estado
            FROM
                " . $this->table_name . "
            WHERE
                p.IDUsuario = ?
            LIMIT
                0,1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // sanitize
    $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id_usuario);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->name = $row['Nombre'];
    $this->apellido_paterno= $row['Apellido_Paterno'];
    $this->apellido_materno= $row['Apellido_Materno'];
    $this->direccion= $row['Direccion'];
    $this->colonia= $row['Colonia'];
    $this->municipio= $row['Municipio'];
    $this->ciudad= $row['Ciudad'];
    $this->pais= $row['Pais'];
    $this->telefono= $row['Telefono'];
    $this->correo= $row['Correo'];
    $this->fecha_nacimiento= $row['Fecha_Nacimiento'];
    $this->fecha_alta= $row['Fecha_Alta'];
    $this->id_rol= $row['IDRol'];
    $this->id_area= $row['IDArea'];
    $this->estado= $row['Estado'];
}
// update the product
function update(){


    //update procedure
    $call = 'CALL sp_Update_Usuario(:idu,:nombre,:apellidop,:apellidom,:direccion,:colonia,:municipio,:ciudad,:pais,:telefono,:fechanacimiento,:idrol,:idarea,:estado)';

    // prepare query statement
    $stmt = $this->conn->prepare($call);

    // sanitize
    $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->apellido_paterno=htmlspecialchars(strip_tags($this->apellido_paterno));
    $this->apellido_materno=htmlspecialchars(strip_tags($this->apellido_materna));
    $this->direccion=htmlspecialchars(strip_tags($this->direccion));
    $this->colonia=htmlspecialchars(strip_tags($this->colonia));
    $this->municipio=htmlspecialchars(strip_tags($this->municipio));
    $this->ciudad=htmlspecialchars(strip_tags($this->ciudad));
    $this->pais=htmlspecialchars(strip_tags($this->pais));
    $this->telefono=htmlspecialchars(strip_tags($this->telefono));
    $this->fecha_nacimiento=htmlspecialchars(strip_tags($this->fecha_nacimiento));
    $this->id_rol=htmlspecialchars(strip_tags($this->id_rol));
    $this->id_area=htmlspecialchars(strip_tags($this->id_area));


    // bind new values
    $stmt->bindParam(':idu', $this->id_usuario);
    $stmt->bindParam(":nombre", $this->name);
    $stmt->bindParam(":apellidop", $this->apellido_paterno);
    $stmt->bindParam(":apellidom", $this->apellido_materno);
    $stmt->bindParam(":direccion", $this->direccion);
    $stmt->bindParam(":colonia", $this->colonia);
    $stmt->bindParam(":municipio", $this->municipio);
    $stmt->bindParam(":ciudad", $this->ciudad);
    $stmt->bindParam(":pais", $this->pais);
    $stmt->bindParam(":telefono", $this->telefono);
    $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
    $stmt->bindParam(":id_rol", $this->id_rol);
    $stmt->bindParam(":id_area", $this->id_area);
    $stmt->bindParam(":estado", $this->estado);

    // execute the query
    if($stmt->execute()){
        return true;
    }

    return false;
}

// search products
function search($keywords){

    // select all query
    $query = "SELECT
               IDUsuario, Nombre, Apellido_Paterno, Apellido_Materno, Direccion, Colonia, Municipio, Ciudad, Pais, Telefono, Correo, Fecha_Nacimiento, Fecha_Alta, IDRol, IDArea, Estado
            FROM
                " . $this->table_name . "
            WHERE
               Nombre LIKE ?
            ORDER BY
                Nombre,IDUsuario DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);

    // execute query
    $stmt->execute();

    return $stmt;
}
// read products with pagination
public function readPaging($from_record_num, $records_per_page){

    // select query
    $query = "SELECT
                 IDUsuario, Nombre, Apellido_Paterno, Apellido_Materno, Direccion, Colonia, Municipio, Ciudad, Pais, Telefono, Correo, Fecha_Nacimiento, Fecha_Alta, IDRol, IDArea, Estado
            FROM
                " . $this->table_name . "
            ORDER BY Nombre,IDUsuario DESC
            LIMIT ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values from database
    return $stmt;
}

public function login(){
    //update procedure
    $call = 'CALL sp_Login(:email,:pass)';

    // prepare query statement
    $stmt = $this->conn->prepare($call);

    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->pass=htmlspecialchars(strip_tags($this->pass));


    // bind new values
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(":pass", $this->pass);

    // execute query
    $stmt->execute();

    return $stmt;


}
// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
}

}



?>
