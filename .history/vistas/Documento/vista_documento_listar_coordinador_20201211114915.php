<script type="text/javascript" src="_recursos/js/console_documento_coordinador.js"></script>
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
          <button class="btn btn-danger" onclick="cargar_contenido('main-content','Documento/vista_documento_registrar.php');"><i class="fa fa-file-text" ></i> &nbsp;&nbsp;<strong>Nuevo Registro</strong></button>
        </div>
        <div class="col-md-12">
          <div class="box-body table-responsive" style="text-align: center;"><br>
          	<label>LISTADO DE PROYECTOS TESIS REGISTRADOS</label>
              <div id="listar_documento_tabla" class=" icon-loading">
                <i id="loading_almacen" style="margin:auto;display:block; margin-top:60px;"></i>
                <div id="nodatos"></div>
              </div>
              <p id="paginador_documento_tabla" style="text-align:right" class="mi_paginador"></p>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- INICIO MODAL -->
<script type="text/javascript">listar_documento_vista("","1");</script>
<!--Fin Modal-->

<style type="text/css">
	.contendor_kn{
		padding: 10px;
	}
</style>
<div class="modal fade bs-example-modal-lg" id="modal_editar_area">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Editar &Aacute;rea</b></h4>
         </div>
        <div class="modal-body">
      <div class="panel-body">
                      <div class="col-sm-6">
                          <input type="text" id="txtidarea" hidden >
                          <label>Nombre &aacute;rea </label>
                          <input type="text" class="form-control" onkeypress="return soloLetras(event)" id="txtarea_modal" placeholder="Ingrese Nombre del area" maxlength="">
                          <br>
                      </div>
                      <div class="col-sm-6">
                          <label>Estado</label>
                          <select id="cmb_estado" style="width: 100%" class="form-control select2">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                          </select>
                      </div>
      </div>
        </div>
        <div class="modal-footer">
          <button  class="btn btn-success" onclick="Editar_area()"><i class="fa fa-check"></i>&nbsp;<b>Modificar &Aacute;rea</b></button>&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>Cancelar</b></button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_asunto_documento_modal">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Asunto del Documento Nro: </b><label id="txtiddocumento_modal"></label></h4>
         </div>
        <div class="modal-body">
      <div class="panel-body">
          <div class="col-md-12">
            <label>Título de la Investigacíon</label>
            <textarea class="form-control" rows="8"  style="resize: none" readonly="" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" placeholder="Ingresar Asunto ..." id="txtasunto_documento_modal"></textarea>
          </div>
      </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>Close</b></button>
        </div>
    </div>
  </div>
</div>


<!-- Modal mostrar Alumno -->

<div class="modal fade" id="modal_asignar_revisor_documento">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Datos del Alumno y Documento Nro: </b><label id="txtiddocumento1_modal"></label></h4>
         </div>
        <div class="modal-body">
      <div class="panel-body">
      <form class="form-inline">
        <div class="form-group">
          <label class="sr-only" for="exampleInputAmount">Revisor</label>
          <select id="select-revisor">

          </select>
        </div>
        <button type="submit" class="btn btn-primary">Transfer cash</button>
      </form>
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
