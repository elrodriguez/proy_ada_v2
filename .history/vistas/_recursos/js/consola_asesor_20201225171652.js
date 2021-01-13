function Limpieza_post_personal(){
	$("#txtPersonaNombre").val("");
	$("#txtApellidoPaterno").val("");
	$("#txtApellidoMaterno").val("");
	$("#txtDireccion").val("");	
	$("#txtDNI").val("");
	$("#txtGenero").val("");
	$("#txtFechaNacimiento").val("");
	$("#txtDistrito").val("");	
	$("#txtProvincia").val("");	
	$("#txtDepartamento").val("");
	$("#txtDireccion").val("");
	$("#txtTelefono").val("");
	$("#txtEmail").val("");
	$("#combo_TipoPersonal").val(1);
	$('#id_archivo_Fotografia').fileinput('reset');
	$("#main-content").load("Personal/vista_listar_personal.php") 
}
function listar_asesor_vista(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/personal/controlador_ListarBuscar_docente.php',
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
				cadena += "<th>NOMBRE Y APELLIDOS</th>";
				cadena += "<th style = 'text-align: center'>DNI</th>";
				cadena += "<th style = 'text-align: center'>EMAIL</th>";
				cadena += "<th style = 'text-align: center'>FECHA NACIMIENTO</th>";
				cadena += "<th style = 'text-align: center'>CELULAR</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";			
					cadena += "<td align='center' hidden>"+valores[i][0]+"</td>";
					cadena += "<td>"+valores[i][1]+" "+valores[i][2]+" "+valores[i][3]+"</td>";
					cadena += "<td align='center'>"+valores[i][4]+"</td>";
					cadena += "<td align='center'>"+valores[i][5]+"</td>";
					cadena += "<td style='color:#9B0000; text-align:center;font-weight: bold;'>"+valores[i][12]+"</td>";
					cadena += "<td style='color:#9B0000; text-align:center;font-weight: bold;'>"+valores[i][7]+"</td>";
					if (valores[i][12]=="INACTIVO") {
						cadena += "<td style = 'text-align: center'> <span class='badge bg-danger' style='color:White;'>"+valores[i][9]+"</span> </td>";
					}else{
						cadena += "<td  style = 'text-align: center'> <span class='badge bg-success' style='color:White;'>"+valores[i][9]+"</span> </td>";
					}
					cadena += "<td><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][2]+"*"+valores[i][3]+"*"+valores[i][4]+"*"+valores[i][5]+"*"+valores[i][6]+"*"+valores[i][7]+"*"+valores[i][8]+"*"+valores[i][9]+"*"+valores[i][10]+"*"+valores[i][11]+"*"+valores[i][12]+"*"+valores[i][13]+"' class='btn btn-primary' onclick='AbrirModalEditarPersonal(this)'><span class='glyphicon glyphicon-pencil'></span>";
					cadena += "</button></td> ";
					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#lista_personal_tabla").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5); 
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_asesor_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_asesor_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
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
						paginar += "<li><a href='javascript:void(0)' onclick='listar_asesor_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_asesor_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_asesor_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
				}
				else{
					paginar += "<li class='disabled'><a href='javascript:void(0)'>Siguiente</a></li>";
					paginar += "<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
				}
				paginar += "</ul>";
				$("#paginador_personal_tabla").html(paginar);
			}else{
				var cadena = "";
				cadena += "<table  class='table table-condensed jambo_table'>";
				cadena += "<thead  class=''>";
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center' hidden='true' >ID</th>";
				cadena += "<th style = 'text-align: center'>NOMBRE Y APELLIDOS</th>";
				cadena += "<th style = 'text-align: center'>DNI</th>";
				cadena += "<th style = 'text-align: center'>SEXO</th>";
				cadena += "<th style = 'text-align: center'>FECHA NACIMIENTO</th>";
				cadena += "<th style = 'text-align: center'>USUARIO</th>";
				cadena += "<th style = 'text-align: center'>ESTADO</th>";
				cadena += "<th>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				cadena +="<tr style = 'text-align: center'><td colspan='8'><strong>No se encontraron registros</strong></td></tr>";
				cadena += "</tbody>";
				cadena += "</table>";
				$("#lista_personal_tabla").html(cadena);
				$("#paginador_personal_tabla").html("");
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown, jqXHR){
			alert("SE PRODUJO UN ERROR");
		}
	});
}
function AbrirModalEditarPersonal(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	$('#modal_editar_asesor').modal({backdrop: 'static', keyboard: false})
	$('#modal_editar_asesor').modal('show');
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
function Editar_asesor(){
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
		url:'../controlador/personal/controlador_editar_personal.php',
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
			  listar_asesor_vista(dato_buscar,'1');
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
function revisar_dni_asesor(){
	var nombre    = $("#txtnombre").val();
	var apepat    = $("#txtapellidopaterno").val();
	var apemat    = $("#txtapellidomaterno").val();
	var fecha     = $("#txtfecha").val();
	var direccion = $("#txtdireccion").val();
	var dni       = $("#txtdni").val();
	var tipo      = $("#cboTipo").val();
	
	if (nombre.length>0  && apemat.length>0 && apepat.length>0 && fecha.length>0 && direccion.length>0 ) {
	}else{
		return swal("Faltan Llenar Datos","","info");
	}
	if (dni.length==0 ) {
		return swal("Faltan Llenar Su Documento de Identidad","","info");
	}

	if (tipo==null) {
		return swal("Falta Seleccionar el Tipo de usuario","","error");
	}
	$.ajax({
		url:'../controlador/ciudadano/controlador_verificar_existencia_dni.php',
		type:'POST',
		data:{
			dni:dni
		}
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length<=0) {
			Registrar_personal();
			
		}else{
			swal("Lo sentimos el DNI Ingresado ya esta siendo utilizado por otro personal","","warning");
		}
	})
}
function Registrar_personal(){
	var Tipo = $('#cboTipo').val();
	if (Tipo==null || Tipo=='') {
		return swal("Falta Seleccionar el Tipo de usuario","","error");
	}
	$.ajax({
		url:'../controlador/personal/controlador_registrar_docente.php',
		type:'POST',
		data: $('#form-registrar-docente').serialize()
	})
	.done(function(resp){
		if (resp > 0) {
			 swal("Datos Registrados!", "", "success")
			 .then ( ( value ) =>  { 
				  $("#main-content").load("Personal/vista_listar_personal.php"); 
			});
			
		}
		else{
			swal("! Registro no completado!", "", "error");	
		}
	})		
}
function Listar_tipousuario_combo() {
	$.ajax({
		url:'../controlador/personal/controlador_combolistar_tipousuario.php',
		type:'POST'
	})
	.done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
			var cadena = "";
				cadena += "<option value='otro'>"+"SELECCIONAR TIPO USUARIO"+"</option>";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#cmbTipousuario").html(cadena);	
		}
		else{
			var cadena = "<option value='NO'>no se encontraron tipo de usuario Disponibles</option>";
			$("#cmbTipousuario").html(cadena);
		}
	})
}
function Listar_tipo_docente_combo() {
	$.ajax({
		url:'../controlador/personal/controlador_combolistar_tipo_docente.php',
		type:'POST'
	})
	.done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length > 0) {
			var cadena = "";
				cadena += "<option value='otro'>"+"SELECCIONAR TIPO"+"</option>";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#cboTipo").html(cadena);	
		}
		else{
			var cadena = "<option value='NO'>no se encontraron tipo Disponibles</option>";
			$("#cboTipo").html(cadena);
		}
	})
}