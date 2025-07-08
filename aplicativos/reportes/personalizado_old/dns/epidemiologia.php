<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

$union_data='';
$objformulario= new  ValidacionesFormulario();

//echo $_POST["fecha_inicio"];
//echo $_POST["fecha_fin"];
$lista_estu=array();

$mes_array=array();
$mes_array["01"]='ENERO';
$mes_array["02"]='FEBRERO';
$mes_array["03"]='MARZO';
$mes_array["04"]='ABRIL';
$mes_array["05"]='MAYO';
$mes_array["06"]='JUNIO';
$mes_array["07"]='JULIO';
$mes_array["08"]='AGOSTO';
$mes_array["09"]='SEPTIEMBRE';
$mes_array["10"]='OCTUBRE';
$mes_array["11"]='NOVIEMBRE';
$mes_array["12"]='DICIEMBRE';

//datos del centro
if(@$_POST["centro_id"])
{
  $lista_centro="select * from dns_centrosalud  inner join app_provincia on dns_centrosalud.prob_codigo=app_provincia.prob_codigo inner join app_canton on dns_centrosalud.cant_codigo=app_canton.cant_codigo inner join dns_tipologia on dns_centrosalud.tipolo_id=dns_tipologia.tipolo_id inner join dns_zona on dns_centrosalud.zona_id=dns_zona.zona_id inner join dns_distrito on dns_centrosalud.distrito_id=dns_distrito.distrito_id where centro_id='".$_POST["centro_id"]."'";
  
  $rs_centro = $DB_gogess->executec($lista_centro,array());
  
  $nombre_centro=$rs_centro->fields["centro_nombre"];
  $centro_provincia=$rs_centro->fields["prob_nombre"];
  $centro_canton=$rs_centro->fields["cant_nombre"];
  $tipo_centro=$rs_centro->fields["tipolo_nombre"];
  $nombre_zona=$rs_centro->fields["zona_nombre"];
  $nombre_distrito=$rs_centro->fields["distrito_nombre"];
  
}
else
{

  $nombre_centro='TODOS';
  $centro_provincia='TODOS';
  $centro_canton='TODOS';
  $tipo_centro='TODOS';
  $nombre_zona='TODOS';
  $nombre_distrito='TODOS';

}
//datos del centro

/*
$busca_tblparaplanillar="select distinct gogess_sistable.tab_name,fie_tablasubgrid,fie_campoenlacesub,tab_codigoesp from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(1)";

$rs_tblpla = $DB_gogess->executec($busca_tblparaplanillar,array());
if($rs_tblpla)
	{
		while (!$rs_tblpla->EOF) {
		
		  $tabla_subgrid=$rs_tblpla->fields["fie_tablasubgrid"];
		  $campo_enlaceval=$rs_tblpla->fields["fie_campoenlacesub"];
		  $tabla_principal=$rs_tblpla->fields["tab_name"];
		  $tabla_especialidad=$rs_tblpla->fields["tab_codigoesp"];
	
	$centro_val="";
	if($_POST["centro_id"])
	{
	$centro_val=" ".$tabla_principal.".centro_id='".$_POST["centro_id"]."' and	";  
	}
		  
		   $union_data.="select 
'".$tabla_principal."' as tabla,
1 as ttbl_id,
".$tabla_principal.".".$campo_enlaceval." as enlace,
atenc_condiciondeegreso,
clie_genero,
diagn_fecharegistro as fecharegistro,
clie_fechanacimiento,
diagn_cie as cie,
diagn_descripcion as descripcioncie,
diagn_tipo as tipo,
".$tabla_principal.".centro_id
from dns_atencion 
inner join ".$tabla_principal." on dns_atencion.atenc_id=".$tabla_principal.".atenc_id
inner join app_cliente on dns_atencion.clie_id=app_cliente.clie_id
inner join ".$tabla_subgrid." on ".$tabla_principal.".".$campo_enlaceval."=".$tabla_subgrid.".".$campo_enlaceval."
inner join dns_tiposervicio on dns_atencion.tiposerv_id=dns_tiposervicio.tiposerv_id
inner join app_usuario on ".$tabla_subgrid.".usua_id=app_usuario.usua_id
inner join dns_centrosalud on ".$tabla_principal.".centro_id=dns_centrosalud.centro_id
where ".$centro_val." diagn_fecharegistro>='".$_POST["fecha_inicio"]."' and diagn_fecharegistro<='".$_POST["fecha_fin"]."' UNION 

";
		  
		  
		
		$rs_tblpla->MoveNext();
		}
	}	
	
//print_r($lista_estu);
//echo $union_data;
$union_data=substr($union_data,0,-10);

*/

if(@$_POST["centro_id"])
	{
	$centro_val=" centro_id='".$_POST["centro_id"]."' and	";  
	}
	
$union_data="select * from pichinchahumana_reportes.epidemia_data where ".$centro_val." fecharegistro>='".$_POST["fecha_inicio"]." 00:00:00' and fecharegistro<='".$_POST["fecha_fin"]." 23:59:59'";

//----------------------------------------------------------------------------------------------------------
$edad_cal='(TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro))';
$edad_mes='(TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12)';

$menor_mes="(IF(".$edad_cal."=0,IF(".$edad_mes."=0,1,0),0)) as nenosmes";
$deuno_a11mes="(IF(".$edad_cal."=0,IF((".$edad_mes.">=1 and ".$edad_mes."<=11),1,0),0)) as deuno_a11mes";
$deuno_acuatro="(IF((".$edad_cal.">=1 and ".$edad_cal."<=4),1,0)) as deuno_acuatro";
$de5_a9="(IF((".$edad_cal.">=5 and ".$edad_cal."<=9),1,0)) as de5_a9";
$de10_a14="(IF((".$edad_cal.">=10 and ".$edad_cal."<=14),1,0)) as de10_a14";
$de15_a19="(IF((".$edad_cal.">=15 and ".$edad_cal."<=19),1,0)) as de15_a19";
$de20_a49="(IF((".$edad_cal.">=20 and ".$edad_cal."<=49),1,0)) as de20_a49";
$de50_a64="(IF((".$edad_cal.">=50 and ".$edad_cal."<=64),1,0)) as de50_a64";
$de65_a120="(IF((".$edad_cal.">=65 and ".$edad_cal."<=120),1,0)) as de65_a120";
$fallecidos="(IF(atenc_condiciondeegreso='FALLECIDO',1,0)) as fallecidos";

$femenino="(IF(clie_genero='F',1,0)) as femenino";
$masculino="(IF(clie_genero='M',1,0)) as masculino";

//----------------------------------------------------------------------------------------------------------

?>
<div id="dvData">
<style type="text/css">
<!--
.css_listat {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.verticalText {
writing-mode: vertical-lr;
    transform: rotate(90deg);
	font-size:9px;
	margin-right: 30%;
	margin-left: 30%;
}
.style1 {font-size: 10px}
.style2 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<table width="1200" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="18"><div align="center" class="css_listat">REPUBLICA DEL ECUADOR <br />
      MINISTERIO DE SALUD PUBLICA <br />
      PROCESO DE EPIDEMIOLOGIA <br />
    NOTIFICACI&Oacute;N DE ENFERMEDADES DE VIGILANCIA EPIDEMIOLOGICA</div></td>
  </tr>
  <tr>
    <td colspan="18"><table width="100%" border="0" cellspacing="0">
      <tr>
        <td width="18%" valign="top" class="css_listat">Provincia :  </td>
        <td width="32%" valign="top" class="css_listat"><?php echo $centro_provincia; ?></td>
        <td width="13%" valign="top" class="css_listat">Cant&oacute;n: </td>
        <td width="37%" valign="top" class="css_listat"><?php echo utf8_encode($centro_canton); ?></td>
        </tr>
      <tr>
        <td valign="top" class="css_listat">Parroquia : </td>
        <td valign="top" class="css_listat">&nbsp;</td>
        <td width="13%" valign="top" class="css_listat">Distrito de Salud: </td>
        <td width="37%" valign="top" class="css_listat"><?php echo utf8_encode($nombre_distrito); ?></td>
      </tr>
      <tr>
        <td valign="top" class="css_listat">Nombre del Establecimiento : </td>
        <td valign="top" class="css_listat"><?php echo utf8_encode($nombre_centro); ?></td>
        <td width="13%" valign="top" class="css_listat">Zona:</td>
        <td width="37%" valign="top" class="css_listat"><?php echo utf8_encode($nombre_zona); ?></td>
      </tr>
      <tr>
        <td valign="top" class="css_listat">Tipo de Establecimiento : </td>
        <td valign="top" class="css_listat"><?php echo $tipo_centro; ?></td>
        <td width="13%" valign="top" class="css_listat">Mes de: </td>
        <td width="37%" valign="top" class="css_listat"><?php 
		   $separa_fecha=explode("-",$_POST["fecha_inicio"]);		   
		   echo $mes_array[$separa_fecha[1]];
		
		 ?></td>
      </tr>
      <tr>
        <td valign="top" class="css_listat">Instituci&oacute;n :</td>
        <td valign="top" class="css_listat">&nbsp;</td>
        <td width="13%" valign="top" class="css_listat">A&ntilde;o:</td>
        <td width="37%" valign="top" class="css_listat"><?php echo $separa_fecha[0]; ?></td>
      </tr>
    </table>
      </td>
  </tr>
  <tr>
    <td colspan="18">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="15"><div align="center" class="css_listat">CASOS NUEVOS CONFIRMADOS EN CONSULTA EXTERNA, EMERGENCIA Y EGRESOS HOSPITALARIOS</div></td>
  </tr>
  <tr>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td rowspan="2" class="css_listat">CODIGO CIE10  v2013</td>
    <td rowspan="2" class="css_listat">ENFERMEDADES</td>
    <td colspan="11" class="css_listat">Grupos de edad</td>
    <td colspan="2" class="css_listat">SEXO</td>
    <td colspan="2" class="css_listat">ACUMULADO</td>
  </tr>
  <tr>
    <td nowrap="nowrap" class="css_listat style1">&lt; 1 MES</td>
    <td nowrap="nowrap" class="style2">1 -11 MESES</td>
    <td nowrap="nowrap" class="style2">1-4</td>
    <td nowrap="nowrap" class="style2">5-9</td>
    <td nowrap="nowrap" class="style2">10-14</td>
    <td nowrap="nowrap" class="style2">15-19</td>
    <td nowrap="nowrap" class="style2">20-49</td>
    <td nowrap="nowrap" class="style2">50-64</td>
    <td nowrap="nowrap" class="style2">65 y +</td>
    <td nowrap="nowrap" class="style2">TOTAL</td>
    <td nowrap="nowrap" class="style2">FALLECIDOS</td>
    <td nowrap="nowrap" class="css_listat">FEMENINO</td>
    <td nowrap="nowrap" class="css_listat">MASCULINO</td>
    <td nowrap="nowrap" class="css_listat">TOTAL</td>
    <td nowrap="nowrap" class="css_listat">FALLECIDOS</td>
  </tr>
  <tr>
    <td class="css_listat">A</td>
    <td nowrap="NOWRAP" class="css_listat">B </td>
    <td nowrap="nowrap" class="css_listat" >C</td>
    <td nowrap="nowrap" class="css_listat">1</td>
    <td nowrap="nowrap" class="css_listat">2</td>
    <td nowrap="nowrap" class="css_listat">3</td>
    <td nowrap="nowrap" class="css_listat">4</td>
    <td nowrap="nowrap" class="css_listat">5 </td>
    <td nowrap="nowrap" class="css_listat">6</td>
    <td nowrap="nowrap" class="css_listat">7</td>
    <td nowrap="nowrap" class="css_listat">8</td>
    <td nowrap="nowrap" class="css_listat">9</td>
    <td nowrap="nowrap" class="css_listat">10</td>
    <td nowrap="nowrap" class="css_listat">11</td>
    <td nowrap="nowrap" class="css_listat">12</td>
    <td nowrap="nowrap" class="css_listat">13</td>
    <td nowrap="nowrap" class="css_listat">14</td>
    <td nowrap="nowrap" class="css_listat">15</td>
  </tr>
		 <tr>
		   <td colspan="18" class="css_lista"><div align="center"><strong>ENFERMEDADES DE TRANSMISI&Oacute;N SEXUAL</strong></div></td>
  </tr>
  <?php
  $contador=0;
  $lista_data="select * from pichinchahumana_extension.dns_grupocie where categenf_id=1";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
		$contador++;
		$busca_grupovalor='';
		$busca_grupovalor=$rs_ldata->fields["gruci_cies"];
		
$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie in (".$busca_grupovalor.")";	

$array_cuenta=array();

 $rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
 if($rs_cuenta)
 {
     	while (!$rs_cuenta->EOF) {
		
		$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
        $rs_cuenta->MoveNext();	
		}
 }


	$total_r=0;
	$total_r=@$array_cuenta["1"]+@$array_cuenta["2"]+@$array_cuenta["3"]+@$array_cuenta["4"]+@$array_cuenta["5"]+@$array_cuenta["6"]+@$array_cuenta["7"]+@$array_cuenta["8"]+@$array_cuenta["9"];
  ?>
  <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["gruci_ciesnombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_ldata->fields["gruci_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
  </tr>
  <?php
          $rs_ldata->MoveNext();	
		}
 }
  ?>
		 <tr>
		   <td colspan="18" class="css_lista"><div align="center"><strong>ENFERMEDADES CR&Oacute;NICAS </strong></div></td>
  </tr>
		 <?php
  
  $lista_data="select * from pichinchahumana_extension.dns_grupocie where categenf_id=2";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
		$contador++;
		
		$busca_grupovalor='';
		$busca_grupovalor=$rs_ldata->fields["gruci_cies"];
		
$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie in (".$busca_grupovalor.")";	

$array_cuenta=array();

 $rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
 if($rs_cuenta)
 {
     	while (!$rs_cuenta->EOF) {
		
		@$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		@$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		@$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		@$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		@$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		@$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		@$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		@$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		@$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		@$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		@$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		@$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
        $rs_cuenta->MoveNext();	
		}
 }


	$total_r=0;
	$total_r=@$array_cuenta["1"]+@$array_cuenta["2"]+@$array_cuenta["3"]+@$array_cuenta["4"]+@$array_cuenta["5"]+@$array_cuenta["6"]+@$array_cuenta["7"]+@$array_cuenta["8"]+@$array_cuenta["9"];
		
  ?>
  <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["gruci_ciesnombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_ldata->fields["gruci_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
  </tr>
  <?php
          $rs_ldata->MoveNext();	
		}
 }
  ?>
		 <tr>
		   <td colspan="18" class="css_lista"><div align="center"><strong>ENFERMEDADES  CRONICAS   CANCER</strong></div></td>
  </tr>
		 <?php
  
  $lista_data="select * from pichinchahumana_extension.dns_grupocie where categenf_id=3";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
		$contador++;
		
		$busca_grupovalor='';
		$busca_grupovalor=$rs_ldata->fields["gruci_cies"];
		
$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie in (".$busca_grupovalor.")";	

$array_cuenta=array();

 $rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
 if($rs_cuenta)
 {
     	while (!$rs_cuenta->EOF) {
		
		@$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		@$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		@$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		@$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		@$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		@$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		@$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		@$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		@$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		@$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		@$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		@$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
        $rs_cuenta->MoveNext();	
		}
 }


	$total_r=0;
	$total_r=@$array_cuenta["1"]+@$array_cuenta["2"]+@$array_cuenta["3"]+@$array_cuenta["4"]+@$array_cuenta["5"]+@$array_cuenta["6"]+@$array_cuenta["7"]+@$array_cuenta["8"]+@$array_cuenta["9"];
		
  ?>
  <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["gruci_ciesnombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_ldata->fields["gruci_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
  </tr>
  <?php
          $rs_ldata->MoveNext();	
		}
 }
  ?>
		 <tr>
		   <td colspan="18" class="css_lista"><div align="center"><strong>ENFERMEDADES TROPICALES </strong></div></td>
  </tr>
		 <?php
  
  $lista_data="select * from pichinchahumana_extension.dns_grupocie where categenf_id=4";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
		$contador++;
		
		$busca_grupovalor='';
		$busca_grupovalor=$rs_ldata->fields["gruci_cies"];
		
$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie in (".$busca_grupovalor.")";	

$array_cuenta=array();

 $rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
 if($rs_cuenta)
 {
     	while (!$rs_cuenta->EOF) {
		
		@$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		@$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		@$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		@$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		@$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		@$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		@$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		@$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		@$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		@$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		@$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		@$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
        $rs_cuenta->MoveNext();	
		}
 }


	$total_r=0;
	$total_r=@$array_cuenta["1"]+@$array_cuenta["2"]+@$array_cuenta["3"]+@$array_cuenta["4"]+@$array_cuenta["5"]+@$array_cuenta["6"]+@$array_cuenta["7"]+@$array_cuenta["8"]+@$array_cuenta["9"];
		
		
  ?>
  <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["gruci_ciesnombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_ldata->fields["gruci_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
  </tr>
  <?php
          $rs_ldata->MoveNext();	
		}
 }
  ?>
		 <tr>
		   <td colspan="18" class="css_lista"><div align="center"><strong>ENFERMEDADES ZOONOSICAS</strong></div></td>
  </tr>
		 <?php
  
  $lista_data="select * from pichinchahumana_extension.dns_grupocie where categenf_id=5";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
		$contador++;
		
		$busca_grupovalor='';
		$busca_grupovalor=$rs_ldata->fields["gruci_cies"];
		
$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie in (".$busca_grupovalor.")";	

$array_cuenta=array();

 $rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
 if($rs_cuenta)
 {
     	while (!$rs_cuenta->EOF) {
		
		@$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		@$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		@$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		@$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		@$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		@$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		@$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		@$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		@$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		@$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		@$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		@$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
        $rs_cuenta->MoveNext();	
		}
 }


	$total_r=0;
	$total_r=@$array_cuenta["1"]+@$array_cuenta["2"]+@$array_cuenta["3"]+@$array_cuenta["4"]+@$array_cuenta["5"]+@$array_cuenta["6"]+@$array_cuenta["7"]+@$array_cuenta["8"]+@$array_cuenta["9"];
	
  ?>
  <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["gruci_ciesnombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_ldata->fields["gruci_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
  </tr>
  <?php
          $rs_ldata->MoveNext();	
		}
 }
  ?>
		 <tr>
		   <td colspan="18" class="css_lista"><div align="center"><strong>ENFERMEDADES TUBERCULOSAS </strong></div></td>
  </tr>
		 <?php
  
  $lista_data="select * from pichinchahumana_extension.dns_grupocie where categenf_id=6";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
		$contador++;
		
		$busca_grupovalor='';
		$busca_grupovalor=$rs_ldata->fields["gruci_cies"];
		
$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie in (".$busca_grupovalor.")";	

$array_cuenta=array();

 $rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
 if($rs_cuenta)
 {
     	while (!$rs_cuenta->EOF) {
		
		@$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		@$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		@$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		@$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		@$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		@$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		@$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		@$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		@$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		@$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		@$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		@$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
        $rs_cuenta->MoveNext();	
		}
 }


	$total_r=0;
	$total_r=@$array_cuenta["1"]+@$array_cuenta["2"]+@$array_cuenta["3"]+@$array_cuenta["4"]+@$array_cuenta["5"]+@$array_cuenta["6"]+@$array_cuenta["7"]+@$array_cuenta["8"]+@$array_cuenta["9"];
	
  ?>
  <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["gruci_ciesnombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_ldata->fields["gruci_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
  </tr>
  <?php
          $rs_ldata->MoveNext();	
		}
 }
  ?>
		 <tr>
		   <td colspan="18" class="css_lista"><div align="center"><strong>COMPORTAMIENTO HUMANO</strong></div></td>
  </tr>
		 <?php
  
  $lista_data="select * from pichinchahumana_extension.dns_grupocie where categenf_id=7";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
		$contador++;
		
		$busca_grupovalor='';
		$busca_grupovalor=$rs_ldata->fields["gruci_cies"];
		
$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie in (".$busca_grupovalor.")";	

$array_cuenta=array();

 $rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
 if($rs_cuenta)
 {
     	while (!$rs_cuenta->EOF) {
		
		@$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		@$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		@$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		@$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		@$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		@$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		@$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		@$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		@$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		@$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		@$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		@$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
        $rs_cuenta->MoveNext();	
		}
 }


	$total_r=0;
	$total_r=@$array_cuenta["1"]+@$array_cuenta["2"]+@$array_cuenta["3"]+@$array_cuenta["4"]+@$array_cuenta["5"]+@$array_cuenta["6"]+@$array_cuenta["7"]+@$array_cuenta["8"]+@$array_cuenta["9"];
	
		
  ?>
  <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["gruci_ciesnombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_ldata->fields["gruci_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
  </tr>
  <?php
          $rs_ldata->MoveNext();	
		}
 }
  ?>
		 <tr>
		   <td colspan="18" class="css_lista"><div align="center"><strong>OTROS EVENTOS</strong></div></td>
  </tr>
		 <?php
  
  $lista_data="select * from pichinchahumana_extension.dns_grupocie where categenf_id=8";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
		$contador++;
		
		$busca_grupovalor='';
		$busca_grupovalor=$rs_ldata->fields["gruci_cies"];
		
$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie in (".$busca_grupovalor.")";	

$array_cuenta=array();

 $rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
 if($rs_cuenta)
 {
     	while (!$rs_cuenta->EOF) {
		
		@$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		@$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		@$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		@$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		@$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		@$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		@$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		@$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		@$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		@$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		@$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		@$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
        $rs_cuenta->MoveNext();	
		}
 }


	$total_r=0;
	$total_r=@$array_cuenta["1"]+@$array_cuenta["2"]+@$array_cuenta["3"]+@$array_cuenta["4"]+@$array_cuenta["5"]+@$array_cuenta["6"]+@$array_cuenta["7"]+@$array_cuenta["8"]+@$array_cuenta["9"];

		
  ?>
   <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["gruci_ciesnombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_ldata->fields["gruci_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_r; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo @$array_cuenta["fallecidos"]; ?></td>
  </tr>
  <?php
          $rs_ldata->MoveNext();	
		}
 }
  ?>
</table>
<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><b class="css_listat">Form: EPI-2 Direcci&oacute;n Nacional de Vigilancia Epidemiol&oacute;gica.</b></td>
  </tr>
</table>
</div>
<?php
 

}
?>