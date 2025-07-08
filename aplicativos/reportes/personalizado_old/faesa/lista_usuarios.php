<style type="text/css">
<!--
.css_titulo {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_texto {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$director="../../../../director/";
include ("../../../../director/cfgclases/clases.php");



$sql1='';
if(@$_POST["tipopac_id"])
  {
   $sql1=" tipopac_id=".$_POST["tipopac_id"]." and ";
  }
$sql2="";
if($_POST["centro_id"])
  {
   $sql2=" app_usuario.centro_id=".$_POST["centro_id"]." and ";
  }
  
$sql3="";

  
$sql4="";



$sql5="";

  

$concatena_sql=$sql1.$sql2.$sql3.$sql4.$sql5;

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_POST["centro_id"],$DB_gogess);

echo "<center><b>".$nciudad."</b></center>";



if($concatena_sql)
  {
$lista_pacientes="select * from app_usuario left join dns_centrosalud on app_usuario.centro_id=dns_centrosalud.centro_id where ".$concatena_sql." usua_estado>=0 and usua_ciruc not in ('1711467884')";
}
else
{
$lista_pacientes="select * from app_usuario left join dns_centrosalud on app_usuario.centro_id=dns_centrosalud.centro_id where usua_estado>=0  and usua_ciruc not in ('1711467884')";

}

//echo $lista_pacientes;
$super_total=0;
?>
<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>

<style type="text/css">
.botonExcel{cursor:pointer;}
</style>

<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="export_to_excel.gif" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>

<div id="Exportar_a_Excel" >

<table width="800" border="1" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#D2E2EE"><span class="css_titulo">No</span></td>
    <td bgcolor="#D2E2EE"><span class="css_titulo">CI</span></td>
	<td bgcolor="#D2E2EE" class="css_titulo">CARGO</td>
	<td bgcolor="#D2E2EE" class="css_titulo">FORMACION PROFESIONAL</td>
	
    <td bgcolor="#D2E2EE" class="css_titulo">NOMBRE</td>
    <td bgcolor="#D2E2EE" class="css_titulo">APELLIDO</td>
    <td bgcolor="#D2E2EE" class="css_titulo">CENTRO</td>
	
	<td bgcolor="#D2E2EE" class="css_titulo">FECHA DE ULTIMO INGRESO AL SISTEMA</td>
	<td bgcolor="#D2E2EE" class="css_titulo">ESTADO</td>
  </tr>
  <?php
  $fecha_ingreso='';
  $cuenta_num=0;
   $rs_gogessform = $DB_gogess->Execute($lista_pacientes);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		$suma_totale=0;
		$cuenta=1;
        $cuenta_num++;
		$fecha_ingreso='';
		$bandera='NO';
		$lista_terap="select hiing_fecha from app_historicoing where hiing_cedula='".$rs_gogessform->fields["usua_ciruc"]."' order by hiing_fecha desc limit 1";
		
		$rs_lterap = $DB_gogess->Execute($lista_terap);
		
		if($rs_lterap){
			while (!$rs_lterap->EOF) {
			
			$fecha_ingreso='';
			$fecha_ingreso=$rs_lterap->fields["hiing_fecha"];
			$bandera='SI';
		
			$rs_lterap->MoveNext();	
			}
		}
		
	if($_POST["estado"])
  {	
   if($bandera==$_POST["estado"])
   {
  ?>
  <tr>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $cuenta_num; ?></span></td>
    <td valign="top" nowrap="nowrap" style=mso-number-format:"@"; class=css_texto >&nbsp;<?php echo $rs_gogessform->fields["usua_ciruc"]; ?></td>
	<td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $rs_gogessform->fields["usua_codigoiniciales"]; ?></span></td>
	<td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $rs_gogessform->fields["usua_formaciondelprofesional"]; ?></span></td>
	
	<td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo utf8_encode($rs_gogessform->fields["usua_nombre"]); ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo utf8_encode($rs_gogessform->fields["usua_apellido"]); ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo utf8_encode($rs_gogessform->fields["centro_nombre"]); ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $fecha_ingreso; ?><br /><b>Lista Ingresos</b><br /><?php 
	$cuenta_ing=0;
	$lista_ingresos="select * from app_historicoing where hiing_cedula='".$rs_gogessform->fields["usua_ciruc"]."'";
	$rs_listaing = $DB_gogess->Execute($lista_ingresos);
	if($rs_listaing){
			while (!$rs_listaing->EOF) {
			
			echo $rs_listaing->fields["hiing_fecha"]." -- ".$rs_listaing->fields["hiing_ip"]."<br>";
			$cuenta_ing++;
			
			$rs_listaing->MoveNext();	
			}
	}		
	
	 ?>
     <br /><b>Total Ingresos:<?php echo $cuenta_ing; ?></b>
	 </span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $bandera; ?></span></td> 
  </tr>
  <?php
    }
  }
  else{
	 ?> 
  <tr>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $cuenta_num; ?></span></td>
    <td valign="top" nowrap="nowrap" style=mso-number-format:"@"; class=css_texto >&nbsp;<?php echo $rs_gogessform->fields["usua_ciruc"]; ?></td>
	<td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $rs_gogessform->fields["usua_codigoiniciales"]; ?></span></td>
	<td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $rs_gogessform->fields["usua_formaciondelprofesional"]; ?></span></td>
	
	
	<td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo utf8_encode($rs_gogessform->fields["usua_nombre"]); ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo utf8_encode($rs_gogessform->fields["usua_apellido"]); ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo utf8_encode($rs_gogessform->fields["centro_nombre"]); ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $fecha_ingreso; ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $bandera; ?></span></td> 
  </tr>
	  <?php
  }
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
</table>

</div>
