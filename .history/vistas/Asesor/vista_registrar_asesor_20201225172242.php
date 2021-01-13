<link type="text/css" rel="stylesheet" href="_recursos/input-file/css/disenio_input.css">
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2><b>REGISTRO DEL ASESOR</b></h2>
    </div>
    <div class="panel-body">
      <form id="form-registrar-docente">    
          <div class="col-md-12 col-lg-12 col-xs-12"> 
            <div class="col-sm-4">
                <label>Nombre</label>
                <input id="txtnombre" name="txtnombre"  onkeypress="return soloLetras(event)"  type="text" style="background-color: #FFFFFF"  placeholder="Ingrese nombre del Asesor" class="form-control" >
                <br>
            </div>
            <div class="col-sm-4">
                <label >Apellido Paterno</label>
                <input name="txtapellidopaterno" type="text" class="form-control" id="txtapellidopaterno" onkeypress="return soloLetras(event)"    style="background-color: #FFFFFF"    placeholder="Ingrese Apellido Paterno">
                <br>
            </div>
            <div class="col-sm-4">
                <label >Apellido Materno</label>
                <input name="txtapellidomaterno" type="text" class="form-control" id="txtapellidomaterno" onkeypress="return soloLetras(event)" style="background-color: #FFFFFF" placeholder="Ingrese Apellido Materno">
                <br>
            </div>          
            <div class="col-sm-12">
                <label >Direccion</label>
                <input type="text" class="form-control" id="txtdireccion" name="txtdireccion">
                <br>
            </div>  
            <div class="col-sm-4">
                <label >Nº Documento Identidad</label>
                <input type="text" class="form-control" name="txtdni" id="txtdni" onkeypress="return soloNumeros(event)"   maxlength="8" style="background-color: #FFFFFF" placeholder="Ingrese Nº Documento Identidad">
                <br>
            </div>
            <div class="col-sm-4">
                <label>Fecha Nacimiento</label>
                <div class=" input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" style="padding: 0px 12px;background-color: #FFFFFF;font-weight:bold;" id="txtfecha"  name="txtfecha" class="form-control"  >
                </div><br>
            </div>
          </div>  
          <div class="col-md-12 col-lg-12 col-xs-12">   
            <div class="col-sm-6">
                <label >Email Personal</label>
                <input type="email" class="form-control" required="" name="txtemail" id="txtemail" placeholder="Ingrese Email">
                <br>
            </div>
            <div class="col-sm-6">
                <label >Telefono</label>
                <input type="text" class="form-control" name="txttelefono" id="txttelefono" maxlength="9" onkeypress="return soloNumeros(event)"  placeholder="Ingrese Numero Telefonico">
                <br>
            </div>
            
            <div class="col-md-6">
                <label>Movil </label>
                <input type="text"class="form-control" name="txtmovil" id="txtmovil"  onkeypress="return soloNumeros(event)" placeholder="Ingrese nro movil" maxlength="9">
                <br>
            </div> 

            <div class="col-sm-4">
                <label >Estado</label>
                <select id="txtEstado" class="form-control" name="txtEstado">
                  <option value="ACTIVO" selected>ACTIVO</option>
                  <option value="INACTIVO">INACTIVO</option> 
                </select>
                <br>
            </div>
            <div class="col-sm-4">
                <label >Sexo</label>
                <select id="txtGenero" class="form-control" name="txtGenero">
                  <option value="M" selected>HOMBRE</option>
                  <option value="F">MUJER</option>
                </select>
                <br>
            </div>

            <div class="col-sm-4">
                <label >Tipo</label>
                <select id="cboTipo" class="form-control select2" name="cboTipo[]" multiple="multiple">
                </select>
                <br>
            </div>

          </div>

                     
          <div class="col-md-12 col-lg-12 col-xs-12" style="text-align:center;">
            <div class="col-md-12">
              <br><button type="button" class="btn btn-success" onclick="revisar_dni_asesor()"><strong> Registrar Asesor</strong></button><br><br>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="_recursos/js/consola_asesor.js"></script>

<script type="text/javascript">
  Listar_tipo_docente_combo();
</script>

<style type="text/css">
  .contendor_kn{
    padding: 10px;
  }
</style>
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
    select{
       font-weight:bold;
      text-align-last:center;
    }
    .select2-container--default.select2-container--disabled .select2-selection--single{
      color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;
    }
    .modal-open .select2-container--open {
      z-index: 999999 !important; width:100% !important; 
    }
</style>
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
</script>
<script>
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
      $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
      });
</script>
<script>
    $(function () {
        $('#cboTipo').select2();
    })
</script>