
function Consultar(){
	$.ajax({
		url:'http://localhost/Reportes/php/controlador_listar_persona.php',
		type:'POST',
		data:{}
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			var cadena = "<table class='table'><tr class='titulo'><td>ID</td><td>Nombres</td><td>Apellidos</td><td>Edad</td></tr>";

			for (var i = 0; i < data.length; i++) {
				cadena += "<tr>";
					cadena += "<td>"+data[i][0]+"</td>";
					cadena += "<td>"+data[i][1]+"</td>";
					cadena += "<td>"+data[i][2]+"</td>";
					cadena += "<td>"+data[i][3]+"</td>";
				cadena += "<tr>";
			}
			cadena += "</table>";
			$("#datos").html(cadena);
		}
		else{
			var cadena = "<h4>No hay registros de clientes</h4>";
			$("#datos").html(cadena);
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

function Generar(array){
	/*window.location.href = "http://localhost/Reportes/php/generar_reporte.php";*/
}