
function editar_provee(id) {
  $(document).ready(function() {
                    
    $.ajax({
      beforeSend: function(){
        $("#btn-buscar").prop('disabled', true);
      },
      url: 'editar_prove.php',
      type: 'POST',
      data: 'id='+ id, //$("#codigo_busqueda").val(),
      success: function(x){
          if(x==0){
            var n = noty({
              text: "Ah ocurrido un error al buscar al proveedor...!",
              theme: 'relax',
              layout: 'center',
              type: 'information',
              timeout: 2000
            });
          }
          else{
            $("#edit_proveedores").html(x);
          }
      },
      error: function(jqXHR,estado,error){
        console.log(error);
      }
    });
  });

}


function busca_provedor(){
        
  $(document).ready(function() {
    
    $.ajax({
      beforeSend: function(){
        $("#btn-buscar").prop('disabled', true);
      },
      url: 'busca_proveedores.php',
      type: 'POST',
      data: 'nombre='+ $("#nombre_busqueda").val(),
      success: function(x){
        if(x==0){
          alert("El proveedor  no existe, favor de verificar...");
          $("#btn-buscar").prop('disabled', false);
          $("#nombre_busqueda").select();
          $("#nombre_busqueda").focus();
        }else{
          $("#info_proveedor").html(x);
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
/*******************************************************************************************/
function elimina_proveedor(){
  if($("#nombre_busqueda").val()  == "sin proveedor"){
    var n = noty({
      text: "No es posible eliminar el proveedor seleccionado...!",
      theme: 'relax',
      layout: 'center',
      type: 'information',
      timeout: 2000
    });
    $("info_proveedor").empty();
  }
  else{
    var n = noty({
      text: "Seguro que desea eliminar al proveedor...?",
      theme: 'relax',
      layout: 'center',
      type: 'information',
      buttons: [
        {addClass: 'btn btn-primary',
         text    : 'Si',
         onClick : function ($noty){
            $noty.close();
            $.ajax({
              beforeSend: function(){},
              url: 'delete_provee.php',
              type: 'POST',
              data: 'nombre='+ $("#nombre_busqueda").val(),
              success: function(x){
               
                if(x == 0){
                  var n = noty({
                    text: "El proveedor no se ha podido eliminar...!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                  });
                  $("info_proveedor").empty();
                }
                else{
                  var n = noty({
                    text: "Se ha eliminado el proveedor...!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                  });
                  $("info_proveedor").empty();
                  cancela_eliminacion();
                  lista_proveedores();
                }
              
              },
              error: function(jqXHR,estado,error){}
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
    
}

/********************************************************************************************************** */
function update_proveedor(proveedor){

  var nombre = $("#editaNombre").val();
  var telefono = $("#editaTelefono").val();
  var domicilio = $("#editaDomicilio").val();
  var ciudad = $("#editaCiudad").val();
  var id = proveedor
  console.log(id);

  if(nombre  == "sin proveedor"){
    var n = noty({
      text: "El proveedor seleccionado esta establecido por default y no es posible realizarle cambios...!",
      theme: 'relax',
      layout: 'center',
      type: 'information',
      timeout: 2000
    });
    $("info_proveedor").empty();
  }
  else{
    var n = noty({
      text: "Seguro que desea actualizar al proveedor...?",
      theme: 'relax',
      layout: 'center',
      type: 'information',
      buttons: [
        {addClass: 'btn btn-primary',
         text    : 'Si',
         onClick : function ($noty){
            $noty.close();
            $.ajax({
              beforeSend: function(){},
              url: 'update_proveedores.php',
              type: 'POST',
              data: 'id='+id+'&nombre='+ nombre+'&telefono='+telefono+'&domicilio='+domicilio+'&ciudad='+ciudad,
              success: function(x){
               console.log(x);
                if(x == 0){
                  var n = noty({
                    text: "El proveedor no se ha podido actualizar...!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                  });
                  $("info_proveedor").empty();
                }
                else{
                  var n = noty({
                    text: "Se ha actualizado el proveedor correctamente...!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                  });
                  $("info_proveedor").empty();
                  cancela_eliminacion();
                  lista_proveedores();
                }
              
              },
              error: function(jqXHR,estado,error){}
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

}

/*********************************************************************************************************** */
function alta_proveedor(){
  
  var nombreProveedores = $("#nombreProveedor").val();
  var telefono = $("#telefono").val();
  var domicilio = $("#domicilio").val();
  var ciudad = $("#ciudad").val();
  var notify;
  $.ajax({
    url: "save_prove.php",
    type: 'POST',
    data: 'nombre='+nombreProveedores+'&telefono='+telefono+'&domicilio='+domicilio+'&ciudad='+ciudad,
    success:function(res){
      console.log(res);
      if(res == "3"){
        notify = noty({
          text: "No ha podido registrar el proveedor ó el proveedor ya existe...!",
          theme: 'relax',
          layout: 'center',
          type: 'information',
          timeout: 2000
        });
        cancela_alta();
      }
      if(res == "1"){
        lista_proveedores();
        notify = noty({
          text: "Se registro el proveedor correctamente",
          theme: "relax",
          layout: "center",
          type: "information",
          timeout: 3000
        });
        cancela_alta();
      }

    },
    error:function(jqXHR,estado,error){
      notify = noty({
        text: "Ocurrio un error al registrar el proveedor, consulte a Soporte...!",
        theme: 'relax',
        layout: 'center',
        type: 'information',
        });
    }
  });

 
}

        
/**********************************************************************/
function lista_proveedores(){
    
  $(document).ready(function(){

      $.ajax({
          beforeSend: function(){
            $("#lista_proveedores").html('<b>Actualizando lista de proveedores...</b>');
          },
          url: 'lista_prove.php',
          type: 'POST',
          data: null,
          success: function(x){
               
            $("#lista_proveedores").html(x);
            $("#tabla_proveedores").dataTable();
          },
          error: function(jqXHR,estado,error){
          }
        });
      
  });

}
/********************************************************************************* */
function anular(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}

function cancela_update(){
  //$("#tabla_proveedores").empty();
  $("#edit_proveedores").empty();
}

function cancela_eliminacion(){
  $("#nombre_busqueda").val("");
  $("#info_proveedor").empty();
  $("#btn-procede-baja").prop('disabled', true);
  $("#btn-cancela-baja").prop("disabled", true);
  $("#btn-buscar").prop("disabled", false);

}

function cancela_alta(){
  $("#nombreProveedor").val("");
  $("#telefono").val("");
  $("#domicilio").val("");
  $("#ciudad").val("");
}
