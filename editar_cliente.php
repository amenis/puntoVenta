<?php
session_start();
if($_SESSION['autorizado']<>1){
header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db= new ConexionMySQL();
$idcliente = test_input($_POST['id']);
$set_names=$db->consulta("SET NAMES 'utf8'");

$exec = $db->consulta("SELECT * FROM clientes WHERE id = '$idcliente' ");
if ($db->numero_de_registros($exec)>0) {
    while ($r = $db->buscar_array($exec)) {
        echo '
        
        <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Nombre Cliente:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="editaNombre" placeholder="Nombre Cliente" value="'.$r['nombre'].'" >
            </div>
        </div>
        <div class="form-group">
            <label for="telefono" class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-3">
                <input type="text" id="editaTelefono" class="form-control" placeholder="Telefono Cliente" value="'.$r['telefono'].'" >
            </div>
        </div>
        <div class="form-group">
            <label for="domicilio" class="col-sm-2 control-label">Domicilio</label>
            <div class="col-sm-3">
                <input type="text" id="editaDomicilio" class="form-control" placeholder="Domicilio Cliente" value="'.$r['domicilio'].'" >
            </div>
        </div>
        <div class="form-group">
            <label for="Ciudad" class="col-sm-2 control-label">Ciudad</label>
            <div class="col-sm-3">
                <input type="text" id="editaCiudad" class="form-control" placeholder="Ciudad Cliente" value="'.$r['ciudad'].'" >
            </div>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-success btn-lg" onclick="update_cliente('.strtoupper($r['id']).');" ><i class="fa   fa-pencil"></i> Editar...</button>
            <button type="button" class="btn btn-danger btn-lg" onclick="cancela_update();" ><i class="fa  fa-recycle"></i> Cancelar...</button>
        </div>
        ';
    }
} else {
    echo "0";
   
}



$db->DesconectaServer();
?>