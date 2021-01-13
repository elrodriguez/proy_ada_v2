function listar_area_vista(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/area/controlador_ListarBuscar_area.php',
		type: 'POST',
		data:'valor='+valor+'&pagina='+pagina+'&boton=buscar',
		beforeSend: function(){
			$("#loading_almacen").addClass("fa fa-refresh fa-spin fa-3x fa-fw");
		},
	    complete: function(){
	      $("#loading_almacen").removeClass("fa fa-refresh fa-spin fa-3x fa-fw");
	    },
		success: function(resp){
			var datos = resp.split("*"); 
			var valores = eval(datos[0]); 
			if(valores.length>0){
				var cadena = "";
				cadena += "<table  class='table table-condensed jambo_table'>";
				cadena += "<thead  class=''>";
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center' hidden='true' >ID</th>";
				cadena += "<th style = 'text-align: center'>&Aacute;REA</th>";
				cadena += "<th style = 'text-align: center'>FECHA REGISTRO</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th style = 'text-align: center'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";			
					cadena += "<td align='center' hidden>"+valores[i][0]+"</td>";
					cadena += "<td>"+valores[i][1]+"</td>";
					cadena += "<td align='center'>"+valores[i][2]+"</td>";
					if (valores[i][3]=="INACTIVO") {
						cadena += "<td style = 'text-align: center'> <span class='badge bg-danger' style='color:White;'>"+valores[i][3]+"</span> </td>";
					}else{
						cadena += "<td  style = 'text-align: center'> <span class='badge bg-success' style='color:White;'>"+valores[i][3]+"</span> </td>";
					}
					cadena += "<td><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][2]+"*"+valores[i][3]+"' class='btn btn-primary' onclick='AbrirModalArea(this)'><span class='glyphicon glyphicon-pencil'></span>";
					cadena += "</button></td> ";
					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#listar_areas_tabla").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5); 
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_area_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_area_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
				}
				else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&laquo;</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Anterior</a></li>";
				}
				limite = 10;
				div = Math.ceil(limite/2);
				pagina_inicio = (pagina > div) ? (pagina - div):1;
				if(numero_paginas > div){
					pagina_restante = numero_paginas - pagina;
					pagina_fin = (pagina_restante > div) ? (pagina + div) : numero_paginas;
				}
				else{
					pagina_fin = numero_paginas;
				}
				for(i = pagina_inicio;i<=pagina_fin;i++){
					if(i==pagina){
						paginar +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
					}
					else{
						paginar += "<li><a href='javascript:void(0)' onclick='listar_area_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_area_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_area_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
				}
				else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Siguiente</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
				}
				paginar += "</ul>";
				$("#paginador_area_vista").html(paginar);
			}else{
				var cadena = "";
				cadena += "<table  class='table table-condensed jambo_table'>";
				cadena += "<thead  class=''>";
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center' hidden='true' >ID</th>";
				cadena += "<th style = 'text-align: center'>&Aacute;REA</th>";
				cadena += "<th style = 'text-align: center'>FECHA REGISTRO</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th style = 'text-align: center'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				cadena +="<tr style = 'text-align: center'><td colspan='4'><strong>No se encontraron registros</strong></td></tr>";
				cadena += "</tbody>";
				cadena += "</table>";
				$("#listar_areas_tabla").html(cadena);
				$("#paginador_area_tabla").html("");
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown, jqXHR){
			alert("SE PRODUJO UN ERROR");
		}
	});
}
function AbrirModalArea(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#modal_editar_area').modal({backdrop: 'static', keyboard: false})
	$('#modal_editar_area').modal('show');
	$('#txtidarea').val(datos_split[0]);
	$('#txtarea_modal').val(datos_split[1]);
	$('#cmb_estado').val(datos_split[3]).trigger("change");	
}
function Editar_area(){
	var codigo    = $("#txtidarea").val();
	var area      = $("#txtarea_modal").val();
	var estado    = $("#cmb_estado").val();
	if(area.length>0 && estado.length>0){
	}
	else{
		return swal("Falta Llenar Datos", "", "info");	
	}	
	$.ajax({
		url:'../controlador/area/controlador_editar_area.php',
		type:'POST',
		data:{
		codigo:codigo,
		area:area,
		estado:estado
		}
	})
	.done(function(resp){
		if (resp > 0) {
			$('#modal_editar_area').modal('hide');
			 swal("Datos Actualizados!", "", "success");
			 var dato_buscar = $("#txt_area_vista").val();
			  listar_area_vista(dato_buscar,'1');
		}
		else{
			swal("! Lo sentimos el area ya fue registrada con anterioridad!", "", "error");	
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status === 0) {

	    alert('Not connect: Verify Network.');

	  } else if (jqXHR.status == 404) {

	    alert('Requested page not found [404]');

	  } else if (jqXHR.status == 500) {

	    alert('Internal Server Error [500].');

	  } else if (textStatus === 'parsererror') {

	    alert('Requested JSON parse failed.');

	  } else if (textStatus === 'timeout') {

	    alert('Time out error.');

	  } else if (textStatus === 'abort') {

	    alert('Ajax request aborted.');

	  } else {

	    alert('Uncaught Error: ' + jqXHR.responseText);

	  }
	})			
}
function registrar_area(){
	var area      = $("#txtarea_modal").val();
	if(area.length>0 ){
	}
	else{
		return swal("Falta Llenar Datos", "", "info");	
	}	
	$.ajax({
		url:'../controlador/area/controlador_registrar_area.php',
		type:'POST',
		data:{
		area:area
		}
	})
	.done(function(resp){
		if (resp > 0) {
			 swal("Datos Registrados!", "", "success")
			 .then ( ( value ) =>  { 
				  $("#main-content").load("Area/vista_area_listar.php"); 
			});
			
		}
		else{
			swal("! Lo sentimos el area ya fue registrada con anterioridad!", "", "error");	
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status === 0) {

	    alert('Not connect: Verify Network.');

	  } else if (jqXHR.status == 404) {

	    alert('Requested page not found [404]');

	  } else if (jqXHR.status == 500) {

	    alert('Internal Server Error [500].');

	  } else if (textStatus === 'parsererror') {

	    alert('Requested JSON parse failed.');

	  } else if (textStatus === 'timeout') {

	    alert('Time out error.');

	  } else if (textStatus === 'abort') {

	    alert('Ajax request aborted.');

	  } else {

	    alert('Uncaught Error: ' + jqXHR.responseText);

	  }
	})			
}