<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['datadarwin2679_sessid_inicio'])
{

$fecha_cambio=$_POST["fecha_cambio"];
$ttext_motivo=$_POST["ttext_motivo"];
$id_valor=$_POST["id_valor"];


$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

$busca_cliente="select * from dns_ginecologiaanamesis where anam_id='".$id_valor."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());

$usua_id_vl=$rs_bcliente->fields["usua_id"];
$centro_id_vl=$rs_bcliente->fields["centro_id"];

$fecha_anterior='';
$fecha_anterior=$rs_bcliente->fields["anam_fecharegistro"];

$anam_enlace='';
$anam_enlace=$rs_bcliente->fields["anam_enlace"];


///actualiza_datos
$nueva_fecha='';
$nueva_fecha=$fecha_cambio." ".date("H:i:s");

if($id_valor)
{

$actualiza_paciente="update dns_ginecologiaanamesis set anam_fecharegistro='".$nueva_fecha."' where anam_id='".$id_valor."'";
$rs_acpaciente = $DB_gogess->executec($actualiza_paciente,array());


if(@$rs_acpaciente)
{
   //REVISION ACTUAL DE ORGANOS Y SISTEMAS (RAS)
    $busca_fechareg=explode(" ",$fecha_anterior);
    $busca_organos="update pichinchahumana_extension.dns_ginecologiagridorgano set gorgano_fecharegistro='".$nueva_fecha."' where anam_enlace='".$anam_enlace."' and gorgano_fecharegistro like '".$busca_fechareg[0]."%'";
    $rs_organos = $DB_gogess->executec($busca_organos,array());
   //REVISION ACTUAL DE ORGANOS Y SISTEMAS (RAS)
   
   //pichinchahumana_extension.dns_ginecologiagridexamenfisico   
    $busca_organos="update pichinchahumana_extension.dns_ginecologiagridexamenfisico set gexamfis_fecharegistro='".$nueva_fecha."' where anam_enlace='".$anam_enlace."' and gexamfis_fecharegistro like '".$busca_fechareg[0]."%'";
    $rs_organos = $DB_gogess->executec($busca_organos,array());   
   //pichinchahumana_extension.dns_ginecologiagridexamenfisico
   
   //dns_ginecologiacuadrobasico   
   $busca_organos="update dns_ginecologiacuadrobasico set cuabas_fecharegistro='".$nueva_fecha."' where anam_enlace='".$anam_enlace."' and cuabas_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_organos = $DB_gogess->executec($busca_organos,array());   
   //dns_ginecologiacuadrobasico
   
   //dns_ginecologiadiagnosticoanamnesis
   $busca_organos="update dns_ginecologiadiagnosticoanamnesis set diagn_fecharegistro='".$nueva_fecha."' where anam_enlace='".$anam_enlace."' and diagn_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_organos = $DB_gogess->executec($busca_organos,array());    
   //dns_ginecologiadiagnosticoanamnesis
   
   //dns_ginecologiareceta 
    
   $lista_rescetdia="select * from dns_ginecologiareceta where plantra_despachado='' and anam_enlace='".$anam_enlace."' and plantra_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_listarecetas = $DB_gogess->executec($lista_rescetdia,array());
   if($rs_listarecetas)
		{
			while (!$rs_listarecetas->EOF) {
    
   $busca_organos1="update dns_ginecologiareceta set plantra_fecharegistro='".$nueva_fecha."' where plantra_id='".$rs_listarecetas->fields["plantra_id"]."'";
   $rs_organos1 = $DB_gogess->executec($busca_organos1,array()); 
   
    $permid_idtabla=$rs_listarecetas->fields["plantra_id"];
	$permid_tabla="dns_ginecologiareceta";
	$permid_acepta=1;
	$permid_motivo="INGRESO_ANTERIOR_SOPORTE_SISTEMA";
	$permid_fecharegistro=date("Y-m-d H:i:s");
	$usua_id=$usua_id_vl;
	$centro_id=$centro_id_vl;
	
  //borra permisos anteriores
   $dele_permi="delete from pichinchahumana_extension.dns_permisosdespacho where permid_idtabla='".$permid_idtabla."' and permid_tabla='".$permid_tabla."'";
   $rs_delpermi= $DB_gogess->executec($dele_permi,array());
   //borra permisos anteriores	
   
   //crea permiso
   $insert_data="insert into pichinchahumana_extension.dns_permisosdespacho (permid_idtabla,permid_tabla,permid_acepta,permid_motivo,permid_fecharegistro,usua_id,centro_id) values ('".$permid_idtabla."','".$permid_tabla."','".$permid_acepta."','".$permid_motivo."','".$permid_fecharegistro."','".$usua_id."','".$centro_id."')";
   $rs_ddata= $DB_gogess->executec($insert_data,array());
   //crea permiso
   
   
               $rs_listarecetas->MoveNext();			   
			   }
		}	   
   //dns_ginecologiareceta
   
   //dns_ginecologiadispositivos
   
   $lista_rescetdia="select * from dns_ginecologiadispositivos where plantrai_despachado='' and anam_enlace='".$anam_enlace."' and plantrai_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_listarecetas = $DB_gogess->executec($lista_rescetdia,array());
   if($rs_listarecetas)
		{
			while (!$rs_listarecetas->EOF) {
    
   $busca_organos1="update dns_ginecologiadispositivos set plantrai_fecharegistro='".$nueva_fecha."' where plantrai_id='".$rs_listarecetas->fields["plantrai_id"]."'";
   $rs_organos1 = $DB_gogess->executec($busca_organos1,array()); 
   
    $permid_idtabla=$rs_listarecetas->fields["plantrai_id"];
	$permid_tabla="dns_ginecologiadispositivos";
	$permid_acepta=1;
	$permid_motivo="INGRESO_ANTERIOR_SOPORTE_SISTEMA";
	$permid_fecharegistro=date("Y-m-d H:i:s");
	$usua_id=$usua_id_vl;
	$centro_id=$centro_id_vl;
	
  //borra permisos anteriores
   $dele_permi="delete from pichinchahumana_extension.dns_permisosdespacho where permid_idtabla='".$permid_idtabla."' and permid_tabla='".$permid_tabla."'";
   $rs_delpermi= $DB_gogess->executec($dele_permi,array());
   //borra permisos anteriores	
   
   //crea permiso
   $insert_data="insert into pichinchahumana_extension.dns_permisosdespacho (permid_idtabla,permid_tabla,permid_acepta,permid_motivo,permid_fecharegistro,usua_id,centro_id) values ('".$permid_idtabla."','".$permid_tabla."','".$permid_acepta."','".$permid_motivo."','".$permid_fecharegistro."','".$usua_id."','".$centro_id."')";
   $rs_ddata= $DB_gogess->executec($insert_data,array());
   //crea permiso
   
   
               $rs_listarecetas->MoveNext();			   
			   }
		}
   
   
   
   //dns_ginecologiadispositivos
   

   $inserta_rastro="insert into pichinchahumana_extension.dns_cambiofecharegistro (cbfech_tabla,cbfech_idvalor,cbfech_fecharegistroanterior,cbfech_fecharegistronueva,cbfech_motivo,cbfech_fechacambio,usua_id) values ('dns_ginecologiaanamesis','".$id_valor."','".$fecha_anterior."','".$nueva_fecha."','".$ttext_motivo."','".date("Y-m-d H:i:s")."','".$_SESSION['datadarwin2679_sessid_inicio']."')";
   
  $rs_rastro = $DB_gogess->executec($inserta_rastro,array());
?>   
<script type="text/javascript">
<!--
$('#anam_fecharegistro').val('<?php echo $nueva_fecha; ?>');
$('#despliegue_anam_fecharegistro').html('<?php echo $nueva_fecha; ?>');

grid_extras_4810('<?php echo $anam_enlace; ?>',0,0);
grid_extras_4821('<?php echo $anam_enlace; ?>',0,0);
grid_extras_4824('<?php echo $anam_enlace; ?>',0,0);
grid_extras_4822('<?php echo $anam_enlace; ?>',0,0);
grid_extras_5242('<?php echo $anam_enlace; ?>',0,0);
grid_extras_5541('<?php echo $anam_enlace; ?>',0,0);

//  End -->
</script> 
<?php  
   echo "<center>Fecha de registro fue actualizado...</center>"; 
}
else
{
  echo "<center>Alerta!! registro no fue actualizdo comun&iacute;quese con el administrador del sistema...</center>";

}

}
///actualiza_datos


}
?>