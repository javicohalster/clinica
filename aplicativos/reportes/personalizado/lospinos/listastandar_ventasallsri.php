<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime", 36000);
ini_set("session.gc_maxlifetime", 36000);
session_start();
if ($_SESSION['datadarwin2679_sessid_inicio']) {

  $nombre_mes2 = array();
  $nombre_mes2["01"] = 'ENERO';
  $nombre_mes2["02"] = 'FEBRERO';
  $nombre_mes2["03"] = 'MARZO';
  $nombre_mes2["04"] = 'ABRIL';
  $nombre_mes2["05"] = 'MAYO';
  $nombre_mes2["06"] = 'JUNIO';
  $nombre_mes2["07"] = 'JULIO';
  $nombre_mes2["08"] = 'AGOSTO';
  $nombre_mes2["09"] = 'SEPTIEMBRE';
  $nombre_mes2["10"] = 'OCTUBRE';
  $nombre_mes2["11"] = 'NOVIEMBRE';
  $nombre_mes2["12"] = 'DICIEMBRE';
  //2 excel
  //3 pdf

  function ver_ciudadpaciente($ci, $DB_gogess)
  {

    $lista_hijos = "select distinct centro_id from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='" . trim($ci) . "'";
    $rs_datahijos = $DB_gogess->executec($lista_hijos, array());

    $centro_id = @$rs_datahijos->fields["centro_id"];
    if (!(@$rs_datahijos->fields["centro_id"])) {
      $centro_id = 1;
    }

    return $centro_id;
  }

  $previsual = 0;
  if (@$_POST["previsual"]) {
    $previsual = @$_POST["previsual"];
    $fecha_i = @$_POST["fecha_inicio"];
    $fecha_f = @$_POST["fecha_fin"];
    $centro_id = @$_POST["centro_id"];
    $clie_institucionval = @$_POST["clie_institucionval"];
    $ireport = @$_POST["ireport"];
    $cliente_ruc = @$_POST["cliente_ruc"];
  } else {
    $previsual = @$_GET["previsual"];
    $fecha_i = @$_GET["fecha_inicio"];
    $fecha_f = @$_GET["fecha_fin"];
    $centro_id = @$_GET["centro_id"];
    $clie_institucionval = @$_GET["clie_institucionval"];
    $ireport = @$_GET["ireport"];
    $cliente_ruc = @$_GET["cliente_ruc"];
  }

  if ($previsual == 2) {
    header('Content-type: application/vnd.ms-excel');
    $fechahoy = date("Y-m-d");
    header("Content-Disposition: attachment; filename=" . "repxls_" . $fechahoy . ".xls");
  }

  $director = '../../../../';
  include("../../../../cfg/clases.php");
  include("../../../../cfg/declaracion.php");
  require_once('tcpdf_include.php');

  $objformulario = new  ValidacionesFormulario();

  $bandera_t1 = 0;
  $actual = strtotime(date("Y-m-d"));
  $mesmenos = date("Y-m-d", strtotime("-2 month", $actual));




  $sql1 = "";
  $sql2 = "";
  $sql3 = "";
  $sql4 = "";
  $sql5 = "";

  if ($centro_id) {
    // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }


  if ($fecha_i != '' and $fecha_f != '') {
    $sql3 = " doccab_fechaemision_cliente>='" . $fecha_i . "' and doccab_fechaemision_cliente<='" . $fecha_f . "' and ";
  } else {

    if ($fecha_i != '' and $fecha_f == '') {
      $sql3 = " doccab_fechaemision_cliente>='" . $fecha_i . "' and ";
    } else {
      if ($fecha_i == '' and $fecha_f != '') {
        $sql3 = " doccab_fechaemision_cliente<='" . $fecha_f . "' and ";
      }
    }
  }

  if ($clie_institucionval) {
    $sql4 = " clie_institucion like '%" . $clie_institucionval . "%' and ";
  }

  if ($cliente_ruc) {
    $sql5 = " doccab_rucci_cliente = '" . trim($cliente_ruc) . "' and ";
  }


  $concatena_sql = $sql1 . $sql2 . $sql3 . $sql4 . $sql5;
  $concatena_sql = substr($concatena_sql, 0, -4);


  $nciudad = '';
  $nciudad = $objformulario->replace_cmb("dns_centrosalud", "centro_id,centro_nombre", " where centro_id =", $centro_id, $DB_gogess);



  //area datos
  $documento = '';
  $cabecera = '';
  $cabecera = $objformulario->replace_cmb("app_empresa", "emp_id,emp_cabecerareportes", " where emp_id=", 1, $DB_gogess);

  $css = "<style type='text/css'>
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>";

  $reporte_pg = "select * from sth_report where rept_id=" . $ireport;
  $rs_reportepg = $DB_gogess->executec($reporte_pg, array());

  $rept_nombre = $rs_reportepg->fields["rept_nombre"];
  $documento = $css . "<div align='center' >" . $rept_nombre . "</div><p align='center'>" . $rs_reportepg->fields["rept_observacion"] . "</p>" . utf8_decode($cabecera) . "<br><center><b>" . $nciudad . "</b></center>";

  $subtotalnc = 0;
  $subtotadelmes = 0;
  //echo $lista_servicios;
  //$xmldata=53;

  $cuenta_fac = 0;
  $documento .= '<center>
Desde: ' . $fecha_i . ' Hasta: ' . $fecha_f . '<br>
<br>';

  ///programacion reporte



  $documento .= '<table border="1" cellpadding="0" cellspacing="0">
  <tr>
	<td>cuenta</td>
	<td>TIPO</td>
	<td>ANULADO</td>
  <td>ESTADO SRI</td>
  <td>FECHA AUTORIZACION</td>
	<td>F. Emisi&oacute;n</td>
	<td>A&Ntilde;O</td>
	<td>MES</td>
    <td>RUC/CEDULA</td>
    <td>Raz&oacute;n Social</td>
    <td>Detalle</td>
	<td>CEDULA PACIENTE</td>
	<td>SEGURO</td>
    <td>No. Comprobante</td>
    <td>No. Autorizaci&oacute;n</td>
	<td>No. Comprobante modificado</td>
    <td>Fecha documento modificado</td>
	
    <td>Cod. Sustento</td>
    <td>Cod. Asiento</td>
    
    <td>Centro de Costo</td>
    <td>12%</td>
    <td>0%</td>
    <td>No objeto</td>
    <td bgcolor="#BDE6DB" >Subtotal</td>
    <td>IVA</td>
    <td>IVA Gasto</td>
    <td>ICE</td>
    <td bgcolor="#BDE6DB" >Total</td>
   
  </tr>';

  if ($concatena_sql) {
    $lista_doc = "SELECT *,'0' as ivagasto,'0' as ice FROM beko_documentocabecera inner join app_proveedor on beko_documentocabecera.proveeve_id=app_proveedor.provee_id where " . $concatena_sql . "  and doccab_nousar=0 ";
  } else {
    $lista_doc = "SELECT *,'0' as ivagasto,'0' as ice FROM beko_documentocabecera inner join app_proveedor on beko_documentocabecera.proveeve_id=app_proveedor.provee_id where and doccab_nousar=0 ";
  }

  //echo $lista_doc;
  $contador_t = 0;
  $rs_data = $DB_gogess->executec($lista_doc, array());
  if ($rs_data) {
    while (!$rs_data->EOF) {

      $array_iva = array();
      $ivarete = 0;
      $nretencion = '';
      $compretcab_clavedeaccesos = '';

      $verif_as = "SELECT abs(sum(detcc_haber-detcc_debe)) as tasi FROM `lpin_comprobantecontable` inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.`comcont_enlace`=lpin_detallecomprobantecontable.`comcont_enlace` where comcont_tabla='beko_documentocabecera' and comcont_idtabla='" . $rs_data->fields["doccab_id"] . "' and tipoa_id=2 and comcont_anulado=0 and (detcc_cuentacontable like  '4.1.%' or detcc_cuentacontable like  '4.2.%') ";
      $rs_okas = $DB_gogess->executec($verif_as, array());

      $suma_cuentas = '';
      $suma_vaoras = 0;
      $verif_asc = "SELECT detcc_cuentacontable,abs(sum(detcc_haber-detcc_debe)) as tasi FROM `lpin_comprobantecontable` inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.`comcont_enlace`=lpin_detallecomprobantecontable.`comcont_enlace` where comcont_tabla='beko_documentocabecera' and comcont_idtabla='" . $rs_data->fields["doccab_id"] . "' and tipoa_id=2 and comcont_anulado=0 and (detcc_cuentacontable like  '4.1.%' or detcc_cuentacontable like  '4.2.%') group by detcc_cuentacontable";
      $rs_okasc = $DB_gogess->executec($verif_asc, array());
      if ($rs_okasc) {
        while (!$rs_okasc->EOF) {

          $busca_cuenta = "select * from lpin_plancuentas where planc_codigoc='" . $rs_okasc->fields["detcc_cuentacontable"] . "'";
          $rs_pc = $DB_gogess->executec($busca_cuenta, array());


          if (!($rs_pc->fields["planc_id"])) {
            $fondo_cuent = ' style="color:#FF0000" ';
          }



          $suma_cuentas .= '<span ' . $fondo_cuent . ' >' . $rs_okasc->fields["detcc_cuentacontable"] . '</span>=' . round($rs_okasc->fields["tasi"], 2) . '<br>';
          $suma_vaoras = $suma_vaoras + round($rs_okasc->fields["tasi"], 2);


          $rs_okasc->MoveNext();
        }
      }


      $suma_cuentas .= "________<br>" . $suma_vaoras;


      //$busca_retencion="select * from ventas_retencion_detalle inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=2 and compra_id='".$rs_data->fields["compra_id"]."'";

      $doccab_id = $rs_data->fields["doccab_id"];
      $busca_retencion = "select * from ventas_retencion_detalle  where impur_id=2 and compra_enlace='" . $doccab_id . "'";

      $doccab_retnumdoc = $rs_data->fields["doccab_retnumdoc"];
      $doccab_retfechaemision = $rs_data->fields["doccab_retfechaemision"];
      $doccab_retautorizacion = $rs_data->fields["doccab_retautorizacion"];

      $rs_listaretencion = $DB_gogess->executec($busca_retencion, array());
      if ($rs_listaretencion) {
        while (!$rs_listaretencion->EOF) {

          @$array_iva[$rs_listaretencion->fields["porcentaje_id"]] = $array_iva[$rs_listaretencion->fields["porcentaje_id"]] + $rs_listaretencion->fields["compretdet_valorretenido"];
          $ivarete = $ivarete + $rs_listaretencion->fields["compretdet_valorretenido"];

          $nretencion = $doccab_retnumdoc;
          $fechanretencion = $doccab_retfechaemision;
          $compretcab_clavedeaccesos = $doccab_retautorizacion;

          $rs_listaretencion->MoveNext();
        }
      }

      //  print_r($array_iva);

      //retencion 
      $array_renta = array();
      $ivaretett = 0;
      //$busca_retencion1="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=1 and compra_id='".$rs_data->fields["compra_id"]."'";

      $busca_retencion1 = "select * from ventas_retencion_detalle  where impur_id=1 and compra_enlace='" . $doccab_id . "'";
      $rs_listaretencion1 = $DB_gogess->executec($busca_retencion1, array());
      if ($rs_listaretencion1) {
        while (!$rs_listaretencion1->EOF) {

          @$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"] = $array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"] + $rs_listaretencion1->fields["compretdet_valorretenido"];
          @$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["codigo"] = $rs_listaretencion1->fields["porcentaje_id"];
          $ivaretett = $ivaretett + $rs_listaretencion1->fields["compretdet_valorretenido"];

          $nretencion = $doccab_retnumdoc;
          $fechanretencion = $doccab_retfechaemision;
          $compretcab_clavedeaccesos = $doccab_retautorizacion;

          $rs_listaretencion1->MoveNext();
        }
      }

      if (count($array_renta) > 0) {

        //print_r(@$array_renta);
      }

      $tipocmp_codigo = $rs_data->fields["tipocmp_codigo"];
      $doccab_anulado = $rs_data->fields["doccab_anulado"];

      $signo = 1;
      if ($tipocmp_codigo == '04') {
        //if($rs_data->fields["doccab_fechadocmodi"]>=$fecha_i and $rs_data->fields["doccab_fechadocmodi"]<=$fecha_f)
        //{
        $signo = -1;
        //}
        //else
        // {
        // $signo=0;
        //}


      }

      if ($doccab_anulado == 1) {
        $signo = 0;
      }



      $separa_fechavalor = array();
      $separa_fechavalor = explode("-", $rs_data->fields["doccab_fechaemision_cliente"]);

      $tipodocd = $objformulario->replace_cmb("pichinchahumana_combos.beko_tipocomprobante", "tipocmp_codigo,tipocmp_nombre", " where tipocmp_codigo like ", $rs_data->fields["tipocmp_codigo"], $DB_gogess);

      $estado_docval = '';
      $fonod_negaticos = '';

      if ($doccab_anulado == 1) {
        $estado_docval = 'ANULADO';
      }

      if ($signo == -1 or $signo == 0) {
        $fonod_negaticos = ' bgcolor="#FBDDE6" ';
      }


      $contador_t++;

      $documento .= '<tr ' . $fonod_negaticos . ' >';
      $documento .= '<td  nowrap="nowrap">' . $contador_t . '</td>';
      $documento .= '<td  nowrap="nowrap">' . $tipodocd . '</td>';
      $documento .= '<td  nowrap="nowrap">' . $estado_docval . '</td>';

      $documento .= '<td  nowrap="nowrap">' . $rs_data->fields["doccab_estadosri"] . '</td>';
      $documento .= '<td  nowrap="nowrap">' . $rs_data->fields["doccab_fechaaut"] . '</td>';

      $documento .= '<td  nowrap="nowrap">' . $rs_data->fields["doccab_fechaemision_cliente"] . '</td>';
      $documento .= '<td  nowrap="nowrap">' . $separa_fechavalor[0] . '</td>';
      $documento .= '<td  nowrap="nowrap">' . $nombre_mes2[$separa_fechavalor[1]] . '</td>';

      $documento .= '<td  style=mso-number-format:"@" >' . $rs_data->fields["doccab_rucci_cliente"] . '</td>';
      //$documento.='<td  style=mso-number-format:"@" ></td>';
      $documento .= '<td>' . $rs_data->fields["doccab_nombrerazon_cliente"] . '</td>';
      $documento .= '<td>' . $rs_data->fields["doccab_adicional"] . '</td>';

      $documento .= '<td>' . $rs_data->fields["doccab_identificacionpaciente"] . '</td>';
      $n_convenio = $objformulario->replace_cmb("pichinchahumana_extension.dns_convenios", "conve_id,conve_nombre", " where conve_id=", $rs_data->fields["conve_id"], $DB_gogess);
      $documento .= '<td>' . $n_convenio . '</td>';

      $documento .= '<td nowrap="nowrap"  style=mso-number-format:"@" >' . $rs_data->fields["doccab_ndocumento"] . '</td>';
      $documento .= '<td nowrap="nowrap"  style=mso-number-format:"@" >' . $rs_data->fields["doccab_nautorizacion"] . '</td>';

      $documento .= '<td nowrap="nowrap"  style=mso-number-format:"@" >' . $rs_data->fields["doccab_ndocuafecta"] . '</td>';
      $documento .= '<td nowrap="nowrap"  style=mso-number-format:"@" >' . $rs_data->fields["doccab_fechadocmodi"] . '</td>';


      $documento .= '<td  style=mso-number-format:"@" ></td>';
      $documento .= '<td></td>';
      $documento .= '<td></td>';
      $documento .= '<td align="right" >' . ($rs_data->fields["doccab_subtotaliva"] * $signo) . '</td>';
      @$total1 = @$total1 + ($rs_data->fields["doccab_subtotaliva"] * $signo);
      $documento .= '<td align="right" >' . ($rs_data->fields["doccab_subtotalsiniva"] * $signo) . '</td>';
      @$total2 = @$total2 + ($rs_data->fields["doccab_subtotalsiniva"] * $signo);

      $documento .= '<td align="right" ></td>';
      @$total3 = @$total3 + ($rs_data->fields["doccab_subtnoobjetoi"] * $signo);

      $subtotal = 0;
      $subtotal = ($rs_data->fields["doccab_subtotaliva"] * $signo) + ($rs_data->fields["doccab_subtotalsiniva"] * $signo) + ($rs_data->fields["doccab_subtnoobjetoi"] * $signo);
      //suma notas de credito
      if ($tipocmp_codigo == '04') {
        if ($rs_data->fields["doccab_fechadocmodi"] >= $fecha_i and $rs_data->fields["doccab_fechadocmodi"] <= $fecha_f) {

          $subtotadelmes = $subtotadelmes + ($rs_data->fields["doccab_subtotaliva"]) + ($rs_data->fields["doccab_subtotalsiniva"]) + ($rs_data->fields["doccab_subtnoobjetoi"]);
        } else {
          $subtotalnc = $subtotalnc + ($rs_data->fields["doccab_subtotaliva"]) + ($rs_data->fields["doccab_subtotalsiniva"]) + ($rs_data->fields["doccab_subtnoobjetoi"]);
        }
      }

      $documento .= '<td bgcolor="#BDE6DB" align="right"  >' . $subtotal . '</td>';
      @$total4 = @$total4 + $subtotal;

      $documento .= '<td align="right" >' . ($rs_data->fields["doccab_iva"] * $signo) . '</td>';
      @$total5 = @$total5 + ($rs_data->fields["doccab_iva"] * $signo);

      $documento .= '<td align="right" ></td>';
      @$total6 = @$total6 + $rs_data->fields["ivagasto"];

      $documento .= '<td align="right" >' . $rs_data->fields["ice"] . '</td>';
      @$total7 = @$total7 + $rs_data->fields["ice"];



      $documento .= '<td bgcolor="#BDE6DB" align="right"  >' . ($rs_data->fields["doccab_total"] * $signo) . '</td>';
      @$total8 = @$total8 + ($rs_data->fields["doccab_total"] * $signo);



      $documento .= '</tr>';

      $rs_data->MoveNext();
    }
  }



  $documento .= '<tr>
    <td  nowrap="nowrap"></td>
	<td  nowrap="nowrap"></td>
    <td ></td>
	<td ></td>
	<td ></td>
	<td></td>
    <td ></td>
	<td></td>
    <td></td>
	<td></td>
    <td></td>
    <td nowrap="nowrap"></td>
    <td nowrap="nowrap"></td>
    <td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right" >' . @$total1 . '</td>
    <td align="right" >' . @$total2 . '</td>
    <td align="right" >' . @$total3 . '</td>
    <td align="right" >' . @$total4 . '</td>
    <td align="right" >' . @$total5 . '</td>
    <td align="right" >' . @$total6 . '</td>
    <td align="right" >' . @$total7 . '</td>
    <td align="right" >' . @$total8 . '</td>
    
  </tr>
</table>Total NC otro mes:' . $subtotalnc . '<br>' . 'Total NC del mes:' . $subtotadelmes . '';

  ///programacion reporte


  //area datos 
  if ($previsual == 1) {
    echo str_replace(".", ",", $documento);
  }
  if ($previsual == 2) {
    echo utf8_decode(str_replace(".", ",", $documento));
  }


  if ($previsual == 3) {

    $comprobantepdf = '';
    $comprobantepdf = $documento;


    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF
    {
      var $filtro_valor_h1;
      var $filtro_valor_h2;
      var $filtro_valor_h3;
      //Page header

      // Page footer
      public function Footer()
      {
        // Position at 15 mm from bottom		
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        //$image_file = 'logopie.fw.png';
        // $this->Image($image_file, 80, 273, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);		
      }
    }


    $pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('CERENI');
    $pdf->SetTitle('CERENI');
    $pdf->SetSubject('CERENI');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    $pdf->filtro_valor_h1 = '';
    $pdf->filtro_valor_h2 = '';
    $pdf->filtro_valor_h3 = '';
    // set default header data
    $pdf->setPrintHeader(false);
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);
    // set header and footer fonts
    //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
    //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
      require_once(dirname(__FILE__) . '/lang/eng.php');
      $pdf->setLanguageArray($l);
    }
    // ---------------------------------------------------------
    // set font
    $pdf->SetFont('helvetica', 'B', 15);
    // add a page
    $pdf->AddPage();
    //$pdf->Write(0, 'HANOR', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 7);
    $pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');
    /*if($_GET["dhoja"]==1)
{
$pdf->AddPage();
$pdf->writeHTML(utf8_encode("<strong>V. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');
}*/
    //echo $lee_plantilla;
    //echo $comprobantepdf="Holaa";
    $nombre_pdf = "pdfdocumento_" . date("Y-m-d") . ".pdf";
    $pdf->Output($nombre_pdf, 'I');
  }
}
