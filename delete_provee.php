<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db=new ConexionMySQL();

$nombre = test_input($_POST['nombre']);

$buscaProvee = $db->consulta("SELECT id FROM proveedores WHERE nombre = '$nombre' ");

if($db->numero_de_registros($buscaProvee)>0 ){
    while($e=$db->buscar_array($buscaProvee)){
      //  echo "DELETE FROM proveedores WHERE id = ".$e['id'];
      echo  $eliminaProvee = $db->consulta("DELETE FROM proveedores WHERE id = ".$e['id']);
    }     
}
else{
    echo "0";    
}
?>

