<style>
  .ui-autocomplete {
    max-height: 400px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 400px;
  }
  </style>
<?php

	        //---ENLACE
			
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$clie_id;
			
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["atenc_idx"]=$atenc_id;
            $objformulario->sendvar["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
			
			$objformulario->sendvar["odonto_gridsignosvx"]=$enlace_atencion;
			$objformulario->sendvar["atenc_enlacex"]=$enlace_atencion;
			
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
			
			//asigna medico
            if(@$rs_buscadatos_fecha->fields["usua_id"])
			{
			$objformulario->sendvar["usua_idx"]=@$rs_buscadatos_fecha->fields["usua_id"];
			}
			else
			{
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			
			}
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			 
			$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["odonto_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			
			//$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
           // $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
?>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  echo $rs_atencion->fields["atenc_hc"]; ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
	   <?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>

    </span></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">EDAD (A la fecha de atenci&oacute;n):</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	?></td>
  </tr>
    <tr>
    <td bgcolor="#D3E0EB"><span class="css_paciente">ESTABLECIMIENTO:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,77,$DB_gogess); ?> </td>
    <td bgcolor="#D3E0EB"><span class="css_paciente">PROFESIONAL:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,88,$DB_gogess); ?></td>
  </tr>
  
  
</table>

<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td onclick="ver_informedns(5,$('#<?php echo $campo_primariodata; ?>').val())" style="cursor:pointer"><img src="images/iconos/declaracion.png" width="194" height="76" /></td>
    <td onclick="ver_informedns(6,$('#<?php echo $campo_primariodata; ?>').val())" style="cursor:pointer" ><img src="images/iconos/negativadeclaracion.png" width="194" height="76" /></td>
    <td onclick="ver_informedns(7,$('#<?php echo $campo_primariodata; ?>').val())" style="cursor:pointer" ><img src="images/iconos/revocatoriaclaracion.png" width="194" height="76" /></td>
  </tr>
</table>
<p>&nbsp;</p>

<?php
$estadoval1='';
$estadoval2='';
$estadoval3='';
$estadoval4='';

switch (trim($rs_atencion->fields["atenc_estadoodontologia"])) {
    case 'SUBSECUENTE':
        $estadoval1='checked';
		$estadoval4='checked';
        break;
    case 'ALTA':
        $estadoval2='checked';
        break;
    case 'DESERCION':
        $estadoval3='checked';
        break;
	case 'PRIMERA VEZ':
        $estadoval4='checked';
        break;	
}
?>
<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" bgcolor="#DEEEF3"><strong>Seleccione el estado en el que se encuentra la atenci&oacute;n actualmente. </strong></td>
  </tr>
  <tr>
    <td><div align="center">PRIMERA VEZ </div></td>
    
    <td><div align="center">ALTA</div></td>
    <td><div align="center">DESERCION</div></td>
  </tr>
  <tr>
    <td><div align="center">
	<?php
	 if(!($objformulario->bloqueo_valor))
	 {
	 ?>
      <input name="estadomedi" type="radio" id="estadomedi1" value="4" onclick="click_radiob()" <?php echo $estadoval4; ?>  />
	  <?php
	 }
	 else
	 {
	    if($estadoval4)
		{
		   echo '<img src="images/check_on.png" width="12" height="12" />';
		}
		else
		{
		   echo '<img src="images/check_off.png" width="12" height="12" />';
		}
	 }
	 ?>  
    </div></td>
  
    <td><div align="center">
	<?php
	 if(!($objformulario->bloqueo_valor))
	 {
	 ?>
      <input name="estadomedi" type="radio" id="estadomedi3" value="2" onclick="click_radiob()" <?php echo $estadoval2; ?> />
	  <?php
	 }
	 else
	 {
	    if($estadoval2)
		{
		   echo '<img src="images/check_on.png" width="12" height="12" />';
		}
		else
		{
		   echo '<img src="images/check_off.png" width="12" height="12" />';
		}
	 }
	 ?>
    </div></td>
    <td><div align="center">
	<?php
	 if(!($objformulario->bloqueo_valor))
	 {
	 ?>
      <input name="estadomedi" type="radio" id="estadomedi4" value="3" onclick="click_radiob()" <?php echo $estadoval3; ?> />
	   <?php
	 }
	 else
	 {
	    if($estadoval3)
		{
		   echo '<img src="images/check_on.png" width="12" height="12" />';
		}
		else
		{
		   echo '<img src="images/check_off.png" width="12" height="12" />';
		}
	 }
	 ?>
    </div></td>
  </tr>
  <tr>
    <td height="20" colspan="4"><div id="div_estadoatencion"></div></td>
  </tr>
</table>
<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);

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
<div id=div_<?php echo $table ?> > </div>


<script>
         $(function() {
            $( "#diagn_ciex" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#diagn_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagn_ciex').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 	  $(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#prod_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#prod_codigox').val(ui.item.codigo);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
	   $(function() {
            $( "#plantra_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamento.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantra_medicamentox').val(ui.item.descripcion);
				  $('#plantra_concentracionx').val(ui.item.concentracion);
				  $('#plantra_presentacionx').val(ui.item.presentacion);
				  $('#plantra_viax').val(ui.item.via);
				  $('#plantra_preciotechox').val(ui.item.techo);
				  $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantra_medicamentox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamentotxt.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantra_codigox').val(ui.item.codigo);
				  $('#plantra_concentracionx').val(ui.item.concentracion);
				  $('#plantra_presentacionx').val(ui.item.presentacion);
				  $('#plantra_viax').val(ui.item.via);
				  $('#plantra_preciotechox').val(ui.item.techo);
				  $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
					
			   }
            });
         });	  


function click_radiob()
		 {
		 	   
		   $("#div_estadoatencion").load("templateformsweb/maestro_standar_odontologia/estadog.php",{
			   atenc_id:$('#atenc_id').val(),
			   estaatenc_id:$('input:radio[name=estadomedi]:checked').val()
			
		
			  },function(result){  
			
			
			  });  
			
			  $("#div_estadoatencion").html("Espere un momento...");  
  
		 
		 }
		   
		 
		 
function ver_informedns(seccion,id)
{

var reponsables=0;
//------------------------------------
//if($('#<?php echo $campo_primariodata; ?>').val()=='')
//{
  
// alert("Porfavor guarde el registro para ver el reporte...");
//}
//else
//{
	
myWindow2=window.open('reportes/certificado_standar.php?atid='+$('#clie_id').val()+'&iddoc='+$('#usua_id').val()+'&seccion='+seccion+'&idsec='+id+'&dhoja='+reponsables,'ventana_consentimiento','width=950,height=600,scrollbars=YES');
myWindow2.focus();
//}
//-------------------------------
}
 
 
				
				
				
		$(function() {
            $( "#plantrai_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantrai_nombredispositivox').val(ui.item.descripcion);
				  $('#plantrai_preciox').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantrai_nombredispositivox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivotxt.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#plantrai_codigox').val(ui.item.codigo);
				  $('#plantrai_preciox').val(ui.item.precio);
					
			   }
            });
         });	
		
 
	
    
      $( "#odonto_indicec" ).change(function() {
                   sumar_ocp();
				}); 
				
	  $( "#odonto_indicep" ).change(function() {
                   sumar_ocp();
				}); 
       $( "#odonto_indiceo" ).change(function() {
                   sumar_ocp();
				}); 				
				
	  function sumar_ocp()
	  {
		  var odonto_indicec=parseFloat($('#odonto_indicec').val());
		  var odonto_indicep=parseFloat($('#odonto_indicep').val());
		  var odonto_indiceo=parseFloat($('#odonto_indiceo').val());
		  var im=odonto_indicec + odonto_indicep + odonto_indiceo;
		  $('#odonto_total').val(im);
		  
		  if(im>52)
		  {
			 $('#odonto_total_despliegue').html("<span style='color:#FF0000'>Fuera de Rango</span>") 
		  }
			  
		  
	  }	  
	  
	  
	  $( "#odonto_indicec1" ).change(function() {
                   sumar_ocp1();
				}); 
				
	  $( "#odonto_indicee" ).change(function() {
                   sumar_ocp1();
				}); 
       $( "#odonto_indiceo1" ).change(function() {
                   sumar_ocp1();
				}); 
	  function sumar_ocp1()
	  {
		  var odonto_indicec1=parseFloat($('#odonto_indicec1').val());
		  var odonto_indicee=parseFloat($('#odonto_indicee').val());
		  var odonto_indiceo1=parseFloat($('#odonto_indiceo1').val());
		  var im=odonto_indicec1 + odonto_indicee + odonto_indiceo1;
		  $('#odonto_total1').val(im);
		  
		  if(im>52)
		  {
			 $('#odonto_total1_despliegue').html("<span style='color:#FF0000'>Fuera de Rango</span>") 
		  }
			  
		  
	  }	 
		
		sumar_ocp1();
		sumar_ocp();
		
		
		
		//busca cantidad de productos

  $( "#plantra_cantidadx" ).change(function() {
                     busca_disponibles();
				});
	
  $( "#plantra_frecuenciax" ).change(function() {
                     busca_disponibles();
				});				
				
  $( "#plantra_diasx" ).change(function() {
                     busca_disponibles();
				});
  				
				
  function busca_disponibles()
  {
	  $("#div_disponibilidad").load("templateformsweb/maestro_standar_anamnesisclinica/busca_disponibles.php",{
	   plantra_codigox:$('#plantra_codigox').val()
	

	  },function(result){  
	
	
	  });  
	
	  $("#div_disponibilidad").html("Espere un momento...");  
  
  }	
		
</script>

<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>