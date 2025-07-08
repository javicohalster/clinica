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

$objformulario= new  ValidacionesFormulario();


$centro_id=$_POST["centro_id"];
$usua_id=$_POST["usua_id"];
$cierr_fecha=$_POST["cierr_fecha"];

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$taabla_cab='';
$ver_linkpdf='';
//if($_POST["ctpc_id"]==1)
//{
   $taabla_cab='beko_documentocabecera';
   $ver_linkpdf='ver_pdf';
//}

//if($_POST["ctpc_id"]==2)
//{
  // $taabla_cab='beko_recibocabecera'; 
   //$ver_linkpdf='ver_pdfrecibo';
   
//}

$lista_fac="select * from ".$taabla_cab." where centro_id='".$centro_id."' and usua_id='".$usua_id."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' and doccab_anulado=1 order by doccab_id asc";


//$lista_fac="select * from ".$taabla_cab." where centro_id='".$centro_id."'  and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' order by doccab_id asc";
?>
<div class="table-responsive p-0">
    <table class="table align-items-center mb-0" width="100%" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>No.</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>Fecha</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>Forma de Pago</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>No. Doc</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>Cliente</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>Ruc</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>Total</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>MOTIVO</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>FECHA ANULADO</b></th>
                <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>Ver PDF</b></th>
            </tr>
        </thead>

        <?php
$grantotal=0;
$num_data=0;
 $rs_data = $DB_gogess->executec($lista_fac,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {
	  
	  $num_data++;

	  $forma_pago='';
	 
	$busca_fpagox="select * from lpin_formapagoventa where doccab_id='".$rs_data->fields["doccab_id"]."'";
    $rs_fpagox = $DB_gogess->executec($busca_fpagox,array());	
     
	if($rs_fpagox->fields["frmc_codigo"]=='01')
	{
	  $forma_pago='EFECTIVO'; 
	}
	
	if($rs_fpagox->fields["frmc_codigo"]=='19')
	{
	  $forma_pago='TARJETA DE CREDITO'; 
	}
	
	if($rs_fpagox->fields["frmc_codigo"]=='16')
	{
	  $forma_pago='TARJETA DE DEBITO'; 
	}
	
	if($rs_fpagox->fields["frmc_codigo"]=='20')
	{
	  $forma_pago='TRANSFERENCIA'; 
	}
	
	if($rs_data->fields["tippo_id"]==1)
	{
	  $forma_pago='CUENTAS POR COBRAR'; 
	}
	
?>
        <tbody>
            <tr>
                <td><?php echo $num_data; ?></td>
                <td><?php echo $rs_data->fields["doccab_fechaemision_cliente"]; ?></td>
                <td><?php echo $forma_pago; ?></td>
                <td><?php echo $rs_data->fields["doccab_ndocumento"]; ?></td>
                <td><?php echo $rs_data->fields["doccab_nombrerazon_cliente"]." ".$rs_data->fields["doccab_apellidorazon_cliente"]; ?>
                </td>
                <td><?php echo $rs_data->fields["doccab_rucci_cliente"]; ?></td>
                <td><?php echo $rs_data->fields["doccab_total"]; ?></td>
                <td><?php echo $rs_data->fields["doccab_motivoanulado"]; ?></td>
                <td><?php echo $rs_data->fields["doccab_fechaanulado"]; ?></td>
                <td><input type="button" name="Button" value="PDF"
                        onClick="<?php echo $ver_linkpdf; ?>('<?php echo $rs_data->fields["doccab_id"]; ?>','01')"></td>
            </tr>
        </tbody>
        <?php
       
	   $grantotal=$grantotal+$rs_data->fields["doccab_total"];

        $rs_data->MoveNext();	   
	  }
  }

?>
        <tfoot>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-uppercase text-secondary font-weight-bolder opacity-7"><b>Total</b></td>
                <td class="text-uppercase text-secondary font-weight-bolder opacity-7"><b><?php echo $grantotal; ?></b>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </tfoot>
    </table>
</div>
<?php
}

?>