<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ventas</title>
    <?php include "./class_lib/links.php"; ?>
</head>
<body onload="revisa_compras();revisa_ventas();pone_gastos();pone_users();genera_grafica();genera_grafica_existe()">
    <?php
         include('class_lib/nav_header2.php');
     ?>
    <div class="container-fluid">
                 <!-- Logo -->
         
       
        <aside class="main-sidebar">
            <?php
            include('class_lib/sidebar.php');
            include('class_lib/class_conecta_mysql.php');
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S�bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            $db=new ConexionMySQL();
            $consulta=$db->consulta("Select nombre_empresa from parametros");
            while($sw=$db->buscar_array($consulta)){
                $name_empresa=$sw['nombre_empresa'];
            }
            ?>
        </aside>
        <section class="content-header">
            <h1>
            <?php
            echo $name_empresa;
            ?>
              <small><?php echo $fecha; ?></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Inicio</li>
            </ol>
        </section>
        <section class="content">
            <div class='row'>
            <div id='pone_compras'></div>
            <div id='pone_ventas'></div>
            <div id='pone_gastos'></div>
            <div id='pone_users'></div>
        </section>
        <div class="MsjAjaxForm"></div>
        <?php include "./class_lib/scripts.php"; ?>
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/morris/raphael-min.js"></script>
        <script src="dist/js/source_init.js"></script>
    </div>
</body>
</html>