<?php
	        //---ENLACE
			
			//----

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=@$clie_id;
			
			$objformulario->sendvar["hcx"]=@$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["atenc_idx"]=@$atenc_id;
            $objformulario->sendvar["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
			//asigna medico
            
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			 
			//$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["activiope_enlacex"]=$aletorioid;
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			
			//$datos_representante="select * from dns_representante where clie_enlace='".@$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
           // $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
?>
<p>&nbsp;</p>
<div class="alert alert-danger" role="alert">
  <b>Aviso Importante!!!</b> Por favor agregue en la lista al menos una actividad para registrar el n&uacute;mero de horas que ocupo en la actividad realizada, esto se tomar&aacute; en cuenta en el reporte PRODUCTIVIDAD OPERATIVA. No olvide guardar el Formulario. Dando clic en Grabar
</div>
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
               minLength: 1,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#diagn_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#diagn_ciex').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 
		 	  $(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		  $(function() {
            $( "#prod_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#prod_codigox').val(ui.item.codigo);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#plantrai_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
               minLength: 1,
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
		 
		  $("#gractope_tiempohorasx").mask({mask: "##:##"});
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>