<script type="text/javascript" src="_recursos/js/console_area.js"></script>
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h2><b>&Aacute;REAS REGISTRADAS</b></h2>
    </div>
    <div class="panel-body">
        <div class="col-md-10"> 
          <div class=" input-group">
            <input id="txt_area_vista" type="text" class="form-control" onkeypress="return soloLetras(event)"  placeholder="Ingrese el nombre del área a buscar ">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
          </div>
        </div>
        <div class="col-md-2">
          <button class="btn btn-danger" onclick="cargar_contenido('main-content','Area/vista_area_registrar.php');"><i class="fa fa-file-text" ></i> &nbsp;&nbsp;<strong>Nuevo Registro</strong></button>    
        </div>
        <div class="col-md-12">
          <div class="box-body table-responsive" style="text-align: center;"><br>
          	<label>LISTADO DE AREAS</label>
              <div id="listar_areas_tabla" class=" icon-loading">
                <i id="loading_almacen" style="margin:auto;display:block; margin-top:60px;"></i>
                <div id="nodatos"></div>
              </div>
              <p id="paginador_area_tabla" style="text-align:right" class="mi_paginador"></p>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- INICIO MODAL -->
<script type="text/javascript">listar_area_vista("","1");</script>
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
<script type="text/javascript">
	$("#txt_area_vista").keyup(function(){
		var dato_buscar = $("#txt_area_vista").val();
		listar_area_vista(dato_buscar,'1');
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