<script type="text/javascript" src="_recursos/js/console_documento_coordinador_etapa_nueve.js"></script>
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h4><b>COORDINADOR: PROYECTO TESIS REGISTRADOS </b></h4>
    </div>
    <div class="panel-body">
        <div class="col-md-10">
          <div class=" input-group">
            <input id="txt_documento_vista" type="text" class="form-control" onkeypress="return soloLetras(event)"  placeholder="Ingrese el c&oacute;digo del documento a buscar ">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
          </div>
        </div>
        <div class="col-md-2">
          
        </div>
        <div class="col-md-12">
          <div class="box-body" style="text-align: center;"><br>
          	<label>LISTADO DE PROYECTOS TESIS REGISTRADOS</label>
              <div id="listar_documento_tabla" class="table-responsive" style="overflow: scroll;">
                <i id="loading_almacen" style="margin:auto;display:block; margin-top:60px;"></i>
                <div id="nodatos" class="table-responsive"></div>
              </div>
              <p id="paginador_documento_tabla" style="text-align:right" class="mi_paginador"></p>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- INICIO MODAL -->
<script type="text/javascript">listar_documento_vista_revisor("","1");</script>
<!--Fin Modal-->

<style type="text/css">
	.contendor_kn{
		padding: 10px;
	}
</style>

<div class="modal" tabindex="-1" id="modal-subir-anexos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Subir Informa turnitin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form enctype="multipart/form-data" id="form-upload-file-anexos">
        <div class="form-group">
          <label for="file-v1">Archivo</label>
          <div class="input-group">
            <input type="file" class="form-control" id="file-v1" name="file-v1">
            <span class="input-group-btn" id="btnverv1">
              
            </span>
          </div>
          <input type="hidden" id="tipo-e4" name="tipo-e4" value="21">
          <input type="hidden" id="iddocumentoanexos" name="iddocumentoanexos">
        </div>
        <div class="form-group">
          <label for="porcentaje">Porcentaje</label>
          <input type="text" class="form-control" id="porcentaje" name="porcentaje">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrar_documento_anexos()">Subir</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="subir-correciones-etapa-ocho" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Subir Correciones</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        
        <form enctype="multipart/form-data" id="form-upload-file-anexos-corregidos-etapa-ocho">
          <div class="form-group">
              <label for="file-ax1-e8" id="file-ax1-e4-title"></label>
              <div class="input-group">
                <input type="file" class="form-control" id="file-ax1-e8" name="file-ax1-e8">
                <span class="input-group-btn" id="btnverax1e4-ocho"></span>
              </div>
              <input type="hidden" id="iddocumentovcorreccionesocho" name="iddocumentovcorreccionesocho">
              <input type="hidden" id="tipo-e4-ocho" name="tipo-e4-ocho">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrar_documento_adicionales_ocho()">subir</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal mostrar Alumno -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-enviar-correo-revisor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Enviar Correo</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Correo Electronico</label>
          <input type="text" class="form-control" name="correo" id="correo-modal">
          <input type="hidden" class="form-control" id="iddocumentomodal-1" name="iddocumentomodal-1">
        </div>
        <div class="form-group">
          <label>Link Zoom</label>
          <input type="text" class="form-control" name="zoom" id="zoom-modal">
        </div>
        <div class="form-group">
          <label>Lugar</label>
          <input type="text" class="form-control" name="lugar" id="lugar-modal">
        </div>
        <div class="form-group">
          <label>Hora</label>
          <input type="text" class="form-control" name="hora" id="hora-modal">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="enviarcorreopordocumentorevisor()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-ver-anexos">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-title-anexos"></h4>
      </div>
      <div class="modal-body" id="modal-body-anexos">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-ver-turniting">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-title-tirniting"></h4>
      </div>
      <div class="modal-body" id="modal-body-turniting">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal_ver_revisor_documento">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Datos del Alumno y Documento Nro: </b><label id="txtiddocumento1_modal"></label></h4>
         </div>
        <div class="modal-body">
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr class="info">
              <th>DNI</th>
              <th>APELLIDOS Y NOMBRES</th>
              <th>CELULAR</th>
            </tr>
          </thead>
          <tbody id="tbody-tabla-revisor-tesis"></tbody>
        </table>
      </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>Close</b></button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_datos_remitente_documento_modal">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Datos del Alumno y Documento Nro: </b><label id="txtiddocumento1_modal"></label></h4>
         </div>
        <div class="modal-body">
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr class="info">
              <th>DNI</th>
              <th>APELLIDOS Y NOMBRES DEL ALUMNO</th>
              <th>CELULAR</th>
            </tr>
          </thead>
          <tbody id="tbody-tabla-alumnos-tesis"></tbody>
        </table>
      </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>Close</b></button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_datos_remitente_documento_modal">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Datos del Alumno y Documento Nro: </b><label id="txtiddocumento1_modal"></label></h4>
         </div>
        <div class="modal-body">
      <div class="panel-body">
          <div class="col-md-12">
            <label>APELLIDOS Y NOMBRES DEL ALUMNO</label>
            <input type="text" id="txtdatosremitente" class="form-control"><br>
          </div>
          <div class="col-md-6">
            <label>DNI</label>
            <input type="text" id="txtdniremitente" class="form-control">
          </div>
          <div class="col-md-6">
            <label>TELEFONO</label>
            <input type="text" id="txttelefonoremitente" class="form-control">
          </div>
      </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>Close</b></button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_datos_remitenteinstitucion_documento_modal">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Datos del Remitente del Documento Nro: </b><label id="txtiddocumento1_modal"></label></h4>
         </div>
        <div class="modal-body">
          <div class="panel-body">
              <div class="col-md-12">
                <label>DATOS REMITENTE</label>
                <input type="text" id="txtdatosremitenteinstitucion" class="form-control"><br>
              </div>
              <div class="col-md-12">
                <label>TIPO INSTITUCI&Oacute;N</label>
                <input type="text" id="txttipoinstitucion" class="form-control">
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>Close</b></button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_archivo_documento" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <div class="kv-zoom-actions pull-right">
            <button type="button" class="btn btn-default btn-close" title="Close detailed preview" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
          </div>
          <h4 class="modal-title" id="myModalLabel"><b>ARCHIVO DEL DOCUMENTO: </b><label id="txtiddocumento1_modal"></label></h4>
        </div>
        <div class="modal-body">
          <div class="floating-buttons"></div>

            <div class="kv-zoom-body file-zoom-content" style="text-align:center; " >
            <div id="id_archivodocumento"></div>

        </div>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
	$("#txt_documento_vista").keyup(function(){
		var dato_buscar = $("#txt_documento_vista").val();
		listar_documento_vista(dato_buscar,'1');
	});
</script>
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
