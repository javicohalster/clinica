<style type="text/css">
<!--

table.fija{

border: #000000 2px solid;

box-shadow: 2px -2px 2px #000;



}

.TableScroll_factura {

        z-index:99;

		width:850px;

        height:190px;	

        overflow: auto;

      }	

	

-->

</style>

<?php

 $tab_id_valor=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_id","where tab_name like",$table,$DB_gogess);

 $lista_detalle="select * from gogess_subgrid where tab_id=".$tab_id_valor; 

 $rs_detalle = $DB_gogess->executec($lista_detalle,array());

?>



<script language="javascript">

<!--


function ver_calendario(clie_id,atenc_hc,centro_id)
{

abrir_standar("aplicativos/documental/opciones/panel/agendar/panel_ver.php","CALENDARIO","divBody_fpago","divDialog_fpago",850,600,clie_id,atenc_hc,centro_id,0,0,0,0);

}


function lista_hijos(ruc)

{

    $("#lista_hijos").load("templateformsweb/maestro_standar_recibos/lista_hijos.php",{



	ci:ruc

	

	 },function(result){       

				 

	

	  });  

	

	  $("#lista_hijos").html("Espere un momento...");



}



function grid_factura(asg)

{



$("#grid_div").load("templateformsweb/maestro_standar_recibos/grid_detalle.php",{



enlace:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),



idgrid:'<?php echo $rs_detalle->fields["subgri_id"]; ?>',



opcion:asg



 },function(result){       



			 



  });  



  $("#grid_div").html("Espere un momento...");



}





function insumo_ver()
{

if($('#tippo_id').val()=='')
{
  alert("Porfavor seleccione Tipo Cobro");
  return false;
}

abrir_standar("templateformsweb/maestro_standar_recibos/procedimientos.php","PROCEDIMIENTOS","divBody_insumo","divDialog_insumo",750,600,$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),$('#tippo_id').val(),0,0,$('#tippo_id').val(),$('#conve_id').val(),$('#doccab_autorizacion').val());



}









function insumo_verlibre()

{



abrir_standar("templateformsweb/maestro_standar_recibos/insumofree.php","INSUMO","divBody_insumo","divDialog_insumo",500,500,$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),0,0,0,0,0,0);



}







function actualiza_campo(tabla,campo,idtabla,id_detalle,valor)

{



     $("#div_actualizac").load("templateformsweb/maestro_standar_recibos/actualiza_campo.php",{



	 tablap:tabla,

	 campop:campo,

     idtablap:idtabla,

	 id_detallep:id_detalle,

	 valorp:valor,

	 enlace:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),

     idgrid:'<?php echo $rs_detalle->fields["subgri_id"]; ?>'



		  },function(result){  

	  

         $('#docdet_total_'+id_detalle).html($('#total_linea').val());

		

		$('#subtotaliva').html($('#subtotaliva1').val());

		$('#subtotaliva0').html($('#subtotaliva01').val());

		$('#subtotalnoobj').html($('#subtotalnoobj1').val());

		$('#subtotalexentoiva').html($('#subtotalexentoiva1').val());

		$('#iva').html($('#iva1').val());

		$('#total').html($('#total1').val());
		
		//=============================
		$('#doccab_total').val($('#total1').val());
		$('#doccab_subtotaliva').val($('#subtotaliva1').val());
		$('#doccab_subtotalsiniva').val($('#subtotaliva01').val());
        $('#doccab_subtnoobjetoi').val($('#subtotalnoobj1').val());
        $('#doccab_subtexentoiva').val($('#subtotalexentoiva1').val());
        $('#doccab_iva').val($('#iva1').val());



		  });  



	// $("#div_actualizac").html("Espere un momento...");



}





function actualiza_descuentogeneral(tabla,campo,idtabla,id_detalle,valor)

{



     $("#div_actualizac").load("templateformsweb/maestro_standar_recibos/actualiza_campodescuento.php",{



	 tablap:tabla,



	 campop:campo,



     idtablap:idtabla,



	 id_detallep:id_detalle,



	 valorp:valor,

	 enlace:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),

     idgrid:'<?php echo $rs_detalle->fields["subgri_id"]; ?>'



		  },function(result){  



		  

$('#docdet_total_'+id_detalle).html($('#total_linea').val());

		



		$('#subtotaliva').html($('#subtotaliva1').val());

		$('#subtotaliva0').html($('#subtotaliva01').val());

		$('#subtotalnoobj').html($('#subtotalnoobj1').val());

		$('#subtotalexentoiva').html($('#subtotalexentoiva1').val());

		$('#iva').html($('#iva1').val());

		$('#total').html($('#total1').val());



		  });  



	 $("#div_actualizac").html("Espere un momento...");







}







function borrar_item(id_borrar)

{



    if(confirm("Alerta. Desea borrar este registro ?")) { 



	      $("#grid_borraitemv").load("templateformsweb/maestro_standar_recibos/borrar_item.php",{idenlace:id_borrar



   



		  },function(result){  



		  grid_factura(0);



		  });  



		  $("#grid_borraitemv").html("Espere un momento...");



    }



	



	



}





function forma_pago()

{



abrir_standar("templateformsweb/maestro_standar_recibos/fpago.php","FORMA_PAGO","divBody_fpago","divDialog_fpago",600,500,$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),0,0,0,0,0,0);





}



function barra_ver()

{



abrir_standar("templateformsweb/maestro_standar_recibos/insumo_barra.php","BARRA","divBody_insumo","divDialog_insumo",500,400,$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),0,0,0,0,0,0);



}



function genera_xml()
{


$("#genera_xml").load("templateformsweb/maestro_standar_recibos/generar_xml.php",{

   enlace:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val()  

 },function(result){       

		activa_desactiva();
		$('#genera_xmlfirmado').html("");
		$('#guarda_firma').html("");
		activa_proceso();
			
  });  



$("#genera_xml").html("Espere un momento...");



}


function firma_directa(idfactura)
{

if($('#firm_xmldata').val()!='')
{
  
  //$("#genera_xmlfirmado").load("http://186.4.157.126:75/doc_sign/docsign.php",{
   
$("#genera_xmlfirmado").load("http://127.0.0.1/doc_sign/docsign.php",{

   xml:$('#firm_xmldata').val(),
   usuario:'faesa',
   clave:'123456'
   

 },function(result){       

  if($('#firm_xmldatafirmado').val()!='')
  {
    guarda_firma()
  }
  else
  {
    alert ("Firma no disponible...");
  
  }			 

  });  



$("#genera_xmlfirmado").html("Espere un momento...");

}
else
{
 alert('XML no existe');
}

}

function guarda_firma()
{
 
 $("#guarda_firma").load("firma_doc/gfirma_doc.php",{

   idfactura:$('#doccab_id').val(),
   xml:$('#firm_xmldatafirmado').val()

 },function(result){       

       

  });  



$("#guarda_firma").html("Espere un momento...");
   

}


function firmar_xml(idfactura)
{



$("#genera_xml").load("firma_doc/firma_doc.php",{

idfactura:idfactura

 },function(result){       



  });  



$("#genera_xml").html("Espere un momento...");





/*



$("#genera_xml").load("firma/firma_factura.php",{

   cedula_firma:'<?php echo $_SESSION['datadarwin2679_sessid_cedula']; ?>',

   emp_id:'<?php echo $_SESSION['datadarwin2679_sessid_emp_id']; ?>',

   doccab_id:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val()

   

 },function(result){       



			 

  });  



$("#genera_xml").html("Espere un momento...");*/



}



function enviar_sri(idfactura)
{
  
  
$("#sri_panel").load("autoriza/envio_fac.php",{

     idfactura:idfactura

 },function(result){       


  });  

$("#sri_panel").html("Espere un momento...");


}

function obtener_sri(idfactura)
{


$("#sri_panel").load("autoriza/autoriza_fac.php",{

     idfactura:idfactura

 },function(result){       

  });  

$("#sri_panel").html("Espere un momento...");


}



function ver_pdf(idfactura,opcion)
{
    
	
    
	if(opcion=='01')
	{
			 window.location.href='pdfrecibos/pdf.php?xml=' + idfactura;
	}
			 
     if(opcion=='04')
	{
			 window.location.href='pdfcredito/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='05')
	{
			 window.location.href='pdfdebito/pdf.php?xml=' + idfactura;
	}
	
	 if(opcion=='06')
	{
			 window.location.href='pdfguia/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='07')
	{
			 window.location.href='pdfsretencion/pdf.php?xml=' + idfactura;
	}

}



function ver_xml(idfactura,opcion)
{

  if(opcion=='01')
	{
			 window.location.href='xmlrecibos/ver.php?xml=' + idfactura;
	}
			 
     if(opcion=='04')
	{
			 window.location.href='xmlrecibos/ver.php?xml=' + idfactura;
	}
	 if(opcion=='05')
	{
			 window.location.href='xmlrecibos/ver.php?xml=' + idfactura;
	}
	
	 if(opcion=='06')
	{
			 window.location.href='xmlrecibos/ver.php?xml=' + idfactura;
	}
	 if(opcion=='07')
	{
			 window.location.href='xmlrecibos/ver.php?xml=' + idfactura;
	}



}

function ejecuta_proc(proceso)
{
    $('#queejecuta').val(proceso);	
	
	ejecutar_submit();
}

function activa_proceso()
{
   if($('#queejecuta').val()==1)
   {   
      ver_pdf($('#doccab_id').val(),'01');
   }
   
   if($('#queejecuta').val()==2)
   {   
      ver_xml($('#doccab_id').val(),'01')
   }
   
   $('#queejecuta').val(0);

}


function activa_boton()
{

  //$("#div_imprimirtiket").html('<a target="_blank" class="btnPrint_imp" href="impresionrecibo/imprimir.php?imp=<?php echo $rs_cfgimp->fields["imp_id"]; ?>&pa='+$("#doccab_id").val()+'" ><img src="images/btn_imp.png" border=0 /></a>');
  //$(".btnPrint_imp").printPage();	
  
  $('#div_pdf').show();
  $('#div_xml').show();
  $('#div_sriemail').show();  
 // $('#div_panelsri').show();
  //$('#div_firma').show();
  //$('#div_srienviar').show();
  //$('#div_sriobtener').show();
}



function oculta_boton()
{
  $("#div_imprimirtiket").html('');  
  $('#div_pdf').hide();
  $('#div_xml').hide();
  $('#div_panelsri').hide();
  $('#div_sriemail').hide();
  //$('#div_firma').hide();
  //$('#div_srienviar').hide();
  //$('#div_sriobtener').hide();
}



function activa_desactiva()
{

	if($('#doccab_ndocumento').val()=='-documento-')
	{
	oculta_boton();
	}
	else
	{
	activa_boton();
	}

}

//-->

</script>

<?php

  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["tipocmp_codigox"]='99';
			$objformulario->sendvar["estaf_idx"]='1';
			$objformulario->sendvar["origenx"]='MANUAL';
			

			$valoralet=mt_rand(1,500);
			$aletorioid='77'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["doccab_idx"]=$aletorioid;
			$busca_emp="select * from app_empresa where emp_id='".$_SESSION['datadarwin2679_sessid_emp_id']."'";
            $rs_femp = $DB_gogess->executec($busca_emp,array());
            $rucempresa=$rs_femp->fields["emp_ruc"];
			$objformulario->sendvar["doccab_rucempresax"]=$rucempresa;
			$objformulario->sendvar["ambi_valorx"]=$objimpuestos->ambi_valor;
			$objformulario->sendvar["emis_valorx"]=$objimpuestos->tipoemi_codigo;
			$objformulario->sendvar["tipase_idx"]=10;
			$objformulario->sendvar["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
			$objformulario->sendvar["tippo_idx"]=1;
			
			$objformulario->sendvar["doccab_ndocumentox"]=strtoupper(date("Y-m-d").uniqid());
			

?>  

<div class="row">
  <div class="col-sm-6"><?php 
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
 ?></div>
  <div class="col-sm-6"> 
                <?php 

		       $objformulario->sendvar["facturaxnum"] ="-factura-";
		     //$generafactura= 
			   $objformulario->generar_formulario(@$submit,$table,81,$DB_gogess);
		       $objformulario->generar_formulario(@$submit,$table,2,$DB_gogess);
		  ?> 
  </div>
</div> 
<?php       

if($csearch)

{

 $valoropcion='actualizar';

}

else

{

 $valoropcion='guardar';

}



echo "<input name='csearch' type='hidden' value=''>

<input name='idab' type='hidden' value=''>

<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >

<input name='table' type='hidden' value='".$table."'>";



?>

<div id="div_actualizac" ><input name="total_linea" type="hidden" id="total_linea" value="" ></div>

<p>&nbsp;</p>	

<div class="row">

  <!--<div class="col-sm-1">

    <div onClick="barra_ver()" style="cursor:pointer" ><img src="images/barra.png"></div>	 

  </div>-->

  <div class="col-sm-1">
    <div id="fpago_btn" ><div onClick="forma_pago()" style="cursor:pointer" ><img src="images/fpago.png"></div></div>
  </div>

  <div class="col-sm-1">
	<div id="insumo_btn" ><div  style="cursor:pointer" ></div></div>
  </div>  

  <div class="col-sm-1"> 
	<div id="terapia_btn" ><div onClick="terapia_ver()" style="cursor:pointer" ><img src="images/personal.png"></div></div>
  </div>
  
  <div class="col-sm-1"> 
	<div id="hill_btn" ><div onClick="hill_ver()" style="cursor:pointer" ><img src="images/hill.png"></div></div>
  </div>

  <div class="col-sm-1">
	<div id="libre_btn" ><div onClick="insumo_verlibre()" style="cursor:pointer" ><img src="images/cochelibre.png"></div></div>
  </div>
  

  
  <div id="div_pdf" class="col-sm-1">
	<div onClick="ejecuta_proc('1')" style="cursor:pointer" ><img src="images/pdf.png"></div>
  </div>  

  <div id="div_xml" class="col-sm-1">
	<div onClick="ejecuta_proc('2')" style="cursor:pointer" ></div>
  </div>
  
 <!-- <div id="div_imprimirtiket" class="col-sm-1">
	
  </div> -->
  <!-- <div id="div_panelsri" class="col-sm-1">
	<div id="sripanel_btn" ><div onClick="verpanel_sri()" style="cursor:pointer" ><img src="images/sri_panel.png"></div></div>
  </div> -->
  
  <div id="div_sriemail" class="col-xs-4 col-sm-1">
	<div onClick="enviar_correo()" style="cursor:pointer" ><img src="images/sriemail.png"></div>
  </div> 

</div>  





<p>&nbsp;</p>	

<p><div id="grid_div"></div></p>



	

<div class="row">

  <div class="col-sm-6">



	

  </div>

  <div class="col-sm-6">

  

  <?php

	$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess);

  ?>

  

  

  </div>

  

</div>  			



<script language="javascript">

<!--

function enviar_correo()
{

$("#sri_email").load("correo/email_proforma.php",{

     doccab_id:$('#doccab_id').val()

 },function(result){       


  });  

$("#sri_email").html("Espere un momento...");

}

function guardar_cliente_data()
{

   $("#grid_clientef").load("templateformsweb/maestro_standar_recibos/guarda_cliente.php",{


doccab_rucci_cliente:$('#doccab_rucci_cliente').val(),
tipoident_codigo:$('#tipoident_codigo').val(),
doccab_nombrerazon_cliente:$('#doccab_nombrerazon_cliente').val(),
doccab_apellidorazon_cliente:$('#doccab_apellidorazon_cliente').val(),
doccab_direccion_cliente:$('#doccab_direccion_cliente').val(),
doccab_telefono_cliente:$('#doccab_telefono_cliente').val(),
doccab_email_cliente:$('#doccab_email_cliente').val(),
emp_id:$('#emp_id').val()



 },function(result){       

			

		generar_clave_acceso();	

			 

  });  

  $("#grid_clientef").html("Espere un momento...");

   

}





function generar_clave_acceso()

{



 $("#g_claveacceso").load("templateformsweb/maestro_standar_recibos/gclavedeacceso.php",{

   

      doccab_id:$('#doccab_id').val()





 },function(result){       

			

			$('#doccab_clavedeaccesos').val($('#gclaveacceso').val());			

			$('#doccab_nautorizacion').val($('#gclaveacceso').val());

			$('#despliegue_doccab_nautorizacion').html($('#gclaveacceso').val());

			

			genera_xml();

			

			

  });  

  $("#g_claveacceso").html("Espere un momento...");





}



//-->

</script>



<script>

         $(function() {

            $( "#doccab_rucci_cliente" ).autocomplete({

               source: "templateformsweb/maestro_standar_recibos/search.php",

               minLength: 4,

			   select: function( event, ui ) {

				  $('#tipoident_codigo').val(ui.item.codigo);
				  $('#doccab_nombrerazon_cliente').val(ui.item.nombre);
				  $('#doccab_apellidorazon_cliente').val(ui.item.apellido);
				  $('#doccab_direccion_cliente').val(ui.item.direccion);
				  $('#doccab_telefono_cliente').val(ui.item.telefono);
				  $('#doccab_email_cliente').val(ui.item.email);

				  
                  var mensaje;
				  var opcion = confirm("LA CEDULA PARA LA FACTURA ES LA MISMA DEL PACIENTE?");
				  if (opcion == true) {					
					
					$('#doccab_identificacionpaciente').val(ui.item.ruc);
					
				  }
                   else
				   {
				   $('#doccab_identificacionpaciente').val('');
				   }

				 //lista_hijos(ui.item.ruc);

					

			   }

            });

         });


$( "#doccab_rucci_cliente" ).blur(function() {
  
           if($('#doccab_rucci_cliente').val()=='')
			{
				  
				  var mensaje;
				  var opcion = confirm("LA CEDULA PARA LA FACTURA ES LA MISMA DEL PACIENTE?");
				  if (opcion == true) {					
					
					$('#doccab_identificacionpaciente').val($('#doccab_rucci_cliente').val());
					
				  }
                   else
				   {
				      $('#doccab_identificacionpaciente').val('');
				   }
				   
			 } 
  
});


function genera_turnovalorec()
{

$("#genrap_tvalor").load("templateformsweb/maestro_standar_recibos/genera_turno.php",{

doccab_identificacionpaciente:$('#doccab_identificacionpaciente').val(),
doccab_id:$('#doccab_id').val(),
centro_id:$('#centro_id').val(),
tipo_doc:'1'

 },function(result){      	 

  });  

  $("#genrap_tvalor").html("Espere un momento...");


}

</script>

<div id="sri_email"></div>

<div id="div_<?php echo $table ?>" > </div>

<div id="divBody_fpago" ></div>

<div id="g_claveacceso"> <input name="gclaveacceso" type="hidden" id="gclaveacceso" value=""> </div>



<div id="divBody_insumo" ></div>

<div id="grid_borraitemv" ></div>

<div id="lista_data_xml">

<div id="genera_xml" >
<?php
$xml_pafirmar='';
if($objformulario->contenid["doccab_id"])
{
$busca_xmlexistente="select doccab_xml from beko_recibocabecera where doccab_id=".$objformulario->contenid["doccab_id"];
$rs_xmlexterno = $DB_gogess->executec($busca_xmlexistente,array());
$xml_pafirmar=$rs_xmlexterno->fields["doccab_xml"];
}
?>
<textarea name="firm_xmldata" id="firm_xmldata"><?php echo $xml_pafirmar; ?></textarea>

</div>

<div id="genera_xmlfirmado" >
<?php
$xml_pafirmarx='';
if($objformulario->contenid["doccab_id"])
{
$busca_xmlexistentex="select doccab_xmlfirmado from beko_recibocabecera where doccab_id=".$objformulario->contenid["doccab_id"];
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex,array());
$xml_pafirmarx=$rs_xmlexternox->fields["doccab_xmlfirmado"];
}
?>
<textarea name="firm_xmldatafirmado" id="firm_xmldatafirmado"><?php echo $xml_pafirmarx; ?></textarea>
</div>

</div>

<div id="sri_panel"></div>

<div id="guarda_firma"></div>

<div id="divBody_pacientedata"></div>



<script language="javascript">
<!--



grid_factura(0);

activa_desactiva();





//-->
</script>	

<?php
//echo "sssssssssss".$objformulario->contenid["doccab_estadosri"];
$envio_valorvert=0;
if($objformulario->contenid["doccab_id"])
{
	$busca_estado_sri="select doccab_estadosri from beko_recibocabecera where doccab_id='".$objformulario->contenid["doccab_id"]."'";
	$rs_bsri = $DB_gogess->executec($busca_estado_sri,array());
	if($rs_bsri->fields["doccab_estadosri"]=='AUTORIZADO')
	{
	  $envio_valorvert=1;
	  echo "<B>DOCUMENTO FUE AUTORIZADO EN EL SRI</B>";
	  ?>
<script language="javascript">
<!--
	  $("#doccab_rucci_cliente").attr('disabled','disabled');	  
	  $("#tipoident_codigo").attr('disabled','disabled');
	  $("#doccab_nombrerazon_cliente").attr('disabled','disabled');
	  $("#doccab_direccion_cliente").attr('disabled','disabled');
	  $("#doccab_telefono_cliente").attr('disabled','disabled');
	  $("#doccab_email_cliente").attr('disabled','disabled');
	  $("#doccab_ndet").attr('disabled','disabled');
	 
	  
	   
	    $("#fpago_btn").hide();
	    $("#insumo_btn").hide();
		//$("#terapia_btn").hide();
		$("#libre_btn").hide();
		$("#firma_btn").hide();
		
		$("#sri_btn").hide();
		$("#guardab_btn").hide();
		
	  
//-->
</script>  
	
	  <?php
	}

}
?>
<script language="javascript">
<!--

function hill_ver()
{

if($('#tippo_id').val()=='')
{
  alert("Porfavor seleccione Tipo Cobro");
  return false;
}

abrir_standar("templateformsweb/maestro_standar_recibos/mghill.php","TARIFARIO","divBody_insumo","divDialog_insumo",900,600,$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),$('#tippo_id').val(),$('#doccab_id').val(),0,$('#conve_id').val(),$('#doccab_autorizacion').val(),'<?php echo $envio_valorvert; ?>');


}


function terapia_ver()
{

if($('#tippo_id').val()=='')
{
  alert("Porfavor seleccione Tipo Cobro");
  return false;
}

abrir_standar("templateformsweb/maestro_standar_recibos/personal.php","TARIFARIO","divBody_insumo","divDialog_insumo",900,600,$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val(),$('#tippo_id').val(),$('#doccab_id').val(),0,$('#conve_id').val(),$('#doccab_autorizacion').val(),'<?php echo $envio_valorvert; ?>');


}

function verpanel_sri()
{

abrir_standar("templateformsweb/maestro_standar_recibos/sri.php","SRI","divBody_insumo","divDialog_insumo",400,180,0,0,0,0,0,0,0);


}


//$('#doccab_identificacionpaciente_despliegue').html('<button type="button" class="mb-sm btn btn-success" onclick="buscar_pacienteexiste()" style="cursor:pointer"> Paciente </button>');

function buscar_pacienteexiste()
{
  abrir_standar("templateformsweb/maestro_standar_facturas/paciente.php","PACIENTE","divBody_pacientedata","divDialog_pacientedata",900,600,0,25,0,0,0,0,$('#doccab_identificacionpaciente').val());
}



$( "#doccab_rucci_cliente" ).change(function() {
    $('#doccab_identificacionpaciente').val('');
});

$( "#doccab_rucci_cliente" ).blur(function() {
  
           if($('#doccab_identificacionpaciente').val()=='')
			{
				  
				  var mensaje;
				  var opcion = confirm("LA CEDULA PARA LA FACTURA ES LA MISMA DEL PACIENTE?");
				  if (opcion == true) {					
					
					$('#doccab_identificacionpaciente').val($('#doccab_rucci_cliente').val());
					
				  }
                   else
				   {
				      $('#doccab_identificacionpaciente').val('');
				   }
				   
			 } 
  
});

	$( "#tipoident_codigo" ).change(function() {
		    
			if($('#tipoident_codigo').val()=='07')
			{
			   $('#doccab_rucci_cliente').val('9999999999');
			   $('#doccab_nombrerazon_cliente').val('CONSUMIDOR');
			   $('#doccab_apellidorazon_cliente').val('FINAL');
			   $('#doccab_direccion_cliente').val('NA');
			 
			}
			
			
		});

$('#lista_data_xml').hide();
//-->
</script>
<input name="queejecuta" type="hidden" id="queejecuta" value="0" />
