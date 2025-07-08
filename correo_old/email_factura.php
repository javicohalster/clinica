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
echo  $buscafacsinxml="select * from beko_documentocabecera where doccab_estadosri='AUTORIZADO' and doccab_enviomail='0' and doccab_email_cliente!='' and doccab_fechaemision_cliente >'".$fechainicioenmails."'  and emp_id='".$emp_id_valor."' limit 20";
//echo $buscafacsinxml;
  $rs_lista = $DB_gogess->Execute($buscafacsinxml);
				if($rs_lista)
				{   
				   while (!$rs_lista->EOF) {	
				           $id_comprobante=$rs_lista->fields["doccab_id"];
				           $idbuscarenvio=$rs_lista->fields["doccab_clavedeaccesos"];
					       $doccab_nombrerazon_cliente=$rs_lista->fields["doccab_nombrerazon_cliente"];
					     $email_cliente1=$rs_lista->fields["doccab_email_cliente"];
						   
					 /// $email_cliente=";drodriguez@ecohevea.com;falider@hotmail.com;jzumba@ecohevea.com;jazr99@yahoo.es;c_landeta@hotmail.com;franklin.aguas@gmail.com";
				 //$email_verificador=";facturaciondibeal@gmail.com";
				  $email_verificador=";facturaciondibeal@gmail.com";
					$email_cliente='';
						 echo   $email_cliente=$email_cliente1.$email_verificador;
					       $enviado=trim($rs_lista->fields["doccab_enviomail"]);
					       
					       $doccab_xmlfirmado=trim($rs_lista->fields["doccab_xmlfirmado"]);
						   
						   $doccab_ndocumento=trim($rs_lista->fields["doccab_ndocumento"]);
						   
						    $doccab_nautorizacion=trim($rs_lista->fields["doccab_nautorizacion"]);
					        $doccab_fechaaut=trim($rs_lista->fields["doccab_fechaaut"]);
							
							$ambi_valor=trim($rs_lista->fields["ambi_valor"]);
							
							$comcab_offline=1;
							
							$estadoarch=trim($rs_lista->fields["doccab_estadosri"]);
					   
						   if($ambi_valor==1)
						   {
							 $datos_nombre='PRUEBAS';
						   }
						   if($ambi_valor==2)
						   {
							 $datos_nombre='PRODUCCION';
						   }
					 
					       $emp_id=$rs_lista->fields["emp_id"];
					       //echo $email_cliente;
				   
				           $datos_emp=datos_empresa($emp_id,$DB_gogess);
						   
						   //------------------------
						    $datos_inserta["repem_tipodoc"]=$rs_lista->fields["tipocmp_codigo"];
							$datos_inserta["repem_numdoc"]=$doccab_ndocumento;
							
							$datos_inserta["repem_claveacceso"]=$idbuscarenvio;
							$datos_inserta["repem_nautorizacion"]=$doccab_nautorizacion;
							
							
							$separa_fecha=explode("T",$doccab_fechaaut);
							$datos_inserta["repem_fechaautorizacion"]=$separa_fecha[0];
							
						   //------------------------
						   
						   $xml_rest=base64_decode($doccab_xmlfirmado);
						   $logotipo_imd="<img src='C:/xampp/htdocs/faesa/correo/logo_emp/logo.png' >";
						   
						   $pathextrap="c:/xampp/htdocs/faesa/correo/";
$comprobantepdf=leer_xml(0,$xml_rest,'01',$doccab_nautorizacion,$doccab_fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap,$comcab_offline);
						   
					//echo $comprobantepdf;	  
					$dompdf = new DOMPDF();
					$dompdf->load_html($comprobantepdf);
					$dompdf->render();
                    $archivo = "C:/xampp/htdocs/faesa/correo/temporal/FAC".$doccab_ndocumento.".pdf";
					$patharchpdf=$archivo;
					$nombrearchpdf="FAC".$doccab_ndocumento.".pdf";
					
	                $id = fopen($archivo, 'w+');
					$cadena = $dompdf->output();
					fwrite($id, $cadena);
					fclose($id);
					
					//-----------------------------------------------------
					
					$archivostring=base64_decode($doccab_xmlfirmado);
					$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
					<autorizacion>
					<estado>'.$estadoarch.'</estado>
					<numeroAutorizacion>'.$doccab_nautorizacion.'</numeroAutorizacion>
					<fechaAutorizacion>'.$doccab_fechaaut.'</fechaAutorizacion>
					<ambiente>'.$datos_nombre.'</ambiente>
					<comprobante><![CDATA[';
					
					$comprovante_autpie=']]></comprobante>
					</autorizacion>';
					$archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;
					
					
					$archivo = "C:/xampp/htdocs/faesa/correo/temporal/FAC".$doccab_ndocumento.".xml";
					$patharchxml=$archivo;
					$nombrearchxml="FAC".$doccab_ndocumento.".xml";
					
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
					       
					    echo   $email_valido[$emvalido]=$lista_emails[$iem];
						   $datos_inserta["repem_email"]=$datos_inserta["repem_email"].";".$email_valido[$emvalido];
					       $emvalido++;
						   echo aquiiii;
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
						   
						   
						   
						   $estado_correo=enviar_correo("COMPROBANTE ELECTRONICO FAESA",$archivos,$email_valido,$doccab_nombrerazon_cliente,"","COMPROBANTE ELECTRONICO",$texto_valor,'',$DB_gogess);
						   
						    if($estado_correo==1)
						   {
						        unlink($patharchpdf);
	                            unlink($patharchxml);
							 
							    $actualizafactur="update beko_documentocabecera set doccab_enviomail='1' where doccab_id='".$id_comprobante."'";
							    $okact=$DB_gogess->Execute($actualizafactur);
								
								$datos_inserta["repem_envio"]='1';
						        $datos_inserta["repem_fechaenvio"]=date("Y-m-d h:m:i");
						        $datos_inserta["repem_mensaje"]='ENVIADO SATISFACTORIAMENTE...';
							    $datos_inserta["repem_mensaje"];
						       // guarda_emaillog($datos_inserta,$DB_gogess);
								
                                $actualizaemail="update beko_documentocabecera set doccab_enviomail='1',doccab_enviomailfecha='".$fechahoy."' where doccab_id='".$id_comprobante."'";
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
						     //guarda_emaillog($datos_inserta,$DB_gogess);
						   }
						   
						   //------------------------------------------
						
						}
						else
						{
						  $datos_inserta["repem_envio"]='0';
						  $datos_inserta["repem_fechaenvio"]=date("Y-m-d h:m:i");
						  $datos_inserta["repem_mensaje"]='SE INTENTO ENVIAR PERO NINGUN CORREO ES VALIDO...';
						echo  $datos_inserta["repem_mensaje"];
						   guarda_emaillog($datos_inserta,$DB_gogess);
						
						}
						  
						  
		
						 
						  
					
				   
				   
				    $rs_lista->MoveNext();
				   }
				}   
			
?>