<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$centro_id=$_POST["centro_id"];
$verifica_redpu=$_POST["verifica_redpu"];

$tabla_srock='';

if($centro_id==1)
{
$centro_id=55;
$tabla_srock='dns_principalstockactual';
}
else
{
$tabla_srock='dns_stockactual';
}

$b_data=trim($_POST["b_data"]);

$clie_id=$_POST["clie_id"];



$precu_id=trim($_POST["precu_id"]);
//===========================================================
$lista_buprecuenta="select * from dns_precuenta where precu_id='".$precu_id."'";
$rs_buprecuenta = $DB_gogess->executec($lista_buprecuenta,array());

     $convepr_id=$rs_buprecuenta->fields["convepr_id"];
	$lista_convenio="select * from pichinchahumana_extension.dns_convenios where conve_id='".$convepr_id."'";
	$rs_conve= $DB_gogess->executec($lista_convenio,array());
	$rs_conve->fields["conve_redpublica"];
	
	$code_redp=0;
	$code_redp=$rs_conve->fields["conve_redpublica"];
	
	$red_publica='NO';
	if($rs_conve->fields["conve_redpublica"]==1)
	{
	  $red_publica='SI';
	}
	
	

//===========================================================



//echo $tabla_srock;
$activodespacho=1;
if($activodespacho==1)
{
?>


<table width="250" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td style="font-size:10px">CODIGO</td>
	<td style="font-size:10px" >NOMBRE</td>
   <!-- <td style="font-size:10px" >STOCK ACTUAL</td> -->
   <td style="font-size:10px; background-color:#D2E3EC" ><b>PRIV</b></td>
   <td style="font-size:10px; background-color:#D2E3EC" ><b>RED PUBLICA</b></td>
    <td style="font-size:10px">DESCARGAR</td>
  </tr>
<?php

if($red_publica=='SI')
{
$lista_productos="select * from dns_cuadrobasicomedicamentos_vista where cuadrobm_redp=1 and (cuadrobm_codigoatc like '%".$b_data."%' or cuadrobm_principioactivo like '%".$b_data."%') order by  cuadrobm_principioactivo asc ";
}
else
{
$lista_productos="select * from dns_cuadrobasicomedicamentos_vista where cuadrobm_redp=0 and (cuadrobm_codigoatc like '%".$b_data."%' or cuadrobm_principioactivo like '%".$b_data."%') order by  cuadrobm_principioactivo asc ";

}

$consuladata_rep='';
if($verifica_redpu==1)
{
echo "<center><b>RED PUBLICA</b></center>";
$consuladata_rep=' cuadrobm_redp=1 and ';
}

$lista_productos="select * from dns_cuadrobasicomedicamentos_vista where  ".$consuladata_rep." (cuadrobm_codigoatc like '%".$b_data."%' or cuadrobm_principioactivo like '%".$b_data."%') order by  cuadrobm_principioactivo asc ";

$rs_bproductos = $DB_gogess->executec($lista_productos,array());
if($rs_bproductos)
 {
	while (!$rs_bproductos->EOF) { 
	
	$cuadrobm_id=$rs_bproductos->fields["cuadrobm_id"];
	
	$stockactual="select sum(stock_cantidad*stock_signo) as stactual from ".$tabla_srock." where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."'";
	$rs_stactua = $DB_gogess->executec($stockactual);
	
	$maximo_permitido=$rs_stactua->fields["stactual"];
	
	if($rs_stactua->fields["stactual"]>0)
	{
?>

  <tr>
    <td style="font-size:10px"><?php echo $rs_bproductos->fields["cuadrobm_codigoatc"]; ?></td>
	<td style="font-size:10px"><?php echo $rs_bproductos->fields["cuadrobm_nombrecomercial"]; ?></td>
	<!-- <td style="font-size:10px"><?php echo $rs_stactua->fields["stactual"]; ?></td> -->
	
	<?php
	$cuadrobm_privada='NO';
	$cuadrobm_redp='NO';
	
	if($rs_bproductos->fields["cuadrobm_privada"]==1)
	{
	  $cuadrobm_privada='SI';
	}
	
	if($rs_bproductos->fields["cuadrobm_redp"]==1)
	{
	  $cuadrobm_redp='SI';
	}
	
	?>
	
	<td style="font-size:10px; background-color:#D2E3EC"><b><?php echo $cuadrobm_privada; ?></b></td>
	<td style="font-size:10px; background-color:#D2E3EC"><b><?php echo $cuadrobm_redp; ?></b></td>
	
	
    <td><input type="button" name="Submit" value="--&gt;&gt;" onClick="ejecuta_despachar('<?php echo $cuadrobm_id; ?>','<?php echo $centro_id; ?>','<?php echo $maximo_permitido; ?>','<?php echo $clie_id; ?>')" ></td>
  </tr>
<?php 
     }


     $rs_bproductos->MoveNext();	
	}	
} 	
  
?>  
</table>

<?php
}
else
{
   echo "No activo para Despacho";

}
?>

<script type="text/javascript">
<!--



//  End -->
</script>