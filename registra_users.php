<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$nombre=test_input(strtoupper($_POST['nombre']));
$clave=test_input($_POST['clave']);
$pass=test_input($_POST['pass']);
$permisos = test_input($_POST['permisos']);
$cadena=$db->consulta("Insert into usuarios(nombre,clave,password,bodega,editable) values('$nombre','$clave','$pass',1,'si')");
?>