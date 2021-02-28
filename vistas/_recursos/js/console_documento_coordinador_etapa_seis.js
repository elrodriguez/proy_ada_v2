function listar_documento_vista_revisor(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/documento/controlador_ListarBuscar_documento_coordinador_etapa_seis.php',
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
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center;color:#fff;width: 80px;word-wrap: break-word;'>ID</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 20px;word-wrap: break-word;'>TÍTULO</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 150px;word-wrap: break-word;'>ASESOR</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 150px;word-wrap: break-word;'>TESISTAS</th>";
				cadena += "<th colspan=2 style = 'text-align: center;color:#fff;width: 30px;word-wrap: break-word;'>A-16 TESIS</th>";
				cadena += "<th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;'>JURADO</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 20px;word-wrap: break-word;'></th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 20px;word-wrap: break-word;'>ENVIAR CORREO</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 10px;word-wrap: break-word;''>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";
					cadena += "<td  style = 'width: 80px;word-wrap: break-word;color:#9B0000; text-align:center;font-weight: bold;'>"+valores[i][0]+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"' class='btn btn-info' title='Vista previa del asunto' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalAsuntoDocumento(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td  style = 'width: 30px;word-wrap: break-word;color:#9B0000;'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][6]+"*asesor' class='btn btn-info' title='Vista previa de los Datos del asesor' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalVerAsesor(this)'><span class='fa fa-eye' style='color: #000000'></span></button></td>";
					cadena += `<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>`+valores[i]['ciudadanos_nombres']+`</td>`;
				
					if (valores[i]['anexo_siete']==0) {
						cadena += `<td><button class='btn-noexist'></button></td>`;
					} else {
						cadena += `<td style = 'width: 80px;word-wrap: break-word;color:#9B0000;'><button type='button' class='btn btn-exist' onclick='modalveranexos("A7","`+valores[i][0]+`","`+valores[i]['anexo_siete']+`")' ><br>A-16</button></td>`;
					}
					if (valores[i]['anexo_ocho']==0) {
						cadena += `<td><button class='btn-noexist'></button></td>`;
					} else {
						cadena += `<td style = 'width: 80px;word-wrap: break-word;color:#9B0000;'><button type='button' class='btn btn-exist' onclick='modalveranexos("A8","`+valores[i][0]+`","`+valores[i]['anexo_ocho']+`")' ><br>TESIS</button></td>`;

					}

					cadena += `<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>`;

					if(valores[i]['anexo_siete'] != '0' && valores[i]['anexo_ocho'] != '0'){
						cadena += `<button name='agregar_revisor_`+valores[i][0]+`' class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' title='ASIGNAR JURADO' onclick='AbrirModalRevisorAgregar("`+valores[i][0]+`")'><i class='glyphicon glyphicon-user' style='color:#000000;'></i></button>`;
					}

					cadena += `</td>`;
					cadena += "&nbsp;</button> </td>";

					cadena += `<td><button class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' type="button" onclick="abrirmodalcombodetalle(this)" name="`+valores[i][0]+`*`+valores[i]['tipo_publicacion']+`*`+valores[i]['nombre_revista']+`"><i class="glyphicon glyphicon-edit" style='color:#000000;'></i></button></td>`;

					cadena += "<td style = 'text-align: center;width: 10px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][2]+"*"+valores[i][3]+"' class='btn btn-correo' onclick='AbrirModalenviarcorreorevisor(this)'><span class='fa fa-envelope fa-2x'></span>";

					cadena += `<td style = 'text-align: center;' title='`+valores[i][5]+`'>`;

					if(valores[i]['num_proceso'] =='6'){
							cadena += `<button class="btn btn-aceptar btn-sx" onclick='rechazarproceso("`+valores[i][0]+`","PENDIENTE","7")'>Aceptar</button>
							<br><br><button class="btn btn-rechazar btn-sx" onclick='rechazarproceso("`+valores[i][0]+`","RECHAZADO","6")'>Rechazar</button>`;
					}else{
						cadena += "<i class='glyphicon glyphicon-ok' style='color:#000000;'></i>";
					}
					cadena +="</td>";
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
				cadena += "<th style = 'text-align: center;width: 30px;word-wrap: break-word;'>REMITENTE</th>";
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

function AbrirModalRevisorAgregar(control){
	$('#coidgo-documento-tesis').val(control);
	$.ajax({
		url:'../controlador/documento/controlador_documento_traeremitente_jurado.php',
		type:'POST',
		data:{
			codigo:control
		}
	}).done(function(resp) {

		var data = JSON.parse(resp);
		if (data.length > 0) {
			$('#modal_asignar_revisor_documento').modal({backdrop: 'static', keyboard: false})
			$("#modal_asignar_revisor_documento").modal('show');
			var cadena='<option>Seleccionar</option>';
			for (var i = 0; i < data.length; i++) {
				var estado = '';
				if(data[i]['revisor']!='0'){
					estado = 'disabled';
				}
				cadena+=`<option `+estado+` value="`+data[i]['asesor_cod']+`">`+data[i]['dni']+` - `+data[i]['nombre']+` `+data[i]['apellido_pater']+` `+data[i]['apellido_mater']+`</option>`;
			}
			$('#select-revisor-documento').html(cadena)
			$('#select-revisor-documento').select2()
			$('#txtiddocumento1_modal').html(control)
			listarrevisorentabla(control);
		}
	})

}
function listarrevisorentabla(control) {
	$.ajax({
		url:'../controlador/documento/controlador_documento_traeremitente_jurador_listar.php',
		type:'POST',
		data:{
			codigo:control
		}
	}).done(function(resp) {
		var cadena='';
		var data = JSON.parse(resp);
		if (data.length > 0) {

			for (var i = 0; i < data.length; i++) {
				cadena+=`<tr>
							<td>`+data[i]['dni']+`</td>
							<th>`+data[i]['nombre']+` `+data[i]['apellido_pater']+` `+data[i]['apellido_mater']+`</td>
							<td>`+data[i]['celular']+`</td>`;
							if(data[i]['tipo']=='I'){
								cadena+=`<td>Independiente</td>`;
							}else if(data[i]['tipo']=='C'){
								cadena+=`<td>Comisión</td>`;
							}else if(data[i]['tipo']=='D'){
								cadena+=`<td>Docente del curso</td>`;
							}
							if(data[i]['modalidad']=='I'){
								cadena+=`<td>Investigador asociado</td>`;
							}else if(data[i]['modalidad']=='T'){
								cadena+=`<td>Titular</td>`;
							}else if(data[i]['modalidad']=='N'){
								cadena+=`<td>Ninguno</td>`;
							}
				cadena+=`<td class="text-center" onclick="eliminarrevisordocumento('`+data[i]['id']+`')"><i class="glyphicon glyphicon-remove"></i></td>
						</tr>`;
			}

		}
		$('#tbody-tabla-revisor-tesis').html(cadena)
	})
}
function eliminarrevisordocumento(id){
	$.ajax({
		url:'../controlador/documento/controlador_eliminar_jurado.php',
		type:'POST',
		data:{id:id}
	}).done(function(resp) {
		if (resp > 0) {
			$("#modal_asignar_revisor_documento").modal('hide');
		}else{
			swal("no se registro","","error");
		}
	})

}
function registrarrevisordocumento(){
	var revisor = $('#select-revisor-documento').val();
	var modalidad = $('#select-revisor-documento-modalidad').val();
	var tipo = $('#select-revisor-documento-tipo').val();
	var documento = $('#coidgo-documento-tesis').val();
	$.ajax({
		url:'../controlador/documento/controlador_registrar_jurado.php',
		type:'POST',
		data:{iddocumento:documento,revisor:revisor,tipo:tipo,modalidad:modalidad}
	}).done(function(resp) {
		if (resp > 0) {
			listarrevisorentabla(documento);
			$("#modal_asignar_revisor_documento").modal('hide');
			swal("","Se registro correctamente","success");

		}else{
			swal("no se registro","","error");
		}
	})

}
//FIN DE LISTAR DOCUMENTOS
function AbrirModalVerAsesor(control) {
	var datos = control.name;
	var datos_split = datos.split("*");
	$.ajax({
		url:'../controlador/documento/controlador_documento_traeremitente_asesor_listar.php',
		type:'POST',
		data:{
			codigo:datos_split[0]
		}
	}).done(function(resp) {
		$('#modal_ver_asesor_documento').modal({backdrop: 'static', keyboard: false})
		$("#modal_ver_asesor_documento").modal('show');
		var cadena='';
		var data = JSON.parse(resp);
		if (data.length > 0) {

			for (var i = 0; i < data.length; i++) {
				cadena+=`<tr>
							<td>`+data[i]['dni']+`</td>
							<th>`+data[i]['nombre']+` `+data[i]['apellido_pater']+` `+data[i]['apellido_mater']+`</td>
							<td>`+data[i]['celular']+`</td>
						</tr>`;
			}

		}
		$('#tbody-tabla-asesor-tesis').html(cadena)
		$('#txtiddocumento1_modal_asesor').html(datos_split[0])
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
	})
	.done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
				$('#modal_datos_remitente_documento_modal').modal({backdrop: 'static', keyboard: false})
				$('#modal_datos_remitente_documento_modal').modal('show');
			var cadena='';
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
		url:'../controlador/documento/controlador_registrar_documento.php',
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
        url:'../controlador/documento/controlador_registrar_documento.php',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success:function(resp) {
          if(resp>0){
          	document.getElementById("create-form-documento").reset();
            swal("Proyecto Tesis Registrado!", "", "success")
			.then ( ( value ) =>  {
				  $("#main-content").load("Documento/vista_documento_listar.php");
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
//=============================================================================================================================
//=============================================================================================================================
//===================================================VERIFICAR DOCUMENTO PENDIENTE=============================================
//=============================================================================================================================
//=============================================================================================================================
						// COORDINADOR
function listar_verificardocumento_vista_coordinador(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/documento/controlador_ListarBuscar_documentopendiente_coordinador.php',
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
				cadena += "<th style = 'text-align: center;color:#fff;width: 80px;word-wrap: break-word;'>ID</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 50px;word-wrap: break-word;'>TÍTULO</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 130px;word-wrap: break-word;'>FECHA RECEPCI&OacuteN</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 100px;word-wrap: break-word;'>&Aacute;REA ASIGNADA</th>"
				cadena += "<th style = 'text-align: center;color:#fff;width: 100px;word-wrap: break-word;''>TIPO DOCUMENTO</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 20px;word-wrap: break-word;'>TESISTA</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 20px;word-wrap: break-word;'>ARCHIVO</th>";
				cadena += "<th style = 'text-align: center;color:#fff;width: 200px;word-wrap: break-word;'>ESTADO</th>";
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
					}else
					{
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
function modalverturnitingcoordinador(porcentaje,title,url){
	var contenidotitulo = '<p><strong>'+title+'</strong> Porcentaje: '+porcentaje+'</p>';
	var iframehtml = `<iframe id="iframemodalturniting" src="../controlador/documento/`+url+`" width="100%" height="500" frameborder="0" scrolling="no"></iframe>`;
	$('#modal-title-tirniting').html(contenidotitulo);
	$('#modal-body-turniting').html(iframehtml);
	$('#modal-ver-turniting').modal('show');
}
function rechazarproceso(codigo,estado,etapa){
	swal({
		title: "¿Estas segur@?",
		text: "Una vez "+estado+", ¡no podrá restaurar!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			$.ajax({
				url:'../controlador/documento/controlador_documento_coordinador_rechazado.php',
				type:'POST',
				data:{
					codigo:codigo,estado:estado,etapa:etapa
				}
			}).done(function(resp){
				listar_documento_vista_revisor("","1");
				if (resp>0) {

				}else{
					swal("No se pudo Rechazar la solicitud","","error");
				}
			})
		}
	  });
}
function AbrirModalenviarcorreorevisor(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#iddocumentomodal-1').val(datos_split[0]);
	$('#modal-enviar-correo-revisor').modal({backdrop: 'static', keyboard: false})
	$('#modal-enviar-correo-revisor').modal('show');
}
function enviarcorreopordocumentorevisor(){
	var doc = $('#iddocumentomodal-1').val();
	var correo = $('#correo-modal').val();
	$.get( "../controlador/documento/controlador_enviar_correo_tisista_resolucion.php?doc="+doc+'&correo='+correo, function( data ) {
		listar_documento_vista_revisor("","1");
		alert("El foreo se envio satisfactoriamente");
	});
}
function AbrirModalSubirArchivoAnexos(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#iddocumentoanexos').val(datos_split[0]);
	$('#modal-subir-anexos').modal({backdrop: 'static', keyboard: false})
	$('#modal-subir-anexos').modal('show');
}
function registrar_documento_anexos(){
	$.ajax({
	  type : 'POST',
	  url:'../controlador/documento/controlador_registrar_documento_coordinador_resolucion.php',
	  data:  new FormData(document.getElementById("form-upload-file-anexos")),
	  contentType: false,
	  cache: false,
	  processData:false,
	  success:function(resp) {
		if(resp>0){
		  $('#modal-subir-anexos').modal('hide');
			document.getElementById("form-upload-file-anexos").reset();
		  	swal("Anexos Registrado!", "", "success").then ( ( value ) =>  {
				$("#main-content").load("Documento/vista_documento_listar_administrar_revisor.php");
		  });
		}else{
		  var filet1 = $("#file-a1").val();
		  if (filet1 == null || file1 == '') {
			  return swal("Falta seleccionar anexo 1","","error");
		  }
		  var file6 = $("#file-a6").val();
		  if (file6 == null || file6 == '') {
			  return swal("Falta seleccionar anexo 6","","error");
		  }
		}
	  }
	});
}
function modalveranexos(anexo,title,url){
	var contenidotitulo = '<p><strong>'+title+'</strong> Archivo: '+anexo+'</p>';
	var iframehtml = `<iframe id="iframemodalanexo" src="../`+url+`" width="100%" height="500" frameborder="0" scrolling="no"></iframe>`;
	$('#modal-title-anexos').html(contenidotitulo);
	$('#modal-body-anexos').html(iframehtml);
	$('#modal-ver-anexos').modal('show');
}
function generar_resolucion_word(documento){
	$('#iframe-word-descarga').attr('src','http://proyada.local/controlador/documento/controlador_generar_resolucion_revisor.php?doc='+documento);
}
function registrarfechas(e,t,d){
	$.ajax({
		type : 'POST',
		url:'../controlador/documento/controlador_registrar_documento_fechas.php',
		data:  {
			tipo:t,fecha:e.target.value,codigo:d
		},
		success:function(resp) {
		  if(resp>0){

		  }else{

		  }
		}
	  });
}
function abrirmodalcombodetalle(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	if(datos_split[1] == '2' || datos_split[1] == '3'){
		$('#div_nombre_revista').css('display', 'block');
	}else{
		$('#div_nombre_revista').css('display', 'none');
	}
	$('#tipo_publicacion').val(datos_split[1]);
	$('#nombre_revista').val(datos_split[2]);
	$('#tipopublicacioniddociuemneto').val(datos_split[0]);
	$('#myModalLabelComboDrop').html(datos_split[0]);
	$('#myModalComboDrop').modal('show');
}
function abririnputadicional(){
	var tt = $('#tipo_publicacion').val();
	if(tt == '2' || tt == '3'){
		$('#div_nombre_revista').css('display', 'block');
	}else{
		$('#div_nombre_revista').css('display', 'none');
	}
}
function registrartipopublicacion(){
	$.ajax({
		type : 'POST',
		url:'../controlador/documento/controlador_registrar_documento_tipo_publicacion.php',
		data:  new FormData(document.getElementById("formtipopublicacion")),
		contentType: false,
		cache: false,
		processData:false,
		success:function(resp) {
		  if(resp>0){
			listar_documento_vista_revisor("","1");
		  }else{

		  }
		}
	  });
}
