<?php

function logcarga($archivo,$linea,$error,$sql_codificado,$DB_gogess)
{

$sql_codde=base64_encode($sql_codificado);
$fechahoy=date("Y-m-d H:i:s");
  $insertadata="INSERT INTO factura_logcarga (logcar_archivo, logcar_linea, logcar_error, logcar_fecha,logcar_sql) VALUES
('".$archivo."', '".$linea."', '".$error."', '".$fechahoy."','".$sql_codde."');";
$rs_ok = $DB_gogess->Execute($insertadata);


}

function leercampos_xml($xml)
	{
	  $deco_xml=base64_decode($xml);
	  $struct_detail = new SimpleXMLElement($deco_xml);

       $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente;
	  
	   return $datosrr;
	}


function leercampos_xmlcompra($xml)
	{
	  $deco_xml=base64_decode($xml);
	  $struct_detail = new SimpleXMLElement($deco_xml);

      
	  
	  
      $datosrr["numeroAutorizacion"] = $struct_detail->numeroAutorizacion->__toString();
	  $datosrr["fechaAutorizacion"] = $struct_detail->fechaAutorizacion->__toString();
	  $datosrr["ambiente"] = $struct_detail->ambiente->__toString();
	  
	  
	  $struct_comprobante = new SimpleXMLElement($struct_detail->comprobante);
	  
	 // print_r($struct_comprobante);
	  $datosrr["razonSocial"] = $struct_comprobante->infoTributaria->razonSocial->__toString();
	  $datosrr["ruc"] = $struct_comprobante->infoTributaria->ruc->__toString();
	  $datosrr["cdruc"]='04'; 
	  $datosrr["codDoc"] = $struct_comprobante->infoTributaria->codDoc->__toString();
	  $datosrr["estab"] = $struct_comprobante->infoTributaria->estab->__toString();
	  $datosrr["ptoEmi"] = $struct_comprobante->infoTributaria->ptoEmi->__toString();
	  $datosrr["secuencial"] = $struct_comprobante->infoTributaria->secuencial->__toString();
	  $datosrr["fechaEmision"] = $struct_comprobante->infoFactura->fechaEmision->__toString();
	  
	  $datosrr["facturacmp"]=$datosrr["estab"]."-".$datosrr["ptoEmi"]."-".$datosrr["secuencial"];
	
	  
	   return $datosrr;
	}
	

function leer_contenido_completo($url){
	
	if (file_exists($url)) {
   //abrimos el fichero, puede ser de texto o una URL
   $fichero_url = fopen ($url, "r");
   $texto = "";
   //bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   
	}
	else
{
 echo 'Archivo no existe...';	

}
   return $texto;
}
function leer_xml($estructurado,$xml,$tcomp,$nauto,$fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap)
{
	//echo $pathextrap;
	
     
	switch ($tcomp) {
    case "01":
	    //FACTURA
        $leeplantilla=leer_contenido_completo($pathextrap."../plantillas/factura.php");
        break;
    case "04":
	    //NOTA DE CREDITO
        $leeplantilla=leer_contenido_completo($pathextrap."../plantillas/notacredito.php");
        break;
    case "05":
	    //NOTA DE DEBITO
        $leeplantilla=leer_contenido_completo($pathextrap."../plantillas/notadebito.php");
        break;
    case "06":
	    //GUIA DE REMISION
        $leeplantilla=leer_contenido_completo($pathextrap."../plantillas/guia.php");
        break;		
    case "07":
	    //COMPROBANTE DE RETENCION
        $leeplantilla=leer_contenido_completo($pathextrap."../plantillas/sretencion.php");
        break;			
		
     }
	     
     
     if($estructurado==1)
	 {
	   $struct = new SimpleXMLElement($xml);
        //Extraer xml embebido
		//print_r($struct);
       $xmlstr_detail=$struct->comprobante;	
	   
	   $numeroAutorizacion=$struct->numeroAutorizacion;	
	   $fechaAutorizacion=$struct->fechaAutorizacion;	
	   $ambiente=$struct->ambiente;	
	   
	   $struct_detail = new SimpleXMLElement($xmlstr_detail); 
	   //envia estructura a generador
	   switch ($tcomp) {
			case "01":
				//FACTURA
				$comprobantepdf=lee_factura($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;
			case "04":
				//NOTA DE CREDITO
			   $comprobantepdf=lee_notadecredito($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;
			case "05":
				//NOTA DE DEBITO
				$comprobantepdf=lee_notadedebito($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;
			case "06":
				//GUIA DE REMISION
				$comprobantepdf=lee_guia($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;		
			case "07":
				//COMPROBANTE DE RETENCION
				$comprobantepdf=lee_retencion($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;			
				
			 }
	     //envia estructura a generador
		 
	 }
	 
	 
	 if($estructurado==0)
	 {	 
	  $struct_detail = new SimpleXMLElement($xml);
		 $numeroAutorizacion=$nauto;	
	     $fechaAutorizacion=$fechaaut;
		 //envia estructura a generador
	   switch ($tcomp) {
			case "01":
				//FACTURA
				$comprobantepdf=lee_factura($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;
			case "04":
				//NOTA DE CREDITO
			    $comprobantepdf=lee_notadecredito($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;
			case "05":
				//NOTA DE DEBITO
				$comprobantepdf=lee_notadedebito($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				
				break;
			case "06":
				//GUIA DE REMISION
				$comprobantepdf=lee_guia($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;		
			case "07":
				//COMPROBANTE DE RETENCION
				$comprobantepdf=lee_retencion($struct_detail,$leeplantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total);
				break;			
				
			 }
	     //envia estructura a generador
		 
	 }
  return $comprobantepdf;
}

//-----------------------------------------


function lee_guia($estructura,$plantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total)
{
       global $ambiente_code,$tipoemision_code,$impuesto_code,$tarifaiva_code;
     // print_r($estructura);
	   $ambiente_val=0;
	   //--infoTributaria--//
	   $ambiente=$estructura->infoTributaria->ambiente->__toString();
	   $tipoEmision=$estructura->infoTributaria->tipoEmision->__toString();
	   $razonSocial=$estructura->infoTributaria->razonSocial;
	   $nombreComercial=$estructura->infoTributaria->nombreComercial;
	   $ruc=$estructura->infoTributaria->ruc;
	   $claveAcceso=$estructura->infoTributaria->claveAcceso;
	   $codDoc=$estructura->infoTributaria->codDoc;
	   $estab=$estructura->infoTributaria->estab;
	   $ptoEmi=$estructura->infoTributaria->ptoEmi;
	   $secuencial=$estructura->infoTributaria->secuencial;
	   $dirMatriz=$estructura->infoTributaria->dirMatriz;
	   $razonSocialDestinatario=$estructura->destinatarios->razonSocialDestinatario;
	   
	   //--infoGuiaRemision--//
	  // $fechaEmision=$estructura->infoGuiaRemision->fechaEmision->__toString();
	   
	    $fechaemisionf=explode(" ",$estructura->infoGuiaRemision->fechaEmision->__toString());
		$separafecha=explode("/",$fechaemisionf[0]);
		$nombremes="";
		$nombremes=fecha_mes($separafecha[1]);
		$fechaEmision=$separafecha[0]." - ".$nombremes." - ".$separafecha[2];
	   
	   $rucTransportista=$estructura->infoGuiaRemision->rucTransportista->__toString();
	   
	
	   
	   //--detalles--//
	   
	    $numdetalle=count($estructura->destinatarios->destinatario->detalles->detalle);
		//echo $numdetalle;
		//print_r($estructura->detalles->detalle[1]->codigoPrincipal);
		
		$nporpg=20;
		$npaginas=$numdetalle/$nporpg;
		
		$numero_er=explode(".",$npaginas);
		$numero_entero=$numero_er[0];

		if($numero_er[1]>0)
		{
		  $numtpg=$numero_er[0]+1;
		}
		//$campo_pg[0]=1;
		
		for($pgv=1;$pgv<=$numero_entero;$pgv++)
		{
		  //$campo_pg[$pgv]=$campo_pg[$pgv]+$nporpg-1;
		  $acumulador_mp=$acumulador_mp+$nporpg-1;
		  $campo_pg[$pgv]=$acumulador_mp;
		}
		
		$recidue_final=$numdetalle-$campo_pg[$pgv];
		//$campo_pg[$pgv+1]=$recidue_final;
		
		$fin_pagina=$recidue_final-1;
		//print_r($campo_pg);
		
		$suma=0;
		$sumatotal=0;
		$ipgv=1;
		$numfilas=1; 
	    for($id=0;$id<$numdetalle;$id++)
		  {
		    
			//----------------------------------
			if($id==0)
			{
			 $griddata.='1/'.$numtpg.'<table width="747px"   >
           
             <tr>
			 		<td class="css_bordesbarra">#</td> 	   
                 <td class="css_bordesbarra">Cod. Principal</td>         
				 <td class="css_bordesbarra">Descripci&oacute;n</td>
                 <td class="css_bordesbarra">Cant</td>
                 <td class="css_bordesbarra">Cod. Almacen</td> 
			   
             </tr>';
			}
			//---------------------------------------
			if(in_array($id,$campo_pg))
			{
				$ipgv++;
			  $griddata.='</table>'; 
			  $griddata.='<div style="page-break-after: always;" /></div>'; 
			  $griddata.='Pag:'.$ipgv.'/'.$numtpg.' '.'Guia:'.$estab.'-'.$ptoEmi.'-'.$secuencial.' Raz&oacute;n Social:'.$razonSocialDestinatario.'<table width="747px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 	   
                 <td class="css_bordesbarra">Cod. Principal</td>         
				 <td class="css_bordesbarra">Descripci&oacute;n</td>
                 <td class="css_bordesbarra">Cant</td>
                 <td class="css_bordesbarra">Cod. Almacen</td> 
             </tr>';
			  
			}
		
			//print_r($estructura->detalles->detalle[$id]->impuestos->impuesto->codigo);
			$descriptxt=stripslashes(htmlentities($estructura->destinatarios->destinatario->detalles->detalle[$id]->descripcion));
			
		  $detalladicionaltxt=stripslashes(htmlentities($estructura->destinatarios->destinatario->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
		  
		  
		  
			if(!(trim($detalladicionaltxt)))
			{
				
				$detalladicionaltxt=0;
			}
			
			 $griddata.='<tr>              
               <td bgcolor="#FFFFFF" class="css_bordes">'.$numfilas.'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">'.$estructura->destinatarios->destinatario->detalles->detalle[$id]->codigoInterno.'</td>
			    <td bgcolor="#FFFFFF" class="css_bordes_d">'.$descriptxt.'</td>
               <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->destinatarios->destinatario->detalles->detalle[$id]->cantidad->__toString(), 3, ".", "").'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">'.$detalladicionaltxt.'</td>
			 
             </tr>';
			 $numfilas=$numfilas+1;
			 if($fin_pagina==$id)
			{
			//----------------------
			$griddata.='</table>'; 
			//----------------------
			}
			 
		  }
		
			
	 
	   //--infoAdicional--//
	   $comprobante_code["01"]="FACTURA";
$comprobante_code["04"]="NOTA DE CR&Eacute;DITO";
$comprobante_code["05"]="NOTA DE D&Eacute;BITO";
$comprobante_code["06"]="GU&Iacute;A DE REMISI&Iacute;N";
$comprobante_code["07"]="COMPROBANTE DE RETENCI&Oacute;N";
	 
	
	   //--platilla--//
	     $razonSocial=stripslashes(htmlentities($razonSocial));
	    $condatos=str_replace("-empresa-",$razonSocial,$plantilla);
		
		
		if($dirEstablecimiento)
		{
			$dirEstablecimiento=stripslashes(htmlentities($dirEstablecimiento));
		$condatos=str_replace("-direccion-",$dirEstablecimiento,$condatos);
		}
		else
		{
			$dirMatriz=stripslashes(htmlentities($dirMatriz));  
		$condatos=str_replace("-direccion-",$dirMatriz,$condatos);	
		}
		
		$condatos=str_replace("-ruccliente-",$rucTransportista,$condatos);
	 $razonSocialTransportista=$estructura->infoGuiaRemision->razonSocialTransportista->__toString();
	  $condatos=str_replace("-razonsocial-",$razonSocialTransportista,$condatos); 
	  
      $placa=$estructura->infoGuiaRemision->placa->__toString();
	  $condatos=str_replace("-placa-",$placa,$condatos); 	  
	
	$dirEstablecimiento=$estructura->infoGuiaRemision->dirEstablecimiento->__toString();
	  $condatos=str_replace("-direccion-",$dirEstablecimiento,$condatos);
	
	
	$contribuyenteEspecial=$estructura->infoGuiaRemision->contribuyenteEspecial;
	   $obligadoContabilidad=$estructura->infoGuiaRemision->obligadoContabilidad;
	   
	   $condatos=str_replace("-especial-",$contribuyenteEspecial,$condatos);
		$condatos=str_replace("-obligado-",$obligadoContabilidad,$condatos);
	
	   $dirPartida=$estructura->infoGuiaRemision->dirPartida->__toString();
	  $condatos=str_replace("-partida-",$dirPartida,$condatos);
	
	 $fechaIniTransporte=$estructura->infoGuiaRemision->fechaIniTransporte->__toString();
	  $condatos=str_replace("-fechait-",$fechaIniTransporte,$condatos);
	  
	  $fechaFinTransporte=$estructura->infoGuiaRemision->fechaFinTransporte->__toString();
	  $condatos=str_replace("-fechaft-",$fechaFinTransporte,$condatos);
	  
	  $codDocSustento=$estructura->destinatarios->destinatario->codDocSustento->__toString();
	  $condatos=str_replace("-comprobante-",$comprobante_code[$codDocSustento],$condatos);
	  
	  $numDocSustento=$estructura->destinatarios->destinatario->numDocSustento->__toString();
	  $condatos=str_replace("-numfac-",$numDocSustento,$condatos);
	  
	  $fechaEmisionDocSustento=$estructura->destinatarios->destinatario->fechaEmisionDocSustento->__toString();
	  $condatos=str_replace("-fechaemi-",$fechaEmisionDocSustento,$condatos);
	  
	  
	  $numAutDocSustento=$estructura->destinatarios->destinatario->numAutDocSustento->__toString();
	  $condatos=str_replace("-nautorizacionf-",$numAutDocSustento,$condatos);
	  
	  
	   $motivoTraslado=$estructura->destinatarios->destinatario->motivoTraslado->__toString();
	  $condatos=str_replace("-motivo-",$motivoTraslado,$condatos);
	  
	  
	  $dirDestinatario=$estructura->destinatarios->destinatario->dirDestinatario->__toString();
	  $condatos=str_replace("-destino-",$dirDestinatario,$condatos);
	  
	  $identificacionDestinatario=$estructura->destinatarios->destinatario->identificacionDestinatario->__toString();
	  $condatos=str_replace("-iddestinatario-",$identificacionDestinatario,$condatos);
	  
	  
	  $razonSocialDestinatario=$estructura->destinatarios->destinatario->razonSocialDestinatario->__toString();
	  $condatos=str_replace("-napdestinatario-",$razonSocialDestinatario,$condatos);
	  
	  $codEstabDestino=$estructura->destinatarios->destinatario->codEstabDestino->__toString();
	  $condatos=str_replace("-codigoest-",$codEstabDestino,$condatos);
	  
	  $ruta=$estructura->destinatarios->destinatario->ruta->__toString();
	  $condatos=str_replace("-ruta-",$ruta,$condatos);
	 
	  
		$condatos=str_replace("-especial-",$contribuyenteEspecial,$condatos);
		$condatos=str_replace("-obligado-",$obligadoContabilidad,$condatos);
		$condatos=str_replace("-rucemp-",$ruc,$condatos);		
		$condatos=str_replace("-nfactura-",$estab."-".$ptoEmi."-".$secuencial,$condatos);		
		$condatos=str_replace("-nautorizacion-",$numeroAutorizacion,$condatos);		
		$condatos=str_replace("-fechahoraaut-",$fechaAutorizacion,$condatos);	
		$valamb=$ambiente;
		$condatos=str_replace("-ambiente-",$ambiente_code[$valamb],$condatos);
		$valemi=$tipoEmision;
		$condatos=str_replace("-emision-",$tipoemision_code[$valemi],$condatos);		
		$condatos=str_replace("-claveacceso-",$claveAcceso,$condatos);	
			
			
		
		
		$razonSocialComprador=stripslashes(htmlentities($razonSocialComprador));	
		
		
	   //Lista
	    $condatos=str_replace("-lista-",$griddata,$condatos);
		
		
        $condatos=str_replace("-logo-",$logotipo_imd,$condatos);
		$condatos=str_replace("-barraclave-",$code_barra,$condatos);
		
	
		
		
		for($ib=0;$ib<count($estructura->infoAdicional->campoAdicional);$ib++)
	{
	    $nombrecampo=$estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if($nombrecampo=='direccionComprador')
		{
			  $dirclietxt=stripslashes($estructura->infoAdicional->campoAdicional[$ib]->__toString());
			  $condatos=str_replace("-dircli-",$dirclietxt,$condatos);
			  $dirbandera=1;
		}
		if($nombrecampo=='telefonoComprador')
		{
			 $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-telcli-",$dirclietxt,$condatos);
			  $telbandera=1;
		}
		if($nombrecampo=='CorreoCliente')
		{
			   $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-emailcli-",$dirclietxt,$condatos);
			  $emailbandera=1;
		}
	    if($nombrecampo=='Fechaemisionguia')
		{
			   $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-fechemisionguia-",$dirclietxt,$condatos);
			  $emailbandera=1;
		}
		
	}
	
	if(!($dirbandera))
	{
		 $condatos=str_replace("-dircli-","",$condatos);
	}
	if(!($telbandera))
	{
		 $condatos=str_replace("-telcli-","",$condatos);
	}
	if(!($emailbandera))
	{
		 $condatos=str_replace("-emailcli-","",$condatos);
	}
		
		
	   
	   return $condatos;
}


//-----------------------------------------


function lee_factura($estructura,$plantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total)
{
       global $ambiente_code,$tipoemision_code,$impuesto_code,$tarifaiva_code;
      //print_r($estructura);
	   $ambiente_val=0;
	   $decimales=4;
	   //--infoTributaria--//
	   $ambiente=$estructura->infoTributaria->ambiente->__toString();
	   $tipoEmision=$estructura->infoTributaria->tipoEmision->__toString();
	   $razonSocial=$estructura->infoTributaria->razonSocial;
	   $nombreComercial=$estructura->infoTributaria->nombreComercial;
	   $ruc=$estructura->infoTributaria->ruc;
	   $claveAcceso=$estructura->infoTributaria->claveAcceso;
	   $codDoc=$estructura->infoTributaria->codDoc;
	   $estab=$estructura->infoTributaria->estab;
	   $ptoEmi=$estructura->infoTributaria->ptoEmi;
	   $secuencial=$estructura->infoTributaria->secuencial;
	   $dirMatriz=$estructura->infoTributaria->dirMatriz;
	   
	   //--infoFactura--//
	  // $fechaEmision=$estructura->infoFactura->fechaEmision->__toString();
	   
	    $fechaemisionf=explode(" ",$estructura->infoFactura->fechaEmision->__toString());
		$separafecha=explode("/",$fechaemisionf[0]);
		$nombremes="";
		$nombremes=fecha_mes($separafecha[1]);
		$fechaEmision=$separafecha[0]." - ".$nombremes." - ".$separafecha[2];
	   
	   
	   $dirEstablecimiento=$estructura->infoFactura->dirEstablecimiento;
	   $contribuyenteEspecial=$estructura->infoFactura->contribuyenteEspecial;
	   $obligadoContabilidad=$estructura->infoFactura->obligadoContabilidad;
	   $tipoIdentificacionComprador=$estructura->infoFactura->tipoIdentificacionComprador;
	   $razonSocialComprador=$estructura->infoFactura->razonSocialComprador;
       $identificacionComprador=$estructura->infoFactura->identificacionComprador;
       $totalSinImpuestos=$estructura->infoFactura->totalSinImpuestos->__toString();
       $totalDescuento=$estructura->infoFactura->totalDescuento->__toString();
   
       $numimpuestos=count($estructura->infoFactura->totalConImpuestos->totalImpuesto);
	   $valorconiva='';
	   $numfilas=1;
	     for($ic=0;$ic<$numimpuestos;$ic++)
		  {
		    
			 
			 if($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigo==2)
			 {
				 if($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje==2)
				 {
					$tvalorconiva= $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
					$valorivac=$estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				 }
				 
				 if($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje==0)
				 {
					$tvalorsiniva= $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				 }
				 if($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje==6)
				 {
					$tvalornogravado= $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				 }
				 
				 
				  if($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje==7)
				 {
					$tvalorexentoiva= $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				 }
				 
				 
			 }
		  
		  }
	   
	   //print_r($impuestos_reg);
	   
	   $propina=$estructura->infoFactura->propina->__toString();
	   $importeTotal=$estructura->infoFactura->importeTotal->__toString();
       $moneda=$estructura->infoFactura->moneda;			
	   
	   //--detalles--//
	   
	    $numdetalle=count($estructura->detalles->detalle);
		//echo $numdetalle;
		//print_r($estructura->detalles->detalle[1]->codigoPrincipal);
		
		$nporpg=20;
		$npaginas=$numdetalle/$nporpg;
		
		$numero_er=explode(".",$npaginas);
		$numero_entero=$numero_er[0];

		if($numero_er[1]>0)
		{
		  $numtpg=$numero_er[0]+1;
		}
		//$campo_pg[0]=1;
		
		for($pgv=1;$pgv<=$numero_entero;$pgv++)
		{
		  //$campo_pg[$pgv]=$campo_pg[$pgv]+$nporpg-1;
		  $acumulador_mp=$acumulador_mp+$nporpg-1;
		  $campo_pg[$pgv]=$acumulador_mp;
		}
		
		$recidue_final=$numdetalle-$campo_pg[$pgv];
		//$campo_pg[$pgv+1]=$recidue_final;
		
		$fin_pagina=$recidue_final-1;
		//print_r($campo_pg);
		
		$suma=0;
		$sumatotal=0;
		$ipgv=1;
		$numfilas=1;
	    for($id=0;$id<$numdetalle;$id++)
		  {
		    
			//----------------------------------
			if($id==0)
			{
			 $griddata.='1/'.$numtpg.'<table width="747px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Cod Almacen</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto 1 %</td>
			   <td class="css_bordesbarra">Dscto 2 %</td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
			}
			//---------------------------------------
			if(in_array($id,$campo_pg))
			{
				$ipgv++;
			  $griddata.='</table>'; 
			  $griddata.='<div style="page-break-after: always;" /></div>'; 
			  $griddata.='Pag:'.$ipgv.'/'.$numtpg.' '.'Fac:'.$estab.'-'.$ptoEmi.'-'.$secuencial.' Raz&oacute;n Social:'.$razonSocialComprador.'<table width="747px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Cod Almacen</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto 1 %</td>
			   <td class="css_bordesbarra">Dscto 2 %</td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
			  
			}
		  
			$descriptxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->descripcion));
			$detalladicionaltxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if(!(trim($detalladicionaltxt)))
			{
				
				$detalladicionaltxt=0;
			}
			
			
			$detalladicionaltx=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
			if($detalladicionaltx!="InformacionAdicional2")
		     { 
			$detalladicionaltxt2=0;
				
			}
			$detalladicionaltx=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
			if($detalladicionaltx=="InformacionAdicional3")
		     { 
			
			$detalladicionaltxt3=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			$detalladicionaltxt2=0;
			if(!(trim($detalladicionaltxt3)))
			{
				
				$detalladicionaltxt3=0;
				
			}
				
				
				
				
			} 
			
			$detalladicionaltx=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
			if($detalladicionaltx=="InformacionAdicional3")
		     { 
			
			$detalladicionaltxt3=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));
			
			if(!(trim($detalladicionaltxt3)))
			{
				
				$detalladicionaltxt3=0;
				
			}
				
			$detalladicionaltxt2=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			if(!(trim($detalladicionaltxt2)))
			{
				
				$detalladicionaltxt2=0;
			}	
				
				
			} 
			
			
			
			
			 $griddata.='<tr>              
               <td bgcolor="#FFFFFF" class="css_bordes">'.$numfilas.'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">'.$estructura->detalles->detalle[$id]->codigoPrincipal.'</td>
               <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "").'</td>
               <td bgcolor="#FFFFFF" class="css_bordes_d">'.$descriptxt.'</td>
			  <td bgcolor="#FFFFFF" class="css_bordes_d">'.$detalladicionaltxt3.'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->detalles->detalle[$id]->precioUnitario->__toString(), 4, ".", ",").'</td> 
			   <td bgcolor="#FFFFFF" class="css_bordes_d">'.$detalladicionaltxt.'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes_d">'.$detalladicionaltxt2.'</td>
			   
			   
                <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",").'</td> 
			    <td bgcolor="#FFFFFF" class="css_bordes_d">'.$tarifaiva_code[$estructura->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString()].'</td>';
			    $griddata.='</td>            
               <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(), $decimales, ".", ",").'</td>
             </tr>';
			 $numfilas=$numfilas+1;
			 if($fin_pagina==$id)
			{
			//----------------------
			$griddata.='</table>'; 
			//----------------------
			}
			 
		  }
		
			
	
	   //--infoAdicional--//
	  
	   
	   
	   //--platilla--//
	     $razonSocial=stripslashes(htmlentities($razonSocial));
	    $condatos=str_replace("-empresa-",$razonSocial,$plantilla);
		
		
		if($dirEstablecimiento)
		{
			$dirEstablecimiento=stripslashes(htmlentities($dirEstablecimiento));
		$condatos=str_replace("-direccion-",$dirEstablecimiento,$condatos);
		}
		else
		{
			$dirMatriz=stripslashes(htmlentities($dirMatriz));  
		$condatos=str_replace("-direccion-",$dirMatriz,$condatos);	
		}
		
		
		$condatos=str_replace("-especial-",$contribuyenteEspecial,$condatos);
		$condatos=str_replace("-obligado-",$obligadoContabilidad,$condatos);
		$condatos=str_replace("-rucemp-",$ruc,$condatos);		
		$condatos=str_replace("-nfactura-",$estab."-".$ptoEmi."-".$secuencial,$condatos);		
		$condatos=str_replace("-nautorizacion-",$numeroAutorizacion,$condatos);		
		$condatos=str_replace("-fechahoraaut-",$fechaAutorizacion,$condatos);	
		$valamb=$ambiente;
		$condatos=str_replace("-ambiente-",$ambiente_code[$valamb],$condatos);
		$valemi=$tipoEmision;
		$condatos=str_replace("-emision-",$tipoemision_code[$valemi],$condatos);		
		$condatos=str_replace("-claveacceso-",$claveAcceso,$condatos);		
		$condatos=str_replace("-ruccliente-",$identificacionComprador,$condatos);	
		
		$razonSocialComprador=stripslashes(htmlentities($razonSocialComprador));	
		$condatos=str_replace("-razonsocial-",$razonSocialComprador,$condatos);
		
		$condatos=str_replace("-fechaemision-",$fechaEmision,$condatos);	
		
		$condatos=str_replace("-total-",number_format($importeTotal, 2, ".", ","),$condatos);
	   //Lista
	    $condatos=str_replace("-lista-",$griddata,$condatos);
		
		//print_r($tvalorconiva);
		$sumatotal=$tvalorconiva+$tvalorsiniva+$totalDescuento;
		$subsinimp=$tvalorconiva+$tvalorsiniva;
		$condatos=str_replace("-suma-",number_format($sumatotal, 2, ".", ","),$condatos);
		$condatos=str_replace("-subtotal-",number_format($tvalorconiva, 2, ".", ","),$condatos);
		
		$condatos=str_replace("-subtotalsiniva-",number_format($tvalorsiniva, 2, ".", ","),$condatos);
		
		$condatos=str_replace("-subtotalnograbado-",number_format($tvalornogravado, 2, ".", ","),$condatos);
		$condatos=str_replace("-subsinimp-",number_format($subsinimp, 2, ".", ","),$condatos);
		$condatos=str_replace("-subtotalexento-",number_format($tvalorexentoiva, 2, ".", ","),$condatos);
		
		
		$condatos=str_replace("-subtotalexeiva-",number_format($tvalorexentoiva, $decimales, ".", ","),$condatos);
		$condatos=str_replace("-iva-",number_format($valorivac, 2, ".", ","),$condatos);
		
		
		$condatos=str_replace("-descuento-",number_format($totalDescuento, 2, ".", ","),$condatos);
		$condatos=str_replace("-logo-",$logotipo_imd,$condatos);
		$condatos=str_replace("-barraclave-",$code_barra,$condatos);
		
		$condatos=str_replace("-subtotalsinimp-",$totalSinImpuestos,$condatos);
		
	
		
		
		for($ib=0;$ib<count($estructura->infoAdicional->campoAdicional);$ib++)
	{
	    $nombrecampo=$estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if($nombrecampo=='direccionComprador')
		{
			  $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-dircli-",$dirclietxt,$condatos);
			  $dirbandera=1;
		}
		if($nombrecampo=='telefonoComprador')
		{
			 $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-telcli-",$dirclietxt,$condatos);
			  $telbandera=1;
		}
		if($nombrecampo=='CorreoCliente')
		{
			   $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-emailcli-",$dirclietxt,$condatos);
			  $emailbandera=1;
		}
		
		if($nombrecampo=='ordenCompra')
		{
			   $op1=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()))."<br>";
			 
		}
		
		if($nombrecampo=='op2')
		{
			   $op2=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()))."<br>";
			  
		}
		
		if($nombrecampo=='op3')
		{
			   $op3=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()))."<br>";
			  
		}
	
		
	}
	
	$condatos=str_replace("-op-",$op1.$op2.$op3,$condatos);
	
	if(!($dirbandera))
	{
		 $condatos=str_replace("-dircli-","",$condatos);
	}
	if(!($telbandera))
	{
		 $condatos=str_replace("-telcli-","",$condatos);
	}
	if(!($emailbandera))
	{
		 $condatos=str_replace("-emailcli-","",$condatos);
	}
		
		
	   
	   return $condatos;
}

//NOTA DE CREDITO

function lee_notadecredito($estructura,$plantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total)
{
       global $ambiente_code,$tipoemision_code,$impuesto_code,$tarifaiva_code,$comprobante_code;
       //print_r($estructura);
	   $ambiente_val=0;
	   $decimales=4;
	   //--infoTributaria--//
	   $ambiente=$estructura->infoTributaria->ambiente->__toString();
	   $tipoEmision=$estructura->infoTributaria->tipoEmision->__toString();
	   $razonSocial=$estructura->infoTributaria->razonSocial;
	   $nombreComercial=$estructura->infoTributaria->nombreComercial;
	   $ruc=$estructura->infoTributaria->ruc;
	   $claveAcceso=$estructura->infoTributaria->claveAcceso;
	   $codDoc=$estructura->infoTributaria->codDoc;
	   $estab=$estructura->infoTributaria->estab;
	   $ptoEmi=$estructura->infoTributaria->ptoEmi;
	   $secuencial=$estructura->infoTributaria->secuencial;
	   $dirMatriz=$estructura->infoTributaria->dirMatriz;
	   
	   //--infoNotaCredito--//
	   $fechaEmision=$estructura->infoNotaCredito->fechaEmision->__toString();
	   
	    $fechaemisionf=explode(" ",$fechaEmision);
		$separafecha=explode("/",$fechaemisionf[0]);
		$nombremes="";
		$nombremes=fecha_mes($separafecha[1]);
		$fecheemidoc=$separafecha[0]." - ".$nombremes." - ".$separafecha[2];
	   
	   
	   $dirEstablecimiento=$estructura->infoNotaCredito->dirEstablecimiento;
	   $contribuyenteEspecial=$estructura->infoNotaCredito->contribuyenteEspecial;
	   $obligadoContabilidad=$estructura->infoNotaCredito->obligadoContabilidad;
	   
	    $codDocModificado=$estructura->infoNotaCredito->codDocModificado->__toString();
		$numDocModificado=$estructura->infoNotaCredito->numDocModificado;
	   // $fechaEmisionDocSustento=$estructura->infoNotaCredito->fechaEmisionDocSustento->__toString();
		
		
		 $fechaemisiondf=explode(" ",$estructura->infoNotaCredito->fechaEmisionDocSustento->__toString());
		$separafecha=explode("/",$fechaemisiondf[0]);
		$nombremes="";
		$nombremes=fecha_mes($separafecha[1]);
		$fechaEmisionDocSustento=$separafecha[0]." - ".$nombremes." - ".$separafecha[2];
		
	   
	   $tipoIdentificacionComprador=$estructura->infoNotaCredito->tipoIdentificacionComprador;
	   $razonSocialComprador=$estructura->infoNotaCredito->razonSocialComprador;
       $identificacionComprador=$estructura->infoNotaCredito->identificacionComprador;
       $totalSinImpuestos=$estructura->infoNotaCredito->totalSinImpuestos->__toString();
	        
       $valorModificacion=$estructura->infoNotaCredito->valorModificacion->__toString();
   
    $moneda=$estructura->infoNotaCredito->moneda->__toString();
   
       $numimpuestos=count($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto);
	   $valorconiva='';
	     for($ic=0;$ic<$numimpuestos;$ic++)
		  {
		    
			 
			 if($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigo==2)
			 {
				 if($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje==2)
				 {
					$tvalorconiva= $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
					$valorivac=$estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				 }
				 
				 if($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje==0)
				 {
					$tvalorsiniva= $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				 }
				 if($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje==6)
				 {
					$tvalornogravado= $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				 }
				 
				 if($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje==7)
				 {
					$tvalorexentoiva= $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				 }
				 
				 
			 }
		  
		  }
	   
	   //print_r($impuestos_reg);
	   $motivo=$estructura->infoNotaCredito->motivo->__toString();
	  
	  $importeTotal=$estructura->infoNotaCredito->valorModificacion->__toString();
       //$moneda=$estructura->infoNotaCredito->moneda;			
	   
	   //--detalles--//
	   
	    $numdetalle=count($estructura->detalles->detalle);
		//echo $numdetalle;
		
		$nporpg=15;
		$npaginas=$numdetalle/$nporpg;
		
		$numero_er=explode(".",$npaginas);
		$numero_entero=$numero_er[0];

		if($numero_er[1]>0)
		{
		  $numtpg=$numero_er[0]+1;
		}
		//$campo_pg[0]=1;
		
		for($pgv=1;$pgv<=$numero_entero;$pgv++)
		{
		 // $campo_pg[$pgv]=$campo_pg[$pgv]+$nporpg-1;
		  $acumulador_mp=$acumulador_mp+$nporpg-1;
		  $campo_pg[$pgv]=$acumulador_mp;
		}
		
		$recidue_final=$numdetalle-$campo_pg[$pgv];
		//$campo_pg[$pgv+1]=$recidue_final;
		
		$fin_pagina=$recidue_final-1;
		
		
		$suma=0;
		$sumatotal=0;
		$ipgv=1;
		//print_r($estructura->detalles->detalle[1]->codigoPrincipal);
		
		
         
		 
		$numfilas=1;
	    for($id=0;$id<$numdetalle;$id++)
		  {
			  
if($id==0)
			{
			  $griddata.='1/'.$numtpg.'<table width="747px">
          
             <tr>
			 			   
               <td class="css_bordesbarra">#</td>
			   <td class="css_bordesbarra">Cod</td>			   
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Cod. Almacen</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto 1 %</td>
			   <td class="css_bordesbarra">Dscto 2 %</td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
			}
			
			if(in_array($id,$campo_pg))
			{
				 $griddata.='</table>';
				  $griddata.='<div style="page-break-after: always;" /></div>'; 
				 $griddata.='Pag:'.$ipgv.'/'.$numtpg.' '.'Cre:'.$estab.'-'.$ptoEmi.'-'.$secuencial.' Raz&oacute;n Social:'.$razonSocialComprador.'<table width="747px">
        
             <tr>
			 			   
               <td class="css_bordesbarra">#</td>
			   <td class="css_bordesbarra">Cod</td>			   
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Cod. Almacen</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto 1 %</td>
			   <td class="css_bordesbarra">Dscto 2 %</td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
				
			}	
			  
		    // echo $estructura->detalles->detalle[$id]["codigoPrincipal"];
			// echo $estructura->detalles->detalle[$id]["descripcion"];
			// echo $estructura->detalles->detalle[$id]["cantidad"];
			// echo $estructura->detalles->detalle[$id]["precioUnitario"];
			// echo $estructura->detalles->detalle[$id]["descuento"];
			// echo $estructura->detalles->detalle[$id]["precioTotalSinImpuesto"];
			//print_r($estructura->detalles->detalle[$id]->impuestos->impuesto->codigo);
			$descriptxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->descripcion));
			//$detalladicionaltxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional["valor"]));
			
			
			//$detalladicionaltxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			//if(!(trim($detalladicionaltxt)))
			//{
				
			//	$detalladicionaltxt=0;
			//}
			//$detalladicionaltxt2=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			//if(!(trim($detalladicionaltxt2)))
			///{
				
				//$detalladicionaltxt2=0;
			//}
			
			
			$descriptxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->descripcion));
			$detalladicionaltxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if(!(trim($detalladicionaltxt)))
			{
				
				$detalladicionaltxt=0;
			}
			
			$detalladicionaltx=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
			if($detalladicionaltx=="InformacionAdicional2")
		     { 
			
			$detalladicionaltxt2=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			$detalladicionaltxt=0;
			if(!(trim($detalladicionaltxt2)))
			{
				
				$detalladicionaltxt2=0;
				
			}
				
				
			} 
			
			$detalladicionaltx=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
			if($detalladicionaltx=="InformacionAdicional3")
		     { 
			
			$detalladicionaltxt3=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			$detalladicionaltxt=0;
			if(!(trim($detalladicionaltxt3)))
			{
				
				$detalladicionaltxt3=0;
				
			}
				
				
				
				
			} 
			
			$detalladicionaltx=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
			if($detalladicionaltx=="InformacionAdicional2")
		     { 
			
			$detalladicionaltxt2=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			//$detalladicionaltxt=0;
			if(!(trim($detalladicionaltxt2)))
			{
				
				$detalladicionaltxt2=0;
				
			}
				
				
				
				
			} 
			 
			 
			
			$detalladicionaltx=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
			if($detalladicionaltx=="InformacionAdicional3")
		     { 
			
			$detalladicionaltxt3=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			$detalladicionaltxt2=0;
			if(!(trim($detalladicionaltxt3)))
			{
				
				$detalladicionaltxt3=0;
				
			}
				
				
				
				
			} 
			
			$detalladicionaltx=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
			if($detalladicionaltx=="InformacionAdicional3")
		     { 
			
			$detalladicionaltxt3=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));
			
			if(!(trim($detalladicionaltxt3)))
			{
				
				$detalladicionaltxt3=0;
				
			}
			}	
			

			
			
			 $griddata.='<tr>              
			   <td bgcolor="#FFFFFF" class="css_bordes">'.$numfilas.'</td>
               <td bgcolor="#FFFFFF" class="css_bordes">'.$estructura->detalles->detalle[$id]->codigoInterno.'</td>
               <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "").'</td>
               <td bgcolor="#FFFFFF" class="css_bordes_d">'.$descriptxt.'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes_d">'.$detalladicionaltxt3.'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->detalles->detalle[$id]->precioUnitario->__toString(), $decimales, ".", ",").'</td>  
			   <td bgcolor="#FFFFFF" class="css_bordes_d">'.$detalladicionaltxt.'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes_d">'.$detalladicionaltxt2.'</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",").'</td> 
			   
			   <td bgcolor="#FFFFFF" class="css_bordes_d">'.$tarifaiva_code[$estructura->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString()].'</td>';
			    $griddata.='</td>
                            
               <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(),$decimales, ".", ",").'</td>
             </tr>';
			
			 $numfilas=$numfilas+1;
			 
			 
			 if($fin_pagina==$id)
			{
			//----------------------
			$griddata.='</table>'; 
			//----------------------
			}
			
		  }
		
	
	   //--infoAdicional--//
	   
	 
	   
	   
	   //--platilla--//
	    $razonSocial=stripslashes(htmlentities($razonSocial));
	    $condatos=str_replace("-empresa-",$razonSocial,$plantilla);
		
		
		if($dirEstablecimiento)
		{
			$dirEstablecimiento=stripslashes(htmlentities($dirEstablecimiento));
		$condatos=str_replace("-direccion-",$dirEstablecimiento,$condatos);
		}
		else
		{
			$dirMatriz=stripslashes(htmlentities($dirMatriz));  
		$condatos=str_replace("-direccion-",$dirMatriz,$condatos);	
		}
		
		
		$condatos=str_replace("-especial-",$contribuyenteEspecial,$condatos);
		$condatos=str_replace("-obligado-",$obligadoContabilidad,$condatos);
		$condatos=str_replace("-rucemp-",$ruc,$condatos);		
		$condatos=str_replace("-ndocumento-",$estab."-".$ptoEmi."-".$secuencial,$condatos);		
		$condatos=str_replace("-nautorizacion-",$numeroAutorizacion,$condatos);		
		$condatos=str_replace("-fechahoraaut-",$fechaAutorizacion,$condatos);	
		$valamb=$ambiente;
		$condatos=str_replace("-ambiente-",$ambiente_code[$valamb],$condatos);
		$valemi=$tipoEmision;
		
		$condatos=str_replace("-emision-",$tipoemision_code[$valemi],$condatos);		
		$condatos=str_replace("-claveacceso-",$claveAcceso,$condatos);		
		$condatos=str_replace("-ruccliente-",$identificacionComprador,$condatos);	
		
		$razonSocialComprador=stripslashes(htmlentities($razonSocialComprador));	
		$condatos=str_replace("-razonsocial-",$razonSocialComprador,$condatos);
		
		$condatos=str_replace("-fechaemision-",$fecheemidoc,$condatos);	
		$condatos=str_replace("-subtotalsinimp-",$totalSinImpuestos,$condatos);
		
		
		//comprobante de sustento
		
		
		$condatos=str_replace("-tipocomprobante-",$comprobante_code[$codDocModificado],$condatos);	
        $condatos=str_replace("-ncomprobante-",$numDocModificado,$condatos);	
        $condatos=str_replace("-fechacomprobante-",$fechaEmisionDocSustento,$condatos);	
        $condatos=str_replace("-razon-",$motivo,$condatos);
		
		//comprobante de sustento
		
		
	   //Lista
	    $condatos=str_replace("-lista-",$griddata,$condatos);
		$sumatotal=$tvalorconiva+$tvalorsiniva+$totalDescuento;
		$subsinimp=$tvalorconiva+$tvalorsiniva;
		
		
		//print_r($tvalorconiva);
		$condatos=str_replace("-suma-",number_format($sumatotal, 2, ".", ","),$condatos);
		$condatos=str_replace("-subtotal-",number_format($tvalorconiva, 2, ".", ","),$condatos);
		$condatos=str_replace("-subtotalsiniva-",number_format($tvalorsiniva, 2, ".", ","),$condatos);
		$condatos=str_replace("-subtotalnograbado-",number_format($tvalornogravado, 2, ".", ","),$condatos);
		$condatos=str_replace("-subsinimp-",number_format($subsinimp, 2, ".", ","),$condatos);
		$condatos=str_replace("-subtotalexento-",number_format($tvalorexentoiva, 2, ".", ","),$condatos);
		$condatos=str_replace("-iva-",number_format($valorivac, 2, ".", ","),$condatos);
		$condatos=str_replace("-descuento-",number_format($totalDescuento, 2, ".", ","),$condatos);
		
		
		$condatos=str_replace("-total-",number_format($importeTotal, 2, ".", ","),$condatos);
        $condatos=str_replace("-logo-",$logotipo_imd,$condatos);
		$condatos=str_replace("-barraclave-",$code_barra,$condatos);
		
	
		
		
		
		for($ib=0;$ib<count($estructura->infoAdicional->campoAdicional);$ib++)
	{
	    $nombrecampo=$estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if($nombrecampo=='direccionComprador')
		{
			  $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-dircli-",$dirclietxt,$condatos);
			  $dirbandera=1;
		}
		if($nombrecampo=='telefonoComprador')
		{
			 $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-telcli-",$dirclietxt,$condatos);
			  $telbandera=1;
		}
		if($nombrecampo=='CorreoCliente')
		{
			   $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-emailcli-",$dirclietxt,$condatos);
			  $emailbandera=1;
		}
	
		if($nombrecampo=='op1')
		{
			   $op1=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()))."<br>";
			 
		}
		
		if($nombrecampo=='op2')
		{
			   $op2=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()))."<br>";
			  
		}
		
		if($nombrecampo=='op3')
		{
			   $op3=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()))."<br>";
			  
		}
	}
	$condatos=str_replace("-op-",$op1.$op2.$op3,$condatos);
	if(!($dirbandera))
	{
		 $condatos=str_replace("-dircli-","",$condatos);
	}
	if(!($telbandera))
	{
		 $condatos=str_replace("-telcli-","",$condatos);
	}
	if(!($emailbandera))
	{
		 $condatos=str_replace("-emailcli-","",$condatos);
	}
		
		
	   
	   return $condatos;
}

//NOTA DE DEBITO

function lee_notadedebito($estructura,$plantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total)
{
       global $ambiente_code,$tipoemision_code,$impuesto_code,$tarifaiva_code,$comprobante_code;
       //print_r($estructura);
	   $ambiente_val=0;
	   //--infoTributaria--//
	   $ambiente=$estructura->infoTributaria->ambiente->__toString();
	   $tipoEmision=$estructura->infoTributaria->tipoEmision->__toString();
	   $razonSocial=$estructura->infoTributaria->razonSocial;
	   $nombreComercial=$estructura->infoTributaria->nombreComercial;
	   $ruc=$estructura->infoTributaria->ruc;
	   $claveAcceso=$estructura->infoTributaria->claveAcceso;
	   $codDoc=$estructura->infoTributaria->codDoc;
	   $estab=$estructura->infoTributaria->estab;
	   $ptoEmi=$estructura->infoTributaria->ptoEmi;
	   $secuencial=$estructura->infoTributaria->secuencial;
	   $dirMatriz=$estructura->infoTributaria->dirMatriz;
	   
	   //--infoNotaDebito--//
	   //$fechaEmision=$estructura->infoNotaDebito->fechaEmision->__toString();
	   
	    $fechaemisiocl=explode(" ",$estructura->infoNotaDebito->fechaEmision->__toString());
		$separafecha=explode("/",$fechaemisiocl[0]);
		$nombremes="";
		$nombremes=fecha_mes($separafecha[1]);
		$fechaEmision=$separafecha[0]." - ".$nombremes." - ".$separafecha[2];
	   
	   $dirEstablecimiento=$estructura->infoNotaDebito->dirEstablecimiento;
	   $tipoIdentificacionComprador=$estructura->infoNotaDebito->tipoIdentificacionComprador;
	   $razonSocialComprador=$estructura->infoNotaDebito->razonSocialComprador;
       $identificacionComprador=$estructura->infoNotaDebito->identificacionComprador;
	   $contribuyenteEspecial=$estructura->infoNotaDebito->contribuyenteEspecial;
	   $obligadoContabilidad=$estructura->infoNotaDebito->obligadoContabilidad;
	  
	  $codDocModificado=$estructura->infoNotaDebito->codDocModificado->__toString();
	  
	  
	  $numDocModificado=$estructura->infoNotaDebito->numDocModificado;
	  //$fechaEmisionDocSustento=$estructura->infoNotaDebito->fechaEmisionDocSustento->__toString();
	  
	    $fechaemisionds=explode(" ",$estructura->infoNotaDebito->fechaEmisionDocSustento->__toString());
		$separafecha=explode("/",$fechaemisionds[0]);
		$nombremes="";
		$nombremes=fecha_mes($separafecha[1]);
		$fechaEmisionDocSustento=$separafecha[0]." - ".$nombremes." - ".$separafecha[2];
		
		
	   
       $totalSinImpuestos=$estructura->infoNotaDebito->totalSinImpuestos->__toString();
       $totalDescuento=$estructura->infoNotaDebito->totalDescuento->__toString();
   
       $numimpuestos=count($estructura->infoNotaDebito->impuestos->impuesto);
	   $valorconiva='';
	     for($ic=0;$ic<$numimpuestos;$ic++)
		  {
		    
			 
			 if($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigo==2)
			 {
				 if($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje==2)
				 {
					$tvalorconiva= $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
					$valorivac=$estructura->infoNotaDebito->impuestos->impuesto[$ic]->valor->__toString();
				 }
				 
				 if($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje==0)
				 {
					$tvalorsiniva= $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
				 }
				 if($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje==6)
				 {
					$tvalornogravado= $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
				 }
				 
				 if($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje==7)
				 {
					$tvalorexentoiva= $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
				 }
				 
				 
			 }
		  
		  }
	   
	   //print_r($impuestos_reg);
	   
	   $propina=$estructura->infoNotaDebito->propina->__toString();
	   $importeTotal=$estructura->infoNotaDebito->valorTotal->__toString();
       $moneda=$estructura->infoNotaDebito->moneda;			
	   
	   //--detalles--//
	   
	    $numdetalle=count($estructura->detalles->detalle);
		//echo $numdetalle;
		//print_r($estructura->detalles->detalle[1]->codigoPrincipal);
		
		
	   //--infoAdicional--//
	   
	 
	   
	   
	   //--platilla--//
	     $razonSocial=stripslashes(htmlentities($razonSocial));
	    $condatos=str_replace("-empresa-",$razonSocial,$plantilla);
		
		
		if($dirEstablecimiento)
		{
			$dirEstablecimiento=stripslashes(htmlentities($dirEstablecimiento));
		$condatos=str_replace("-direccion-",$dirEstablecimiento,$condatos);
		}
		else
		{
			$dirMatriz=stripslashes(htmlentities($dirMatriz));  
		$condatos=str_replace("-direccion-",$dirMatriz,$condatos);	
		}
		
		
		$condatos=str_replace("-especial-",$contribuyenteEspecial,$condatos);
		$condatos=str_replace("-obligado-",$obligadoContabilidad,$condatos);
		$condatos=str_replace("-rucemp-",$ruc,$condatos);		
		$condatos=str_replace("-ndocumento-",$estab."-".$ptoEmi."-".$secuencial,$condatos);		
		$condatos=str_replace("-nautorizacion-",$numeroAutorizacion,$condatos);		
		$condatos=str_replace("-fechahoraaut-",$fechaAutorizacion,$condatos);	
		$valamb=$ambiente;
		$condatos=str_replace("-ambiente-",$ambiente_code[$valamb],$condatos);
		$valemi=$tipoEmision;
		$condatos=str_replace("-emision-",$tipoemision_code[$valemi],$condatos);		
		$condatos=str_replace("-claveacceso-",$claveAcceso,$condatos);		
		$condatos=str_replace("-ruccliente-",$identificacionComprador,$condatos);	
		
		$razonSocialComprador=stripslashes(htmlentities($razonSocialComprador));	
		$condatos=str_replace("-razonsocial-",$razonSocialComprador,$condatos);
		
		$condatos=str_replace("-fechaemision-",$fechaEmision,$condatos);	
		
		$condatos=str_replace("-total-",number_format($importeTotal, 2, ".", ","),$condatos);
		
		//comprobante de sustento

		$condatos=str_replace("-tipocomprobante-",$comprobante_code[$codDocModificado],$condatos);	
        $condatos=str_replace("-ncomprobante-",$numDocModificado,$condatos);	
        $condatos=str_replace("-fechacomprobante-",$fechaEmisionDocSustento,$condatos);	
        
		
		//comprobante de sustento
		
		
	   //Lista
	    $condatos=str_replace("-lista-",$griddata,$condatos);
		
		//print_r($tvalorconiva);
		$condatos=str_replace("-subtotal-",number_format($tvalorconiva, 2, ".", ","),$condatos);
		
		$condatos=str_replace("-subtotalsiniva-",number_format($tvalorsiniva, 2, ".", ","),$condatos);
		$condatos=str_replace("-subtotalexeiva-",number_format($tvalorexentoiva, 2, ".", ","),$condatos);
		$condatos=str_replace("-subtotalnograbado-",number_format($tvalornogravado, 2, ".", ","),$condatos);
		$condatos=str_replace("-iva-",number_format($valorivac, 2, ".", ","),$condatos);
		$condatos=str_replace("-descuento-",number_format($totalDescuento, 2, ".", ","),$condatos);
        $condatos=str_replace("-logo-",$logotipo_imd,$condatos);
		$condatos=str_replace("-barraclave-",$code_barra,$condatos);
		
	   echo count($estructura->infoAdicional->campoAdicional);
	
	$dirbandera=0;
	$telbandera=0;
	$emailbandera=0;
	for($ib=0;$ib<count($estructura->infoAdicional->campoAdicional);$ib++)
	{
	    $nombrecampo=$estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if($nombrecampo=='direccionComprador')
		{
			  $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-dircli-",$dirclietxt,$condatos);
			  $dirbandera=1;
		}
		if($nombrecampo=='telefonoComprador')
		{
			 $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-telcli-",$dirclietxt,$condatos);
			  $telbandera=1;
		}
		if($nombrecampo=='CorreoCliente')
		{
			   $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			  $condatos=str_replace("-emailcli-",$dirclietxt,$condatos);
			  $emailbandera=1;
		}
	
		
	}
	
	if(!($dirbandera))
	{
		 $condatos=str_replace("-dircli-","",$condatos);
	}
	if(!($telbandera))
	{
		 $condatos=str_replace("-telcli-","",$condatos);
	}
	if(!($emailbandera))
	{
		 $condatos=str_replace("-emailcli-","",$condatos);
	}
	
	 //  $estructura->infoAdicional->campoAdicional[3]["nombre"]->__toString()
	

		
	   
	   return $condatos;
}

//RETENCIONES


function lee_retencion($estructura,$plantilla,$numeroAutorizacion,$fechaAutorizacion,$logotipo_imd,$code_barra)
{
       global $ambiente_code,$tipoemision_code,$impuesto_code,$tarifaiva_code,$retencion_code,$comprobante_code,$renta_cod_un;
       //print_r($renta_cod_un);
	   $ambiente_val=0;
	   //--infoTributaria--//
	   $ambiente=$estructura->infoTributaria->ambiente->__toString();
	   $tipoEmision=$estructura->infoTributaria->tipoEmision->__toString();
	   $razonSocial=$estructura->infoTributaria->razonSocial;
	   $nombreComercial=$estructura->infoTributaria->nombreComercial;
	   $ruc=$estructura->infoTributaria->ruc;
	   $claveAcceso=$estructura->infoTributaria->claveAcceso;
	   $codDoc=$estructura->infoTributaria->codDoc;
	   $estab=$estructura->infoTributaria->estab;
	   $ptoEmi=$estructura->infoTributaria->ptoEmi;
	   $secuencial=$estructura->infoTributaria->secuencial;
	   $dirMatriz=$estructura->infoTributaria->dirMatriz;
	   
	   //--infoCompRetencion--//
	
	   
	   
	    $fechaemisionds=explode(" ",$estructura->infoCompRetencion->fechaEmision->__toString());
		$separafecha=explode("/",$fechaemisionds[0]);
		$nombremes="";
		$nombremes=fecha_mes($separafecha[1]);
		$fechaEmision=$separafecha[0]." - ".$nombremes." - ".$separafecha[2];
	   
	   
	   $dirEstablecimiento=$estructura->infoCompRetencion->dirEstablecimiento;
	   $contribuyenteEspecial=$estructura->infoCompRetencion->contribuyenteEspecial;
	   $obligadoContabilidad=$estructura->infoCompRetencion->obligadoContabilidad;
	  
	   $tipoIdentificacionSujetoRetenido=$estructura->infoCompRetencion->tipoIdentificacionSujetoRetenido;
	   $razonSocialSujetoRetenido=$estructura->infoCompRetencion->razonSocialSujetoRetenido;
       $identificacionSujetoRetenido=$estructura->infoCompRetencion->identificacionSujetoRetenido;
	   $periodoFiscal=$estructura->infoCompRetencion->periodoFiscal;
	   
       $totalSinImpuestos=$estructura->infoCompRetencion->totalSinImpuestos->__toString();
       $totalDescuento=$estructura->infoCompRetencion->totalDescuento->__toString();
	   

	   
	   //print_r($impuestos_reg);
	   
	   $propina=$estructura->infoCompRetencion->propina->__toString();
	   $importeTotal=$estructura->infoCompRetencion->importeTotal->__toString();
       $moneda=$estructura->infoCompRetencion->moneda;		
	   
	   
	   
	   //--info adicional--//
	   
	   	
	   //print_r($estructura->infoAdicional->campoAdicional[0]["nombre"]->__toString());
	   $iad=0;
	   $numfilas=1;
	   for($ib=0;$ib<count($estructura->infoAdicional->campoAdicional);$ib++)
	   {
		   //echo $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString(); 
		    
		   $pos =0;
		   $pos = strpos($estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString(),"formacionAdicio");
		   
		   if($pos)
		   {
			   $adicion[$iad]=$estructura->infoAdicional->campoAdicional[$ib]->__toString();
			    
		   }
		   //echo $pos."<br>";
		   //----------------------------------------
		   
	
		   
		   //----------------------------------------
		   $iad++;
	   }
	  
	
	   //--detalles--//
	   
	    $numimpuesto=count($estructura->impuestos->impuesto);
		//echo $numdetalle;
		//print_r($estructura->detalles->detalle[1]->codigoPrincipal);
		//<th class="css_bordesbarra">Comprobante</th>
						 // <th class="css_bordesbarra">N&uacute;mero</th>
						 //  <th class="css_bordesbarra">Fecha de emisi&oacute;n</th>
						 // <th class="css_bordesbarra">Ejercicio Fiscal</th>
						 
						  //<td bgcolor="#FFFFFF" class="css_bordes_d">'.$estructura->impuestos->impuesto[$id]->codDocSustento->__toString().'</td>
			// <td bgcolor="#FFFFFF" class="css_bordes_d">'.$estructura->impuestos->impuesto[$id]->numDocSustento->__toString().'</td>
			// <td bgcolor="#FFFFFF" class="css_bordes_d">'.$estructura->impuestos->impuesto[$id]->fechaEmisionDocSustento->__toString().'</td>
			//<td bgcolor="#FFFFFF" class="css_bordes_d">'.$periodoFiscal.'</td>
			
			
						 
		$griddata.='<table width="747px">
          
             <tr>
	            <td class="css_bordesbarra">#</td>
				<td class="css_bordesbarra">Impuesto</td>
			  <td class="css_bordesbarra">Cod. Ret.</td>
               <td class="css_bordesbarra">Base imponible</td>
                <td class="css_bordesbarra">% de retenci&oacute;n</td>
               <td class="css_bordesbarra">Valor Retenido </td>
			   
             </tr>';
         
		 
		
	    for($id=0;$id<$numimpuesto;$id++)
		  {
		   
		   
		    
			
			
		   $codigoRetencion=$estructura->impuestos->impuesto[$id]->codigoRetencion->__toString();
		   
		   
		   
$docsustento=$estructura->impuestos->impuesto[$id]->codDocSustento->__toString();
$ndocsus=$estructura->impuestos->impuesto[$id]->numDocSustento->__toString();
$fechaemidos=$estructura->impuestos->impuesto[$id]->fechaEmisionDocSustento->__toString();			
			 $griddata.='<tr>  
			
			             <td bgcolor="#FFFFFF" class="css_bordes">'.$numfilas.'</td>
						 <td bgcolor="#FFFFFF" class="css_bordes_d">'.$retencion_code[$estructura->impuestos->impuesto[$id]->codigo->__toString()].'</td>
               
               <td bgcolor="#FFFFFF" class="css_bordes_d">'.$codigoRetencion.' : '.$renta_cod_un[trim($codigoRetencion)].'</td>
               <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->impuestos->impuesto[$id]->baseImponible->__toString(), 2, ".", ",").'</td> 
			   <td bgcolor="#FFFFFF" class="css_bordes">'.$estructura->impuestos->impuesto[$id]->porcentajeRetener.'</td>';
			    $griddata.='</td>
               <td bgcolor="#FFFFFF" class="css_bordes">'.number_format($estructura->impuestos->impuesto[$id]->valorRetenido->__toString(), 2, ".", ",").'</td>             
              
             </tr>';
			$totalvalorss=$estructura->impuestos->impuesto[$id]->valorRetenido->__toString();
			$totalvalorp=$totalvalorp+$totalvalorss;
			$numfilas=$numfilas+1;
		  }
		
			
	 $griddata.='
	 
	 <tr>
	   
			   <td class="css_bordes"></td>
               <td class="css_bordes"></td>
               <td class="css_bordes"></td>
			   <td class="css_bordes"></td>
               <td class="css_bordes"><b>Total</b></td>
               <td class="css_bordes"><b>'.number_format($totalvalorp, 2, ".", ",").'</b></td>
			   
             </tr>
	 
	 </tbody>
           </table>'; 
	   //--infoAdicional--//
	   
	 
	   
	   
	   //--platilla--//
	     $razonSocial=stripslashes(htmlentities($razonSocial));
		 $string = str_replace ( "&amp;", '&', $razonSocial );
	    $condatos=str_replace("-empresa-",$razonSocial,$plantilla);
		
		
		if($dirEstablecimiento)
		{
			$dirEstablecimiento=stripslashes(htmlentities($dirEstablecimiento));
		$condatos=str_replace("-direccion-",$dirEstablecimiento,$condatos);
		}
		else
		{
			$dirMatriz=stripslashes(htmlentities($dirMatriz));  
		$condatos=str_replace("-direccion-",$dirMatriz,$condatos);	
		}
		
		
		$condatos=str_replace("-especial-",$contribuyenteEspecial,$condatos);
		$condatos=str_replace("-obligado-",$obligadoContabilidad,$condatos);
		$condatos=str_replace("-rucemp-",$ruc,$condatos);		
		$condatos=str_replace("-nretencion-",$estab."-".$ptoEmi."-".$secuencial,$condatos);		
		$condatos=str_replace("-nautorizacion-",$numeroAutorizacion,$condatos);		
		$condatos=str_replace("-fechahoraaut-",$fechaAutorizacion,$condatos);	
		$valamb=$ambiente;
		$condatos=str_replace("-ambiente-",$ambiente_code[$valamb],$condatos);
		$valemi=$tipoEmision;
		$condatos=str_replace("-emision-",$tipoemision_code[$valemi],$condatos);		
		$condatos=str_replace("-claveacceso-",$claveAcceso,$condatos);		
		$condatos=str_replace("-ruccliente-",$identificacionSujetoRetenido,$condatos);	
		
		$razonSocialSujetoRetenido=stripslashes(htmlentities($razonSocialSujetoRetenido));	
		$condatos=str_replace("-razonsocial-",$razonSocialSujetoRetenido,$condatos);
		
		$condatos=str_replace("-fechaemision-",$fechaEmision,$condatos);	
		
		$condatos=str_replace("-total-",number_format($importeTotal, 2, ".", ","),$condatos);
	   //Lista
	    $condatos=str_replace("-lista-",$griddata,$condatos);
		
		//print_r($tvalorconiva);
		$condatos=str_replace("-subtotal-",number_format($tvalorconiva, 2, ".", ","),$condatos);
		
		$condatos=str_replace("-subtotalsiniva-",number_format($tvalorsiniva, 2, ".", ","),$condatos);
		
		$condatos=str_replace("-subtotalnograbado-",number_format($tvalornogravado, 2, ".", ","),$condatos);
		$condatos=str_replace("-iva-",number_format($valorivac, 2, ".", ","),$condatos);
		$condatos=str_replace("-descuento-",number_format($totalDescuento, 2, ".", ","),$condatos);
        $condatos=str_replace("-logo-",$logotipo_imd,$condatos);
		$condatos=str_replace("-barraclave-",$code_barra,$condatos);
		
	$condatos=str_replace("-csustento-",$docsustento,$condatos);
	$condatos=str_replace("-nsustento-",$ndocsus,$condatos);
	$condatos=str_replace("-fsustento-",$fechaemidos,$condatos);
	$condatos=str_replace("-efiscal-",$periodoFiscal,$condatos);
		
	  $iad=0;
	   for($ib=0;$ib<count($estructura->infoAdicional->campoAdicional);$ib++)
	   {
		   //echo $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString(); 
		   
		   $nombrecampo=$estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
			if($nombrecampo=='direccionComprador')
			{
				  $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
				 // $dirclietxt=utf8_encode($dirclietxt);
				 // $dirclietxt=str_replace("Quito Quito","Quito",$dirclietxt);
				//$dirclietxt=mb_convert_encoding($dirclietxt,'HTML-ENTITIES','UTF-8');
				 // $dirclietxt=str_replace("Lotización","cierto",$dirclietxt);
				$condatos=str_replace("-dircli-",$dirclietxt,$condatos);
				
				
				
				//$condatos=utf8_decode($condatos);
				  $dirbandera=1;
			}
			if($nombrecampo=='telefonoSujetoRetenido')
			{
				 $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
				  $condatos=str_replace("-telcli-",$dirclietxt,$condatos);
				 // $dirclietxt=mb_convert_encoding($dirclietxt,'HTML-ENTITIES','UTF-8');
				  $telbandera=1;
			}
			if($nombrecampo=='CorreoSujetoRetenido')
			{
				   $dirclietxt=stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
				  $condatos=str_replace("-emailcli-",$dirclietxt,$condatos);
				 // $dirclietxt=mb_convert_encoding($dirclietxt,'HTML-ENTITIES','UTF-8');
				  $emailbandera=1;
			}
	
		   
		   //----------------------------------------
		   $iad++;
	   }
	   
	   if(!($dirbandera))
	{
		 $condatos=str_replace("-dircli-","",$condatos);
	}
	if(!($telbandera))
	{
		 $condatos=str_replace("-telcli-","",$condatos);
	}
	if(!($emailbandera))
	{
		 $condatos=str_replace("-emailcli-","",$condatos);
	}
	
		
		
	   
	   return $condatos;
}
?>