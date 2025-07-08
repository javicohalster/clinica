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

?>
<table width="500" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#D2E2EE"><span class="css_titulo">TERAPEUTA</span></td>
    <td bgcolor="#D2E2EE"><span class="css_titulo">No. TERAPIAS</span></td>
  </tr>
  <?php
  if($_POST["usua_id"])
  {
$lista_terapias="select tr.usua_id,usua_nombre,usua_apellido,count(terap_id) as total from faesa_terapiasregistro tr inner join app_usuario us on tr.usua_id=us.usua_id where terap_fecha>='".$_POST["fecha_inicio"]."' and terap_fecha<='".$_POST["fecha_fin"]."'  and tr.usua_id=".$_POST["usua_id"]." group by tr.usua_id";
}
else
{
$lista_terapias="select tr.usua_id,usua_nombre,usua_apellido,count(terap_id) as total from faesa_terapiasregistro tr inner join app_usuario us on tr.usua_id=us.usua_id where terap_fecha>='".$_POST["fecha_inicio"]."' and terap_fecha<='".$_POST["fecha_fin"]."' group by tr.usua_id";

}

   $rs_gogessform = $DB_gogess->Execute($lista_terapias);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
  ?>
  <tr>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["usua_nombre"]." ".$rs_gogessform->fields["usua_apellido"]; ?></span></td>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
</table>