<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db=new ConexionMySQL();

$codigo=test_input(strtoupper($_POST['codigo']));
$descripcion=test_input(strtoupper($_POST['descripcion']));
$costo=test_input($_POST['costo']);
$precio=test_input($_POST['precio']);
$proveedor=test_input($_POST['proveedor']);
$id = test_input(strtoupper($_POST['id']));
$linea = $_POST['linea'];

$actualizaProducto = $db->consulta("UPDATE articulos SET codigo= '$codigo',descripcion='$descripcion',costo=$costo,precio=$precio,proveedor=$proveedor,linea=$linea, grupo='',codigostock='',fecha_cad='0000-00-00' WHERE id = $id ");
$actualizaExistencia = $db->consulta("UPDATE existencias SET codigo= '$codigo' WHERE id = $id ");

?>