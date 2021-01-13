<script type="text/javascript" src="_recursos/js/consola_revisor.js"></script>
<link type="text/css" rel="stylesheet" href="_recursos/input-file/css/diseño_input_2.css">
<script src="_recursos/input-file/js/bootstrap-uploader/file-upload.js"></script>
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h2><b>PERSONAL REGISTRADO</b></h2>            
    </div>
    <div class="panel-body">
	    <br>
	    <div class="col-md-10"> 
	        <div class=" input-group">
	          	<input type="text" class="form-control" placeholder="Ingrese el documento de identidad nacional" id="txtbuscar_personal"  onkeypress="return soloNumeros(event)"  >
	          	<span class="input-group-addon"><i class="fa fa-search"></i></span>
	        </div>
	    </div>
	    <div class="col-md-2">
	       <button style="width:100%" class="btn btn-danger" onclick="cargar_contenido('main-content','Personal/vista_registrar_personal.php')"><i class="fa fa-plus-square"></i>&nbsp;<b>Nuevo Registro</b></button></div>
        <div class="col-md-12">
            <div class="table-responsive" style="text-align: center;">
            	<br>
            	<label>LISTADO DEL PERSONAL ADMINISTRATIVO</label>
                <div id="lista_personal_tabla" class="icon-loading">
                </div>
                <p id="paginador_personal_tabla" style="text-align:right" class="mi_paginador"></p>
              </div>
         </div>
    </div>
  </div>
</div>
<!-- INICIO MODAL -->
<div class="modal fade bs-example-modal-lg" id="modal_editar_personal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Editar Personal</b></h4>
         </div>
      	<div class="modal-body">
			<div class="panel-body">
	                    <div class="col-sm-12">
	                        <input type="text" id="txtidciudadano" hidden >
	                        <label>Nombres </label>
	                        <input type="text" class="form-control" onkeypress="return soloLetras(event)" id="txtnombre_alimentos" placeholder="Ingrese Nombres" maxlength="">
	                        <br>
	                    </div>
	                    <div class="col-md-6">
	                        <label>Apellido Paterno </label>
	                        <input type="text" class="form-control"onkeypress="return soloLetras(event)"id="txtapellidopaterno" placeholder="Ingrese Apellido Paterno" maxlength="">
	                       <br>
	                    </div>
	                    <div class="col-md-6">
	                        <label >Apellido Materno </label>
	                        <input type="text" class="form-control" onkeypress="return soloLetras(event)" id="txtapellidomaterno" placeholder="Ingrese Apelido Materno" maxlength="">
	                        <br>
	                    </div> 
	                    <div class="col-sm-6">
	                        <label >Tel&eacute;fono </label>
	                        <input type="text" class="form-control" onkeypress="return soloNumeros(event)" id="txttelefono_modal" placeholder="Ingrese nro telefóno" maxlength="9">
	                        <br>
	                    </div>        
	                    <div class="col-md-6">
	                        <label>Movil </label>
	                        <input type="text"class="form-control" id="txtmovil_modal"  onkeypress="return soloNumeros(event)" placeholder="Ingrese nro movil" maxlength="9">
	                            <br>
	                    </div> 
	                    <div class="col-md-8">
	                        <label>Direcci&oacute;n </label>
	                        <input type="text"  class="form-control" id="txtdireccion_modal" placeholder="Ingrese dirección" maxlength="200">
	                        <br>
	                    </div> 
	                    <div class="col-sm-4">
	                        <label>Fecha Nacimiento</label>
	                        <div class=" input-group">
	                          <div class="input-group-addon">
	                            <i class="fa fa-calendar"></i>
	                          </div>
	                          <input type="date" style="padding: 0px 12px;background-color: #FFFFFF;font-weight:bold;" id="txtfecha_modal"  class="form-control"  >
	                        </div><br>
	                    </div>
	                    <div class="col-md-4">
	                        <label>Nro Documento</label>
	                        <input type="text"  class="form-control"  onkeypress="return soloNumeros(event)" id="txtnrodocumento" style="width: 100%;" placeholder="Ingrese nro Documento" maxlength="8">
	                    </div>
	                    <div class="col-sm-4">
	                        <label>Email</label>
	                        <input type="text"  class="form-control" id="txtemail_modal" style="width: 100%;" placeholder="Ingrese nro Documento" maxlength="80">
	                    </div> 
	                    <div class="col-md-4">
	                    	<label>Estado</label>
					        <select id="cmb_estadopersonal" style="width: 100%" class="form-control select2">
					           <option value="ACTIVO">ACTIVO</option>
					           <option value="INACTIVO">INACTIVO</option>
					        </select>
	                    </div>  
			</div>         
        </div> 
        <div class="modal-footer">
        	<button  class="btn btn-success" onclick="Editar_personal()"><i class="fa fa-check"></i>&nbsp;<b>Modificar Personal</b></button>&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>Cancelar</b></button>
        </div> 
    </div>
  </div> 
</div>
<style type="text/css">
	.contendor_kn{
		padding: 10px;
	}
</style> 
<script type="text/javascript">listar_personal_vista('','1');</script>
<script type="text/javascript">
  $("#txtbuscar_personal").keyup(function(){
    var dato_buscar = $("#txtbuscar_personal").val();
    listar_personal_vista(dato_buscar,'1');
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
<script>
    $(function () {
        $('.select2').select2();
    })
</script>