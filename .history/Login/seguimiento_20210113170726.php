<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="zxx">
<head>
	<title>Seguimiento Documentario</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Full Screen Enroll Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<link rel="stylesheet" href="_plantilla/css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="_plantilla/css/fontawesome-all.css">
	<script src="../vistas/_recursos/js/jquery.min.js"></script>

	<link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="_plantilla/js/sweetalert.css">
	 <link href="../vistas/_recursos/css/customs.css" rel="stylesheet">
	   <link rel="stylesheet" href="../vistas/_recursos/css/bootstrap.css" type="text/css" />
</head>
<body>
	<div style="text-align: center;" class="row">
    <div class="col-md-12" style="text-align: center;">
      <h2><?php echo $_SESSION['nombre_completo']; ?></h2>
			<br><br>
			<label>SEGUIMIENTO DE PROYETO TESIS</label><br><br>
		</div>
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<input type="text" id="txtdocumento" class="form-control">
		</div>
		<div class="col-md-1">
			<button  class="btn btn-primary" onclick="buscardocumento()"><i class=" fa fa-plus-square-o"></i>&nbsp;BUSCAR</button>  <br><br>
		</div>
	</div>
	<div class="main-w3ls">
		<div class="left-content" style="text-align: center;flex: 0 0 100%;max-width: 100%;">
			<div class="center-content form-style-agile">
				<div class="input-group mb-12 col-md-12">
					<table id="tabla_horario" class="table table-bordered jambo_table">
		                <thead>
                        <tr>
                          <th rowspan="2" style = 'vertical-align: middle;text-align: center;color: #fff;width: 80px;word-wrap: break-word;font-weight: bold;'>ID</th>
                          <th rowspan="2" style = 'vertical-align: middle;text-align: center;color: #fff;width: 80px;word-wrap: break-word;font-weight: bold;'>TÍTULO</th>
                          <th rowspan="2" style = 'vertical-align: middle;text-align: center;color: #fff;width: 80px;word-wrap: break-word;font-weight: bold;'>FECHA RECEPCI&OacuteN</th>
                          <th rowspan="2" style = 'vertical-align: middle;text-align: center;color: #fff;width: 80px;word-wrap: break-word;font-weight: bold;'>&Aacute;REA ASIGNADA</th>
                          <th rowspan="2" style = 'vertical-align: middle;text-align: center;color: #fff;width: 80px;word-wrap: break-word;font-weight: bold;'>TIPO DOCUMENTO</th>
                          <th rowspan="2" style = 'vertical-align: middle;text-align: center;color: #fff;width: 80px;word-wrap: break-word;font-weight: bold;'>ALUMNO</th>
                          <th colspan="3" style = 'text-align: center;color: #fff;width: 80px;word-wrap: break-word;font-weight: bold;'>Etapa 1</th>
                          <th style = 'text-align: center;color: #fff;width: 80px;word-wrap: break-word;font-weight: bold;'> Etapa 3 </th>
                          <th></th>
                          <th></th>
                        </tr>
		                    <tr>
                            <th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;font-weight: bold;'>ARCHIVO</th>
                            <th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;font-weight: bold;'>V2</th>
                            <th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;font-weight: bold;'>V3</th>
                            <th style = 'text-align: center;color: #fff;width: 20px;word-wrap: break-word;font-weight: bold;'>Anexo 6</th>
            								<th style = 'text-align: center;color: #fff;width: 30px;word-wrap: break-word;font-weight: bold;'>ESTADO</th>
                            <th style = 'text-align: center;color: #fff;width: 30px;word-wrap: break-word;font-weight: bold;'></th>
		                    </tr>
		                </thead>
		                <tbody id="tbody_tabla_seguimiento">
		                </tbody>
		            </table>
		        </div>
	        </div>
        </div>
	</div>
	<div>
	<div class="input-group mb-12 col-md-12" style="text-align: right;">
		<a href="index.php" class="btn btn-primary" style="box-shadow: 0 0 0 .2rem rgba(0,0,0,0);">Regresar al login</a><br><br>
	</div>
	</div>
  <div class="modal" tabindex="-1" id="modal-subir-v2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Subir archivo V2</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form enctype="multipart/form-data" id="form-upload-file-v2">
          <div class="form-group">
            <label for="file-v2">v2</label>
            <input type="file" class="form-control" id="file-v2" name="file-v2">
            <input type="hidden" id="iddocumentov2" name="iddocumentov2">
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="registrar_documento_v2()">Subir Archivo</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" tabindex="-1" id="modal-subir-v3">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Subir archivo V3</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form enctype="multipart/form-data" id="form-upload-file-v3">
          <div class="form-group">
            <label for="file-v3">v3</label>
            <input type="file" class="form-control" id="file-v3" name="file-v3">
            <input type="hidden" id="iddocumentov3" name="iddocumentov3">
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="registrar_documento_v3()">Subir Archivo</button>
        </div>
      </div>
    </div>
  </div>
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
    .modal-open .select2-container--open { z-index: 999999 !important; width:100% !important; }
</style>
<div class="modal fade" id="modal_asunto_documento_modal">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel"><b>Título del proyecto Nro: </b><label id="txtiddocumento_modal"></label></h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
        <div class="modal-body">
      <div class="panel-body">
          <div class="col-md-12">
            <label>TÍTULO</label>
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
<div class="modal fade" id="modal_datos_remitente_documento_modal">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel"><b>Datos del Alumno - Documento Nro: </b><label id="txtiddocumento1_modal"></label></h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
        <div class="modal-body">
      <div class="panel-body">
          <div class="col-md-12">
            <label>DATOS DEL ALUMNO</label>
            <input type="text" id="txtdatosremitente" class="form-control"><br>
          </div>
          <div class="col-md-6">
            <label>DNI</label>
            <input type="text" id="txtdniremitente" class="form-control">
          </div>
          <div class="col-md-6">
            <label>CELULAR</label>
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
           <h4 class="modal-title" id="myModalLabel"><b>Datos del Remitente del Documento Nro: </b><label id="txtiddocumento1_modal"></label></h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
        <div class="modal-body">
      <div class="panel-body">
          <div class="col-md-12">
            <label>DATOS DEL ALUMNO</label>
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
          <h4 class="modal-title" id="myModalLabel"><b>PROYECTO TESIS: </b><label id="txtiddocumento1_modal"></label></h4>
          <div class="kv-zoom-actions pull-right">
            <button type="button" class="btn btn-default btn-close" title="Close detailed preview" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
          </div>
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
<!-- Modal -->
<div class="modal fade" id="subir-correciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Subir Correciones</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        
        <form enctype="multipart/form-data" id="form-upload-file-anexos-corregidos">
          <div class="form-group">
              <label for="file-ax1">Anexo 1</label>
              <div class="input-group">
                <input type="file" class="form-control" id="file-ax1" name="file-ax1">
                <span class="input-group-btn" id="btnverax1">
                  
                </span>
              </div>
              <input type="hidden" id="iddocumentovcorrecciones" name="iddocumentovcorrecciones">
            </div>
            <div class="form-group">
              <label for="file-pc">Proyecto corregido</label>
              <div class="input-group">
                <input type="file" class="form-control" id="file-pc" name="file-pc">
                <span class="input-group-btn" id="btnverpc">
                  
                </span>
              </div>
              
            </div>
            <div class="form-group">
              <label for="file-carta">Carta</label>
              <div class="input-group">
              <input type="file" class="form-control" id="file-carta" name="file-carta">
                <span class="input-group-btn" id="btnvercarta">
                  
                </span>
              </div>
              
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrar_documento_anexos_corregidos()">subir</button>
      </div>
    </div>
  </div>
</div>
<script src="../vistas/_recursos/js/jquery.min.js"></script>
<script type="text/javascript" src="js/console_seguimiento.js"></script>
<script src="../vistas/_recursos/js/consola_usuario.js"></script>
<script src="_plantilla/js/sweetalert.min.js"></script>
<script src="../vistas/_recursos/js/bootstrap.min.js"></script>
<script>buscardocumento()</script>
</body>
</html>
