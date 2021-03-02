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
			var cadena = ``;
			for (var i = 0; i < valores.length; i++) {
				cadena += "<tr>";
					cadena += "<td  style = 'width: 80px;word-wrap: break-word;color:#9B0000; text-align:center;font-weight: bold;'>"+valores[i][0]+"</td>";
					cadena += "<td style = 'text-align: center;width: 50px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"' class='btn btn-info' title='Vista previa del asunto' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalAsuntoDocumento(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td style = 'text-align: center;width: 40px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][6]+"' class='btn btn-info' title='Vista previa de los Datos del remitente' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalVerRemitente(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][9]+"' class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' title='Ver documento Cargado' onclick='AbrirModalArchivo_documento(this)'><i class='fa  fa-folder-open' style='color:orange;'></i></button></td>";
					if(valores[i]['doc_estado']=="RECHAZADO" && valores[i]['num_proceso']==1 && valores[i]['archivo_etapa1_v2'] == '0'){
						btn_v2 = `<button name='`+valores[i][0]+`*`+valores[i][1]+`*`+valores[i][2]+`*`+valores[i][3]+`*`+valores[i][4]+`*`+valores[i][5]+`*`+valores[i][6]+`*`+valores[i][7]+`*`+valores[i][8]+`*`+valores[i][9]+`*`+valores[i][10]+`*`+valores[i][11]+`*`+valores[i][12]+`*`+valores[i][13]+`*`+valores[i][14]+`' class='btn btn-primary' onclick='AbrirModalSubirArchivov2(this)'><i class='glyphicon glyphicon-upload'></i></button>`;
					}else{
						btn_v2 = '<i class="glyphicon glyphicon-remove"></i>';
					}
					if(valores[i]['doc_estado']=="RECHAZADO" && valores[i]['num_proceso']==1 && valores[i]['archivo_etapa1_v3']== '0' && valores[i]['archivo_etapa1_v2'] != '0'){
						btn_v3 = `<button name='`+valores[i][0]+`*`+valores[i][1]+`*`+valores[i][2]+`*`+valores[i][3]+`*`+valores[i][4]+`*`+valores[i][5]+`*`+valores[i][6]+`*`+valores[i][7]+`*`+valores[i][8]+`*`+valores[i][9]+`*`+valores[i][10]+`*`+valores[i][11]+`*`+valores[i][12]+`*`+valores[i][13]+`*`+valores[i][14]+`' class='btn btn-primary' onclick='AbrirModalSubirArchivov3(this)'><i class='glyphicon glyphicon-upload'></i></button>`;
					}else{
						btn_v3 = '<i class="glyphicon glyphicon-remove"></i>';
					}
          // ANEXO 6 primer revisor
					if(valores[i]['anexo_seis']!='0' && valores[i]['anexo_seis_2']=='0' && valores[i]['anexo_seis_3']== '0'){
						btn_a6 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis']+`"><i class='glyphicon glyphicon-cloud-download'></i></button>`;
					}else if(valores[i]['anexo_seis_2']!='0' && valores[i]['anexo_seis_3']== '0'){
						btn_a6 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis_2']+`"><i class='glyphicon glyphicon-cloud-download'></i></button>`;
					}else if(valores[i]['anexo_seis_3']!='0'){
						btn_a6 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis_3']+`"><i class='glyphicon glyphicon-cloud-download'></i></button>`;
					}else{
						btn_a6 = '';
					}
          //anexo 6 revisor 2
          if(valores[i]['anexo_seis_uno_r2']!='0' && valores[i]['anexo_seis_dos_r2']=='0' && valores[i]['anexo_seis_tres_r2']== '0'){
            btn_a62 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis_uno_r2']+`"><i class='glyphicon glyphicon-search'></i></button>`;
          }else if(valores[i]['anexo_seis_dos_r2']!='0' && valores[i]['anexo_seis_tres_r2']== '0'){
            btn_a62 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis_dos_r2']+`"><i class='glyphicon glyphicon-search'></i></button>`;
          }else if(valores[i]['anexo_seis_tres_r2']!='0'){
            btn_a62 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis_tres_r2']+`"><i class='glyphicon glyphicon-search'></i></button>`;
          }else{
            btn_a62 = '';
          }
          //anexo 6 revisor 3
          if(valores[i]['anexo_seis_uno_r3']!='0' && valores[i]['anexo_seis_dos_r3']=='0' && valores[i]['anexo_seis_tres_r3']== '0'){
            btn_a63 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis_uno_r3']+`"><i class='glyphicon glyphicon-search'></i></button>`;
          }else if(valores[i]['anexo_seis_dos_r3']!='0' && valores[i]['anexo_seis_tres_r3']== '0'){
            btn_a63 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis_dos_r3']+`"><i class='glyphicon glyphicon-search'></i></button>`;
          }else if(valores[i]['anexo_seis_tres_r3']!='0'){
            btn_a63 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['anexo_seis_tres_r3']+`"><i class='glyphicon glyphicon-search'></i></button>`;
          }else{
            btn_a63 = '';
          }
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_v2+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_v3+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_a6+"</td>";
          cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_a62+"</td>";
          cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_a63+"</td>";


					if(valores[i]['num_proceso'] == '3' && valores[i]['doc_estado'] == 'RECHAZADO'){
						btn_subir_nuevos = `<button type="button" class="btn btn-primary" name="`+valores[i][0]+`*`+valores[i]['anexo_uno_etapa_tres']+`*`+valores[i]['proyecto_etapa_tres']+`*`+valores[i]['carta_etapa_tres']+`" onclick="modalsubircorreciones(this)">
												<i class="glyphicon glyphicon-open"></i>
					  						</button>`;
					}else{
						btn_subir_nuevos = '';
					}
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_subir_nuevos+"</td>";
					if(valores[i]['num_proceso'] == '4' && valores[i]['doc_estado'] == 'RECHAZADO'){
						btn_subir_1_etapa4 = `<button type="button" class="btn btn-primary" name="`+valores[i][0]+`*`+valores[i]['anexo_uno_etapa_cuatro']+`" onclick="modalsubircorrecionesetapacuatro(this,'9')">
												<i class="glyphicon glyphicon-open"></i>
											  </button>`;
						btn_subir_2_etapa4 = `<button type="button" class="btn btn-primary" name="`+valores[i][0]+`*`+valores[i]['carta_etapa_cuatro']+`" onclick="modalsubircorrecionesetapacuatro(this,'10')">
												<i class="glyphicon glyphicon-open"></i>
											  </button>`;
						btn_ver_1_etapa4 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['etica_anexo_uno']+`"><i class='glyphicon glyphicon-search'></i></button>`;
						if(valores[i]['etica_anexo_cuatro']!='0' && valores[i]['etica_anexo_cuatro_dos']=='0' && valores[i]['etica_anexo_cuatro_tres']== '0'){
							btn_ver_4_etapa4 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['etica_anexo_cuatro']+`"><i class='glyphicon glyphicon-search'></i></button>`;
						}else if(valores[i]['etica_anexo_cuatro_dos']!='0' && valores[i]['etica_anexo_cuatro_tres']== '0'){
							btn_ver_4_etapa4 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['etica_anexo_cuatro_dos']+`"><i class='glyphicon glyphicon-search'></i></button>`;
						}else if(valores[i]['etica_anexo_cuatro_tres']!='0'){
							btn_ver_4_etapa4 = `<a target="_blank" class='btn btn-info' href="../`+valores[i]['etica_anexo_cuatro_tres']+`"><i class='glyphicon glyphicon-search'></i></button>`;
						}else{
							btn_ver_4_etapa4 = '';
						}

					}else{
						btn_subir_1_etapa4 = '';
						btn_subir_2_etapa4 = '';
						btn_ver_1_etapa4 = '';
						btn_ver_4_etapa4 = '';
					}
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_ver_1_etapa4+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_ver_4_etapa4+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_subir_1_etapa4+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_subir_2_etapa4+"</td>";

					if(valores[i]['num_proceso'] == '6'){
						btn_subir_1_etapa6 = `<button type="button" class="btn btn-primary" name="`+valores[i][0]+`*`+valores[i]['anexo_siete']+`" onclick="modalsubircorrecionesetapacuatro(this,'11')">
												<i class="glyphicon glyphicon-open"></i>
											  </button>`;
						btn_subir_2_etapa6 = `<button type="button" class="btn btn-primary" name="`+valores[i][0]+`*`+valores[i]['anexo_ocho']+`" onclick="modalsubircorrecionesetapacuatro(this,'12')">
												<i class="glyphicon glyphicon-open"></i>
					  						</button>`;
					}else{
						btn_subir_1_etapa6 = '';
						btn_subir_2_etapa6 = '';
					}

					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_subir_1_etapa6+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_subir_2_etapa6+"</td>";

					if(valores[i]['num_proceso'] == '7' && valores[i]['doc_estado'] == 'RECHAZADO'){
						btn_ver_1_etapa7 = `<a target="_blank" href="../`+valores[i]['anexo_dies']+`" class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' title='Ver documento Cargado'><i class='fa  fa-folder-open' style='color:orange;'></i></a>`;
						btn_subir_1_etapa7 = `<button type="button" class="btn btn-primary" name="`+valores[i][0]+`*`+valores[i]['anexo_dies_dos']+`" onclick="modalsubircorrecionesetapacuatro(this,'14')">
												<i class="glyphicon glyphicon-open"></i>
											  </button>`;
						btn_subir_2_etapa7 = `<button type="button" class="btn btn-primary" name="`+valores[i][0]+`*`+valores[i]['anexo_dies_tres']+`" onclick="modalsubircorrecionesetapacuatro(this,'15')">
												<i class="glyphicon glyphicon-open"></i>
					  						</button>`;
					}else{
						btn_ver_1_etapa7 = '';
						btn_subir_1_etapa7 = '';
						btn_subir_2_etapa7 = '';
					}

					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_ver_1_etapa7+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_subir_1_etapa7+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_subir_2_etapa7+"</td>";

					if(valores[i]['num_proceso'] == '9' && valores[i]['doc_estado'] == 'RECHAZADO'){
						btn_ver_1_etapa9 = `<a target="_blank" href="../`+valores[i]['archivo_turnitin_etapa_nueve']+`" class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' title='Ver documento Cargado'><i class='fa  fa-folder-open' style='color:orange;'></i></a>`;
						btn_subir_1_etapa9 = `<button type="button" class="btn btn-primary" name="`+valores[i][0]+`*`+valores[i]['archivo_turnitin_dos_etapa_nueve']+`" onclick="modalsubircorrecionesetapacuatro(this,'23')">
												<i class="glyphicon glyphicon-open"></i>
					  						</button>`;
					}else{
						btn_ver_1_etapa9 = '';
						btn_subir_1_etapa9 = '';
					}

					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_ver_1_etapa9+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+btn_subir_1_etapa9+"</td>";

					if (valores[i][5]=="INACTIVO") {
						cadena += "<tdstyle = 'text-align: center;width: 30px;word-wrap: break-word;'> <span class='badge bg-danger' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}else if (valores[i][5]=="PENDIENTE") {
						cadena += "<td style = 'text-align: center;width: 30px;word-wrap: break-word;'> <span class='badge bg-warning' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}else{
						cadena += "<td style = 'text-align: center;width: 30px;word-wrap: break-word;'> <span class='badge bg-success' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}
          cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+valores[i]['num_proceso']+" de 9</td>";
          let porcentaje = (parseInt(valores[i]['num_proceso'])*100)/9;
          cadena += `<td style = 'text-align: center;width: 100px;word-wrap: break-word;'>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="`+Math.round(porcentaje)+`" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;width: `+Math.round(porcentaje)+`%;">
                    `+Math.round(porcentaje)+`%
                    </div>
                  </div>
                </td>`;
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
		var cadena =  '<object data="../'+datos_split[0]+'"#zoom=100" type="application/pdf" style="width: 100%; height: 100%; min-height: 480px;">';
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
function modalsubircorreciones(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	if(datos_split[1]!='0'){
		var btnverv1 = `<a target="_blank" href="../`+datos_split[1]+`" class="btn btn-default" type="button">Ver</a>`;
		$('#btnverax1').html(btnverv1);
	}
	if(datos_split[2]!='0'){
		var btnverv2 = `<a target="_blank" href="../`+datos_split[2]+`" class="btn btn-default" type="button">Ver</a>`;
		$('#btnverpc').html(btnverv2);
	}
	if(datos_split[3]!='0'){
		var btnverv3 = `<a target="_blank" href="../`+datos_split[3]+`" class="btn btn-default" type="button">Ver</a>`;
		$('#btnvercarta').html(btnverv3);
	}
	$('#iddocumentovcorrecciones').val(datos_split[0]);
	$('#subir-correciones').modal({backdrop: 'static', keyboard: false})
	$('#subir-correciones').modal('show');
}
function modalsubircorrecionesetapacuatro(control,tipo){
	var datos = control.name;
	var datos_split = datos.split("*");
	var btnverv1 ='';
	if(datos_split[1]!='0'){
		btnverv1 += `<a target="_blank" href="../`+datos_split[1]+`" class="btn btn-default" type="button">Ver</a>`;
		$('#btnverax1e4').html(btnverv1);
	}else{
		btnverv1 += '';
		$('#btnverax1e4').html(btnverv1);
	}
	if(tipo == '9'){
		$('#file-ax1-e4-title').html('A1')
		$('#tipo-e4').val('9')
	}else if(tipo == '10'){
		$('#file-ax1-e4-title').html('Carta')
		$('#tipo-e4').val('10')
	}else if(tipo == '11'){
		$('#file-ax1-e4-title').html('A7')
		$('#tipo-e4').val('11')
	}else if(tipo == '12'){
		$('#file-ax1-e4-title').html('A8')
		$('#tipo-e4').val('12')
	}else if(tipo == '14'){
		$('#file-ax1-e4-title').html('V2')
		$('#tipo-e4').val('14')
	}else if(tipo == '15'){
		$('#file-ax1-e4-title').html('V3')
		$('#tipo-e4').val('15')
	}else if(tipo == '23'){
		$('#file-ax1-e4-title').html('Correcion')
		$('#tipo-e4').val('23')
	}
	$('#iddocumentovcorreccionescuatro').val(datos_split[0]);
	$('#subir-correciones-etapa-cuatro').modal({backdrop: 'static', keyboard: false})
	$('#subir-correciones-etapa-cuatro').modal('show');
}
function registrar_documento_anexos_corregidos(){
	$.ajax({
	  type : 'POST',
	  url:'../controlador/documento/controlador_registrar_documento_coordinador_anexos_corregidos.php',
	  data:  new FormData(document.getElementById("form-upload-file-anexos-corregidos")),
	  contentType: false,
	  cache: false,
	  processData:false,
	  success:function(resp) {
		if(resp>0){
		  $('#subir-correciones').modal('hide');
			document.getElementById("form-upload-file-anexos-corregidos").reset();
		  	swal("Anexos Registrado!", "", "success").then ( ( value ) =>  {
				filtrar_seguimiento_modal($('#txtdocumento').val());
		  	});
		}
	  }
	});
}
function registrar_documento_anexos_corregidos_etapa_cuatro(){
	$.ajax({
	  type : 'POST',
	  url:'../controlador/documento/controlador_registrar_documento_coordinador_anexos_corregidos_etapa_cuatro.php',
	  data:  new FormData(document.getElementById("form-upload-file-anexos-corregidos-etapa-cuatro")),
	  contentType: false,
	  cache: false,
	  processData:false,
	  success:function(resp) {
		if(resp>0){
		  $('#subir-correciones').modal('hide');
			document.getElementById("form-upload-file-anexos-corregidos-etapa-cuatro").reset();
			$('#subir-correciones-etapa-cuatro').modal('hide');
		  	swal("Anexos Registrado!", "", "success").then ( ( value ) =>  {
				filtrar_seguimiento_modal($('#txtdocumento').val());
		  	});
		}
	  }
	});
}
