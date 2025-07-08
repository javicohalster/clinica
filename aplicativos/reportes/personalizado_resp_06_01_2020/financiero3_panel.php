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
<div align="center" class="style1">FINANCIERO </div>
<p>&nbsp;</p>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E6F1F2" class="style1">A&ntilde;o</td>
    <td bgcolor="#E6F1F2" class="style1">Mes</td>
    <td bgcolor="#E6F1F2" class="style1">Centro</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
  <tr>
    <td><select name="anio_valor" id="anio_valor" class="form-control" >
       <option value="2019">2019</option>
       <option value="2018">2018</option>
     </select></td>
     <td><select name="mes_valor" id="mes_valor" class="form-control" >
        <option value="">-MES-</option>
        <option value="01">ENERO</option>
        <option value="02">FEBRERO</option>
        <option value="03">MARZO</option>
        <option value="04">ABRIL</option>
        <option value="05">MAYO</option>
        <option value="06">JUNIO</option>
        <option value="07">JULIO</option>
        <option value="08">AGOSTO</option>
        <option value="09">SEPTIEMBRE</option>
        <option value="10">OCTUBRE</option>
        <option value="11">NOVIEMBRE</option>
        <option value="12">DICIEMBRE</option>
      </select></td>
     <td><select name="centro_id" id="centro_id">
      <option value="">--seleccionar--</option>
	  <?php
	    $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",@$centro_id," where centro_activosistema=1 ",$DB_gogess);
	  ?> 
    </select>    </td>
	
    <td><input type="button" name="Button" value="Buscar" onClick="ejecuta_reporte()"></td>
    <td><input type="button" name="btnExport" id="btnExport" value="Excel" /></td>
  </tr>
</table>
<br><br>
<div id="ver_reporte" ></div>


<p>&nbsp;</p>

<script type="text/javascript">
<!--
//$( "#fecha_inicio" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#fecha_fin" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>
<SCRIPT LANGUAGE=javascript>
<!--
function ejecuta_reporte()
{
 if($('#anio_valor').val()=='')
 {
  alert("Ingrese el a\u00f1o");
  return false;
 }
  if($('#mes_valor').val()=='')
 {
 alert("Ingrese el mes");
  return false;
 }
 
   if($('#centro_id').val()=='')
 {
 alert("Seleccione el Centro");
  return false;
 }
  

  
 $("#ver_reporte").load("dns/financiero3.php",{
    anio_valor:$('#anio_valor').val(),
	mes_valor:$('#mes_valor').val(),
	centro_id:$('#centro_id').val()
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

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
		a.download = 'financiero_<?php echo date("Y-m-d"); ?>.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		e.preventDefault();
		return (a);
		
    });
</script>