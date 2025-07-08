<?php
//parametros
//forma de pago
$formapago_code["01"]="Sin Utili. Sist. Financiero";
$formapago_code["02"]="CHEQUE PROPIO";
$formapago_code["03"]="CHEQUE CERTIFICADO";
$formapago_code["04"]="CHEQUE DE GERENCIA";
$formapago_code["05"]="CHEQUE DEL EXTERIOR";
$formapago_code["06"]="DEBITO DE CUENTA";
$formapago_code["07"]="TRANSFERENCIA PROPIO BANCO";
$formapago_code["08"]="TRANSFERENCIA OTRO BANCO NACIONAL";
$formapago_code["09"]="TRANSFERENCIA BANCO EXTERIOR";
$formapago_code["10"]="TARJETA DE CREDITO NACIONAL";
$formapago_code["11"]="TARJETA DE CREDITO INTERNACIONAL";
$formapago_code["12"]="GIRO";
$formapago_code["13"]="DEPOSITO EN CUENTA (CORRIENTE/AHORROS)";
$formapago_code["14"]="ENDOSO DE INVERSION";
$formapago_code["15"]="COMPENSACION DE DEUDAS";
$formapago_code["16"]="TARJETA DE DEBITO";
$formapago_code["17"]="DINERO ELECTRONICO";
$formapago_code["18"]="TARJETA PREPAGO";
$formapago_code["18"]="TARJETA PREPAGO";
$formapago_code["19"]="TARJETA DE CREDITO";
$formapago_code["20"]="OTROS CON UTIL. SIST. FINANC.";
$formapago_code["21"]="ENDOSO DE TITULOS";
//parametros
//code comprobantes
$comprobante_code["01"]="FACTURA";
$comprobante_code["04"]="NOTA DE CR&Eacute;DITO";
$comprobante_code["05"]="NOTA DE D&Eacute;BITO";
$comprobante_code["06"]="GU&Iacute;A DE REMISI&Iacute;N";
$comprobante_code["07"]="COMPROBANTE DE RETENCI&Oacute;N";
//code ambiente
$ambiente_code["1"]="PRUEBAS";
$ambiente_code["2"]="PRODUCCION";
//code emision
$tipoemision_code["1"]="Emisi&oacute;n Normal";
$tipoemision_code["2"]="Emisi&oacute;n por Indisponibilidad del Sistema";
//code identificacion
$tipoidentificacion_code["04"]="RUC";
$tipoidentificacion_code["05"]="CEDULA";
$tipoidentificacion_code["06"]="PASAPORTE";
$tipoidentificacion_code["07"]="CONSUMIDOR FINAL";
$tipoidentificacion_code["08"]="IDENTIFICACION  DELEXTERIOR";
$tipoidentificacion_code["09"]="PLACA";
//Impuestos
$impuesto_code["2"]="IVA";
$impuesto_code["3"]="ICE";
$impuesto_code["5"]="IRBPNR";

$tarifaiva_code["0"]="0%";
$tarifaiva_code["2"]="12%";
$tarifaiva_code["3"]="14%";
$tarifaiva_code["6"]="No Objeto de Impuesto";
$tarifaiva_code["7"]="Exento de IVA";

//impuesto retencion
$retencion_code["1"]="RENTA";
$retencion_code["2"]="IVA";
$retencion_code["6"]="ISD";
//parametros
function fecha_mes($mes)
{
   switch ($mes) {
    case '01':
        $mesn='Ene';
        break;
    case '02':
        $mesn='Feb';
        break;
    case '03':
        $mesn='Mar';
        break;
    case '04':
        $mesn='Abr';
        break;
	 case '05':
        $mesn='May';
        break;
	 case '06':
        $mesn='Jun';
        break;
	case '07':
        $mesn='Jul';
        break;	
	case '08':
        $mesn='Ago';
        break;
	case '09':
        $mesn='Sep';
        break;
	case '10':
        $mesn='Oct';
        break;
	case '11':
        $mesn='Nov';
        break;
	case '12':
        $mesn='Dic';
        break;														
    default:
       $mesn='';
      }
	  
	  return  $mesn;
}


$renta_cod_un["1"]='IVA 30%';
$renta_cod_un["2"]='IVA 70%';
$renta_cod_un["3"]='IVA 100%';
$renta_cod_un["302"]='RETENCION EMPLEADOS EN RELACION DE DEPENDENCIA';
$renta_cod_un["303"]='RETENCION HONORARIOS PROFESSIONALES';
$renta_cod_un["304"]='Servicios predomina el intelecto';
$renta_cod_un["307"]='Servicios predomina la mano de obra';
$renta_cod_un["308"]='Servicios entre sociedades';
$renta_cod_un["309"]='RETENCION SERVICIOS PUBLICIDAD Y COMUNICACION';
$renta_cod_un["310"]='Servicio transporte privado de pasajeros o servicio publico o privado de carga';
$renta_cod_un["312"]='Transferencia de bienes muebles de naturaleza corporal';
$renta_cod_un["319"]='Arrendamiento mercantil';
$renta_cod_un["320"]='Arrendamiento bienes inmuebles';
$renta_cod_un["322"]='Seguros y reaseguros (primas y cesiones)';
$renta_cod_un["323"]='Por rendimientos financieros (No aplica para IFIs)';
$renta_cod_un["332"]='RETENCION PAGOS DE BIENES O SERVICIOS NO SUJETOS A RETENCION';
$renta_cod_un["333"]='RETENCION CONVENIO DE DEBITO O CREDITO';
$renta_cod_un["334"]='RETENCION PAGO CON TARJETA DE CREDITO';
$renta_cod_un["340"]='Otras retenciones aplicables el 1%';
$renta_cod_un["341"]='Otras retenciones aplicables el 2%';
$renta_cod_un["342"]='Otras retenciones aplicables el 8%';
$renta_cod_un["343"]='Otras retenciones aplicables a la tarifa de impuesto a la renta prevista para sociedades';
$renta_cod_un["323A"]='Depositos Cta. Cte.';
$renta_cod_un["323C"]='Por rendimientos financieros:  depositos en cuentas exentas';
$renta_cod_un["336"]='Reembolso de Gasto - Compra Intermediario';
$renta_cod_un["337"]='Reembolso de Gasto - Compra de quien asume el gasto';
$renta_cod_un["347"]='Dividendos anticipados';
$renta_cod_un["501"]='Pago al exterior - Beneficios Empresariales';
$renta_cod_un["502"]='Pago al exterior - Servicios Empresariales';
$renta_cod_un["504"]='Pago al exterior - Dividendos';
$renta_cod_un["505"]='Pago al exterior - Intereses';
$renta_cod_un["506"]='Pago al exterior - Intereses por Finaciamiento de proveedores externos';
$renta_cod_un["507"]='Pago al exterior - Intereses de creditos externos';
$renta_cod_un["508"]='Pago al exterior - Creditos de IFIs organismos y gobierno a gobierno';
$renta_cod_un["511"]='Pago al exterior - Servicios profesionales independientes';
$renta_cod_un["520"]='Pago al exterior - Por otros conceptos';
?>