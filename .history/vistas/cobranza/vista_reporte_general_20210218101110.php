<script type="text/javascript" src="_recursos/js/consola_cobranza.js"></script>
<div class="contendor_kn">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h2><b>Revisores</b></h2>            
    </div>
    <div class="panel-body">
	    <div class="col-md-3"> 
	        <div class=" input-group">
	          	<input type="text" class="form-control" placeholder="Fecha desde" id="txtfecha_desde" name="txtfecha_desde">
	          	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
	    </div>
        <div class="col-md-3"> 
	        <div class=" input-group">
	          	<input type="text" class="form-control" placeholder="Fecha Hasta" id="txtfecha_hasta" name="txtfecha_hasta">
	          	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
	    </div>
        <div class="col-md-3"> 
	        <button class="btn btn-primary" onclick="exportarexcelpagardocente()">Exportar Excel</button>
	    </div>
        <div class="col-md-12">

         </div>
    </div>
  </div>
</div>