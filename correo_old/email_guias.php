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
$fechahoy=date("Y-m-d");
//datos de firma

//datos de firma


$emp_id_valor=1;
//------------------------------

//------------------------------
 $buscafacsinxml="select * from comprobante_guia_cabecera where compguiacab_estadosri='AUTORIZADO' and compguiacab_enviomail='' and compguiacab_email_cliente!='' and emp_id=".$emp_id_valor." order by compguiacab_fechaemision_cliente desc limit 10";
//echo $buscafacsinxml;
  $rs_lista = $DB_gogess->Execute($buscafacsinxml);
				if($rs_lista)
				{   
				   while (!$rs_lista->EOF) {	
				           $id_comprobante=$rs_lista->fields["compguiacab_id"];
				           $idbuscarenvio=$rs_lista->fields["compguiacab_clavedeaccesos"];
					       $compguiacab_nombrerazon_cliente=$rs_lista->fields["compguiacab_nombrerazon_cliente"];
					       $email_cliente1=$rs_lista->fields["compguiacab_email_cliente"];
						   
						    //$email_cliente="drodriguez@ecohevea.com;falider@hotmail.com;jzumbacohevea.com;jazr99@yahoo.es;c_landeta@hotmail.com;franklin.aguas@gmail.com";
						   $email_verificador=";facturaciondibeal@gmail.com;facturaciondibeal@gmail.com";
						   
						   $email_cliente='';
						 echo   $email_cliente=$email_cliente1.$email_verificador;
					       $enviado=trim($rs_lista->fields["compguiacab_enviomail"]);
					       
					       $compguiacab_xmlfirmado=trim($rs_lista->fields["compguiacab_xmlfirmado"]);
						   
						   $compguiacab_nfactura=trim($rs_lista->fields["compguiacab_nfactura"]);
						   
						    $compguiacab_nautorizacion=trim($rs_lista->fields["compguiacab_nautorizacion"]);
					        $compguiacab_fechaaut=trim($rs_lista->fields["compguiacab_fechaaut"]);
							
							$compguiacab_ambiente=trim($rs_lista->fields["compguiacab_ambiente"]);
							
							$compguiacab_offline=trim($rs_lista->fields["compguiacab_offline"]);
							
							$estadoarch=trim($rs_lista->fields["compguiacab_estadosri"]);
					   
						   if($compguiacab_ambiente==1)
						   {
							 $datos_nombre='PRUEBAS';
						   }
						   if($compguiacab_ambiente==2)
						   {
							 $datos_nombre='PRODUCCION';
						   }
					 
					       $emp_id=$rs_lista->fields["emp_id"];
					       //echo $email_cliente;
				   
				           $datos_emp=datos_empresa($emp_id,$DB_gogess);
						   
						   //------------------------
						    $datos_inserta["repem_tipodoc"]=$rs_lista->fields["compguiacab_tipocomprobante"];
							$datos_inserta["repem_numdoc"]=$compguiacab_nfactura;
							
							$datos_inserta["repem_claveacceso"]=$idbuscarenvio;
							$datos_inserta["repem_nautorizacion"]=$compguiacab_nautorizacion;
							
							
							$separa_fecha=explode("T",$compguiacab_fechaaut);
							$datos_inserta["repem_fechaautorizacion"]=$separa_fecha[0];
							
						   //------------------------
						   
						  echo $xml_rest=base64_decode($compguiacab_xmlfirmado);
						   $logotipo_imd="<img src='C:/xampp/htdocs/dibeal/correo/logo_emp/logo.png' >";
						   
						   $pathextrap="C:/xampp/htdocs/dibeal/correo/";
$comprobantepdf=leer_xml(0,$xml_rest,'06',$compguiacab_nautorizacion,$compguiacab_fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap,$compguiacab_offline);
						   
					//echo $comprobantepdf;	  
					$dompdf = new DOMPDF();
					$dompdf->load_html($comprobantepdf);
					$dompdf->render();
                    $archivo = "C:/xampp/htdocs/dibeal/correo/temporal/GUI".$compguiacab_nfactura.".pdf";
					$patharchpdf=$archivo;
					$nombrearchpdf="GUI".$compguiacab_nfactura.".pdf";
					
	                $id = fopen($archivo, 'w+');
					$cadena = $dompdf->output();
					fwrite($id, $cadena);
					fclose($id);
					
					//-----------------------------------------------------
					
					$archivostring=base64_decode($compguiacab_xmlfirmado);
					$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
					<autorizacion>
					<estado>'.$estadoarch.'</estado>
					<numeroAutorizacion>'.$compguiacab_nautorizacion.'</numeroAutorizacion>
					<fechaAutorizacion>'.$compguiacab_fechaaut.'</fechaAutorizacion>
					<ambiente>'.$datos_nombre.'</ambiente>
					<comprobante><![CDATA[';
					
					$comprovante_autpie=']]></comprobante>
					</autorizacion>';
					$archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;
					
					
					$archivo = "C:/xampp/htdocs/dibeal/correo/temporal/GUI".$compguiacab_nfactura.".xml";
					$patharchxml=$archivo;
					$nombrearchxml="GUI".$compguiacab_nfactura.".xml";
					
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
					
						if(count($email_valido)>0)
						{
						   //------------------------------------------
						   
						   
						   
						   $estado_correo=enviar_correo("COMPROBANTE ELECTRONICO DIBEAL",$archivos,$email_valido,$compguiacab_nombrerazon_cliente,"","COMPROBANTE ELECTRONICO",$texto_valor,'',$DB_gogess);
						   
						    if($estado_correo==1)
						   {
						        unlink($patharchpdf);
	                            unlink($patharchxml);
							 
							    $actualizafactur="update comprobante_guia_cabecera set compguiacab_sello='SI' where compguiacab_id='".$id_comprobante."'";
								$okact=$DB_gogess->Execute($actualizafactur);
								
								$datos_inserta["repem_envio"]='1';
						        $datos_inserta["repem_fechaenvio"]=date("Y-m-d h:m:i");
						      echo  $datos_inserta["repem_mensaje"]='ENVIADO SATISFACTORIAMENTE...';
						        guarda_emaillog($datos_inserta,$DB_gogess);
								
                                $actualizaemail="update comprobante_guia_cabecera set compguiacab_enviomail='ENVIADO',compguiacab_enviomailfecha='".$fechahoy."' where compguiacab_id='".$id_comprobante."'";
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
						  echo   $datos_inserta["repem_mensaje"]='ERROR AL ENVIAR CORREO CONEXION NO VALIDAD...';
						     guarda_emaillog($datos_inserta,$DB_gogess);
						   }
						   
						   //------------------------------------------
						
						}
						else
						{
						  $datos_inserta["repem_envio"]='0';
						  $datos_inserta["repem_fechaenvio"]=date("Y-m-d h:m:i");
						  $datos_inserta["repem_mensaje"]='SE INTENTO ENVIAR PERO NINGUN CORREO ES VALIDO...';
						   guarda_emaillog($datos_inserta,$DB_gogess);
						
						}
						  
						  
		
						 
						  
					
				   
				   
				    $rs_lista->MoveNext();
				   }
				}   
			
?>