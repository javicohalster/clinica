<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=44440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

$genr_id=$_POST["genr_id"];
$valcedula_val=@$_POST["valcedula_val"];

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles
for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
	     $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");

include("../libreria/envio.php");
require_once("PHPMailer_v51/class.phpmailer.php");
require_once("PHPMailer_v51/class.smtp.php");
include("config_email_phpmailer.php");
 
$objformulario= new  ValidacionesFormulario();
$obj_funciones=new util_funciones();
include("codebarra/Barcode.php");


$cabecer_val='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ROL DE PAGOS</title>
<style type="text/css">
<!--
.css_titulo {
	font-size: 14px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

.css_txt {
	font-size: 10px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

.css_txt8 {
	font-size: 8px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

.css_txts {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
</head>

<body>';


$pie_valor='</body>
</html>';
 
$url="../plantillas/rolde_pagos.php";
$comprobantepdf=$obj_funciones->leer_contenido_completo($url);

$emp_id=1;
$nombre_empresa="select * from app_empresa where emp_id='".$emp_id."'"; 
$resultl_empresa = $DB_gogess->executec($nombre_empresa,array());

$logo='<br><center><img src="../archivo/'.$resultl_empresa->fields["emp_logo"].'" width="210" /></center>';

$comprobantepdf=str_replace("-logo-",$logo,$comprobantepdf);

$comprobantepdf=str_replace("-titulo-",utf8_encode($resultl_empresa->fields["emp_nombre"]),$comprobantepdf);

$comprobantepdf_condata='';

$lista_rolg="select * from conco_generarroles where genr_id='".$genr_id."'";
$resultl_rolg = $DB_gogess->executec($lista_rolg,array());

$genr_anio=$resultl_rolg->fields["genr_anio"];
$genr_mes=$resultl_rolg->fields["genr_mes"];

$mes=array();
$mes[1]='ENERO';
$mes[2]='FEBRERO';
$mes[3]='MARZO';
$mes[4]='ABRIL';
$mes[5]='MAYO';
$mes[6]='JUNIO';
$mes[7]='JULIO';
$mes[8]='AGOSTO';
$mes[9]='SEPTIEMBRE';
$mes[10]='OCTUBRE';
$mes[11]='NOVIEMBRE';
$mes[12]='DICIEMBRE';


$concatena='';
//$lista_empleados="select * from conco_roles where genr_id='".$genr_id."' and usua_id in(1,257,272,55,255,285,231,275,69,27,261)";
if($valcedula_val)
{
$datos_empl="select * from app_usuario where usua_rucci='".$valcedula_val."'";
$resultl_empl=$DB_gogess->executec($datos_empl,array());
$lista_empleados="select * from conco_roles  where genr_id='".$genr_id."' and usua_id in(".$resultl_empl->fields["usua_id"].") ";
}
else
{
$lista_empleados="select * from conco_roles inner join app_usuario on conco_roles.usua_id=app_usuario.usua_id where genr_id='".$genr_id."' and roles_enviomail=0 order by usua_apellido asc limit 20";
}

//echo $lista_empleados;

$ilista_arch=0;
$array_larch=array();

$resultl_listaroles = $DB_gogess->executec($lista_empleados,array());
if($resultl_listaroles)
{
      while (!$resultl_listaroles->EOF)
		{
		
		  $datos_empleado="select * from app_usuario where usua_id='".$resultl_listaroles->fields["usua_id"]."'";
		  $resultl_empleado= $DB_gogess->executec($datos_empleado,array());
		  
		  $comprobantepdf_condata=str_replace("-titulo-",utf8_encode($resultl_empresa->fields["emp_nombre"]),$comprobantepdf);
		  $comprobantepdf_condata=str_replace("-subtitulo-",utf8_encode($resultl_empresa->fields["emp_departamento"]),$comprobantepdf);
		  $comprobantepdf_condata=str_replace("-nombres-",utf8_encode($resultl_empleado->fields["usua_nombre"]." ".$resultl_empleado->fields["usua_apellido"]),$comprobantepdf_condata);
		  $comprobantepdf_condata=str_replace("-cedula-",utf8_encode($resultl_empleado->fields["usua_rucci"]),$comprobantepdf_condata);
		  
		  //$obtiene_cargos="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace inner join cmb_coddepartamento on 		
//grid_infolaboral3.info_codigodepartamento=cmb_coddepartamento.coddep_id inner join cmb_puestoinstitucional on grid_infolaboral3.info_puestoinstitucional=cmb_puestoinstitucional.tipoinst_id where info_fechadesalida='0000-00-00' and app_usuario.usua_id='".$resultl_listaroles->fields["usua_id"]."' order by info_id desc limit 1";
          $obtiene_cargos="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace inner join app_tipounidad on 		
grid_infolaboral3.info_unidad=app_tipounidad.tipouni_id inner join cmb_puestoinstitucional on grid_infolaboral3.info_puestoinstitucional=cmb_puestoinstitucional.tipoinst_id where info_fechadesalida='0000-00-00' and app_usuario.usua_id='".$resultl_listaroles->fields["usua_id"]."' order by info_id desc limit 1";
		  $rs_cargos=$DB_gogess->executec($obtiene_cargos,array());
	      	  
			  
	  
//info_puestoinstitucionalx

//info_codigodepartamentox
//coddep_codigo,coddep_nombre
		  
		  $comprobantepdf_condata=str_replace("-puestoi-",utf8_encode($rs_cargos->fields["tipouni_id"]." ".$rs_cargos->fields["tipoinst_nombre"]),$comprobantepdf_condata);
		  //$comprobantepdf_condata=str_replace("-unidad-",utf8_encode($rs_cargos->fields["coddep_codigo"]." ".$rs_cargos->fields["coddep_nombre"]),$comprobantepdf_condata);
		  $comprobantepdf_condata=str_replace("-unidad-",utf8_encode($rs_cargos->fields["tipouni_nombre"]),$comprobantepdf_condata);
		  $comprobantepdf_condata=str_replace("-mes-",utf8_encode($mes[$resultl_rolg->fields["genr_mes"]]),$comprobantepdf_condata);
		  $comprobantepdf_condata=str_replace("-anio-",utf8_encode($resultl_rolg->fields["genr_anio"]),$comprobantepdf_condata);
		  
		  $comprobantepdf_condata=str_replace("-sueldon-",utf8_encode($rs_cargos->fields["info_rmu"]),$comprobantepdf_condata);
		  
		  
		  $total_ingresos=0;
		  $total_egresos=0;
		  
		  $ingreso_val='';
		  $ingreso_val=' <table width="100%" border="0" cellpadding="0" cellspacing="0">';
		  $busca_ingresos="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=1 and tiporub_id=1";
		  
		  //echo $busca_ingresos."<br>";
		  $resultl_ingresos= $DB_gogess->executec($busca_ingresos,array());
		  if($resultl_ingresos)
           {
		       while (!$resultl_ingresos->EOF)
		       {
			    
				  $ingreso_val.='<tr><td class="css_txt" ><b>SUELDO:</b></td> <td class="css_txts" >'.number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '').'</td></tr>';
				  
				  $total_ingresos=$total_ingresos+number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				
				$resultl_ingresos->MoveNext();
		       }
		   }
		   
		  //otros ingresos
		  
		   $busca_ingresos="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=1 and tiporub_id!=1";
		  
		  $resultl_ingresos= $DB_gogess->executec($busca_ingresos,array());
		  if($resultl_ingresos)
           {
		       while (!$resultl_ingresos->EOF)
		       {
			    
				  $ingreso_val.='<tr><td class="css_txt" ><b>'.$resultl_ingresos->fields["rubrg_nombre"].':</b></td> <td class="css_txts" >'.number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '').'</td></tr>';
				  $total_ingresos=$total_ingresos+number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  
				$resultl_ingresos->MoveNext();
		       }
		   }
		  
		  //otros ingresos
		  $ingreso_val.='<tr><td><b>&nbsp;</b></td><td>&nbsp;</td></tr>'; 
		  $ingreso_val.='<tr><td class="css_txt" ><b>TOTAL INGRESOS</b></td> <td class="css_txts" ><b>'.number_format($total_ingresos, 2, '.', '').'</b></td></tr>'; 		   
		  $ingreso_val.='</table>';
		  $comprobantepdf_condata=str_replace("-ingresos-",utf8_encode($ingreso_val),$comprobantepdf_condata);
		  
		  
		  //egresos varios
		  $egresos_val='';
		  $egresos_val=' <table width="100%" border="0" cellpadding="0" cellspacing="0">';
		  
		  
		  $busca_egresos="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=2";
		  
		  $resultl_egresos= $DB_gogess->executec($busca_egresos,array());
		  if($resultl_egresos)
           {
		       while (!$resultl_egresos->EOF)
		       {
			    
				  $egresos_val.='<tr><td class="css_txt" ><b>'.$resultl_egresos->fields["rubrg_nombre"].':</b></td> <td class="css_txts" >'.number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '').'</td></tr>';				  
				  $total_egresos=$total_egresos+number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  
				
				$resultl_egresos->MoveNext();
		       }
		   }
		  
		  $egresos_val.='<tr><td><b>&nbsp;</b></td><td>&nbsp;</td></tr>'; 
		  $egresos_val.='<tr><td class="css_txt" ><b>TOTAL EGRESOS</b></td> <td class="css_txts" ><b>'.number_format($total_egresos, 2, '.', '').'</b></td></tr>';
		  $egresos_val.='</table>';
		  //echo $egresos_val;
		  $comprobantepdf_condata=str_replace("-egresos-",utf8_encode($egresos_val),$comprobantepdf_condata);
		  //egresos varios
		  
		  //patronal
		  $valor_patronal='';
		  $busca_patronal="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=3";
		  
		  $resultl_patronal= $DB_gogess->executec($busca_patronal,array());
		  if($resultl_patronal)
           {
		       while (!$resultl_patronal->EOF)
		       {
			    			  
				  $valor_patronal=number_format($resultl_patronal->fields["rubrg_valor"], 2, '.', '');
				  
				
				$resultl_patronal->MoveNext();
		       }
		   }
		  
		  $comprobantepdf_condata=str_replace("-apatronal-",$valor_patronal,$comprobantepdf_condata);
		  
		  //patronal
   
          $total_recibir=0;
		  $total_recibir=$total_ingresos-$total_egresos;
		  $total_recibir=number_format($total_recibir, 2, '.', '');
          //totales
		  $comprobantepdf_condata=str_replace("-totalrecibir-",$total_recibir,$comprobantepdf_condata);
		  //totales
  

		  
		 // $concatena.=$comprobantepdf_condata.'<div style="page-break-after: always"></div>';
		  
		  $concatena='';
		  $concatena=$comprobantepdf_condata;		  
		  $concatena=$cabecer_val.$concatena.$pie_valor;
		  
		  //genera_pdf		  
		  
		  $xml="roldepagos";
		  $dompdf = new DOMPDF();
		  $dompdf->set_paper('A4', 'portrait');
		  $dompdf->load_html($concatena, 'UTF-8');
		  $dompdf->render();		
		  $fecha_hoy=date("Y-m-d");		
		  $archivo = "temp/ROL_ID".$resultl_listaroles->fields["usua_id"]."_".$genr_id."_".$fecha_hoy."_".$_SESSION['datadarwin2679_sessid_inicio'].".pdf";
		  $patharchpdf=$archivo;
		  $nombrearchpdf="ROL_ID".$resultl_listaroles->fields["usua_id"]."_".$genr_id."_".$fecha_hoy."_".$_SESSION['datadarwin2679_sessid_inicio'].".pdf";
		  
		  $id = fopen($archivo, 'w+');
          $cadena = $dompdf->output();
          fwrite($id, $cadena);
          fclose($id);
		  
		  $array_larch[$ilista_arch]=$nombrearchpdf;		  
		  $ilista_arch++;
		  
		  //genera_pdf
		  
		  
		  //envia por correo
		  $archivos=array();
		  $archivos[0]["path"]=$patharchpdf;
		  $archivos[0]["nombre"]=$nombrearchpdf;		  
		  $texto_valor="Le enviamos su documento electr&oacute;nico.";
		  $TITULOEMAIL="DOCUMENTO ELECTRONICO GAD ROL-".$resultl_empleado->fields["usua_rucci"];
		  
		  $email_cliente=$resultl_empleado->fields["usua_email"];
		 // $email_cliente="franklin.aguas@gmail.com";
		  //$email_extra="demrodriguez79@gmail.com";
		  
		  $faccab_nombrerazon_cliente=$resultl_empleado->fields["usua_nombre"];

		  
		  if($email_cliente)
		  {
		  $estado_correo=enviar_correo($TITULOEMAIL,$archivos,$email_cliente,$faccab_nombrerazon_cliente,"rrhhlaconcordia@gmail.com","ROL",$texto_valor,$email_extra,$DB_gogess);
		  }
		  
		  if(!($email_cliente))
					{
						echo "El cliente no tiene registrado un correo electr&oacute;nico...";	
					}
		  
		  if($estado_correo==1)
					{
					  
					     echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000'>Correo: Enviado satisfactoriamente...</div>";
						
									$fechahoy=date("Y-m-d H:i:s"); 
									
									$actualizaemail="update conco_roles set roles_enviomail='1' where roles_id='".$resultl_listaroles->fields["roles_id"]."'";
									 
									$okv=$DB_gogess->executec($actualizaemail,array()); 
						
						  unlink($patharchpdf);
						  unlink($patharchxml);
						  echo "Enviado a:".$email_cliente."<br><hr>";
					  
					
					}		
		  
		  if($estado_correo==0)
					{
						  echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'>Correo:NO Enviado </div>";
						  if($patharchpdf)
						  {
						  unlink($patharchpdf);
						  unlink($patharchxml);
						  }
					}				
		  //envia por correo
		  
		  
		
		$resultl_listaroles->MoveNext();
		}
}		

//echo $concatena;
//$aleatorioval=date("YmdHis");
//$valoralet=mt_rand(1,500);
//$nombre_filetotal=$xml."_".$genr_id."_".$genr_anio."_".$genr_mes."_".$aleatorioval.$valoralet.".pdf";

//include 'PDFMerger.php';
//$pdf = new PDFMerger;
//for($i=0;$i<count($array_larch);$i++)
//{
  // $pdf->addPDF('temp/'.$array_larch[$i], 'all');
//}
//$pdf->merge('file', 'temp/'.$nombre_filetotal);
//$pdf->merge('download', 'temp/'.$nombre_filetotal); 
 
 
 
}

?>