<style type="text/css">
<!--
.css_titulo {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_texto {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$director="../../../../director/";
include ("../../../../director/cfgclases/clases.php");

$sql1='';
if($_POST["tipopac_id"])
  {
   $sql1=" cli.tipopac_id=".$_POST["tipopac_id"]." and ";
  }

if($_POST["centro_id"])
  {
   $sql2=" us.centro_id=".$_POST["centro_id"]." and ";
  }

$concatena_sql=$sql1.$sql2;

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_POST["centro_id"],$DB_gogess);

echo "<center><b>".$nciudad."</b></center>";
?>
<table width="500" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#D2E2EE"><span class="css_titulo">CATEGORIA</span></td>
    <td bgcolor="#D2E2EE"><span class="css_titulo">No. TERAPIAS</span></td>
  </tr>
  <?php
  if($concatena_sql)
  {
$lista_terapias="select cli.tipopac_id,tipopac_nombre,usua_nombre,usua_apellido,count(terap_id) as total from faesa_terapiasregistro tr inner join app_usuario us on tr.usua_id=us.usua_id inner join app_cliente cli on cli.clie_id=tr.clie_id inner join faesa_tipopaciente tp on tp.tipopac_id=cli.tipopac_id where ".$concatena_sql." (terap_fecha>='".$_POST["fecha_inicio"]."' and terap_fecha<='".$_POST["fecha_fin"]."') group by cli.tipopac_id";
}
else
{

$lista_terapias="select cli.tipopac_id,tipopac_nombre,usua_nombre,usua_apellido,count(terap_id) as total from faesa_terapiasregistro tr inner join app_usuario us on tr.usua_id=us.usua_id inner join app_cliente cli on cli.clie_id=tr.clie_id inner join faesa_tipopaciente tp on tp.tipopac_id=cli.tipopac_id where terap_fecha>='".$_POST["fecha_inicio"]."' and terap_fecha<='".$_POST["fecha_fin"]."' group by cli.tipopac_id";

}

   $rs_gogessform = $DB_gogess->Execute($lista_terapias);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		
  
  ?>
  <tr>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["tipopac_nombre"]; ?></span></td>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
</table>