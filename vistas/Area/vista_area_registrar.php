<script type="text/javascript" src="_recursos/js/console_area.js"></script>
<link type="text/css" rel="stylesheet" href="_recursos/input-file/css/disenio_input.css">
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h2><b>REGISTRO DE &Aacute;REAS</b></h2>            
    </div>
    <div class="panel-body">
        <div class="col-sm-6"><br>
          <label>Nombre &aacute;rea </label>
          <input type="text" class="form-control" onkeypress="return soloLetras(event)" id="txtarea_modal" placeholder="Ingrese Nombre del area" maxlength="">
          <br>
        </div>
        <div class="col-md-6"><br>
          <label>ESTADO:</label>
          <input class="form-control" readonly value="ACTIVO" type="text" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;" id="txtestado">
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12" style="text-align:center;">
          <div class="col-md-12">
            <br><button class="btn btn-success" onclick="registrar_area()"><strong> Registrar &Aacute;rea</strong></button><br><br>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- INICIO MODAL -->
<!--Fin Modal-->

<style type="text/css">
	.contendor_kn{
		padding: 10px;
	}
</style>
<script>
    $(function () {
        $('.select2').select2();
    })
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