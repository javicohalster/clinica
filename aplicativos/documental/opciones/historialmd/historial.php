<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
//include("libreport.php");
$objformulario= new  ValidacionesFormulario();



$busca_atencionactual="select * from app_cliente inner join dns_atencion on app_cliente.clie_id=dns_atencion.clie_id where clie_rucci='".$_POST["clie_rucci"]."' and atenc_id='".$_POST["atenc_id"]."'";
$rs_ATENCIOn = $DB_gogess->executec($busca_atencionactual,array());

$clie_id=$rs_ATENCIOn->fields["clie_id"];
$atenc_id=$_POST["atenc_id"];

?>
<style type="text/css">
<!--
.css_listaespe {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#DDEAEE"><span class="css_listaespe">FECHA</span></td>
	<td bgcolor="#DDEAEE"><span class="css_listaespe">ESPECIALIDAD</span></td>
    <td bgcolor="#DDEAEE"><span class="css_listaespe">DOCUMENTO</span></td>
  </tr>
<?php


				
$lista_tabeval="select * from gogess_sistable where tab_name not in ('dns_imagenologia','dns_laboratorio','dns_laboratorioinforme','dns_consultaexterna','dns_rehabilitacionanamesis','dns_otorrinoanamesis','dns_ginecologiaconsultaexterna','dns_emergenciaconsultaexterna','dns_gastroenterologiaconsultaexterna','dns_pediatriaconsultaexterna','dns_cardiologiaconsultaexterna','dns_traumatologiaconsultaexterna','dns_ginecologiaconsultaexterna','dns_enfermeria','dns_hospitalconsultaexterna','dns_newlaboratorio','dns_newinterconsulta','dns_newhospitalizacionanamesis','dns_newhospitalizacionconsultaexterna','dns_newgastroenterologiaanamesis','dns_newgastroenterologiaconsultaexterna','dns_newcardiologiaanamesis','dns_newcardiologiaconsultaexterna','dns_newpediatriaanamesis','dns_newpediatriaconsultaexterna','dns_newtraumatologiaanamesis','dns_newtraumatologiaconsultaexterna','dns_newconsultaexternaconsultaexterna','dns_newemergenciaanamesis','dns_newemergenciaconsultaexterna','dns_newprotocolooperatorio','dns_protocolooperatorio','dns_epicrisisanamesis','dns_epicrisisconsultaexterna','dns_newepicrisisanamesis','dns_newreferencia','dns_newimagenologia','dns_newimagenologiainfo','dns_odontologia','dns_imagenologiainfo') and  tab_sysmedico=1";
$rs_tabeval = $DB_gogess->executec($lista_tabeval,array());
if($rs_tabeval)
{
	  while (!$rs_tabeval->EOF) {	
	  
	  //busca campos
	  $lista_datosmenu="select * from gogess_menupanel where tab_id='".$rs_tabeval->fields["tab_id"]."'";
      $rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
	  
	  //busca campos
	  
	  
	  $separa_subind=explode("_",$rs_tabeval->fields["tab_campoprimario"]);
	  $campo_fechareg=$separa_subind[0]."_fecharegistro";	  
	  $lista_secciones="select * from ".$rs_tabeval->fields["tab_name"]." where ".$rs_tabeval->fields["tab_name"].".atenc_id='".$rs_ATENCIOn->fields["atenc_id"]."' order by ".$campo_fechareg." desc";
	  
	  $rs_seccion = $DB_gogess->executec($lista_secciones,array());
		    if($rs_seccion)
			{
				while (!$rs_seccion->EOF) {			
				
				$campos_data='';
				$campos_data64='';
				$eteneva_id='';				
				$mnupan_id=$rs_datosmenu->fields["mnupan_id"];
				$linkpdfg='';
				$urllinkg='';
				$linkimprimirg='';
				$campo_fecha='';
				
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_newconsultaexternaanamesis')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformularionewconsultaexterna";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
					
					$campo_fecha='anam_fecharegistro';
				
				
				}
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_anamesisexamenfisico')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformulario";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
					$campo_fecha='anam_fecharegistro';
				
				}
				
				if($rs_tabeval->fields["tab_name"]=='dns_anamesisexamenfisico')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformulario";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
					$campo_fecha='anam_fecharegistro';
				
				}
					
			
			if($rs_tabeval->fields["tab_name"]=='dns_emergenciaanamesis')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformularioemergencia";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
					$campo_fecha='anam_fecharegistro';
				
				}
				
				if($rs_tabeval->fields["tab_name"]=='dns_gastroenterologiaanamesis')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformulariogastroenterologia";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
					$campo_fecha='anam_fecharegistro';
				
				}
				
				if($rs_tabeval->fields["tab_name"]=='dns_pediatriaanamesis')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformulariopediatria";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
					$campo_fecha='anam_fecharegistro';
				
				}
				
				
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_traumatologiaanamesis')
				{
				  
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformulariotraumatologia";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
					
					$campo_fecha='anam_fecharegistro';
				
				}
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_hospitalanamesis')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformulariohospital";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
				    $campo_fecha='anam_fecharegistro';
				}
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_cardiologiaanamesis')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformulariocardiologia";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
				    $campo_fecha='anam_fecharegistro';
				}
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_ginecologiaanamesis')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformularioginecologia";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
				    $campo_fecha='anam_fecharegistro';
				}
				
				if($rs_tabeval->fields["tab_name"]=='dns_interconsulta')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdformulariointerconsulta";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
				    $campo_fecha='intercon_fecharegistro';
				}
				
				if($rs_tabeval->fields["tab_name"]=='dns_referencia')
				{
				
				    $campos_data='';
					$campos_data64='';
					$campos_data='iddata='.$rs_tabeval->fields["tab_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
					$campos_data64=base64_encode($campos_data);
					
					$linkpdfg="pdfreferencia";
                    $urllinkg="pdfformularios/".$linkpdfg.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]];				 
				    $linkimprimirg="onClick=ver_pdfform('".$urllinkg."')";
				    $campo_fecha='referencia_fecharegistro';
				}
				
				
				
				
				
?>  
  <tr>  
    <td valign="top"><?php  echo $rs_seccion->fields[$campo_fecha]; ?></td>
	<td><?php  echo $rs_tabeval->fields["tab_title"]; ?><hr />
	<?php
	
	if($rs_tabeval->fields["tab_name"]=='dns_newconsultaexternaanamesis')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='558'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_newconsultaexternaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$linkpdfgx="pdfformevolucionnewconsultaexterna";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='conext_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_consultaexterna'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
						
				
				}
	
	
	
	
	if($rs_tabeval->fields["tab_name"]=='dns_anamesisexamenfisico')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='320'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_consultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$linkpdfgx="pdfformularioevolucion";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='conext_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_consultaexterna'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
						
				
				}	
				
				
		if($rs_tabeval->fields["tab_name"]=='dns_emergenciaanamesis')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='464'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_emergenciaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$linkpdfgx="pdfformevolucionemergencia";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='conext_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_emergenciaconsultaexterna'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
						
				
				}		
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_gastroenterologiaanamesis')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='450'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_gastroenterologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$linkpdfgx="pdfformevoluciongastroenterologia";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='conext_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_gastroenterologiaconsultaexterna'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
						
				
				}		
				
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_pediatriaanamesis')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='411'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_pediatriaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$linkpdfgx="pdfformulariopediatriavolucion";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='conext_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_pediatriaconsultaexterna'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
						
				
				}		
				
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_cardiologiaanamesis')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='383'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_cardiologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$linkpdfgx="pdfformulariocardiolovolucion";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='conext_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_cardiologiaconsultaexterna'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
						
				
				}	
				
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_traumatologiaanamesis')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='381'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_traumatologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$linkpdfgx="pdfformulariotraumatvolucion";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='conext_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_traumatologiaconsultaexterna'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
						
				
				}	
				
				
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_ginecologiaanamesis')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='379'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_ginecologiaconsultaexterna where anam_id='".$rs_seccion->fields["anam_id"]."' order by conext_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$linkpdfgx="pdfformularioegenicolovolucion";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$rs_seccion->fields["anam_id"];				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='conext_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_ginecologiaconsultaexterna'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
						
				
				}	
				
				
				
				
				if($rs_tabeval->fields["tab_name"]=='dns_hospitalanamesis')
				{
				
				$lista_datosmenu_sub="select * from gogess_menupanel where tab_id='440'";
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_protocolooperatorio where protoop_tblprincipal='dns_hospitalanamesis' and protoop_idenlace='".$rs_seccion->fields["anam_id"]."' order by protoop_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$protoop_id=$rs_subsecuentes->fields["protoop_id"];
							
							$linkpdfgx="pdformularioprotocolo";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$protoop_id;				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='protoop_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_protocolooperatorio'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
					
					
					
			    $lista_datosmenu_sub="select * from gogess_menupanel where tab_id='436'";
				$tab_id=436;
                $rs_datosmenu_sub = $DB_gogess->executec($lista_datosmenu_sub,array($mnupan_id));
				$mnupan_id_sub=$rs_datosmenu_sub->fields["mnupan_id"];
				
				$lista_subsecuentes="select * from dns_epicrisisanamesis where protoop_tblprincipal='dns_hospitalanamesis' and protoop_idenlace='".$rs_seccion->fields["anam_id"]."' order by anam_fecharegistro desc";
				$rs_subsecuentes = $DB_gogess->executec($lista_subsecuentes,array());
				 if($rs_subsecuentes)
					{
						while (!$rs_subsecuentes->EOF) {
						
						    $campos_data='';
							$campos_data64='';
							//$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id_sub;
							
							$campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5=0&pVar3='.$mnupan_id_sub;
							$campos_data64=base64_encode($campos_data);
							
							$anam_id=$rs_subsecuentes->fields["anam_id"];
							
							$linkpdfgx="pdformularioepicrisis";
                            $urllinkgx="pdfformularios/".$linkpdfgx.".php?ssr=".$campos_data64."|"."+".$anam_id;				 
				            $linkimprimirgx="onClick=ver_pdfform('".$urllinkgx."')";
				            $campo_fechax='anam_fecharegistro';
							
							$lista_tabevalx="select * from gogess_sistable where tab_name='dns_epicrisisanamesis'";
							$rs_tablax = $DB_gogess->executec($lista_tabevalx,array());
							
							echo $rs_subsecuentes->fields[$campo_fechax]." -- >".$rs_tablax->fields["tab_title"]." --> "."<span ".$linkimprimirgx." style='cursor:pointer' ><img src='images/pdfdoc.png' width='30' ></span><br>";


						
						   $rs_subsecuentes->MoveNext();
						}
					}
					
					
						
				
				}
					
					
	?>		
	</td>
    <td valign="top" style="cursor:pointer" <?php echo $linkimprimirg; ?> ><img src="images/pdfdoc.png" ></td>
	<td>
	<?php //echo $links_data; ?>
	</td>	
  </tr>
<?php

               //busca imagen
			   $busca_imagen="select * from dns_imagenologia where imgag_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and imgag_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."' order by imgag_fecharegistro desc";
			   $rs_imagen = $DB_gogess->executec($busca_imagen,array());
			   if($rs_imagen)
			   {
			     while (!$rs_imagen->EOF) {	
				 
				 $campo_fechasecun='imgag_fecharegistro';
				 
				 $eteneva_id=0;
				 $tab_id=285;
				 $mnupan_id=61;
				 $campos_data='';
                 $campos_data64='';
                 $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                 $campos_data64=base64_encode($campos_data);
				 $linkpdf="pdfimagen";
                 $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_imagen->fields["imgag_id"];				 
				 $linkimprimir="onClick=ver_pdfform('".$urllink."')";
				 
				 //busca id informe
				 $busca_informeimg="select * from dns_imagenologiainfo where imgag_id='".$rs_imagen->fields["imgag_id"]."'";
				 $rs_imageninforme = $DB_gogess->executec($busca_informeimg,array());				 
				 //busca id informe
				 
				 $logoinforme='';
				 $eteneva_idi=0;
				 $tab_idi=324;
				 $mnupan_idi=90;
				 $linkpdfi="pdfimageninforme";  
                 $campos_datai='';
                 $campos_data64i='';
                 $campos_datai='iddata=324&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=90';
                 $campos_data64i=base64_encode($campos_datai); 
				 $urllinki="pdfformularios/".$linkpdfi.".php?ssr=".$campos_data64i."|"."+".$rs_imageninforme->fields["imginfo_id"];		
				 
				 if($rs_imageninforme->fields["imginfo_id"]>0)
				 {
				   $linkimprimiri="onClick=ver_pdfform('".$urllinki."')";
				   $logoinforme='<img src="images/pdfdoc.png" ><br />Informe';			 
				 }	 
				 
				 
			   ?>
			   
			   <tr>  
    <td></td>
	<td>IMAGENOLOGIA - SOLICITUD (SNS-MSP / HCU-form.012 / 2008)<br><?php echo $rs_imagen->fields["imgag_fecharegistro"]; ?></td>
    <td>
	
	
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/pdfdoc.png" ><br />Solicitud</td>
    <td <?php echo $linkimprimiri; ?> style="cursor:pointer" ><?php echo $logoinforme; ?></td>
  </tr>
</table>
	
	</td>
	<td>
	<?php //echo $links_data; ?>
	</td>	
  </tr>
				
				<?php
				    $rs_imagen->MoveNext();
				}
			   }
				//busca imagen
				
		
		
				
				//busca laboratorio
				
			   $busca_laborato="select * from dns_laboratorio where lab_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and lab_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."'";
			   $rs_laborato = $DB_gogess->executec($busca_laborato,array());
			   if($rs_laborato)
			   {
			     while (!$rs_laborato->EOF) {	
				 
				 $eteneva_id=0;
				 $tab_id=321;
				 $mnupan_id=60;
				 $campos_data='';
                 $campos_data64='';
                 $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                 $campos_data64=base64_encode($campos_data);
				 $linkpdf="pdflaboratorio";
                 $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_laborato->fields["lab_id"];				 
				 $linkimprimir="onClick=ver_pdfform('".$urllink."')";
				 
				 //busca id informe
				 $busca_informeimg="select * from dns_laboratorioinforme where lab_id='".$rs_laborato->fields["lab_id"]."'";
				 $rs_laboratoinforme = $DB_gogess->executec($busca_informeimg,array());				 
				 //busca id informe
				 
				 $logoinforme='';
				 $eteneva_idi=0;
				 $tab_idi=325;
				 $mnupan_idi=91;
				 $linkpdfi="pdflaboratorioinforme";  
                 $campos_datai='';
                 $campos_data64i='';
                 $campos_datai='iddata='.$tab_idi.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=91';
                 $campos_data64i=base64_encode($campos_datai); 
				 $urllinki="pdfformularios/".$linkpdfi.".php?ssr=".$campos_data64i."|"."+".$rs_laboratoinforme->fields["labinfor_id"];		
				 
				 if($rs_laboratoinforme->fields["labinfor_id"]>0)
				 {
				   $linkimprimiri="onClick=ver_pdfform('".$urllinki."')";
				   $logoinforme='<img src="images/pdfdoc.png" ><br />Informe';			 
				 }	 
				 
				 
			   ?>
			   
	<tr>  
    <td></td>
	<td>LABORATORIO CLINICO - SOLICITUD (SNS-MSP / HCU-form.010 / 2008)<br /> <?php echo $rs_laborato->fields["lab_fecharegistro"]; ?></td>
    <td>
	
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/pdfdoc.png" ><br />Solicitud</td>
    <td <?php echo $linkimprimiri; ?> style="cursor:pointer" ><?php echo $logoinforme; ?></td>
  </tr>
</table>
	
	</td>
	<td>
	<?php //echo $links_data; ?>
	</td>	
  </tr>
				
				<?php
				    $rs_laborato->MoveNext();
				}
			   }
			
				//busca aboratorio
				
				
				
				//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				
				//busca laboratorio nuevo
				
			   $busca_laborato="select * from dns_newlaboratorio where lab_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and lab_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."'";
			   $rs_laborato = $DB_gogess->executec($busca_laborato,array());
			   if($rs_laborato)
			   {
			     while (!$rs_laborato->EOF) {	
				 
				 $eteneva_id=0;
				 $tab_id=590;
				 $mnupan_id=219;
				 $campos_data='';
                 $campos_data64='';
                 $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                 $campos_data64=base64_encode($campos_data);
				 $linkpdf="pdfnewlaboratorio";
                 $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_laborato->fields["lab_id"];				 
				 $linkimprimir="onClick=ver_pdfform('".$urllink."')";
				 
				 //busca id informe
				 $busca_informeimg="select * from dns_laboratorioinforme where lab_id='".$rs_laborato->fields["lab_id"]."'";
				 $rs_laboratoinforme = $DB_gogess->executec($busca_informeimg,array());				 
				 //busca id informe
				 
				 $logoinforme='';
				 $eteneva_idi=0;
				 $tab_idi=325;
				 $mnupan_idi=91;
				 $linkpdfi="pdflaboratorioinforme";  
                 $campos_datai='';
                 $campos_data64i='';
                 $campos_datai='iddata='.$tab_idi.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=91';
                 $campos_data64i=base64_encode($campos_datai); 
				 $urllinki="pdfformularios/".$linkpdfi.".php?ssr=".$campos_data64i."|"."+".$rs_laboratoinforme->fields["labinfor_id"];		
				 
				 if($rs_laboratoinforme->fields["labinfor_id"]>0)
				 {
				   $linkimprimiri="onClick=ver_pdfform('".$urllinki."')";
				   $logoinforme='<img src="images/pdfdoc.png" ><br />Informe';			 
				 }	 
				 
				 $logoinforme='';
			   ?>
			   
	<tr>  
    <td></td>
	<td>NEW LABORATORIO CLINICO - SOLICITUD (SNS-MSP / HCU-form.010 / 2021)<br /> <?php echo $rs_laborato->fields["lab_fecharegistro"]; ?></td>
    <td>
	
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/pdfdoc.png" ><br />Solicitud</td>
    <td <?php echo $linkimprimiri; ?> style="cursor:pointer" ><?php echo $logoinforme; ?></td>
  </tr>
</table>
	
	</td>
	<td>
	<?php //echo $links_data; ?>
	</td>	
  </tr>
				
				<?php
				    $rs_laborato->MoveNext();
				}
			   }
			
				//busca aboratorio nuevo
				
				
				
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				
				
				///=====================================================================================================
				
				
				   //busca imagen nuevo
				   
			   $busca_imagen="select * from dns_newimagenologia where imgag_tablaexterno='".$rs_tabeval->fields["tab_name"]."' and imgag_idexterno='".$rs_seccion->fields[$rs_tabeval->fields["tab_campoprimario"]]."' order by imgag_fecharegistro desc";
			   $rs_imagen = $DB_gogess->executec($busca_imagen,array());
			   if($rs_imagen)
			   {
			     while (!$rs_imagen->EOF) {	
				 
				 $campo_fechasecun='imgag_fecharegistro';
				 
				 $eteneva_id=0;
				 $tab_id=587;
				 $mnupan_id=217;
				 $campos_data='';
                 $campos_data64='';
                 $campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
                 $campos_data64=base64_encode($campos_data);
				 $linkpdf="pdfnewimagen";
                 $urllink="pdfformularios/".$linkpdf.".php?ssr=".$campos_data64."|"."+".$rs_imagen->fields["imgag_id"];				 
				 $linkimprimir="onClick=ver_pdfform('".$urllink."')";
				 
				 //busca id informe
				 $busca_informeimg="select * from dns_newimagenologiainfo where imgag_id='".$rs_imagen->fields["imgag_id"]."'";
				 $rs_imageninforme = $DB_gogess->executec($busca_informeimg,array());				 
				 //busca id informe
				 
				 $logoinforme='';
				 $eteneva_idi=0;
				 $tab_idi=589;
				 $mnupan_idi=218;
				 $linkpdfi="pdfnewimageninforme";  
                 $campos_datai='';
                 $campos_data64i='';
                 $campos_datai='iddata=589&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=218';
                 $campos_data64i=base64_encode($campos_datai); 
				 $urllinki="pdfformularios/".$linkpdfi.".php?ssr=".$campos_data64i."|"."+".$rs_imageninforme->fields["imginfo_id"];		
				 
				 if($rs_imageninforme->fields["imginfo_id"]>0)
				 {
				   $linkimprimiri="onClick=ver_pdfform('".$urllinki."')";
				   $logoinforme='<img src="images/pdfdoc.png" ><br />Informe';			 
				 }	 
				 
				 
			   ?>
			   
			   <tr>  
    <td></td>
	<td>IMAGENOLOGIA - SOLICITUD (SNS-MSP / HCU-form.012 / 2021)<br><?php echo $rs_imagen->fields["imgag_fecharegistro"]; ?></td>
    <td>
	
	
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/pdfdoc.png" ><br />Solicitud</td>
    <td <?php echo $linkimprimiri; ?> style="cursor:pointer" ><?php echo $logoinforme; ?></td>
  </tr>
</table>
	
	</td>
	<td>
	<?php //echo $links_data; ?>
	</td>	
  </tr>
				
				<?php
				    $rs_imagen->MoveNext();
				}
			   }
				//busca imagen nuevo
				
				
				
				///======================================================================================================
				
				
				
				

                   
				   $rs_seccion->MoveNext();
				}
			}	


       $rs_tabeval->MoveNext();	   
     }
}
?>  
</table>

<script type="text/javascript">
<!--

function ver_pdfform(url)
{

   location.href = url;

}

function sin_acceso()
{
   alert("No tiene acceso a este documento, llame al administrador para solicitar el acceso...");

}

function imprimir_datos(tab_id,clie_id,atenc_id,eteneva_id,mnupan_id,id)
{

   myWindow3=window.open('aplicativos/documental/datos_substandarformunico_print.php?iddata='+tab_id+'&pVar2='+clie_id+'&pVar4='+atenc_id+'&pVar5='+eteneva_id+'&pVar3='+mnupan_id+'&pVar9='+id,'ventana_reporteunico','width=850,height=700,scrollbars=YES');

   myWindow3.focus();



}
//  End -->
</script>