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
					cadena += "<td align='center' hidden>"+valores[i]['asesor_cod']+"</td>";
					cadena += "<td>"+valores[i]['modalidad']+"</td>";
					cadena += "<td>"+valores[i]['descripcion']+"</td>";
					cadena += "<td>"+valores[i]['nombre_completo']+"</td>";
					cadena += "<td>"+valores[i]['tipo']+"</td>";
					cadena += "<td>"+valores[i]['categoria']+"</td>";
					cadena += "<td></td>";
					cadena += "<td>"+valores[i]['por_pagar_fecha']+"</td>";
					cadena += "<td><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][2]+"*"+valores[i][3]+"*"+valores[i][4]+"*"+valores[i][5]+"*"+valores[i][6]+"*"+valores[i][7]+"*"+valores[i][8]+"*"+valores[i][9]+"*"+valores[i][10]+"*"+valores[i][11]+"*"+valores[i][12]+"*"+valores[i][13]+"*"+valores[i][14]+"' class='btn btn-primary' onclick='AbrirModalEditarPersonal(this)'><span class='glyphicon glyphicon-pencil'></span>";
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
					cadena += "<td align='center' hidden>"+valores[i]['asesor_cod']+"</td>";
					cadena += "<td>"+valores[i]['modalidad']+"</td>";
					cadena += "<td>"+valores[i]['descripcion']+"</td>";
					cadena += "<td>"+valores[i]['nombre_completo']+"</td>";
					cadena += "<td>"+valores[i]['tipo']+"</td>";
					cadena += "<td>"+valores[i]['categoria']+"</td>";
					cadena += "<td></td>";
					cadena += "<td>"+valores[i]['por_pagar_fecha']+"</td>";
					cadena += "<td><button name='"+valores[i][0]+"*"+valores[i][1]+"*"+valores[i][2]+"*"+valores[i][3]+"*"+valores[i][4]+"*"+valores[i][5]+"*"+valores[i][6]+"*"+valores[i][7]+"*"+valores[i][8]+"*"+valores[i][9]+"*"+valores[i][10]+"*"+valores[i][11]+"*"+valores[i][12]+"*"+valores[i][13]+"*"+valores[i][14]+"' class='btn btn-primary' onclick='AbrirModalEditarPersonal(this)'><span class='glyphicon glyphicon-pencil'></span>";
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
