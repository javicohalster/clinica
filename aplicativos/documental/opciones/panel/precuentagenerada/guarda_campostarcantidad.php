<?php
header('Content-Type: text/html; charset=UTF-8');
$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/

if($_SESSION['datadarwin2679_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$sqltotal="";

$precio=$_POST["cantidad"];
$clie_id=$_POST["clie_id"];
$precu_id=$_POST["precu_id"];
$tipo=$_POST["tipo"];

//$busca_cliente="select * from app_cliente where clie_id='".$clie_id."'";
//$rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
//$conve_id=$rs_bcliente->fields["conve_id"];
	  
//$pvp_enformula=0;
//$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$_POST["valor"],$DB_gogess);
   	  

$actualiza_data="update ".$_POST["tabla"]." set ".$_POST["campo"]."='".$_POST["valor"]."',detapre_precioventa='".$_POST["cantidad"]."' where ".$_POST["campoidtabla"]."='".$_POST["id"]."'";
$okvalor=$DB_gogess->executec($actualiza_data); 

$lista_totales="select sum(ROUND(detapre_precio, 2)*detapre_cantidad) as total_g from dns_detalleprecuenta where precu_id='".$precu_id."' and detapre_tipo='".$tipo."'"; 
$okv_totales=$DB_gogess->executec($lista_totales); 

?>
<script type="text/javascript">
<!--

//$('#cmb_detapre_precioventa<?php echo $_POST["id"]; ?>').html('<?php echo $pvp_enformula; ?>');
$('#cmb_total<?php echo $_POST["id"]; ?>').html('<?php echo $_POST["valor"]*$precio; ?>');
$('#totales_gentar<?php echo $tipo; ?>').html('<?php echo round($okv_totales->fields["total_g"],3); ?>')

//  End -->
</script>

<?php

}
?>