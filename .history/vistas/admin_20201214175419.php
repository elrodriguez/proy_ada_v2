<?php
session_start();
  if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Sistema Documentario | Panel</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="_recursos/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="_recursos/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="_recursos/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="_recursos/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="_recursos/css/font.css" type="text/css" />
  <link rel="stylesheet" href="_recursos/css/app.css" type="text/css" />
  <link rel="stylesheet" href="_recursos/js/sweetalert.css">
  <link href="_recursos/css/customs.css" rel="stylesheet">
  <script src="_recursos/js/jquery.min.js"></script>
  <script type="text/javascript" src="_recursos/js/consola_usuario.js"></script>
  <script type="text/javascript" src="_recursos/js/Console_menu.js"></script>
  <link type="text/css" rel="stylesheet" href="_recursos/input-file/css/disenio_input_2.css">
  <script src="_recursos/input-file/js/bootstrap-uploader/file-upload.js"></script>
   <link rel="stylesheet" href="_recursos/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="_recursos/css/mystyle.css">
</head>
<body>
  <input type="text" value="<?php echo $_SESSION['codigo_personal']; ?>"  hidden="true" id="txtcodigo_principal_usuario">
  <input type="text" value="<?php echo $_SESSION['nombre_usuario']; ?>" hidden="true" id="txtnombre_principal_usuario">
  <input type="text" value="<?php echo $_SESSION['codigo_usuario']; ?>" style="display: none" id="txtnombre_codigo_usuario">
  <div class="app app-header-fixed" id="app" action="index.php">
    <div class="app-header navbar">
      <div class="navbar-header bg-dark">
        <button class="pull-right visible-xs dk" data-toggle="class:show" data-target=".navbar-collapse" style="color:#ecf0f1;">
          <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" data-toggle="class:off-screen" data-target=".app-aside" ui-scroll="app"  style="color:#ecf0f1;">
          <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <a href="admin.php" class="navbar-brand text-lt">
          <!--<i class="glyphicon glyphicon-leaf icon text-success"></i>-->
          <i class="fa fa-list icon text-success"></i>
          <img src="_recursos/img/logo.png" alt="." class="hide">
          <span class="hidden-folded m-l-xs">Sis. Tramite</span>
        </a>
      </div>
      <div class="collapse pos-rlt navbar-menu-wrapper navbar-collapse box-shadow bg-white-only">
      <!--navbar-menu-wrapper d-flex align-items-stretch-->
        <div class="nav navbar-nav hidden-xs">
          <a href="#" class="btn no-shadow navbar-btn" data-toggle="class:app-aside-folded" data-target=".app">
            <i class="fa fa-dedent fa-fw text"></i>
            <i class="fa fa-indent fa-fw text-active"></i>
          </a>
          <a href class="btn no-shadow navbar-btn" data-toggle="class:show" data-target="#aside-user">
            <i class="icon-user fa-fw"></i>
          </a>
        </div>

        <ul class="nav navbar-nav navbar-right">
        <?php if ($_SESSION['usu']=="ADMINISTRADOR") {
        ?>
          <li class="dropdown">
            <a class="nav-link count-indicator dropdown-toggle"  id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell-o"></i>
              <div id="notificacion_palpante"></div>
            </a>
            <ul class="dropdown-menu animated fadeInRight w" style="width:375px">

              <li class="wrapper b-b m-b-sm bg-light m-t-n-xs">

                <div>
                    <a ui-sref="app.dashboard-v1"onclick="cargar_contenido('main-content','Verificar_documento/vista_verificardocumento_listar.php');">
                     <h4><strong>Documentos</strong> </h4>
                    </a>
                </div>
              </li>
              <div id="id_contenido">

              </div>
            </ul>
          </li>
        <?php
          }
        ?>
          <li class="dropdown"><!--style="width: 30px; height:40px "-->
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <div id="txtimagen1">

                </div>

                <i class="on md b-white bottom"></i>
              </span>
              <span class="hidden-sm hidden-md">
                <strong><?php echo $_SESSION['usu'] ?></strong> : <label id="txtnombre_usuario"></label></span>
              </span> <b class="caret"></b>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w hidden-folded" style="width:250px" >
              <li class="wrapper b-b m-b-sm bg-light m-t-n-xs">
                <div>
                  <p>Bienvenido</p>
                </div>
                <progressbar value="60" class="progress-xs m-b-none bg-white"></progressbar>
              </li>
              <li>
                <a onclick="abrirModalusuario()">
                  <span class="badge bg-danger pull-right">C</span>
                  <span>Configuracion de Cuenta</span>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="../controlador/usuario/controlador_usuario_cerrar_sesion.php">Salir</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div class="app-aside hidden-xs bg-dark">
      <div class="aside-wrap">
        <div class="navi-wrap">
          <div class="clearfix hidden-xs text-center hide" id="aside-user">
            <div class="dropdown wrapper">
              <a ui-sref="app.page.profile">
                <span class="thumb-lg w-auto-folded avatar m-t-sm">
                  <div id="txtimagen">

                  </div>
                </span>
              </a>
              <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><label id="txtnombre_usuario1"></label></span></strong>
              </span > <span class="text-muted text-xs block"><?php echo $_SESSION['usu']?> <b class="caret"></b></span> </span>
              </a>
              <ul class="dropdown-menu animated fadeInRight w hidden-folded">
                <li class="wrapper b-b m-b-sm bg-info m-t-n-xs">
                  <span class="arrow top hidden-folded arrow-info"></span>
                  <div>
                    <p>Bienvenido</p>
                  </div>
                  <progressbar value="60" type="white" class="progress-xs m-b-none dker"></progressbar>
                </li>
                <li><a onclick="abrirmodaladministrativo()">Datos Personales</a>
                </li>
               <li><a onclick="abrirModalusuario()" data-toggle="modal">Configuración de Cuenta</a></li>
                <li class="divider"></li>
                <li>
                  <a href="../controlador/usuario/controlador_usuario_cerrar_sesion.php">Salir</a>
                </li>
              </ul>
            </div>
            <div class="line dk hidden-folded"></div>
          </div>
          <nav ui-nav class="navi">
            <ul class="nav">
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span translate="aside.nav.HEADER" style="color: #fff; font-weight:bold">PANEL ADMINISTRATIVO</span>
              </li>
              <li>
                <a href class="auto">
                  <span class="pull-right text-muted">
                  <b class="badge bg-info pull-right">M</b>
                  </span>
                  <i class="fa fa-laptop icon text-success"></i>
                  <span class="font-bold" translate="aside.nav.Mantenimiento">MANTENIMIENTO</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li ui-sref-active="active">
                    <a  onclick="abrirmodaladministrativo()">
                    <span>Usuario</span>
                    </a>
                  </li>

                </ul>
            <?php if ($_SESSION['usu']=="ADMINISTRADOR") {
            ?>
              <li>
                <a href class="auto">
                  <span class="pull-right text-muted">
                  <b class="badge bg-info pull-right">P</b>
                  </span>
                  <i class="glyphicon glyphicon-user icon text-info-lter"></i>
                  <span class="font-bold" translate="aside.nav.Mantenimiento">PERSONAL</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li ui-sref-active="active" onclick="cargar_contenido('main-content','Personal/vista_listar_personal.php');">
                    <a ui-sref="app.dashboard-v2">
                    <span>Listar Personal</span>
                    </a>
                  </li>
                  <li ui-sref-active="active">
                    <a ui-sref="app.dashboard-v1" onclick="cargar_contenido('main-content','Personal/vista_registrar_personal.php');">
                    <span>Nuevo Personal</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- agregado final -->

              <li>
                <a href class="auto">
                  <span class="pull-right text-muted">
                  <b class="badge bg-info pull-right">P</b>
                  </span>
                  <i class="glyphicon glyphicon-user icon text-info-lter"></i>
                  <span class="font-bold" translate="aside.nav.Mantenimiento">ASESOR</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li ui-sref-active="active" onclick="cargar_contenido('main-content','Asesor/vista_listar_asesor.php');">
                    <a ui-sref="app.dashboard-v2">
                    <span>Listar Asesores</span>
                    </a>
                  </li>
                  <li ui-sref-active="active">
                    <a ui-sref="app.dashboard-v1" onclick="cargar_contenido('main-content','Asesor/vista_registrar_asesor.php');">
                    <span>Nuevo Asesor</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                <a href class="auto">
                  <span class="pull-right text-muted">
                  <b class="badge bg-info pull-right">C</b>
                  </span>
                  <i class="fa fa-briefcase icon text-info-lter text-success"></i>
                  <span class="font-bold" translate="aside.nav.Mantenimiento">ALUMNOS</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li ui-sref-active="active" onclick="cargar_contenido('main-content','Ciudadano/vista_listar_ciudadano.php');">
                    <a ui-sref="app.dashboard-v2">
                    <span>Listar Alumnos</span>
                    </a>
                  </li>
                  <li ui-sref-active="active">
                    <a ui-sref="app.dashboard-v1" onclick="cargar_contenido('main-content','Ciudadano/vista_registrar_ciudadano.php');">
                    <span>Nuevo Alumno</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- <li>
                <a href class="auto">
                  <span class="pull-right text-muted">
                  <b class="badge bg-info pull-right">I</b>
                  </span>
                  <i class="fa fa-folder-open icon text-info-lter"></i>
                  <span class="font-bold" translate="aside.nav.Mantenimiento">INSTITUCIÓN</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li ui-sref-active="active"onclick="cargar_contenido('main-content','Institucion/vista_institucion_listar.php');">
                    <a ui-sref="app.dashboard-v2">
                    <span>Listar Instituci&oacute;n</span>
                    </a>
                  </li>
                  <li ui-sref-active="active">
                    <a ui-sref="app.dashboard-v1"onclick="cargar_contenido('main-content','Institucion/vista_institucion_registrar.php');">
                    <span>Nueva Instituci&oacute;n</span>
                    </a>
                  </li>
                </ul>
              </li> -->
              <li>
                <a href class="auto">
                  <span class="pull-right text-muted">
                  <b class="badge bg-info pull-right">A</b>
                  </span>
                  <i class="fa fa-list icon text-success"></i>
                  <span class="font-bold">&Aacute;REA</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li ui-sref-active="active"onclick="cargar_contenido('main-content','Area/vista_area_listar.php');">
                    <a ui-sref="app.dashboard-v2">
                    <span>Listar &Aacute;reas</span>
                    </a>
                  </li>
                  <li ui-sref-active="active"onclick="cargar_contenido('main-content','Area/vista_area_registrar.php');">
                    <a ui-sref="app.dashboard-v2">
                    <span>Nueva &Aacute;rea</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li ui-sref-active="active">
                <a ui-sref="app.mail.list">
                  <b class="badge bg-info pull-right">D</b>
                  <i class="fa fa-file-text icon text-info-lter"></i>
                  <span class="font-bold" translate="aside.nav.Venta">DOCUMENTO</span>
                </a>
               <ul class="nav nav-sub dk">
                  <li ui-sref-active="active">
                    <a ui-sref="app.mail.list" onclick="cargar_contenido('main-content','Documento/vista_documento_listar.php')">
                    <span>Listar Documento</span>
                    </a>
                  </li>
                  <li ui-sref-active="active">
                    <a ui-sref="app.dashboard-v2 "onclick="cargar_contenido('main-content','Documento/vista_documento_registrar.php')">
                    <span>Nuevo Documento</span>
                    </a>
                  </li>
                </ul>
              </li>
               <li>
                <a href class="auto">
                  <span class="pull-right text-muted">
                  <b class="badge bg-info pull-right">TD</b>
                  </span>
                  <i class="fa fa-file icon text-success"></i>
                  <span class="font-bold">T. DOCUMENTO</span>
                </a>
                <ul class="nav nav-sub dk">
                  <li ui-sref-active="active">
                    <a ui-sref="app.dashboard-v1"onclick="cargar_contenido('main-content','Tipo_Documento/vista_tipoDocumento_Listar.php');">
                    <span>Lista de tipos de documentos</span>
                    </a>
                  </li>
                  <li ui-sref-active="active"onclick="cargar_contenido('main-content','Tipo_Documento/vista_tipoDocumento_Registrar.php');">
                    <a ui-sref="app.dashboard-v2">
                    <span>Nuevo Tipo de documento</span>
                    </a>
                  </li>
                </ul>
                </li>
              <li class="line dk">
              <li ui-sref-active="active">
                <a ui-sref="app.calendar">
                <span class="pull-right text-muted">
                  <b class="badge bg-info pull-right">R</b>
                  </span>
                  <i class="glyphicon glyphicon-print icon text-info-lter"></i>
                  <span class="font-bold" translate="aside.nav.Compra">REPORTES</span>
                </a>
                <ul class="nav nav-sub dk">
                    <li ui-sref-active="active"onclick="cargar_contenido('main-content','RangoFechas/vista_rangofechas_listar.php');">
                      <a ui-sref="app.dashboard-v2">
                        <span>Reportes de documentos - Rango Fechas</span>
                      </a>
                    </li>
                    <!-- <li ui-sref-active="active" onclick="AbrirReporteInstitucion()"  >
                      <a ui-sref="app.dashboard-v1">
                      <span>Reportes de documentos institucionales</span>
                      </a>
                    </li>
                    <li ui-sref-active="active"onclick="AbrirReporteCiudadano()">
                      <a ui-sref="app.dashboard-v2">
                      <span>Reporte de dcumento de personas</span>
                      </a>
                    </li> -->
                </ul>
              </li>
            <?php }
            ?>

<!-- __________________________________Segundo Usuario FRANCIS -->
              <?php if ($_SESSION['usu']=="ASISTENTE") {
              ?>
              <li ui-sref-active="active">
                <a ui-sref="app.mail.list">
                  <b class="badge bg-info pull-right">D</b>
                  <i class="fa fa-file-text icon text-info-lter"></i>
                  <span class="font-bold" translate="aside.nav.Venta">PROYECTO TESIS</span>
                </a>
               <ul class="nav nav-sub dk">
                  <li ui-sref-active="active">
                    <a ui-sref="app.mail.list" onclick="cargar_contenido('main-content','Documento/vista_documento_listar_asistente.php')">
                    <span>Listar</span>
                    </a>
                  </li>
                  <li ui-sref-active="active">
                    <a ui-sref="app.dashboard-v2 "onclick="cargar_contenido('main-content','Documento/vista_documento_registrar_asistente.php')">
                    <span>Registrar</span>
                    </a>
                  </li>
                </ul>
              </li>
            <?php }
            ?>
<!-- __________________________TERCER USUARIO_JOSE_______________________ -->
            <?php if ($_SESSION['usu']=="COORDINADOR") {
            ?>
            <li ui-sref-active="active">
              <a ui-sref="app.mail.list">
                <b class="badge bg-info pull-right">D</b>
                <i class="fa fa-file-text icon text-info-lter"></i>
                <span class="font-bold" translate="aside.nav.Venta">DOCUMENTO</span>
              </a>
             <ul class="nav nav-sub dk">
                <li ui-sref-active="active">
                  <a ui-sref="app.mail.list" onclick="cargar_contenido('main-content','Documento/vista_documento_listar_coordinador.php')">
                  <span>Listar Documento</span>
                  </a>
                </li>
                <li ui-sref-active="active">
                    <a ui-sref="app.dashboard-v1"onclick="cargar_contenido('main-content','Verificar_documento/vista_verificardocumento_listar_coordinador.php');">
                  <span>Estado de Documentos</span>
                  </a>
                </li>
                <li ui-sref-active="active">
                    <a ui-sref="app.administarion"onclick="cargar_contenido('main-content','Documento/vista_documento_listar_administrar_revisor.php');">
                    <span>ADMINISTRAR REVISORES</span>
                  </a>
                </li>
              </ul>
            </li>
          <?php }
          ?>
<!-- _________________________CUARTO USUARIO________________________ -->
          <?php if ($_SESSION['usu']=="REVISOR") {
          ?>
          <li ui-sref-active="active">
            <a ui-sref="app.mail.list">
              <b class="badge bg-info pull-right">D</b>
              <i class="fa fa-file-text icon text-info-lter"></i>
              <span class="font-bold" translate="aside.nav.Venta">DOCUMENTO</span>
            </a>
           <ul class="nav nav-sub dk">
              <li ui-sref-active="active">
                <a ui-sref="app.mail.list" onclick="cargar_contenido('main-content','Documento/vista_documento_listar.php')">
                <span>Listar Documento</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a ui-sref="app.dashboard-v2 "onclick="cargar_contenido('main-content','Documento/vista_documento_registrar.php')">
                <span>Nuevo Documento</span>
                </a>
              </li>
            </ul>
          </li>
          <?php }
          ?>

          <!-- ___________________________QUINTO USUARIO__________________ -->

          <?php if ($_SESSION['usu']=="COBRANZA") {
          ?>
          <li ui-sref-active="active">
            <a ui-sref="app.mail.list">
              <b class="badge bg-info pull-right">D</b>
              <i class="fa fa-file-text icon text-info-lter"></i>
              <span class="font-bold" translate="aside.nav.Venta">DOCUMENTO</span>
            </a>
           <ul class="nav nav-sub dk">
              <li ui-sref-active="active">
                <a ui-sref="app.mail.list" onclick="cargar_contenido('main-content','Documento/vista_documento_listar.php')">
                <span>Listar Documento</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a ui-sref="app.dashboard-v2 "onclick="cargar_contenido('main-content','Documento/vista_documento_registrar.php')">
                <span>Nuevo Documento</span>
                </a>
              </li>
            </ul>
          </li>
          <?php }
          ?>



          </nav>
          <!-- nav -->
        </div>
      </div>
    </div>
    <!-- / menu -->

    <!-- content -->
      <div class="app-content" id="main-content">
        <div class="contendor_kn">
          <div class="panel panel-default">
            <div class="panel-body">
              <div style="text-align: center;" align="center">
              <img style="text-align: center;" align="center" src="ucsur-fonfo.png">
              <div style="text-align: left;">
              <br>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>

    <!-- /content -->
    <!-- aside right -->
    <div class="app-aside-right pos-fix no-padder w-md w-auto-xs bg-white b-l animated fadeInRight hide">
      <div class="vbox">
        <div class="wrapper b-b b-t b-light m-b">
          <a href class="pull-right text-muted text-md" data-toggle="class:show" data-target=".app-aside-right"><i class="icon-close"></i></a>
          Chat
        </div>
        <div class="wrapper m-t b-t b-light">
          <form class="m-b-none">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Say something">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">SEND</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- / aside right -->

    <!-- footer -->
    <div class="app-footer wrapper b-t bg-light">
      <span class="pull-right">V.1.0.1 <a href="#app" class="m-l-sm text-muted"><i class="fa fa-long-arrow-up"></i></a></span>
      &copy; 2020 Copyright.
    </div>
    <!-- / footer -->
  </div>
  <!-- jQuery -->

  <script src="_recursos/js/sweetalert.min.js"></script>
  <script src="_recursos/js/jquery.min.js"></script>
  <script src="_recursos/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="_recursos/js/Console_menu.js"></script>
  <script src="_recursos/select2/dist/js/select2.full.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script type="text/javascript">filtrar_DocumentosPendientes();</script>
  <script type="text/javascript">


    function cargar_contenido(contenedor,contenido){
      $("#"+contenedor).load(contenido);
    }
  </script>
  <!-- Pluggin -->

  <!-- Final Pluggin -->
  <style type="text/css">
  .contendor_kn{
    padding: 10px;
  }
</style>
<script type="text/javascript">
  function AbrirReporteInstitucion(){
    window.open('Reportes/php/generar_reporte_institucion.php', '_blank');
  }

  function AbrirReporteCiudadano(){
    window.open('Reportes/php/generar_reporte_persona.php', '_blank');
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
  <style type="text/css">
    label{
      font-weight:bold;
    }
    select{
      font-weight:bold;
      text-align-last:center;
      padding-right: 29px;
    }
    button{
    font-weight:bold;
    }
  </style>
  <script type="text/javascript">
    +function ($) {
      $(function(){
        // class
        $(document).on('click', '[data-toggle^="class"]', function(e){
          e && e.preventDefault();
          console.log('abc');
          var $this = $(e.target), $class , $target, $tmp, $classes, $targets;
          !$this.data('toggle') && ($this = $this.closest('[data-toggle^="class"]'));
          $class = $this.data()['toggle'];
          $target = $this.data('target') || $this.attr('href');
          $class && ($tmp = $class.split(':')[1]) && ($classes = $tmp.split(','));
          $target && ($targets = $target.split(','));
          $classes && $classes.length && $.each($targets, function( index, value ) {
            if ( $classes[index].indexOf( '*' ) !== -1 ) {
              var patt = new RegExp( '\\s' +
                  $classes[index].
                    replace( /\*/g, '[A-Za-z0-9-_]+' ).
                    split( ' ' ).
                    join( '\\s|\\s' ) +
                  '\\s', 'g' );
              $($this).each( function ( i, it ) {
                var cn = ' ' + it.className + ' ';
                while ( patt.test( cn ) ) {
                  cn = cn.replace( patt, ' ' );
                }
                it.className = $.trim( cn );
              });
            }
            ($targets[index] !='#') && $($targets[index]).toggleClass($classes[index]) || $this.toggleClass($classes[index]);
          });
          $this.toggleClass('active');
        });

        // collapse nav
        $(document).on('click', 'nav a', function (e) {
          var $this = $(e.target), $active;
          $this.is('a') || ($this = $this.closest('a'));

          $active = $this.parent().siblings( ".active" );
          $active && $active.toggleClass('active').find('> ul:visible').slideUp(200);

          ($this.parent().hasClass('active') && $this.next().slideUp(200)) || $this.next().slideDown(200);
          $this.parent().toggleClass('active');

          $this.next().is('ul') && e.preventDefault();

          setTimeout(function(){ $(document).trigger('updateNav'); }, 300);
        });
      });
    }(jQuery);
  </script>
<div class="modal fade bs-example-modal-lg" id="modal_editar_adminsitrador" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel"><label> EDITAR DATOS PERSONALES</label></h4>
         </div>
        <div class="modal-body">
          <div class="contendor_kn">
            <div class="panel panel-default">
              <div class="panel-body">
                <form method="POST" id="update-form-administrador">
                  <div class="col-md-6">
                    <input type="text" id="personal_id" name="personal_id" hidden value="<?php echo $_SESSION['codigo_personal']?>" >
                    <label  class="col-sm-4 control-label">Nombres </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" onkeypress="return soloLetras(event)" name="nombres_personal" id="nombres_personal" placeholder="Ingrese Nombres" maxlength="">
                      <br>
                    </div>
                    <label  class="col-sm-4 control-label">Apellido Paterno </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control"onkeypress="return soloLetras(event)"  name="apePate_personal" id="apePate_personal" placeholder="Ingrese Apellido Paterno" maxlength="">
                      <br>
                    </div>
                    <label  class="col-sm-4 control-label">Apellido Materno </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" onkeypress="return soloLetras(event)" name="apeMate_personal" id="apeMate_personal" placeholder="Ingrese Apelido Materno" maxlength="">
                      <br>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-sm-12" style="text-align:center">
                      <label  class="control-label">Fotograf&iacute;a</label><br>
                      <div id="txtimagen2">

                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label  class="col-sm-2 control-label">Email </label>
                    <div class="col-sm-4">
                      <input type="email" class="form-control"  style="width: 94%"  name="email_personal" id="email_personal" placeholder="Ingrese email" maxlength="100">
                      <br>
                    </div>
                    <label  class="col-sm-2 control-label">Tel&eacute;fono </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" onkeypress="return soloNumeros(event)"  name="telefono_personal" id="telefono_personal" placeholder="Ingrese nro telefóno" maxlength="9">
                      <br>
                    </div>

                    <label  class="col-sm-2 control-label">Movil </label>
                    <div class="col-sm-4">
                      <input type="text" style="width: 94%" class="form-control" name="movil_personal" id="movil_personal"  onkeypress="return soloNumeros(event)" placeholder="Ingrese nro movil" maxlength="9">
                      <br>
                    </div>
                    <label  class="col-sm-2 control-label">Direcci&oacute;n </label>
                    <div class="col-sm-4">
                      <input type="text"  class="form-control"  onkeypress="return soloLetras(event)" name="direccion_personal" id="direccion_personal" placeholder="Ingrese dirección" maxlength="200">
                      <br>
                    </div>
                    <label  class="col-sm-2 control-label">Fecha Nacimiento </label>
                    <div class="col-sm-4">
                      <div class=" input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" style="width: 94%;padding: 0px 12px;"  id="fechanacimiento_personal"  name="fechanacimiento_personal"  class="form-control"  >
                      </div>
                    </div>
                    <label  class="col-sm-2 control-label">DNI </label>
                    <div class="col-sm-4">
                      <input type="text"  class="form-control"  onkeypress="return soloNumeros(event)" name="dni_personal" id="dni_personal" placeholder="Ingrese DNI" maxlength="13">
                      <br>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xs-12" style="text-align:center;" >
                    <br>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4" >
                       <button class="btn btn-success"  style="width: 100%" ><span class="glyphicon glyphicon-floppy-saved" ></span>&nbsp;<b>Modificar Datos</b></button><br>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-close"></i><strong> Close</strong></button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_cuenta"  style="padding:50px 0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="mimodal_registrar"><label>Configuraci&oacute;n de la Cuenta</label></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="formulario_usuario">
              <div class="box-body">
                <div class="" id="msj_persona">
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Tipo Usuario</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" style="background:#fff;font-weight:bold;" value="<?php echo $_SESSION['usu'] ?>" disabled="" id="tipo_usuario" placeholder="Tipo Usuario" maxlength="40">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Usuario</label>
                  <div class="col-sm-5">
                    <input type="text" id="txtoriginal" value="" hidden='true'>
                    <input type="text"  style="background:#fff;font-weight:bold;" id="txtusuario" class="form-control" value="<?php echo $_SESSION['usuario'] ?>" disabled=""  placeholder="Usuario" maxlength="30">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"> Actual</label>
                  <div class="col-sm-5">
                    <input type="password" class="form-control"  id="txtactual" placeholder="contrasenia Actual" maxlength="30">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Nueva </label>
                  <div class="col-sm-5">
                    <input type="password" class="form-control"  id="txtnueva" placeholder="Nueva contrasenia" maxlength="30">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Repetir Contraseña Nueva</label>
                  <div class="col-sm-5">
                    <input type="password" class="form-control" id="txtrepetir" placeholder="repetir contrasenia nueva" maxlength="30">
                  </div>

                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <button type="button" style="cursor:pointer;" onclick="Editar_cuenta();" class="btn btn-success"><b>Actualizar </b>&nbsp;&nbsp; <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> </button>
              </div>
              <!-- /.box-footer -->
            </form>
        </div>
        <div class="modal-footer">
          <div class="form-group">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><b> Cerrar</b></button>

          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
  traer_administrador();
    $(document).on('submit', '#update-form-administrador', function() {
      var data = $(this).serialize();
      $.ajax({
        type : 'POST',
        mimeType: "multipart/form-data",
        url  : '../controlador/personal/controlador_editar_administrador.php',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success:function(resp) {
          $("#modal_editar_adminsitrador").modal('hide');
          traer_administrador();
          document.getElementById("update-form-administrador").reset();
          if(resp>0){
            swal("Datos Actualizados","","success")
            .then ( ( value ) =>  {
              document.getElementById("update-form-administrador").reset();
              traer_administrador();
            } ) ;
          }else{
            swal("Lo sentimos los datos no fueron registrados","","error")
            .then ( ( value ) =>  {
              document.getElementById("update-form-administrador").reset();
              traer_administrador();
            } ) ;
          }
          traer_administrador();
        }
      });
      return false;
    });
</script>

</body>
</html>
