<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Usuarios</title>
    <?php include "./class_lib/links.php"; ?>
  </head>
  <body onload="pone_users_registrados();">

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
        include('class_lib/class_conecta_mysql.php');
        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Movimientos de Usuarios.
              <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Usuarios</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class='row'>
            <div class='col-md-12'>
              <div class='nav-tabs-custom'>
                  <ul class="nav nav-tabs pull-right">
                    <li><a href="#cambios" data-toggle="tab">Ver Usuarios</a></li>
                    <li><a href="#bajas" data-toggle="tab">Baja</a></li>
                    <li class="active"><a href="#altas" data-toggle="tab">Alta</a></li>

                    <li class="pull-left header"><i class="fa fa-file-text"></i> Operaciones de usuarios.</li>
                  </ul>
                  <div class="tab-content">
                    <!----------------------------------------------------------------------------------------->
                    <div class="tab-pane active" id="altas">
                      <div class='box box-warning'>
                        
                        
                        <div class="box-header with-border">
                          <h3 class='box-title'>Crear nuevo usuario</h3>
                        </div>
                        <?
                        if(preg_match('/(USRA)/',$_SESSION['permisos'])){
                        ?>
                        <form class="form-horizontal">
                          <div class='form-group'>
                            <label for="codigo" class="col-sm-2 control-label">Nombre completo:</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id='nombre' placeholder='Nombre del usuario...' required>
                            </div>
                          </div>

                          <div class='form-group'>
                            <label for="codigo" class="col-sm-2 control-label">Usuario:</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id='clave' placeholder='Clave del usuario...' required>
                            </div>
                          </div>

                          <div class='form-group'>
                            <label for="codigo" class="col-sm-2 control-label">Password:</label>
                            <div class="col-sm-3">
                              <input type="password" class="form-control" id='pass' placeholder='Password del usuario...' required>
                            </div>
                          </div>

                          <div class='form-group'>
                            <label for="codigo" class="col-sm-2 control-label">Permisos:</label>
                            <div class="col-sm-7">
                              <br>
                              <div class="col-sm-2 pull-right">
                                <div class="">
                                  <b>Marcar Todos  </b>
                                  <input type="checkbox" onChange="allPermitions('tblPermitions')">
                                </div>
                              </div>
                              <br><br>
                              <table class="table table-hover" id="tblPermitions">
                                <thead>
                                  <tr>
                                    <th style="text-align: center;"></th>
                                    <th>Ver</th>
                                    <th>Agregar</th>
                                    <th>Cancelar y Eliminar</th>
                                    <th>Modificar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                  <tr class="text-center">
                                    <td>Ventas</td>
                                    <td><input type="checkbox" name="pos1" value="VTSV"   ></td>
                                    <td><input type="checkbox" name="pos2" value="VTSA"   ></td>
                                    <td><input type="checkbox" name="pos3" value="VTSC"   ></td>
                                    
                                  </tr>
                                  
                                  <tr class="text-center">
                                    <td>Citas</td>
                                    <td><input type="checkbox" name="pos40" value="CITAV"  ></td>
                                    <td><input type="checkbox" name="pos41" value="CITAA"  ></td>
                                    <td><input type="checkbox" name="pos42" value="CITAC"  ></td>
                                    <td><input type="checkbox" name="pos43" value="CITAM"  ></td>
                                  </tr>

                                  <tr class="text-center">
                                    <td>Articulos</td>
                                    <td><input type="checkbox" name="pos4" value="ARTV"  ></td>
                                    <td><input type="checkbox" name="pos5" value="ARTA"  ></td>
                                    <td><input type="checkbox" name="pos6" value="ARTC"  ></td>
                                    <td><input type="checkbox" name="pos7" value="ARTM"  ></td>
                                  </tr>
                                  <tr class="text-center">
                                    <td>lineas</td>
                                    <td><input type="checkbox" name="pos8" value="LINV"  ></td>
                                    <td><input type="checkbox" name="pos9" value="LINA" ></td>
                                    <td><input type="checkbox" name="pos10" value="LINC" ></td>
                                    <td><input type="checkbox" name="pos11" value="LINM" ></td>
                                  </tr>
                                  <tr class="text-center">
                                    <td>Proveedores</td>
                                    <td><input type="checkbox" name="pos12" value="PROV" ></td>
                                    <td><input type="checkbox" name="pos13" value="PROA" ></td>
                                    <td><input type="checkbox" name="pos14" value="PROC" ></td>
                                    <td><input type="checkbox" name="pos15" value="PROM" ></td>
                                  </tr>

                                  <tr class="text-center">
                                    <td>Entrada Compras</td>
                                    <td><input type="checkbox" name="pos16" value="COMPV" ></td>
                                    <td><input type="checkbox" name="pos17" value="COMPA" ></td>                                   
                                    
                                  </tr>

                                  <tr class="text-center">
                                    <td>Revision de Entrada Compras</td>
                                    <td><input type="checkbox" name="pos18" value="RECV" ></td>
                                    <td></td>
                                    <td><input type="checkbox" name="pos19" value="RECC"></td>
                                    
                                  </tr>

                                  <tr class="text-center">
                                    <td>Inventarios</td>
                                    <td><input type="checkbox" name="pos20" value="INVV" ></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="pos21" value="INVM" ></td>
                                  </tr>

                                  <tr class="text-center">
                                    <td>Corte de Caja</td>
                                    <td><input type="checkbox" name="pos22" value="CORTV" ></td>
                                    
                                  </tr>

                                  <tr class="text-center">
                                    <td>Existencias</td>
                                    <td><input type="checkbox" name="pos23" value="EXISV" ></td>
                                    
                                  </tr>

                                  <tr class="text-center">
                                    <td>Reportes Ventas</td>
                                    <td><input type="checkbox" name="pos24" value="REPVV" ></td>
                                   
                                  </tr>

                                  <tr class="text-center">
                                    <td>Registro Gastos</td>
                                    <td><input type="checkbox" name="pos25" value="GASTV" ></td>
                                    <td><input type="checkbox" name="pos26" value="GASTA" ></td>
                                    
                                  </tr>
                                 

                                  <tr class="text-center">
                                    <td>Proveedores</td>
                                    <td><input type="checkbox" name="pos27" value="PROV" ></td>
                                    <td><input type="checkbox" name="pos28" value="PROA" ></td>
                                    <td><input type="checkbox" name="pos29" value="PROC" ></td>
                                    <td><input type="checkbox" name="pos30" value="PROM" ></td>
                                  </tr>

                                  <tr class="text-center">
                                    <td>Editar Gastos</td>
                                    <td><input type="checkbox" name="pos31" value="EGASV" ></td>
                                    <td></td>
                                    <td><input type="checkbox" name="pos32" value="EGASC" ></td>
                                    <td></td>
                                  </tr>

                                  <tr class="text-center">
                                    <td>Parametros</td>
                                    <td><input type="checkbox" name="pos33" value="PARAV" ></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="pos34" value="PARAM" ></td>
                                  </tr>

                                  <tr class="text-center">
                                    <td>Respaldo</td>
                                    <td><input type="checkbox" name="pos35" value="RESV" ></td>
                                    
                                  </tr>

                                  <tr class="text-center">
                                    <td>Usuarios</td>
                                    <td><input type="checkbox" name="pos36" value="USRV" ></td>
                                    <td><input type="checkbox" name="pos37" value="USRA" ></td>
                                    <td><input type="checkbox" name="pos38" value="USRC" ></td>
                                    <td><input type="checkbox" name="pos39" value="USRM" ></td>
                                  </tr>



                                </tbody>
                              </table>
                            </div>
                          </div>
                          
                          <div class="btn-group">
                            <button type='button' class='btn btn-danger pull-right' onclick='registra_usr();' id='btn-reg-usr'>Registrar</button>
                          </div>

                        </form>
                        <?
                        }
                        else{
                          echo "<h3>NO CUENTA CON LOS PERMISOS REQUERIDOS</h3>";
                        }
                        ?>
                      </div>  

                    </div>
                    <!---------------------------------------------------------------------------------------->
                    
                    <div class="tab-pane" id="bajas">

                      <?
                      if( preg_match('/(USRC)/',$_SESSION)){
                      ?>
                      <form class='form-horizontal' onkeypress="return anular(event)">
                        <div class='form-group'>
                          <label for="nombre_busqueda" class="col-sm-2 control-label">Codigo:</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id='nombre_busqueda' onchange="busca_usuario();" placeholder='Nombre Usuario...'>
                          </div>
                        </div>

                        <div id='info_usuario'></div>
                        <br>
                        <div class="btn-group">
                          <button type='button' class='btn btn-primary btn-lg' onclick='busca_usuario();' id='btn-buscar'><i class='fa  fa-search'></i> Buscar...</button>
                          <button type='button' class='btn btn-success btn-lg' onclick='elimina_usuario();' id='btn-procede-baja' disabled><i class='fa   fa-times'></i> Eliminar...</button>
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
                    <!---------------------------------------------------------------------------------------->
                    

                    <div class="tab-pane" id="cambios">

                      <form class="form-horizontal" onkeypress="return anular(event)">
                        <div id='edit_user'></div>
                      </form>
                       <br>   
                      <div id='users_registrados'></div>                     

                    </div>



                  </div>
              </div>
            </div>
          </div>
          <!-- Your Page Content Here -->

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
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="dist/js/source_parameters.js"></script>
  </body>
</html>