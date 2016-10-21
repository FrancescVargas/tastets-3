function cargar(id) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            mostrarLista(datos);
        }
    }
    ajax.open("get", "ajax-cargar.php?id="+id, true);
    ajax.send();
}



function mostrarLista(d){
    

    
    var res  = document.querySelector("#resultado"); 
    var cad="";
    cad="<h4>Detalls Tastet "+d.nom+"</h4><table id='tablecargar'><tr><td><img alt='foto'  class='fototastet' src='"+d.foto+"'><span>Id: </span>"+d.id+"<br><span>Nom: </span>"+d.nom+"<br><span>Responsable: </span>"+d.responsable+"<br><span>DNI: </span>"+d.dni+"<br><span>Departament: </span>"+d.dep.nomdep+"<br><span>Lloc: </span>"+d.lloc+"<br><span>Nombre Màxim d'Alumnes per Sessió: </span>"+d.int_maxim_alu+"<br><span>Nivell mínim (o òptim) d&#39;edat o formació per fer el taller: </span>"+d.int_nivell+"<br><span>Períodes de l&#39;any en que està disponible: </span>"+d.dispany.disp+"<br></td><tr><td><span>Descripció: </span>"+d.descripcio+"<br></td></tr><tr><td><span>Comentaris Interns: </span>"+d.int_comentari+"<br></td></tr><tr><td><span>Quantitat màxima de tallers en un any acadèmic: </span>"+d.int_max_tallers_any+"<br><span>Duració de l'activitat (en hores): </span>"+d.int_duracio_activitat+"<br><span>Temps de preparació de l'activitat (en hores): </span>"+d.int_duracio_preparacio+"<br><span>Quantitat de personal implicat: </span><br>";
    
    for(i=0;i<d["participants"].length;i++)
    {    
    cad+=d["participants"][i]["nom_participant"]+"<br>";
    }
   
    
    cad+="</td></tr><tr><td><span>Suggeriments i comentaris: </span>"+d.int_sugg+"<br></td></tr></table>";
     
    res.innerHTML=cad;
}


// ____________________  petició  ----------------------------  //


function peticio(id) {
 

 var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            mostrarPeticions(datos);
        }
    }
    ajax.open("get", "ajax-peticions.php?id="+id, true);
    ajax.send();
}



function mostrarPeticions(d){
    

    
    var res  = document.querySelector("#resultado"); 
    var cad="";
    
    if(typeof d=="object")
    {
        cad+="<h4>Peticions del tastet "+d[0]["nom"]+"</h4><table id='tablecargar'><tr>";
         for(j in d[0])
                    {
                       if(j!=="nom" && j!=="id" && j!=="activitat_id") cad+="<th>"+j+"</th>";
                    }
        cad+="<th>Detalls Tastet Realitzat</th>";
        cad+="</tr>";
        for(i in d)
            {
               cad+="<tr>";
                for(j in d[i])
                {
                   if(j!=="nom" && j!=="id" && j!=="activitat_id") cad+="<td>"+d[i][j]+"</td>";
                }
                if(d[i]["realitzada"]=="1") cad+="<td><a href='editartastetfet.php?id_activitat="+d[i]["activitat_id"]+"&id_solicitut="+d[i]["id"]+"'>Edita Detalls</a></td>";
                if(d[i]["realitzada"]=="0") cad+="<td><a href='afegirtastetfet.php?id_activitat="+d[i]["activitat_id"]+"&id_solicitut="+d[i]["id"]+"'>Afegeix Detalls</a></td>";
                
            cad+="</tr>";
            }
        cad+="</table>";
    }
    if(typeof d=="string") 
    {
        cad+="<h4>No hi han peticions</h4>";
    }
    
    res.innerHTML=cad;
     
    
}


// ____________________  TASTETSFETS  ----------------------------  //


function tastetsfets(id) {
 

 var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            mostrarTastetsfets(datos);
        }
    }
    ajax.open("get", "ajax-tastetsfets.php?id="+id, true);
    ajax.send();
}



function mostrarTastetsfets(d){
    

    
    var res  = document.querySelector("#resultado"); 
    var cad="";
    
    if(typeof d=="object")
    {
        cad+="<h4>Detalls Tastets Fets "+d[0]["nom"]+"</h4><table id='tablecargar'><tr>";
         for(j in d[0])
                    {
                        if(j!=="nom" && j!=="id" && j!=="activitat_id" && j!=="solicitut_id") cad+="<th>"+j+"</th>";
                    }
        
        cad+="</tr>";
        for(i in d)
            {
               cad+="<tr>";
                for(j in d[i])
                {
                   if(j!=="nom" && j!=="id" && j!=="activitat_id" && j!=="solicitut_id") cad+="<td>"+d[i][j]+"</td>";
                }
                
                
            cad+="</tr>";
            }
        cad+="</table>";
    }
    if(typeof d=="string") 
    {
        cad+="<h4>No hi han Tastets Fets</h4>";
    }
    
    res.innerHTML=cad;
     
    
}




// ____________________  totalalumnes  ----------------------------  //


function totalalumnes(id) {
 

 var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            mostrarAlumnesTotals(datos);
        }
    }
    ajax.open("get", "ajax-totalalumnes.php?id="+id, true);
    ajax.send();
}



function mostrarAlumnesTotals(d){
    

    
    var res  = document.querySelector("#resultado"); 
    var cad="";
    
    if(typeof d=="object")
    {
        cad+="<h4>Alumnes totals Tastet "+d[0]["nom"]+"</h4><table id='tablecargar'><tr>";
         for(j in d[0])
                    {
                        if(j!=="nom" && j!=="id" && j!=="activitats_fetes_id") cad+="<th>"+j+"</th>";
                    }
        
        cad+="</tr>";
        for(i in d)
            {
               cad+="<tr>";
                for(j in d[i])
                {
                   if(j!=="nom" && j!=="id" && j!=="activitats_fetes_id") cad+="<td>"+d[i][j]+"</td>";
                }
                
                
            cad+="</tr>";
            }
        cad+="</table>";
    }
    if(typeof d=="string") 
    {
        cad+="<h4>No hi han Alumnes del Tastet</h4>";
    }
    
    res.innerHTML=cad;
     
    
}


// ____________________  totals  ----------------------------  //


function total() {
 

 var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            mostrarTotals(datos);
        }
    }
    ajax.open("get", "ajax-totals.php", true);
    ajax.send();
}



function mostrarTotals(d){
    

    
    var res  = document.querySelector("#resultado"); 
    var cad="";
    
    if(typeof d=="object")
    {
        cad+="<h4>Alumnes totals</h4><table id='tablecargar'><tr>";
         for(j in d[0])
                    {
                       cad+="<th><a href='javascript:ordenar(\""+j+"\")'>"+j+"</a></th>";
                    }
        
        cad+="</tr>";
        for(i in d)
            {
               cad+="<tr>";
                for(j in d[i])
                {
                   cad+="<td>"+d[i][j]+"</td>";
                }
                
                
            cad+="</tr>";
            }
        cad+="</table>";
    }
    
    if(typeof d=="string") 
    {
        cad+="<h4>No hi han dades</h4>";
    }
    res.innerHTML=cad;
     
    
}


function ordenar(j) {
 
var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            orden(datos);
        }
    }
    ajax.open("get", "ajax-ordenats.php?campo="+j, true);
    ajax.send();
    
}

function orden(d){
    

    
    var res  = document.querySelector("#resultado"); 
    var cad="";
    
    
        cad+="<h4>Alumnes totals ordenats</h4><table id='tablecargar'><tr>";
    
         for(j in d[0])
                    {
                       cad+="<th><a href='javascript:ordenar(\""+j+"\")'>"+j+"</a></th>";
                    }
        
        cad+="</tr>";
        for(i in d)
            {
               cad+="<tr>";
                for(j in d[i])
                {
                   cad+="<td>"+d[i][j]+"</td>";
                }
                
                
            cad+="</tr>";
            }
        cad+="</table>";
    
    res.innerHTML=cad;
     
    
}