var eventos = [];
var date = new Date();
var yyyy = date.getFullYear().toString();
var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    

$('#calendar').fullCalendar({
    header: {
        language: 'es',
        left: 'prev,next today',
        center: 'title',
        right:'month,agendaWeek,agendaDay',
    },
    defaultDate: yyyy+"-"+mm+"-"+dd,
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    selectable: true,
    selectHelper: true,
    select: function(start, end) {
        
        $('#ModalAdd #start').val(moment(start).format("YYYY-MM-DD[T]HH:mm"));
        $('#ModalAdd #end').val(moment(start).format("YYYY-MM-DD[T]HH:mm"));
        $('#ModalAdd').modal('show');
    },
    eventRender: function(event, element) {
        
        
        element.bind('dblclick', function() {
            $('#ModalEdit #Editid').val(event.id);
            $('#ModalEdit #Editnombre').val(event.title);
            $('#ModalEdit #Edittelefono').val(event.phone);
            $('#ModalEdit #Editstart').val(event.start.format("YYYY-MM-DD[T]HH:mm"));
            $('#ModalEdit #Editend').val(event.end.format("YYYY-MM-DD[T]HH:mm"));
            $('#ModalEdit').modal('show');
        });
    },
    eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

    },
    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

        edit(event);

    },
    events: function(start, end, timezone, callback) {
                       
        //craft and make the request
        $.ajax({
            url: "listaCitas.php",
            type: "GET",
            dataType: 'json',
            cache: false
            }).done(function(data) {
            //on success call `callback` with the data
            callback(data)
        })
    },
});

function limpiarCampos(){
    //Modal Add
    var title = document.getElementById("nombre").value="";
    var phoneNumber = document.getElementById("telefono").value="";
    var timeStart = document.getElementById("start").value="";
    var timeEnd = document.getElementById("end").value="";
    
    //modal Edit
    var id = document.getElementById("Editid").value="";
    var title = document.getElementById("Editnombre").value="";
    var phoneNumber = document.getElementById("Edittelefono").value="";
    var timeStart = document.getElementById("Editstart").value="";
    var timeEnd = document.getElementById("Editend").value="";
}


function editaEvento(){
    var xhr = new  XMLHttpRequest();

    var id = document.getElementById("Editid").value;
    var title = document.getElementById("Editnombre").value;
    var phoneNumber = document.getElementById("Edittelefono").value;
    var timeStart = document.getElementById("Editstart").value;
    var timeEnd = document.getElementById("Editend").value;

    var n = noty({
        text: "Seguro que desea Editar la cita...?",
        theme: 'relax',
        layout: 'center',
        type: 'information',
        buttons     : [
            {addClass: 'btn btn-primary',
                text    : 'Si',
                onClick : function ($noty){ 
                    $noty.close();
                    xhr.open('POST','editEventData.php',true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onload = function(){
                        if(xhr.status === 200 ){
                            
                            console.log(xhr.response);
                            if(xhr.response == 1){
                                n = noty({
                                    text: "Evento Editado Correctamente..!",
                                    theme: 'relax',
                                    layout: 'center',
                                    type: 'information',
                                    timeout: 2000,
                                });
                                limpiarCampos();
                                $('#calendar').fullCalendar( 'refetchEvents' );
                            }
                            else if (xhr.response == 0) {
                                n = noty({
                                    text: "Evento no se ha editado correctamente..!",
                                    theme: 'relax',
                                    layout: 'center',
                                    type: 'information',
                                    timeout: 2000,
                                });
                            }
                        }
                    }
                    xhr.onerror = function(){
                        var n = noty({
                                text: "Se ha detectado un error favor de llamar al administrador..!",
                                theme: 'relax',
                                layout: 'center',
                                type: 'information',
                                timeout: 2000,
                            });
                    }

                    xhr.send("id="+id+"&title="+title+"&phone="+phoneNumber+"&timeStart="+timeStart+"&timeEnd="+timeEnd);
                }
            },
            {addClass: 'btn btn-primary',
                text    : 'No',
                onClick : function ($noty){ 
                    $noty.close();
                }   
            }
        ]
    });

}

function guardarEvento(){

    var title = document.getElementById("nombre").value;
    var phoneNumber = document.getElementById("telefono").value;
    var timeStart = document.getElementById("start").value;
    var timeEnd = document.getElementById("end").value;

    var xhr = new  XMLHttpRequest();
    xhr.open('POST','newEvent.php',true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function(){
        if(xhr.status === 200 ){
            
            limpiarCampos();

            if(xhr.response == 1){
                n = noty({
                    text: "Evento Guardado Correctamente..!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                });
                $('#calendar').fullCalendar( 'refetchEvents' );
            }
            else if (xhr.response == 0) {
                n = noty({
                    text: "Evento no se ha generado correctamente..!",
                    theme: 'relax',
                    layout: 'center',
                    type: 'information',
                    timeout: 2000,
                });
            }
            
        }
    }
    xhr.onerror = function(){
        var n = noty({
                text: "Se ha detectado un error favor de llamar al administrador..!",
                theme: 'relax',
                layout: 'center',
                type: 'information',
                timeout: 2000,
            });
    }

    xhr.send("title="+title+"&phone="+phoneNumber+"&timeStart="+timeStart+"&timeEnd="+timeEnd);
}

function edit(event){
    start = event.start.format('YYYY-MM-DD[T]HH:mm:ss');
    if(event.end){
        end = event.end.format('YYYY-MM-DD[T]HH:mm:ss');
    }else{
        end = start;
    }
    
    id =  event.id;
    
    Event = [];
    Event[0] = id;
    Event[1] = start;
    Event[2] = end;
    
    var xhr = new  XMLHttpRequest();

    var n = noty({
        text: "Seguro que desea Editar la cita...?",
        theme: 'relax',
        layout: 'center',
        type: 'information',
        buttons     : [
            {addClass: 'btn btn-primary',
                text    : 'Si',
                onClick : function ($noty){ 
                    $noty.close();
                    xhr.open('POST','editEventDate.php',true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onload = function(){
                        if(xhr.status === 200 ){
                            
                            if(xhr.response == 1){
                                n = noty({
                                    text: "Evento Editado Correctamente..!",
                                    theme: 'relax',
                                    layout: 'center',
                                    type: 'information',
                                    timeout: 2000,
                                });
                                $('#calendar').fullCalendar( 'refetchEvents' );
                            }
                            else if (xhr.response == 0) {
                                n = noty({
                                    text: "Evento no se ha generado correctamente..!",
                                    theme: 'relax',
                                    layout: 'center',
                                    type: 'information',
                                    timeout: 2000,
                                });
                            }
                            
                        }
                    }
                    xhr.onerror = function(){
                        var n = noty({
                                text: "Se ha detectado un error favor de llamar al administrador..!",
                                theme: 'relax',
                                layout: 'center',
                                type: 'information',
                                timeout: 2000,
                            });
                    }

                    xhr.send("id="+Event[0]+"&timeStart="+Event[1]+"&timeEnd="+Event[2]);
                }
            },
            { addClass: 'btn btn-primary',
                text    : 'No',
                onClick : function ($noty){ 
                    $noty.close();
                }
            }
        ]
    });

}

function cancelarEvento(){

    var xhr = new  XMLHttpRequest();
    var id = document.getElementById('Editid').value;
    
    var n = noty({
        text: "Seguro que desea cancelar la cita...?",
        theme: 'relax',
        layout: 'center',
        type: 'information',
        buttons     : [
          {addClass: 'btn btn-primary',
           text    : 'Si',
           onClick : function ($noty){  
                $noty.close();
                xhr.open('POST','cancelEventDate.php',true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function(){
                    if(xhr.status === 200 ){
                                           
                        if(xhr.response == 1){
                            n = noty({
                                text: "Evento Cancelado Correctamente..!",
                                theme: 'relax',
                                layout: 'center',
                                type: 'information',
                                timeout: 2000,
                            });
                            $('#calendar').fullCalendar( 'refetchEvents' );
                        }
                        else if (xhr.response == 0) {
                            n = noty({
                                text: "Evento no se ha podido cancelar correctamente..!",
                                theme: 'relax',
                                layout: 'center',
                                type: 'information',
                                timeout: 2000,
                            });
                        }
                        
                    }
                }
                xhr.onerror = function(){
                    var n = noty({
                            text: "Se ha detectado un error favor de llamar al administrador..!",
                            theme: 'relax',
                            layout: 'center',
                            type: 'information',
                            timeout: 2000,
                        });
                }

                xhr.send("id="+id);
             
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
