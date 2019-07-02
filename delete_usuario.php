<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$nombreUsr = test_input(strtoupper($_POST['nombreUsr']) );

$elimina = $db->consulta("DELETE FROM usuarios WHERE nombre = '$nombreUsr' AND editable = 'si' ");

?>