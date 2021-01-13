<script type="text/javascript" src="_recursos/js/console_tipodocumento.js"></script>
<link type="text/css" rel="stylesheet" href="_recursos/input-file/css/disenio_input.css">
<div class="contendor_kn">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2><b>REGISTRO DE TIPO DE DOCUMENTO</b></h2>
			<br>
		</div>
		<div class="panel-body">
			<br>
            <div class="col-md-12">
                <label>Nombre</label>
                <input type="text" id="txttipodocumento_modal" placeholder="Ingrese el nombre o descripción del tipo de documento" onkeypress="return soloLetras(event)" style="background-color: #FFFFFF" class="form-control"><br>
            </div>
            <div class="col-md-12">
                <label>Estado</label><br>
                <input class="form-control" readonly value="ACTIVO" type="text" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;" id="txtestado"> 
            </div>
            <div class="col-md-12 col-lg-12 col-xs-12" style="text-align:center;" >
                <br><br>
                <button class="btn btn-success" onClick="Registrar_TipoDocumento()"><i class="fa fa-floppy-o"></i>&nbsp;<b>Rgistrar Tipo Documento</b></button>
            </div>
            <br>           			
        </div>
        <br>
	</div>			
</div>
<style type="text/css">
	.contendor_kn{
		padding: 10px;
	}
</style>
<script type="text/javascript">
  $("#txtbuscar_tipodocumento").keyup(function(){
    var dato_buscar = $("#txtbuscar_tipodocumento").val();
    listar_TipoDocumento_vista(dato_buscar,'1');
  });
</script>
<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    function soloNumeros(e){
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla==8){
            return true;
        }
            
        // Patron de entrada, en este caso solo acepta numeros
        patron =/[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }
</script>
<style type="text/css">
    label{
      font-weight:bold;
    }
    .select2{
      font-weight:bold;
      text-align-last:center;
    }
    button{
    font-weight:bold;
    }
        .modal-open .select2-container--open { z-index: 999999 !important; width:100% !important; }
</style>
<script>
    $(function () {
        $('.select2').select2();
    })
</script>