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
$lista_listaseguro="select tipopac_id,tipopac_nombre from faesa_tipopaciente";
$rs_listaseguro = $DB_gogess->executec($lista_listaseguro,array());
if($rs_listaseguro)
	{
		while (!$rs_listaseguro->EOF) {

//---------------------------------------------------------------------------------------------------------------------

$codigo_seguro=$rs_listaseguro->fields["tipopac_id"];

$tarifa_sql="select 'tarifario' as tipo,tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from pichinchahumana_reportes.planilla_tarifariodata where centro_id='".$_POST["centro_id"]."' and cuabas_fecharegistro like '".$_POST["anio_valor"]."-".$_POST["mes_valor"]."-%' and  prod_nivel=".$nivel_establ."  and tipopac_id='".$codigo_seguro."' UNION ";

$receta_sql="select  'medicamento' as tipo,tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from pichinchahumana_reportes.planilla_recetadata where centro_id='".$_POST["centro_id"]."' and cuabas_fecharegistro like '".$_POST["anio_valor"]."-".$_POST["mes_valor"]."-%'  and tipopac_id='".$codigo_seguro."' UNION ";

$insumos_sql="select 'insumo' as tipo,tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from pichinchahumana_reportes.planilla_insumodata where centro_id='".$_POST["centro_id"]."' and cuabas_fecharegistro like '".$_POST["anio_valor"]."-".$_POST["mes_valor"]."-%' and tipopac_id='".$codigo_seguro."' UNION ";

$union_data='';
$union_data=$tarifa_sql.$receta_sql.$insumos_sql;
//TARIFARIO 
$union_data=substr($union_data,0,-6).' order by clie_rucci asc';

@$suma_datos=array();
$suma_tipos=array();
$recolecta_rucs=array();

$cuenta_valor=0;

$rs_btarifario = $DB_gogess->executec($union_data,array());
if($rs_btarifario)
	{
		while (!$rs_btarifario->EOF) {
		
		$valor_sumado=0;
		$valor_sumado=number_format($rs_btarifario->fields["prod_precio"], 3, '.', '')*$rs_btarifario->fields["prod_cantidad"];
		
		@$suma_datos[$rs_btarifario->fields["tipo"]][$rs_btarifario->fields["tabla"]]=@$suma_datos[$rs_btarifario->fields["tipo"]][$rs_btarifario->fields["tabla"]]+number_format($valor_sumado, 2, '.', '');		
		@$suma_tipos[$rs_btarifario->fields["tipo"]]=$suma_tipos[$rs_btarifario->fields["tipo"]]+number_format($valor_sumado, 2, '.', '');
		
		$recolecta_rucs[$cuenta_valor]=$rs_btarifario->fields["clie_rucci"];
		$cuenta_valor++;
		
		
		$rs_btarifario->MoveNext();	
		}
	}	




//$cuenta_totales="select count(clie_rucci) as total from  (select distinct clie_rucci from (".$union_data.") as t1) as total";
//$rs_tbltotales = $DB_gogess->executec($cuenta_totales,array());

$resultado_unico=array();
$resultado_unico=array_unique($recolecta_rucs);
//echo count($resultado_unico);

//print_r($suma_datos);
?>
<br /><br />
<center><b><?php echo $rs_listaseguro->fields["tipopac_nombre"]; ?></b></center>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><div align="center" class="css_listat">MEDICINA</div></td>
    <td colspan="3"><div align="center" class="css_listat">CONSULTA EXTERNA</div></td>
    <td colspan="3"><div align="center" class="css_listat">ENFERMERIA</div></td>
    <td colspan="3"><div align="center" class="css_listat">ODONTOLOGIA</div></td>
    <td colspan="3"><div align="center" class="css_listat">PSICOLOGIA</div></td>
    <td colspan="3"><div align="center" class="css_listat">REHABILITACION</div></td>
    <td colspan="3"><div align="center" class="css_listat">LABORATORIO CLINICO</div></td>
    <td colspan="3"><div align="center" class="css_listat"><strong>PROCEDIMIENTOS MINIMAMENTE INVASIVOS</strong></div></td>
    <td colspan="3"><div align="center" class="css_listat">PRE HOSPITALARIO</div></td>
    <td colspan="3"><div align="center" class="css_listat">ACTIVIDADES EXTRAMURALES</div></td>
    <td><div align="center" class="css_listat">VALOR MEDICAMENTO</div></td>
    <td><div align="center" class="css_listat">VALOR INSUMOS</div></td>
    <td><div align="center" class="css_listat">VALOR TARIFARIO</div></td>
    <td><div align="center" class="css_listat">TOTAL</div></td>
    <td><div align="center" class="css_listat">NUMERO DE ATENCIONES TOTALES</div></td>
  </tr>
  <tr>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamentos</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">Tarifario</td>
    <td class="css_lista">Medicamento</td>
    <td class="css_lista">Insumos</td>
    <td class="css_lista">&nbsp;</td>
    <td class="css_lista">&nbsp;</td>
    <td class="css_lista">&nbsp;</td>
    <td class="css_lista">&nbsp;</td>
    <td class="css_lista">&nbsp;</td>
  </tr>
  <tr>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_anamesisexamenfisico"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_anamesisexamenfisico"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_anamesisexamenfisico"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_consultaexterna"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_consultaexterna"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_consultaexterna"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_enfermeria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_enfermeria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_enfermeria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_odontologia"]+@$suma_datos["tarifario"]["dns_subsecuenteodontologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_odontologia"]+@$suma_datos["medicamento"]["dns_subsecuenteodontologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_odontologia"]+@$suma_datos["insumo"]["dns_subsecuenteodontologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_psicologia"]+@$suma_datos["tarifario"]["dns_subsecuentepsicologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_psicologia"]+@$suma_datos["medicamento"]["dns_subsecuentepsicologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_psicologia"]+@$suma_datos["insumo"]["dns_subsecuentepsicologia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_fisioterapia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_fisioterapia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_fisioterapia"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_laboratorioinforme"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_laboratorioinforme"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_laboratorioinforme"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_procediminetosinvasivos"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_procediminetosinvasivos"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_procediminetosinvasivos"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_prehospitalario"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_prehospitalario"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_prehospitalario"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["tarifario"]["dns_visitadomiciliaria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["medicamento"]["dns_visitadomiciliaria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_datos["insumo"]["dns_visitadomiciliaria"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos["medicamento"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos["insumo"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos["tarifario"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo @$suma_tipos["tarifario"] + @$suma_tipos["insumo"]+ @$suma_tipos["medicamento"]; ?></div></td>
    <td class="css_lista"><div align="center" class="css_lista"><?php echo count($resultado_unico); ?></div></td>
  </tr>
</table>
<?php
//---------------------------------------------------------------------------------------------------------------------
   $rs_listaseguro->MoveNext();	
     }
  }  


?>
</div>
<?php
}
?>