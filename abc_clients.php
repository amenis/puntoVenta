<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Clientes</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link href="plugins/jtable/themes/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
    <link href="plugins/jtable/jquery-ui.structure.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/jtable/themes/metro/blue/jtable.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body onload="lista_clientes()">

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
            Mantenimiento de Clientes.
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mtto. de Clientes.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
            <div class='col-md-12'>
              <div class='nav-tabs-custom'>
                <ul class="nav nav-tabs pull-right">
                  <li><a href="#ver" data-toggle="tab">Ver clientes</a></li>
                  <li><a href="#bajas" data-toggle="tab">Baja</a></li>
                  <li class="active"><a href="#altas" data-toggle="tab">Alta</a></li>
                  <li class="pull-left header"><i class="fa fa-file-text"></i> Movimientos Clientes.</li>
                </ul>
                <div class="tab-content">

                  <div class="tab-pane active" id="altas">
                    <form class="form-horizontal">
                      <div class='form-group'>
                        <label for="descripcion" class="col-sm-2 control-label">Nombre Cliente:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id='nombreCliente' placeholder='Nombre Cliente' required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="telefono" class="col-sm-2 control-label">Telefono</label>
                        <div class="col-sm-3">
                          <input type="text" id="telefono" class="form-control" placeholder="Telefono Cliente">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="domicilio" class="col-sm-2 control-label">Domicilio</label>
                        <div class="col-sm-3">
                          <input type="text" id="domicilio" class="form-control" placeholder="Domicilio Cliente">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Ciudad" class="col-sm-2 control-label">Ciudad</label>
                        <div class="col-sm-3">
                          <input type="text" id="ciudad" class="form-control" placeholder="Ciudad Cliente">
                        </div>
                      </div>
                      <div class="btn-group">
                        <button type='button' class='btn btn-raised btn-primary btn-lg' onclick='alta_cliente();' id='btn-altas'><i class='fa fa-check-circle'></i> Registrar Cliente.</button>
                        <button type='button' class='btn btn-danger btn-raised btn-lg' onclick='cancela_alta();' id='btn-alta-cancela'><i class='fa fa-times'></i> Cancelar.</button>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="bajas">
                    <form class='form-horizontal' onkeypress="return anular(event)">
                      <div class='form-group'>
                        <label for="codigo_busqueda" class="col-sm-2 control-label">nombre:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id='nombre_busqueda' onchange="busca_cliente();" placeholder='nombre proveedor...' >
                        </div>
                      </div>
                      <div id='info_Cliente'></div>
                      <br>
                      <div class="btn-group">
                        <button type='button' class='btn btn-primary btn-lg' onclick='busca_cliente();' id='btn-buscar'><i class='fa  fa-search'></i> Buscar...</button>
                        <button type='button' class='btn btn-success btn-lg' onclick='elimina_cliente();' id='btn-procede-baja' disabled><i class='fa   fa-times'></i> Eliminar...</button>
                        <button type='button' class='btn btn-danger btn-lg' onclick='cancela_eliminacion();' id='btn-cancela-baja' disabled><i class='fa  fa-recycle'></i> Cancelar...</button>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="ver">
                    <form class="form-horizontal" onkeypress="return anular(event)">
                      <div id='edit_clientes'></div>
                    </form>
                    <br>                    
                    <div id='lista_clientes'>
                  </div>

                </div>
              </div>
            </div>
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <!-- Main Footer -->
      <?php
      include('class_lib/main_fotter.php');
      ?>


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
    <script src="dist/js/source_clients.js"></script>
  </body>
</html>