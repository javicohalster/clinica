<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$fecha_actual=date("Y-m-d");

//$ver_sipuede="select * from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"]." and terap_fecha>'".$fecha_actual."'";
$ver_sipuede="select * from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"]."";
$ok_versi=$DB_gogess->executec($ver_sipuede,array());

if(@$ok_versi->fields["terap_id"])
{
//$creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"]." and terap_fecha>'".$fecha_actual."'";

if($ok_versi->fields["hcc_id"]>0)
{
$creascripborrado="update ".$_POST["ptabla"]." set terap_cancelado=1 where ".$_POST["pcampo"]."=".$_POST["pvalor"]."";
$ok=$DB_gogess->executec($creascripborrado,array());
}
else
{
$creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"]."";
$ok=$DB_gogess->executec($creascripborrado,array());
}

//echo $creascripborrado;

 if($ok)
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro borrado con exito...</div>';
 }
 else
 {
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado intente nuevamente...</div>';
echo '<script type="text/javascript">

<!--

 mensaje_borrado("No se puede borrar")

//-->

</script> ';

 }

}
else
{

echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro fuera de fecha...</div>';
echo '<script type="text/javascript">
<!--

 mensaje_borrado("Registro fuera de fecha...")

//-->
</script> ';

}
 

 }
 else
 {

echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Sesi&oacute;n ha caducado F5 para continuar...</div>';

 }

?>