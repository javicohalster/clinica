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

//echo $_POST["fecha_inicio"];
//echo $_POST["fecha_fin"];
$lista_estu=array();


$cuenta_sql="select dns_gridactividadesoperativas.usua_id,SEC_TO_TIME(SUM(TIME_TO_SEC(gractope_tiempohoras))) as total from dns_actividadoperativa inner join dns_gridactividadesoperativas on dns_actividadoperativa.activiope_enlace=dns_gridactividadesoperativas.activiope_enlace where gractope_fecharegistro>='".$_POST["fecha_inicio"]."' and gractope_fecharegistro <='".$_POST["fecha_fin"]."' group by dns_gridactividadesoperativas.usua_id";
		

 $rs_gogessform = $DB_gogess->executec($cuenta_sql,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		   $lista_estu[$rs_gogessform->fields["usua_id"]]=$rs_gogessform->fields["total"];
		
		 $rs_gogessform->MoveNext();	
		}
 }		

//print_r($lista_estu);


$horas_contrato=20;
$horas_ideales=8;
?>
<div id="dvData">
<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="css_listat">CI</div></td>
    <td><div align="center" class="css_listat">NOMBRE DEL PROFESIONAL</div></td>
	<td><div align="center" class="css_listat">PROFESION</div></td>
    <td><div align="center" class="css_listat">HORAS CONTRATO/QUE SE UTILIZA PARA ACTIVIDADES OPERATIVAS</div></td>
    <td><div align="center" class="css_listat">HORAS IDEALES ACTIVIDADES OPERATIVAS</div></td>
    <td><div align="center" class="css_listat">HORAS REALES ACTIVIDADES OPERATIVAS</div></td>
    <td><div align="center" class="css_listat">PRODUCTIVIDAD</div></td>
  </tr>
<?php
if($_POST["usua_id"])
{
 $listacampos1="select * from app_usuario where usua_estado=1 and centro_id='".$_POST["centro_id"]."' and usua_id='".$_POST["usua_id"]."'";
}
else
{
 $listacampos1="select * from app_usuario where usua_estado=1 and centro_id='".$_POST["centro_id"]."'";

} 
 $rs_gogessform = $DB_gogess->executec($listacampos1,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		
$busca_ideal="select * from pichinchahumana_extension.dns_profesion where prof_nombre='".trim($rs_gogessform->fields['usua_formaciondelprofesional'])."'";
$rs_ideal = $DB_gogess->executec($busca_ideal,array());
//echo $rs_ideal->fields['prof_citasideales']."<br>";


$porcentaje=0;
if($horas_ideales>0)
{
  @$saca_solohoras=explode(":",$lista_estu[$rs_gogessform->fields["usua_id"]]);
  @$valor_reales=$saca_solohoras[0]*1;
  @$porcentaje=($valor_reales/$horas_ideales)*100;
}
//echo ;
		
		
?>  
  <tr>
    <td class="css_lista" ><?php echo $rs_gogessform->fields["usua_ciruc"]; //"-->".$rs_gogessform->fields["usua_id"]." ".$busca_ideal; ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_gogessform->fields["usua_apellido"]." ".$rs_gogessform->fields["usua_nombre"]); ?></td>
	<td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_gogessform->fields["usua_formaciondelprofesional"]); ?></td>
    <td class="css_lista" ><?php echo $horas_contrato; ?></td>
    <td class="css_lista" ><?php echo $horas_ideales; ?></td>
    <td class="css_lista" ><?php echo @$lista_estu[$rs_gogessform->fields["usua_id"]]; ?></td>
    <td class="css_lista" ><?php echo number_format($porcentaje, 0, '.', ''); ?></td>
  </tr>
<?php
            $rs_gogessform->MoveNext();	
       }
  }
		

?>  
</table>
</div>
<?php
}
?>