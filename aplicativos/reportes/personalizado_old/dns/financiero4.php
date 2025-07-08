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

?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td class="css_listat">CENTRO</td>
    <td class="css_listat">ASEGURADOR/FINANCIADOR</td>
    <td class="css_listat">No. OFICIO </td>
    <td class="css_listat">No. PlANILLA </td>
    <td class="css_listat">FECHA ENTREGA </td>
    <td class="css_listat">A&Ntilde;O</td>
    <td class="css_listat">MES</td>
    <td class="css_listat">VALOR PLANILLA </td>
    <td class="css_listat">FECHA REGISTRO </td>
  </tr>
  <?php
if($_POST["tipopac_id"])
{
$lista_seg="select dns_recaudacion.recau_id AS recau_id,dns_recaudacion.emp_id AS emp_id,dns_centrosalud.centro_nombre AS centro_nombre,faesa_tipopaciente.tipopac_nombre AS tipopac_nombre,dns_recaudacion.recau_noficio AS recau_noficio,dns_recaudacion.recau_nplanilla AS recau_nplanilla,dns_recaudacion.recau_fechaentrega AS recau_fechaentrega,dns_recaudacion.recau_anio AS recau_anio,dns_recaudacion.recau_mes AS recau_mes,dns_recaudacion.recau_valorplanilla AS recau_valorplanilla,dns_recaudacion.recau_fecharegistro AS recau_fecharegistro,dns_recaudacion.centro_id AS centro_id from ((dns_recaudacion left join faesa_tipopaciente on((dns_recaudacion.tipopac_id = faesa_tipopaciente.tipopac_id))) left join dns_centrosalud on((dns_recaudacion.centro_id = dns_centrosalud.centro_id))) where dns_recaudacion.centro_id='".$centro_id."'  and dns_recaudacion.recau_anio='".$_POST["anio_valor"]."' and dns_recaudacion.recau_mes='".$mesnombre[$_POST["mes_valor"]]."' and dns_recaudacion.tipopac_id='".$_POST["tipopac_id"]."'";
}
else
{
$lista_seg="select dns_recaudacion.recau_id AS recau_id,dns_recaudacion.emp_id AS emp_id,dns_centrosalud.centro_nombre AS centro_nombre,faesa_tipopaciente.tipopac_nombre AS tipopac_nombre,dns_recaudacion.recau_noficio AS recau_noficio,dns_recaudacion.recau_nplanilla AS recau_nplanilla,dns_recaudacion.recau_fechaentrega AS recau_fechaentrega,dns_recaudacion.recau_anio AS recau_anio,dns_recaudacion.recau_mes AS recau_mes,dns_recaudacion.recau_valorplanilla AS recau_valorplanilla,dns_recaudacion.recau_fecharegistro AS recau_fecharegistro,dns_recaudacion.centro_id AS centro_id from ((dns_recaudacion left join faesa_tipopaciente on((dns_recaudacion.tipopac_id = faesa_tipopaciente.tipopac_id))) left join dns_centrosalud on((dns_recaudacion.centro_id = dns_centrosalud.centro_id))) where dns_recaudacion.centro_id='".$centro_id."'  and dns_recaudacion.recau_anio='".$_POST["anio_valor"]."' and dns_recaudacion.recau_mes='".$mesnombre[$_POST["mes_valor"]]."'";

}
  
  $rs_lista = $DB_gogess->executec($lista_seg,array());
if($rs_lista)
	{
		while (!$rs_lista->EOF) {
		
		
  ?>
  <tr>
    <td class="css_lista"><?php echo utf8_encode($rs_lista->fields["centro_nombre"]); ?></td>
    <td class="css_lista"><?php echo $rs_lista->fields["tipopac_nombre"]; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_lista->fields["recau_noficio"]); ?></td>
    <td class="css_lista"><?php echo $rs_lista->fields["recau_nplanilla"]; ?></td>
    <td class="css_lista"><?php echo $rs_lista->fields["recau_fechaentrega"]; ?></td>
    <td class="css_lista"><?php echo $rs_lista->fields["recau_anio"]; ?></td>
    <td class="css_lista"><?php echo $rs_lista->fields["recau_mes"]; ?></td>
    <td class="css_lista"><?php echo $rs_lista->fields["recau_valorplanilla"]; ?></td>
    <td class="css_lista"><?php echo $rs_lista->fields["recau_fecharegistro"]; ?></td>
  </tr>
  <?php
               $rs_lista->MoveNext();
			 }
         }	
  
  ?>
</table>

</div>

<?php
}
?>

