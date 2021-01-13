$(document).ready(function(){
    setInterval('filtrar_DocumentosPendientes()',30000);
    //setInterval('filtrar_JustificacionesPendientes()',2000);
  });
function filtrar_DocumentosPendientes(){
	$.ajax({
		url:'../controlador/Menu/controlador_VerificarDocumentos_buscar.php',
		type:'POST'
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		var con=0;
		if (data.length > 0) {
			$("#notificacion_palpante").html('<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>');
			var cadena = '';
			for (var i = 0; i < data.length; i++) {
				con++;
				if (con<=2) {
					cadena+='<li style=" padding: 5px 15px 5px 25px">';
		            cadena+='<a class="dropdown-item preview-item">';
		            cadena+='<div><strong>'+data[i][1]+'</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small style="color:red"><i class="fa fa-clock-o"></i><strong> '+data[i][0]
		            cadena+='</strong></small><br><strong>&Aacute;REA ASIGNADA: </strong>' +data[i][2];
		            cadena+='</div>';
		            cadena+='</a>';
		            cadena+='</li>';
		            cadena+='<li class="divider"></li>';
				};
            }
            if (con>1) {
            cadena+="<li class='wrapper bg-light' style='padding: 4px 0px; margin-top: -9px;margin-bottom: -5px;' onclick="+"cargar_contenido('main-content','Verificar_documento/vista_verificardocumento_listar.php');"+"><a><h6 class='p-3mb-0 text-center'><strong> "+con+" Documentos Pendientes</strong></h6></a></li>";
            }else{
            cadena+="<li class='wrapper bg-light' style='padding: 4px 0px; margin-top: -9px;margin-bottom: -5px;' onclick="+"cargar_contenido('main-content','Verificar_documento/vista_verificardocumento_listar.php');"+"><a><h6 class='p-3mb-0 text-center'><strong> "+con+" Documentos Pendiente</strong></h6></a></li>";           	
            }
            $("#id_contenido").html(cadena);				
		}
		else{
			$("#notificacion_palpante").html('<div class="notify"></div>');
			var cadena ='';
            cadena+="<li class='wrapper bg-light' style='padding: 4px 0px; margin-top: -9px;margin-bottom: -5px;'><a><h6 class='p-3mb-0 text-center'><strong> "+con+" Documentos Pendiente</strong></h6></a></li>";	
			$("#id_contenido").html(cadena);
		}
	})
}
