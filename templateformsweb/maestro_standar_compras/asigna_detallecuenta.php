<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss = 44450000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/

if ($_SESSION['datadarwin2679_sessid_inicio']) {
    $director = '../../';
    include("../../cfg/clases.php");
    include("../../cfg/declaracion.php");

    $objformulario = new  ValidacionesFormulario();
    $sqltotal = "";

    $cdxml_id = $_POST["cdxml_id"];
    $compra_nfactura = $_POST["compra_nfactura"];
    $compra_id = $_POST["compra_id"];

    $busca_datacp = "select * from dns_compras where compra_id='" . $compra_id . "'";
    $rs_bdatacp = $DB_gogess->executec($busca_datacp, array());
    $proveevar_id = $rs_bdatacp->fields["proveevar_id"];

    $busca_dataprov = "select * from  app_proveedor where provee_id='" . $rs_bdatacp->fields["proveevar_id"] . "'";
    $rs_bdataprov = $DB_gogess->executec($busca_dataprov, array());

    $provee_cuentag = '';
    $provee_cuentag = $rs_bdataprov->fields["provee_cuentag"];

    $busca_data = "select * from dns_comprasdetallexml where cdxml_id='" . $cdxml_id . "'";
    $rs_bdata = $DB_gogess->executec($busca_data, array());

    $compra_numeroproceso = $_POST["compra_numeroproceso"];

    $compra_enlace = $compra_numeroproceso;
    $cuadrobm_id = 0;
    $cuecomp_cantidad = $rs_bdata->fields["cdxml_cantidad"];
    $cuecomp_preciounitario = $rs_bdata->fields["cdxml_preciounitario"];
    $porcecr_id = '';
    $porceci_id = '';
    $cuecomp_descuento = '';
    $cuecomp_descuentodolar = $rs_bdata->fields["cdxml_descuento"];
    $cuecomp_subtotal = $rs_bdata->fields["cdxml_totalsinimpuestos"];
    $usua_id = $_SESSION['datadarwin2679_sessid_inicio'];
    $cuecomp_fecharegistro = date("Y-m-d H:i:s");
    $prcomp_impucodigo = '2';

    /*if($rs_bdata->fields["cdxml_iva"]>0)
{
$taric_id='1';
}
else
{
$taric_id='2';
}*/
    //=======================

    if ($rs_bdata->fields["cdxml_iva"] == 0) {
        $taric_id = '2';
    }

    if ($rs_bdata->fields["cdxml_iva"] == 2) {
        $taric_id = '1';
    }

    if ($rs_bdata->fields["cdxml_iva"] == 4) {
        $taric_id = '5';
    }

    if ($rs_bdata->fields["cdxml_iva"] == 6) {
        $taric_id = '3';
    }

    if ($rs_bdata->fields["cdxml_iva"] == 7) {
        $taric_id = '4';
    }

    if ($rs_bdata->fields["cdxml_iva"] == 8) {
        $taric_id = '6';
    }

    if ($rs_bdata->fields["cdxml_iva"] == 5) {
        $taric_id = '7';
    }



    $cuecomp_codigoext = $rs_bdata->fields["cdxml_codigo"];
    $cuecomp_descripext = $rs_bdata->fields["cdxml_descripcion"];

    $planc_codigoc = $provee_cuentag;

    $inserta_data = "INSERT INTO lpin_cuentacompra ( compra_enlace, cuecomp_cantidad, cuecomp_preciounitario, porcecr_id, porceci_id, cuecomp_descuento, cuecomp_descuentodolar, cuecomp_subtotal, usua_id, cuecomp_fecharegistro, cuecomp_codigoext, cuecomp_descripext, cdxml_id,taric_id,planc_codigoc) VALUES
('" . $compra_enlace . "','" . $cuecomp_cantidad . "','" . $cuecomp_preciounitario . "','" . $porcecr_id . "','" . $porceci_id . "','" . $cuecomp_descuento . "','" . $cuecomp_descuentodolar . "','" . $cuecomp_subtotal . "','" . $usua_id . "','" . $cuecomp_fecharegistro . "','" . $cuecomp_codigoext . "','" . $cuecomp_descripext . "','" . $cdxml_id . "','" . $taric_id . "','" . $planc_codigoc . "');";

    $rs_bdata = $DB_gogess->executec($inserta_data, array());
    //echo $inserta_data;


    $busca_ac = "update dns_comprasdetallexml set cdxml_asignado=1 where cdxml_id='" . $cdxml_id . "'";
    $rs_bac = $DB_gogess->executec($busca_ac, array());

    //================================
    //periodo activo no olvidar




}
