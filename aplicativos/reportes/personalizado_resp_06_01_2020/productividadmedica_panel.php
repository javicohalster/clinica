<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();
?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
-->
</style>
<div align="center" class="style1">PRODUCTIVIDAD MEDICA</div>
<p>&nbsp;</p>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E6F1F2" class="style1"><strong>Fecha inicio </strong></td>
    <td bgcolor="#E6F1F2" class="style1"><strong>Fecha fin </strong></td>
    <td bgcolor="#E6F1F2" class="style1">Centro</td>
    <td bgcolor="#E6F1F2" class="style1">Personal</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="fecha_inicio" type="text" id="fecha_inicio"  autocomplete="off" ></td>
    <td><input name="fecha_fin" type="text" id="fecha_fin"  autocomplete="off" ></td>
     <td><select name="centro_id" id="centro_id" onchange="us_centro()">
       <option value="">--seleccionar--</option>
       <?php
	    $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",@$centro_id," where centro_activosistema=1 ",$DB_gogess);
	  ?>
     </select></td>
     <td><div id="ver_usuarios"><select name="usua_id" id="usua_id">
      <option value="">--seleccionar--</option>
	  <?php
	    $objformulario->fill_cmb("app_usuario","usua_id,usua_apellido,usua_nombre",@$usua_id," where usua_estado=1 order by usua_apellido asc",$DB_gogess);
	  ?> 
    </select></div></td>
	
    <td><input type="button" name="Button" value="Buscar" onClick="ejecuta_reporte()"></td>
    <td><input type="button" name="btnExport" id="btnExport" value="Excel" /></td>
  </tr>
</table>
<br><br>
<div id="ver_reporte" ></div>


<p>&nbsp;</p>

<script type="text/javascript">
<!--
$( "#fecha_inicio" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_fin" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>
<SCRIPT LANGUAGE=javascript>
<!--
function ejecuta_reporte()
{
 if($('#fecha_inicio').val()=='')
 {
  alert("Ingrese la fecha de inicio");
  return false;
 }
  if($('#fecha_fin').val()=='')
 {
 alert("Ingrese la fecha de fin");
  return false;
 }
 
 
  
 $("#ver_reporte").load("dns/productividad.php",{
    fecha_inicio:$('#fecha_inicio').val(),
	fecha_fin:$('#fecha_fin').val(),
	usua_id:$('#usua_id').val(),
	centro_id:$('#centro_id').val()
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}


function us_centro()
{
    $("#ver_usuarios").load("dns/listaus.php",{
    centro_id:$('#centro_id').val(),
	
  },function(result){  

  });  
  $("#ver_usuarios").html("Espere un momento...");  
    

}

//-->
</SCRIPT>
<script>
    $("#btnExport").click(function(e) {
        //window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()),'Excel');
        //e.preventDefault();
		
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		a.href = data_type + ', ' + encodeURIComponent($('#dvData').html());
		//setting the file name
		a.download = 'productividadme_<?php echo date("Y-m-d"); ?>.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		e.preventDefault();
		return (a);
		
    });
</script>