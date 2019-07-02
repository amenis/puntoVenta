<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>

<html>
  <head>
    <title>Proveedores</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/datepicker/css/bootstrap-datepicker3.css">
  </head>
  <body  onload="lista_proveedores()">

    <div class="wrapper">

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
        <section class="content">
            <div class='row'>
                <div class='col-md-12'>
                    <div class='nav-tabs-custom'>
                        <ul class="nav nav-tabs pull-right">
                            <li><a href="#ver" data-toggle="tab">Ver Proveedores</a></li>
                            <li><a href="#bajas" data-toggle="tab">Baja</a></li>
                            <li class="active"><a href="#altas" data-toggle="tab">Alta</a></li>

                            <li class="pull-left header"><i class="fa fa-file-text"></i> Movimientos Proveedores.</li>
                        </ul>
                        <div class="tab-content">
                            
                            <div class="tab-pane active" id="altas">
                                <?
                                if(preg_match('/(PROA)/',$_SESSION['permisos'])){                               
                                ?>
                                <form class="form-horizontal">
                                    <div class='form-group'>
                                        <label for="descripcion" class="col-sm-2 control-label">Nombre Proveedor:</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id='nombreProveedor' placeholder='Nombre Proveedor' required>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="telefono" class="col-sm-2 control-label">Telefono</label>
                                        <div class="col-sm-3">
                                            <input type="text" id="telefono" class="form-control" placeholder="Telefono Proveedor">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="domicilio" class="col-sm-2 control-label">Domicilio</label>
                                        <div class="col-sm-3">
                                            <input type="text" id="domicilio" class="form-control" placeholder="Domicilio Proveedor">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Ciudad" class="col-sm-2 control-label">Ciudad</label>
                                        <div class="col-sm-3">
                                            <input type="text" id="ciudad" class="form-control" placeholder="Ciudad Proveedor">
                                        </div>
                                    </div>

                                    <div class="btn-group">
                                        <button type='button' class='btn btn-raised btn-primary btn-lg' onclick='alta_proveedor();' id='btn-altas'><i class='fa fa-check-circle'></i> Registrar Proveedor.</button>
                                        <button type='button' class='btn btn-danger btn-raised btn-lg' onclick='cancela_alta();' id='btn-alta-cancela'><i class='fa fa-times'></i> Cancelar.</button>
                                    </div>
                                </form>
                                <?
                                }
                                else{
                                    echo "<h3>NO CUENTA CON LOS PERMISOS REQUERIDOS</h3>";
                                }
                                ?>
                            </div>

                            <div class="tab-pane" id="bajas">
                                <?
                                if(preg_match('/(PROC)/',$_SESSION['permisos'])){                                    
                                ?>
                                <form class='form-horizontal' onkeypress="return anular(event)">
                                    <div class='form-group'>
                                        <label for="codigo_busqueda" class="col-sm-2 control-label">nombre:</label>
                                        <div class="col-sm-3">
                                        <input type="text" class="form-control" id='nombre_busqueda' onchange="busca_provedor();" placeholder='nombre proveedor...' >
                                        </div>
                                    </div>

                                    <div id='info_proveedor'></div>
                                    <br>
                                    <div class="btn-group">
                                        <button type='button' class='btn btn-primary btn-lg' onclick='busca_provedor();' id='btn-buscar'><i class='fa  fa-search'></i> Buscar...</button>
                                        <button type='button' class='btn btn-success btn-lg' onclick='elimina_proveedor();' id='btn-procede-baja' disabled><i class='fa   fa-times'></i> Eliminar...</button>
                                        <button type='button' class='btn btn-danger btn-lg' onclick='cancela_eliminacion();' id='btn-cancela-baja' disabled><i class='fa  fa-recycle'></i> Cancelar...</button>
                                    </div>
                                </form>
                                <?
                                }
                                else{
                                    echo "<h3>NO CUENTA CON LOS PERMISOS REQUERIDOS</h3>";
                                }
                                ?>               
                            </div>
                            
                            <div class="tab-pane" id="ver">
                                <form class="form-horizontal" onkeypress="return anular(event)">
                                    <div id='edit_proveedores'></div>
                                </form>
                                <br>                    
                                <div id='lista_proveedores'>
                            </div>

                        </div><!-- /.tab-content -->
                    </div>
                </div>
            </div>

            <div class='col-md-12'></div>
               
            
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/uploadify/jquery.uploadify.js"></script>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="dist/js/source_provs.js"></script>
  </body>
</html>