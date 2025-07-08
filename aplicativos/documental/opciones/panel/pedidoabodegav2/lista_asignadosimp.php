<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_GET["excel"]==1)
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."LISTA_".$fechahoy.".xls");
}

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$partop_id=$_GET["partop_id"];
$centro_id=$_GET["centro_id"];

if($centro_id==1)
{
  $centro_id='55';
}

$lista_bprecuentac="select * from lpin_parteoperatorio where partop_id='".$partop_id."'";
$rs_bprecuentac = $DB_gogess->executec($lista_bprecuentac,array());
$cuenta_v=0;
?><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td><?php
	  echo "<b>SALA:</b> ".$rs_bprecuentac->fields["partop_sala"]."<br>";
echo "<b>HORA:</b> ".$rs_bprecuentac->fields["partop_hora"]."<br>";
echo "<b>PACIENET:</b> ".$rs_bprecuentac->fields["partop_paciente"]."<br>";
	  
	  ?></td>
      <td>
	  <?php
	  echo "<b>PROCEDIMIENTO:</b> ".$rs_bprecuentac->fields["partop_procedimiento"]."<br>";
echo "<b>CIRUJANO:</b> ".$rs_bprecuentac->fields["partop_cirujano"]."<br>";
echo "<b>HAB:</b> ".$rs_bprecuentac->fields["partop_hab"]."<br>";
echo "<b>T. QUIROFANO:</b> ".$rs_bprecuentac->fields["partop_tquirofano"]."<br>";
	  ?>	  
	  </td>
    </tr>
  </table>


  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Solicita de </div></td> 
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Usuario</div></td>       
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad Pedida</div></td>
	   <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad Entregada </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Fecha Registro </div></td>
    </tr>
	<?php
	$valor_total=0;
	//$lista_precuentas="select * from dns_preddetalleparteoperatorio left join dns_centrosalud on dns_preddetalleparteoperatorio.centrob_id=dns_centrosalud.centro_id  where partop_id='".$partop_id."' and detapre_tipo in (1,2) and dns_preddetalleparteoperatorio.centrob_id in (".$centro_id.",1,9999,8888)";
	
 $lista_precuentas="select *,dns_preddetalleparteoperatorio.usua_id as usario_enf from dns_preddetalleparteoperatorio left join dns_centrosalud_origen on dns_preddetalleparteoperatorio.centrob_id=dns_centrosalud_origen.centro_id  where partop_id='".$partop_id."' and detapre_tipo in (1,2)";
	
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) { 
	  
   $usario_enf=$rs_lprecuentas->fields["usario_enf"];
   $n_usuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$usario_enf,$DB_gogess);	   

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==1)
   {
     $estado_prec='MEDICAMENTOS';
   
   }
   
   if($rs_lprecuentas->fields["detapre_tipo"]==2)
   {
     $estado_prec='INSUMOS';
   
   }
   
   
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_preddetalleparteoperatorio'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';
   
   
$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; 
   $cuenta_v++;
	?>
    <tr>
       <td height="21" class="css_texto"><div align="center">
        <?php echo $cuenta_v; ?>
       </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"].' '.$rs_lprecuentas->fields["detapre_observacion"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $n_usuario; ?></div></td>   
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  
	  
//$ncampo_val='detapre_observacion';
//echo '<input name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_camposzz('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" />';
						
	  
	  ?>	  
	  </div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	    <td class="css_texto" style="font-size:10px" ><div align="center"></div></td>
     <!-- <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precioventa"]; ?></div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo ($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></td> -->
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	<?php
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>

<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	 <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b>&nbsp;</b></div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
</table>

<br /><br /><br />

  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center">__________________________________</div></td>
      <td>&nbsp;</td>
      <td><div align="center">__________________________________</div></td>
    </tr>
    <tr>
      <td><div align="center">FIRMA SOLICITANTE </div></td>
      <td>&nbsp;</td>
      <td><div align="center">FIRMA BODEGA </div></td>
    </tr>
    <tr>
      <td><div align="center">NOMBRE:</div></td>
      <td>&nbsp;</td>
      <td><div align="center">NOMBRE:</div></td>
    </tr>
  </table>
  <div id="campo_valorxx"></div>

<script type="text/javascript">
<!--
function guardar_camposzz(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valorxx").load("aplicativos/documental/opciones/panel/pedidoabodega/guarda_campop.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){       

  });  

$("#campo_valorxx").html("Espere un momento...");



}

//  End -->
</script>