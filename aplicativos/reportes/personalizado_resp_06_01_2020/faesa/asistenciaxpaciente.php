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
    <td bgcolor="#D2E2EE"><span class="css_titulo">PACIENTE</span></td>
    <td bgcolor="#D2E2EE"><span class="css_titulo">No. ASISTENCIAS</span></td>
  </tr>
  <?php
  //psicologia
  if($_POST["clie_id"])
  {
  
 $lista_ecoluciones="select distinct count(evoludet_fecha) as total,clie_id from faesa_evolucion evos inner join faesa_evoluciondetalle det on  evos.evolu_enlace=det.evolu_enlace  where evoludet_fecha>='".$_POST["fecha_inicio"]."' and evoludet_fecha<='".$_POST["fecha_fin"]."' and evos.clie_id=".$_POST["clie_id"]." group by evos.clie_id";
 
 
}
else
{

$lista_ecoluciones="select distinct count(evoludet_fecha) as total,clie_id from faesa_evolucion evos inner join faesa_evoluciondetalle det on  evos.evolu_enlace=det.evolu_enlace  where evoludet_fecha>='".$_POST["fecha_inicio"]."' and evoludet_fecha<='".$_POST["fecha_fin"]."' group by evos.clie_id";

}

//echo $lista_ecoluciones;

  $rs_gogessform = $DB_gogess->Execute($lista_ecoluciones);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_cliente","clie_id,clie_nombre,clie_apellido"," where clie_id=",$rs_gogessform->fields["clie_id"],$DB_gogess);
  ?>
  <tr>
    <td><span class="css_texto"><?php echo utf8_encode($nusuario); ?></span></td>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
 
</table>