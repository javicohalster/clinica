<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<div id="dvData">
<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.verticalText {
writing-mode: vertical-lr;
    transform: rotate(90deg);
	font-size:9px;
	margin-right: 30%;
	margin-left: 30%;
}
.style1 {font-size: 11px}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<?php
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();
$obtien_anio=array();
$obtien_anio=explode("-",$_POST["fecha_inicio"]);
$lista_estu=array();

$mesnombre["01"]="ENERO";
$mesnombre["02"]="FEBRERO";
$mesnombre["03"]="MARZO";
$mesnombre["04"]="ABRIL";
$mesnombre["05"]="MAYO";
$mesnombre["06"]="JUNIO";
$mesnombre["07"]="JULIO";
$mesnombre["08"]="AGOSTO";
$mesnombre["09"]="SEPTIEMBRE";
$mesnombre["10"]="OCTUBRE";
$mesnombre["11"]="NOVIEMBRE";
$mesnombre["12"]="DICIEMBRE";

$centro_id=$_POST["centro_id"];
$datos_centro="select * from dns_centrosalud inner join app_provincia on dns_centrosalud.prob_codigo=app_provincia.prob_codigo where centro_id=".$centro_id;
$rs_centro = $DB_gogess->executec($datos_centro,array());

$zona='';
$zona=$rs_centro->fields["zona_id"];
$subzona='';
$subzona=$rs_centro->fields["prob_nombre"];
$nombrecentro=$rs_centro->fields["centro_nombre"];

$nivel_establ=0;
$nivel_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,permif_id"," where centro_id=",$centro_id,$DB_gogess); 

$lista_listaseguro="select tipopac_id,tipopac_nombre from faesa_tipopaciente";
$rs_listaseguro = $DB_gogess->executec($lista_listaseguro,array());
if($rs_listaseguro)
	{
		while (!$rs_listaseguro->EOF) {
		$codigo_seguro=$rs_listaseguro->fields["tipopac_id"];
//------------------------------------------------------------------
?>
<br /><br />
<center><b><?php echo $rs_listaseguro->fields["tipopac_nombre"]; ?></b></center><br /><br />
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td class="css_listat">SUBCENTRO</td>
    <td class="css_listat">LUGAR</td>
    <td class="css_listat">TIPO DE REVISION PLANILLA</td>
    <td class="css_listat">NUMERO PLANILLA CONSOLIDADA</td>
    <td class="css_listat">MES</td>
    <td class="css_listat">FECHA CIERRE</td>
    <td class="css_listat">ASEGURADORA</td>
    <td class="css_listat">OFICIO DE PRESENTACION A ASEGURADORA</td>
    <td class="css_listat">FECHA PRESENTACION</td>
    <td class="css_listat">VALOR PRESENTADO</td>
    <td class="css_listat">NUMERO RECEPCION </td>
    <td class="css_listat">SEGUIMIENTO</td>
  </tr>
<?php
$lista_centros="select * from dns_centrosalud left join app_provincia on dns_centrosalud.prob_codigo=app_provincia.prob_codigo where centro_activo=1 and centro_id not in (55) order by centro_nombre asc";
$rs_centros = $DB_gogess->executec($lista_centros,array());
 if($rs_centros)
 {
     	while (!$rs_centros->EOF) {
		
		//busca si existe seguimieto
		$tipo_planilla='';
		$noplanilla='';
		$nombremes='';
		$anio='';
		$fecha_cierre='';
		$tipopac_id='';
		$noficio='';
		$segumiem_fecha='';
		$segumiem_valor='';
		$segumiem_nrecepcion='';
		$recau_enlace='';
		$busca_seg="select * from dns_recaudacion left join pichinchahumana_extension.dns_seguimientocobro on dns_recaudacion.recau_enlace=pichinchahumana_extension.dns_seguimientocobro.recau_enlace left join pichinchahumana_extension.dns_tiposeguimiento on pichinchahumana_extension.dns_seguimientocobro.tiposeg_id=pichinchahumana_extension.dns_tiposeguimiento.tiposeg_id where centro_id='".$rs_centros->fields["centro_id"]."' and recau_mes='".$mesnombre[$_POST["mes_valor"]]."' and recau_anio='".$_POST["anio_valor"]."' and dns_recaudacion.tipopac_id='".$codigo_seguro."' order by recau_id asc";
		$rs_seg = $DB_gogess->executec($busca_seg,array());
		if($rs_seg)
        {
             while (!$rs_seg->EOF) {
			 
			   $tipo_planilla=$rs_seg->fields["tiposeg_nombre"];
			   $noplanilla=$rs_seg->fields["recau_nplanilla"];
			   $nombremes=$rs_seg->fields["recau_mes"];
			   $anio=$rs_seg->fields["recau_anio"];
			   $tipopac_id=$rs_seg->fields["tipopac_id"];
			   $noficio=$rs_seg->fields["recau_noficio"];			   
			   $segumiem_fecha=$rs_seg->fields["segumiem_fecha"];
			   $segumiem_valor=$rs_seg->fields["segumiem_valor"];
			   $segumiem_nrecepcion=$rs_seg->fields["segumiem_nrecepcion"];
			   
			   $recau_enlace=$rs_seg->fields["recau_enlace"];
			   
			   $rs_seg->MoveNext();
			 }
         }		
		 
		 $fecha = new DateTime($_POST["anio_valor"].'-'.$_POST["mes_valor"].'-01');
         $fecha->modify('last day of this month');
         $fecha_cierre=$fecha->format('Y-m-d');
		//busca si existe seguimieto
		
		//busca aseguradora
		
		$buaseguradora="select tipopac_nombre from faesa_tipopaciente where tipopac_id='".$tipopac_id."'";
		$rs_nasegura = $DB_gogess->executec($buaseguradora,array());
		//busca aseguradora
			
?>  
  <tr>
    <td class="css_lista"><?php echo utf8_encode($rs_centros->fields["centro_nombre"]); ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_centros->fields["prob_nombre"]); ?></td>
    <td class="css_lista"><?php echo $tipo_planilla; ?></td>
    <td class="css_lista"><?php echo $noplanilla; ?></td>
    <td class="css_lista"><?php echo $nombremes; ?></td>
    <td nowrap="nowrap" class="css_lista" ><?php echo $fecha_cierre; ?></td>
    <td class="css_lista"><?php echo $rs_nasegura->fields["tipopac_nombre"]; ?></td>
    <td class="css_lista"><?php echo $noficio; ?></td>
    <td class="css_lista"><?php echo $segumiem_fecha; ?></td>
    <td class="css_lista"><?php echo $segumiem_valor; ?></td>
    <td class="css_lista"><?php echo $segumiem_nrecepcion; ?></td>
    <td class="css_lista">
	<?php
	if($recau_enlace)
	{
	$lista_seguimiento="select * from pichinchahumana_extension.dns_seguimientocobro inner join pichinchahumana_extension.dns_tiposeguimiento tseg on pichinchahumana_extension.dns_seguimientocobro.tiposeg_id=tseg.tiposeg_id inner join app_usuario on pichinchahumana_extension.dns_seguimientocobro.usua_id=app_usuario.usua_id where recau_enlace='".$recau_enlace."'";
	$rs_lsegimiento = $DB_gogess->executec($lista_seguimiento,array());
	
	?>	
	<table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td class="css_listat">Estado</td>
        <td class="css_listat">Observacion</td>
        <td class="css_listat">Fecha</td>
        <td class="css_listat">Valor</td>
        <td class="css_listat">No. Oficio </td>
        <td class="css_listat">No. Rececion </td>
        <td class="css_listat">Usuario Registra </td>
        <td class="css_listat">Fecha Registro </td>
      </tr>
	 <?php
	 if($rs_lsegimiento)
        {
             while (!$rs_lsegimiento->EOF) {
	 ?> 
      <tr>
        <td class="css_lista"><?php echo $rs_lsegimiento->fields["tiposeg_nombre"]; ?></td>
        <td class="css_lista"><?php echo $rs_lsegimiento->fields["segumiem_observacion"]; ?></td>
        <td class="css_lista"><?php echo $rs_lsegimiento->fields["segumiem_fecha"]; ?></td>
        <td class="css_lista"><?php echo $rs_lsegimiento->fields["segumiem_valor"]; ?></td>
        <td class="css_lista"><?php echo $rs_lsegimiento->fields["segumiem_noficio"]; ?></td>
        <td class="css_lista"><?php echo $rs_lsegimiento->fields["segumiem_nrecepcion"]; ?></td>
        <td class="css_lista"><?php echo $rs_lsegimiento->fields["usua_nombre"]." ".$rs_lsegimiento->fields["usua_apellido"]; ?></td>
        <td class="css_lista"><?php echo $rs_lsegimiento->fields["segumiem_fecharegistro"]; ?></td>
      </tr>
	  <?php
	             $rs_lsegimiento->MoveNext(); 
	            }
		 }
	 	 
	  ?>
    </table>
	<?php
	}
	?>
	</td>
  </tr>
<?php

         $rs_centros->MoveNext();	
       }
  }

?>  
</table>

<?php
//------------------------------------------------------------------
  $rs_listaseguro->MoveNext();	
     }
  } 
?>


</div>

<?php
}
?>
