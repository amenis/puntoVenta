
function lista_clientes(){
  $(document).ready(function() {
    $.ajax({
      beforeSend: function(){
        $("#pone_clientes").html("Recuperando proveedores...");
      },
      url: 'lista_clientes.php',
      type: 'POST',
      data: null,
      success: function(x){
       
        $("#lista_clientes").html(x);
        $(".select2").select2();
      },
      error: function(jqXHR,estado,error){
      }
    });
  });
}

function busca_cliente(){
  $(document).ready(function() {
    nombre = $("#nombre_busqueda").val();
    $.ajax({
      beforeSend: function(){
        $("#pone_clientes").html("Recuperando proveedores...");
      },
      url: 'busca_clientes.php',
      type: 'POST',
      data: 'nombre='+ nombre,
      success: function(x){
        if(x==0){
          var n = noty({
            text: "El proveedor a buscar no existe favor de verificar...!",
            theme: 'relax',
            layout: 'center',
            type: 'information',
            timeout: 2000
          });
        }
        else{
          $("#info_Cliente").html(x);
          $("#btn-buscar").prop("disabled",true);
          $("#btn-procede-baja").prop('disabled',false);
          $("#btn-cancela-baja").prop('disabled',false);
          //$(".select2").select2();
        }
       
      },
      error: function(jqXHR,estado,error){
      }
    });
  });
}

/******************************************************************************* */
function elimina_cliente(){
    var n = noty({
      text: "Seguro que desea eliminar al cliente...?",
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
              url: 'delete_cliente.php',
              type: 'POST',
              data: 'nombre='+ $("#nombre_busqueda").val(),
              success: function(x){
               console.log(x);
               
                if(x == 0){
                  var n = noty({
                    text: "El cliente no se ha podido eliminar...!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                  });
                  $("info_cliente").empty();
                }
                else{
                  var n = noty({
                    text: "Se ha eliminado el cliente...!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                  });
                  $("info_cliente").empty();
                  cancela_eliminacion();
                  lista_clientes();
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


function update_cliente(proveedor){

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
      text: "Seguro que desea actualizar al cliente...?",
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
              url: 'update_cliente.php',
              type: 'POST',
              data: 'id='+id+'&nombre='+ nombre+'&telefono='+telefono+'&domicilio='+domicilio+'&ciudad='+ciudad,
              success: function(x){
               console.log(x);
                if(x == 0){
                  var n = noty({
                    text: "El Cliente no se ha podido actualizar...!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                  });
                 
                }
                else{
                  var n = noty({
                    text: "Se ha actualizado el clientecorrectamente...!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                  });
                  $("info_proveedor").empty();
                  cancela_eliminacion();
                  $("edit_clientes").empty();
                  lista_clientes();
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


function alta_cliente(){
  
  var nombreCliente = $("#nombreCliente").val();
  var telefono = $("#telefono").val();
  var domicilio = $("#domicilio").val();
  var ciudad = $("#ciudad").val();
  var notify;
  $.ajax({
    url: "save_cliente.php",
    type: 'POST',
    data: 'nombre='+nombreCliente+'&telefono='+telefono+'&domicilio='+domicilio+'&ciudad='+ciudad,
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
        lista_clientes();
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

/******************************************************************************* */


function editar_cliente(id) {
  $(document).ready(function() {
                    
    $.ajax({
      beforeSend: function(){
        $("#btn-buscar").prop('disabled', true);
      },
      url: 'editar_cliente.php',
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
            $("#edit_clientes").html(x);
          }
      },
      error: function(jqXHR,estado,error){
        console.log("err ",error);
      }
    });
  });

}

/************************************************************************************** */

function cancela_update(){
  //$("#tabla_proveedores").empty();
  $("#edit_clientes").empty();
}


function cancela_eliminacion(){
  $("#nombre_busqueda").val("");
  $("#info_Cliente").empty();
  $("#btn-procede-baja").prop('disabled', true);
  $("#btn-cancela-baja").prop("disabled", true);
  $("#btn-buscar").prop("disabled", false);

}


function cancela_alta() {
  $("#nombreProveedor").val("");
  $("#telefono").val("");
  $("#domicilio").val("");
  $("#ciudad").val("");
}



/************************************************************************************** */
function anular(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}