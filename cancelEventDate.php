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


$sql = $db->consulta("UPDATE citas SET  estado = 'CANCELADO' WHERE id = $id ");
if($sql){
    echo "1";
}
else{
    echo "0";
}

?>