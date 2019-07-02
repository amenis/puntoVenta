<?php

session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$id=test_input(strtoupper($_POST['id']));

$consulta = $db->consulta("SELECT * FROM usuarios WHERE id='$id' ");

if($db->numero_de_registros($consulta)>0){
    while ($r = $db->buscar_array($consulta)) {
        $permitions = $r['permisos'];
        if($r['editable'] == "si"){
          
            echo "
    
            <div class='form-group'>
                <label for='codigo' class='col-sm-2 control-label'>Nombre completo:</label>
                <div class='col-sm-5'>
                    <input type='text' class='form-control' id='editaNombre' value=".$r['nombre']."  >
                </div>
            </div>
        
            <div class='form-group'>
                <label for='codigo' class='col-sm-2 control-label'>Usuario:</label>
                <div class='col-sm-3'>
                    <input type='text' class='form-control' id='editaClave' value=".$r['clave']."  >
                </div>
            </div>
        
            <div class='form-group'>
                <label for='codigo' class='col-sm-2 control-label'>Password:</label>
                <div class='col-sm-3'>
                    <input type='password' class='form-control' id='editaPassword'  value=".$r['password']."  >
                </div>
            </div>

            <div class='form-group'>
                <label for='codigo' class='col-sm-2 control-label'>Permisos:</label>
                <div class='col-sm-7'>
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
                </div>
            </div>

            <div class='btn-group' >
           
                <button type='button' class='btn btn-success btn-lg' onclick='update_usuario(\"".addslashes(strtoupper($id))."\");' ><i class='fa   fa-pencil'></i> Editar...</button>
                <button type='button' class='btn btn-danger btn-lg' onclick='cancela_update();' ><i class='fa  fa-recycle'></i> Cancelar...</button>
                
            
            </div>
        
            ";

        }
        else{

            echo "
    
            <div class='form-group'>
                <label for='codigo' class='col-sm-2 control-label'>Nombre completo:</label>
                <div class='col-sm-5'>
                    <input type='text' class='form-control' id='editaNombre' value=".$r['nombre']." placeholder='Nombre del usuario...' disabled>
                </div>
            </div>
        
            <div class='form-group'>
                <label for='codigo' class='col-sm-2 control-label'>Usuario:</label>
                <div class='col-sm-3'>
                    <input type='text' class='form-control' id='editaClave' value=".$r['clave']." placeholder='Clave del usuario...' disabled>
                </div>
            </div>
        
            <div class='form-group'>
                <label for='codigo' class='col-sm-2 control-label'>Password:</label>
                <div class='col-sm-3'>
                    <input type='password' class='form-control' id='editaPassword' value=".$r['password']." placeholder='Password del usuario...' disabled >
                </div>
            </div>
             
            <div class='form-group'>
                <label for='codigo' class='col-sm-2 control-label'>Permisos:</label>
                <div class='col-sm-7'>
                    
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
                                <td><input type='checkbox' name='pos1' value='VTSV' ".(  ( preg_match('/(VTSV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos2' value='VTSA' ".(  ( preg_match('/(VTSA)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos3' value='VTSC' ".(  ( preg_match('/(VTSC)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                    
                            </tr>
                            <tr class='text-center'>
                                <td>Citas</td>
                                <td><input type='checkbox' name='pos40' value='CITAV' ".(  ( preg_match('/(CITAV)/',$permitions) ) ?  'checked=true' :  '' )." disabled></td>
                                <td><input type='checkbox' name='pos41' value='CITAA' ".(  ( preg_match('/(CITAA)/',$permitions) ) ?  'checked=true' :  '' )." disabled></td>
                                <td><input type='checkbox' name='pos42' value='CITAC' ".(  ( preg_match('/(CITAC)/',$permitions) ) ?  'checked=true' :  '' )." disabled></td>
                                <td><input type='checkbox' name='pos43' value='CITAM' ".(  ( preg_match('/(CITAM)/',$permitions) ) ?  'checked=true' :  '' )." disabled></td>
                            </tr>
                            <tr class='text-center'>
                                <td>Articulos</td>
                                <td><input type='checkbox' name='pos4' value='ARTV' ".(  ( preg_match('/(ARTV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos5' value='ARTA' ".(  ( preg_match('/(ARTA)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos6' value='ARTC' ".(  ( preg_match('/(ARTC)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos7' value='ARTM' ".(  ( preg_match('/(ARTM)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                            </tr>
                            <tr class='text-center'>
                                <td>lineas</td>
                                <td><input type='checkbox' name='pos8' value='LINV' ".(  ( preg_match('/(LINV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos9' value='LINA' ".(  ( preg_match('/(LINA)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos10' value='LINC' ".( ( preg_match('/(LINC)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos11' value='LINM' ".( ( preg_match('/(LINM)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                            </tr>
                            <tr class='text-center'>
                                <td>Proveedores</td>
                                <td><input type='checkbox' name='pos12' value='PROV' ".(  ( preg_match('/(PROV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos13' value='PROA' ".(  ( preg_match('/(PROA)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos14' value='PROC' ".(  ( preg_match('/(PROC)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos15' value='PROM' ".(  ( preg_match('/(PROM)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                            </tr>

                            <tr class='text-center'>
                                <td>Entrada Compras</td>
                                <td><input type='checkbox' name='pos16' value='COMPV' ".(  ( preg_match('/(COMPV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos17' value='COMPA' ".(  ( preg_match('/(COMPA)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>                                   
                                    
                            </tr>

                            <tr class='text-center'>
                                <td>Revision de Entrada Compras</td>
                                <td><input type='checkbox' name='pos18' value='RECV' ".(  ( preg_match('/(RECV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td></td>
                                <td><input type='checkbox' name='pos19' value='RECC' ".(  ( preg_match('/(RECC)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                    
                            </tr>

                            <tr class='text-center'>
                                <td>Inventarios</td>
                                <td><input type='checkbox' name='pos20' value='INVV' ".(  ( preg_match('/(INVV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td></td>
                                <td></td>
                                <td><input type='checkbox' name='pos21' value='INVM' ".(  ( preg_match('/(INVM)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                            </tr>

                            <tr class='text-center'>
                                <td>Corte de Caja</td>
                                <td><input type='checkbox' name='pos22' value='CORTV' ".(  ( preg_match('/(CORTV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                    
                            </tr>

                            <tr class='text-center'>
                                <td>Existencias</td>
                                <td><input type='checkbox' name='pos23' value='EXISV' ".(  ( preg_match('/(EXISV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                    
                            </tr>

                            <tr class='text-center'>
                                <td>Reportes Ventas</td>
                                <td><input type='checkbox' name='pos24' value='REPVV' ".(  ( preg_match('/(REPVV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                   
                            </tr>

                            <tr class='text-center'>
                                <td>Registro Gastos</td>
                                <td><input type='checkbox' name='pos25' value='GASTV' ".(  ( preg_match('/(GASTV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos26' value='GASTA' ".(  ( preg_match('/(GASTA)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                    
                            </tr>
                                 
                            <tr class='text-center'>
                                <td>Proveedores</td>
                                <td><input type='checkbox' name='pos27' value='PROV' ".(  ( preg_match('/(PROV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos28' value='PROA' ".(  ( preg_match('/(PROA)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos29' value='PROC' ".(  ( preg_match('/(PROC)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos30' value='PROM' ".(  ( preg_match('/(PROM)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                            </tr>

                            <tr class='text-center'>
                                <td>Editar Gastos</td>
                                <td><input type='checkbox' name='pos31' value='EGASV' ".(  ( preg_match('/(EGASV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td></td>
                                <td><input type='checkbox' name='pos32' value='EGASC' ".(  ( preg_match('/(EGASC)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td></td>
                            </tr>

                            <tr class='text-center'>
                                <td>Parametros</td>
                                <td><input type='checkbox' name='pos33' value='PARAV' ".(  ( preg_match('/(PARAV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td></td>
                                <td></td>
                                <td><input type='checkbox' name='pos34' value='PARAM' ".(  ( preg_match('/(PARAM)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                            </tr>

                            <tr class='text-center'>
                                <td>Respaldo</td>
                                <td><input type='checkbox' name='pos35' value='RESV' ".(  ( preg_match('/(RESV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                  
                            </tr>

                            <tr class='text-center'>
                                <td>Usuarios</td>
                                <td><input type='checkbox' name='pos36' value='USRV' ".(  ( preg_match('/(USRV)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos37' value='USRA' ".(  ( preg_match('/(USRA)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos38' value='USRC' ".(  ( preg_match('/(USRC)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                                <td><input type='checkbox' name='pos39' value='USRM' ".(  ( preg_match('/(USRM)/',$permitions) ) ?  'checked=true' :  '' )." disabled ></td>
                            
                            </tr>

                        </tbody>
                    </table>
                </div>               
            </div>
            <div class='btn-group' >               
                <button type='button' class='btn btn-danger btn-lg' onclick='cancela_update();' ><i class='fa  fa-recycle'></i> Cancelar...</button>
            </div>

            ";

        }
       
    }
}
else{
    echo "0";
}

?>