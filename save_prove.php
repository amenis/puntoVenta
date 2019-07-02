<?php
session_start();
    if($_SESSION['autorizado']<>1){
        header("Location: index.php");
    }
    //error_reporting(0);
    require('class_lib/class_conecta_mysql.php');
    require('class_lib/funciones.php');

    $db=new ConexionMySQL();

    $nombre = test_input($_POST['nombre']);
    $telefono = test_input($_POST['telefono']);
    $domicilio = test_input($_POST['domicilio']);
    $ciudad = test_input($_POST['ciudad']);

    //verify if exist the provider
    $existProveconsult = $db->consulta("SELECT * FROM proveedores WHERE nombre = '$nombre'");
    if( $db->numero_de_registros($existProveconsult)==0 ){
        $guardaProveedor = $db->consulta( "INSERT INTO proveedores(nombre,telefono,domicilio,ciudad) VALUES('$nombre','$telefono','$domicilio','$ciudad')" );
        echo "1";
    }
    else{
        echo "3";
    }

