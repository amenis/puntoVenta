<?php include "./class_lib/sesionSecurity.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    include "./class_lib/links.php";
    include "./class_lib/scripts.php"; 
    ?>
</head>
<body>
    
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
            <h1> Perfil.</h1>   
        </section>

        <!-- Main content -->
        <section class="content">
           
            <div class='row'>
                <div class='col-md-12'> 
                    <div class='box box-primary'>
                        <div class='box-header with-border'>
                            <h3 class='box-title'>Datos del gasto...</h3>
                        </div>
                        <div class='box-body'>
                       
                            <?php
                            //include('./class_lib/funciones.php');
                                $db=new ConexionMySQL();

                                $id=test_input(strtoupper( base64url_decode( $_GET['perfil'] )    )  );
                                $consulta = $db->consulta("SELECT * FROM usuarios WHERE id='$id' ");

                                if($db->numero_de_registros($consulta)>0){
                                    
                                    while ($r = $db->buscar_array($consulta)) {
                                        $permitions = $r['permisos'];
                                        $disabled = $r['editable'] == "no" ? "disabled" : "" ;
                 
                                        echo "
                                        <form class='form-horizontal'>
                                            <div class='form-group'>
                                                <label for='codigo' class='col-sm-2 control-label'>Nombre completo:</label>
                                                <div class='col-sm-5'>
                                                    <input type='text' class='form-control' id='editaNombre' value=".$r['nombre']." placeholder='Nombre del usuario...' ".$disabled." >
                                                </div>
                                            </div>
                                        
                                            <div class='form-group'>
                                                <label for='codigo' class='col-sm-2 control-label'>Usuario:</label>
                                                <div class='col-sm-3'>
                                                    <input type='text' class='form-control' id='editaClave' value=".$r['clave']." placeholder='Clave del usuario...' >
                                                </div>
                                            </div>
                                        
                                            <div class='form-group'>
                                                <label for='codigo' class='col-sm-2 control-label'>Password:</label>
                                                <div class='col-sm-3'>
                                                    <input type='password' class='form-control' id='editaPassword'  placeholder='Password del usuario...' value=".$r['password']." >
                                                </div>
                                            </div>

                                            <div class='form-group'>
                                                <label for='codigo' class='col-sm-2 control-label'>Permisos:</label>
                                                <div class='col-sm-7'>
                                                  
                                                    ";
                                                    if($r['editable']=='no'){
                                                        echo "
                                                        <br>
                                                        <div class='col-sm-2 pull-right'>
                                                            <div class=''>
                                                                <b>Marcar Todos  </b>
                                                                <input type='checkbox' onChange='allPermitions(\"tblEditPermitions\")'>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <table class='table table-hover' id='tblEditPermitions'>
                                                            <thead>
                                                                <tr>
                                                                    <th style='text-align: center;'></th>
                                                                    <th>Ver</th>
                                                                    <th>Agregar</th>
                                                                    <th>Cancelar y Eliminar</th>
                                                                    <th>Modificar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr class='text-center'>
                                                                    <td>Ventas</td>
                                                                    <td><input type='checkbox' name='pos1' value='VTSV' ".(  ( preg_match('/(VTSV)/',$permitions) ) ?  'checked=true' :  '' )."  ></td>
                                                                    <td><input type='checkbox' name='pos2' value='VTSA' ".(  ( preg_match('/(VTSA)/',$permitions) ) ?  'checked=true' :  '' )."  ></td>
                                                                    <td><input type='checkbox' name='pos3' value='VTSC' ".(  ( preg_match('/(VTSC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                        
                                                                </tr>
                                                                <tr class='text-center'>
                                                                    <td>Citas</td>
                                                                    <td><input type='checkbox' name='pos40' value='CITAV' ".(  ( preg_match('/(CITAV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos41' value='CITAA' ".(  ( preg_match('/(CITAA)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos42' value='CITAC' ".(  ( preg_match('/(CITAC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos43' value='CITAM' ".(  ( preg_match('/(CITAM)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                </tr>
                                                                <tr class='text-center'>
                                                                    <td>Articulos</td>
                                                                    <td><input type='checkbox' name='pos4' value='ARTV' ".(  ( preg_match('/(ARTV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos5' value='ARTA' ".(  ( preg_match('/(ARTA)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos6' value='ARTC' ".(  ( preg_match('/(ARTC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos7' value='ARTM' ".(  ( preg_match('/(ARTM)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                </tr>
                                                                <tr class='text-center'>
                                                                    <td>lineas</td>
                                                                    <td><input type='checkbox' name='pos8' value='LINV' ".(  ( preg_match('/(LINV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos9' value='LINA' ".(  ( preg_match('/(LINA)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos10' value='LINC' ".(  ( preg_match('/(LINC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos11' value='LINM' ".(  ( preg_match('/(LINM)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                </tr>
                                                                <tr class='text-center'>
                                                                    <td>Proveedores</td>
                                                                    <td><input type='checkbox' name='pos12' value='PROV' ".(  ( preg_match('/(PROV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos13' value='PROA' ".(  ( preg_match('/(PROA)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos14' value='PROC' ".(  ( preg_match('/(PROC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos15' value='PROM' ".(  ( preg_match('/(PROM)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Entrada Compras</td>
                                                                    <td><input type='checkbox' name='pos16' value='COMPV' ".(  ( preg_match('/(COMPV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos17' value='COMPA' ".(  ( preg_match('/(COMPA)/',$permitions) ) ?  'checked=true' :  '' )." ></td>                                   
                                                                        
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Revision de Entrada Compras</td>
                                                                    <td><input type='checkbox' name='pos18' value='RECV' ".(  ( preg_match('/(RECV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td></td>
                                                                    <td><input type='checkbox' name='pos19' value='RECC' ".(  ( preg_match('/(RECC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                        
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Inventarios</td>
                                                                    <td><input type='checkbox' name='pos20' value='INVV' ".(  ( preg_match('/(INVV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><input type='checkbox' name='pos21' value='INVM' ".(  ( preg_match('/(INVM)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Corte de Caja</td>
                                                                    <td><input type='checkbox' name='pos22' value='CORTV' ".(  ( preg_match('/(CORTV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                        
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Existencias</td>
                                                                    <td><input type='checkbox' name='pos23' value='EXISV' ".(  ( preg_match('/(EXISV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                        
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Reportes Ventas</td>
                                                                    <td><input type='checkbox' name='pos24' value='REPVV' ".(  ( preg_match('/(REPVV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Registro Gastos</td>
                                                                    <td><input type='checkbox' name='pos25' value='GASTV' ".(  ( preg_match('/(GASTV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos26' value='GASTA' ".(  ( preg_match('/(GASTA)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                        
                                                                </tr>
                                                                    
                                                                <tr class='text-center'>
                                                                    <td>Proveedores</td>
                                                                    <td><input type='checkbox' name='pos27' value='PROV' ".(  ( preg_match('/(PROV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos28' value='PROA' ".(  ( preg_match('/(PROA)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos29' value='PROC' ".(  ( preg_match('/(PROC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos30' value='PROM' ".(  ( preg_match('/(PROM)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Editar Gastos</td>
                                                                    <td><input type='checkbox' name='pos31' value='EGASV' ".(  ( preg_match('/(EGASV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td></td>
                                                                    <td><input type='checkbox' name='pos32' value='EGASC' ".(  ( preg_match('/(EGASC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td></td>
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Parametros</td>
                                                                    <td><input type='checkbox' name='pos33' value='PARAV' ".(  ( preg_match('/(PARAV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><input type='checkbox' name='pos34' value='PARAM' ".(  ( preg_match('/(PARAM)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Respaldo</td>
                                                                    <td><input type='checkbox' name='pos35' value='RESV' ".(  ( preg_match('/(RESV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    
                                                                </tr>
                                    
                                                                <tr class='text-center'>
                                                                    <td>Usuarios</td>
                                                                    <td><input type='checkbox' name='pos36' value='USRV' ".(  ( preg_match('/(USRV)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos37' value='USRA' ".(  ( preg_match('/(USRA)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos38' value='USRC' ".(  ( preg_match('/(USRC)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                    <td><input type='checkbox' name='pos39' value='USRM' ".(  ( preg_match('/(USRM)/',$permitions) ) ?  'checked=true' :  '' )." ></td>
                                                                
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        ";
                                                    }
                                                echo"
                                                </div>
                                            </div>

                                            
                                            <div class='btn-group' >
                                        
                                                <button type='button' class='btn btn-success btn-lg' onclick='update_usuario(\"".addslashes(strtoupper($id))."\");' ><i class='fa   fa-pencil'></i> Editar...</button>
                                                                                              
                                            
                                            </div>
                                        </form>
                                        ";        
                                    }
                                }                           
                            
                            ?>
                        </div>
                    </div>               
                </div>
            </div>


        <!-- Your Page Content Here -->
        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->



    <div class="MsjAjaxForm"></div>
 
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>

    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/morris/raphael-min.js"></script>
    <script src="dist/js/source_init.js"></script>
    <script src="dist/js/source_parameters.js"></script>
  
</body>
</html>