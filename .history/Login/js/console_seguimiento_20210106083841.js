$(document).ready(function(){
    $("#txtdocumento").val("");
});
function filtrar_seguimiento_modal(buscar){
	$.ajax({
		url:'controlador/seguimiento/controlador_seguimiento_listar.php',
		type:'POST',
		data:{
			buscar:buscar
		}
	})
	.done(function(resp){
		var valores = JSON.parse(resp);
		if (valores.length > 0) {
			var cadena = "";
			for (var i = 0; i < valores.length; i++) {
				cadena += "<tr>";			
					cadena += "<td  style = 'width: 80px;word-wrap: break-word;color:#9B0000; text-align:center;font-weight: bold;'>"+valores[i][0]+"</td>";
					cadena += "<td style = 'text-align: center;width: 50px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"' class='btn btn-info' title='Vista previa del asunto' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalAsuntoDocumento(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td style = 'text-align: center;width: 130px;word-wrap: break-word;'>"+valores[i][2]+"</td>";
					cadena += "<td style = 'text-align: center;width: 150px;word-wrap: break-word;'>"+valores[i][4]+"</td>";
					cadena += "<td style = 'text-align: center;width: 150px;word-wrap: break-word;'>"+valores[i][3]+"</td>";
					cadena += "<td style = 'text-align: center;width: 40px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][6]+"' class='btn btn-info' title='Vista previa de los Datos del remitente' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalVerRemitente(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][9]+"' class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' title='Ver documento Cargado' onclick='AbrirModalArchivo_documento(this)'><i class='fa  fa-folder-open' style='color:orange;'></i></button></td>";
					if(valores[i]['doc_estado']=="RECHAZADO" && valores[i]['num_proceso']==1 && valores[i]['archivo_etapa1_v2']== null){
						btn_v2 = `<button name='`+valores[i][0]+`*`+valores[i][1]+`*`+valores[i][2]+`*`+valores[i][3]+`*`+valores[i][4]+`*`+valores[i][5]+`*`+valores[i][6]+`*`+valores[i][7]+`*`+valores[i][8]+`*`+valores[i][9]+`*`+valores[i][10]+`*`+valores[i][11]+`*`+valores[i][12]+`*`+valores[i][13]+`*`+valores[i][14]+`' class='btn btn-primary' onclick='AbrirModalSubirArchivov2(this)'><i class='glyphicon glyphicon-upload'></i></button>`;
					}else{
						btn_v2 = '<i class="glyphicon glyphicon-remove"></i>';
					}
					if(valores[i]['doc_estado']=="RECHAZADO" && valores[i]['num_proceso']==1 && valores[i]['archivo_etapa1_v3']== null && valores[i]['archivo_etapa1_v2'] != null){
						btn_v3 = `<button name='`+valores[i][0]+`*`+valores[i][1]+`*`+valores[i][2]+`*`+valores[i][3]+`*`+valores[i][4]+`*`+valores[i][5]+`*`+valores[i][6]+`*`+valores[i][7]+`*`+valores[i][8]+`*`+valores[i][9]+`*`+valores[i][10]+`*`+valores[i][11]+`*`+valores[i][12]+`*`+valores[i][13]+`*`+valores[i][14]+`' class='btn btn-primary' onclick='AbrirModalSubirArchivov3(this)'><i class='glyphicon glyphicon-upload'></i></button>`;
					}else{
						btn_v3 = '<i class="glyphicon glyphicon-remove"></i>';
					}
					if(valores[i]['anexo_seis']!="null" && valores[i]['anexo_seis_2']=='null' && valores[i]['anexo_seis_3']== 'null'){
						console.log(1);
						btn_a6 = `<a target="_blank" class='btn btn-primary' href="../`+valores[i]['anexo_seis']+`"><i class='glyphicon glyphicon-upload'></i></button>`;
					}else if(valores[i]['anexo_seis_2']!='null' && valores[i]['anexo_seis_3']== 'null'){
						console.log(2);
						btn_a6 = `<a target="_blank" class='btn btn-primary' href="../`+valores[i]['anexo_seis_2']+`"><i class='glyphicon glyphicon-upload'></i></button>`;
					}else if(valores[i]['anexo_seis_3']!= 'null'){
						console.log(valores[i]['anexo_seis_3']);
						btn_a6 = `<a target="_blank" class='btn btn-primary' href="../`+valores[i]['anexo_seis_3']+`"><i class='glyphicon glyphicon-upload'></i></button>`;
					}
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_v2+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_v3+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_a6+"</td>";
					if (valores[i][5]=="INACTIVO") {
						cadena += "<tdstyle = 'text-align: center;width: 30px;word-wrap: break-word;'> <span class='badge bg-danger' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}else if (valores[i][5]=="PENDIENTE") {
						cadena += "<td style = 'text-align: center;width: 30px;word-wrap: break-word;'> <span class='badge bg-warning' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}else
					{
						cadena += "<td style = 'text-align: center;width: 30px;word-wrap: break-word;'> <span class='badge bg-success' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}
					cadena += "</tr>";
			}
			$("#tbody_tabla_seguimiento").html(cadena);
		}
		else{
			var cadena ="<tr style = 'text-align: center'><td colspan='7'><strong>No se encontraron registros</strong></td></tr>";
			$("#tbody_tabla_seguimiento").html(cadena);
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
function buscardocumento(){
	var id = $("#txtdocumento").val();
	filtrar_seguimiento_modal(id);
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
	})
	.done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
				$('#modal_datos_remitente_documento_modal').modal({backdrop: 'static', keyboard: false})
				$('#modal_datos_remitente_documento_modal').modal('show');
			var cadena="";
			for (var i = 0; i < data.length; i++) {
				$('#txtdatosremitente').val(data[i][0]);
				$('#txtdniremitente').val(data[i][1]);
				$('#txttelefonoremitente').val(data[i][2]);	
			}			
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
function AbrirModalSubirArchivov2(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#iddocumentov2').val(datos_split[0]);
	$('#modal-subir-v2').modal({backdrop: 'static', keyboard: false})
	$('#modal-subir-v2').modal('show');
}
function registrar_documento_v2(){
	$.ajax({
	  type : 'POST',
	  url:'controlador/seguimiento/controlador_registrar_documento_v2.php',
	  data:  new FormData(document.getElementById("form-upload-file-v2")),
	  contentType: false,
	  cache: false,
	  processData:false,
	  success:function(resp) {
		swal(resp,"","info");
		$('#modal-subir-v2').modal('hide');
		filtrar_seguimiento_modal($('#txtdocumento').val());
	  }
	});
}
function AbrirModalSubirArchivov3(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#iddocumentov3').val(datos_split[0]);
	$('#modal-subir-v3').modal({backdrop: 'static', keyboard: false})
	$('#modal-subir-v3').modal('show');
}
function registrar_documento_v3(){
	$.ajax({
	  type : 'POST',
	  url:'controlador/seguimiento/controlador_registrar_documento_v3.php',
	  data:  new FormData(document.getElementById("form-upload-file-v3")),
	  contentType: false,
	  cache: false,
	  processData:false,
	  success:function(resp) {
		swal(resp,"","info");
		$('#modal-subir-v3').modal('hide');
		filtrar_seguimiento_modal($('#txtdocumento').val());
	  }
	});
}