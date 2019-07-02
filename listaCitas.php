<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db=new ConexionMySQL();

$timeStart = test_input($_GET['timeStart']);

mysqli_real_escape_string($timeStart);

$getDates = $db->consulta("SELECT * FROM citas ORDER BY id AND estado = 'ACTIVO' ");

$data = array();
$i=0;

if($db->numero_de_registros($getDates)>0 ){
    while ($a = $db->buscar_array($getDates)) {

        $start = explode(" ", $a['timeStart'] );
		$end = explode(" ", $a['timeEnd']);
		if($start[1] == '00:00:00'){
			$start = $start[0];
		}else{
			$start = $a['timeStart'];
		}
		if($end[1] == '00:00:00'){
			$end = $end[0];
		}else{
			$end = $a['timeEnd'];
		}

        $data[$i]['id'] = $a['id'];
        $data[$i]['title'] = $a['name'];
        $data[$i]['phone'] = $a['phone'];
        $data[$i]['start'] = $start;
        $data[$i]['end'] = $end;
        //$data[$i] = $a;
        $i++;
    }
    echo json_encode($data);
   
}
else{
    
    echo json_encode("");
}

$db->getError();
?>