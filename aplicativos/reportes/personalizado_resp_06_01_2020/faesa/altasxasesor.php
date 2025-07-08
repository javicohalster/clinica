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
    <td bgcolor="#D2E2EE"><span class="css_titulo">No. ALTAS</span></td>
  </tr>
  <?php
  //psicologia
  if($_POST["usua_id"])
  {
  
 $lista_ecoluciones="select count(*) as total,evos.usua_id from faesa_informealta evos   where infoalta_fecharegistro>='".$_POST["fecha_inicio"]."' and infoalta_fecharegistro<='".$_POST["fecha_fin"]."' and evos.usua_id=".$_POST["usua_id"]." group by evos.usua_id";
 
 
}
else
{

 $lista_ecoluciones="select count(*) as total,evos.usua_id from faesa_informealta evos   where infoalta_fecharegistro>='".$_POST["fecha_inicio"]."' and infoalta_fecharegistro<='".$_POST["fecha_fin"]."' group by evos.usua_id";

}

  $rs_gogessform = $DB_gogess->Execute($lista_ecoluciones);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
  ?>
  <tr>
    <td><span class="css_texto"><?php echo $nusuario; ?></span></td>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
 
</table>