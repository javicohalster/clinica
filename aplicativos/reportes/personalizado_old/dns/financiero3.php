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
$objformulario= new  ValidacionesFormulario();
$obtien_anio=array();
@$obtien_anio=explode("-",$_POST["fecha_inicio"]);
$lista_estu=array();

$centro_id=$_POST["centro_id"];
$datos_centro="select * from dns_centrosalud inner join app_provincia on dns_centrosalud.prob_codigo=app_provincia.prob_codigo where centro_id=".$centro_id;
$rs_centro = $DB_gogess->executec($datos_centro,array());

$zona='';
$zona=$rs_centro->fields["zona_id"];
$subzona='';
$subzona=$rs_centro->fields["prob_nombre"];
$nombrecentro=$rs_centro->fields["centro_nombre"];

$nivel_establ=0;
$nivel_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,permif_id"," where centro_id=",$centro_id,$DB_gogess); 

?>
<div id="dvData">
<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.verticalText {
writing-mode: vertical-lr;
    transform: rotate(90deg);
	font-size:9px;
	margin-right: 30%;
	margin-left: 30%;
}
.style1 {font-size: 11px}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<?php

//---------------------------------------------------------------------------------------------------------------------

//$codigo_seguro=$rs_listaseguro->fields["tipopac_id"];

$tarifa_sql="select 'tarifario' as tipo,tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from pichinchahumana_reportes.planilla_tarifariodata where centro_id='".$_POST["centro_id"]."' and cuabas_fecharegistro like '".$_POST["anio_valor"]."-".$_POST["mes_valor"]."-%' and  prod_nivel=".$nivel_establ."  UNION ";

$receta_sql="select  'medicamento' as tipo,tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from pichinchahumana_reportes.planilla_recetadata where centro_id='".$_POST["centro_id"]."' and cuabas_fecharegistro like '".$_POST["anio_valor"]."-".$_POST["mes_valor"]."-%'  UNION ";

$insumos_sql="select 'insumo' as tipo,tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from pichinchahumana_reportes.planilla_insumodata where centro_id='".$_POST["centro_id"]."' and cuabas_fecharegistro like '".$_POST["anio_valor"]."-".$_POST["mes_valor"]."-%' UNION ";

$union_data='';
$union_data=$tarifa_sql.$receta_sql.$insumos_sql;
//TARIFARIO 
$union_data=substr($union_data,0,-6).' order by clie_rucci asc';

$suma_datos68=array();
$suma_tipos68=array();

$suma_datos100=array();
$suma_tipos100=array();

$recolecta_rucs["100"]=array();
$recolecta_rucs["68"]=array();
$cuenta_valor1=0;
$cuenta_valor2=0;

$rs_btarifario = $DB_gogess->executec($union_data,array());
if($rs_btarifario)
	{
		while (!$rs_btarifario->EOF) {
		
		$tipase_id=$objformulario->replace_cmb("app_cliente","clie_rucci,tipase_id"," where clie_rucci like ",$rs_btarifario->fields["clie_rucci"],$DB_gogess); 
		
		//3,4
		$clie_parentescopaciente=$objformulario->replace_cmb("app_cliente","clie_rucci,clie_parentescopaciente"," where clie_rucci like ",$rs_btarifario->fields["clie_rucci"],$DB_gogess); 
		
		$valor_sumado=0;
		$valor_sumado=number_format($rs_btarifario->fields["prod_precio"], 3, '.', '')*$rs_btarifario->fields["prod_cantidad"];
		
		//PADRE,MADRE,ESPOSO,ESPOSA
		
		if(($tipase_id==3 or $tipase_id==4) and ($clie_parentescopaciente=='PADRE' or $clie_parentescopaciente=='MADRE' or $clie_parentescopaciente=='ESPOSO' or  $clie_parentescopaciente=='ESPOSA'))
		{
		//68%		    
	@$suma_datos68[$rs_btarifario->fields["tipo"]][$rs_btarifario->fields["tabla"]]=$suma_datos68[$rs_btarifario->fields["tipo"]][$rs_btarifario->fields["tabla"]]+number_format($valor_sumado, 2, '.', '');		
	@$suma_tipos68[$rs_btarifario->fields["tipo"]]=$suma_tipos68[$rs_btarifario->fields["tipo"]]+number_format($valor_sumado, 2, '.', '');
	
	    $recolecta_rucs[68][$cuenta_valor2]=$rs_btarifario->fields["clie_rucci"];
	  	$cuenta_valor2++;
	
		}
		else
		{
		//100%
		
	@$suma_datos100[$rs_btarifario->fields["tipo"]][$rs_btarifario->fields["tabla"]]=$suma_datos100[$rs_btarifario->fields["tipo"]][$rs_btarifario->fields["tabla"]]+number_format($valor_sumado, 2, '.', '');		
	@$suma_tipos100[$rs_btarifario->fields["tipo"]]=$suma_tipos100[$rs_btarifario->fields["tipo"]]+number_format($valor_sumado, 2, '.', '');
	
	    $recolecta_rucs[100][$cuenta_valor1]=$rs_btarifario->fields["clie_rucci"];
	  	$cuenta_valor1++;
	
		
		}
		
		
		
		
		
		
		
		$rs_btarifario->MoveNext();	
		}
	}	




//$cuenta_totales="select count(clie_rucci) as total from  (select distinct clie_rucci from (".$union_data.") as t1) as total";
//$rs_tbltotales = $DB_gogess->executec($cuenta_totales,array());

$resultado_unico1=array();
$resultado_unico1=array_unique($recolecta_rucs[100]);

//print_r($suma_datos);
?>
<br /><br />
<center><b>100%</b></center>
<center><b><?php //echo $rs_listaseguro->fields["tipopac_nombre"]; ?></b></center>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="css_listat">CONSULTA EXTERNA</div></td>
    <td><div align="center" class="css_listat">ENFERMERIA</div></td>
    <td><div align="center" class="css_listat">ODONTOLOGIA</div></td>
    <td><div align="center" class="css_listat">PSICOLOGIA</div></td>
    <td><div align="center" class="css_listat">REHABILITACION</div></td>
    <td><div align="center" class="css_listat">LABORATORIO CLINICO</div></td>
    <td><div align="center" class="css_listat">VALOR MEDICAMENTO</div></td>
    <td><div align="center" class="css_listat">VALOR INSUMOS</div></td>
    <td><div align="center" class="css_listat">TOTAL</div></td>
    <td><div align="center" class="css_listat">NUMERO DE ATENCIONES TOTALES</div></td>
  </tr>
  
  <tr>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos100["tarifario"]["dns_consultaexterna"] + @$suma_datos100["tarifario"]["dns_anamesisexamenfisico"] +  @$suma_datos100["tarifario"]["dns_procediminetosinvasivos"] + @$suma_datos100["tarifario"]["dns_prehospitalario"] + @$suma_datos100["tarifario"]["dns_visitadomiciliaria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos100["tarifario"]["dns_enfermeria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos100["tarifario"]["dns_odontologia"]+@$suma_datos100["tarifario"]["dns_subsecuenteodontologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos100["tarifario"]["dns_psicologia"]+@$suma_datos100["tarifario"]["dns_subsecuentepsicologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos100["tarifario"]["dns_fisioterapia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos100["tarifario"]["dns_laboratorioinforme"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos100["medicamento"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos100["insumo"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos100["tarifario"] + @$suma_tipos100["insumo"]+ @$suma_tipos100["medicamento"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo count($resultado_unico1); ?></div></td>
  </tr>
</table>

<br /><br /><br />

<?php
$resultado_unico2=array();
$resultado_unico2=array_unique($recolecta_rucs[68]);
?>

<center><b>68%</b></center>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="css_listat">CONSULTA EXTERNA</div></td>
    <td><div align="center" class="css_listat">ENFERMERIA</div></td>
    <td><div align="center" class="css_listat">ODONTOLOGIA</div></td>
    <td><div align="center" class="css_listat">PSICOLOGIA</div></td>
    <td><div align="center" class="css_listat">REHABILITACION</div></td>
    <td><div align="center" class="css_listat">LABORATORIO CLINICO</div></td>
    <td><div align="center" class="css_listat">VALOR MEDICAMENTO</div></td>
    <td><div align="center" class="css_listat">VALOR INSUMOS</div></td>
    <td><div align="center" class="css_listat">TOTAL</div></td>
    <td><div align="center" class="css_listat">NUMERO DE ATENCIONES TOTALES</div></td>
  </tr>
  
  <tr>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos68["tarifario"]["dns_consultaexterna"] + @$suma_datos68["tarifario"]["dns_anamesisexamenfisico"] +  @$suma_datos68["tarifario"]["dns_procediminetosinvasivos"] + @$suma_datos68["tarifario"]["dns_prehospitalario"] + @$suma_datos68["tarifario"]["dns_visitadomiciliaria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos68["tarifario"]["dns_enfermeria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos68["tarifario"]["dns_odontologia"]+@$suma_datos68["tarifario"]["dns_subsecuenteodontologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos68["tarifario"]["dns_psicologia"]+@$suma_datos68["tarifario"]["dns_subsecuentepsicologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos68["tarifario"]["dns_fisioterapia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos68["tarifario"]["dns_laboratorioinforme"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos68["medicamento"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos68["insumo"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos68["tarifario"] + @$suma_tipos68["insumo"]+ @$suma_tipos68["medicamento"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo count($resultado_unico2); ?></div></td>
  </tr>
</table>

</div>
<?php
}
?>