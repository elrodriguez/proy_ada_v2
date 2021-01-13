<script type="text/javascript" src="_recursos/js/console_tipodocumento.js"></script>
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2><b>TIPO DE DOCUMENTOS REGISTRADOS</b></h2>            
    </div>
    <div class="panel-body">
      <br>
      <div class="col-md-10"> 
        <div class=" input-group">
          <input type="text" class="form-control" placeholder="Ingresar nombre tipo de documento a buscar" id="txtbuscar_tipodocumento"  onkeypress="return soloLetras(event)"  >
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
      <div class="col-md-2">
        <button style="width:100%" class="btn btn-danger" onclick="cargar_contenido('main-content','Tipo_Documento/vista_tipoDocumento_Registrar.php')"><i class="fa fa-plus-square"></i>&nbsp;<b>Nuevo Registro</b></button>   
      </div>
      <div class="col-md-12">
        <div class="table-responsive" style="text-align: center;">
          <br>
          <label>LISTADO DE TIPO DE DOCUMENTOS</label>
          <div id="lista_tipodocumento_tabla" class="icon-loading">
            <i id="loading_nivel"></i>
            <div id="nodatos">               
            </div>
          </div>
          <p id="paginador_tipodocumento_tabla" style="text-align:right" class="mi_paginador"></p>
        </div>
      </div>
		    <script type="text/javascript">listar_TipoDocumento_vista("","1")</script>
    </div>
  </div>
</div>
</div>
<!--MODAL EDITAR CARGO-->
<div class="modal fade bs-example-modal-lg" id="modal_editar_TipoDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><b>Editar Tipo de Documento</b></h4>
         </div>
        <div class="modal-body">
        		<div class="panel-body">
                <input type="text"  id="txtidtipodocumento" hidden="true">
                <div class="col-md-6">
                  <label>Nombre</label>
                  <input type="text" id="txttipodocumento_modal"  onkeypress="return soloLetras(event)" class="form-control">
                </div>
                <div class="col-md-6 ">
                  <label>Estado</label><br>
                  <select id="cbmEstado" class="form-control select2" style="width: 100%">
                    <option value="ACTIVO">DISPONIBLE</option>
                    <option value="INACTIVO">NO DISPONIBLE</option>
                  </select>
                </div>
              <div class="col-md-12 col-lg-12 col-xs-12" style="text-align:center;" >
                <br>
                <button class="btn btn-success" onClick="Editar_TipoDocumento()"><i class="fa fa-check"></i>&nbsp;<b>Modificar Tipo Documento</b></button>
              </div>
              <br>           			
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;<b>Cancelar</b></button>
        </div> 
     
    </div>    
  </div> 
</div>   
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