<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
?>
<style type="text/css">

<!--

.txt_titulo {

	font-size: 11px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-weight: bold;

	border: 1px solid #666666;			

 }

.txt_txt {

	font-size: 11px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	border: 1px solid #666666;			

 }

.Estilo1 {font-size: 10px}

-->

</style>
<?php
include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {

  $objtableform->select_templateform(@$table,$DB_gogess);	

  }

$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;



if($_POST["opcion"]==2)
{

 $borra_reg="delete from faesa_pedagogiaaprendizaje where pedago_enlace=".$_POST["enlace"]." and pedaprendiz_id=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());

}


if($_POST["opcion"]==1)
{

$sql_inserta="INSERT INTO `faesa_pedagogiaaprendizaje` (pedago_enlace,tipoa_id,pedaprendiz_porcentaje,pedaprendiz_apreciacion,usua_id,pedaprendiz_fecharegistro) VALUES ('".$_POST["enlace"]."','".$_POST["tipoa_idx"]."','".$_POST["pedaprendiz_porcentajex"]."','".$_POST["pedaprendiz_apreciacionx"]."','".$_SESSION['datadarwin2679_sessid_inicio']."','".date("Y-m-d h:i:s")."')";
$rs_inserta = $DB_gogess->executec($sql_inserta,array());

}

?>

<div class="table-responsive">

<table class="table table-bordered"  style="width:100%" >

  <tr>

    <td>Eliminar</td>
    <td>Tipo</td>
	<td>Porcentaje</td>
    <td>Apreciaci&oacute;n</td>
  </tr>

<?php
$cuenta=0;

$lista_servicios="select pedaprendiz_id,pedago_enlace,faesa_pedagogiaaprendizaje.tipoa_id,pedaprendiz_porcentaje,pedaprendiz_apreciacion,pedaprendiz_fecharegistro,tipoa_nombre from faesa_pedagogiaaprendizaje inner join faesa_tipoarea2 on faesa_pedagogiaaprendizaje.tipoa_id=faesa_tipoarea2.tipoa_id where pedago_enlace=".$_POST['enlace']." order by pedaprendiz_porcentaje desc";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

	    $cuenta++;

  ?>

  <tr>

    <td onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields["pedago_enlace"]; ?>','<?php echo $rs_data->fields["pedaprendiz_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>

	
	<td><?php echo $rs_data->fields["tipoa_nombre"]; ?></td>   
	<td><?php echo $rs_data->fields["pedaprendiz_porcentaje"]; ?></td>
    <td><?php echo $rs_data->fields["pedaprendiz_apreciacion"]; ?></td>
  </tr>

  <?php

   $rs_data->MoveNext();	   

	  }

  }

  ?>

</table>


</div>

