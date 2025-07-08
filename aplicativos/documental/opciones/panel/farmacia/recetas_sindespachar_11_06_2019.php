<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");


?>
<?php


 	//
	//dns_odontoplantra 	 
$lista_medicametos="select * from dns_atencion inner join dns_anamesisexamenfisico on dns_atencion.atenc_id=dns_anamesisexamenfisico.atenc_id inner join  dns_recetaanamesisexamenfisico on  dns_anamesisexamenfisico.anam_enlace=dns_recetaanamesisexamenfisico.anam_enlace where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='' and DATE_ADD(plantra_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
?>
<style type="text/css">
<!--
.style1 {
	font-size: 10px;
	font-weight: bold;
}
.style2 {font-size: 10px}
-->
</style>

<div id="ejecutando_dataval">
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO PRIMERA VEZ</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style1">C&oacute;digo</span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style1">Medicamento</span></td>
	<td bgcolor="#E2EFF3"><span class="style1">Consentraci&oacute;n</span></td>
	<td bgcolor="#E2EFF3"><span class="style1">Indicaciones</span></td>
    <td bgcolor="#E2EFF3"><span class="style1">Cantidad</span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
	<td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_indicaciones"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_fecharegistro"];  ?></td>
    <td><input type="button" name="Button" value="--&gt;" onClick="ejecuta_despachar('<?php echo $rs_medi1->fields["plantra_id"]; ?>','dns_recetaanamesisexamenfisico')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>

<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS PRIMERA VEZ </strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_anamesisexamenfisico';
$tablareceta='dns_dispositivomedicoexafisico';
$enlace="anam_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button2" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO SUBSECUENTE</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
	<td bgcolor="#E2EFF3"><span class="style2"><strong>Consentraci&oacute;n</strong></span></td>
	<td bgcolor="#E2EFF3"><span class="style2"><strong>Presentaci&oacute;n</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
	<td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_consultaexterna';
$tablareceta='dns_recetaconsultaexterna';
$enlace="conext_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='' and DATE_ADD(plantra_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
	<td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_presentacion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_fecharegistro"];  ?></td>
    <td><input type="button" name="Button" value="--&gt;" onClick="ejecuta_despachar('<?php echo $rs_medi1->fields["plantra_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>


<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS SUBSECUENTE</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
	<td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_consultaexterna';
$tablareceta='dns_dispositivomedicoexterno';
$enlace="conext_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
	<td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>


<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO ODONTOLOGIA</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
	<td bgcolor="#E2EFF3"><span class="style2"><strong>Consentraci&oacute;n</strong></span></td>
	<td bgcolor="#E2EFF3"><span class="style2"><strong>Presentaci&oacute;n</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
	<td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_odontologia';
$tablareceta='dns_odontoplantra';
$enlace="odonto_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='' and DATE_ADD(plantra_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
	<td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_presentacion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_fecharegistro"];  ?></td>
    <td><input type="button" name="Button" value="--&gt;" onClick="ejecuta_despachar('<?php echo $rs_medi1->fields["plantra_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>


<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS ODONTOLOGIA</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_odontologia';
$tablareceta='dns_dispositivomedicoodontologia';
$enlace="odonto_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button3" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO SUBSECUENTE ODONTOLOGIA</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Consentraci&oacute;n</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Presentaci&oacute;n</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_subsecuenteodontologia';
$tablareceta='dns_recetasodontologia';
$enlace="subsecodont_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='' and DATE_ADD(plantra_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_presentacion"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_fecharegistro"];  ?></td>
    <td><input type="button" name="Button4" value="--&gt;" onClick="ejecuta_despachar('<?php echo $rs_medi1->fields["plantra_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS SUBSECUENTE ODONTOLOGIA</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_subsecuenteodontologia';
$tablareceta='dns_dispositivosodontologia';
$enlace="subsecodont_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button33" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS PSICOLOGIA </strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_psicologia';
$tablareceta='dns_dispositivospsicologia';
$enlace="psicolo_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button32" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS LABORATORIO </strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_laboratorioinforme';
$tablareceta='dns_dispositivoslaboratorio';
$enlace="labinfor_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button322" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS IMAGENOLOGIA</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_imagenologiainfo';
$tablareceta='dns_dispositivosimagen';
$enlace="imginfo_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button3222" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS REHABILITACI&Oacute;N</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_fisioterapia';
$tablareceta='dns_dispositivosfisioterapia';
$enlace="fisiot_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button32222" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS PROCEDIMIENTOS INVASIVOS </strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_procediminetosinvasivos';
$tablareceta='dns_dispositivosinvasivos';
$enlace="prinvas_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button322222" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS ENFERMERIA </strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_enfermeria';
$tablareceta='dns_dispositivosenfermeria';
$enlace="enferm_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button3222222" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO PRE HOSPITALARIO</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Consentraci&oacute;n</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Presentaci&oacute;n</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_prehospitalario';
$tablareceta='dns_recetaprehospitalario';
$enlace="prehosp_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='' and DATE_ADD(plantra_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_presentacion"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_fecharegistro"];  ?></td>
    <td><input type="button" name="Button5" value="--&gt;" onClick="ejecuta_despachar('<?php echo $rs_medi1->fields["plantra_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS PRE HOSPITALARIO </strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_prehospitalario';
$tablareceta='dns_dispositivomedicoprehospitalario';
$enlace="prehosp_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button32222222" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="550" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS ACTIVIDADES EXTRAMURALES</strong></div></td>
  </tr>
  <tr>
    <td width="94" bgcolor="#E2EFF3"><span class="style2"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style2"><strong>Medicamento</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style2"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3" class="style1">Fecha</td>
    <td width="30" bgcolor="#E2EFF3"><span class="style2"></span></td>
  </tr>
  <?php
$tablaprincipa='dns_visitadomiciliaria';
$tablareceta='dns_dispositivosvisitadom';
$enlace="vidomici_enlace";

$lista_medicametos="select * from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='' and DATE_ADD(plantrai_fecharegistro,INTERVAL 3 DAY)>=NOW()";

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());
  
  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fecharegistro"];  ?></td>
    <td><input type="button" name="Button322222222" value="--&gt;" onClick="ejecuta_despachardispositivo('<?php echo $rs_medi1->fields["plantrai_id"]; ?>','<?php echo $tablareceta; ?>')"></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
</div>
<div id="grid_ejecuta_despachar"></div>
<script type="text/javascript">

function ejecuta_despachar(id,tabla)
{
  
  $("#grid_ejecuta_despachar").load("aplicativos/documental/opciones/panel/farmacia/despachar.php",{

  plantra_id:id,
  tabla:tabla,
  centro_id:'<?php echo $_SESSION['datadarwin2679_centro_id'];  ?>',
  usua_id:'<?php echo $_SESSION['datadarwin2679_sessid_inicio']; ?>'

  },function(result){  
  
ejecutaz_data();

  });  

  $("#ejecutando_dataval").html("Espere un momento...");
  $("#grid_ejecuta_despachar").html("Espere un momento..."); 
  
   


}

function ejecuta_despachardispositivo(id,tabla)
{
  
  $("#grid_ejecuta_despachar").load("aplicativos/documental/opciones/panel/farmacia/despachard.php",{

  plantra_id:id,
  tabla:tabla,
  centro_id:'<?php echo $_SESSION['datadarwin2679_centro_id'];  ?>',
  usua_id:'<?php echo $_SESSION['datadarwin2679_sessid_inicio']; ?>'

  },function(result){  
ejecutaz_data();

  });  

  $("#grid_ejecuta_despachar").html("Espere un momento...");  


}

</script>
