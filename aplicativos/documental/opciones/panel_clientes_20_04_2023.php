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
.css_inicio4 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }

	
.TableScroll {
        z-index:99;
		width:520px;
        height:220px;	
        overflow: auto;
      }
	  
.TableScrolldiario {
        z-index:99;
		width:100%;
        height:220px;	
        overflow: auto;
      }	  
-->
</style>


<div class="container" style="padding-top: 1em; padding-right:1em; ">



<center><h4> ALERTAS </h4>
  <p><strong>ATENCION DIARIA </strong></p>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><label>
        <div align="center"><strong>Fecha:</strong>
          <input name="fecha_at" type="text" id="fecha_at" value="<?php echo date("Y-m-d");  ?>" />
          <input type="button" name="Button" value="Ver" onclick="fecha_datadiario()" />
          <input type="button" name="Button" value="Excel" onclick="imp_facdiaria()"  />
        </div>
      </label></td>
    </tr>
    <tr>
      <td><div class=TableScrolldiario><div id="grid_diario" ></div></div></td>
    </tr>
  </table>
  <br />
</center>
<div class="form-group">

<div class="col-xs-12" align="center">
<?php 
$fecha_hoy=date("Y-m-d");
$usua_id=$_SESSION['datadarwin2679_sessid_inicio'];

?>

<table width="100" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	 OMS <a href="https://www.paho.org/hq/index.php?option=com_content&view=article&id=15696:coronavirus-disease-covid-19&Itemid=4206&lang=es" target="_blank"><b>Qu&eacute; es la enfermedad por el coronavirus &lrm;&lrm;(COVID-19)&lrm;?	</b> </a>
	 <div class=TableScroll>

	<table width="500" border="1">
      <tr>
        <td colspan="8" bgcolor="#EDCFBA"><div align="center"><span class="Estilo1">PACIENTES SINTOMATICOS RESPIRATORIOS </span></div></td>
      </tr>
      <tr>
	    <td bgcolor="#E4ECEF" class="Estilo1">No.</td>
        <td bgcolor="#E4ECEF" class="Estilo1">Cedula</td>
        <td bgcolor="#E4ECEF" class="Estilo1">Nombre</td>
        <td bgcolor="#E4ECEF" class="Estilo1">Sintomaticos Respiratorios </td>
      </tr>
      <?php
	  $cuentatos=0;
$busca_sintomaticos="select * from dns_anamesisexamenfisico inner join app_cliente on dns_anamesisexamenfisico.clie_id=app_cliente.clie_id where  (anam_respiratorio=1) and clie_rucci not in ('1711467884','1714907449')";
$rs_sintomaticos = $DB_gogess->executec($busca_sintomaticos,array());
if($rs_sintomaticos)
 {
	  while (!$rs_sintomaticos->EOF) {
	  
	$anam_respiratorio='';
	if($rs_sintomaticos->fields["anam_respiratorio"]==1)
	{
	  $anam_respiratorio='SI';
	}
	
	
	   
	   $cuentatos++;
      ?>	
      <tr>
	    <td class="css_inicio4"><?php echo $cuentatos; ?></td>
        <td class="css_inicio4"><?php echo utf8_encode($rs_sintomaticos->fields["clie_rucci"]); ?></td>
        <td class="css_inicio4"><?php echo utf8_encode($rs_sintomaticos->fields["clie_nombre"]." ".$rs_sintomaticos->fields["clie_apellido"]); ?></td>
        <td class="css_inicio4"><?php echo $anam_respiratorio; ?></td>
      </tr>
      <?php
	                      
	
	
      $rs_sintomaticos->MoveNext();
	  }
  }	 
	
  ?>
    </table>
	</div>
	<b>Total:</b><?php echo $cuentatos; ?>
  </td>
	<td>&nbsp;</td>
	
    <td valign="top">
	<div class=TableScroll>
	<table width="500" border="1">
      <tr>
        <td colspan="5" bgcolor="#CEDCE3"><div align="center"><span class="Estilo1">PACIENTES PENDIENTES PARA HOY  </span></div></td>
      </tr>
	  
	   
      <tr>
       
        <td bgcolor="#CEDCE3" class="Estilo1">Paciente</td>
        <td bgcolor="#CEDCE3" class="Estilo1">Especialidad</td>
		<td bgcolor="#CEDCE3" class="Estilo1">Turno</td>
       
      </tr>
	  
	     <?php
 $lista_campor="select * from pichinchahumana_extension.dns_gridturnos where gridtur_fecha='".date("Y-m-d")."' and centro_id=".$_SESSION['datadarwin2679_centro_id']." and gridtur_estado='' and usuaat_id='".$usua_id."' order by gridtur_turno desc";
		 
					 
					  $rs_lbuscacihoy = $DB_gogess->executec($lista_campor,array());
					 if($rs_lbuscacihoy)
					 {
						  while (!$rs_lbuscacihoy->EOF) {
						  
						  
						  $busca_cliente="select * from app_cliente where clie_id='".trim($rs_lbuscacihoy->fields["clie_id"])."'";
						  $rs_bcliente = $DB_gogess->executec($busca_cliente,array());
						  
						  $nombre_medico="select * from dns_especialidad where especi_id='".$rs_lbuscacihoy->fields["especi_id"]."'";
					      $rs_nmedico = $DB_gogess->executec($nombre_medico,array());
						   
						   $estado='';
						   if($rs_lbuscacihoy->fields["gridtur_estado"]==1)
						   {
						      $estado='ATENDIDO';					   
						   }
						   
  
                           
  ?>
  <tr>
       
        <td class="css_inicio4"><?php echo ucwords(strtolower($rs_bcliente->fields["clie_nombre"]." ".$rs_bcliente->fields["clie_apellido"])); ?></td>
        <td class="css_inicio4"><?php echo $rs_nmedico->fields["especi_nombre"]; ?></td>
		<td class="css_inicio4"><?php echo $rs_lbuscacihoy->fields["gridtur_turno"]; ?></td>
        
      </tr>
  
    <?php
	                      
	
	
                         $rs_lbuscacihoy->MoveNext();
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
  $lista_cedulas="select * from app_cliente where LENGTH(clie_rucci)!=10";
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
             <td class="caracter_error"><b><?php echo utf8_encode($rs_listacedulas->fields["centro_nombre"]); ?></b></td>
             <td class="caracter_error"><?php echo $rs_listacedulas->fields["total"]; ?></td>
           </tr>
           <?php 
		 
		 $rs_listacedulas->MoveNext(); 
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
<div class="col-xs-12"></div>
</div>


</div>

<script language="javascript">
<!--

function fecha_datadiario()
{


  $("#grid_diario").load("aplicativos/documental/listados_diario.php",{

  fecha_at:$('#fecha_at').val()

  },function(result){  



  });  



  $("#grid_diario").html("Espere un momento...");  



}

fecha_datadiario();

function imp_facdiaria() {
window.open('aplicativos/documental/listados_diarioexcel.php?fecha_at='+$('#fecha_at').val(),'ventanad','width=750,height=500,scrollbars=YES');

}

//-->

</script>

