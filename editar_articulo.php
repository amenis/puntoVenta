<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$codigo=test_input($_POST['codigo']);

$cadena="Select * from articulos where codigo='$codigo'";
$exec=$db->consulta($cadena);
if($db->numero_de_registros($exec)>0){
  while($r=$db->buscar_array($exec)){
    $id = $r['id'];
    $desc=$r['descripcion'];
    $stock=$r['codigo'];
    $costo=$r['costo'];
    $precio=$r['precio'];
    $proveedor=$r['proveedor'];
    $linea = $r['linea'];

    echo "<div class='form-group'>";
    echo "   <label for='' class='col-sm-2 control-label'>Codigo:</label>";
    echo "   <div class='col-sm-3'>";
    echo "   <input type='text' class='form-control' id='Editcodigo' placeholder='Codigo de Stock...' value='$stock' >";
    echo "   </div>";
    echo "   </div>";

   echo "<div class='form-group'>";
   echo "   <label for='' class='col-sm-2 control-label'>Descripcion:</label>";
   echo "   <div class='col-sm-6'>";
   echo "   <input type='text' class='form-control' id='Editdescripcion' placeholder='Descripcion del articulo...' value='$desc' >";
   echo "   </div>";
   echo "   </div>";
/*
   echo "<div class='form-group'>";
   echo "   <label for='' class='col-sm-2 control-label'>Codigo de Stock:</label>";
   echo "   <div class='col-sm-3'>";
   echo "   <input type='text' class='form-control' id='' placeholder='Codigo de Stock...' value='$stock' >";
   echo "   </div>";
   echo "   </div>";
*/
   echo "<div class='form-group'>";
   echo "   <label for='' class='col-sm-2 control-label'>Costo:</label>";
   echo "   <div class='col-sm-2'>";
   echo "   <input type='text' class='form-control' id='Editcostos' placeholder='Costo...' value='$costo' >";
   echo "   </div>";
   echo "   </div>";

   echo "<div class='form-group'>";
   echo "   <label for='' class='col-sm-2 control-label'>Precio:</label>";
   echo "   <div class='col-sm-2'>";
   echo "   <input type='text' class='form-control' id='Editprecio' placeholder='Precio...' value='$precio' >";
   echo "   </div>";
   echo "   </div>";

    $proveeconsult = "select * from proveedores order by id";
    $busca_prov=$db->consulta($proveeconsult);
    echo "
    <div class='form-group'>
        <label for='proveedor' class='col-sm-2 control-label'>Proveedor:</label>
        <div class='col-sm-4'>
            <select class='form-control select2' id='Editproveedor'>
                <option value='' >Seleccione..</option>";
                while($t=$db->buscar_array($busca_prov)){
                     $disabled = $t['id'] == $proveedor ? 'selected' : '' ;
                    echo "<option value=$t[id]  $disabled >$t[id] - $t[nombre]</option>";
                }
        echo "
            </select>
        </div>
    </div>";
    echo "
    <div class='form-group'>
        <label for='linea' class='col-sm-2 control-label'>Linea:</label>
        <div class='col-sm-4'>
        <div>
            <select id='Editlinea' class='form-control select2'>
            <option value='' >Seleccione...</option>
    ";
            
                $selectLinea=$db->consulta("SELECT * FROM lineas");
                while($rowLineas=mysqli_fetch_array($selectLinea)){
                    $selected = $rowLineas['linea'] == $linea ? "selected" : "";
                    echo '<option value="'.$rowLineas['linea'].'"  '.$selected.' >'.$rowLineas['descripcion'].'</option>';
                }           
    echo "
            </select>
        </div>
        </div>
    </div> 
    "; 
    
/*
  $busca_linea=$db->consulta("Select descripcion from lineas where linea=$r[linea] ");
      while($t=$db->buscar_array($busca_linea)){
       $linea=$t['descripcion'];
       echo "<div class='form-group'>";
       echo "   <label for='' class='col-sm-2 control-label'>Linea:</label>";
       echo "   <div class='col-sm-4'>";
       echo "   <input type='text' class='form-control' id='' placeholder='Linea...' value='$linea' >";
       echo "   </div>";
       echo "   </div>";
      }

  $busca_grupo=$db->consulta("Select descripcion from lineas where linea=$r[linea] and grupo=$r[grupo]");
      while($z=$db->buscar_array($busca_grupo)){
       $grupo=$z['descripcion'];
       echo "<div class='form-group'>";
       echo "   <label for='' class='col-sm-2 control-label'>Grupo:</label>";
       echo "   <div class='col-sm-4'>";
       echo "   <input type='text' class='form-control' id='' placeholder='Grupo...' value='$grupo' >";
       echo "   </div>";
       echo "   </div>";
      }
*/
/*      echo "<div class='form-group'>";
       echo "   <label for='' class='col-sm-2 control-label'>Imagen:</label>";
       echo "   <div class='col-sm-4'>";
       if($r['imagen']==""){
         echo "No hay imagen asociada...";
       }else{
         $src='img_articulos/'.$r['imagen'];
         echo "<img alt='150x150' src='$src'  height='250' width='300'/>";
       }
       echo "   </div>";
       echo "   </div>";
       */
       echo  "
       <button type='button' class='btn btn-success btn-lg' onclick='update_articulo(\"".addslashes(strtoupper($id))."\");' ><i class='fa   fa-pencil'></i> Editar...</button>
       <button type='button' class='btn btn-danger btn-lg' onclick='cancela_update();' ><i class='fa  fa-recycle'></i> Cancelar...</button>
       ";
   }
}else{
  echo 0;
}
?>

