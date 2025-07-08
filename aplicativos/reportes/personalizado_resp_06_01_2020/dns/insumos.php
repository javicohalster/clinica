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
-->
</style>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");


$objformulario= new  ValidacionesFormulario();

//echo $_POST["fecha_inicio"];
$obtien_anio=array();
$obtien_anio=explode("-",$_POST["fecha_inicio"]);
//print_r($obtien_anio);
//echo $_POST["fecha_fin"];
$lista_estu=array();

$centro_id=$_POST["centro_id"];
$datos_centro="select * from dns_centrosalud inner join app_provincia on dns_centrosalud.prob_codigo=app_provincia.prob_codigo where centro_id=".$centro_id;
$rs_centro = $DB_gogess->executec($datos_centro,array());

$zona='';
$zona=$rs_centro->fields["zona_id"];

$subzona='';
$subzona=$rs_centro->fields["prob_nombre"];

$nombrecentro=$rs_centro->fields["centro_nombre"];

//personal=
$array_genero=array();
$lista_personla="select usua_genero,count(usua_genero) as total from app_usuario where grad_id!=18 and centro_id='".$_POST["centro_id"]."' group by usua_genero";
$rs_lgenero = $DB_gogess->executec($lista_personla,array());
if($rs_lgenero)
	{
		while (!$rs_lgenero->EOF) {
		
		    $array_genero[$rs_lgenero->fields["usua_genero"]]=$rs_lgenero->fields["total"];
		
		$rs_lgenero->MoveNext();
		}
	}	


//obtener medicamentos usados

$lista_d="select distinct dns_cuadrobasicomedicamentos.cuadrobm_id,cuadrobm_codigoatc,concat(cuadrobm_principioactivo,' ',cuadrobm_nombredispositivo) as nombre_generico,cuadrobm_primerniveldesagregcion as forma,concat(cuadrobm_concentracion,' ',cuadrobm_presentacion) as concentracion,cuadrobm_valorplanilladispositivos from dns_stockactual inner join dns_cuadrobasicomedicamentos on dns_stockactual.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where stock_fechaureg>='".$_POST["fecha_inicio"]."' and stock_fechaureg<='".$_POST["fecha_fin"]."' and centro_id='".$_POST["centro_id"]."' and categ_id=2 order by dns_cuadrobasicomedicamentos.cuadrobm_id asc";

 
	

//obtener medicamentos usados

//print_r($lista_estu);

?>

<table width="950" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="8" class="css_lista"><center><b>POLIC&Iacute;A NACIONAL DEL ECUADOR</b></center></td>
  </tr>
  <tr>
    <td colspan="8" class="css_lista"><center>DIRECCI&Oacute;N NACIONAL DE SALUD</center></td>
  </tr>
  <tr>
    <td colspan="8" class="css_lista"><center>PEDIDO ANUAL DE MEDICAMENTOS PARA EL CIEC Y LOS ESTABLECIMIETNOS DE SALUD DEL PRIMER NIVEL <br /> DE ATENCION AMBULATORIA A&Ntilde;O <?php echo $obtien_anio[0]; ?></center></td>
  </tr>
  <tr>
    <td colspan="8" class="css_lista"><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td class="css_lista">UNIDAD:</td>
        <td class="css_lista"><?php echo $nombrecentro; ?></td>
        <td class="css_lista">MEDICO RESPONSABLE: </td>
        <td class="css_lista">&nbsp;</td>
      </tr>
      <tr>
        <td class="css_lista">ZONA:</td>
        <td class="css_lista"><?php echo $zona; ?></td>
        <td class="css_lista">FECHA:</td>
        <td class="css_lista"><?php echo date("Y-m-d") ?></td>
      </tr>
      <tr>
        <td class="css_lista">SUBZONA:</td>
        <td class="css_lista"><?php echo $subzona; ?></td>
        <td class="css_lista">NUMERICO PERSONAL POLICIAL MASCULINO: </td>
        <td class="css_lista"><?php echo $array_genero["MASCULINO"]; ?></td>
      </tr>
      <tr>
        <td class="css_lista">&nbsp;</td>
        <td class="css_lista">&nbsp;</td>
        <td class="css_lista">NUMERICO PERSONAL POLICIAL FEMENINO: </td>
        <td class="css_lista"><?php echo $array_genero["FEMENINO"]; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="css_listat">CODIGO ATC</td>
    <td class="css_listat">NOMBRE GENERICO</td>
    <td class="css_listat">FORMA FARMAC&Eacute;UTICA</td>
    <td class="css_listat">CONCENTRACION</td>
    <td class="css_listat">CONSUMO A&Ntilde;O <?php echo $obtien_anio[0]; ?></td>
    <td class="css_listat">SALDO A LA FECHA</td>
    <td class="css_listat">PRECIO PLANILLA </td>
    <td class="css_listat">PEDIDO ANUAL</td>
  </tr>
<?php
$rs_tblpla = $DB_gogess->executec($lista_d,array());
if($rs_tblpla)
	{
		while (!$rs_tblpla->EOF) {
		
		
$stockactual="select sum(stock_cantidad * stock_signo) as stactual from dns_stockactual where centro_id=".$_POST["centro_id"]." and cuadrobm_id=".$rs_tblpla->fields["cuadrobm_id"]." and (stock_fechaureg>='".$_POST["fecha_inicio"]."' and stock_fechaureg<='".$_POST["fecha_fin"]."') and stock_tipo='CONSUMO'";
$rs_stactua = $DB_gogess->executec($stockactual);

$consumo_actual=0;
$consumo_actual=$rs_stactua->fields["stactual"]*1;

//-----------------------------------------------------------
//actual
$stockactualx="select sum(stock_cantidad * stock_signo) as stactual from dns_stockactual where centro_id=".$_POST["centro_id"]." and cuadrobm_id=".$rs_tblpla->fields["cuadrobm_id"];
$rs_stactuax = $DB_gogess->executec($stockactualx);

$stock_actualvalor=$rs_stactuax->fields["stactual"]*1;
//-----------------------------------------------------------


//-----------------------------------------------------------
//pedidos
 $pedidos_valor="select sum(stock_cantidad * stock_signo) as stactual from dns_stockactual where centro_id=".$_POST["centro_id"]." and cuadrobm_id=".$rs_tblpla->fields["cuadrobm_id"]." and stock_tabla=''  and year(stock_fechaureg)=".$obtien_anio[0]."";
$rs_pedidosvalor = $DB_gogess->executec($pedidos_valor);

$stock_pedidosvalor=$rs_pedidosvalor->fields["stactual"]*1;

//-----------------------------------------------------------
?>  
  <tr>
    <td nowrap="nowrap" class="css_lista"><?php echo $rs_tblpla->fields["cuadrobm_codigoatc"]; ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_tblpla->fields["nombre_generico"]); ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_tblpla->fields["forma"]); ?></td>
    <td class="css_lista"><?php echo utf8_encode($rs_tblpla->fields["concentracion"]); ?></td>
    <td class="css_lista"><?php echo abs($consumo_actual); ?></td>
    <td class="css_lista"><?php echo $stock_actualvalor; ?></td>
    <td class="css_lista"><?php echo $rs_tblpla->fields["cuadrobm_valorplanilladispositivos"]; ?></td>
    <td class="css_lista"><?php echo $stock_pedidosvalor; ?></td>
  </tr>
 
<?php
          $rs_tblpla->MoveNext();
		}
	}
?>  
 <tr>
    <td colspan="8" nowrap="nowrap" class="css_lista"><p>&nbsp;</p>
      <table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="17%" class="css_lista">FIRMA:</td>
        <td width="33%" height="50" class="css_lista">&nbsp;</td>
        <td width="22%" class="css_lista">FIRMA:</td>
        <td width="28%" class="css_lista">&nbsp;</td>
      </tr>
      <tr>
        <td class="css_lista">NOMBRE DEL MEDICO: </td>
        <td class="css_lista">&nbsp;</td>
        <td class="css_lista">NOMBRE ENCARGADO BOTIQUIN: </td>
        <td class="css_lista">&nbsp;</td>
      </tr>
      <tr>
        <td class="css_lista">GRADO:</td>
        <td class="css_lista">&nbsp;</td>
        <td class="css_lista">GRADO:</td>
        <td class="css_lista">&nbsp;</td>
      </tr>
      <tr>
        <td class="css_lista">C.C:</td>
        <td class="css_lista">&nbsp;</td>
        <td class="css_lista">C.C.</td>
        <td class="css_lista">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

<?php
}
?>