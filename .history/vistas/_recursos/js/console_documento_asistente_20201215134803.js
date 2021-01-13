// ACTUALIZAR PDF INICIO
function AbrirModalSubirArchivoTurniting(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#iddocumentoturniting').val(datos_split[0]);
	$('#modal-subir-turning').modal({backdrop: 'static', keyboard: false})
	$('#modal-subir-turning').modal('show');
}
function AbrirModalenviarcorreo(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#iddocumentomodal-1').val(datos_split[0]);
	$('#modal-enviar-correo').modal({backdrop: 'static', keyboard: false})
	$('#modal-enviar-correo').modal('show');
}
function enviarcorreopordocumento(){
	var doc = $('#iddocumentomodal-1').val();
	var correo = $('#correo-modal').val();
	$.get( "../controlador/documento/controlador_enviar_correo.php?doc="+doc+'&correo='+correo, function( data ) {
		alert("El foreo se envio satisfactoriamente");
		listar_documento_vista("","1")
	});
}
function AbrirModalEditarPersonal(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#modal_editar_personal').modal({backdrop: 'static', keyboard: false})
	$('#modal_editar_personal').modal('show');
	$('#txtidciudadano').val(datos_split[0]);
	$('#txtnombre_alimentos').val(datos_split[1]);
	$('#txtapellidopaterno').val(datos_split[2]);
	$('#txtapellidomaterno').val(datos_split[3]);
	$('#txtemail_modal').val(datos_split[10]);
	$('#txtnrodocumento').val(datos_split[4]);
	$('#txttelefono_modal').val(datos_split[8]);
	$('#txtmovil_modal').val(datos_split[9]);
	$('#txtdireccion_modal').val(datos_split[7]);
	$('#txtfecha_modal').val(datos_split[6]);
	$('#cmb_estadopersonal').val(datos_split[12]).trigger("change");
}
function Editar_personal(){
	var codigo    = $("#txtidciudadano").val();
	var nombre    = $("#txtnombre_alimentos").val();
	var apepat    = $("#txtapellidopaterno").val();
	var apemat    = $("#txtapellidomaterno").val();
	var telefono  = $("#txttelefono_modal").val();
	var movil     = $("#txtmovil_modal").val();
	var direccion = $("#txtdireccion_modal").val();
	var fecha     = $("#txtfecha_modal").val();
	var nrodocume = $("#txtnrodocumento").val();
	var email     = $("#txtemail_modal").val();
	var estado    = $('#cmb_estadopersonal').val();
	if(nombre.length>0 && apepat.length>0 && apemat.length>0 && direccion.length>0 && nrodocume.length>0 && email.length>0 ){
	}
	else{
		return swal("Falta Llenar Datos", "", "info");
	}
	$.ajax({
		url:'../controlador/personal/controlador_editar_pdf.php',
		type:'POST',
		data:{
		codigo:codigo,
		nombre:nombre,
		apepat:apepat,
		apemat:apemat,
		telefono:telefono,
		movil:movil,
		direccion:direccion,
		fecha:fecha,
		nrodocume:nrodocume,
		email:email,
		estado:estado
		}
	})
	.done(function(resp){
		if (resp > 0) {
			$('#modal_editar_personal').modal('hide');
			 swal("Datos Actualizados!", "", "success");
			 var dato_buscar = $("#txtbuscar_personal").val();
			  listar_personal_vista(dato_buscar,'1');
		}
		else{
			swal("! Registro no completado!", "", "error");
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
// ACTUALIZAR PDF FINAL

function listar_documento_vista(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/documento/controlador_ListarBuscar_documento_asistente.php',
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
				cadena += "<table border='0' class='table table-condensed jambo_table'>";
				cadena += "<thead  class=''>";
				cadena += "<tr>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 80px;word-wrap: break-word;'>CÓDIGO</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;'>TÍTULO</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 150px;word-wrap: break-word;'>ASESOR</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 150px;word-wrap: break-word;'>FECHA RECEPCI&OacuteN</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 120px;word-wrap: break-word;''>TIPO DOCUMENTO</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 30px;word-wrap: break-word;'>ALUMNO</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;'>ARCHIVO</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;'>ESTADO</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;'>INFORME TURNITING</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;'>ENVIAR CORREO</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 10px;word-wrap: break-word;''>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";
					cadena += "<td  style = 'width: 80px;word-wrap: break-word;color:#9B0000; text-align:center;font-weight: bold;'>"+valores[i][0]+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"' class='btn btn-info' title='Vista previa del asunto' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalAsuntoDocumento(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td  style = 'width: 80px;word-wrap: break-word;color:#9B0000;'>"+valores[i]['asesor_full_name']+"</td>";
					cadena += "<td style = 'text-align: center;width: 150px;word-wrap: break-word;'>"+valores[i][2]+"</td>";
					cadena += "<td style = 'text-align: center;width: 120px;word-wrap: break-word;'>"+valores[i][3]+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][6]+"' class='btn btn-info' title='Vista previa de los Datos del remitente' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalVerRemitente(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][9]+"' class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' title='Ver documento Cargado' onclick='AbrirModalArchivo_documento(this)'><i class='fa  fa-folder-open' style='color:orange;'></i></button></td>";
					if (valores[i]['num_proceso']=="1"){
						if (valores[i][5]=="INACTIVO") {
							cadena += "<tdstyle = 'text-align: center;width: 20px;word-wrap: break-word;'> <span class='badge bg-danger' style='color:White;'>"+valores[i][5]+"</span> </td>";
						}else if (valores[i][5]=="PENDIENTE") {
							cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'> <span class='badge bg-info' style='color:White;'>"+valores[i][5]+"</span> </td>";
						}else{
							cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'> <span class='badge bg-success' style='color:White;'>"+valores[i][5]+"</span> </td>";
						}
					}else{
						cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'> <span class='badge bg-success' style='color:White;'>ACEPTADO</span> </td>";
					}
					
					//IFORME TURNITING
					let btn_ver='';
					if(valores[i]['archivo_turniting']){
						btn_ver = `<button type='button' class='btn btn-link' onclick='modalverturniting("`+valores[i]['porcentaje']+`","`+valores[i][0]+`","`+valores[i]['archivo_turniting']+`")' >Ver</button>`;
					}
					cadena += "<td><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][2]+"*"+valores[i][3]+"*"+valores[i][4]+"*"+valores[i][5]+"*"+valores[i][6]+"*"+valores[i][7]+"*"+valores[i][8]+"*"+valores[i][9]+"*"+valores[i][10]+"*"+valores[i][11]+"*"+valores[i][12]+"*"+valores[i][13]+"*"+valores[i][14]+"' class='btn btn-primary' onclick='AbrirModalSubirArchivoTurniting(this)'><i class='fa fa-cloud-upload'></i></button>"+btn_ver+"</td>";
					cadena += "<td><button name='"+valores[i][0]+"' class='btn btn-primary' onclick='AbrirModalenviarcorreo(this)'><i class='fa fa-envelope'></i>";

					cadena += "<td style = 'text-align: center;width:1000px;word-wrap: break-word;'><button  name='"+valores[i][0]+"'  class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#000;color:#000 !important;'  title='Aceptar Documento' onclick='AbrirfuncionAceptarSolicitud_asistente(this)'><i class='fa fa-check' style='color:green;'></i>";
					cadena += "<b> Aceptar</b></button>&nbsp;<button  name='"+valores[i][0]+"'  class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#000;color:#000 !important;'  title='Rechazar Documento' onclick='AbrirfuncionRechazarSolicitud(this)'><i class='fa fa-close' style='color:red;'></i>";
					cadena += "<b> Rechazar</b></button></td>";
					cadena += "</button></td> ";


					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#listar_documento_tabla").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5);
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_documento_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_documento_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
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
						paginar += "<li><a href='javascript:void(0)' onclick='listar_documento_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_documento_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_documento_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
				}
				else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Siguiente</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
				}
				paginar += "</ul>";
				$("#paginador_documento_tabla").html(paginar);
			}else{
				var cadena = "";
				cadena += "<table  class='table table-condensed jambo_table'>";
				cadena += "<thead  class=''>";
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center;width: 80px;word-wrap: break-word;'>ID</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;'>ASUNTO</th>";
				cadena += "<th style = 'text-align: center;width: 150px;word-wrap: break-word;'>FECHA RECEPCI&OacuteN</th>";
				cadena += "<th style = 'text-align: center;width: 150px;word-wrap: break-word;'>&Aacute;REA ASIGNADA</th>"
				cadena += "<th style = 'text-align: center;width: 120px;word-wrap: break-word;''>TIPO DOCUMENTO</th>";
				cadena += "<th style = 'text-align: center;width: 30px;word-wrap: break-word;'>ALUMNO</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;'>ARCHIVO</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;'>ESTADO</th>";
				cadena += "<th style = 'text-align: center;width: 10px;word-wrap: break-word;''>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				cadena +="<tr style = 'text-align: center'><td colspan='8'><strong>No se encontraron registros</strong></td></tr>";
				cadena += "</tbody>";
				cadena += "</table>";
				$("#listar_documento_tabla").html(cadena);
				$("#paginador_documento_tabla").html("");
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown, jqXHR){
			alert("SE PRODUJO UN ERROR");
		}
	});
}

//FIN DE LISTAR DOCUMENTOS
function AbrirModalArchivo_documento(control){

	$('#modal_archivo_documento').modal({backdrop: 'static', keyboard: false})
	$("#modal_archivo_documento").modal('show');
	var datos = control.name;
	var datos_split = datos.split("*");
		if (datos_split[0]!="" ) {
		var cadena =  '<object data="../controlador/documento/'+datos_split[0]+'"#zoom=100" type="application/pdf" style="width: 100%; height: 100%; min-height: 480px;">';
		$("#id_archivodocumento").html(cadena);
		}else{
		var cadena =  '<br><br><label>NO EXISTE ARCHIVO</label><br><br><br>';
		$("#id_archivodocumento").html(cadena);
		}
}
function AbrirModalAsuntoDocumento(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#modal_asunto_documento_modal').modal({backdrop: 'static', keyboard: false})
	$('#modal_asunto_documento_modal').modal('show');
	$('#txtiddocumento_modal').html(datos_split[0]);
	$('#txtasunto_documento_modal').val(datos_split[1]);
	$('#cmb_estado').val(datos_split[3]).trigger("change");
}
function AbrirModalDocumento(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#modal_editar_institucion').modal({backdrop: 'static', keyboard: false})
	$('#modal_editar_institucion').modal('show');
	$('#txtidinstitucion').val(datos_split[0]);
	$('#txtinstitucion_modal').val(datos_split[1]);
	$('#txttipoinstitucion_modal').val(datos_split[2]);
	$('#cmb_estado').val(datos_split[3]).trigger("change");
}
function AbrirModalVerRemitente(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#txtiddocumento1_modal').html(datos_split[0]);
	$('#txtiddocumento2_modal').html(datos_split[0]);
	if (datos_split[2]=="C") {
		BuscarRemitenteCiudadano(datos_split[0]);
	}
	if (datos_split[2]=="I") {
		BuscarRemitenteInstitucion(datos_split[0]);
	}
}
function BuscarRemitenteCiudadano(control) {
	$.ajax({
		url:'../controlador/documento/controlador_documento_traeremitenteciudadano.php',
		type:'POST',
		data:{
			codigo:control
		}
	}).done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
				$('#modal_datos_remitente_documento_modal').modal({backdrop: 'static', keyboard: false})
				$('#modal_datos_remitente_documento_modal').modal('show');
			var cadena= '';
			for (var i = 0; i < data.length; i++) {
				cadena+=`<tr>
							<td>`+data[i][1]+`</td>
							<th>`+data[i][0]+`</td>
							<td>`+data[i][2]+`</td>
						</tr>`;
			}
			$('#tbody-tabla-alumnos-tesis').html(cadena)
		}else{
			swal("Documento sin remitente","","info");
		}
	})
}
function BuscarRemitenteInstitucion(control) {
	$.ajax({
		url:'../controlador/documento/controlador_documento_traeremitenteinstitucion.php',
		type:'POST',
		data:{
			codigo:control
		}
	})
	.done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
				$('#modal_datos_remitenteinstitucion_documento_modal').modal({backdrop: 'static', keyboard: false})
				$('#modal_datos_remitenteinstitucion_documento_modal').modal('show');
			var cadena="";
			for (var i = 0; i < data.length; i++) {
				$('#txtdatosremitenteinstitucion').val(data[i][0]);
				$('#txttipoinstitucion').val(data[i][1]);
			}
		}else{
			swal("Documento sin remitente","","info");
		}
	})
}
function Listar_tipodocumento_combo() {
	$.ajax({
		url:'../controlador/tipo_documento/controlador_combolistar_tipodocumento.php',
		type:'POST'
	})
	.done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
			// var cadena = "";
			// 	cadena += "<option value='otro'>"+"SELECCIONAR TIPO DOCUMENTO"+"</option>";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#combo_tipodocumento").html(cadena);
		}
		else{
			var cadena = "<option value='otro'>no se encontraron tipo de documentos Disponibles</option>";
			$("#combo_tipodocumento").html(cadena);
		}
	})
}
function Listar_areas_combo() {
	$.ajax({
		url:'../controlador/area/controlador_combolistar_area.php',
		type:'POST'
	})
	.done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
			// var cadena = "";
			// 	cadena += "<option value='otro'>"+"SELECCIONAR &Aacute;REA"+"</option>";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#combo_area").html(cadena);
		}
		else{
			var cadena = "<option value='otro'>no se encontraron areas Disponibles</option>";
			$("#combo_area").html(cadena);
		}
	})
}
function Listar_asesor_combo() {
	$.ajax({
		url:'../controlador/area/controlador_combolistar_asesor.php',
		type:'POST'
	})
	.done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
			var cadena = "";
				cadena += "<option value='otro'>"+"SELECCIONAR ASESOR"+"</option>";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+" "+data[i][2]+" "+data[i][3]+"</option>";
			}
			$("#combo_asesor").html(cadena);
		}
		else{
			var cadena = "<option value='otro'>no se encontraron Asesores</option>";
			$("#combo_asesor").html(cadena);
		}
	})
}
function AbrirModalRemitente(){
	$('#modal_remitente').modal({backdrop: 'static', keyboard: false})
	$("#modal_remitente").modal("show");
	listar_ciudadanoremitente_vista('','1');
	listar_institucionremitente_vista('','1');
}
function listar_ciudadanoremitente_vista(valor,pagina){
	var modalidad = $('#cbm_tipo').val();
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/ciudadano/controlador_ListarBuscar_ciudadano_remitente_modal.php',
		type: 'POST',
		data:'valor='+valor+'&pagina='+pagina+'&boton=buscar&modalidad='+modalidad,
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
				cadena += "<th style = 'text-align: center'>NOMBRE Y APELLIDOS</th>";
				cadena += "<th style = 'text-align: center'>DNI</th>";
				cadena += "<th style = 'text-align: center'>FECHA NACIMIENTO</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					var datoscompletos;
					datoscompletos = valores[i][1]+" "+valores[i][2]+" "+valores[i][3];
					cadena += "<tr>";
					cadena += "<td align='center' hidden>"+valores[i][0]+"</td>";
					cadena += "<td>"+valores[i][1]+" "+valores[i][2]+" "+valores[i][3]+"</td>";
					cadena += "<td align='center'>"+valores[i][4]+"</td>";
					cadena += "<td align='center'>"+valores[i][6]+"</td>";
					if (valores[i][12]=="INACTIVO") {
						cadena += "<td style = 'text-align: center'> <span class='badge bg-danger' style='color:White;'>"+valores[i][12]+"</span> </td>";
					}else{
						cadena += "<td  style = 'text-align: center'> <span class='badge bg-success' style='color:White;'>"+valores[i][12]+"</span> </td>";
					}
					cadena += "<td><button name='"+valores[i][0]+"*"+datoscompletos+"*"+"C"+"' class='btn btn-primary' onclick='agregarDatosciudadanos(this)'><span class='glyphicon glyphicon-pencil'></span>";
					cadena += "</button></td> ";
					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#listar_ciudadanosdisponibles_remitente").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5);
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_ciudadanoremitente_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_ciudadanoremitente_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
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
						paginar += "<li><a href='javascript:void(0)' onclick='listar_ciudadanoremitente_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_ciudadanoremitente_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_ciudadanoremitente_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
				}
				else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Siguiente</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
				}
				paginar += "</ul>";
				$("#paginador_ciudadanosdisponibles_remitente").html(paginar);
			}else{
				var cadena = "";
				cadena += "<table  class='table table-condensed jambo_table'>";
				cadena += "<thead  class=''>";
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center' hidden='true' >ID</th>";
				cadena += "<th style = 'text-align: center'>NOMBRE Y APELLIDOS</th>";
				cadena += "<th style = 'text-align: center'>DNI</th>";
				cadena += "<th style = 'text-align: center'>FECHA NACIMIENTO</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				cadena +="<tr style = 'text-align: center'><td colspan='7'><strong>No se encontraron registros</strong></td></tr>";
				cadena += "</tbody>";
				cadena += "</table>";
				$("#listar_ciudadanosdisponibles_remitente").html(cadena);
				$("#paginador_ciudadanosdisponibles_remitente").html("");
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown, jqXHR){
			alert("SE PRODUJO UN ERROR");
		}
	});
}
function listar_institucionremitente_vista(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/institucion/controlador_ListarBuscar_institucionremitente_modal.php',
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
				cadena += "<th style = 'text-align: center'>INSTITUCI&Oacute;N</th>";
				cadena += "<th style = 'text-align: center'>TIPO INSTITUCI&Oacute;N</th>";
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
						cadena += "<td style = 'text-align: center'> <span class='badge bg-success' style='color:White;'>"+valores[i][3]+"</span> </td>";
					}
					cadena += "<td style = 'text-align: center'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+"I"+"' class='btn btn-primary' onclick='EnviarDatosRemitente(this)'><span class='glyphicon glyphicon-pencil'></span>";
					cadena += "</button></td> ";
					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#div_listar_instituciondisponible_remitente").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5);
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_institucionremitente_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_institucionremitente_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
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
						paginar += "<li><a href='javascript:void(0)' onclick='listar_institucionremitente_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_institucionremitente_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_institucionremitente_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
				}
				else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Siguiente</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
				}
				paginar += "</ul>";
				$("#paginador_instituciondisponible_remitente").html(paginar);
			}else{
				var cadena = "";
				cadena += "<table  class='table table-condensed jambo_table'>";
				cadena += "<thead  class=''>";
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center' hidden='true' >ID</th>";
				cadena += "<th style = 'text-align: center'>INSTITUCI&Oacute;N</th>";
				cadena += "<th style = 'text-align: center'>TIPO INSTITUCI&Oacute;N</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th style = 'text-align: center'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				cadena +="<tr style = 'text-align: center'><td colspan='4'><strong>No se encontraron registros</strong></td></tr>";
				cadena += "</tbody>";
				cadena += "</table>";
				$("#div_listar_instituciondisponible_remitente").html(cadena);
				$("#paginador_instituciondisponible_remitente").html("");
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown, jqXHR){
			alert("SE PRODUJO UN ERROR");
		}
	});
}
function agregarDatosciudadanos(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$("#txttipo").val(datos_split[2]);

	if ( $("#txtidremitente"+datos_split[0]).length > 0 ) {
		alert('el alumno ya esta seleccionado');
		return false;
	}

	var inputs = $("#div-alumnos-agregados").html();

	inputs += `<div id="div-alumnos-agregados`+datos_split[0]+`">
				<div class="col-md-5">
					<label>C&oacute;digo Alumno</label>
					<input type="text" value="`+datos_split[0]+`" id="txtidremitente`+datos_split[0]+`" name="idremitente[]" readonly style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;" readonly class="form-control">
				</div>
				<div class="col-md-5">
					<label>Datos Alumno</label>
					<input type="text" value="`+datos_split[1]+`" id="txtdatosremitente`+datos_split[0]+`" name="txtdatosremitente[]" readonly style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;" readonly class="form-control">
				</div>
				<div class="col-md-2">
					<button onclick="quitarAlumno('`+datos_split[0]+`')" class="btn btn-primary" type="button">Eliminar</button>
				</div>
			</div>`;

	$("#div-alumnos-agregados").html(inputs);

	$("#modal_remitente").modal("hide");
}
function quitarAlumno(id){
	$('#div-alumnos-agregados'+id).remove();
}
function EnviarDatosRemitente(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$("#txtidremitente").val(datos_split[0]);
	$("#txtdatosremitente").val(datos_split[1]);
	$("#txttipo").val(datos_split[2]);
	$("#modal_remitente").modal("hide");
}
function TraerCodigoDocumento(){
	$.ajax({
		url:'../controlador/documento/controlador_codigodocumento_listar.php',
		type:'POST'
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			var cant=data[0][0];
			if (cant<9) {
			    $("#txtiddocumento").val("DOC-00000"+(parseInt(cant)+1));
			};
			if (cant>=9 && cant<=98) {
				$("#txtiddocumento").val("DOC-0000"+(parseInt(cant)+1));
			};
			if (cant>=99 && cant<=998) {
				$("#txtiddocumento").val("DOC-000"+(parseInt(cant)+1));
			};
			if (cant>=999 && cant<=9998) {
				$("#txtiddocumento").val("DOC-00"+(parseInt(cant)+1));
			};
			if (cant>=9999 && cant<99999) {
				$("#txtiddocumento").val("DOC-0"+(parseInt(cant)+1));
			};
			if (cant>=99999) {
				$("#txtiddocumento").val("DOC-"+(parseInt(cant)+1));
			};
		}
		else{
			$("#txtiddocumento").val("DOC-000001");
		}
	})
}


function Registrar_documento(){
	var iddocumento = $("#txtiddocumento").val();
	var idremitente = $("#txtidremitente").val();
	var opcion      = $("#txttipo").val();
	var idtipodocu  = $("#combo_tipodocumento").val();
	var idasesor    = $("#combo_asesor").val();
	var idarea      = $("#combo_area").val();
	var asunto      = $("#txtasunto_documento").val();
	var idnumero 		= $("#idnumero").val();
	var idusuario   = $("#txtnombre_codigo_usuario").val();
	if (idarea=='asunto' ) {
		return swal("Falta Ingresar el título de la tesis","","error");
	}
	if (idasesor=='idasesor' ) {
		return swal("Falta seleccionar el Asesor","","error");
	}
	if (idarea=='otro' && idtipodocu=='otro') {
		return swal("Falta seleccionar el area de destino y el Tipo Documento","","error");
	}
	if (idarea=='otro' ) {
		return swal("Falta seleccionar el area de destino","","error");
	}
	if (idtipodocu=='otro') {
		return swal("Falta seleccionar el tipo de documento","","error");
	}
	if (idremitente.length==0) {
		return swal("Falta seleccionar el tipo de documento","","error");
	}
	//return alert(iddocumento+" - "+ asunto +" - "+ idtipodocu +" - "+idarea +" - "+ idremitente +" - "+ idusuario +" - "+opcion);
	$.ajax({
		url:'../controlador/documento/controlador_registrar_documento_asistente.php',
		type:'POST',
		data:{
			iddocumento:iddocumento,
			asunto:asunto,
			idnumero : idnumero,
			idtipodocu:idtipodocu,
			idasesor:idasesor,
			idarea:idarea,
			idremitente:idremitente,
			idusuario:idusuario,
			opcion:opcion
		}
	})

	.done(function(resp){
		if (resp > 0) {
			swal("Proyecto Tesis Registrado!", "", "success")
			.then ( ( value ) =>  {
				  $("#main-content").load("Documento/vista_documento_listar.php");
			});

		}
		else{
			swal("! Lo sentimos el documento no fue Registrado!", "", "error");
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
function Registrar_documento_post(){
	$(document).on('submit', '#create-form-documento', function() {
      var data = $(this).serialize();
      $.ajax({
        type : 'POST',
        mimeType: "multipart/form-data",
        url:'../controlador/documento/controlador_registrar_documento_asistente.php',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success:function(resp) {
          if(resp>0){
          	document.getElementById("create-form-documento").reset();
            swal("Proyecto Tesis Registrado!", "", "success")
			.then ( ( value ) =>  {
				  $("#main-content").load("Documento/vista_documento_listar_asistente.php");
			});
          }else{
            var iddocumento = $("#txtiddocumento").val();
			var idremitente = $("#txtidremitente").val();
			var opcion      = $("#txttipo").val();
			var idtipodocu  = $("#combo_tipodocumento").val();
			var idasesor		= $("#combo_asesor").val();
			var idarea      = $("#combo_area").val();
			var asunto      = $("#txtasunto_documento").val();
			var idnumero    = $("#idnumero").val();
			var idusuario   = $("#txtnombre_codigo_usuario").val();
			if (asunto.length==0 ) {
				return swal("Falta ingresar el título del documento","","error");
			}
			if (idasesor=='otro' ) {
				return swal("Falta seleccionar el Asesor","","error");
			}
			if (idarea=='otro' && idtipodocu=='otro') {
				return swal("Falta seleccionar el area de destino y el Tipo Documento","","error");
			}
			if (idarea=='otro' ) {
				return swal("Falta seleccionar el area de destino","","error");
			}

			if (idtipodocu=='otro') {
				return swal("Falta seleccionar el tipo de documento","","error");
			}
			if (idremitente.length==0) {
				return swal("Falta seleccionar el alumno","","error");
			}
          }
          traer_administrador();
        }
      });
      return false;
    });
}
function registrar_documento_turniting(){
      $.ajax({
        type : 'POST',
        url:'../controlador/documento/controlador_registrar_documento_asistente_turniting.php',
        data:  new FormData(document.getElementById("form-upload-file-turniting")),
        contentType: false,
        cache: false,
        processData:false,
        success:function(resp) {
          if(resp>0){
			$('#modal-subir-turning').modal('hide');
          	document.getElementById("form-upload-file-turniting").reset();
            swal("Proyecto Tesis Registrado!", "", "success")
			.then ( ( value ) =>  {
				  $("#main-content").load("Documento/vista_documento_listar_asistente.php");
			});
          }else{
            var porcentaje = $("#porcentaje").val();
			var fileturniting = $("#file-turniting").val();
			if (porcentaje == null ||  porcentaje == '') {
				return swal("Falta ingresar el porcentaje","","error");
			}
			if (fileturniting == null || fileturniting == '') {
				return swal("Falta seleccionar archivo","","error");
			}
          }
        }
      });
}
//=============================================================================================================================
//=============================================================================================================================
//===================================================VERIFICAR DOCUMENTO PENDIENTE=============================================
//=============================================================================================================================
//=============================================================================================================================
						// SISTENTE
function listar_verificardocumento_vista_asistente(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/documento/controlador_ListarBuscar_documentopendiente_asistente.php',
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
				cadena += "<th style = 'text-align: center;width: 80px;word-wrap: break-word;'>ID</th>";
				cadena += "<th style = 'text-align: center;width: 50px;word-wrap: break-word;'>TÍTULO</th>";
				cadena += "<th style = 'text-align: center;width: 130px;word-wrap: break-word;'>FECHA RECEPCI&OacuteN</th>";
				cadena += "<th style = 'text-align: center;width: 100px;word-wrap: break-word;'>&Aacute;REA ASIGNADA</th>"
				cadena += "<th style = 'text-align: center;width: 100px;word-wrap: break-word;''>TIPO DOCUMENTO</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;'>TESISTA</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;'>ARCHIVO</th>";
				cadena += "<th style = 'text-align: center;width: 200px;word-wrap: break-word;'>ESTADO</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";
					cadena += "<td  style = 'width: 80px;word-wrap: break-word;color:#9B0000; text-align:center;font-weight: bold;'>"+valores[i][0]+"</td>";
					cadena += "<td style = 'text-align: center;width: 50px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"' class='btn btn-info' title='Vista previa del asunto' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalAsuntoDocumento(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td style = 'text-align: center;width: 130px;word-wrap: break-word;'>"+valores[i][2]+"</td>";
					cadena += "<td style = 'text-align: center;width: 100px;word-wrap: break-word;'>"+valores[i][4]+"</td>";
					cadena += "<td style = 'text-align: center;width: 100px;word-wrap: break-word;'>"+valores[i][3]+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][6]+"' class='btn btn-info' title='Vista previa de los Datos del remitente' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalVerRemitente(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][9]+"' class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' title='Ver documento Cargado' onclick='AbrirModalArchivo_documento(this)'><i class='fa  fa-folder-open' style='color:orange;'></i></button></td>";
					if (valores[i][5]=="RECHAZADO") {
						cadena += "<td style = 'text-align: center;width: 80px;word-wrap: break-word;'><button disabled class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#000;color:#000 !important;'  title='Aceptar Documento' onclick='AbrirfuncionAceptarSolicitud(this)'><i class='fa fa-check' style='color:green;'></i>";
						cadena += "<b> Procesado</b></button></td>";
					}else if (valores[i][5]=="ACEPTADO") {
						cadena += "<td style = 'text-align: center;width: 80px;word-wrap: break-word;'><button disabled class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#000;color:#000 !important;'  title='Aceptar Documento' onclick='AbrirfuncionAceptarSolicitud(this)'><i class='fa fa-check' style='color:green;'></i>";
						cadena += "<b> Procesado</b></button></td>";
					}else{
						cadena += "<td style = 'text-align: center;width: 200px;word-wrap: break-word;'><button  name='"+valores[i][0]+"'  class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#000;color:#000 !important;'  title='Aceptar Documento' onclick='AbrirfuncionAceptarSolicitud(this)'><i class='fa fa-check' style='color:green;'></i>";
						cadena += "<b> Aceptar</b></button>&nbsp;<button  name='"+valores[i][0]+"'  class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#000;color:#000 !important;'  title='Rechazar Documento' onclick='AbrirfuncionRechazarSolicitud(this)'><i class='fa fa-close' style='color:red;'></i>";
						cadena += "<b> Rechazar</b></button></td>";
					}
					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#listar_documentopendiente_tabla").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5);
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_verificardocumento_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_verificardocumento_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
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
						paginar += "<li><a href='javascript:void(0)' onclick='listar_verificardocumento_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_verificardocumento_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_verificardocumento_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
				}
				else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Siguiente</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
				}
				paginar += "</ul>";
				$("#paginador_documentopendiente_tabla").html(paginar);
			}else{
				var cadena = "";
				cadena += "<table  class='table table-condensed jambo_table'>";
				cadena += "<thead  class=''>";
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center;width: 80px;word-wrap: break-word;'>ID</th>";
				cadena += "<th style = 'text-align: center;width: 50px;word-wrap: break-word;'>ASUNTO</th>";
				cadena += "<th style = 'text-align: center;width: 130px;word-wrap: break-word;'>FECHA RECEPCI&OacuteN</th>";
				cadena += "<th style = 'text-align: center;width: 100px;word-wrap: break-word;'>&Aacute;REA ASIGNADA</th>"
				cadena += "<th style = 'text-align: center;width: 100px;word-wrap: break-word;''>TIPO DOCUMENTO</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;'>REMITENTE</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;'>ARCHIVO</th>";
				cadena += "<th style = 'text-align: center;width: 200px;word-wrap: break-word;'>ESTADO</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				cadena +="<tr style = 'text-align: center'><td colspan='8'><strong>No se encontraron registros</strong></td></tr>";
				cadena += "</tbody>";
				cadena += "</table>";
				$("#listar_documentopendiente_tabla").html(cadena);
				$("#paginador_documentopendiente_tabla").html("");
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown, jqXHR){
			alert("SE PRODUJO UN ERROR");
		}
	});
}


function AbrirfuncionAceptarSolicitud(control){
	var datos       = control.name;
	var datos_split = datos.split("*");
	swal({
	  title: "¿Seguro que desea Aceptar el Documento?",
	  icon: "success",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	$.ajax({
	  		url:'../controlador/documento/controlador_documento_aceptado.php',
	  		type:'POST',
	  		data:{
	  			codigo:datos_split[0]
	  		}
	  	})
	  	.done(function(resp){
	  		 listar_verificardocumento_vista('PENDIENTE','1');
	  		if (resp>0) {
	  			 swal("Solicitud Aceptada","", {
				      icon: "success",
				    });
	  		}else{
	  			swal("No se pudo Aceptar la solicitud","","error");
	  		}
	  	})

	  } else {
	    swal("Proceso Cancelado","","warning");
	  }
	});
}
function AbrirfuncionAceptarSolicitud_asistente(control){
	var datos       = control.name;
	var datos_split = datos.split("*");
	swal({
	  title: "¿Seguro que desea Aceptar el Documento?",
	  icon: "success",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	$.ajax({
	  		url:'../controlador/documento/controlador_documento_aceptado_asistente.php',
	  		type:'POST',
	  		data:{
	  			codigo:datos_split[0]
	  		}
	  	})
	  	.done(function(resp){
	  		 listar_verificardocumento_vista('PENDIENTE','1');
	  		if (resp>0) {
	  			 swal("Solicitud Aceptada","", {
				      icon: "success",
				    });
	  		}else{
	  			swal("No se pudo Aceptar la solicitud","","error");
	  		}
	  	})

	  } else {
	    swal("Proceso Cancelado","","warning");
	  }
	});
}


function AbrirfuncionRechazarSolicitud(control){
	var datos       = control.name;
	var datos_split = datos.split("*");
	swal({
	  title: "¿Seguro que desea Rechazar el Documento?",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	     	$.ajax({
		  		url:'../controlador/documento/controlador_documento_rechazado.php',
		  		type:'POST',
		  		data:{
		  			codigo:datos_split[0]
		  		}
		  	})
		  	.done(function(resp){alert(resp);
		  		 listar_verificardocumento_vista('PENDIENTE','1');
		  		if (resp>0) {
		  			 swal("Solicitud Rechazada","", {
					      icon: "success",
					    });
		  		}else{
		  			swal("No se pudo Rechazar la solicitud","","error");
		  		}
		  	})
	  } else {
	   swal("Proceso Cancelado","","warning");
	  }
	});
}

function modalverturniting(porcentaje,title,url){
	var contenidotitulo = '<p><strong>'+title+'</strong> Porcentaje: '+porcentaje+'</p>';
	var iframehtml = `<iframe id="iframemodalturniting" src="../controlador/documento/`+url+`" width="100%" height="500" frameborder="0" scrolling="no"></iframe>`;
	$('#modal-title-tirniting').html(contenidotitulo);
	$('#modal-body-turniting').html(iframehtml);
	$('#modal-ver-turniting').modal('show');
}
