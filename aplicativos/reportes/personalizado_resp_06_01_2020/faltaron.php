<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$ireport=$_GET["ireport"];
$director="../../../adm_ministry/";
include ("../../../adm_ministry/cfgclases/clases.php");

?>
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
  
 $("#ver_reporte").load("lista_faltaron.php",{
    fecha_inicio:$('#fecha_inicio').val(),
	fecha_fin:$('#fecha_fin').val(),
	even_id:$('#even_id').val()
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}

function a_excel()
{
	var fecha_inicio=$('#fecha_inicio').val();
	var fecha_fin=$('#fecha_fin').val();
	var even_id=$('#even_id').val();
	
window.open('lista_faltaronexel.php?fecha_inicio=' + fecha_inicio +'&fecha_fin='+fecha_fin+'&even_id='+even_id,'ventana1','width=750,height=500,scrollbars=YES');

}
//-->
</SCRIPT>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
-->
</style>
<div align="center" class="style1">FALTARON RANGO DE FECHA</div>
<div align="center" class="style1">SE TOMA EN CUENTA SU ULTIMA ASISTENCIA</div>
<p>&nbsp;</p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E6F1F2" class="style1"><strong>Fecha inicio </strong></td>
    <td bgcolor="#E6F1F2" class="style1"><strong>Fecha fin </strong></td>
     <td bgcolor="#E6F1F2" class="style1">Evento</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="fecha_inicio" type="text" id="fecha_inicio"></td>
    <td><input name="fecha_fin" type="text" id="fecha_fin"></td>
     <td><select name="even_id" id="even_id">
      <option value="0">--seleccionar evento--</option>
	  <?php
	$objformulario->fill_cmb("app_eventos","even_id,even_nombre",@$even_id,@$orden,$DB_gogess);
	  ?>
	  
    </select>
    </td>
	
    <td><input type="button" name="Button" value="Buscar" onClick="ejecuta_reporte()"></td>
    <td><input type="button" name="Button2" value="Excel" onclick="a_excel()" /></td>
  </tr>
</table><br><br>
<div id="ver_reporte" ></div>


<p>&nbsp;</p>

<script type="text/javascript">
<!--
$( "#fecha_inicio" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_fin" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>