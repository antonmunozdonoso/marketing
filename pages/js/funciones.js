
const arreglo = [];

function agregar(argument) {
	
	var columnas = document.getElementById('columnas');
	var eliminar_elemento = document.getElementById('eliminar_elemento');
	var idTmp = Math.random().toString(36).substring(7);
	var numero_id = document.getElementById('numero_id');
	

	var select = document.createElement('select');
	select.classList.add("especialidades"+idTmp, "js-states", "form-control");
	var atributo = document.createAttribute("style");
	atributo.value = "width:280px";
	select.setAttributeNode(atributo);
	var atributo2 = document.createAttribute("required");
	select.setAttributeNode(atributo2);
	select.id = 'columna_'+idTmp;
	select.name = 'columna_'+idTmp;
	select.innerHTML += '<option value="">Seleccione Columna</option>';
	var label = document.createElement('label');
	label.classList.add("text-left", "mt-2");
	label.innerHTML = 'Columna';
	var div2 = document.createElement('div');
	div2.classList.add("form-group");
	div2.id = 'div2_'+idTmp;
	var div = document.createElement('div');
	div.classList.add("col-md-3");
	div.id = 'div_'+idTmp;
	

	label.appendChild(select);
	div2.appendChild(label);
	div.appendChild(div2);

	arreglo.push(idTmp);
	numero_id.value = arreglo;
	console.log(numero_id.value);

	/*if (eliminar_elemento.hasAttribute("onclick") == true) {
	  // hacer algo
	}else {
	var atributo_eliminar = document.createAttribute("onclick");
	atributo_eliminar.value = 'eliminar_columna('+idTmp+')';
	console.log(eliminar_elemento);
	eliminar_elemento.setAttributeNode(atributo_eliminar);
	}
	eliminar_elemento.id='eliminar_elemento_'+idTmp;*/

	$(document).ready(function() {
        $('.especialidades'+idTmp).select2();
    });

	columnas.appendChild(div);
	ajaxColumnas(idTmp);
}


function filtro_columnas(idTmp){
    
    var xmlhttp = new XMLHttpRequest();
    var url = "consulta_columnas.php";
    xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var array = JSON.parse(xmlhttp.responseText);
                    var i;
                    var out = "<option value='' selected>Seleccione Columna</option>";
                	//console.log(array);
                    for(i = 0; i < array.length; i++) {
                    
                            out+=" <option value="+array[i].columna+">"+array[i].columna+"</option>";
                        
                    
                    }           
                    document.getElementById("columna_"+idTmp).innerHTML = out;
                }
            }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function eliminar_columna() {
	
	var numero_id = document.getElementById('numero_id');
	var id_numero = document.getElementById('numero_id').value;
	//console.log(arreglo.length);
	if (arreglo.length > 0) {

		for (i = 0; i < arreglo.length; i++) {

		 	//console.log(arreglo[i]);
		  	var tmp_eliminar = arreglo[i];
		}

		const node = document.getElementById("div_"+tmp_eliminar);
		if (node.parentNode) {
	  		node.parentNode.removeChild(node);
	  		arreglo.pop();
	  		numero_id.value = arreglo;
		} 

	}
	
}


function ajaxColumnas(idTmp){
    
    $.ajax({
      data: {
          
          columnas: 'columnas',
                               
      },
      url: '../ajax/columnas.ajax.php',
      type: "POST",
      success: function(respuesta){
         
          if (respuesta) {

	    		var array = JSON.parse(respuesta);
                var i;
                var out = "<option value='' selected>Seleccione Columna</option>";
            	//console.log(array);
                for(i = 0; i < array.length; i++) {
                
                        out+=" <option value="+array[i].columna+">"+array[i].columna+"</option>";
                    
                
                }           
                document.getElementById("columna_"+idTmp).innerHTML = out;

	    	}else {

          		console.log(respuesta);
          	} 

	    }

	})
}