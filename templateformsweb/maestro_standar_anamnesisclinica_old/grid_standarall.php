<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
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
$objformulario= new  ValidacionesFormulario();
$datos_fields="select * from gogess_sisfield where fie_id=".$_POST["fie_id"];
$rs_fields = $DB_gogess->executec($datos_fields,array());

//tabla_grid
$sub_tabla=$rs_fields->fields["fie_tablasubgrid"];
//id tabla grid
$campo_id=$rs_fields->fields["fie_tablasubcampoid"];
//campos tabla grid
$campos_dataedit=array();
$campos_dataedit=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);

$campos_datainserta=array();
$campos_datainserta=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);
//tabla combo
$tabla_combo=$rs_fields->fields["fie_tblcombogrid"];
$idtabla_combo=$rs_fields->fields["fie_campoidcombogrid"];
//subtablas
//campo enlace
$campo_enlace='';
$campo_enlace=$rs_fields->fields["fie_campoenlacesub"];
//fecha registro grid
$campo_fecharegistro='';
$campo_fecharegistro=$rs_fields->fields["fie_campofecharegistro"];

//titulos
$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$rs_fields->fields["fie_tituloscamposgrid"]);

//lista
$fie_camposgridselect=array();
$fie_camposgridselect=explode(",",$rs_fields->fields["fie_camposgridselect"]);


if($_POST["opcion"]==2)
{
 $borra_reg="delete from ".$sub_tabla." where ".$campo_enlace."='".$_POST["enlace"]."' and ".$campo_id."=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());
}


if($_POST["opcion"]==1)
{


		if($_POST[$campo_id."x"]>0)
			{
			 $sql_edita='';
			 $sql_edita=$objvarios->genera_update($sub_tabla,$campo_id,$_POST[$campo_id."x"],$_POST,$campos_datainserta);
			 $rs_edita = $DB_gogess->executec($sql_edita,array());
			
			}
			else
			{
			 $rs_inserta ='';
			  $sql_inserta=$objvarios->genera_insert($sub_tabla,$campo_enlace,$campo_fecharegistro,$_POST["enlace"],$_POST["sess_id"],date("Y-m-d H:i:s"),$_POST,$campos_datainserta);
			 $rs_inserta = $DB_gogess->executec($sql_inserta,array());
			
			}



}
?>

<div class="table-responsive">
<table class="table table-bordered"  style="width:100%" >
  <tr>

   <?php
	for($i=0;$i<count($fie_tituloscamposgrid);$i++)
	 {
      echo '<td bgcolor="#DFE9EE" >'.utf8_encode($fie_tituloscamposgrid[$i]).'</td>';
	 }
	?>
  </tr>
<?php
$cuenta=0;
if($tabla_combo)
{
$lista_servicios="select * from ".$sub_tabla." inner join  ".$tabla_combo." on ".$sub_tabla.".".$idtabla_combo."=".$tabla_combo.".".$idtabla_combo." where ".$campo_enlace."='".$_POST['enlace']."'";
}
else
{
$lista_servicios="select * from ".$sub_tabla." where ".$campo_enlace."='".$_POST['enlace']."'";

}
//echo $lista_servicios;
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
  ?>
  <tr>
 
	<?php
	for($i=0;$i<count($fie_camposgridselect);$i++)
	 {
		 
		$lista_camposz="select gridfield_nameid,gridfield_editarengrid,gridfield_tipo,gridfield_campoafectacheck,gridfield_valordefault,gridfield_orderecibe,gridfield_bloqueado,gridfield_tablecmb,gridfield_camposcmb,gridfield_ordercmb,gridfield_extra from gogess_gridfield where fie_id=".$_POST["fie_id"]."  and gridfield_nameid='".$fie_camposgridselect[$i]."x"."' and gridfield_editarengrid=1";
        $rs_lcanpz = $DB_gogess->executec($lista_camposz,array());
		
		
		
		if(trim($rs_lcanpz->fields["gridfield_editarengrid"])==1)
		{
		
		if($rs_lcanpz->fields["gridfield_tipo"]=='textarea')
	     {
		 $link_guarda="guarda_fila_cmb".$_POST["fie_id"]."('".$campo_id."','".$rs_data->fields[$campo_id]."','".$sub_tabla."','".$fie_camposgridselect[$i]."',$('#".$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i."').val());";	 
		 
			 if($rs_data->fields[$rs_lcanpz->fields["gridfield_bloqueado"]]==0) 
			 {
			 echo '<td><textarea onblur="'.$link_guarda.'" class="form-control" name="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" cols="30" rows="2" id="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" disabled >'.$rs_data->fields[$fie_camposgridselect[$i]].'</textarea></td>';
			 }
			 else
			 {
			  echo '<td><textarea onblur="'.$link_guarda.'" class="form-control" name="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" cols="30" rows="2" id="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'">'.$rs_data->fields[$fie_camposgridselect[$i]].'</textarea></td>';
			 
			 }
		 
		 
		 }
		 
		 if($rs_lcanpz->fields["gridfield_tipo"]=='check')
	     {
		 
		 $link_guarda="guarda_check_cmb".$_POST["fie_id"]."('".$campo_id."','".$rs_data->fields[$campo_id]."','".$sub_tabla."','".$fie_camposgridselect[$i]."',$('#".$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i."').val(),'".$i."','".$rs_lcanpz->fields["gridfield_campoafectacheck"]."','".$rs_lcanpz->fields["gridfield_valordefault"]."','".$rs_lcanpz->fields["gridfield_orderecibe"]."');";	 
		 
		 if($rs_data->fields[$fie_camposgridselect[$i]]==1)
		 {
		 echo '<td> <input onclick="'.$link_guarda.'" type="checkbox" id="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" name="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" value="'.$rs_data->fields[$fie_camposgridselect[$i]].'" checked="checked" /> </td>';
		 }
		 else
		 {
		 echo '<td> <input onclick="'.$link_guarda.'" type="checkbox" id="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" name="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" value="'.$rs_data->fields[$fie_camposgridselect[$i]].'"  /> </td>';
		 }
		 
		 }
		 
		 
		 
		 if($rs_lcanpz->fields["gridfield_tipo"]=='select')
	     {
		     $link_guarda="guarda_fila_cmb".$_POST["fie_id"]."('".$campo_id."','".$rs_data->fields[$campo_id]."','".$sub_tabla."','".$fie_camposgridselect[$i]."',$('#".$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i."').val());";	 
			 
			 
		  
			 
		 
			 if($rs_data->fields[$rs_lcanpz->fields["gridfield_bloqueado"]]==0) 
			 {
			   
			   echo '<td>';		   
			   echo '<select class="form-control" name="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" id="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'"  '.$rs_lcanpz->fields["gridfield_extra"].' onclick="'.$link_guarda.'" >';
		       echo '<option value="" >--Seleccionar--</option>';		   
		       $objformulario->fill_cmb($rs_lcanpz->fields["gridfield_tablecmb"],$rs_lcanpz->fields["gridfield_camposcmb"],$rs_data->fields[$fie_camposgridselect[$i]],' '.$rs_lcanpz->fields["gridfield_ordercmb"],$DB_gogess);
		       echo '</select>';
			   echo '</td>';
			   
			   
			 }
			 else
			 {
			   echo '<td>';		   
			   echo '<select class="form-control" name="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'" id="'.$fie_camposgridselect[$i].$rs_data->fields[$campo_id].$i.'"  '.$rs_lcanpz->fields["gridfield_extra"].' onclick="'.$link_guarda.'" >';
		       echo '<option value="" >--Seleccionar--</option>';		   
		       $objformulario->fill_cmb($rs_lcanpz->fields["gridfield_tablecmb"],$rs_lcanpz->fields["gridfield_camposcmb"],$rs_data->fields[$fie_camposgridselect[$i]],' '.$rs_lcanpz->fields["gridfield_ordercmb"],$DB_gogess);
		       echo '</select>';
			   echo '</td>';
			 
			 }
		 
		 
		 }
		 
		 
		 
		 
		 
		}
		else
		{
		 echo '<td>'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
		 }
	 }
	?>
	
  </tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
</table>
</div>
<?php
if(!(@$_SESSION['datadarwin2679_sessid_inicio']))
{

echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession'.$_POST["fie_id"].'","divDialog_acsession'.$_POST["fie_id"].'",400,400,"",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession'.$_POST["fie_id"].'"></div>
';

}
?>