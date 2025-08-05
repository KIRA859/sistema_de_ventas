<?php
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'sistemadeventas');
$servidor = "mysql:host=localhost;dbname=sistemadeventas";
//$servidor = "mysql : dbname=".BD."; host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
   // echo "La conexion a la base de datos fue con exito"; 
}catch(PDOException $e){
    //print_r($e);
    echo "!Error al conectar a la base de datos!";
}

$URL = "http://localhost/sistema_de_ventas";

date_default_timezone_set("America/Bogota"); 
$fechaHora=date('Y-m-d H:i:s');//Si se utiliza h:i:s el formato de hora sera completo de 24 horas osea que despues de las 12pm sera 13 y asi.

