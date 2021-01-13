<script type="text/javascript" src="_recursos/js/consola_asesor.js"></script>
<link type="text/css" rel="stylesheet" href="_recursos/input-file/css/diseño_input_2.css">
<script src="_recursos/input-file/js/bootstrap-uploader/file-upload.js"></script>
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h2><b>ASESORES REGISTRADOS</b></h2>            
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
	       <button style="width:100%" class="btn btn-danger" onclick="cargar_contenido('main-content','Asesor/vista_registrar_asesor.php')"><i class="fa fa-plus-square"></i>&nbsp;<b>Nuevo Registro</b></button></div>
        <div class="col-md-12">
            <div class="table-responsive" style="text-align: center;">
            	<br>
            	<label>LISTADO DEL ASESORES - TODAS LAS CARRERAS</label>
                <div id="lista_personal_tabla" class="icon-loading">
                </div>
                <p id="paginador_personal_tabla" style="text-align:right" class="mi_paginador"></p>
              </div>
         </div>
    </div>
  </div>
</div>

<!-- INICIO MODAL -->
<div class="modal fade bs-example-modal-lg" id="modal_editar_asesor">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Editar Asesor</b></h4>
         </div>
      	<div class="modal-body">

				<div class="col-sm-4">
					<input type="text" id="txtidciudadano" hidden >
					<label>Nombres </label>
					<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="txtnombre_alimentos" name="txtnombre_alimentos" placeholder="Ingrese Nombres" maxlength="">
					<br>
				</div>
				<div class="col-md-4">
					<label>Apellido Paterno </label>
					<input type="text" class="form-control"onkeypress="return soloLetras(event)"id="txtapellidopaterno" name="txtapellidopaterno" placeholder="Ingrese Apellido Paterno" maxlength="">
					<br>
				</div>
				<div class="col-md-4">
					<label >Apellido Materno </label>
					<input type="text" class="form-control" onkeypress="return soloLetras(event)" id="txtapellidomaterno" name="txtapellidomaterno" placeholder="Ingrese Apelido Materno" maxlength="">
					<br>
				</div> 
				<div class="col-sm-6">
					<label >Tel&eacute;fono </label>
					<input type="text" class="form-control" onkeypress="return soloNumeros(event)" id="txttelefono_modal" name="txttelefono_modal" placeholder="Ingrese nro telefóno" maxlength="9">
					<br>
				</div>        
				<div class="col-md-6">
					<label>Movil </label>
					<input type="text"class="form-control" id="txtmovil_modal" name="txtmovil_modal" onkeypress="return soloNumeros(event)" placeholder="Ingrese nro movil" maxlength="9">
					<br>
				</div> 
				<div class="col-md-8">
					<label>Direcci&oacute;n </label>
					<input type="text"  class="form-control" id="txtdireccion_modal" name="txtdireccion_modal" placeholder="Ingrese dirección" maxlength="200">
					<br>
				</div> 
				<div class="col-sm-4">
					<label>Fecha Nacimiento</label>
					<div class=" input-group">
						<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
						</div>
						<input type="date" name="txtfecha_modal" style="padding: 0px 12px;background-color: #FFFFFF;font-weight:bold;" id="txtfecha_modal"  class="form-control"  >
					</div><br>
				</div>
				<div class="col-md-4">
					<label>Nro Documento</label>
					<input type="text"  class="form-control"  onkeypress="return soloNumeros(event)" id="txtnrodocumento" name="txtnrodocumento" style="width: 100%;" placeholder="Ingrese nro Documento" maxlength="8">
				</div>
				<div class="col-sm-4">
					<label>Email</label>
					<input type="text"  class="form-control" name="txtemail_modal" id="txtemail_modal" style="width: 100%;" placeholder="Ingrese nro Documento" maxlength="80">
				</div>
				<div class="col-sm-4">
					<label >Sexo</label>
					<select id="txtGenero" class="form-control" name="txtGenero">
						<option value="M" selected>HOMBRE</option>
						<option value="F">MUJER</option>
					</select>
				</div>
				<div class="col-md-4">
					<label>Estado</label>
					<select id="cmb_estadopersonal" name="cmb_estadopersonal" style="width: 100%" class="form-control select2">
						<option value="ACTIVO">ACTIVO</option>
						<option value="INACTIVO">INACTIVO</option>
					</select>
				</div> 
				<div class="col-sm-4">
					<label >Tipo</label>
					<select id="cboTipo" class="form-control" name="cboTipo[]" multiple="multiple"></select>
				</div>
       
        </div> 
        <div class="modal-footer">
        	<button  class="btn btn-success" onclick="Editar_asesor()"><i class="fa fa-check"></i>&nbsp;<b>Modificar Asesor</b></button>&nbsp;&nbsp;&nbsp;
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
<script type="text/javascript">listar_asesor_vista('','1');</script>
<script type="text/javascript">
  $("#txtbuscar_personal").keyup(function(){
    var dato_buscar = $("#txtbuscar_personal").val();
    listar_asesor_vista(dato_buscar,'1');
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
		$.ajax({
			url:'../controlador/personal/controlador_combolistar_tipo_docente.php',
			type:'POST'
		}).done(function(resp) {
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
		});
        $('#cboTipo').select2();
    })
</script>