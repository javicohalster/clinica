<?php
ini_set('memory_limit','-1');
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
$valor_busca=$_POST["ireport"];
$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();


$certif_id=@$_POST["ireport"];
$especi_id=@$_POST["especi_id"];
$usua_ci=$_POST["c1"];
$med_ci=$_POST["c2"];
$certifg_texto=$_POST["texto"];
$usua_id=@$_SESSION['datadarwin2679_sessid_inicio'];
$certifg_fecharegistro=date("Y-m-d");
$nd_otorgado=@$_POST["nd_otorgado"];


$inserta_reg="insert into dns_emplcertificadogenerado (certif_id,especi_id,usua_ci,med_ci,certifg_texto,usua_id,certifg_fecharegistro,nd_otorgado) values ('".$certif_id."','".$especi_id."','".$usua_ci."','".$med_ci."','".$certifg_texto."','".$usua_id."','".$certifg_fecharegistro."','".$nd_otorgado."');";

$rs_cert = $DB_gogess->executec($inserta_reg,array());
$id_regval=$DB_gogess->funciones_nuevoID(0);


}
?>
<input name="id_gen" type="hidden" id="id_gen" value="<?php echo $id_regval; ?>">