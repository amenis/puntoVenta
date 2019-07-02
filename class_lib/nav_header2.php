<a href="inicio.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b></b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b></b></span>
</a>
<?php
   error_reporting(0);
   $fp = fopen("contador.txt","r"); // Abrimos el fichero donde guardaremos y leeremos las visitas
   $visitas = intval(fgets($fp)); // Leemos las visitas y usamos intval para asegurarnos de que devuelve un entero
?>
<nav class="navbar navbar-inverse">
 
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="dist/img/avatar.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $_SESSION['nombre_de_usuario']; ?></span>
            </a>
            <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                    <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
                    <p>
                        Usuario: <?php echo $_SESSION['nombre_de_usuario']; ?>
                        <!--<small>Member since Nov. 2012</small>-->
                    </p>
                </li>
                <!-- Menu Footer-->
               <li class="user-footer">
                 <a href="#!" class="btn btn-info btn-block"><i class='fa fa-user'></i> Perfil</a>
                <a href="endsession.php" class="btn btn-danger btn-block btn-exit-system"><i class='fa fa-power-off'></i> Salir</a>
                </li>
            </ul>
        </li>
             
    </ul>
  </div>
</nav>