<link type="text/css" rel="stylesheet" href="_recursos/input-file/css/disenio_input.css">
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2><b>REGISTRO DE CIUDADANOS</b></h2>
    </div>
    <div class="panel-body">
          <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="col-sm-12">
                <label>Nombre</label>
                <input id="txtnombre"  onkeypress="return soloLetras(event)"  type="text" style="background-color: #FFFFFF"  placeholder="Ingrese nombre de la persona" class="form-control" >
                <br>
            </div>
            <div class="col-sm-6">
                <label >Apellido Paterno</label>
                <input type="text" class="form-control" id="txtapellidopaterno" onkeypress="return soloLetras(event)"    style="background-color: #FFFFFF"    placeholder="Ingrese Apellido Paterno">
                <br>
            </div>
            <div class="col-sm-6">
                <label >Apellido Materno</label>
                <input type="text" class="form-control" id="txtapellidomaterno" onkeypress="return soloLetras(event)" style="background-color: #FFFFFF" placeholder="Ingrese Apellido Materno">
                <br>
            </div>
            <div class="col-sm-6">
                <label >Direcci&oacute;n</label>
                <input type="text" class="form-control" id="txtdireccion" style="background-color: #FFFFFF" placeholder="Ingrese Direccion">
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
                <label >Nº Documento Identidad</label>
                <input type="text" class="form-control" id="txtdni" onkeypress="return soloNumeros(event)"   maxlength="8" style="background-color: #FFFFFF" placeholder="Ingrese Nº Documento Identidad">
                <br>
            </div>
            <div class="col-sm-4">
                <label >Sexo</label>
                <select id="txtGenero" class="form-control select2" name="txtGenero">
                  <option value="M">HOMBRE</option>
                  <option value="F">MUJER</option>
                </select>
                <br>
            </div><br>
            <div class="col-md-4" style="display:none;">
                <label>Modalidad </label>
                <select id="cbm_tipo"  style="width: 100%" class="form-control select2">
                  <option value="PREGRADO">PREGRADO</option>
                  <option value="POSGRADO">POSGRADO</option>
                </select>
                <br>
            </div>
          </div>
          <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="col-sm-6">
                <label >Email</label>
                <input type="email" class="form-control"  id="txtemail" placeholder="Ingrese Email">
                <br>
            </div>
            <div class="col-sm-6">
                <label>Fecha Nacimiento</label>
                <div class=" input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" style="padding: 0px 12px;background-color: #FFFFFF;font-weight:bold;" id="txtfecha"  class="form-control"  >
                </div><br>
            </div>
            <div class="col-sm-6">
                <label >Celular</label>
                <input type="text" class="form-control" id="txttelefono" maxlength="9" onkeypress="return soloNumeros(event)"  placeholder="Ingrese Numero Telefonico">
                <br>
            </div>
            <div class="col-md-6">
                <label>Teléfono </label>
                <input type="text"class="form-control" id="txtmovil"  onkeypress="return soloNumeros(event)" placeholder="Ingrese nro movil" maxlength="9">
                <br>
            </div>
          </div>
          <div class="col-md-12 col-lg-12 col-xs-12" style="text-align:center;">
            <div class="col-md-12">
              <br><button class="btn btn-success" onclick="revisar_dni_ciudadano()"><strong> Registrar Ciudadano</strong></button><br><br>
            </div>
          </div>
    </div>
  </div>
</div>
<script type="text/javascript">
</script>
<script type="text/javascript" src="_recursos/js/consola_ciudadano.js"></script>

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
        $('.select2').select2();
    })
</script>
