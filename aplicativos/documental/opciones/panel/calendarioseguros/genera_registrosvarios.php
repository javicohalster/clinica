<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//echo $_POST["fecha_inicioval"];

//echo ;
$n_terapiasval=$_POST["n_terapiasval"];
$dias_selecciona='';
$horas_selecciona='';

$terap_motivoval=$_POST["terap_motivoval"];
$terap_nfacturaval=$_POST["terap_nfacturaval"];

//==============================================================================
$array_lista=array();
$toma_d=0;
for($i=0;$i<=6;$i++)
{
	$toma_d=$i+1;
	$array_lista[$i]["usua_id"]=$_POST["usua_idvalx".$toma_d];
	$array_lista[$i]["terap_fecha"]=$_POST["fecha_inicioval".$toma_d];
	$array_lista[$i]["terap_hora"]=$_POST["hora_".$toma_d];
	$array_lista[$i]["terap_motivo"]=$_POST["motivo_".$toma_d];
	$array_lista[$i]["prof_id"]=$_POST["prof_idvalx".$toma_d];
	$array_lista[$i]["terap_medicompanies"]=$_POST["medicompanies_".$toma_d];
	$array_lista[$i]["terap_copago"]=$_POST["copago_".$toma_d];
	$array_lista[$i]["terap_obs"]=$_POST["observacion_".$toma_d];
}
//==============================================================================

//codigo medicopanies unico
//copago unico 

//print_r($array_lista);
$especi_id=0;
for($i=0;$i<=6;$i++)
{
  
  if($array_lista[$i]["terap_fecha"]!='')
  {
  
  $especi_id=0;
  $buscat_us="select * from app_usuario where usua_id='".$array_lista[$i]["usua_id"]."'";
  $rs_buscus = $DB_gogess->executec($buscat_us,array());
  $especi_id=$rs_buscus->fields["especi_id"];
  
  $inserta_datos="insert into faesa_terapiasregistro (atenc_hc,clie_id,terap_fecha,terap_hora,terap_autorizacion,especi_id,usua_id,centro_id,usuar_id,terap_fecharegistro,terap_motivo,terap_nfactura,prof_id,terap_medicompanies,terap_copago,terap_obs,conve_id) values ('".$_POST["atenc_hc"]."','".$_POST["clie_id"]."','".$array_lista[$i]["terap_fecha"]."','".$array_lista[$i]["terap_hora"]."','".$_POST["n_autorizacionval"]."','".$array_lista[$i]["prof_id"]."','".$array_lista[$i]["usua_id"]."','".$_POST["centro_id"]."','".$_POST["usuar_id"]."','".date("Y-m-d")."','".$array_lista[$i]["terap_motivo"]."','".$terap_nfacturaval."','".$array_lista[$i]["prof_id"]."','".$array_lista[$i]["terap_medicompanies"]."','".$array_lista[$i]["terap_copago"]."','".$array_lista[$i]["terap_obs"]."',2)";
  
  $rs_terapia = $DB_gogess->executec($inserta_datos,array());
  //echo $inserta_datos."<br>";
  
  }
  
}


}
?>