<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Citas</title>
        <?php include "./class_lib/links.php"; ?>
        <!-- FullCalendar -->
        <link rel="stylesheet" href='dist/css/fullcalendar.min.css'>
        <style>
           
            #calendar {
                max-width: 830px;
                max-height: 50px;
            }
            .col-centered{
                float: none;
                margin: 0 auto;

            }
        </style>

    </head>
    <body>
        
        <div class="wrapper" style="background:white">
            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <?php
                include('class_lib/nav_header.php');
                ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <?php
                include('class_lib/sidebar.php');
                ?>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    Mantenimiento de Proveedores.
                    <small></small>
                    </h1>
                    <ol class="breadcrumb">
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Mtto. de Proveedores.</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" style="background:white">
                
                    <!-- Your Page Content Here -->
                   
                    <div class='col-lg-12 text-center'>                        
                        <div id="calendar" class="col-centered">                        
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <?
                                if(preg_match('/(CITAA)/',$_SESSION['permisos'] )){
                                ?>
                                <form class="form-horizontal" method="POST" onsubmit="return false">
                                
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Nombre</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Telefono</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="telefono">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                                            <div class="col-sm-10">
                                            <input type="datetime-local" name="start" class="form-control" id="start"   >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                                            <div class="col-sm-10">
                                            <input type="datetime-local" name="end" class="form-control" id="end" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary" onclick="guardarEvento()" data-dismiss="modal" >Guardar</button>
                                    </div>
                                </form>
                                <?
                                }
                                else{
                                    echo "<h3>No cuenta con los permisos requeridos</h3>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form class="form-horizontal" method="POST" onsubmit="return false">
                                
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Editar Evento</h4>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Nombre</label>
                                            <div class="col-sm-10">
                                            <input type="hidden" name="id" class="form-control" id="Editid">
                                            <input type="text" name="nombre" class="form-control" id="Editnombre" placeholder="nombre">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Telefono</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="telefono" class="form-control" id="Edittelefono" placeholder="telefono">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                                            <div class="col-sm-10">
                                            <input type="datetime-local" name="start" class="form-control" id="Editstart"   >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                                            <div class="col-sm-10">
                                            <input type="datetime-local" name="end" class="form-control" id="Editend" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                                        <?
                                        if(preg_match('/(CITAM)/',$_SESSION['permisos'])){
                                        ?>
                                        <button type="submit" class="btn btn-primary" onclick="editaEvento()" data-dismiss="modal" >Editar</button>
                                        <?
                                        }
                                        if(preg_match('/(CITAC)/',$_SESSION['permisos'])){
                                        ?>
                                        <button type="submit" class="btn btn-danger" onclick="cancelarEvento()" data-dismiss="modal" >Cancelar</button>
                                        <?
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
		
                    
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
        </div>

        <!-- REQUIRED JS SCRIPTS -->
        <div class="MsjAjaxForm"></div>
        <?php include "./class_lib/scripts.php"; ?>
        <script src="plugins/fastclick/fastclick.min.js"></script>
        <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
        <script src="dist/js/moment.min.js"></script>
        <script src='dist/js/fullcalendar.min.js'></script>
        <script src='dist/js/fullcalendar.js'></script>
        <script src='dist/js/locale/es.js'></script>       
        <script src='dist/js/dates.js'></script>
    </body>
</html>