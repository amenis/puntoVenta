<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();

$cadena="Select * from usuarios";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
  echo "<div class='box box-primary'>";
  echo "<div class='box-header'>";
  echo "<h3 class='box-title'>Usuarios registrados.</h3>";
  echo "</div>";
  echo "<div class='box-body'>";
 echo "<table id='tabla_users' class='table table-hover table-condensed'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>Nombre</th>";
 echo "</tr>";
 echo "<tr>";
 echo "<th>Acciones</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
 while($e=$db->buscar_array($exe)){
    echo "<tr>";
    echo "<td style='text-align: center;'>".strtoupper($e['nombre'])."</td>";
    echo "<td style='text-align: center;'>";
    
    if(preg_match('/(USRM)/',$_SESSION['permisos'])){  
      echo "<button type='button' class='btn btn-success' onclick='editar_usuario(\"".addslashes(strtoupper($e['id']))."\");' ><i class='fa   fa-pencil'></i> </button>";
    }
    echo "</tr>";
  
 }
 echo "</tbody>";
 echo "</table>";
 echo "</div>";
 echo "</div>";
}else{
 echo "<b>Actualmente no hay usuarios registrados...</b>";
}
?>