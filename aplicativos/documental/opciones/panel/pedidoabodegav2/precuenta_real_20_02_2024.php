<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$ci_paciente=$_POST["ci_paciente"];
$partop_id=$_POST["partop_id"];
$centro_id=$_POST["centro_id"];


$busca_asigancion="select * from dns_precuenta where partopx_id='".$partop_id."'";
$rs_pasignacion = $DB_gogess->executec($busca_asigancion);

if($rs_pasignacion->fields["precu_id"]>0)
{

echo "ASIGNADO A PRECUENTA NUMERO: ".$rs_pasignacion->fields["precu_id"]."<br>";

$busca_datax="select * from app_cliente where clie_id='".$rs_pasignacion->fields["clie_id"]."'";
$rs_udatax = $DB_gogess->executec($busca_datax,array());

echo "PACIENTE: ".$rs_udatax->fields["clie_nombre"]." ".$rs_udatax->fields["clie_apellido"];


}
else
{


$lista_usv="select * from app_usuario where usua_id='".$_SESSION['datadarwin2679_sessid_inicio']."'";
$rs_usv= $DB_gogess->executec($lista_usv,array());
$centrousuario_id=$rs_usv->fields['centro_id'];
$usua_enlace=$rs_usv->fields["usua_enlace"];
$usua_permitirreposicion=$rs_usv->fields["usua_permitirreposicion"];
$usua_permitirotrbredp=$rs_usv->fields["usua_permitirotrbredp"];
$precu_id=0;
?>
<br>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E9F1F5"><div align="center">CI</div></td>
	<td bgcolor="#E9F1F5"><div align="center">PACIENTE</div></td>
	<td bgcolor="#E9F1F5"><div align="center">CONVENIO</div></td>
    <td bgcolor="#E9F1F5"><div align="center">OBSERVACION</div></td>
    <td bgcolor="#E9F1F5"><div align="center">FECHA INICIO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">FECHA FIN</div></td>
  </tr>
<?php
$lista_bprecuenta="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where clie_rucci='".$ci_paciente."' and precu_activo=1 order by precu_id desc limit 1";
$rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());

if($rs_bprecuenta)
 {
	while (!$rs_bprecuenta->EOF) { 
	
	
	$clie_id=$rs_bprecuenta->fields["clie_id"];
	$precu_id=$rs_bprecuenta->fields["precu_id"];
	$atenc_enlace=$rs_bprecuenta->fields["atenc_enlace"];
	
	$lista_aten="select * from dns_atencion where atenc_enlace='".$atenc_enlace."'";
	$rs_aten = $DB_gogess->executec($lista_aten,array());
	
	$atenc_id=$rs_aten->fields["atenc_id"];
	
	$convepr_id=$rs_bprecuenta->fields["convepr_id"];
	$lista_convenio="select * from pichinchahumana_extension.dns_convenios where conve_id='".$convepr_id."'";
	$rs_conve= $DB_gogess->executec($lista_convenio,array());
	$rs_conve->fields["conve_redpublica"];
	
	$code_redp=0;
	$code_redp=$rs_conve->fields["conve_redpublica"];
	
	$red_publica='NO';
	if($rs_conve->fields["conve_redpublica"]==1)
	{
	  $red_publica='SI';
	}
	?>

  <tr>
    <td><?php echo $rs_bprecuenta->fields["clie_rucci"]; ?></td>
	<td><?php echo $rs_bprecuenta->fields["clie_nombre"].' '.$rs_bprecuenta->fields["clie_apellido"]; ?></td>
	<td><?php echo $rs_conve->fields["conve_nombre"].' RED PUBLICA: <b>'.$red_publica.'</b>'; ?></td>
    <td><?php echo $rs_bprecuenta->fields["precu_observacion"]; ?></td>
    <td><?php echo $rs_bprecuenta->fields["precu_fechainicio"]; ?></td>
	 <td><?php echo $rs_bprecuenta->fields["precu_fechafinal"]; ?></td>
  </tr>

	 
	 <?php	
	
	   $rs_bprecuenta->MoveNext();	
	}	
} 
//$usua_permitirotrbredp=1;	
?>
</table>
<br><br>

<?php

$red_publica_op='NO';
if($centro_id==29)
{
$red_publica_op='SI';

}

$bloqueo=0;
if($red_publica_op!==$red_publica)
{

echo "<div style='color:#FF0000'>ALERTA!!!! La precuenta y el parte operatorio no son iguales en el tipo de seguro....</div>";
$bloqueo=1;

}
?>

<div id="ejecuta_datax">
<?php
if($bloqueo==0)
{

if($red_publica=='NO')
{
?>
<input type="button" name="Submit" value="PROCESAR DASCARGO" onclick="procesa_data_pboega('<?php echo $centro_id; ?>','<?php echo $partop_id; ?>','<?php echo $precu_id; ?>','<?php echo $clie_id; ?>')" />
<?php
}


}
?>
</div>

<?php
}
?>

