<?php
$tiempossss=4444000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$firma_docvalor='';
if($_SESSION['datadarwin2679_sessid_inicio'])
{


$listaxml="select * from beko_documentocabecera where doccab_id='".$_POST["enlace"]."'";
$resultlistat = $DB_gogess->executec($listaxml,array());

if($resultlistat->fields["tipocmp_codigo"]=='01')
{
$objSriFactura=new sri_facturas();
$objSriFactura->setdoccab_id($_POST["enlace"]);
$objSriFactura->setDataBase($DB_gogess);
$firma_docvalor=$objSriFactura->xml_factura();
}

if($resultlistat->fields["tipocmp_codigo"]=='04')
{
$objSriFactura=new sri_facturas();
$objSriFactura->setdoccab_id($_POST["enlace"]);
$objSriFactura->setDataBase($DB_gogess);
$firma_docvalor=$objSriFactura->xml_nc();
}


}


?>
<textarea name="firm_xmldata" id="firm_xmldata"><?php echo $firma_docvalor; ?></textarea>
