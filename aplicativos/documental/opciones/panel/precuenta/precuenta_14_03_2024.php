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

$ci_paciente=$_POST["ci_paciente"];


$lista_usv="select * from app_usuario where usua_id='".$_SESSION['datadarwin2679_sessid_inicio']."'";
$rs_usv= $DB_gogess->executec($lista_usv,array());
$centrousuario_id=$rs_usv->fields['centro_id'];
$usua_enlace=$rs_usv->fields["usua_enlace"];
$usua_permitirreposicion=$rs_usv->fields["usua_permitirreposicion"];
$usua_permitirotrbredp=$rs_usv->fields["usua_permitirotrbredp"];

$usua_permitirab=$rs_usv->fields["usua_permitirab"];
?>
<br>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E9F1F5"><div align="center">CI</div></td>
	<td bgcolor="#E9F1F5"><div align="center">PACIENTE</div></td>
	<td bgcolor="#E9F1F5"><div align="center">CONVENIO</div></td>
    <td bgcolor="#E9F1F5"><div align="center">OBSERVACION</div></td>
    <td bgcolor="#E9F1F5"><div align="center">FECHA INICIO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">FECHA FIN</div></td>
	
	<?php
	if($usua_permitirab==1)
	{
	?>	
	<td bgcolor="#E9F1F5"><div align="center">ESTADO</div></td>
	<?php
	}	
	?>
	
  </tr>
<?php
if($usua_permitirab==1)
{
 $lista_bprecuenta="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where clie_rucci='".$ci_paciente."'  order by 	precu_id desc limit 1";
 $rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());
}
else
{
$lista_bprecuenta="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where clie_rucci='".$ci_paciente."' and precu_activo=1 order by 	precu_id desc limit 1";
$rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());
}

if($rs_bprecuenta)
 {
	while (!$rs_bprecuenta->EOF) { 
	
	
	$clie_id=$rs_bprecuenta->fields["clie_id"];
	$precu_id=$rs_bprecuenta->fields["precu_id"];
	$atenc_enlace=$rs_bprecuenta->fields["atenc_enlace"];
	
	$lista_aten="select * from dns_atencion where atenc_enlace='".$atenc_enlace."'";
	$rs_aten = $DB_gogess->executec($lista_aten,array());
	
	$atenc_id=$rs_aten->fields["atenc_id"];
	
	$convepr_id=$rs_bprecuenta->fields["convepr_id"];
	$lista_convenio="select * from pichinchahumana_extension.dns_convenios where 	conve_id='".$convepr_id."'";
	$rs_conve= $DB_gogess->executec($lista_convenio,array());
	$rs_conve->fields["conve_redpublica"];
	
	$code_redp=0;
	$code_redp=$rs_conve->fields["conve_redpublica"];
	
	$red_publica='NO';
	if($rs_conve->fields["conve_redpublica"]==1)
	{
	  $red_publica='SI';
	}
	?>

  <tr>
    <td><?php echo $rs_bprecuenta->fields["clie_rucci"]; ?></td>
	<td><?php echo $rs_bprecuenta->fields["clie_nombre"].' '.$rs_bprecuenta->fields["clie_apellido"]; ?></td>
	<td><?php echo $rs_conve->fields["conve_nombre"].' RED PUBLICA: <b>'.$red_publica.'</b>'; ?></td>
    <td><?php echo $rs_bprecuenta->fields["precu_observacion"]; ?></td>
    <td><?php echo $rs_bprecuenta->fields["precu_fechainicio"]; ?></td>
	 <td><?php echo $rs_bprecuenta->fields["precu_fechafinal"]; ?></td>
	 
	 <?php
	if($usua_permitirab==1)
	{
	?>	
	
	<td>
	<?php
	$comulla_simple="'";
	$ncampo_val='precu_activo';
    $ide_producto='precu_id';
	$tabla_valordata="'dns_precuenta'";
	
	echo '<select class="form-control" style="width:120px" id="cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].'"  onChange="guardar_campost('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_bprecuenta->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_bprecuenta->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
    <option value="" >--Tipo--</option>';
    $objformulario->fill_cmb('dns_estadoprecuenta','estap_id,estap_nombre',$rs_bprecuenta->fields[$ncampo_val],'',$DB_gogess);
    echo '</select>';
		
	?>
	</td> 
	
	
	<?php
	}
	?>
	 
  </tr>

	 
	 <?php	
	
	   $rs_bprecuenta->MoveNext();	
	}	
} 
//$usua_permitirotrbredp=1;	
?>
</table>
<br><br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">Bodega:
      <select name="centro_id " id="centro_id"  class="form-control" >
        <?php
	         echo '<option value="">---Seleccionar--</option>';
			 
			 if($code_redp==1)
			 {
			 $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",$centrousuario_id," where  centro_redpublica=1 and centro_id!=1 and centro_id='".$centrousuario_id."' order by centro_id asc ",$DB_gogess);	
			 
			// $lista_extra="select * from dns_gridcentros inner join dns_centrosalud on  dns_gridcentros.centro_id=dns_centrosalud.centro_id where usua_enlace='".$usua_enlace."' and centro_redpublica=1";
			 if($usua_permitirotrbredp==1)
			 {
		      $lista_extra="select * from dns_gridcentros inner join dns_centrosalud on  dns_gridcentros.centro_id=dns_centrosalud.centro_id where usua_enlace='".$usua_enlace."' and dns_gridcentros.centro_id!=1";	 
			 }
			 else
			 {
			 $lista_extra="select * from dns_gridcentros inner join dns_centrosalud on  dns_gridcentros.centro_id=dns_centrosalud.centro_id where usua_enlace='".$usua_enlace."' and centro_redpublica=1";
			 }
			 
			 
			 
			 }
			 else
			 {
			 $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",$centrousuario_id," where  centro_id!=1 and centro_id='".$centrousuario_id."' and centro_redpublica=0 order by centro_id asc ",$DB_gogess);	
			 
			 $lista_extra="select * from dns_gridcentros inner join dns_centrosalud on  dns_gridcentros.centro_id=dns_centrosalud.centro_id where usua_enlace='".$usua_enlace."' and centro_redpublica=0 and dns_gridcentros.centro_id!=1";
			 
			 }
			 
			 echo $lista_extra;
			 
			 $rs_lx = $DB_gogess->executec($lista_extra,array());
			 if($rs_lx)
			 {
				while (!$rs_lx->EOF) { 
			
				
				echo '<option value="'.$rs_lx->fields["centro_id"].'" >'.$rs_lx->fields["centro_nombre"].'</option>';
				
				$rs_lx->MoveNext();
				}
			 }	
			 
	  ?>
      </select>    </td>
  </tr>
  <tr>
    <td>Buscar:
    <input name="b_data" type="text" id="b_data" value="" /></td>
    <td><input type="button" name="Submit" value="DESPLEGAR" onclick="desplegar_listainventario()" /></td>
  </tr>
  <tr>
    <td colspan="2"><br /><div align="center">
      <input name="fecha_desc" type="hidden" id="fecha_desc" value="<?php echo date("Y-m-d"); ?>" class="form-control"  />
    </div></td>
  </tr>
</table>

<div align="right"><br>
<?php
if($usua_permitirreposicion==1)
{
?>
  <input type="button" name="Submit22" value="REPOSICION A SUB BODEGA" onclick="tomainv_doc()" />&nbsp;&nbsp;
<?php
}
?>  
  <input type="button" name="Submit2" value="Imprimir" onclick="imprimir_doc()" />
  <input type="button" name="Submit2" value="Excel" onclick="imprimir_docexcel()" />
</div>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="52%" valign="top"><div id="lista_bodega" class="TableScroll_lista"></div></td>
    <td width="48%" valign="top"><div id="lista_asignado" class="TableScroll_lista"></div></td>
  </tr>
</table>


<!--
<center>TARIFARIO</center>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" valign="top"><div id="lista_tarfario" class="TableScroll_lista"></div></td>
    <td width="50%" valign="top"><div id="lista_tarasignado" class="TableScroll_lista"></div></td>
  </tr>
</table>

-->

<div id="p_borrar"></div>
<div id="divBody_pdespacho"></div>
<br /><br />
<!--
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>Buscar Med/Insumo:<input name="bucsa_med" type="text" id="bucsa_med" />
      <input type="button" name="Submit3" value="Buscar" onclick="lista_cmb()" />
      <br /><br /></td>
  </tr>
    <tr>
    <td>
	Origen:<select name="centrotx_id " id="centrotx_id"  class="form-control" onchange="lista_cmb()" >
      <?php
	         echo '<option value="">---Seleccionar--</option>';
			 $objformulario->fill_cmb("dns_centrosalud","centro_id,centro_nombre",$centrousuario_id," where  centro_id=1 order by centro_id asc ",$DB_gogess);
			  echo '<option value="9999">COMPRA EXTERNA</option>';
			   echo '<option value="8888">VARIOS</option>';	
	  ?>
	  
    </select></td>
	
  </tr>
  <tr>
    <td>
	<div id="lista_mediext"></div>
	</td>
	
  </tr>
</table>
-->

<div id="campo_valorpr"></div>

<script type="text/javascript">
<!--

function guardar_campost(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valorpr").load("aplicativos/documental/opciones/panel/precuentagenerada/guarda_campoppre.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){ 


  });  

$("#campo_valorpr").html("Espere un momento...");

}



function tomainv_doc() {
window.open('aplicativos/documental/opciones/panel/precuenta/lista_asignadosinv.php?precu_id=<?php echo $precu_id; ?>&centro_id='+$('#centro_id').val(),'ventana1','width=750,height=500,scrollbars=YES');

}


function imprimir_doc() {
window.open('aplicativos/documental/opciones/panel/precuenta/lista_asignadosimp.php?precu_id=<?php echo $precu_id; ?>&centro_id='+$('#centro_id').val(),'ventana1','width=750,height=500,scrollbars=YES');

}

function imprimir_docexcel() {
window.open('aplicativos/documental/opciones/panel/precuenta/lista_asignadosimp.php?excel=1&precu_id=<?php echo $precu_id; ?>&centro_id='+$('#centro_id').val(),'ventana1','width=750,height=500,scrollbars=YES');

}


function lista_cmb()
{

   if($('#centrotx_id').val()=='')
   {
     alert("Seleccione el origen...");
     return false;
   }

   $("#lista_mediext").load("aplicativos/documental/opciones/panel/precuenta/cmb_listamed.php",{
      
	  centro_id:$('#centrotx_id').val(),
	  b_data:$('#bucsa_med').val(),
	  precu_id:'<?php echo $precu_id; ?>'

  },function(result){  

     desplegar_asignados();
  });  
  $("#lista_mediext").html("Espere un momento");  

}



function ejecuta_despachar(cuadrobm_id,centro_id,maximop,clie_id)
{
	
  
  abrir_standar("aplicativos/documental/opciones/panel/precuenta/lotes.php","Despacho","divBody_pdespacho","divDialog_pdespacho",580,500,<?php echo $precu_id; ?>,'dns_precuenta',centro_id,'<?php echo $_SESSION['datafrank1109_sessid_inicio']; ?>','<?php echo $clie_id; ?>',maximop,cuadrobm_id);
  
}

function desplegar_listainventario()
{
  if($('#centro_id').val()=='')
  {
     alert("Seleccione la bodega");
     return false;
  }
  
   $("#lista_bodega").load("aplicativos/documental/opciones/panel/precuenta/lista_medinsu.php",{
      
	  centro_id:$('#centro_id').val(),
	  b_data:$('#b_data').val()

  },function(result){  

     desplegar_asignados();
  });  
  $("#lista_bodega").html("Espere un momento");  
}


function desplegar_listatarifario()
{
  
   $("#lista_tarfario").load("aplicativos/documental/opciones/panel/precuenta/lista_tarifario.php",{
      

  },function(result){  

     desplegar_asignados();
  });  
  $("#lista_tarfario").html("Espere un momento");  
}


function desplegar_asignados()
{

   $("#lista_asignado").load("aplicativos/documental/opciones/panel/precuenta/lista_asignados.php",{
      
	  precu_id:'<?php echo $precu_id; ?>',
	  centro_id:$('#centro_id').val()

  },function(result){  


  });  
  $("#lista_asignado").html("Espere un momento");  
}

function desplegar_asignadostarifatio()
{

   $("#lista_tarasignado").load("aplicativos/documental/opciones/panel/precuenta/lista_asignadostar.php",{
      
	  precu_id:'<?php echo $precu_id; ?>'

  },function(result){  


  });  
  $("#lista_tarasignado").html("Espere un momento");  
}


desplegar_asignados();
//desplegar_asignadostarifatio();

function asgnar_prdetalle(prod_id,centro_id)
{

if($('#cantidp_'+prod_id).val()=='')
 {
   alert("Ingrese la Cantidad...");
   return false;
 }

 $("#lista_tarasignado").load("aplicativos/documental/opciones/panel/precuenta/asignar_gtar.php",{
      
	  precu_id:'<?php echo $precu_id; ?>',
	  clie_id:'<?php echo $clie_id; ?>',
	  atenc_id:'<?php echo $atenc_id; ?>',
	  prod_id:prod_id,
	  cantidad:$('#cantidp_'+prod_id).val(),
	  centro_id:centro_id

  },function(result){  

desplegar_asignadostarifatio();

  });  
  $("#lista_tarasignado").html("Espere un momento"); 


}


function asgnar_detalle(cuadrobm_id,centro_id,maximop,clie_id)
{

 var maximovalor;
 
 maximovalor=parseFloat(maximop);

 if($('#cantid_'+cuadrobm_id).val()=='')
 {
   alert("Ingrese la Cantidad...");
   return false;
 }
 
 if($('#cantid_'+cuadrobm_id).val()>maximovalor)
 {
    alert("Cantidad supera al stock actual...");
   return false;
 
 }

 $("#lista_asignado").load("aplicativos/documental/opciones/panel/precuenta/asignar_g.php",{
      
	  precu_id:'<?php echo $precu_id; ?>',
	  clie_id:'<?php echo $clie_id; ?>',
	  atenc_id:'<?php echo $atenc_id; ?>',
	  cuadrobm_id:cuadrobm_id,
	  cantidad:$('#cantid_'+cuadrobm_id).val(),
	  centro_id:centro_id,
	  maximop:maximop,
	  centro_id:centro_id

  },function(result){  

//desplegar_asignados();

  });  
  $("#lista_asignado").html("Espere un momento"); 

}

function borrar_asigx(detapre_id)
{

if (confirm("Esata seguro en borrar") == true) {
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/precuenta/borrar_g.php",{
      
	  detapre_id:detapre_id

  },function(result){  

desplegar_asignados();
desplegar_listainventario();

  });  
  $("#p_borrar").html("Espere un momento"); 



}

}



function borrar_asigtar(detapre_id)
{

let text;
if (confirm("Esata seguro en borrar") == true) {
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/precuenta/borrar_g.php",{
      
	  detapre_id:detapre_id

  },function(result){  

desplegar_asignadostarifatio();

  });  
  $("#p_borrar").html("Espere un momento"); 



}

}


//desplegar_listatarifario();


function borrar_asigxprincipal(detapre_id)
{

if (confirm("Esata seguro en borrar") == true) {
 

 $("#p_borrar").load("aplicativos/documental/opciones/panel/precuenta/borrar_gprincipal.php",{
      
	  detapre_id:detapre_id

  },function(result){  

desplegar_asignados();
desplegar_listainventario();

  });  
  $("#p_borrar").html("Espere un momento"); 



}

}



//  End -->
</script>

<script language="javascript">
    <!--
	 $("#fecha_desc").datepicker({dateFormat: 'yy-mm-dd'});
	 
	 //-->
</script>