<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$idCompra = test_input($_POST['id']);
$user=test_input($_SESSION['nombre_de_usuario']);

$CancelCompra = $db->consulta("SELECT *  FROM kardex WHERE numero= $idCompra and tipo='CEC' ");

if($db->numero_de_registros($cancelCompra)>0){
    echo "0";
}
else{
    
    $buscaCompra = $db->consulta("SELECT *  FROM kardex WHERE numero= $idCompra and tipo='EC'");
    while($data = $db->buscar_array($buscaCompra)){
        $articulo=$data['codigo'];
        $cantidad=$data['cantidad'];
        $costou=$data['costou'];
        $preciou=$data['preciou'];
        $fecha = $data['fecha'];
        $proveedor = $data['proveedor'];
        $descuentoPorce = $data['descuento_porcentaje'];
        $impuestoPorce = $data['impuesto_porcentaje'];
        $serie = $data['serie'];
        $numero = $data['numero'];
        $cliente=$data['referencia'];

        $insertaCancelacion = $db->consulta("Insert into kardex(codigo,cantidad,tipo,fecha,user,costou,preciou,
        proveedor,descuento_porcentaje,impuesto_porcentaje,serie,numero,fecha_proceso,referencia,
        referencia1,referencia2) values('$articulo',$cantidad,'CEC',$fecha,'$user',$costou,$preciou,
        $proveedor,$descuentoPorce,$impuestoPorce,$serie,$numero,now(),'$cliente','','')");
    }
    echo "1";
}



?>