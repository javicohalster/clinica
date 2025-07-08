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
situ_id as servicio
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
//echo $union_data
$union_data=substr($union_data,0,-10);

//----------------------------------------------------------------------------------------------------------
$edad_cal="IF(clie_fechanacimiento='0000-00-00',777,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro))";
$edad_mes="IF(clie_fechanacimiento='0000-00-00',777,TIMESTAMPDIFF(MONTH,clie_fechanacimiento,fecharegistro)% 12)";

//$menor_mes="(IF(".$edad_cal."=0,IF(".$edad_mes."=0,1,0),0)) as nenosmes";

$deuno_a11mes="(IF(".$edad_cal."=0,IF((".$edad_mes.">=1 and ".$edad_mes."<=11),1,0),0)) as deuno_a11mes";
$deuno_acuatro="(IF((".$edad_cal.">=1 and ".$edad_cal."<=4),1,0)) as deuno_acuatro";
$de5_a9="(IF((".$edad_cal.">=5 and ".$edad_cal."<=9),1,0)) as de5_a9";
$de10_a14="(IF((".$edad_cal.">=10 and ".$edad_cal."<=14),1,0)) as de10_a14";
$de15_a19="(IF((".$edad_cal.">=15 and ".$edad_cal."<=19),1,0)) as de15_a19";
$de20_a24="(IF((".$edad_cal.">=20 and ".$edad_cal."<=24),1,0)) as de20_a24";
$de25_a39="(IF((".$edad_cal.">=25 and ".$edad_cal."<=39),1,0)) as de25_a39";
$de40_a54="(IF((".$edad_cal.">=40 and ".$edad_cal."<=54),1,0)) as de40_a54";
$de55_a64="(IF((".$edad_cal.">=55 and ".$edad_cal."<=64),1,0)) as de55_a64";
$de65_a120="(IF((".$edad_cal.">=65 and ".$edad_cal."<=120),1,0)) as de65_a120";

$de777="(IF((".$edad_cal."=777),1,0)) as de777";

$fallecidos="(IF(atenc_condiciondeegreso='FALLECIDO',1,0)) as fallecidos";

$femenino="(IF(clie_genero='F',1,0)) as femenino";
$masculino="(IF(clie_genero='M',1,0)) as masculino";

$edad_sql="IF(clie_fechanacimiento='0000-00-00',777,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro)) AS edad";
$mes_sql="IF(clie_fechanacimiento='0000-00-00',777,TIMESTAMPDIFF(MONTH,clie_fechanacimiento,fecharegistro)% 12)  as mes";

//----------------------------------------------------------------------------------------------------------

$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,".$edad_sql.",".$mes_sql.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a24.",".$de25_a39.",".$de40_a54.",".$de55_a64.",".$de65_a120.",".$de777.",".$fallecidos.",servicio,tabla from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."'";	

//crea temporal
 $data_registros=array();
 $rs_csql = $DB_gogess->executec($cuenta_sql,array());
  if($rs_csql)
  {
     	while (!$rs_csql->EOF) {
		
		  $data_registros['tbl'][] = $rs_csql->fields;
		
		$rs_csql->MoveNext();	
		}
	}	

//print_r($data_registros);

 $separa_fecha=explode("-",$_POST["fecha_inicio"]);
		   //echo $separa_fecha[0]."<br>";
		   //echo $mes_array[$separa_fecha[1]];
		   
$centro_id=$_POST["centro_id"];
$datos_centro="select * from dns_centrosalud inner join app_provincia on dns_centrosalud.prob_codigo=app_provincia.prob_codigo where centro_id=".$centro_id;
$rs_centro = $DB_gogess->executec($datos_centro,array());

$zona='';
$zona=$rs_centro->fields["zona_id"];

$subzona='';
$subzona=$rs_centro->fields["prob_nombre"];

$nombrecentro=$rs_centro->fields["centro_nombre"];		   
?>
<div id="dvData">
<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_listatp {font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.css_listaP {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.verticalText {
writing-mode: vertical-lr;
    transform: rotate(90deg);
	font-size:9px;
	margin-right: 30%;
	margin-left: 30%;
}
.style2 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<table width="1200" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="37"><div align="center" class="css_listat">REPUBLICA DEL ECUADOR <br />
      MINISTERIO DE SALUD PUBLICA <br />
      PROCESO DE EPIDEMIOLOGIA <br />
    NOTIFICACI&Oacute;N DE ENFERMEDADES DE VIGILANCIA EPIDEMIOLOGICA</div></td>
  </tr>
  <tr>
    <td colspan="37"><table width="900" border="1" cellspacing="0">
        <tr>
          <td valign="top" class="css_listaP">DATOS DE IDENTIFICACI&Oacute;N</td>
          <td valign="top" class="css_listaP">INSTITUCI&Oacute;N DEL SISTEMA</td>
          <td class="css_listaP">PERSONAL</td>
          <td class="css_listaP">RESPONSABLE DE LA CONSOLIDACI&Oacute;N</td>
        </tr>
        <tr>
          <td valign="top"><table border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td rowspan="2" class="style2">A</td>
              <td class="css_listaP"><strong>NOMBRE DEL ESTABLECIMIENTO</strong></td>
              <td class="css_listaP"><strong><?php echo $nombrecentro; ?></strong></td>
            </tr>
            <tr>
              <td class="style2">NOMBRE DEL PROFESIONAL</td>
              <td class="css_listaP">&nbsp;</td>
            </tr>
          </table></td>
          <td valign="top"><table width="130" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td rowspan="4" class="css_listaP">B</td>
              <td class="css_listaP">1</td>
              <td colspan="2" class="css_listaP">HQ1</td>
            </tr>
            <tr>
              <td class="css_listaP">2</td>
              <td colspan="2" class="css_listaP">HG2</td>
            </tr>
            <tr>
              <td class="css_listaP">3</td>
              <td class="css_listaP">CS</td>
              <td class="css_listaP">&nbsp;</td>
            </tr>
            <tr>
              <td class="css_listaP">4</td>
              <td colspan="2" class="css_listaP">S.C.S</td>
            </tr>
          </table></td>
          <td valign="top"><table width="176" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="14" rowspan="4" class="css_listaP">C</td>
              <td width="11" class="css_listaP">1</td>
              <td width="111" class="css_listaP">M&Eacute;DICO</td>
              <td width="30" class="css_listaP">&nbsp;</td>
            </tr>
            <tr>
              <td class="css_listaP">2</td>
              <td class="css_listaP">PSIC&Oacute;LOGO</td>
              <td class="css_listaP">&nbsp;</td>
            </tr>
            <tr>
              <td class="css_listaP">3</td>
              <td class="css_listaP">FISIOTERAPISTA</td>
              <td class="css_listaP">&nbsp;</td>
            </tr>
            <tr>
              <td class="css_listaP">4</td>
              <td class="css_listaP">ENFERMERA</td>
              <td class="css_listaP">&nbsp;</td>
            </tr>
          </table></td>
          <td valign="top"><table width="400" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="20" rowspan="3" class="css_listaP">&nbsp;</td>
              <td width="95" class="style2">DIAS</td>
              <td width="27" class="css_listaP">&nbsp;</td>
              <td width="33" class="style2">MES</td>
              <td width="43" class="css_listaP"><?php echo $mes_array[$separa_fecha[1]]; ?></td>
              <td width="29" class="style2">A&Ntilde;O</td>
              <td width="50" class="css_listaP"><?php echo $separa_fecha[0]; ?></td>
              <td width="85" rowspan="3" valign="top" class="css_listaP"><div align="center">FIRMA</div></td>
            </tr>
            <tr>
              <td colspan="2" class="style2">NOMBRE:</td>
              <td colspan="4" class="css_listaP">&nbsp;</td>
              </tr>
            <tr>
              <td colspan="2" class="style2">CARGO:</td>
              <td colspan="4" class="css_listaP">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>    </td>
  </tr>
  <tr>
    <td colspan="37">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="37" class="css_listatp"><div align="center" class="css_listat">CONSOLIDADO MENSUAL DE MORBILIDAD POR GRUPO ETAREO</div></td>
  </tr>
  <tr>
    <td rowspan="2" class="css_listatp">&nbsp;</td>
    <td rowspan="2" class="css_listatp">CIE 10 PATOLOGIA </td>
    <td rowspan="2" class="css_listatp">DESCRIPCION DE LA PATOLOGIA </td>
    <td colspan="3" class="css_listatp">SEXO</td>
    <td rowspan="2" class="css_listatp">S.ACTIVO</td>
    <td rowspan="2" class="css_listatp">S. PASIVO </td>
    <td rowspan="2" class="css_listatp">DEPENDIENTES</td>
    <td rowspan="2" class="css_listatp">OTRAS ASEGURADORAS </td>
    <td rowspan="2" class="css_listatp">TOTAL</td>
    <td colspan="11" class="css_listatp">PRIMERAS</td>
    <td class="css_listatp">&nbsp;</td>
    <td colspan="11" class="css_listatp">SUBSECUENTES</td>
    <td class="css_listatp">&nbsp;</td>
    <td colspan="2" class="css_listatp">TOTALES</td>
  </tr>
  <tr>
    <td class="css_listatp">M</td>
    <td class="css_listatp">F</td>
    <td class="css_listatp">TOTAL</td>
    <td nowrap="nowrap" class="css_listatp">1-11 MESES</td>
    <td nowrap="nowrap" class="css_listatp">1-4 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">5-9 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">10-14 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">15-19 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">20-24 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">25-39 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">40-54 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">55-64 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">65 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">NO REGISTRA FECHA NACIMIENTO </td>
    <td nowrap="nowrap" class="css_listatp">TOTAL</td>
    <td nowrap="nowrap" class="css_listatp">1-11 MESES</td>
    <td nowrap="nowrap" class="css_listatp">1-4 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">5-9 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">10-14 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">15-19 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">20-24 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">25-39 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">40-54 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">55-64 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">65 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listatp">NO REGISTRA FECHA NACIMIENTO</td>
    <td nowrap="nowrap" class="css_listatp">TOTAL</td>
    <td nowrap="nowrap" class="css_listatp">PRIMERAS</td>
    <td nowrap="nowrap" class="css_listatp">SUBSECUENTES</td>
  </tr>
  
  <?php
  $total_m=0;
  $total_sactivo=0;
  $total_spasivo=0;
  $total_dependiente=0;
  $total_otros=0;
  $total_1=0;
		  $total_2=0;
		  $total_3=0;
		  $total_4=0;
		  $total_5=0;
		  $total_6=0;
		  $total_7=0;
		  $total_8=0;
		  $total_9=0;
		  $total_10=0;
		  $total_11=0;
		  
		  
		  $total_s1=0;
		  $total_s2=0;
		  $total_s3=0;
		  $total_s4=0;
		  $total_s5=0;
		  $total_s6=0;
		  $total_s7=0;
		  $total_s8=0;
		  $total_s9=0;
		  $total_s10=0;
		  $total_s11=0;
  
  
  
  $contador=0;
  $lista_data="select distinct  cie,descripcioncie  from (".$union_data.") tbl";
  $rs_ldata = $DB_gogess->executec($lista_data,array());
  if($rs_ldata)
  {
     	while (!$rs_ldata->EOF) {
		
	$contador++;
	
	
//$cuenta_sql="select cie,clie_genero,".$femenino.",".$masculino.",clie_fechanacimiento,fecharegistro,TIMESTAMPDIFF(YEAR,clie_fechanacimiento,fecharegistro) AS edad, TIMESTAMPDIFF( MONTH, clie_fechanacimiento, fecharegistro ) % 12 as mes,".$menor_mes.",".$deuno_a11mes.",".$deuno_acuatro.",".$de5_a9.",".$de10_a14.",".$de15_a19.",".$de20_a49.",".$de50_a64.",".$de65_a120.",".$fallecidos." from (".$union_data.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and cie ='".$rs_ldata->fields["cie"]."'";	
//$cuenta_sql='';
//$array_cuenta=array();

 //$rs_cuenta = $DB_gogess->executec($cuenta_sql,array());
// if($rs_cuenta)
// {
     	//while (!$rs_cuenta->EOF) {
		
		//$array_cuenta["1"]=$array_cuenta["1"]+$rs_cuenta->fields["nenosmes"];
		//$array_cuenta["2"]=$array_cuenta["2"]+$rs_cuenta->fields["deuno_a11mes"];
		//$array_cuenta["3"]=$array_cuenta["3"]+$rs_cuenta->fields["deuno_acuatro"];
		//$array_cuenta["4"]=$array_cuenta["4"]+$rs_cuenta->fields["de5_a9"];
		//$array_cuenta["5"]=$array_cuenta["5"]+$rs_cuenta->fields["de10_a14"];
		//$array_cuenta["6"]=$array_cuenta["6"]+$rs_cuenta->fields["de15_a19"];
		//$array_cuenta["7"]=$array_cuenta["7"]+$rs_cuenta->fields["de20_a49"];
		//$array_cuenta["8"]=$array_cuenta["8"]+$rs_cuenta->fields["de50_a64"];
		//$array_cuenta["9"]=$array_cuenta["9"]+$rs_cuenta->fields["de65_a120"];
		
		//$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$rs_cuenta->fields["fallecidos"];
		//$array_cuenta["f"]=$array_cuenta["f"]+$rs_cuenta->fields["femenino"];
		//$array_cuenta["m"]=$array_cuenta["m"]+$rs_cuenta->fields["masculino"];
		
		
       // $rs_cuenta->MoveNext();	
		//}
 //}
 
        $array_cuenta["1"]=0;
		$array_cuenta["2"]=0;
		$array_cuenta["3"]=0;
		$array_cuenta["4"]=0;
		$array_cuenta["5"]=0;
		$array_cuenta["6"]=0;
		$array_cuenta["7"]=0;
		$array_cuenta["8"]=0;
		$array_cuenta["9"]=0;
		$array_cuenta["10"]=0;
		$array_cuenta["11"]=0;
		
		$array_cuenta["s1"]=0;
		$array_cuenta["s2"]=0;
		$array_cuenta["s3"]=0;
		$array_cuenta["s4"]=0;
		$array_cuenta["s5"]=0;
		$array_cuenta["s6"]=0;
		$array_cuenta["s7"]=0;
		$array_cuenta["s8"]=0;
		$array_cuenta["s9"]=0;
		$array_cuenta["s10"]=0;
		$array_cuenta["s11"]=0;
		
		$array_cuenta["fallecidos"]=0;
		$array_cuenta["f"]=0;
		$array_cuenta["m"]=0;
		
		$array_cuenta["sactivo"]=0;
		$array_cuenta["spasivo"]=0;
		$array_cuenta["dependiente"]=0;
		$array_cuenta["otros"]=0;
		
		
		 
foreach($data_registros['tbl'] as $obj){

   if(trim($obj["cie"])==trim($rs_ldata->fields["cie"]))
   {
      	
		$array_cuenta["fallecidos"]=$array_cuenta["fallecidos"]+$obj["fallecidos"];
		$array_cuenta["f"]=$array_cuenta["f"]+$obj["femenino"];
		$array_cuenta["m"]=$array_cuenta["m"]+$obj["masculino"];
		
		switch ($obj["servicio"]) {
			case 1:
				 $array_cuenta["sactivo"]=$array_cuenta["sactivo"]+1;
				break;
			case 2:
				$array_cuenta["spasivo"]=$array_cuenta["spasivo"]+1;
				break;
			case 4:
				$array_cuenta["dependiente"]=$array_cuenta["dependiente"]+1;
				break;
			default:
			   $array_cuenta["otros"]=$array_cuenta["otros"]+1;
		}
		
		//
	
		//if($obj["tabla"]==)
		 if($obj["tabla"]=='dns_anamesisexamenfisico' or $obj["tabla"]=='dns_imagenologiainfo' or $obj["tabla"]=='dns_odontologia' or $obj["tabla"]=='dns_procediminetosinvasivos' or $obj["tabla"]=='dns_psicologia' or $obj["tabla"]=='dns_referencia' or $obj["tabla"]=='dns_interconsulta' or $obj["tabla"]=='dns_prehospitalario' or $obj["tabla"]=='dns_histopatologia' or $obj["tabla"]=='dns_laboratorio' or $obj["tabla"]=='dns_imagenologia' or $obj["tabla"]=='dns_enfermeria' or $obj["tabla"]=='dns_laboratorioinforme' or $obj["tabla"]=='dns_fisioterapia' or $obj["tabla"]=='dns_visitadomiciliaria')
		 {
		
		$array_cuenta["1"]=$array_cuenta["1"]+$obj["deuno_a11mes"];
		$array_cuenta["2"]=$array_cuenta["2"]+$obj["deuno_acuatro"];
		$array_cuenta["3"]=$array_cuenta["3"]+$obj["de5_a9"];
		$array_cuenta["4"]=$array_cuenta["4"]+$obj["de10_a14"];
		$array_cuenta["5"]=$array_cuenta["5"]+$obj["de15_a19"];
		$array_cuenta["6"]=$array_cuenta["6"]+$obj["de20_a24"];
		$array_cuenta["7"]=$array_cuenta["7"]+$obj["de25_a39"];
		$array_cuenta["8"]=$array_cuenta["8"]+$obj["de40_a54"];
		$array_cuenta["9"]=$array_cuenta["9"]+$obj["de55_a64"];
		$array_cuenta["10"]=$array_cuenta["10"]+$obj["de65_a120"];
		$array_cuenta["11"]=$array_cuenta["11"]+$obj["de777"];
		
		}
		
		if($obj["tabla"]=='dns_consultaexterna' or $obj["tabla"]=='dns_subsecuenteodontologia' or $obj["tabla"]=='dns_subsecuentepsicologia' or $obj["tabla"]=='dns_regfisioterapia')
		   {
		   
		$array_cuenta["s1"]=$array_cuenta["s1"]+$obj["deuno_a11mes"];
		$array_cuenta["s2"]=$array_cuenta["s2"]+$obj["deuno_acuatro"];
		$array_cuenta["s3"]=$array_cuenta["s3"]+$obj["de5_a9"];
		$array_cuenta["s4"]=$array_cuenta["s4"]+$obj["de10_a14"];
		$array_cuenta["s5"]=$array_cuenta["s5"]+$obj["de15_a19"];
		$array_cuenta["s6"]=$array_cuenta["s6"]+$obj["de20_a24"];
		$array_cuenta["s7"]=$array_cuenta["s7"]+$obj["de25_a39"];
		$array_cuenta["s8"]=$array_cuenta["s8"]+$obj["de40_a54"];
		$array_cuenta["s9"]=$array_cuenta["s9"]+$obj["de55_a64"];
		$array_cuenta["s10"]=$array_cuenta["s10"]+$obj["de65_a120"];
		$array_cuenta["S11"]=$array_cuenta["S11"]+$obj["de777"];
		   
		   }
		
		//
		
   
   }

}
	
	
  ?>
  <tr>
    <td class="css_lista"><?php echo $contador; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_ldata->fields["cie"]); ?></td>
    <td class="css_lista" ><?php echo $rs_ldata->fields["descripcioncie"]; ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo $array_cuenta["m"]; ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo $array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo $array_cuenta["m"]+$array_cuenta["f"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["sactivo"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["spasivo"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["dependiente"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["otros"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["sactivo"]+$array_cuenta["spasivo"]+$array_cuenta["dependiente"]+$array_cuenta["otros"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["10"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["11"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["1"]+$array_cuenta["2"]+$array_cuenta["3"]+$array_cuenta["4"]+$array_cuenta["5"]+$array_cuenta["6"]+$array_cuenta["7"]+$array_cuenta["8"]+$array_cuenta["9"]+$array_cuenta["10"]+$array_cuenta["11"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s1"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s2"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s3"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s4"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s5"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s6"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s7"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s8"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s9"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s10"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s11"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s1"]+$array_cuenta["s2"]+$array_cuenta["s3"]+$array_cuenta["s4"]+$array_cuenta["s5"]+$array_cuenta["s6"]+$array_cuenta["s7"]+$array_cuenta["s8"]+$array_cuenta["s9"]+$array_cuenta["s10"]+$array_cuenta["s11"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["1"]+$array_cuenta["2"]+$array_cuenta["3"]+$array_cuenta["4"]+$array_cuenta["5"]+$array_cuenta["6"]+$array_cuenta["7"]+$array_cuenta["8"]+$array_cuenta["9"]+$array_cuenta["10"]+$array_cuenta["11"]; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $array_cuenta["s1"]+$array_cuenta["s2"]+$array_cuenta["s3"]+$array_cuenta["s4"]+$array_cuenta["s5"]+$array_cuenta["s6"]+$array_cuenta["s7"]+$array_cuenta["s8"]+$array_cuenta["s9"]+$array_cuenta["s10"]+$array_cuenta["s11"]; ?></td>
  </tr>
  
  <?php
          $total_m=$total_m+$array_cuenta["m"];
		  $total_f=$total_f+$array_cuenta["f"];
		  
		  $total_sactivo=$total_sactivo+$array_cuenta["sactivo"];
		  $total_spasivo=$total_spasivo+$array_cuenta["spasivo"];
		  $total_dependiente=$total_dependiente+$array_cuenta["dependiente"];
		  $total_otros=$total_otros+$array_cuenta["otros"];
		  
		  $total_1=$total_1+$array_cuenta["1"];
		  $total_2=$total_2+$array_cuenta["2"];
		  $total_3=$total_3+$array_cuenta["3"];
		  $total_4=$total_4+$array_cuenta["4"];
		  $total_5=$total_5+$array_cuenta["5"];
		  $total_6=$total_6+$array_cuenta["6"];
		  $total_7=$total_7+$array_cuenta["7"];
		  $total_8=$total_8+$array_cuenta["8"];
		  $total_9=$total_9+$array_cuenta["9"];
		  $total_10=$total_10+$array_cuenta["10"];
		  $total_11=$total_11+$array_cuenta["11"];
		  
		  
		  $total_s1=$total_s1+$array_cuenta["s1"];
		  $total_s2=$total_s2+$array_cuenta["s2"];
		  $total_s3=$total_s3+$array_cuenta["s3"];
		  $total_s4=$total_s4+$array_cuenta["s4"];
		  $total_s5=$total_s5+$array_cuenta["s5"];
		  $total_s6=$total_s6+$array_cuenta["s6"];
		  $total_s7=$total_s7+$array_cuenta["s7"];
		  $total_s8=$total_s8+$array_cuenta["s8"];
		  $total_s9=$total_s9+$array_cuenta["s9"];
		  $total_s10=$total_s10+$array_cuenta["s10"];
		  $total_s11=$total_s11+$array_cuenta["s11"];
		  
  
          $rs_ldata->MoveNext();	
		}
 }
  ?>
  
  <tr>
    <td class="css_lista">&nbsp;</td>
    <td class="css_lista">&nbsp;</td>
    <td class="css_lista" >&nbsp;</td>
    <td nowrap="nowrap" class="css_lista" ><?php echo $total_m; ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo $total_f; ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo $total_m+$total_f; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_sactivo; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_spasivo; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_dependiente; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_otros; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_sactivo+$total_spasivo+$total_dependiente+$total_otros; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_1; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_2; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_3; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_4; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_5; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_6; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_7; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_8; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_9; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_10; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_11; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_1+$total_2+$total_3+$total_4+$total_5+$total_6+$total_7+$total_8+$total_9+$total_10+$total_11; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s1; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s2; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s3; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s4; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s5; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s6; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s7; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s8; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s9; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s10; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s11; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s1+$total_s2+$total_s3+$total_s4+$total_s5+$total_s6+$total_s7+$total_s8+$total_s9+$total_s10+$total_s11; ?></td>
	<td nowrap="nowrap" class="css_lista"><?php echo $total_1+$total_2+$total_3+$total_4+$total_5+$total_6+$total_7+$total_8+$total_9+$total_10+$total_11; ?></td>
    <td nowrap="nowrap" class="css_lista"><?php echo $total_s1+$total_s2+$total_s3+$total_s4+$total_s5+$total_s6+$total_s7+$total_s8+$total_s9+$total_s10+$total_s11; ?></td>
  </tr>
</table>
</div>
<?php
}
?>