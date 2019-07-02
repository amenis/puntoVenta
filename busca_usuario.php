<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$nombreUsr=test_input(strtoupper($_POST['nombreUsr']));

$consulta = $db->consulta("SELECT * FROM usuarios WHERE nombre='$nombreUsr' AND editable = 'si' ");

if($db->numero_de_registros($consulta)>0){
    while ($r = $db->buscar_array($consulta)) {
        echo "
    
        <div class='form-group'>
            <label for='codigo' class='col-sm-2 control-label'>Nombre completo:</label>
            <div class='col-sm-5'>
                <input type='text' class='form-control' value=".$r['nombre']." placeholder='Nombre del usuario...' disabled>
            </div>
        </div>
    
        <div class='form-group'>
            <label for='codigo' class='col-sm-2 control-label'>Usuario:</label>
            <div class='col-sm-3'>
                <input type='text' class='form-control' value=".$r['clave']." placeholder='Clave del usuario...' disabled>
            </div>
        </div>
    
        <div class='form-group'>
            <label for='codigo' class='col-sm-2 control-label'>Password:</label>
            <div class='col-sm-3'>
                <input type='password' class='form-control' value=".$r['password']." placeholder='Password del usuario...' disabled>
            </div>
        </div>
    
    ";
    }
}
else{
    echo 0;
    
}
  

?>