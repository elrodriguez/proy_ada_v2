<script type="text/javascript" src="_recursos/js/console_area.js"></script>
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h2><b>REPORTE DOCUMENTO - RANGO FECHAS</b></h2>
    </div>
    <div class="panel-body">
        <br><br>
        
          <div class="col-md-6" style="text-align:center">
            <label><strong>Fecha Inicio&nbsp;&nbsp;</strong> </label>
            <input id="txt_modal_fecha1" class="form-control" style="padding: 0px 202px;" type="date" ><br>
          </div>
          <div class="col-md-6" style="text-align:center">
            <label><strong>Fecha Final&nbsp;&nbsp;</strong> </label>
            <input id="txt_modal_fecha2"  class="form-control" style="padding: 0px 202px;" type="date" ><br>
          </div>
          <div class="col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-4" style="text-align: center;"><br><br>
              <form method="GET" action="Reportes/php/generar_reporte_rangofechas.php" target="_blank"><br>
                <input id="reporte_fecha1" hidden="true" name="reporte_fecha1" >
                    <input id="reporte_fecha2" hidden="true" name="reporte_fecha2" >
              <button id="btn-imprimir" name="btn-imprimir" style="width:100%" type="submit" class="btn btn-danger"><i class='glyphicon glyphicon-print'></i>&nbsp;&nbsp;<strong>IMPRIMIR REPORTE</strong></button>  
              </form>
            </div>
          </div>
       
    </div>
  </div>
</div>
<style type="text/css">
	.contendor_kn{
		padding: 10px;
	}
</style>
<script type="text/javascript">
    $("#txt_modal_fecha1").change(function(){
      var fecha1 = $("#txt_modal_fecha1").val();
      var fecha2 = $("#txt_modal_fecha2").val();
      $("#reporte_fecha1").val(fecha1);
      $("#reporte_fecha2").val(fecha2);
    }); 
    $("#txt_modal_fecha2").change(function(){
      var fecha1 = $("#txt_modal_fecha1").val();
      var fecha2 = $("#txt_modal_fecha2").val();
      $("#reporte_fecha1").val(fecha1);
      $("#reporte_fecha2").val(fecha2);
    }); 
</script>