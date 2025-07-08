<script language="javascript">
<!--
//referencia
function aceptar_us(manolid,usuaid)
{

  $("#aceptar_onoff"+manolid).load("aplicativos/documental/opciones/requerimiento/aceptar_experto.php",{
usuaidp:usuaid,
manolidp:manolid
 },function(result){       

  });  

$("#aceptar_onoff"+manolid).html("...");

 
}


//-->
</script>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.caracter_error
{
    font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;

}
.Estilo4 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }

	
.TableScroll {
        z-index:99;
		width:520px;
        height:220px;	
        overflow: auto;
      }
-->
</style>


<div class="container" style="padding-top: 1em; padding-right:1em; ">

<center><h4> ALERTAS </h4></center>



<div class="form-group">

<div class="col-xs-12" align="center">
<?php 
$fecha_hoy=date("Y-m-d");
$usua_id=$_SESSION['datadarwin2679_sessid_inicio'];

?>

<table width="100" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	
	<div class=TableScroll>
	 <table width="500" border="1" cellpadding="0" cellspacing="1">
  <tr>
    <td colspan="5" bgcolor="#CEDCE3"><div align="center"><span class="Estilo1">TERAPIAS </span></div></td>
    </tr>
  <tr>
    <td bgcolor="#CEDCE3" class="Estilo1">Estado</td>
    <td bgcolor="#CEDCE3" class="Estilo1">Fecha</td>
    <td bgcolor="#CEDCE3" class="Estilo1">Hora</td>
    <td bgcolor="#CEDCE3" class="Estilo1">Paciente</td>
    <td bgcolor="#CEDCE3" class="Estilo1">Tipo</td>
	
  </tr>
  <?php
   $lista_buscat="select * from  faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=".$usua_id." and terap_fecha>='".$fecha_hoy."' order by terap_fecha asc limit 30";
					 
					 $rs_lbuscat = $DB_gogess->executec($lista_buscat,array());
					 if($rs_lbuscat)
					 {
						  while (!$rs_lbuscat->EOF) {
						  
						  //busca factura
						  $bandera_exite=0; 
						  $busca_factura="select beko_documentodetalle.terap_id from beko_documentodetalle inner join beko_documentocabecera on beko_documentodetalle.doccab_id=beko_documentocabecera.doccab_id";
						  $rs_bfactura = $DB_gogess->executec($busca_factura,array());
						  if($rs_bfactura)
						  {
						      while (!$rs_bfactura->EOF) {
							  
									  if($rs_bfactura->fields["terap_id"])
									  {	
										     $saca_idter=explode(",",$rs_bfactura->fields["terap_id"]);
									  
									 // print_r($saca_idter);
									  
											  if (in_array($rs_lbuscat->fields["terap_id"], $saca_idter)) {
											  
												   $bandera_exite=1;
											  }
									  
									  }
							    $rs_bfactura->MoveNext();
							  }
						  }	  
	                      
						  
						  //buca factura
						  
						   $alerta='';
						 // if($rs_lbuscat->fields["terap_nfactura"]=='')
						  if($bandera_exite==0)
						  {
						    $alerta='<img src="images/red.png" width="10" height="10" />';
						  }
						  else
						  {
						    $alerta='<img src="images/green.png" width="10" height="10" />';
						  
						  }
						  
						   if($rs_lbuscat->fields["terap_autorizacion"]!='')
						  {
						    $alerta='<img src="images/autorizado.png" width="10" height="10" />';
						  }
						  
						  
						   //verifica si es issfa
						  
						  if($rs_lbuscat->fields["tipopac_id"]==1)
						  {
						    $alerta='<img src="images/issfa.png" width="10" height="10" />';
						  
						  }
						  
						  //verifica si es isffa
						  
						  //verifica si la factura es fisica
						  
						  if($rs_lbuscat->fields["terap_nfactura"])
						  {
						    $alerta='<img src="images/fisica.png" width="10" height="10" />';
						  }
						  //verifica si la factyra es fisica
						  
						  
  
  ?>
  <tr>
    <td  nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px'  ><span class="Estilo4"><?php echo $alerta; ?></span></td>
    <td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo $rs_lbuscat->fields["terap_fecha"]; ?></span></td>
    <td nowrap="nowrap"  style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px'  ><span class="Estilo4"><?php echo $rs_lbuscat->fields["terap_hora"]; ?></span></td>
    <td nowrap="nowrap"  style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo ucwords(strtolower(utf8_encode($rs_lbuscat->fields["clie_nombre"]." ".$rs_lbuscat->fields["clie_apellido"]))); ?></span></td>
    <td  nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px'  ><span class="Estilo4">TERAPIA</span></td>
	 
  </tr>
  <?php
                   $rs_lbuscat->MoveNext();
						  }
					 
					 }
  
  ?>
  
   <?php
   $busca_citas="select tu.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido,atenc_id,asighor_fecha from faesa_asigahorario inner join faesa_integragrupo tu on faesa_asigahorario.grup_id=tu.grup_id inner join app_cliente on faesa_asigahorario.clie_id=app_cliente.clie_id where tu.usua_id=".$usua_id." and asighor_fecha>='".$fecha_hoy."'";	
					 
					  $rs_lbuscaci = $DB_gogess->executec($busca_citas,array());
					 if($rs_lbuscaci)
					 {
						  while (!$rs_lbuscaci->EOF) {
  
  ?>
  <tr>
    <td></td>
    <td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo $rs_lbuscaci->fields["asighor_fecha"]; ?></span></td>
    <td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo $rs_lbuscaci->fields["integr_hora"]; ?></span></td>
    <td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo utf8_encode($rs_lbuscaci->fields["clie_nombre"]." ".$rs_lbuscaci->fields["clie_apellido"]); ?></span></td>
	<td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4">E.INTEGRAL</span></td>
    
  </tr>
  <?php
                         $rs_lbuscaci->MoveNext();
						  }
					 
					 }
  
  ?>
  </table>	
  </div>
  </td>
	<td>&nbsp;</td>
	
    <td valign="top">
	<div class=TableScroll>
	<table width="500" border="1">
      <tr>
        <td colspan="5" bgcolor="#CEDCE3"><div align="center"><span class="Estilo1">PACIENTES PARA HOY  </span></div></td>
      </tr>
	  
	   
      <tr>
        <td bgcolor="#CEDCE3" class="Estilo1">Hora</td>
        <td bgcolor="#CEDCE3" class="Estilo1">Paciente</td>
        <td bgcolor="#CEDCE3" class="Estilo1">Terapeuta</td>
		<td bgcolor="#CEDCE3" class="Estilo1">Tipo</td>
        <td bgcolor="#CEDCE3" class="Estilo1">Estado</td>
      </tr>
	  
	     <?php
  $busca_citashoy="select tu.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido,atenc_id,asighor_fecha from faesa_asigahorario inner join faesa_integragrupo tu on faesa_asigahorario.grup_id=tu.grup_id inner join app_cliente on faesa_asigahorario.clie_id=app_cliente.clie_id where asighor_fecha='".$fecha_hoy."'";	
					 
					  $rs_lbuscacihoy = $DB_gogess->executec($busca_citashoy,array());
					 if($rs_lbuscacihoy)
					 {
						  while (!$rs_lbuscacihoy->EOF) {
						  
						   $nombre_medico="select * from app_usuario where usua_id=".$rs_lbuscacihoy->fields["usua_id"];
					       $rs_nmedico = $DB_gogess->executec($nombre_medico,array());
  
                           if($rs_nmedico->fields["centro_id"]==$_SESSION['datadarwin2679_centro_id'])
						   {
  ?>
  <tr>
        <td class="Estilo4"><?php echo $rs_lbuscacihoy->fields["integr_hora"]; ?></td>
        <td class="Estilo4"><?php echo ucwords(strtolower(utf8_encode($rs_lbuscacihoy->fields["clie_nombre"]." ".$rs_lbuscacihoy->fields["clie_apellido"]))); ?></td>
        <td class="Estilo4"><?php echo $rs_nmedico->fields["usua_nombre"]." ".$rs_nmedico->fields["usua_apellido"]; ?></td>
		<td class="Estilo4">Evaluaci&oacute;n Integral</td>
        <td class="Estilo4"></td>
      </tr>
  
    <?php
	                        }
	
	
                         $rs_lbuscacihoy->MoveNext();
						  }
					 
					 }
  
  ?>
  
	  
	  
	  
	  <?php
   $lista_buscathoy="select faesa_terapiasregistro.terap_id,faesa_terapiasregistro.usua_id,terap_nfactura,terap_autorizacion,app_cliente.clie_id,terap_hora,clie_nombre,clie_apellido,tipopac_id,terap_nfactura from  faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where terap_fecha='".$fecha_hoy."' and faesa_terapiasregistro.centro_id='".$_SESSION['datadarwin2679_centro_id']."' order by terap_hora asc";
					 
					 $rs_lbuscathoy = $DB_gogess->executec($lista_buscathoy,array());
					 if($rs_lbuscathoy)
					 {
						  while (!$rs_lbuscathoy->EOF) {
						  
						  
						   //busca factura
						  $bandera_exite=0; 
						  $busca_factura="select beko_documentodetalle.terap_id from beko_documentodetalle inner join beko_documentocabecera on beko_documentodetalle.doccab_id=beko_documentocabecera.doccab_id";
						  $rs_bfactura = $DB_gogess->executec($busca_factura,array());
						  if($rs_bfactura)
						  {
						      while (!$rs_bfactura->EOF) {
							  
									  if($rs_bfactura->fields["terap_id"])
									  {	
										     $saca_idter=explode(",",$rs_bfactura->fields["terap_id"]);
									  
									 // print_r($saca_idter);
									  
											  if (in_array($rs_lbuscathoy->fields["terap_id"], $saca_idter)) {
											  
												   $bandera_exite=1;
											  }
									  
									  }
							    $rs_bfactura->MoveNext();
							  }
						  }	    
						  //buca factura
						  
						  
						   $alerta='';
						 // if($rs_lbuscathoy->fields["terap_nfactura"]=='')
						  if($bandera_exite==0)
						  {
						    $alerta='<img src="images/red.png" width="10" height="10" />';
						  }
						  else
						  {
						    $alerta='<img src="images/green.png" width="10" height="10" />';
						  
						  }
						  
						   if($rs_lbuscathoy->fields["terap_autorizacion"]!='')
						  {
						    $alerta='<img src="images/autorizado.png" width="10" height="10" />';
						  }
						  
						   //verifica si es issfa
						  
						  if($rs_lbuscathoy->fields["tipopac_id"]==1)
						  {
						    $alerta='<img src="images/issfa.png" width="10" height="10" />';
						  
						  }
						  
						  //verifica si es isffa
						  
						  //verifica si la factura es fisica
						  
						  if($rs_lbuscathoy->fields["terap_nfactura"])
						  {
						    $alerta='<img src="images/fisica.png" width="10" height="10" />';
						  }
						  //verifica si la factyra es fisica
						  
						  
						   $nombre_medico="select * from app_usuario where usua_id=".$rs_lbuscathoy->fields["usua_id"];
					       $rs_nmedico = $DB_gogess->executec($nombre_medico,array());
						   
  
  ?>
	  
      <tr>
        <td class="Estilo4"><?php echo $rs_lbuscathoy->fields["terap_hora"]; ?></td>
        <td class="Estilo4"><?php echo ucwords(strtolower(utf8_encode($rs_lbuscathoy->fields["clie_nombre"]." ".$rs_lbuscathoy->fields["clie_apellido"]))); ?></td>
        <td class="Estilo4"><?php echo $rs_nmedico->fields["usua_nombre"]." ".$rs_nmedico->fields["usua_apellido"]; ?></td>
		<td class="Estilo4">Terapia</td>
        <td class="Estilo4"><?php echo $alerta; ?></td>
      </tr>
	   <?php
                   $rs_lbuscathoy->MoveNext();
						  }
					 
					 }
  
  ?>
	  
	  
    </table>
	</div>
	</td>
    </tr>
</table>

  
  
</div>
</div>
<p>&nbsp; </p>

<div class="form-group">
<div class="col-xs-12">
   <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <td valign="top">
	   <div class=TableScroll>
	   <table width="400" border="1" cellpadding="0" cellspacing="1">
  <tr>
    <td bgcolor="#CEDCE3"><div align="center"><span class="Estilo1">CEDULAS ERRONEAS VERIFICAR </span></div></td>
  </tr>
  <?php
  $lista_cedulas="select * from app_cliente";
  $rs_listacedulas = $DB_gogess->executec($lista_cedulas,array());
  if($rs_listacedulas)
   {
     	while (!$rs_listacedulas->EOF) {
		 $num_digi=strlen($rs_listacedulas->fields["clie_rucci"]);
		 if($num_digi!=10)
		 {
		?>
		 <tr>
            <td class="caracter_error"><?php echo $rs_listacedulas->fields["clie_rucci"]." --> Numero digitos incorrecto:".$num_digi; ?></td>
         </tr>
		 <?php 
		 } 
		 $rs_listacedulas->MoveNext(); 
		}
		
	}	

  ?>
  
</table>
</div>
</td>
<td>&nbsp;</td>
       <td valign="top">
	   <div class=TableScroll>
	   
	   
	 <table width="500" border="1" cellpadding="0" cellspacing="1">
  <tr>
    <td colspan="6" bgcolor="#CEDCE3"><div align="center"><span class="Estilo1">EVALUACIONES </span></div></td>
    </tr>
  <tr>
    <td bgcolor="#CEDCE3" class="Estilo1">Estado</td>
    <td bgcolor="#CEDCE3" class="Estilo1">Fecha</td>
    <td bgcolor="#CEDCE3" class="Estilo1">Hora</td>
    <td bgcolor="#CEDCE3" class="Estilo1">Paciente</td>
    <td bgcolor="#CEDCE3" class="Estilo1">Tipo</td>
	<td bgcolor="#CEDCE3" class="Estilo1">Incio</td>
	
  </tr>
   <?php
   $busca_citas="select tu.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido,atenc_id,asighor_fecha,faesa_asigahorario.eteneva_id from faesa_asigahorario inner join faesa_integragrupo tu on faesa_asigahorario.grup_id=tu.grup_id inner join app_cliente on faesa_asigahorario.clie_id=app_cliente.clie_id where tu.usua_id=".$usua_id."  order by asighor_fecha desc";	
   
   //and asighor_fecha>='".$fecha_hoy."'
					 
					  $rs_lbuscaci = $DB_gogess->executec($busca_citas,array());
					 if($rs_lbuscaci)
					 {
						  while (!$rs_lbuscaci->EOF) {
						  $inicio="";
						  $busca_digitado="select * from faesa_terapiafisica where eteneva_id=".$rs_lbuscaci->fields["eteneva_id"];
						  $rs_buscad = $DB_gogess->executec($busca_digitado,array());
						  if($rs_buscad->fields["terfisic_id"])
						  {
						    $inicio="SI";
						  }
  
  ?>
  <tr>
    <td></td>
    <td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo $rs_lbuscaci->fields["asighor_fecha"]; ?></span></td>
    <td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo $rs_lbuscaci->fields["integr_hora"]; ?></span></td>
    <td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo utf8_encode($rs_lbuscaci->fields["clie_nombre"]." ".$rs_lbuscaci->fields["clie_apellido"]); ?></span></td>
	<td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4">E.INTEGRAL</span></td>
	
	<td nowrap="nowrap" style='padding-top:3px; padding-bottom:3px; padding-left:3px; padding-right:3px' ><span class="Estilo4"><?php echo $inicio;  ?></span></td>
    
  </tr>
  <?php
                         $rs_lbuscaci->MoveNext();
						  }
					 
					 }
  
  ?>
  </table>	
  
	   
	   
	   
	   
	   </div>
	   
	   </td>
     </tr>
   </table>
   
<p>&nbsp;</p>
    
</div>
<div class="col-xs-12">

 <table width="300" border="1" cellpadding="0" cellspacing="1">
  <tr>
    <td colspan="2" bgcolor="#CEDCE3"><div align="center"><span class="Estilo1">NUMERO PACIENTES</span></div></td>
  </tr>
  <?php
  $lista_cedulas="select count(app_cliente.centro_id) total,centro_nombre from app_cliente inner join dns_centrosalud on app_cliente.centro_id=dns_centrosalud.centro_id group by app_cliente.centro_id";
  $rs_listacedulas = $DB_gogess->executec($lista_cedulas,array());
  if($rs_listacedulas)
   {
     	while (!$rs_listacedulas->EOF) {
		
		?>
		 <tr>
            <td class="caracter_error"><b><?php echo $rs_listacedulas->fields["centro_nombre"]; ?></b></td>
            <td class="caracter_error"><?php echo $rs_listacedulas->fields["total"]; ?></td>
		 </tr>
		 <?php 
		 
		 $rs_listacedulas->MoveNext(); 
		}
		
	}	

  ?>
</table>

</div>
</div>


</div>

<script language="javascript">

<!--



//-->

</script>