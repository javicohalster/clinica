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
$campos_datainsertaeditar=array();
$campos_datainserta=explode(",",$rs_fields->fields["fie_tablasubgridcampos"].",centro_id");
$campos_datainsertaeditar=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);

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
			 //editar
			 
			 $sql_edita='';
			 $sql_edita=$objvarios->genera_update($sub_tabla,$campo_id,$_POST[$campo_id."x"],$_POST,$campos_datainsertaeditar);
			 $rs_edita = $DB_gogess->executec($sql_edita,array());
			
			}
			else
			{
				
		     //insertar turno
               $busca_siguiente="select gridtur_turno from dns_gridturnos inner join dns_atencion on dns_gridturnos.atenc_enlace=dns_atencion.atenc_enlace where especi_id=".$_POST["especi_idx"]." and gridtur_fecha='".date("Y-m-d")."' and dns_atencion.centro_id='".$_SESSION['datadarwin2679_centro_id']."' order by gridtur_turno desc limit 1"; 
			   
			   $busca_siguiente="select gridtur_turno from dns_gridturnos where especi_id=".$_POST["especi_idx"]." and gridtur_fecha='".date("Y-m-d")."' and centro_id='".$_SESSION['datadarwin2679_centro_id']."' order by gridtur_turno desc limit 1"; 
			   
			   
			   $rs_bturno = $DB_gogess->executec($busca_siguiente,array());
			   $numturno=0;
			   if($rs_bturno->fields["gridtur_turno"])
			   {
				  $numturno=$rs_bturno->fields["gridtur_turno"]+1;
			   }
			   else
			   {
				   $numturno=1;
			   }
			   
			 $_POST["gridtur_turnox"]=$numturno;
             @$_POST["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
              //insertar turno		
			  
			 $rs_inserta ='';
			 $sql_inserta=$objvarios->genera_insert($sub_tabla,$campo_enlace,$campo_fecharegistro,$_POST["enlace"],$_POST["sess_id"],date("Y-m-d H:i:s"),$_POST,$campos_datainserta);
			 $rs_inserta = $DB_gogess->executec($sql_inserta,array());
			
			}



}
?>

<div class="table-responsive">
<table class="table table-bordered"  style="width:100%" >
  <tr>
    <td bgcolor="#DFE9EE"  >Eliminar</td>
	<td bgcolor="#DFE9EE"  >Editar</td>
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
$lista_servicios="select * from ".$sub_tabla." where ".$campo_enlace."='".$_POST['enlace']."' order by gridtur_fecha,especi_id,gridtur_turno desc";

}
//echo $lista_servicios;
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
  ?>
  <tr>
    <td  onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields[$campo_enlace]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
    <td onClick="grid_editar_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields[trim($campo_enlace)]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-pencil"></span></td>
	<?php
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
						echo '<td>'.$valordt.'</td>';
					}
					break;
				case 'check':
					{
					 if($rs_data->fields[$fie_camposgridselect[$i]]==1)
						 {
							 echo '<td><img src="images/check.png" width="24" height="22" /></td>';
							}
							else
							{
							 echo '<td></td>';
							}	

							 
					}
					break;

				default:
				   {
					 echo '<td>'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
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