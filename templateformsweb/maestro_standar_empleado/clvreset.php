<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

function generarCodigo($longitud) {
 $key = '';
 $pattern = '234567890abcdefghjkmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}

$nclvvalor=generarCodigo(8);
//echo $_POST["idv"];

$obj_resetclave= new funciones_generales();
$obj_resetclave->setDataBase($DB_gogess);
$obj_resetclave->setUser($_POST["idv"]);
$obj_resetclave->setPassword($nclvvalor);
$obj_resetclave->reset_clave();



}
else
{
   echo '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;" >Lo sentimos, su sesi�n ha caducado de clic en F5 para continuar....</span>';

}
?>