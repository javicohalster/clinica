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

$datos_butabla="select * from gogess_sistable where tab_name='".$rs_fields->fields["tab_name"]."'";
$rs_fieldbutabla = $DB_gogess->executec($datos_butabla,array());
$campo_prreceta='';
$campo_prreceta=$rs_fieldbutabla->fields["tab_campoprimario"];

//tabla_grid
$sub_tabla=$rs_fields->fields["fie_tablasubgrid"];
//id tabla grid
$campo_id=$rs_fields->fields["fie_tablasubcampoid"];
//campos tabla grid
$campos_dataedit=array();
$campos_dataedit=explode(",",$rs_fields->fields["fie_tablasubgridcampos"].",plantra_preciocompra,plantra_porcentajerestapreciotecho,plantra_porcentajeadm,plantra_porcentajeiva,plantra_valorplanilla");

$campos_datainserta=array();
$campos_datainserta=explode(",",$rs_fields->fields["fie_tablasubgridcampos"].",plantra_preciocompra,plantra_porcentajerestapreciotecho,plantra_porcentajeadm,plantra_porcentajeiva,plantra_valorplanilla");
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

//-------------------------------------------------------
//busca parametros para planillar
$busca_datostarifario="select * from app_empresa where emp_id=1";
$rs_dttarifario = $DB_gogess->executec($busca_datostarifario,array());

//-------------------------------------------------------


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

$busca_preciosx="select cuadrobm_preciomedicamento from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".trim($_POST["plantra_codigox"])."'";
$rs_bpreciox = $DB_gogess->executec($busca_preciosx,array());
//plantra_preciocompra
//plantra_porcentajerestapreciotecho
//plantra_porcentajeadm
//plantra_porcentajeiva
//plantra_valorplanilla

$_POST["plantra_preciocomprax"]=$rs_bpreciox->fields["cuadrobm_preciomedicamento"];
$_POST["plantra_porcentajerestapreciotechox"]=$rs_dttarifario->fields["emp_restaporcentaje"];
$_POST["plantra_porcentajeadmx"]=$rs_dttarifario->fields["emp_valorgastosadm"];
$_POST["plantra_porcentajeivax"]=0;

$calcula_por=($rs_bpreciox->fields["cuadrobm_preciomedicamento"]*$rs_dttarifario->fields["emp_valorgastosadm"])/100;
$calcula_iva=($rs_bpreciox->fields["cuadrobm_preciomedicamento"]*$_POST["plantra_porcentajeivax"])/100;
$plantra_valorplanillax=$rs_bpreciox->fields["cuadrobm_preciomedicamento"]+$calcula_por+$calcula_iva;
$_POST["plantra_valorplanillax"]=$plantra_valorplanillax;

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
<div align="right">
  <table width="550" border="0">
  <tr>
    <td width="221">Alerta: Seleccione la fecha que se realiz&oacute; la receta para poder generar el documento</td>
    <td width="221"><input name="fecha_imp" type="text" class="form-control" id="fecha_imp" value="<?php echo date("Y-m-d"); ?>" ></td>
    <td width="20">&nbsp;</td>
    <td width="145"><button type="button" class="mb-sm btn btn-primary" onClick="imprimir_recet()" style="background-color:#000066" >IMPRIMIR RECETA</button></td>
  </tr>
</table>
</div>
<table class="table table-bordered"  style="width:100%" >
  <tr>
    <td bgcolor="#DFE9EE" style="font-size:11px;padding:2px;" >Eliminar</td>
	<td bgcolor="#DFE9EE"  style="font-size:11px;padding:2px;" >Editar</td>
   <?php
	for($i=0;$i<count($fie_tituloscamposgrid);$i++)
	 {
      echo '<td bgcolor="#DFE9EE"  style="font-size:11px;padding:2px;" >'.$fie_tituloscamposgrid[$i].'</td>';
	 }
	?>
  </tr>
<?php
$cuenta=0;
if($tabla_combo)
{
$lista_servicios="select *,DATE_ADD(".$campo_fecharegistro.",INTERVAL 3 DAY) as fechacierre from ".$sub_tabla." inner join  ".$tabla_combo." on ".$sub_tabla.".".$idtabla_combo."=".$tabla_combo.".".$idtabla_combo." where ".$campo_enlace."='".$_POST['enlace']."'";
}
else
{
$lista_servicios="select *,DATE_ADD(".$campo_fecharegistro.",INTERVAL 3 DAY) as fechacierre from ".$sub_tabla." where ".$campo_enlace."='".$_POST['enlace']."' order by ".$campo_fecharegistro." desc";

}
//echo $lista_servicios;
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
		
		$bloque_registro=0;
		if(@$rs_data->fields[$campo_fecharegistro])
			{
			  //echo $rs_sihaydata->fields["fechacierre"];
			   if(date("Y-m-d")>$rs_data->fields["fechacierre"])
			   {			   
			     $bloque_registro=1;
			   }
			   
			}
			
	if($bloque_registro==1)
		{
	?>
	<tr><td style="font-size:11px;padding:2px;" >&nbsp;</td>
    <td style="font-size:11px;padding:2px;" >&nbsp;</td>
	<?php	
		}
		else
		{			
  ?>
  <tr><td onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields[$campo_enlace]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer;font-size:11px;padding:2px;" ><span class="glyphicon glyphicon-ban-circle"></span></td>
    <td onClick="grid_editar_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields[trim($campo_enlace)]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer;font-size:11px;padding:2px;" ><span class="glyphicon glyphicon-pencil"></span></td>
	<?php
	}
	for($i=0;$i<count($fie_camposgridselect);$i++)
	 {
		 $lista_camposxc="select * from gogess_gridfield where fie_id=".$_POST["fie_id"]." and gridfield_nameid='".trim($fie_camposgridselect[$i])."x"."'";
		 $rs_dataxc = $DB_gogess->executec($lista_camposxc,array());
		 $valordt='';
		 
		 switch (trim($rs_dataxc->fields["gridfield_tipo"])) {
				case 'select':
					{
						
						$listac=array();
						$listac=explode(",",$rs_dataxc->fields["gridfield_camposcmb"]);
						$valordt=$objformulario->replace_cmb($rs_dataxc->fields["gridfield_tablecmb"],$rs_dataxc->fields["gridfield_camposcmb"],"where ".$listac[0].'=',$rs_data->fields[$fie_camposgridselect[$i]],$DB_gogess);
						echo '<td style="font-size:11px;padding:2px;" >'.$valordt.'</td>';
					}
					break;
				case 'check':
					{
					 if($rs_data->fields[$fie_camposgridselect[$i]]==1)
						 {
							 echo '<td style="font-size:11px;padding:2px;" ><img src="images/check.png" width="24" height="22" /></td>';
							}
							else
							{
							 echo '<td style="font-size:11px;padding:2px;" ></td>';
							}	

							 
					}
					break;

				default:
				   {
					 echo '<td style="font-size:11px;padding:2px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
					}
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

<script type="text/javascript">
<!--
$( "#fecha_imp" ).datepicker({dateFormat: 'yy-mm-dd'});

function imprimir_recet()
{
   if($('#<?php echo $campo_prreceta; ?>').val()>0)
   {	 
   window.open('recetas/receta_standar.php?fecha='+$("#fecha_imp").val()+'&idcl='+$("#clie_id").val()+'&fieid=<?php echo $_POST["fie_id"]; ?>&enlace=<?php echo $_POST['enlace']; ?>', '_blank');  
    }
   else
   {
     alert("Por favor guarde el formulario completo para poder imprimir la receta (DE CLIC EN GUARDAR Y PLANILLAR)");
   
   }
}

//  End -->
</script>