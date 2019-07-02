<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db=new ConexionMySQL();

$title = test_input($_POST['title']);
$phone = test_input($_POST['phone']);
$timeStart =test_input($_POST['timeStart']);
$timeEnd = test_input($_POST['timeEnd']);

$timeStart = str_replace("T",' ',$timeStart);
$timeEnd = str_replace('T',' ',$timeEnd);


$saveEvent = $db->consulta("INSERT INTO citas(name,phone,timeStart,timeEnd,estado) VALUES('$title','$phone','$timeStart','$timeEnd','ACTIVO' )");

if($saveEvent){
    echo "1";
}
else{
    echo "0";
}

?>