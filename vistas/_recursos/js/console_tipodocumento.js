///////////////////////  Registrar Tipo de Documento  /////////////////////////////////////////
function Registrar_TipoDocumento(){
	/*Datos para la tabla venta*/
	var descripcion =$("#txttipodocumento_modal").val();
	if(descripcion.length==0){
		return swal("Falta ingresar datos","","info");
	}
	$.ajax({
	    url:'../controlador/tipo_documento/controlador_TipoDocumento_Registrar.php',
		type:'POST',
		data:{
			nombre:descripcion
		}
	})
	.done(function(resp){
		if (resp > 0) {
			var cod = JSON.parse(resp);
		    swal("Tipo Documento Registrado!", "", "success")
 			.then ( ( value ) =>  { 
				  $("#main-content").load("Tipo_Documento/vista_tipoDocumento_listar.php"); 
			});
		}
		else{
			swal("! Error !", "Registro no completado!", "error");	
		}
	})	
}
function AbrirModalEditarTipoDocumento(control){
	var datos = control.name;
		var datos_split = datos.split("*");
		$("#modal_editar_TipoDocumento").modal('show');
		$("#txtidtipodocumento").val(datos_split[0]);
		$("#txttipodocumento_modal").val(datos_split[1]);
		$("#cbmEstado").val(datos_split[2]).trigger("change");
}
function listar_TipoDocumento_vista(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/tipo_documento/controlador_TipoDocumento_Listar.php',
		type: 'POST',
		data:'valor='+valor+'&pagina='+pagina+'&boton=buscar',
		success: function(resp){
			var datos = resp.split("*"); 
			var valores = eval(datos[0]); 
			if(valores.length>0){
				var cadena = "";
				cadena += "<table class='table table-condensed jambo_table'>";
				cadena += "<thead class=''>";
				cadena += "<tr>";
				cadena += "<th style = 'text-align: center'>NOMBRE</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th style = 'text-align: center'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for (var i = 0; i < valores.length; i++) {
					cadena += "<tr>";
						cadena += "<td hidden>"+valores[i][0]+"</td>";
						cadena += "<td style = 'text-align: center'>"+valores[i][1]+"</td>";
						if (valores[i][2]=="INACTIVO") {
							cadena += "<td style = 'text-align: center'> <span class='badge bg-danger'  style='color:White;'>"+valores[i][2]+"</span> </td>";
						}else{
							cadena += "<td  style = 'text-align: center'> <span class='badge bg-success' style='color:White;'>"+valores[i][2]+"</span> </td>";
						}
						cadena += "<td style = 'text-align: center'>";
						cadena += "<button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][2]+"' class='btn btn-primary' onclick='AbrirModalEditarTipoDocumento(this)'><span class='glyphicon glyphicon-pencil'></span>";
						cadena += "</button> </td> ";
					cadena += "<tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#lista_tipodocumento_tabla").html(cadena);
				var totaldatos = datos[1];
				//alert("total de datos"+totaldatos);
				var numero_paginas = Math.ceil(totaldatos/5); //el Math.ceil acerca el resultado al próximo entero
				//alert("total de paginas"+numero_paginas);
				//var buscar_almacen = $("#txt_modal_nombreArea").val();
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_TipoDocumento_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_TipoDocumento_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
				}else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&laquo;</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Anterior</a></li>";
				}
				limite = 10;
				div = Math.ceil(limite/2);
				pagina_inicio = (pagina > div) ? (pagina - div):1;
				if(numero_paginas > div){
					pagina_restante = numero_paginas - pagina;
					pagina_fin = (pagina_restante > div) ? (pagina + div) : numero_paginas;
				}else{
					pagina_fin = numero_paginas;
				}
				////////////////////////////////////////////////////////
				for(i = pagina_inicio;i<=pagina_fin;i++){
					if(i==pagina){
						paginar +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
					}else{
						paginar += "<li><a href='javascript:void(0)' onclick='listar_TipoDocumento_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_TipoDocumento_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_TipoDocumento_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
				}else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Siguiente</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
				}
				paginar += "</ul>";
				$("#paginador_tipodocumento_tabla").html(paginar);
			}else{
				var cadena ="";
				cadena += "<table class='table table-condensed jambo_table'>";
				cadena += "<thead class=''>";
				cadena += "<tr>";
				cadena += "<th style = 'text-align: center'>NOMBRE</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th style = 'text-align: center'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				cadena += "<tr><td colspan='4'><Strong>Datos No Encontrados</Strong</td></tr>";
				cadena += "</tbody>";
				cadena += "</table>";
				$("#lista_tipodocumento_tabla").html(cadena);
				$("#paginador_tipodocumento_tabla").html(paginar);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown, jqXHR){
			alert("SE PRODUJO UN ERROR");
		}
	});
}
function Editar_TipoDocumento(){
    var codigo      = $("#txtidtipodocumento").val();
    var descripcion = $("#txttipodocumento_modal").val();
    var cbmEstado   = $("#cbmEstado").val();
    if (descripcion.length==0) {
    	return swal("Faltan Datos","","info");
    }
	$.ajax({
		url:'../controlador/tipo_documento/controlador_TipoDocumento_Editar.php',
		type:'POST',
		data:{
			cod:codigo,
			descri: descripcion,
		    estado:cbmEstado
		}
	})
	.done(function(resp){
		if (resp > 0) {
		    swal("Datos Actualizados!", "", "success");
		}
		else{
			swal("No se pudo actualizar los Datos", "", "error");	
		}
		$("#modal_editar_TipoDocumento").modal('hide');
		var buscar = $("#txtbuscar_tipodocumento").val();
		listar_TipoDocumento_vista(buscar,"1");
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
