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

.tableScroll_grids {
        z-index:99;
        height:190px;	
        overflow: auto;
      }  

</style>
<?php
            
	        //---ENLACE
			$tipofor_id=0;
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$clie_id;		
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["centro_idx"]=$centro_id;
			$objformulario->sendvar["estaatenc_idx"]=4;
			@$objformulario->sendvar["tipofor_idx"]=$tipofor_id;			
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
					

			//--------------------------------------------------
			//busca signos vitales			
			$objformulario->sendvar["atenc_enlacex"]=$rs_atencion->fields["atenc_enlace"];	
            $objformulario->sendvar["conext_etiquetasignosvx"]=$enlace_atencion;			
			//--------------------------------------------------
			
			$objformulario->sendvar["atenc_idx"]=$atenc_id;

			//asigna medico
           
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["admmed_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
		
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


<p>&nbsp;</p>


<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
?>

<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
<div id="mujer_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
?>
</div>
<div id="antecedentesp_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
?>
</div>
<div id="antecedentesf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
?>
<div id="revicionorgf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
?>
</div>
<div id="signos_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess);
?>
</div>
<div id="examenfisico_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 
?>
</div>

<div id="tarifario_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
?>
</div>
<div id="diagnostico_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
?>
</div>
<div id="recetapres_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess);
?>
</div>
<div id="dispositivos_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,16,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,17,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,18,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,19,$DB_gogess);
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

</script>


<script>
 
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>