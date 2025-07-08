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

 
 
  
 $("#ver_reporte").load("lista_detallado.php",{
    fecha_inicio:$('#fecha_inicio').val(),
	fecha_fin:$('#fecha_fin').val(),
	even_id:$('#even_id').val()
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}

function a_excel()
{
	
	
window.open('lista_detalladoexel.php','ventana1','width=750,height=500,scrollbars=YES');

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
<div align="center" class="style1">ASISTENCIA DETALLADA</div>
<div align="center" class="style1"><input type="button" name="Button2" value="Excel" onclick="a_excel()" /></div>

<?php
$fecha_hoy=date("Y-m-d");

$dt_laSemanaPasada = date('Y-m-d', strtotime('-4 week')) ; // resta 1 semana
?>

<p>&nbsp;</p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  
</table>

<div id="ver_reporte" ></div>


<p>&nbsp;</p>

<script type="text/javascript">
<!--
$( "#fecha_inicio" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_fin" ).datepicker({dateFormat: 'yy-mm-dd'});

ejecuta_reporte();
//  End -->
</script>