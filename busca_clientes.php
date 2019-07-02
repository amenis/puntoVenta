<?php
session_start();
if($_SESSION['autorizado']<>1){
header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db= new ConexionMySQL();
$nombreCliente = test_input($_POST['nombre']);
$set_names=$db->consulta("SET NAMES 'utf8'");

$exec = $db->consulta("SELECT * FROM clientes WHERE nombre = '$nombreCliente' ");
if ($db->numero_de_registros($exec)>0) {
    while ($r = $db->buscar_array($exec)) {
        echo '
        
        <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Nombre Cliente:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="editaNombre" placeholder="Nombre Cliente" value="'.$r['nombre'].'" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="telefono" class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-3">
                <input type="text" id="editaTelefono" class="form-control" placeholder="Telefono Cliente" value="'.$r['telefono'].'" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="domicilio" class="col-sm-2 control-label">Domicilio</label>
            <div class="col-sm-3">
                <input type="text" id="editaDomicilio" class="form-control" placeholder="Domicilio Cliente" value="'.$r['domicilio'].'" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="Ciudad" class="col-sm-2 control-label">Ciudad</label>
            <div class="col-sm-3">
                <input type="text" id="editaCiudad" class="form-control" placeholder="Ciudad Cliente" value="'.$r['ciudad'].'" disabled>
            </div>
        </div>
        ';
    }
} else {
    echo "0";
   
}



$db->DesconectaServer();
?>