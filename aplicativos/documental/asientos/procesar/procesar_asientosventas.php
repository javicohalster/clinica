<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['datadarwin2679_sessid_inicio'])
{

$doccab_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

?>
<link type="text/css" href="../../../../templates/page/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script src="../../../../templates/page/menu/js/1.11.2.jquery.min.js"></script>
<script type="text/javascript" src="../../../../templates/page/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="../../../../templates/page/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../../templates/page/js/jquery.form.js"></script>

<?php
}


?>