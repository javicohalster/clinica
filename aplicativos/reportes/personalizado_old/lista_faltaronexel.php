<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."rep_".$fechahoy.".xls");
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$ireport=$_GET["ireport"];
$director="../../../adm_ministry/";
include ("../../../adm_ministry/cfgclases/clases.php");
//echo $_GET["even_id"];
?>
<style type="text/css">
<!--
.style5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.style8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<table border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#E8F3F4"><span class="style5">No.</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Fecha asistencia</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Nombre</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Apellido</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Genero</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Edad</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Estado Civil </span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Direcci&oacute;n</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Celular</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Tel&eacute;fono fijo </span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Email</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Horario contacto </span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Como te enteraste? </span></td>
    
  </tr>
  <?php
  $contador=0;
  if(@$_GET["even_id"])
  {
 $listacampos1="select distinct app_cliente.clie_id,asis_fecharegistro,clie_nombre,clie_apellido,clie_genero,clie_estadocivil,clie_direccion,clie_celular,clie_telefono,clie_email,clie_horariocontacto,clie_comoteenteraste,clie_megustaria from app_cliente inner join app_asistencia on app_cliente.clie_id=app_asistencia.clie_id where even_id=".@$_GET["even_id"]." order by asis_fecharegistro desc";
  }
  else
  {
$listacampos1="select distinct app_cliente.clie_id,asis_fecharegistro,clie_nombre,clie_apellido,clie_genero,clie_estadocivil,clie_direccion,clie_celular,clie_telefono,clie_email,clie_horariocontacto,clie_comoteenteraste,clie_megustaria from app_cliente inner join app_asistencia on app_cliente.clie_id=app_asistencia.clie_id order by asis_fecharegistro desc";	  
	  
  }
 
 //echo $listacampos1;
 $rs_gogessform = $DB_gogess->Execute($listacampos1);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		$desplegar=1;
		//reglas
		if(@$_GET["even_id"])
       {
		$fechas_menores="select asis_id,asis_asiste from app_asistencia left join app_eventos on app_asistencia.even_id=app_eventos.even_id where clie_id=".$rs_gogessform->fields["clie_id"]." and asis_fecharegistro >= '".$_GET["fecha_inicio"]."' and asis_fecharegistro<='".$_GET["fecha_fin"]."' and app_asistencia.even_id=".$_GET["even_id"];
		}
		else
		{
		
		$fechas_menores="select asis_id,asis_asiste from app_asistencia left join app_eventos on app_asistencia.even_id=app_eventos.even_id where clie_id=".$rs_gogessform->fields["clie_id"]." and asis_fecharegistro >= '".$_GET["fecha_inicio"]."' and asis_fecharegistro<='".$_GET["fecha_fin"]."'";
		}
		
		$rs_menores = $DB_gogess->Execute($fechas_menores);
		
		if(@$rs_menores->fields["asis_asiste"]==1)
		{
		  $desplegar=0;
		
		}
		if($desplegar==1)
		{
		$contador++;
  ?>
  <tr>
    <td><span class="style8"><?php echo $contador; ?></span></td>
    <td><span class="style8"><?php echo $rs_gogessform->fields["asis_fecharegistro"]; ?></span></td>
    <td><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_nombre"]); ?></span></td>
    <td><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_apellido"]); ?></span></td>
    <td><span class="style8"><?php echo $rs_gogessform->fields["clie_genero"]; ?></span></td>
    <td><span class="style8"><?php //echo $rs_gogessform->fields["clie_id"]; ?></span></td>
    <td><span class="style8"><?php echo $rs_gogessform->fields["clie_estadocivil"]; ?></span></td>
	 <td><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_direccion"]); ?></span></td>
    <td><span class="style8"><?php echo $rs_gogessform->fields["clie_celular"]; ?></span></td>
    <td><span class="style8"><?php echo $rs_gogessform->fields["clie_telefono"]; ?></span></td>
    <td><span class="style8"><?php echo $rs_gogessform->fields["clie_email"]; ?></span></td>
    <td><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_horariocontacto"]); ?></span></td>
    <td><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_comoteenteraste"]); ?></span></td>
    
  </tr>
  
  <?php
     }
  
  	$rs_gogessform->MoveNext();	
		}
		
		echo'<tr>
    <td colspan="13">Total encontrados: '.$contador.'</td>
  </tr>';
		
 }
  ?>
</table>
