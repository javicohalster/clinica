<?php
//cambio de fecha registro
$linkcambior="onclick=abrir_standar('aplicativos/documental/cambio_fecha.php','CAMBIO','divBody_foto','divDialog_foto',500,300,'interconsulta',$('#intercon_id').val(),0,0,0,0,0) style='cursor:pointer'";
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkcambior.'  style="cursor:pointer"> CAMBIAR FECHA REGISTRO </button>';

$linkhistorialr="onclick=abrir_standar('aplicativos/documental/historial_fecha.php','CAMBIO','divBody_foto','divDialog_foto',790,300,'interconsulta',$('#intercon_id').val(),0,0,0,0,0) style='cursor:pointer'";
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
			
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			 
			//$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["intercon_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
					//llega de otra tabla
			 $objformulario->sendvar["enlace_idexternox"]=@$id_llega;
			 $objformulario->sendvar["enlace_tablaexternox"]=@$tabla_llega;
			 
			 $objformulario->sendvar["referencia_fecharx"]=date("Y-m-d");	
			 $objformulario->sendvar["referencia_fechainvx"]=date("Y-m-d");	
			 
			 if($id_llega>0)
			{
            $objformulario->subtabla=$id_llega;
			}
			
			//obtiene datos del representante
?>

<?php
$bandera_cie=0;
if($objformulario->contenid["intercon_enlace"])
{
     $busca_diag="select count(*) as total from dns_diagnosticointerconsulta where intercon_enlace='".$objformulario->contenid["intercon_enlace"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
     
	 $bandera_cie=$rs_diag->fields["total"];
}
else
{
     $busca_diag="select count(*) as total from dns_diagnosticointerconsulta where intercon_enlace='".$objformulario->sendvar["intercon_enlacex"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
	 
	 $bandera_cie=$rs_diag->fields["total"];

}
?>

<table width="800" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:<span class="css_texto">
      <?php  $objformulario->generar_formulario(@$submit,$table,44,$DB_gogess);
  echo $rs_dcliente->fields["clie_rucci"];	  ?>
    </span></span></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><strong>I. DATOS DEL USUARIO/USUARIA </strong></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><strong>Apellidos </strong></td>
    <td bgcolor="#F1F7F8"><strong>Nombres</strong></td>
    <td bgcolor="#F1F7F8"><strong>Fecha de nacimiento </strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Sexo</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Estado Civil </strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Instrucci&oacute;n</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Seguro</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Empresa donde trabaja </strong></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="css_texto"><span class="texto_caja"><?php echo utf8_encode($rs_dcliente->fields["clie_apellido"]); ?>
      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
    </span></span></td>
    <td bgcolor="#F1F7F8"><span class="texto_caja"><?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]); ?></span></td>
    <td bgcolor="#F1F7F8"><span class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></span></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_genero"];  ?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php  
	$civil_estado=$objformulario->replace_cmb("app_estadocivil","civil_id,civil_nombre","where civil_id=",$rs_dcliente->fields["civil_id"],$DB_gogess);
	echo $civil_estado;
	 ?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php
	
	$instru_estado=$objformulario->replace_cmb("dns_instruccion","instruccion_id,instruccion_nombre","where instruccion_id=",$rs_dcliente->fields["clie_instruccion"],$DB_gogess);
	echo $instru_estado;
	
	?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php
	
	$nseguro=$objformulario->replace_cmb("faesa_tipopaciente","tipopac_id,tipopac_nombre","where tipopac_id=",$rs_dcliente->fields["tipopac_id"],$DB_gogess);
	echo $nseguro;
	
	?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_dondetrabaja"];  ?></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><span class="css_paciente"><strong>EDAD (A la fecha de atenci&oacute;n):</strong></span>      <?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	?></td>
  </tr>
</table>
<br>

<?php

    //$rs_dcliente->fields["nac_id"]
    $nombrepais='';
	$nombrepais=$objformulario->replace_cmb("dns_nacionalidad","nac_id,nac_nombre","where nac_id=",$rs_dcliente->fields["nac_id"],$DB_gogess);
	//echo $nombrepais;
	
	$provinciav=$objformulario->replace_cmb("app_provincia","prob_codigo,prob_nombre","where prob_codigo like ",$rs_dcliente->fields["prob_codigo"],$DB_gogess);
	$cantonv=$objformulario->replace_cmb("app_canton","cant_codigo,cant_nombre","where cant_codigo like ",$rs_dcliente->fields["cant_codigo"],$DB_gogess);
	//$rs_dcliente->fields["clie_rucci"]
    //$rs_dcliente->fields["clie_parroquia"]
	//$rs_dcliente->fields["clie_direccion"]
    //$rs_dcliente->fields["clie_celular"]
	
?>



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
		 
		 
function genera_cieexterno(codigo,diagn_tipox,idext)
{

$.ajax({
    // la URL para la petición
    url : 'templateformsweb/maestro_standar_referencia/searchcie.php',
    // la información a enviar
    // (también es posible utilizar una cadena de datos)
    data : { term : codigo },
    // especifica si será una petición POST o GET
    type : 'GET',
    // el tipo de información que se espera de respuesta
    dataType : 'json',
    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
    success : function(json) {
        //console.log(json[0]);	
		$('#diagn_ciex'+idext).val(json[0].codigo);
		$('#diagn_descripcionx'+idext).val(json[0].descripcion);
		$('#diagn_tipox'+idext).val(diagn_tipox);
		
    },
    // código a ejecutar si la petición falla;
    // son pasados como argumentos a la función
    // el objeto de la petición en crudo y código de estatus de la petición
    error : function(xhr, status) {
        ///alert('Disculpe, existió un problema');
    },
    // código a ejecutar sin importar si la petición falló o no
    complete : function(xhr, status) {
        ///alert('Petición realizada');
		grid_extras_5401($('#intercon_enlace').val(),0,1);
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

		 
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>