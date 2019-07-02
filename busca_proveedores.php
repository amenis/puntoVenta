<?php
session_start();
if($_SESSION['autorizado']<>1){
header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db= new ConexionMySQL();
$nombreProve = test_input($_POST['nombre']);
$set_names=$db->consulta("SET NAMES 'utf8'");

$exec = $db->consulta("SELECT * FROM proveedores WHERE nombre = '$nombreProve' ");
if ($db->numero_de_registros($exec)>0) {
    while ($r = $db->buscar_array($exec)) {
        echo '
        
        <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Nombre Proveedor:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="" placeholder="Nombre Proveedor" value="'.$r['nombre'].'" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="telefono" class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-3">
                <input type="text" id="" class="form-control" placeholder="Telefono Proveedor" value="'.$r['telefono'].'" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="domicilio" class="col-sm-2 control-label">Domicilio</label>
            <div class="col-sm-3">
                <input type="text" id="" class="form-control" placeholder="Domicilio Proveedor" value="'.$r['domicilio'].'" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="Ciudad" class="col-sm-2 control-label">Ciudad</label>
            <div class="col-sm-3">
                <input type="text" id="" class="form-control" placeholder="Ciudad Proveedor" value="'.$r['ciudad'].'" disabled>
            </div>
        </div>
      
        ';
    }
} else {
    echo "0";
   
}



$db->DesconectaServer();
?>