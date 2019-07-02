<?php

session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db=new ConexionMySQL();

$id = test_input($_POST['id']);
$title = test_input($_POST['title']);
$phone = test_input($_POST['phone']);
$timeStart =test_input($_POST['timeStart']);
$timeEnd = test_input($_POST['timeEnd']);

$timeStart = str_replace("T",' ',$timeStart);
$timeEnd = str_replace('T',' ',$timeEnd);


$saveEvent = $db->consulta(" UPDATE citas SET name= '$title', phone='$phone', timeStart = '$timeStart', timeEnd = '$timeEnd' WHERE id = $id ");

if($saveEvent){
    echo "1";
}
else{
    echo "0";
}

$db->getError();

?>