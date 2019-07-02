<section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nombre_de_usuario'] ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
            </div>
          </div>

          <!-- search form (Optional)
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
              <?
              if(preg_match('/(VTSV)/',$_SESSION['permisos'])){
              ?>
              <a href="#"><i class="fa fa-money"></i> <span>Ventas.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?
                if(preg_match('/(VTSA)/',$_SESSION['permisos'])){
                ?>
                <li><a href="punto_venta.php"><i class="fa fa-object-group"></i> Punto de Venta.</a></li>
                <?
                }
                if(preg_match('/(VTSC)/',$_SESSION['permisos'])){
                ?>
                <li><a href="cancel_venta.php"><i class="fa fa-times"></i> Cancelacion de Ventas.</a></li>
              </ul>
            </li>
            <?
                }
              }
            ?>
            <li class="treeview">
              <?if(preg_match('/(CITAV)/',$_SESSION['permisos'])){?>
              <a href="#"> <i class="	fa fa-calendar"></i> <span>Citas</span>  <i class="fa fa-angle-left pull-right"></i></a>
              <ul  class="treeview-menu" >
                <li><a href="citas.php"><i class="fa fa-object-group"></i> Agendar Citas.</a></li>
              </ul>
              <?
              }
              ?>
            </li>
            <!--
            <li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>Cartera Clientes.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="cartera_clientes.php"><i class="fa fa-user"></i> Consulta y Abonos.</a></li>
              </ul>
            </li>
            -->
            <li class="treeview">
              <a href="#"><i class="fa fa-server"></i> <span>Mtto. de Archivos.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?
                if(preg_match('/(ARTV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="abc_articulos.php"><i class="fa fa-cubes"></i> Articulos.</a></li>
                <?
                }
                if(preg_match('/(LINV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="abc_lineas.php"><i class="fa fa-bars"></i> Lineas.</a></li>
                <?
                }
                if(preg_match('/(PROV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="abc_provs2.php"><i class="fa fa-truck"></i> Proveedores.</a></li>
                <?
                }
                ?>
                <!--<li><a href="abc_clients.php"><i class="fa fa-male"></i> Clientes.</a></li>-->
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-home"></i> <span>Almacen.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?
                if(preg_match('/(COMPV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="entrada_compra.php"><i class="fa fa-download"></i> Entradas X Compra.</a></li>
                <?
                }
                if(preg_match('/(RECV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="rev_entrada.php"><i class="fa fa-search"></i> Revision de Entradas x Compra.</a></li>
                <?
                }
                if(preg_match('/(INVV)/',$_SESSION['permisos'])){
                ?>
                <!--<li><a href="valida_cambio.php?opt=1265780909"><i class="fa fa-sort-numeric-asc"></i> Ajustes de Inventario.</a></li>-->
                <li><a href="aju_inventarios.php"><i class="fa fa-sort-numeric-asc"></i> Ajustes de Inventario.</a></li>
                <?
                }
                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-edit"></i> <span>Reportes.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?
                if(preg_match('/(CORTV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="rep_ventas.php"><i class="fa fa-newspaper-o"></i> Corte de Cajas.</a></li>
                <?
                }
                if(preg_match('/(EXISV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="rep_existe.php"><i class="fa fa-file-text"></i> Reporte de Existencias.</a></li>
                <?
                }
                if(preg_match('/(REPVV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="rep_ventas_s.php"><i class="fa fa-list-alt"></i> Reporte de Ventas.</a></li>
                <?
                }
                ?>
                <!--<li><a href="Pro_Caducar.php"><i class=" fa fa-file-text"></i> Articulos por Vencer.</a></li>-->
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-calendar-minus-o"></i> <span>Gastos.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?
                if(preg_match('/(EGASV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="reg_egresos.php"><i class="fa fa-calendar-plus-o"></i> Registro de Gastos.</a></li>
                <?
                }
                if(preg_match('/(EGASC)/',$_SESSION['permisos'])){
                ?>
                <li><a href="rep_gastos.php"><i class="fa fa-code-fork"></i> Vis./Edi. Gastos</a></li>
                <?
                }
                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-terminal"></i> <span>Utilerias.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?
                if(preg_match('/(PARAV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="parametros.php"><i class="fa fa-map-o"></i> Parametros de Aplicacion.</a></li>
                <?
                }
                if(preg_match('/(RESV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="util_backup.php"><i class="fa fa-folder-open"></i> Respaldo de BD.</a></li>
                <?
                }
                if(preg_match('/(USRV)/',$_SESSION['permisos'])){
                ?>
                <li><a href="util_usr.php"><i class="fa fa-user"></i> Usuarios.</a></li>
                <?
                }
                ?>
              </ul>
            </li>

          </ul><!-- /.sidebar-menu -->
        </section>
