<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$compra_enlace=$_POST["compra_enlace"];

$lista_valor=array();

$lista_detalles="select sum(prcomp_subtotal) as total,prcomp_taricodigo  from lpin_productocompra where compra_enlace='".$compra_enlace."' group by prcomp_taricodigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valor[$rs_data->fields["prcomp_taricodigo"]]=$lista_valor[$rs_data->fields["prcomp_taricodigo"]]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


 $lista_detalles="select sum(cuecomp_subtotal) as total,taric_id  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' group by taric_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $sacatari="select * from beko_tarifa where tari_id='".$rs_data->fields["taric_id"]."'";
		 $rs_sacatar = $DB_gogess->executec($sacatari,array());		 
		 $tari_codigo=$rs_sacatar->fields["tari_codigo"];	  
		 
	     $lista_valor[$tari_codigo]=$lista_valor[$tari_codigo]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(acfi_subtotal) as total,tarif_id  from dns_activosfijos where compra_enlace='".$compra_enlace."' group by tarif_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $sacatari="select * from beko_tarifa where tari_id='".$rs_data->fields["tarif_id"]."'";
		 $rs_sacatar = $DB_gogess->executec($sacatari,array());		 
		 $tari_codigo=$rs_sacatar->fields["tari_codigo"];	  
		 
	     $lista_valor[$tari_codigo]=$lista_valor[$tari_codigo]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
//print_r($lista_valor);
 
//saca descuentos
$array_descuentos=array();
$lista_detalles="select sum(prcomp_descuentodolar) as descuento  from lpin_productocompra where compra_enlace='".$compra_enlace."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	    $array_descuentos["descuento"]=$array_descuentos["descuento"]+$rs_data->fields["descuento"];
	  
	   $rs_data->MoveNext();
	  }
 }	  
 

$lista_detalles="select sum(cuecomp_descuentodolar) as descuento  from lpin_cuentacompra where compra_enlace='".$compra_enlace."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $array_descuentos["descuento"]=$array_descuentos["descuento"]+$rs_data->fields["descuento"];
	  
	    $rs_data->MoveNext();
	  }
  }	
  

//saca descuentos  

//saca iva
$valor_iva=array();
$totales_iva=0;
$gran_total=0;


$sacatari="select * from beko_tarifa";
$rs_sacatar = $DB_gogess->executec($sacatari,array());	
 if($rs_sacatar)
 {
	  while (!$rs_sacatar->EOF) {	  
	  
	  $valor_iva[$rs_sacatar->fields["tari_codigo"]]=($lista_valor[$rs_sacatar->fields["tari_codigo"]]*$rs_sacatar->fields["tari_valor"])/100;
	  
	  $gran_total=$gran_total+$lista_valor[$rs_sacatar->fields["tari_codigo"]];
	  $totales_iva=$totales_iva+$valor_iva[$rs_sacatar->fields["tari_codigo"]];
	  
	  $rs_sacatar->MoveNext();
	  }
 }	  

//saca iva
  
//saca totales

$ttotal=$gran_total+$totales_iva;

//saca totales
//print_r($lista_valor);

?>

<script language="javascript">
<!--

<?php
if(!(@$lista_valor[2]))
{
 $lista_valor[2]=0;
} 

if(!(@$lista_valor[4]))
{
 $lista_valor[4]=0;
} 

if(!(@$lista_valor[5]))
{
 $lista_valor[5]=0;
} 

if(!(@$lista_valor[8]))
{
 $lista_valor[8]=0;
} 

if(!(@$lista_valor[0]))
{
 $lista_valor[0]=0;
} 

$valor_rettotal=0;
$valor_rettotal=$lista_valor[2]+$lista_valor[4]+$lista_valor[5]+$lista_valor[8];

$concatena_desglo='<div class="form-group"> <div class="col-md-12"> ';

   $lista_bitar="select tari_codigo,tari_nombre from beko_tarifa";
   $rs_databitar = $DB_gogess->executec($lista_bitar,array());
   if($rs_databitar)
     {
	  while (!$rs_databitar->EOF) {
	  
	      if(@$lista_valor[$rs_databitar->fields["tari_codigo"]]>0)
		  {
		     //$concatena_desglo.= '<div class="form-group"><div class="col-xs-3" align="right">Subtotal '.$rs_databitar->fields["tari_nombre"].': </div><div class="col-xs-7" style="text-align:left" >'.$lista_valor[$rs_databitar->fields["tari_codigo"]].'</div><div class="col-xs-1"></div><div class="col-xs-1"></div></div> </div>';
			 
			    $concatena_desglo.= ' <div class="form-group">';
			    $concatena_desglo.= ' <div class="col-xs-3" align="right">Subtotal '.$rs_databitar->fields["tari_nombre"].': </div>';
				$concatena_desglo.= ' <div class="col-xs-7" style="text-align:left" >'.$lista_valor[$rs_databitar->fields["tari_codigo"]].'</div>';
				$concatena_desglo.= ' <div class="col-xs-1"></div><div class="col-xs-1"></div>';
				$concatena_desglo.= ' </div> </div>';
			 
		  }
	  
	    $rs_databitar->MoveNext();
	  }
	 } 

$concatena_desglo.=' </div></div>';   

?>

$('#despliega_desglo').html('<?php echo $concatena_desglo; ?>');

$('#compra_subtotaliva').val('<?php echo round($valor_rettotal, 2); ?>');
$('#compra_subtotalceroiva').val('<?php echo round($lista_valor[0],2); ?>');
$('#compra_descuento').val('<?php echo round($array_descuentos["descuento"],2); ?>');
$('#compra_iva').val('<?php echo round($totales_iva,2); ?>');
$('#compra_total').val('<?php echo round($ttotal,2); ?>');

lista_retenciones();

enviar_formulariodata('form_dns_compras');

//-->
</script>

<?php

}

?>