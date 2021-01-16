<script type="text/javascript" src="_recursos/js/consola_ciudadano.js"></script>
<link type="text/css" rel="stylesheet" href="_recursos/input-file/css/diseño_input_2.css">
<script src="_recursos/input-file/js/bootstrap-uploader/file-upload.js"></script>
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h4><b>ALUMNOS(AS) REGISTRADOS(AS)</b></h4>
    </div>
    <div class="panel-body">
	    <br>
	    <div class="col-md-10">
	        <div class=" input-group">
	          	<input type="text" class="form-control" placeholder="Ingrese el documento de identidad nacional" id="txtbuscar_ciudadano"  onkeypress="return soloNumeros(event)"  >
	          	<span class="input-group-addon"><i class="fa fa-search"></i></span>
	        </div>
	    </div>
	    <div class="col-md-2">
	       <button style="width:100%" class="btn btn-danger" onclick="cargar_contenido('main-content','Ciudadano/vista_registrar_ciudadano.php')"><i class="fa fa-plus-square"></i>&nbsp;<b>Nuevo Registro</b></button></div>
        <div class="col-md-12">
            <div class="table-responsive" style="text-align: center;">
            	<br>
            	<label>LISTADO DE ALUMNOS</label>
                <div id="lista_ciudadano_tabla" class="icon-loading">
                </div>
                <p id="paginador_ciudadano_tabla" style="text-align:right" class="mi_paginador"></p>
              </div>
         </div>
    </div>
  </div>
</div>
<!-- INICIO MODAL -->
<div class="modal fade bs-example-modal-lg" id="modal_editar_ciudadano">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Editar Alumno</b></h4>
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
	                    <div class="col-md-6">
	                        <label>Modalidad</label>
	                        <select id="cbm_tipo"  style="width: 100%" class="form-control select2">
	                          <option value="PREGRADO">PREGRADO</option>
	                          <option value="POSGRADO">POSGRADO</option>
	                        </select>
	                        <br>
	                    </div>
	                    <div class="col-sm-6">
	                        <label >Celular </label>
	                        <input type="text" class="form-control" onkeypress="return soloNumeros(event)" id="txttelefono_modal" placeholder="Ingrese nro telefóno" maxlength="9">
	                        <br>
	                    </div>
	                    <div class="col-md-6">
	                        <label>Teléfono </label>
	                        <input type="text"class="form-control" id="txtmovil_modal"  onkeypress="return soloNumeros(event)" placeholder="Ingrese nro movil" maxlength="9">
	                            <br>
	                    </div>
	                    <div class="col-md-6">
	                        <label>Direcci&oacute;n </label>
	                        <input type="text"  class="form-control"  onkeypress="return soloLetras(event)"id="txtdireccion_modal" placeholder="Ingrese dirección" maxlength="200">
	                        <br>
						</div>
						<div class="col-sm-6">
							<label >Carrera Profesional</label>
							<select id="carrera" name="carrera" class="form-control" required="">
							<option value="">Seleccione carrera</option>
							<option value="Administración de empresas">Administración de empresas</option>
							<option value="Administración de Negocios Internacionales">Administración de Negocios Internacionales</option>
							<option value="Arquitectura y Urbanismo Ambiental">Arquitectura y Urbanismo Ambiental</option>
							<option value="Artes Escénicas">Artes Escénicas</option>
							<option value="Biología Marina">Biología Marina</option>
							<option value="Comunicación y Publicidad">Comunicación y Publicidad</option>
							<option value="Contabilidad Corporativa">Contabilidad Corporativa</option>
							<option value="Derecho">Derecho</option><option value="Enfermería">Enfermería</option>
							<option value="Estomatología / Odontología">Estomatología / Odontología</option>
							<option value="Farmacia y Bioquímica">Farmacia y Bioquímica</option>
							<option value="Ingeniería Acuícola">Ingeniería Acuícola</option>
							<option value="Ingeniería Agoforestal">Ingeniería Agoforestal</option>
							<option value="Ingeniería Ambiental">Ingeniería Ambiental</option>
							<option value="Ingeniería de Sistemas Empresariales">Ingeniería de Sistemas Empresariales</option>
							<option value="Ingeniería Económica y de Negocios">Ingeniería Económica y de Negocios</option>
							<option value="Ingeniería Civil">Ingeniería Civil</option>
							<option value="Marketing y Administración">Marketing y Administración</option>
							<option value="Medicina Humana">Medicina Humana</option>
							<option value="Medicina Veterinaria y Zootécnia">Medicina Veterinaria y Zootécnia</option>
							<option value="Nutrición y DIetética">Nutrición y DIetética</option>
							<option value="Obstetricia">Obstetricia</option>
							<option value="Psicología">Psicología</option>
							<option value="Turismo Sostenible y Hotelería">Turismo Sostenible y Hotelería</option>
							</select>
							<br>
						</div>
	                    <div class="col-sm-4">
	                        <label>Fecha Nacimiento</label>
	                        <div class=" input-group">
	                          <div class="input-group-addon">
	                            <i class="fa fa-calendar"></i>
	                          </div>
	                          <input type="date" style="padding: 0px 12px;background-color: #FFFFFF;font-weight:bold;" id="txtfecha_modal"  class="form-control"  >
	                        </div>
	                    </div>
	                    <div class="col-md-4">
	                        <label>DNI</label>
	                        <input type="text"  class="form-control"  onkeypress="return soloNumeros(event)" id="txtnrodocumento" style="width: 100%;" placeholder="Ingrese nro Documento" maxlength="13">
	                    </div>
	                    <div class="col-sm-4">
	                        <label>Email</label>
	                        <input type="text"  class="form-control"  onkeypress="return soloNumeros(event)" id="txtemail_modal" style="width: 100%;" placeholder="Ingrese nro Documento" maxlength="13">
	                    </div>
			</div>
        </div>
        <div class="modal-footer">
        	<button  class="btn btn-success" onclick="Editar_ciudadano()"><i class="fa fa-check"></i>&nbsp;<b>Modificar Alumno</b></button>&nbsp;&nbsp;&nbsp;
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
<script type="text/javascript">listar_ciudadano_vista('','1');</script>
<script type="text/javascript">
  $("#txtbuscar_ciudadano").keyup(function(){
    var dato_buscar = $("#txtbuscar_ciudadano").val();
    listar_ciudadano_vista(dato_buscar,'1');
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