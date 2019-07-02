/********************************************************************/
function establece_caja(){
 $.ajax({
          beforeSend: function(){
           },
          url: 'establece_caja.php',
          type: 'POST',
          data: 'caja='+$("#numcaja").val(),
          success: function(x){
            alert("Se establecio el numero de caja en esta sesion...!");
            window.location='parametros.php';
             },
           error: function(jqXHR,estado,error){
             $("#btn-caja").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al establecer el numero de caja, contacte a soporte inmediatamente...!");
           }
           });
}
/********************************************************************/
function establece_datos_empresa(){
    $.ajax({
          beforeSend: function(){
           },
          url: 'estabelece_name_empresa.php',
          type: 'POST',
          data: 'name='+$("#nombre_empresa").val()+'&dom='+$("#dom_empresa").val()+"&clave="+$("#clave_acceso").val(),
          success: function(x){
            alert("Se han establecio los datos empresa correctamente...!");
            window.location='parametros.php';
             },
           error: function(jqXHR,estado,error){
             $("#btn-name").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al establecer los datos de la empresa, contacte a soporte inmediatamente...!");
           }
           });
}
/*****************************************************************************/
function registra_usr(){
  if($("#nombre").val()==""||$("#clave").val()==""||$("#pass").val()==""){
    alert("Debes de completar todos los campos...");
    $("#nombre").focus();
  }else{
    var permitions = getPermitions('tblPermitions');
    $.ajax({
          beforeSend: function(){
           },
          url: 'registra_users.php',
          type: 'POST',
          data: 'nombre='+$("#nombre").val()+'&clave='+$("#clave").val()+'&pass='+$("#pass").val()+"&permisos="+permitions,
          success: function(x){
              if(x!='0'){
                alert("Se registro el usuario correctamente...");
              }
              pone_users_registrados();
             },
           error: function(jqXHR,estado,error){
             $("#btn-reg-usr").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al registrar el usuario, contacte a soporte inmediatamente...!");
           }
           });
           }
}

function getPermitions(location){
  var arrayPermitions ="";
  var tblPermitions = $("#"+location+"> tbody > tr > td");
  tblPermitions.find("input").each(function(){
    if(this.checked){
      arrayPermitions = arrayPermitions +this.getAttribute('value')+"," ; 
    }
    else {
      arrayPermitions = arrayPermitions + ',';
    }        
    //console.log(this.getAttribute("name"));
     
  });

  return arrayPermitions;
}

function allPermitions(location){
  var tblPermitions = $("#"+location+"> tbody > tr > td");
  tblPermitions.find("input").each(function(){
    if(this.checked){
      this.checked = false
    }
    else {
      this.checked = true
    }
    
        
    //console.log(this.getAttribute("name"));
     
  });
 
 
}

function busca_usuario(articulo){
        
  $(document).ready(function() {  
   
   $.ajax({
    beforeSend: function(){
        $("#btn-buscar").prop('disabled', true);
      },
    url: 'busca_usuario.php',
    type: 'POST',
    data: 'nombreUsr='+ $("#nombre_busqueda").val(),
    success: function(x){
        if(x==0){
          alert("El usuario no existe...");
          $("#btn-buscar").prop('disabled', false);
          $("#codigo_busqueda").select();
          $("#codigo_busqueda").focus();
        }else{
        $("#info_usuario").html(x);
        $("#btn-procede-baja").prop('disabled', false);
        $("#btn-cancela-baja").prop("disabled", false);
        }
      },
      error: function(jqXHR,estado,error){
        console.log(error);
      }
    });
  });
}


function elimina_usuario(){
  var n = noty({
    text: "Seguro que desea eliminar el articulo...?",
    theme: 'relax',
    layout: 'center',
    type: 'information',
    buttons     : [
      {addClass: 'btn btn-primary',
        text    : 'Si',
        onClick : function ($noty){
          $noty.close();
          $.ajax({
            beforeSend: function(){  },
            url: 'delete_usuario.php',
            type: 'POST',
            data: 'nombreUsr='+ $("#nombre_busqueda").val(),
            success: function(x){
              console.log(x);
              if(x == 1 ){
                var n = noty({
                  text: "Se ha eliminado el usuario correctamente...!",
                  theme: 'relax',
                  layout: 'center',
                  type: 'information',
                  timeout: 2000,
                });
                cancela_eliminacion();
                pone_users_registrados();
              }
              else{
                var n = noty({
                  text: "Se ha podido eliminar el usuario...!",
                  theme: 'relax',
                  layout: 'center',
                  type: 'information',
                  timeout: 2000,
                });
                cancela_eliminacion();
                pone_users_registrados();
              }
              
            },
            error: function(jqXHR,estado,error){ }
          });
        }
      },
      {addClass: 'btn btn-danger',
        text    : 'No',
        onClick : function ($noty){
          $noty.close();
        }
      }
    ]
  });
}


function editar_usuario(usuario){
         
  $(document).ready(function() {
            
   $.ajax({
   beforeSend: function(){
      $("#btn-buscar").prop('disabled', true);
    },
   url: 'edita_usuario.php',
   type: 'POST',
   data: 'id='+ usuario, //$("#codigo_busqueda").val(),
   success: function(x){
     
       if(x==0){
        alert("El codigo del usuario, no existe...");
         $("#btn-buscar").prop('disabled', false);
         $("#codigo_busqueda").select();
         $("#codigo_busqueda").focus();
       }else{
       $("#edit_user").html(x);
       $("#btn-procede-baja").prop('disabled', false);
       $("#btn-cancela-baja").prop("disabled", false);
       }
    },
    error: function(jqXHR,estado,error){
      console.log(error);
    }
    });
   });
  }
function update_usuario(id){
    var nombre=$("#editaNombre").val();           
    var clave=$("#editaClave").val();
    var password= $("#editaPassword").val() ;
    var permisos = getPermitions('tblEditPermitions');
    var n = noty({
           text: "Seguro que desea efectuar cambios en los datos de usuario...?",
           theme: 'relax',
           layout: 'center',
           type: 'information',
           buttons     : [
             {addClass: 'btn btn-primary',
              text    : 'Si',
              onClick : function ($noty){
                $noty.close();
                $.ajax({
                  beforeSend: function(){
        
                    },
                  url: 'update_usuario.php',
                  type: 'POST',
                  data: 'id='+id+"&nombre="+nombre+"&clave="+clave+"&password="+password+"&permisos="+permisos,
                  success: function(x){
                  
                    if(x == 1){
                      var n = noty({
                        text: "Se ha actualizado la informacion del usuario...!",
                        theme: 'relax',
                        layout: 'center',
                        type: 'information',
                        timeout: 2000,
                      });
                        cancela_update();
                        pone_users_registrados();
                    }
                    else{

                      var n = noty({
                        text: "No se ha podido actualizar la informacion del usuario...!",
                        theme: 'relax',
                        layout: 'center',
                        type: 'information',
                        timeout: 2000,
                      });
                        cancela_update();
                        pone_users_registrados();
                    }
                   
                  },
                  error: function(jqXHR,estado,error){}
                });
               }
            },
            {
              addClass: 'btn btn-danger',
              text    : 'No',
              onClick : function ($noty){
                  $noty.close();

              }
             }
           ]
           });
  }



/************************************************************************************* */
function cancela_eliminacion(){
  $("#info_usuario").empty();
  $("#nombre_busqueda").val('');
  $("#btn-cancela-baja").prop('disabled', true);
  $("#btn-procede-baja").prop('disabled', true);
  $("#btn-buscar").prop('disabled', false);
  $("#codigo_busqueda").focus();
}

function cancela_update(){
  $("#edit_user").empty(); 
}

/***********************************************************************************/
function pone_users_registrados(){
   $.ajax({
          beforeSend: function(){
            $("#users_registrados").html("<img src='dist/img/default.gif'></img>");
           },
          url: 'pone_users_regs.php',
          type: 'POST',
          data: null,
          success: function(x){
             $("#users_registrados").html(x);
             },
           error: function(jqXHR,estado,error){
             $("#users_registrados").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al consultar usuarios registrados, contacte a soporte inmediatamente...!");
           }
           });
}
/*******************************************************************************/

function anular(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}

/*****************************************************************************/