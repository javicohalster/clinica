<style type="text/css">
<!--
.css_titulo {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_texto {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$director="../../../../director/";
include ("../../../../director/cfgclases/clases.php");

function ver_precioterapia($clie_id,$DB_gogess)
{
   //-----------------------------------------
   $cantidad_nueva=1;
   $lista_hijos="select distinct tipopac_id,clie_nombre,clie_apellido,clie_id from app_cliente where clie_id='".$clie_id."'";
   $rs_datahijos = $DB_gogess->Execute($lista_hijos,array());
   if($rs_datahijos)
   {
	  while (!$rs_datahijos->EOF) {	
        
		$tipopac_id=$rs_datahijos->fields["tipopac_id"];
		$nombre_n=$rs_datahijos->fields["clie_nombre"];
		$apellido_n=$rs_datahijos->fields["clie_apellido"];

        $rs_datahijos->MoveNext();	   
	  }
   }
   $valor_precio='prod_precio';
	switch ($tipopac_id) {
    case 1:
        $valor_precio="prod_precioisfa";
        break;
    case 2:
        $valor_precio="prod_precio";
        break;
    case 3:
        $valor_precio="prod_precioconvenio";
        break;
	case 4:
        $valor_precio="prod_precioconveniohermano";
        break;	
	case 5:
        $valor_precio="prod_preciopolicia";
        break;
	case 6:
        $valor_precio="prod_preciomilitar";
        break;		
	case 7:
        $valor_precio="prod_preciomilitar";
        break;	
	case 8:
        $valor_precio="prod_preciomilitar";
        break;					
    }
	
	$busca_serial="select usua_id,prod_codigo,prod_id from efacsistema_producto where  prod_paraterapia=1";
    $rs_serial = $DB_gogess->Execute($busca_serial,array());
	
   //-----------------------------------------
   
   $busca_dataproducto="select prod_codigo,prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as ".$valor_precio.",efacsistema_producto.impu_codigo,efacsistema_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['datadarwin2679_sessid_inicio']." as usua_id from efacsistema_producto inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo where  prod_id=".$rs_serial->fields["prod_id"];
$rs_dataproducto = $DB_gogess->Execute($busca_dataproducto,array());

   return $rs_dataproducto->fields["docdet_total"];


   //-----------------------------------------

}

$sql1='';
if(@$_POST["tipopac_id"])
  {
   $sql1=" tipopac_id=".$_POST["tipopac_id"]." and ";
  }
$sql2="";
if($_POST["centro_id"])
  {
   $sql2=" centro_id=".$_POST["centro_id"]." and ";
  }
  
$sql3="";
if($_POST["clie_rucci"])
  {
   $clie_id=$objformulario->replace_cmb("app_cliente","clie_rucci,clie_id"," where clie_rucci =",$_POST["clie_rucci"],$DB_gogess);
   $sql3=" clie_id=".$clie_id." and ";
  }
  
$sql4="";
if($_POST["usua_id"])
  {
   $sql4=" usua_id=".$_POST["usua_id"]." and ";
  }
  

//optiene terapias pagadas
$concatena_pag='';
$listatpag="select terap_id from beko_documentodetalle";
$rs_listapag = $DB_gogess->Execute($listatpag);
 if($rs_listapag)
 {
     	while (!$rs_listapag->EOF) {
		
		
		$concatena_pag.=$rs_listapag->fields["terap_id"];
		
		$rs_listapag->MoveNext();	
		}
  }
 
//lista fisica
$lista_fisica="select distinct terap_id from faesa_terapiasregistro where terap_nfactura!=''";
$rs_listafisica = $DB_gogess->Execute($lista_fisica);
 if($rs_listafisica)
 {
     	while (!$rs_listafisica->EOF) {
		
		
		$concatena_pag.=$rs_listafisica->fields["terap_id"].",";
		
		$rs_listafisica->MoveNext();	
		}
  }
  
//lista issfa
$lista_issfa="select distinct  terap_id from faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where tipopac_id='1'";
$rs_listaissfa = $DB_gogess->Execute($lista_issfa);
 if($rs_listaissfa)
 {
     	while (!$rs_listaissfa->EOF) {
		
		
		$concatena_pag.=$rs_listaissfa->fields["terap_id"].",";
		
		$rs_listaissfa->MoveNext();	
		}
  }
 

//lista ninos issfa
$concatena_pagissfa='';
$lista_niissfa="select clie_id from app_cliente where tipopac_id='1'";
$rs_ninosissfa = $DB_gogess->Execute($lista_niissfa);
if($rs_ninosissfa)
{
     while (!$rs_ninosissfa->EOF) {
		
		
		$concatena_pagissfa.=$rs_ninosissfa->fields["clie_id"].",";
		
		$rs_ninosissfa->MoveNext();	
	}

}
$concatena_pagissfa=$concatena_pagissfa."0"; 

//lista ninos issfa 

$concatena_pag=$concatena_pag."0";  
$concatena_pagarray=array();
$concatena_pagarray=explode(",",$concatena_pag);
//optiene terapias pagadas

$sql5="";
if($_POST["estado"])
  {
      if($_POST["estado"]==1)
	  {
	  $sql5=" terap_id in (".$concatena_pag.") and ";
	  }
	  else
	  {
	  $sql5=" terap_id not in (".$concatena_pag.") and ";
	  
	  }
  }

  

$concatena_sql=$sql1.$sql2.$sql3.$sql4.$sql5;

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_POST["centro_id"],$DB_gogess);

echo "<center><b>".$nciudad."</b></center>";



if($concatena_sql)
  {
$lista_pacientes="select distinct  clie_id from faesa_terapiasregistro where ".$concatena_sql." (terap_fecha>='".$_POST["fecha_inicio"]."' and terap_fecha<='".$_POST["fecha_fin"]."')";
}
else
{
$lista_pacientes="select distinct  clie_id from faesa_terapiasregistro where (terap_fecha>='".$_POST["fecha_inicio"]."' and terap_fecha<='".$_POST["fecha_fin"]."')";

}

//echo $lista_pacientes;
$lista_pacientes="select * from  app_cliente inner join  faesa_tipopaciente on app_cliente.tipopac_id=faesa_tipopaciente.tipopac_id where clie_id in (".$lista_pacientes.") and clie_id not in (".$concatena_pagissfa.")";
$super_total=0;
?>
<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>

<style type="text/css">
.botonExcel{cursor:pointer;}
</style>

<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="export_to_excel.gif" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>

<div id="Exportar_a_Excel" >

<table width="800" border="1" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#D2E2EE"><span class="css_titulo">No</span></td>
    <td bgcolor="#D2E2EE"><span class="css_titulo">CI</span></td>
	<td bgcolor="#D2E2EE" class="css_titulo">TIPO</td>
    <td bgcolor="#D2E2EE" class="css_titulo">NOMBRE</td>
    <td bgcolor="#D2E2EE" class="css_titulo">APELLIDO</td>
    <td bgcolor="#D2E2EE" class="css_titulo">TERAPIAS</td>
  </tr>
  <?php
  $cuenta_num=0;
   $rs_gogessform = $DB_gogess->Execute($lista_pacientes);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		$suma_totale=0;
		$cuenta=1;
$cuenta_num++;
  ?>
  <tr>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $cuenta_num; ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $rs_gogessform->fields["clie_rucci"]; ?></span></td>
	<td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo $rs_gogessform->fields["tipopac_nombre"]; ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo utf8_encode($rs_gogessform->fields["clie_nombre"]); ?></span></td>
    <td valign="top" nowrap="nowrap"><span class="css_texto"><?php echo utf8_encode($rs_gogessform->fields["clie_apellido"]); ?></span></td>
    <td valign="top" nowrap="nowrap">
      <table width="400px" border="0" cellpadding="0" cellspacing="0">
        <tr>
		  <td bgcolor="#D6E2E4" class="css_titulo">No</td>
          <td bgcolor="#D6E2E4" class="css_titulo">Fecha</td>
          <td bgcolor="#D6E2E4" class="css_titulo">Hora</td>
          <td bgcolor="#D6E2E4" class="css_titulo">Estado</td>
          <td bgcolor="#D6E2E4" class="css_titulo">Valor</td>
		  <td bgcolor="#D6E2E4" class="css_titulo">Obs</td>
        </tr>
		<?php
	if($sql5)
	{
	$lista_terap="select * from faesa_terapiasregistro where ".$sql5." clie_id=".$rs_gogessform->fields["clie_id"]." and (terap_fecha>='".$_POST["fecha_inicio"]."' and terap_fecha<='".$_POST["fecha_fin"]."') order by terap_fecha,terap_hora asc";
	}
	else
	{
	$lista_terap="select * from faesa_terapiasregistro where clie_id=".$rs_gogessform->fields["clie_id"]." and (terap_fecha>='".$_POST["fecha_inicio"]."' and terap_fecha<='".$_POST["fecha_fin"]."') order by terap_fecha,terap_hora asc";
	}
	$rs_lterap = $DB_gogess->Execute($lista_terap);
	{
     	while (!$rs_lterap->EOF) {
		
		$estado_valor='';
		if(in_array($rs_lterap->fields["terap_id"],$concatena_pagarray))
		{
		 $estado_valor='PAGADO';
		}
		else
		{
		$estado_valor='PENDIENTE';
		
		}
		$valor_tera=0;
		
		
		 if(is_numeric($rs_lterap->fields["terap_nfactura"]))
			{
					$estado_valor='FACTURA FISICA';
			}
		
		
		  if($rs_gogessform->fields["tipopac_id"]==1)
			 {
					$estado_valor='ISSFA';
						  
			 }
		
		$valor_tera=ver_precioterapia($rs_gogessform->fields["clie_id"],$DB_gogess); 	 
		$suma_totale=$suma_totale+$valor_tera;
	?>
        <tr>
		  <td class="css_texto"><?php echo $cuenta;
		  $cuenta++; ?></td>
          <td class="css_texto"><?php echo $rs_lterap->fields["terap_fecha"]; ?></td>
          <td class="css_texto"><?php echo $rs_lterap->fields["terap_hora"]; ?></td>
          <td class="css_texto"><?php echo $estado_valor; ?></td>
          <td class="css_texto"><?php echo $valor_tera; ?></td>
		  <td class="css_texto"><?php echo $rs_lterap->fields["terap_nfactura"]; ?></td>
        </tr>
        
	<?php
	$rs_lterap->MoveNext();	
		}
  }
	?>	
	<tr>
          <td colspan="5" bgcolor="#D6E2E4" class="css_texto">Total</td>
          <td bgcolor="#D6E2E4" class="css_texto"><?php echo $suma_totale; 
		  $super_total=$super_total+$suma_totale;
		  ?></td>
        </tr>
    </table></td>
  </tr>
 
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
   <tr>
    <td colspan="5" valign="top" nowrap="nowrap" bgcolor="#D2E2EE">TOTAL</td>
    <td valign="top" nowrap="nowrap" bgcolor="#D2E2EE"><?php echo $super_total; ?></td>
  </tr>
</table>

</div>
