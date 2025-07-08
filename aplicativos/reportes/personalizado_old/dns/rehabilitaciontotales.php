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

//obtiene datos del centro
$centro_id=$_POST["centro_id"];
$datos_centro="select * from dns_centrosalud inner join app_provincia on dns_centrosalud.prob_codigo=app_provincia.prob_codigo where centro_id=".$centro_id;
$rs_centro = $DB_gogess->executec($datos_centro,array());

$zona='';
$zona=$rs_centro->fields["zona_id"];

$subzona='';
$subzona=$rs_centro->fields["prob_nombre"];

$nombrecentro=$rs_centro->fields["centro_nombre"];

$nivel_centro=$rs_centro->fields["permif_id"];


//obtiene datos del centro

$lista_estu=array();


$saca_citas='select fisiot_id as id_tbl,clie_id,dns_fisioterapia.usua_id,DATE(fisiot_fecharegistro) as fecharegistro,TIME(fisiot_fecharegistro) as hora,"dns_fisioterapia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,dns_fisioterapia.fisiot_enlace as enlace,dns_fisioterapia.centro_id,fisiot_centrorefiere,fisiot_profesionarefiere,usua_ciruc,usua_nombre,usua_apellido,"PRIMERA" as tipo_at
from dns_fisioterapia inner join app_usuario on dns_fisioterapia.usua_id=app_usuario.usua_id 
';


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
    <td><div align="center" class="css_listat">ZONA</div></td>
    <td><div align="center" class="css_listat">SUBZONA</div></td>
	<td><div align="center" class="css_listat">Unidad RPIS que transfiere/DERIVA  (SI ES ENVIADO LOCAL ES EL MISMO)</div></td>
    <td><div align="center" class="css_listat">NOMBRE DEL CENTRO MEDICO (DONDE SE ATIENDE)</div></td>
    <td><div align="center" class="css_listat">NIVEL SOLO RPIS/NIVEL DEL CENTRO  (DEL QUE ATIENDE)</div></td>
    <td><div align="center" class="css_listat">FECHA DE ATENCION (dd/mm/aaaa)</div></td>
    <td><div align="center" class="css_listat">HORA DE ATENCION  (00:00)</div></td>
	<td><div align="center" class="css_listat">CIE 10</div></td>
	<td><div align="center" class="css_listat">DESCRIPCION DEL CIE 10</div></td>
	<td><div align="center" class="css_listat">FECHA DE INICIO DEL TRATAMIENTO (FECHA DE ATENCION)</div></td>
	<td><div align="center" class="css_listat">FECHA DE FINALIZACION DEL TRATAMIENTO (POR DIA EL MISMO)</div></td>
	<td><div align="center" class="css_listat">FECHA DE LA PRESTACION (MISMA FECHA DE INCIO)</div></td>
	<td><div align="center" class="css_listat">ESPECIALIDAD TERAPEUTICA</div></td>
	<td><div align="center" class="css_listat">CLASIFICACION POR CARGO/ESPECIALIDAD</div></td>
	<td><div align="center" class="css_listat">NOMBRE DEL PROFESIONAL TERAPEUTA (Apellidos y Nombres)</div></td>
	<td><div align="center" class="css_listat">CEDULA DEL PROFESIONAL TERAPEUTA</div></td>
	<td><div align="center" class="css_listat">No. DE HISTORIA CLINICA O CEDULA</div></td>
	<td><div align="center" class="css_listat">PARENTESCO</div></td>
	<td><div align="center" class="css_listat">NOMBRE TITULAR DEL SEGURO</div></td>
	<td><div align="center" class="css_listat">Nro. CEDULA TITULAR</div></td>
	<td><div align="center" class="css_listat">NOMBRE BENEFICIARIO</div></td>
	<td><div align="center" class="css_listat">Nro. CEDULA DEL BENEFICIARIO</div></td>
	<td><div align="center" class="css_listat">TIPO DE AFILIACION</div></td>
	<td><div align="center" class="css_listat">ETNIA</div></td>
	<td><div align="center" class="css_listat">SEXO</div></td>
	<td><div align="center" class="css_listat">EDAD</div></td>
	<td><div align="center" class="css_listat">NACIONALIDAD</div></td>
	<td><div align="center" class="css_listat">NUMERO TELEFONICO DEL  PACIENTE  CELULAR</div></td>
	<td><div align="center" class="css_listat">TARIFADO</div></td>
	<td><div align="center" class="css_listat">CANTIDAD</div></td>
	<td><div align="center" class="css_listat">REGISTRO DE TERAPIAS</div></td>
	<td><div align="center" class="css_listat">CANTIDAD</div></td>
  </tr>
  
  <?php
  if($_POST["usua_id"])
  {
$cuenta_sql="select id_tbl,tabla,clie_id,usua_id,prenatal_p,prenatal_s,parto,postparto,planificacion_p,planificacion_s,uterino,mamario,fecharegistro,enlace,hora,fisiot_profesionarefiere,fisiot_centrorefiere,usua_ciruc,usua_nombre,usua_apellido,tipo_at,situ_id,clie_fechanacimiento,clie_apellido,clie_nombre,clie_rucci,clie_genero,clie_numerodecedulatitular,clie_parentescopaciente,clie_nombretitulardelseguro,tipopac_id,nac_id,clie_celular from pichinchahumana_reportes.lista_rehabilitaciontotales tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and usua_id='".$_POST["usua_id"]."' and centro_id='".$centro_id."'";
}
else
{
$cuenta_sql="select id_tbl,tabla,clie_id,usua_id,prenatal_p,prenatal_s,parto,postparto,planificacion_p,planificacion_s,uterino,mamario,fecharegistro,enlace,hora,fisiot_profesionarefiere,fisiot_centrorefiere,usua_ciruc,usua_nombre,usua_apellido,tipo_at,situ_id,clie_fechanacimiento,clie_apellido,clie_nombre,clie_rucci,clie_genero,clie_numerodecedulatitular,clie_parentescopaciente,clie_nombretitulardelseguro,tipopac_id,nac_id,clie_celular from pichinchahumana_reportes.lista_rehabilitaciontotales tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and centro_id='".$centro_id."'";

}

//echo $cuenta_sql;
 $rs_gogessform = $DB_gogess->executec($cuenta_sql,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		$ncentro=$nombrecentro;
		if($rs_gogessform->fields["fisiot_centrorefiere"])
		{
		  $ncentro=$rs_gogessform->fields["fisiot_centrorefiere"];
		}
		
		$quita_hora=array();
		$quita_hora=explode(" ",$rs_gogessform->fields["fecharegistro"]);
		
		$feha_regi=array();
		$feha_regi=explode("-",$quita_hora[0]);
		
		
		//-------------	
		//diagnosticos
		  
		  $busca_tbldiagnositco="select * from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(1) and gogess_sistable.tab_name='".$rs_gogessform->fields["tabla"]."' and fie_type='campogrid'";
	
	       $rs_tbldiag = $DB_gogess->executec($busca_tbldiagnositco,array());
		   
		   $lista_diag="select * from ".$rs_tbldiag->fields["fie_tablasubgrid"]." where ".$rs_tbldiag->fields["fie_campoenlacesub"]."='".$rs_gogessform->fields["enlace"]."' limit 1";
	       $rs_diag = $DB_gogess->executec($lista_diag,array());
		   
		//----------------
		
		/// $busca_data_cliente="select * from app_cliente where clie_id='".$rs_gogessform->fields["clie_id"]."'";	
		/// $rs_cliente = $DB_gogess->executec($busca_data_cliente,array());
		 
		 //-------------------
		 
	$nombre_titulars='';
	$cedula_titulars='';
	
	if($rs_gogessform->fields["clie_numerodecedulatitular"]==$rs_gogessform->fields["clie_rucci"])
	{
	   $nombre_titulars=$rs_gogessform->fields["clie_apellido"].' '.$rs_gogessform->fields["clie_nombre"];
	   $cedula_titulars=$rs_gogessform->fields["clie_rucci"];
	   
	   // $nombre_titulars='';
	  // $cedula_titulars='';
	
	}
	else
	{
	   if($rs_gogessform->fields["clie_numerodecedulatitular"]=='')
	   {
	     $nombre_titulars='';
	     $cedula_titulars='';
		 if($rs_gogessform->fields["clie_parentescopaciente"]=='TITULAR')
			 {
				 
				 $nombre_titulars=$rs_gogessform->fields["clie_apellido"].' '.$rs_gogessform->fields["clie_nombre"];
	             $cedula_titulars=$rs_gogessform->fields["clie_rucci"];
			  } 
	   } 
	   else
	   {
	      $nombre_titulars=$rs_gogessform->fields["clie_nombretitulardelseguro"];
	      $cedula_titulars=$rs_gogessform->fields["clie_numerodecedulatitular"];
	   
	   }
	
	}
		
		//tipopac_id
		
		
		$busca_tiposeguro="select tipopac_nombre from faesa_tipopaciente where tipopac_id='".$rs_gogessform->fields["tipopac_id"]."'";	
		$rs_tseguro = $DB_gogess->executec($busca_tiposeguro,array());
		
		$sexo='';
		if($rs_gogessform->fields["clie_genero"]=='F')
		{
		  $sexo='FEMENINO';
		}
		if($rs_gogessform->fields["clie_genero"]=='M')
		{
		  $sexo='MASCULINO';
		}
		
		
	$edad_val=array();
	//$edad_val=calculaedad();
	
	$edad_val=$objvarios->calcular_edad($rs_gogessform->fields["clie_fechanacimiento"],$rs_gogessform->fields["fecharegistro"]);
	
	
	
	//nacionalidad
	$busca_nacionalidad="select nac_nombre from dns_nacionalidad where nac_id='".$rs_gogessform->fields["nac_id"]."'";	
    $rs_nacionalidad = $DB_gogess->executec($busca_nacionalidad,array());
	
	 
	//tarifado
	$tarifa_data='';
	$tarifa_data='<table width="400" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="37" class="css_listat">No</td>
    <td width="149" class="css_listat">TNS</td>
    <td width="93" class="css_listat">DESCRIPCION</td>
    <td width="93" class="css_listat">VALOR</td>
  </tr>';
    $ceuenta_dor=0;
	$suma_precio=0;
	$busca_tarifado="select * from dns_tarifariofisioterapia where fisiot_enlace='".$rs_gogessform->fields["enlace"]."' and (cuabas_fecharegistro>='".$_POST["fecha_inicio"]."' and cuabas_fecharegistro<='".$_POST["fecha_fin"]."')";	
    $rs_tarifado = $DB_gogess->executec($busca_tarifado,array());
	if($rs_tarifado)
	{
		while (!$rs_tarifado->EOF) {	
		 
		 $ceuenta_dor++;
		 $tarifa_data.='<tr>
			<td height="23" class="css_lista">'.$ceuenta_dor.'</td>
			<td class="css_lista">'.$rs_tarifado->fields["prod_codigo"].'</td>
			<td class="css_lista">'.$rs_tarifado->fields["prod_descripcion"].'</td>
			<td class="css_lista">'.$rs_tarifado->fields["prod_precio"].'</td>
		  </tr>';
		  $suma_precio=$suma_precio+$rs_tarifado->fields["prod_precio"];
		
		$rs_tarifado->MoveNext();
		}
	}	
	
	$tarifa_data.='<tr>
			<td height="23" class="css_lista"><B>'.$ceuenta_dor.'</B></td>
			<td class="css_lista"></td>
			<td class="css_lista"><B>TOTAL</B></td>
			<td class="css_lista"><B>'.$suma_precio.'</B></td>
		  </tr>';
	$tarifa_data.='</table>';
 
  

	 //registro terapias
	$registro_data='';
	$rterap_dor=0;
	$registro_data='<table width="400" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="37" class="css_listat">No</td>
    <td width="149" class="css_listat">TIPO</td>
    <td width="93" class="css_listat">FECHA</td>
    <td width="93" class="css_listat">HORA</td>
  </tr>';
	 $busca_rterapias="select * from dns_regfisioterapia where fisiot_enlace='".$rs_gogessform->fields["enlace"]."' and (regterapia_fecharegistro>='".$_POST["fecha_inicio"]."' and regterapia_fecharegistro<='".$_POST["fecha_fin"]."')";	
     $rs_rteraias = $DB_gogess->executec($busca_rterapias,array());
	 if($rs_rteraias)
	{
		while (!$rs_rteraias->EOF) {	
		
		 $rterap_dor++;
		 $registro_data.='<tr>
			<td height="23" class="css_lista">'.$ceuenta_dor.'</td>
			<td class="css_lista">'.$rs_rteraias->fields["regterapia_tipo"].'</td>
			<td class="css_lista">'.$rs_rteraias->fields["regterapia_fecha"].'</td>
			<td class="css_lista">'.$rs_rteraias->fields["regterapia_hora"].'</td>
		  </tr>';
		
		$rs_rteraias->MoveNext();
		}
	}	
	
	$registro_data.='<tr>
			<td height="23" class="css_lista"><B></B></td>
			<td class="css_lista"></td>
			<td class="css_lista"><B>TOTAL</B></td>
			<td class="css_lista"><B>'.$rterap_dor.'</B></td>
		  </tr>';
	$registro_data.='</table>';
  ?>
  
  <tr valign="top">
    <td nowrap="NOWRAP" class="css_lista"><?php echo $zona; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $subzona; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $ncentro; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $nombrecentro; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $nivel_centro; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $feha_regi[2]."/".$feha_regi[1]."/".$feha_regi[0] ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $rs_gogessform->fields["hora"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $rs_diag->fields["diagn_cie"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $rs_diag->fields["diagn_descripcion"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $feha_regi[2]."/".$feha_regi[1]."/".$feha_regi[0] ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $feha_regi[2]."/".$feha_regi[1]."/".$feha_regi[0] ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $feha_regi[2]."/".$feha_regi[1]."/".$feha_regi[0] ?></td>
    <td nowrap="NOWRAP" class="css_lista">TERAPIA FISICA</td>
    <td nowrap="NOWRAP" class="css_lista">MEDICINA FISICA Y REHABILITACI&Oacute;N</td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo utf8_encode(@$rs_gogessform->fields["usua_apellido"].' '.$rs_gogessform->fields["usua_nombre"]); ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo @$rs_gogessform->fields["usua_ciruc"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $rs_gogessform->fields["clie_rucci"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $rs_gogessform->fields["clie_parentescopaciente"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo utf8_encode($nombre_titulars); ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo utf8_encode($cedula_titulars); ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo utf8_encode(@$rs_gogessform->fields["clie_apellido"].' '.$rs_gogessform->fields["clie_nombre"]); ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo @$rs_gogessform->fields["clie_rucci"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $rs_tseguro->fields["tipopac_nombre"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $sexo; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $edad_val["anio"]; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo strtoupper($rs_nacionalidad->fields["nac_nombre"]); ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $rs_gogessform->fields["clie_celular"]; ?></td>
    <td  class="css_lista"><?php echo $tarifa_data; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $ceuenta_dor; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $registro_data; ?></td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo $rterap_dor; ?></td>
  </tr>

  <?php
       $total_uno=$total_uno+$ceuenta_dor;
	   $total_dos=$total_dos+$rterap_dor;
  
      $rs_gogessform->MoveNext();	
		}
 }
  
  ?>
  
   <tr valign="top">
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td  class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo  $total_uno; ?></td>
    <td nowrap="NOWRAP" class="css_lista">&nbsp;</td>
    <td nowrap="NOWRAP" class="css_lista"><?php echo  $total_dos; ?></td>
  </tr>
  
</table>
</div>
<?php
}
?>

