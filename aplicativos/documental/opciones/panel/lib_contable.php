<?php
/**
 * Contable Funciones
 * 
 * Este archivo permite obtener funciones standar para el sistema.
 * 
 * @author Franklin Aguas <franklin.aguas@gmail.com>
 * @version 1.0
 * @package util_funciones
 */

class contable_funciones{

var $DB_gogess;
var $camposbusqueda;

function despliegue_form($namemodulo,$mnupan_id)
{

$contenido='';   
   
$subindice_modulo="_".$namemodulo;
$carpeta_modulo=$namemodulo;

$comill_s="'";
$cliente_valor="";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_'.$namemodulo.'.php'.$comill_s.','.$comill_s.'FORMULARIO'.$comill_s.','.$comill_s.'divBody_interno_'.$namemodulo.$comill_s.','.$comill_s.$comill_s.',0,'.$comill_s.$mnupan_id.$comill_s.',0,0,0,0)" style=cursor:pointer';	

$contenido.='<div>';
$contenido.='<button type="button" class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;NUEVO</button>';


$ilistx=1;
$buscareporte="select * from rose_variabledeveloper where rept_publicado=1 and rept_activo=1 and mnupan_id='".$mnupan_id."'";
$rs_gogessform = $this->DB_gogess->executec($buscareporte,array());
if($rs_gogessform)
 {

     	while (!$rs_gogessform->EOF) {		
		    $ilistx++;	
	
$linkeditarbtn=' onclick="ver_reportedatamodulo('.$rs_gogessform->fields["vardev_id"].')" ';

$contenido.='&nbsp;&nbsp;<button type="button" class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"  '.$linkeditarbtn.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>'.$rs_gogessform->fields["vardev_nombre"].'</button>';
		
		
		$rs_gogessform->MoveNext();	
		}
 }		




$contenido.='</div>';
$contenido.='<div id="divBody_interno'.$subindice_modulo.'" ></div><p>&nbsp;</p><div align="center" id="grid'.$subindice_modulo.'" ></div>';	
   
return $contenido;

}


function despliegue_scripts($mnupan_id,$namemodulo)
{

$lista_campob='';
if($this->camposbusqueda)
{
 $listado_buscador=array();
 $listado_buscador=explode(",",$this->camposbusqueda);
 for($z=0;$z<count($listado_buscador);$z++)
 {
    $saca_tipodata=array();
	$saca_tipodata=explode("|",$listado_buscador[$z]);
	
	
	switch ($saca_tipodata[1]) {
			  case 'fecha':
				{
				  // if($_POST[$saca_tipodata[0]]!='' and )
				  $lista_campob.=" ".str_replace("_x","inicio_x",$saca_tipodata[0]).":$('#".str_replace("_x","inicio_x",$saca_tipodata[0])."').val(), "; 
				  $lista_campob.=" ".str_replace("_x","fin_x",$saca_tipodata[0]).":$('#".str_replace("_x","fin_x",$saca_tipodata[0])."').val(), "; 
				}
				break;
			  default:
				{				
				  $lista_campob.=" ".$saca_tipodata[0].":$('#".$saca_tipodata[0]."').val(), ";  
				}
			}
	
	
	
 }
 
}

$scritp_valor='';
$scritp_valor.='
function desplegar_grid_'.$namemodulo.'()
{

$("#grid_'.$namemodulo.'").load("aplicativos/documental/opciones/grid/'.$namemodulo.'/grid_'.$namemodulo.'.php",{
  '.$lista_campob.'
  pVar2:"",
  pVar3:"'.$mnupan_id.'",
  indice_grid:"_'.$namemodulo.'",
  namemodulo:"'.$namemodulo.'",
  campos_bu:"'.$this->camposbusqueda.'"

  },function(result){  

  });  

  $("#grid_'.$namemodulo.'").html("Espere un momento");  

}';

$scritp_valor.='
desplegar_grid_'.$namemodulo.'();';

return $scritp_valor;

}



}

?>