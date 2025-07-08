<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
$fechahoy=date("Y-m-d");
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename="."resultado_".$fechahoy.".xls");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
require_once($director."libreria/dompdf/dompdf_config.inc.php");

$objperfil=new objetosistema_perfil();
if($_SESSION['datadarwin2679_sessid_inicio'])
{
$saca_datosus="select * from media_usuario inner join media_pais on media_usuario.pais_id=media_pais.pais_id where usua_id=?";
$ok_resultado=$DB_gogess->executec($saca_datosus,array($_SESSION['datadarwin2679_sessid_inicio']));
$suma_total_valor=0;
$suma_total_pesos=0;

?><?php
$variable_imp='<style type="text/css">
<!--
td,th {
	
	font-size: 11px;
}
.Estilo1 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo6 {
	font-size: 11px;
	font-weight: bold;
	color: #FFFFFF;
	
}
.Estilo9 {
	font-size: 11px;
	
}
.borde_tabla{
	font-size: 11px;
	color: #000000;
	text-decoration: none;
	border: 1px solid #000000;
}
.titulo_nombre
{
	font-size: 12px;
	color: #000000;
}
.Estilo11 {font-size: 12px; color: #000000; font-weight: bold; }
-->
</style>


<page style="font-size: 11px" footer="page" >';
?>
<?php
$variable_imp.='<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="181"><img src="http://10.1.13.103/Iberoamericana/images/logocumbre.png" width="181" height="166"></td>
    <td width="400"><div align="center"><span class="Estilo1">Herramienta de autoevaluaci&oacute;n de la transparencia, rendici&oacute;n de cuentas e integridad judicial Iberoamericana</span><br>
    </div></td>
  </tr>
</table>
<table width="400" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <td width="198"><span class="Estilo11">Nombres y apellidos:</span></td>
    <td width="486"><span class="Estilo9">'.$ok_resultado->fields["usua_nombre"]." ".$ok_resultado->fields["usua_apellido"].'</span></td>
  </tr>
  <tr>
    <td><span class="Estilo11">Pa&iacute;s:</span></td>
    <td><span class="Estilo9">'.$ok_resultado->fields["pais_nombre"].'</span></td>
  </tr>
  <tr>
    <td><span class="Estilo11">Instituci&oacute;n:</span></td>
    <td><span class="Estilo9">'.$ok_resultado->fields["usua_institucion"].'</span></td>
  </tr>
  <tr>
    <td><span class="Estilo11">Periodo evaluado:</span></td>
    <td><span class="Estilo9">'.$ok_resultado->fields["usua_periodo"].'.</span></td>
  </tr>
</table><br>
<table width="100px" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr bgcolor="#4270BB">
    <td class="Estilo6"  align="center"  ><span class="Estilo6">VARIABLE (&Aacute;REA)</span></td>
    <td class="Estilo6"  width="500" ><div align="center">INDICADOR</div></td>
    <td class="Estilo6" align="center" >CALIFICACI&Oacute;N</td>
  </tr>';
 ?>
 <?php
 //$lista_vr="select * from media_formulario inner join media_categoriaform on media_formulario.categf_id=media_categoriaform.categf_id";
 $lista_vr="select * from media_categoriaform";
 $rs_lvr = $DB_gogess->executec($lista_vr,array());
 if($rs_lvr)
	{
		while (!$rs_lvr->EOF) {

 $variable_imp.='<tr bgcolor="#4270BB">
    <td colspan="3" align="center" class="Estilo6" >'.$rs_lvr->fields["categf_nombre"].'</td>
  </tr>';

  $lista_formulario="select * from media_formulario where categf_id=?";
  $rs_listaform= $DB_gogess->executec($lista_formulario,array($rs_lvr->fields["categf_id"]));
  
  $cant_formularios=$rs_listaform->RecordCount();
  
  $numero_act=0;
  
  if($rs_listaform)
	{
	  while (!$rs_listaform->EOF) {
	  $numero_act++;
 
	  //lista preguntas
	  $cuenta_preg="select count(*) as npreg from media_preguntas where form_id=?";
	  $rs_cantiprg= $DB_gogess->executec($cuenta_preg,array($rs_listaform->fields["form_id"]));
	  $cant_span=$rs_cantiprg->fields["npreg"];
	  //lista preguntas
  
       //lista preguntas
	   $idc=1;
	   $lista_dtpreg="select * from  media_preguntas where form_id=?";
	   $rs_listapreg= $DB_gogess->executec($lista_dtpreg,array($rs_listaform->fields["form_id"]));
	   if($rs_listapreg)
	   {
	       while (!$rs_listapreg->EOF) {
		   
		   if($idc==1)
		   {
		     
			
			 $cant_span=$cant_span+1;
			 
			
			 
			 $valor_rowspan='<td rowspan="'.$cant_span.'"   class="borde_tabla"  bgcolor="#77A0D2" ><div div align="center" class="Estilo6">'.trim($rs_listaform->fields["form_nombre"]).'</div></td>';
		   }
		   $idc++;
		   
	  
  $variable_imp.='<tr >'.$valor_rowspan;
  // echo $valor_rowspan; 
  $valor_rowspan='';
 
    $variable_imp.='<td class=borde_tabla >'.$rs_listapreg->fields["pregf_nombre"].'</td>';
     
	  $lista_calf="select * from media_total where usua_id=? and form_id=? and pregf_id=? and tot_periodo='".$_SESSION['datadarwin2679_sessid_periodoactual']."'";
	  $rs_okcalif= $DB_gogess->executec($lista_calf,array($_SESSION['datadarwin2679_sessid_inicio'],$rs_listaform->fields["form_id"],$rs_listapreg->fields["pregf_id"]));
	  $total_gen=$rs_okcalif->fields["tot_general"];
	  $variable_imp.='<td class=borde_tabla >'.$rs_okcalif->fields["tot_resultado"]." %".'</td></tr>';
  

	        $rs_listapreg->MoveNext();
	      }
		  
		

$variable_imp.='<tr class="Estilo9">
  <td class=borde_tabla bgcolor="#77A0D2" align="center" ><span class="Estilo6" >CALIFICACI&Oacute;N:</span></td>
    <td class=borde_tabla bgcolor="#77A0D2" ><span class="Estilo6" >'.$total_gen." %".'</span></td> </tr>';
	//echo $rs_listaform->fields["form_peso"];
	$suma_total_valor=$suma_total_valor+($total_gen*$rs_listaform->fields["form_peso"]);
	$suma_total_pesos= $suma_total_pesos+$rs_listaform->fields["form_peso"];
	$resultado_finalpori=0;
	
	
	   if($cant_formularios==$numero_act)
			 {
			 
			 $resultado_finalpori=$suma_total_valor/$suma_total_pesos;
			 
			 
			 $nombre_i='';
			$nombre_i=str_replace("III/ ","",$rs_lvr->fields["categf_nombre"]);
			$nombre_i=str_replace("II/ ","",$nombre_i);
			$nombre_i=str_replace("I/ ","",$nombre_i);
			$nombre_i=str_replace("Indicadores de","",$nombre_i);
			 
			 $variable_imp.='<tr class="Estilo9">
  <td class=borde_tabla bgcolor="#4270BB" colspan="2" align="center" > <span class="Estilo6" > Calificaci&oacute;n '.$nombre_i.'</span></td>
    <td class=borde_tabla bgcolor="#4270BB" ><span class="Estilo6" >'.round($resultado_finalpori).'%</span></td> </tr>';
	
	        $suma_total_valor=0;
			 $suma_total_pesos=0;
			 $resultado_finalpori=0;
	
			 }
		  
		  
		  
	   }
	   //lista preguntas
	   
 
  
         $rs_listaform->MoveNext();
      }
   }
 
               $rs_lvr->MoveNext();
                }
  
   }
  
  
   $variable_imp.='<tr bgcolor="#4270BB" >
    <td colspan="4" align="center" ><span class="Estilo6">*Si en alguna de las calificaciones anteriores obtuvo el siguiente resultado "%", favor revisar que hay contestado todas las preguntas.</span></td>
  </tr>';
  
  
  $variable_imp.='<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>';


$variable_imp.='</page>';



//$variable_imp=str_replace("","",utf8_encode($variable_imp);

echo utf8_encode($variable_imp);
/*
$dompdf = new DOMPDF();
$dompdf->load_html($variable_imp, 'UTF-8');
$dompdf->render();
$dompdf->stream("resultados.pdf");
*/
}
?>