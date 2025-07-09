<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tiempossss = 444200;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
$system = 1;
include("cfg/clases.php");
include("cfg/declaracion.php");
$director = "";
include($director . "libreria/variables/variables.php");
//test
/*if(!($apl))
{
 $apl=17;
 $secc=7;
 }*/
//test 

$objportal->datos_portal($system, $DB_gogess);

if (isset($close) && $close == 1)
{
    $_SESSION['vir_ususer'] = "";
    $_SESSION['vir_pwd'] = "";
    $_SESSION['vir_name'] = "";	
    $_SESSION['vir_ci'] = "";	
    $_SESSION['vir_sessid'] = "";
}

$objtemplatep->select_templatep($system, $apl ?? null, $ar ?? null, $DB_gogess);

if ($system)
{
  // Inicializamos sesion   
  include($objtemplatep->path_template . "index.php");
}
?>
