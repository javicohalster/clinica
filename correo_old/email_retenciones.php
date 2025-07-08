<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include("lib_factura.php");
include("libreria/lib_pdf.php");
include("libreria/lib_parametros.php");
include("codebarra/Barcode.php");
require_once("libreria/dompdf/dompdf_config.inc.php");
include("libreria/envio.php");
 require_once("PHPMailer_v51/class.phpmailer.php");
 require_once("PHPMailer_v51/class.smtp.php");
 include("config_email_phpmailer.php");
$fechahoy=date("Y-m-d h:m:i");
//datos de firma

//datos de firma


$emp_id_valor=1;
//------------------------------

//------------------------------
$fechainicioenmails="2015-03-06";
$buscafacsinxml="select * from comprobante_retencion_cab where compretcab_estadosri='AUTORIZADO' and compretcab_enviomail='' and compretcab_email_cliente!='' and compretcab_fechaemision_cliente >'".$fechainicioenmails."' and emp_id=".$emp_id_valor." limit 20";
//echo $buscafacsinxml;
  $rs_lista = $DB_gogess->Execute($buscafacsinxml);
				if($rs_lista)
				{   
				   while (!$rs_lista->EOF) {	
				           $id_comprobante=$rs_lista->fields["compretcab_id"];
				           $idbuscarenvio=$rs_lista->fields["compretcab_clavedeaccesos"];
					       $comcab_nombrerazon_cliente=$rs_lista->fields["compretcab_nombrerazon_cliente"];
					       $email_cliente1=$rs_lista->fields["compretcab_email_cliente"];
						   
						   // $email_cliente="drodriguez@ecohevea.com;falider@hotmail.com;jzumbacohevea.com;jazr99@yahoo.es;c_landeta@hotmail.com;franklin.aguas@gmail.com";
						   $email_verificador=";facturaciondibeal@gmail.com;facturaciondibeal@gmail.com";
					$email_cliente='';
						 echo   $email_cliente=$email_cliente1.$email_verificador;
						   
						   
					       $enviado=trim($rs_lista->fields["compretcab_enviomail"]);
					       
					       $comcab_xmlfirmado=trim($rs_lista->fields["compretcab_xmlfirmado"]);
						   
						   $comcab_nfactura=trim($rs_lista->fields["compretcab_nretencion"]);
						   
						    $comcab_nautorizacion=trim($rs_lista->fields["compretcab_nautorizacion"]);
					        $comcab_fechaaut=trim($rs_lista->fields["compretcab_fechaaut"]);
							
							$comcab_ambiente=trim($rs_lista->fields["compretcab_ambiente"]);
							
							$compretcab_offline=trim($rs_lista->fields["compretcab_offline"]);
							
							$estadoarch=trim($rs_lista->fields["compretcab_estadosri"]);
					   
						   if($comcab_ambiente==1)
						   {
							 $datos_nombre='PRUEBAS';
						   }
						   if($comcab_ambiente==2)
						   {
							 $datos_nombre='PRODUCCION';
						   }
					 
					       $emp_id=$rs_lista->fields["emp_id"];
					       //echo $email_cliente;
				   
				           $datos_emp=datos_empresa($emp_id,$DB_gogess);
						   
						   //------------------------
						    $datos_inserta["repem_tipodoc"]=$rs_lista->fields["compretcab_tipocomprobante"];
							$datos_inserta["repem_numdoc"]=$comcab_nfactura;
							
							$datos_inserta["repem_claveacceso"]=$idbuscarenvio;
							$datos_inserta["repem_nautorizacion"]=$comcab_nautorizacion;
							
							
							$separa_fecha=explode("T",$comcab_fechaaut);
							$datos_inserta["repem_fechaautorizacion"]=$separa_fecha[0];
							
						   //------------------------
						   
						   $xml_rest=base64_decode($comcab_xmlfirmado);
						   $logotipo_imd="<img src='C:/xampp/htdocs/dibeal/correo/logo_emp/logo.png' >";
						   
						   $pathextrap="c:/xampp/htdocs/dibeal/correo/";
$comprobantepdf=leer_xml(0,$xml_rest,'07',$comcab_nautorizacion,$comcab_fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap,$compretcab_offline);
						   
					//echo $comprobantepdf;	  
					$dompdf = new DOMPDF();
					$dompdf->load_html($comprobantepdf);
					$dompdf->render();
                    $archivo = "C:/xampp/htdocs/dibeal/correo/temporal/RET".$comcab_nfactura.".pdf";
					$patharchpdf=$archivo;
					$nombrearchpdf="RET".$comcab_nfactura.".pdf";
					
	                $id = fopen($archivo, 'w+');
					$cadena = $dompdf->output();
					fwrite($id, $cadena);
					fclose($id);
					
					//-----------------------------------------------------
					
					$archivostring=base64_decode($comcab_xmlfirmado);
					$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
					<autorizacion>
					<estado>'.$estadoarch.'</estado>
					<numeroAutorizacion>'.$comcab_nautorizacion.'</numeroAutorizacion>
					<fechaAutorizacion>'.$comcab_fechaaut.'</fechaAutorizacion>
					<ambiente>'.$datos_nombre.'</ambiente>
					<comprobante><![CDATA[';
					
					$comprovante_autpie=']]></comprobante>
					</autorizacion>';
					$archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;
					
					
					$archivo = "c:/xampp/htdocs/dibeal/correo/temporal/RET".$comcab_nfactura.".xml";
					$patharchxml=$archivo;
					$nombrearchxml="RET".$comcab_nfactura.".xml";
					
					$id = fopen($archivo, 'w+');
					$cadena = $archivoaut;
					fwrite($id, $cadena);
					fclose($id);
					
					//toma archivos
					
					$archivos[0]["path"]=$patharchpdf;
					$archivos[0]["nombre"]=$nombrearchpdf;
					
					$archivos[1]["path"]=$patharchxml;
					$archivos[1]["nombre"]=$nombrearchxml;
					
					//toma archivos
					
					unset($lista_emails);
					$lista_emails=explode(";",$email_cliente);
					$emvalido=0;
					$noemvalido=0;
					for($iem=0;$iem<count($lista_emails);$iem++)
					{
					
					  if (filter_var($lista_emails[$iem], FILTER_VALIDATE_EMAIL)) {
					       
					       $email_valido[$emvalido]=$lista_emails[$iem];
						   $datos_inserta["repem_email"]=$datos_inserta["repem_email"].";".$email_valido[$emvalido];
					       $emvalido++;
					  }
					  else
					  {
					       $email_novalido[$noemvalido]=$lista_emails[$iem];
						   $datos_inserta["repem_emailnovalido"]=$datos_inserta["repem_emailnovalido"].";".$email_novalido[$noemvalido];
					       $noemvalido++;
					  
					  }
					
					
					}
					unset($lista_emails);
						if(count($email_valido)>0)
						{
						   //------------------------------------------
						   
						   
						   
						   $estado_correo=enviar_correo("COMPROBANTE ELECTRONICO DIBEAL",$archivos,$email_valido,$comcab_nombrerazon_cliente,"","COMPROBANTE ELECTRONICO",$texto_valor,'',$DB_gogess);
						   
						    if($estado_correo==1)
						   {
						        unlink($patharchpdf);
	                            unlink($patharchxml);
							 
							    $actualizafactur="update comprobante_retencion_cab set compretcab_sello='SI' where compretcab_id='".$id_comprobante."'";
								$okact=$DB_gogess->Execute($actualizafactur);
								
								$datos_inserta["repem_envio"]='1';
						        $datos_inserta["repem_fechaenvio"]=date("Y-m-d h:m:i");
						        $datos_inserta["repem_mensaje"]='ENVIADO SATISFACTORIAMENTE...';
								echo $datos_inserta["repem_mensaje"];
						        guarda_emaillog($datos_inserta,$DB_gogess);
								
                                $actualizaemail="update comprobante_retencion_cab set compretcab_enviomail='ENVIADO',compretcab_enviomailfecha='".$fechahoy."' where compretcab_id='".$id_comprobante."'";
                                $okv=$DB_gogess->Execute($actualizaemail); 
								
								  unlink($patharchpdf);
								  unlink($patharchxml);
							 
							 
							 
						   
						   }
						   
						   if($estado_correo==0)
						   {
						    unlink($patharchpdf);
	                         unlink($patharchxml);
						     $datos_inserta["repem_envio"]='0';
						     $datos_inserta["repem_fechaenvio"]=date("Y-m-d h:m:i");
						     $datos_inserta["repem_mensaje"]='ERROR AL ENVIAR CORREO CONEXION NO VALIDAD...';
						 $datos_inserta["repem_mensaje"];
						     guarda_emaillog($datos_inserta,$DB_gogess);
						   }
						   
						   //------------------------------------------
						
						}
						else
						{
						  $datos_inserta["repem_envio"]='0';
						  $datos_inserta["repem_fechaenvio"]=date("Y-m-d h:m:i");
						  $datos_inserta["repem_mensaje"]='SE INTENTO ENVIAR PERO NINGUN CORREO ES VALIDO...';
						  $datos_inserta["repem_mensaje"];
						   guarda_emaillog($datos_inserta,$DB_gogess);
						
						}
						  
						  
		
						 
						  
					
				   
				   
				    $rs_lista->MoveNext();
				   }
				}   
			
?>