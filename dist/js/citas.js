

var today=new Date();

function getData(dateIn){
  
    return new Promise(function(resolve, reject) {
        
        var request = new XMLHttpRequest();
        request.open('GET', 'listaCitas.php?fecha=" '+dateIn+' " ');
        //request.responseType = 'json';
       
        request.onload = function() {
          if (request.status === 200) {
         
            resolve(request.response);
          } else {
         
            reject(Error('data didn\'t download successfully; error code:' + request.statusText));
          }
        };
        request.onerror = function() {
      
            reject(Error('There was a network error.'));
        };
       
        request.send();
      });
}

function existDates(fecha){
    var show;
    var jsonData;
    

    getData(fecha).then(function(res){

        jsonData = JSON.parse(res);      

        if(jsonData.length > 0 ){
           marker= "dayMark";
        }
        else{
            show = "";
        }   
        
        //dayMark = show;    
        return show;      
     
    }).catch(function(err){
         //console.log(err);
    });

    
  
   
}


function mostrarCalendario(year,month)
{ 

    var now=new Date(year,month-1,1);
    var last=new Date(year,month,0);
    var fistDayOfWeek=(now.getDay()==0)?7:now.getDay();
    var lastDayOfMonth=last.getDate();
    var day=1;
    var resultado="<tr >";
    
    var last_cell=fistDayOfWeek+lastDayOfMonth;
   
    // do it a bucle until 42, that is the max of value 
    // 6 colums of 7 days
    for(var i=1;i<=42;i++)
    {    

        if(i==fistDayOfWeek)
        {
            //determinate witch day beging
            day=1;
        }
        if(i<fistDayOfWeek || i>=last_cell)
        {
            // empty cell
            resultado+="<td>&nbsp;</td>";
        }else{                  

            
            // show the day
            if(day==today.getDate() && month==today.getMonth()+1 && year==today.getFullYear()){
                console.log( existDates(''+year+'-'+month+'-'+day+'' ) );
                
                resultado+=
                    `<td class='hoy'>
                        ${day} 
                        <div class=" "><div> 
                    </td>`;
            }
            else{
                resultado+=`<td> ${day} <div class=" "><div>  </td>`;
            }
            day++;
        }
        if(i%7==0)
        {
            if(day>lastDayOfMonth)
                break;
            resultado+="</tr><tr>\n";
        }
    }
    resultado+="</tr>";

    var meses=Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    // calculate the next month and year
    nextMonth=month+1;
    nextYear=year;
    if(month+1>12)
    {
        nextMonth=1;
        nextYear=year+1;
    }

    // calculate the before month and year
    prevMonth=month-1;
    prevYear=year;
    if(month-1<1)
    {
        prevMonth=12;
        prevYear=year-1;
    }

    document.getElementById("calendar").getElementsByTagName("caption")[0].innerHTML="<div>"+meses[month-1]+" / "+year+"</div><div><button onclick='mostrarCalendario("+prevYear+","+prevMonth+")' class='btn' >&lt;</button> <button onclick='mostrarCalendario("+nextYear+","+nextMonth+")' class='btn'>&gt;</button></div>";
    document.getElementById("calendar").getElementsByTagName("tbody")[0].innerHTML=resultado;
}


mostrarCalendario(today.getFullYear(),today.getMonth()+1);