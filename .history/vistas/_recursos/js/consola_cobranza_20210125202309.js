function listar_personal_vista(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/cobranza/controlador_revisor_listado.php',
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
				cadena += "<th style = 'text-align: center;color:#fff;'>TESIS</th>";
				cadena += "<th style = 'text-align: center;' hidden='true' >ID</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Nivel</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Programa Académico</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Docente</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>TIPO (M;N)</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>CATEGORIA</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>MODALIDAD</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>FECHA REGISTRO</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['doc_asunto']+"</td>";
					cadena += "<td style = 'vertical-align: middle;' align='center' hidden>"+valores[i]['asesor_cod']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['modalidad']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['descripcion']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['nombre_completo']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['tipo']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['categoria']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['moda']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['por_pagar_fecha']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>";
					cadena += `<button onclick='cambiarestadoapagado("`+valores[i]['id']+`","1","1")'>pagado</button>`;
					cadena += "</td> ";
					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#lista_personal_tabla").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5);
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
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
						paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
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
function listar_asesor_vista(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/cobranza/controlador_asesor_listado.php',
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
				cadena += "<th style = 'text-align: center;color:#fff;'>TESIS</th>";
				cadena += "<th style = 'text-align: center;' hidden='true' >ID</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Nivel</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Programa Académico</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Docente</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>TIPO (M;N)</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>CATEGORIA</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>MODALIDAD</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>FECHA REGISTRO</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['doc_asunto']+"</td>";
					cadena += "<td style = 'vertical-align: middle;' align='center' hidden>"+valores[i]['asesor_cod']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['modalidad']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['descripcion']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['nombre_completo']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['tipo']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['categoria']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['moda']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['por_pagar_fecha']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>";
					cadena += `<button onclick='cambiarestadoapagado("`+valores[i]['id']+`","1","2")'>pagado</button>`;
					cadena += "</td> ";
					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#lista_personal_tabla").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5);
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
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
						paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
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
function listar_jurado_vista(valor,pagina){
	var pagina = Number(pagina);
	$.ajax({
		url:'../controlador/cobranza/controlador_jurado_listado.php',
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
				cadena += "<th style = 'text-align: center;color:#fff;'>TESIS</th>";
				cadena += "<th style = 'text-align: center;' hidden='true' >ID</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Nivel</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Programa Académico</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>Docente</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>TIPO (M;N)</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>CATEGORIA</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>MODALIDAD</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>FECHA REGISTRO</th>";
				cadena += "<th style = 'text-align: center;color:#fff'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['doc_asunto']+"</td>";
					cadena += "<td style = 'vertical-align: middle;' align='center' hidden>"+valores[i]['asesor_cod']+"</td>";
					cadena += "<td style = 'vertical-align: middle;' >"+valores[i]['modalidad']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['descripcion']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['nombre_completo']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['tipo']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['categoria']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['moda']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>"+valores[i]['por_pagar_fecha']+"</td>";
					cadena += "<td style = 'vertical-align: middle;'>";
					cadena += `<button onclick='cambiarestadoapagado("`+valores[i]['id']+`","1","3")'>pagado</button>`;
					cadena += "</td> ";
					cadena += "</tr>";
				}
				cadena += "</tbody>";
				cadena += "</table>";
				$("#lista_personal_tabla").html(cadena);
				var totaldatos = datos[1];
				var numero_paginas = Math.ceil(totaldatos/5);
				var paginar = "<ul class='pagination'>";
				if(pagina>1){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+1+'"'+")'>&laquo;</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+(pagina-1)+'"'+")'>Anterior</a></li>";
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
						paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+i+'"'+")'>"+i+"</a></li>";
					}
				}
				if(pagina < numero_paginas){
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+(pagina+1)+'"'+")'>Siguiente</a></li>";
					paginar += "<li><a href='javascript:void(0)' onclick='listar_personal_vista("+'"'+valor+'","'+numero_paginas+'"'+")'>&raquo;</a></li>";
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
function cambiarestadoapagado(codigo,estado,flag){
	swal({
		title: "¿Estas segur@?",
		text: "Una vez "+estado+", ¡no podrá restaurar!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			$.ajax({
				url:'../controlador/cobranza/controlador_pagar_docente.php',
				type:'POST',
				data:{
					codigo:codigo,estado:estado,flag:flag
				}
			}).done(function(resp){
				if (resp>0) {
					 swal("el docente fue pagado", {
						icon: "success",
					  });
					  if(flag=='1'){
						listar_personal_vista('','1');
					  }else if(flag=='2'){
						listar_asesor_vista('','1'); 
					  }else if(flag=='3'){
						listar_jurado_vista('','1');
					  }
				}else{
					swal("No se pudo Rechazar la solicitud","","error");
				}
			})
		}
	  });
}
function listar_documento_reporte_vista(valor,pagina){
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
				cadena += "<tr >";
				cadena += "<th style = 'text-align: center;width: 80px;word-wrap: break-word;'>ID</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;color:#fff;'>TÍTULO</th>";
				cadena += "<th style = 'text-align: center;width: 150px;word-wrap: break-word;color:#fff;'>FECHA RECEPCI&OacuteN</th>";
				cadena += "<th style = 'text-align: center;width: 150px;word-wrap: break-word;color:#fff;'>&Aacute;REA ASIGNADA</th>"
				cadena += "<th style = 'text-align: center;width: 120px;word-wrap: break-word;color:#fff;'>TIPO DOCUMENTO</th>";
				cadena += "<th style = 'text-align: center;width: 30px;word-wrap: break-word;color:#fff;'>ALUMNO</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;color:#fff;'>ARCHIVO</th>";
				cadena += "<th style = 'text-align: center;width: 30px;word-wrap: break-word;color:#fff;'>ETAPA</th>";
				cadena += "<th style = 'text-align: center;width: 30px;word-wrap: break-word;color:#fff;'>% AVANCE</th>";
				cadena += "<th style = 'text-align: center;width: 20px;word-wrap: break-word;color:#fff;'>ESTADO</th>";
				cadena += "<th style = 'text-align: center;width: 10px;word-wrap: break-word;color:#fff;'>ACCI&Oacute;N</th>";
				cadena += "</tr>";
				cadena += "</thead>";
				cadena += "<tbody>";
				for(var i = 0 ; i<valores.length; i++){
					cadena += "<tr>";
					cadena += "<td  style = 'width: 80px;word-wrap: break-word;color:#9B0000; text-align:center;font-weight: bold;'>"+valores[i][0]+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"' class='btn btn-info' title='Vista previa del asunto' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalAsuntoDocumento(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td style = 'text-align: center;width: 150px;word-wrap: break-word;'>"+valores[i][2]+"</td>";
					cadena += "<td style = 'text-align: center;width: 150px;word-wrap: break-word;'>"+valores[i][4]+"</td>";
					cadena += "<td style = 'text-align: center;width: 120px;word-wrap: break-word;'>"+valores[i][3]+"</td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][6]+"' class='btn btn-info' title='Vista previa de los Datos del remitente' style='background-color: #ffffff ; border-color: #ffffff' onclick='AbrirModalVerRemitente(this)'><span class='fa fa-eye' style='color: #000000'></span>";
					cadena += "&nbsp;</button> </td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'><button name='"+valores[i][9]+"' class='btn btn-primary btn-sx' style='background-color:#fff;border-color:#fff' title='Ver documento Cargado' onclick='AbrirModalArchivo_documento(this)'><i class='fa  fa-folder-open' style='color:orange;'></i></button></td>";
					cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'>"+valores[i]['num_proceso']+" de 9</td>";
					let porcentaje = (parseInt(valores[i]['num_proceso'])*100)/9;
					cadena += `<td style = 'text-align: center;width: 100px;word-wrap: break-word;'>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="`+porcentaje+`" aria-valuemin="0" aria-valuemax="100" style="`+porcentaje+`%;">
										`+porcentaje+`%
										</div>
									</div>
								</td>`;
					if (valores[i][5]=="INACTIVO") {
						cadena += "<tdstyle = 'text-align: center;width: 20px;word-wrap: break-word;'> <span class='badge bg-danger' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}else if (valores[i][5]=="PENDIENTE") {
						cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'> <span class='badge bg-warning' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}else
					{
						cadena += "<td style = 'text-align: center;width: 20px;word-wrap: break-word;'> <span class='badge bg-success' style='color:White;'>"+valores[i][5]+"</span> </td>";
					}
					cadena += "<td style = 'text-align: center;width: 10px;word-wrap: break-word;'><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][2]+"*"+valores[i][3]+"' class='btn btn-primary' onclick='AbrirModalDocumento(this)'><span class='glyphicon glyphicon-pencil'></span>";
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
