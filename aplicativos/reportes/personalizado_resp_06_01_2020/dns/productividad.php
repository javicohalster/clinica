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

$saca_citas='select clie_id,usua_id,imginfo_fecharegistro as fecharegistro from dns_imagenologiainfo union 
		select clie_id,usua_id,anam_fecharegistro as fecharegistro from dns_anamesisexamenfisico union 
		select clie_id,usua_id,conext_fecharegistro as fecharegistro from dns_consultaexterna union 
		select clie_id,usua_id,odonto_fecharegistro as fecharegistro from dns_odontologia union 
		select clie_id,usua_id,prinvas_fecharegistro as fecharegistro from dns_procediminetosinvasivos union 
		select clie_id,usua_id,psicolo_fecharegistro as fecharegistro from dns_psicologia union 
		select clie_id,usua_id,referencia_fecharegistro as fecharegistro from dns_referencia union 
		select clie_id,usua_id,intercon_fecharegistro as fecharegistro from dns_interconsulta union 
		select clie_id,usua_id,subsecodont_fecharegistro as fecharegistro from dns_subsecuenteodontologia union 
		select clie_id,usua_id,prehosp_fecharegistro as fecharegistro from dns_prehospitalario union 
		select clie_id,usua_id,histopa_fecharegistro as fecharegistro from dns_histopatologia union 
		select clie_id,usua_id,lab_fecharegistro as fecharegistro from dns_laboratorio union 
		select clie_id,usua_id,imgag_fecharegistro as fecharegistro from dns_imagenologia union 
		select clie_id,usua_id,enferm_fecharegistro as fecharegistro from dns_enfermeria union 
		select clie_id,usua_id,labinfor_fecharegistro as fecharegistro from dns_laboratorioinforme union 
		select clie_id,usua_id,fisiot_fecharegistro as fecharegistro from dns_fisioterapia union 
		select clie_id,usua_id,subsecpsico_fecharegistro as fecharegistro from dns_subsecuentepsicologia union 
		select clie_id,usua_id,vidomici_fecharegistro as fecharegistro from dns_visitadomiciliaria union		
		select clie_id,dns_regfisioterapia.usua_id,regterapia_fecha as fecharegistro from dns_fisioterapia inner join dns_regfisioterapia on dns_fisioterapia.fisiot_enlace=dns_regfisioterapia.fisiot_enlace	
		
		';
		
		
		
$saca_citas="select clie_id,usua_id,fecharegistro from pichinchahumana_reportes.productividad_data where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."'";	
		
$cuenta_sql="select count(clie_id) as total,usua_id from (".$saca_citas.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' group by usua_id";	

 $rs_gogessform = $DB_gogess->executec($cuenta_sql,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		   $lista_estu[$rs_gogessform->fields["usua_id"]]=$rs_gogessform->fields["total"];
		
		 $rs_gogessform->MoveNext();	
		}
 }		

//print_r($lista_estu);

?>
<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

<?php
if(@$_POST["centro_id"])
{
$lista_centros="select * from dns_centrosalud where centro_activo=1 and centro_id='".$_POST["centro_id"]."'";
}
else
{
$lista_centros="select * from dns_centrosalud where centro_activo=1";
}

$rs_centros = $DB_gogess->executec($lista_centros,array());
 if($rs_centros)
 {
     	while (!$rs_centros->EOF) {
		
		echo "<center><br><b>".utf8_encode($rs_centros->fields["centro_nombre"])."</b></center><br>";
?>

<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="css_listat">CI</div></td>
    <td><div align="center" class="css_listat">NOMBRE DEL PROFESIONAL</div></td>
	<td><div align="center" class="css_listat">PROFESION</div></td>
    <td><div align="center" class="css_listat">HORAS CONTRATO</div></td>
    <td><div align="center" class="css_listat">CITAS IDEALES</div></td>
    <td><div align="center" class="css_listat">CITAS REALES</div></td>
    <td><div align="center" class="css_listat">PRODUCTIVIDAD</div></td>
  </tr>
<?php

if($_POST["usua_id"])
{
 $listacampos1="select * from app_usuario where usua_estado=1 and centro_id='".$rs_centros->fields["centro_id"]."' and usua_id='".$_POST["usua_id"]."'";
}
else
{
 $listacampos1="select * from app_usuario where usua_estado=1 and centro_id='".$rs_centros->fields["centro_id"]."'";

}
 
 //echo $listacampos1;
 $rs_gogessform = $DB_gogess->executec($listacampos1,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		
$busca_ideal="select * from pichinchahumana_extension.dns_profesion where prof_nombre='".trim($rs_gogessform->fields['usua_formaciondelprofesional'])."'";
$rs_ideal = $DB_gogess->executec($busca_ideal,array());
//echo $rs_ideal->fields['prof_citasideales']."<br>";


$porcentaje=0;
if($rs_ideal->fields['prof_citasideales']>0)
{
  $porcentaje=($lista_estu[$rs_gogessform->fields["usua_id"]]/$rs_ideal->fields['prof_citasideales'])*100;
}
//echo ;
		
		
?>  
  <tr>
    <td class="css_lista" ><?php echo $rs_gogessform->fields["usua_ciruc"]; //"-->".$rs_gogessform->fields["usua_id"]." ".$busca_ideal; ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_gogessform->fields["usua_apellido"]." ".$rs_gogessform->fields["usua_nombre"]); ?></td>
	<td nowrap="nowrap" class="css_lista" ><?php echo utf8_encode($rs_gogessform->fields["usua_formaciondelprofesional"]); ?></td>
    <td class="css_lista" ><?php echo $rs_gogessform->fields["usua_horascontrato"]; ?></td>
    <td class="css_lista" ><?php echo $rs_ideal->fields['prof_citasideales']; ?></td>
    <td class="css_lista" ><?php echo $lista_estu[$rs_gogessform->fields["usua_id"]]; ?></td>
    <td class="css_lista" ><?php echo number_format($porcentaje, 2, '.', ''); ?></td>
  </tr>
<?php
            $rs_gogessform->MoveNext();	
       }
  }
		

?>  
</table>
<?php
         $rs_centros->MoveNext();	
       }
  }

?>


<?php
}
?>