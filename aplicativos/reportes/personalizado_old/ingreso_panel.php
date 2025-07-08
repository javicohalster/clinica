<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
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

 
  
 $("#ver_reporte").load("faesa/lista_usuarios.php",{
	centro_id:$('#centro_id').val(),
	estado:$('#estado').val()
	
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}

function a_excel()
{
	var fecha_inicio=$('#fecha_inicio').val();
	var fecha_fin=$('#fecha_fin').val();
	var tipopac_id=$('#tipopac_id').val();
	
//window.open('lista_faltaronexel.php?fecha_inicio=' + fecha_inicio +'&fecha_fin='+fecha_fin+'&tipopac_id='+tipopac_id,'ventana1','width=750,height=500,scrollbars=YES');

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
<div align="center" class="style1"> LISTA DE ACCESOS </div>
<p>&nbsp;</p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	 <td bgcolor="#E6F1F2" class="style1">Centro</td>
     <td bgcolor="#E6F1F2" class="style1">Estado</td>
     <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
  <tr>

	<td><select name="centro_id" id="centro_id">
      <option value="">--seleccionar centro--</option>
	  <?php
	    $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",@$centro_id,@$orden,$DB_gogess);
	  ?> 
    </select>    </td>
    <td><select name="estado" id="estado">
      <option value="">--seleccionar --</option>
      <option value="SI">Ingreso</option>
      <option value="NO">No Ingreso</option>
      
    </select></td>
    <td><input type="button" name="Button" value="Buscar" onclick="ejecuta_reporte()" /></td>
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