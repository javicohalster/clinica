<?php
//cambio de fecha registro
$linkcambior="onclick=abrir_standar('aplicativos/documental/cambio_fecha.php','CAMBIO','divBody_foto','divDialog_foto',500,300,'referencia',$('#referencia_id').val(),0,0,0,0,0) style='cursor:pointer'";
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkcambior.'  style="cursor:pointer"> CAMBIAR FECHA REGISTRO </button>';

$linkhistorialr="onclick=abrir_standar('aplicativos/documental/historial_fecha.php','CAMBIO','divBody_foto','divDialog_foto',790,300,'referencia',$('#referencia_id').val(),0,0,0,0,0) style='cursor:pointer'";
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkhistorialr.'  style="cursor:pointer"> HISTORIAL CAMBIO </button>';
echo '<div id="divBody_foto"></div>';
//cambio de fecha registro

	        //---ENLACE
			
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$clie_id;
			
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["atenc_idx"]=$atenc_id;
            $objformulario->sendvar["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
			//asigna medico
            
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			
			
			$objformulario->sendvar["referencia_serviciocrx"]='1';
			$objformulario->sendvar["referencia_serviciorx"]='1';
			
				//llega de otra tabla
			 $objformulario->sendvar["enlace_idexternox"]=@$id_llega;
			 $objformulario->sendvar["enlace_tablaexternox"]=@$tabla_llega;
			 
			 $objformulario->sendvar["referencia_fecharx"]=date("Y-m-d");	
			$objformulario->sendvar["referencia_fechainvx"]=date("Y-m-d");	
			 
			 if($id_llega>0)
			{
            $objformulario->subtabla=$id_llega;
			}
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			 
			//$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["referencia_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
?>
<style type="text/css">
<!--
.style1 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style>

<?php
if($_SESSION['datadarwin2679_sessid_inicio']==74)
{
?>
<input type="button" name="Submit" value="Test ws" onclick="lee_ws()" />
<div id="lista_ws"></div>
<?php
}
?>


<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  $objformulario->generar_formulario(@$submit,$table,44,$DB_gogess); ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_direccion"];  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
	   <?php echo $rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]; ?>

    </span></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">EDAD (A la fecha de atenci&oacute;n):</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php
	//$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	if(@$objformulario->contenid[$campo_fechareg]!='')
	{
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$objformulario->contenid[$campo_fechareg]);
	}
	else
	{
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],date("Y-m-d"));
	}
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	?></td>
  </tr>
</table>

<br>

<?php
$bandera_cie=0;
if($objformulario->contenid["referencia_enlace"])
{
     $busca_diag="select count(*) as total from dns_diagnosticoreferencia where referencia_enlace='".$objformulario->contenid["referencia_enlace"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
     
	 $bandera_cie=$rs_diag->fields["total"];
}
else
{
     $busca_diag="select count(*) as total from dns_diagnosticoreferencia where referencia_enlace='".$objformulario->sendvar["referencia_enlacex"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
	 
	 $bandera_cie=$rs_diag->fields["total"];

}
?>


<p>&nbsp;</p>

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
?>
<div id="id_deriva">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
</div>
<div id="id_contra">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
?>
</div>
<div id="id_deriva1">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
?>
<div id="id_contra1">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
?>

<?php
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
            $( "#diagn_ciex<?php echo $objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx<?php echo $objformulario->subtabla; ?>').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#diagn_descripcionx<?php echo $objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#diagn_ciex<?php echo $objformulario->subtabla; ?>').val(ui.item.codigo);
					
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
		 
		 
$( "#tipref_id" ).change(function() {
  depls_forma();
});

function depls_forma()
{
   if($('#tipref_id').val()==1 || $('#tipref_id').val()==2)
   {
      $('#id_deriva').show();  
	   $('#id_deriva1').show(); 
	  $('#id_contra').hide();
	  $('#id_contra1').hide();
	  $('#referencia_entiquetaderivacion_html').html('REFERENCIA / DERIVACION');
	  
   }
   else
   {
      $('#id_deriva').hide(); 
	  $('#id_deriva1').hide();
	  $('#id_contra').show();
	  $('#id_contra1').show();
	  $('#referencia_entiquetaderivacion_html').html('CONTRAREFERENCIA / REFERENCIA INVERSA');
   }

}
	
$('#id_deriva').hide();  
$('#id_contra').hide();	
$('#id_contra1').hide();		

depls_forma(); 


    
function genera_cieexterno(codigo,diagn_tipox,idext)
{

$.ajax({
    // la URL para la petici�n
    url : 'templateformsweb/maestro_standar_newreferencia/searchcie.php',
    // la informaci�n a enviar
    // (tambi�n es posible utilizar una cadena de datos)
    data : { term : codigo },
    // especifica si ser� una petici�n POST o GET
    type : 'GET',
    // el tipo de informaci�n que se espera de respuesta
    dataType : 'json',
    // c�digo a ejecutar si la petici�n es satisfactoria;
    // la respuesta es pasada como argumento a la funci�n
    success : function(json) {
        //console.log(json[0]);	
		$('#diagn_ciex'+idext).val(json[0].codigo);
		$('#diagn_descripcionx'+idext).val(json[0].descripcion);
		$('#diagn_tipox'+idext).val(diagn_tipox);
		
    },
    // c�digo a ejecutar si la petici�n falla;
    // son pasados como argumentos a la funci�n
    // el objeto de la petici�n en crudo y c�digo de estatus de la petici�n
    error : function(xhr, status) {
        ///alert('Disculpe, existi� un problema');
    },
    // c�digo a ejecutar sin importar si la petici�n fall� o no
    complete : function(xhr, status) {
        ///alert('Petici�n realizada');
		grid_extras_9064($('#referencia_enlace').val(),0,1);
    }
});


}



<?php
if($bandera_cie==0)
{
//busca diagnosticos
//lab_tablaexterno//lab_idexterno
$campo_idext='';
//$objformulario->sendvar["enlace_idexternox"]=@$id_llega;
//$objformulario->sendvar["enlace_tablaexternox"]=@$tabla_llega;
		 
if($objformulario->sendvar["enlace_idexternox"]>0)
{
    
	$campo_idext=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like ",$objformulario->sendvar["enlace_tablaexternox"],$DB_gogess);
	
	$busca_diag="select * from ".$objformulario->sendvar["enlace_tablaexternox"]." where ".$campo_idext."='".$objformulario->sendvar["enlace_idexternox"]."'";
	$rs_budiag = $DB_gogess->executec($busca_diag,array());
	
	
	//busca datos del diagnostico
	$busca_campodiag="select * from gogess_sisfield where tab_name='".trim($objformulario->sendvar["enlace_tablaexternox"])."' and ttbl_id=1 and fie_tablasubgrid!=''";
	$rs_campodiag = $DB_gogess->executec($busca_campodiag,array());
	
	$busca_listadiag="select * from ".$rs_campodiag->fields["fie_tablasubgrid"]." where ".$rs_campodiag->fields["fie_campoenlacesub"]."='".$rs_budiag->fields[$rs_campodiag->fields["fie_campoenlacesub"]]."' order by 1 asc";
	 $rs_listd = $DB_gogess->executec($busca_listadiag,array());
	 if($rs_listd)
     {
	   while (!$rs_listd->EOF) {	
	   
	       echo " genera_cieexterno('".$rs_listd->fields["diagn_cie"]."','".$rs_listd->fields["diagn_tipo"]."','".$objformulario->sendvar["enlace_idexternox"]."'); ";
	  
	    $rs_listd->MoveNext();	
	   }	 
	 } 
	
	//busca datos del diagnostico
	
	

}			 

//busca dianosticos
}
?> 


 function lee_ws()
		 {
		   $("#lista_ws").load("leer/refer.php",{
				referencia_id:$('#referencia_id').val()
			  },function(result){  
			
			  });  
			
			  $("#lista_ws").html("Espere un momento");  
		 }


</script>

<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>