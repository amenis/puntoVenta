<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();

//$cadena="Select * from articulos";
$cadena = "SELECT * FROM proveedores";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
  echo "<div class='box box-primary'>";
  echo "    <div class='box-header'>";
  echo "        <h3 class='box-title'>Proveedores registrados.</h3>";
  echo "    </div>";
  echo "    <div class='box-body'>";
 echo "         <table id='tabla_proveedores' class='table table-hover table-condensed'>";
 echo "             <thead>";
 echo "                 <tr>";
 echo "                     <th>Nombre</th>/<th>Telefono</th><th>Direccion</th><th>Ciudad</th><th>Acciones</th>";
 echo "                 </tr>";
 echo "             </thead>";
 echo "             <tbody>";
 while($e=$db->buscar_array($exe)){
   echo "               <tr>";
   echo "                   <td style='text-align: center;'>".strtoupper($e['nombre'])."</td>";
  // echo "<td style='text-align: center;'>".strtoupper($e['codigostock'])."</td>";
   echo "                   <td style='text-align: center;'>".strtoupper($e['telefono'])."</td>";
   echo "                   <td style='text-align: center;'>$e[direccion]</td>";
   echo "                   <td style='text-align: center;'>$e[ciudad]</td>";
   if(preg_match('/(PROM)/',$_SESSION['permisos'])){    
   echo "                   <td style='text-align: center;'> <button class='btn btn-success' onclick='editar_provee(".addslashes(strtoupper($e['id'])).");' > <span class='glyphicon glyphicon-pencil'></span></button> </td>";
   }
   //echo "<td style='text-align: center;'>$e[linea]</td>";
   //echo "<td style='text-align: center;'>$e[grupo]</td>";
   echo "               </tr>";
 }
 echo "             </tbody>";
 echo "         </table>";
 echo "     </div>";
 echo "</div>";
}else{
 echo "<b>Actualmente no hay proveedores registrados...</b>";
}
?>