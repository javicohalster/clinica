<?php
ini_set("session.cookie_lifetime",4445000);
ini_set("session.gc_maxlifetime",4445000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles


$director="../../../director/";
include ("../../../director/cfgclases/clases.php");

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
  
 $("#ver_reporte").load("faesa/altasxasesor.php",{
    fecha_inicio:$('#fecha_inicio').val(),
	fecha_fin:$('#fecha_fin').val(),
	usua_id:$('#usua_id').val()
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}

function a_excel()
{
	var fecha_inicio=$('#fecha_inicio').val();
	var fecha_fin=$('#fecha_fin').val();
	var usua_id=$('#usua_id').val();
	
window.open('lista_faltaronexel.php?fecha_inicio=' + fecha_inicio +'&fecha_fin='+fecha_fin+'&usua_id='+usua_id,'ventana1','width=750,height=500,scrollbars=YES');

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
<div align="center" class="style1">NUMERO DE ALTAS POR TERAPEUTA </div>
<p>&nbsp;</p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E6F1F2" class="style1"><strong>Fecha inicio </strong></td>
    <td bgcolor="#E6F1F2" class="style1"><strong>Fecha fin </strong></td>
     <td bgcolor="#E6F1F2" class="style1">Terapeuta</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
    
  </tr>
  <tr>
    <td><input name="fecha_inicio" type="text" id="fecha_inicio"></td>
    <td><input name="fecha_fin" type="text" id="fecha_fin"></td>
     <td><select name="usua_id" id="usua_id">
      <option value="">--seleccionar evento--</option>
	  <?php
	    $objformulario->fill_cmb("app_usuario","usua_id,usua_nombre,usua_apellido",@$usua_id,@$orden,$DB_gogess);
	  ?> 
    </select>
    </td>
	
    <td><input type="button" name="Button" value="Buscar" onClick="ejecuta_reporte()"></td>
    
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