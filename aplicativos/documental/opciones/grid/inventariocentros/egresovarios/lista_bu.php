<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
<?php

$centro_activoentrecentros=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_activoentrecentros"," where centro_id=",$_SESSION['datadarwin2679_centro_id'],$DB_gogess);

$centro_disposentrecentros=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_disposentrecentros"," where centro_id=",$_SESSION['datadarwin2679_centro_id'],$DB_gogess);

$lista_tipo='';

if($centro_activoentrecentros==1 and $centro_disposentrecentros==1)
{
  $lista_tipo=' categ_id in (1,2,4,5,6,7,8) and ';
}

if($centro_activoentrecentros==1 and $centro_disposentrecentros==0)
{
  $lista_tipo=' categ_id in (1,2,4,5,6,7,8) and ';

}

if($centro_activoentrecentros==0 and $centro_disposentrecentros==1)
{
  $lista_tipo=' categ_id in (1,2,4,5,6,7,8) and ';

}



 $lista_campor="select * from dns_cuadrobasicomedicamentos where ".$lista_tipo."  cuadrobm_historial=0 and (cuadrobm_codigoatc like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_principioactivo like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_nombrecomercial like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_nombredispositivo like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_primerniveldesagregcion like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_presentacion like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_concentracion like '%".$_POST["bu_txtproducto"]."%')  order by  cuadrobm_principioactivo asc";
 
 
 $rs_tabla = $DB_gogess->executec($lista_campor,array());
 if($rs_tabla)
 {
	  while (!$rs_tabla->EOF) {	  
	  
	                    $ncampo_val='cuadrobm_principioactivo';
						$nom1='';					
						if($rs_tabla->fields["cuadrobm_nombredispositivo"])
						{
						   $nom1=$rs_tabla->fields["cuadrobm_nombredispositivo"].' ';
						}
						
						$nom2='';					
						if($rs_tabla->fields["cuadrobm_primerniveldesagregcion"])
						{
						   $nom2=$rs_tabla->fields["cuadrobm_primerniveldesagregcion"].' ';
						}
						
						$nom3='';					
						if($rs_tabla->fields["cuadrobm_presentacion"])
						{
						   $nom3=$rs_tabla->fields["cuadrobm_presentacion"].' ';
						}
						 
						$nom4='';					
						if($rs_tabla->fields["cuadrobm_concentracion"])
						{
						   $nom4=$rs_tabla->fields["cuadrobm_concentracion"].' ';
						}
	                    
						$concatena_nom=$nom1.$nom2.$nom3.$nom4;
						
						
						
						//cuadrobm_id,cuadrobm_principioactivo,cuadrobm_nombredispositivo,cuadrobm_primerniveldesagregcion,cuadrobm_presentacion,cuadrobm_concentracion
?>
  <tr>
    <td width="82"><input type="button" name="Button" value="Seleccionar" onClick="selecciona_p('<?php echo $rs_tabla->fields["cuadrobm_id"]; ?>')"></td>
    <td width="218"><?php echo $rs_tabla->fields["cuadrobm_codigoatc"].' - '.utf8_encode($rs_tabla->fields[$ncampo_val]).' '.utf8_encode($concatena_nom); ?></td>
  </tr>
<?php	  
	  $rs_tabla->MoveNext();
	  }
  }
?>
</table>
