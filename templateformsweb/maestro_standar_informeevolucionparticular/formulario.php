<script language="javascript">
<!--
function ver_informeparticular(seccion,id)
{
var reponsables;
if(id=='')
{
 alert("Guarde el informe para imprimir");
 return false;
}

reponsables=1;
if (confirm("Desea que las firmas de responsables vaya en la misma hoja?")) {

    reponsables=0;
}

myWindow2=window.open('reportes/reportes_particular.php?seccion='+seccion+'&idsec='+id+'&dhoja='+reponsables,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}
//-->
</script>

<?php  
	        //---ENLACE
			$valoralet=mt_rand(1,500);
			$aletorioid=$_SESSION['datadarwin2679_sessid_cedula'].date("Ymdhis").$valoralet;
			//----
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$_POST["pVar2"];
			$objformulario->sendvar["codex"]=$aletorioid;
			$objformulario->sendvar["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
			
			$objformulario->sendvar["hcx"]=$rs_dcliente->fields["clie_rucci"];
			
			$objformulario->sendvar["infomrevopr_fechaimpresionx"]=date("Y-m-d");
			$objformulario->sendvar["infomrevopr_validezx"]=date("Y-m-d");
			
			 
			 
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];
			
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			
			$objformulario->sendvar["atenc_enlacex"]=$aletorioid;
			
			
			
		//echo getcwd();	 
?>

<button type="button" class="mb-sm btn btn-primary"  onClick="ver_informeparticular(4,$('#infomrevopr_id').val())"  style="background-color:#000066" >IMPRIMIR INFORME</button>

<div class="form-group">	
<div class="col-md-12">
<?php
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
</div>
</div>

<div class="form-group">
<div class="col-md-12">
<?php
if($csearch)
{
$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
}
?>
</div>
</div>



<div class="form-group">
<div class="col-md-12">
<?php
if($csearch)
{
$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
}
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
<div id=div_<?php echo $table ?> > </div>
<div id="divBody_informes" ></div>
<script language="javascript">
<!--

var config1 ={
  toolbarGroups: [
						{"name":"basicstyles","groups":["basicstyles"]},
						{"name":"paragraph","groups":["list","blocks"]},
						{"name":"styles","groups":["styles"]}
					],
					// Remove the redundant buttons from toolbar groups defined above.
					removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
}



$('#infomrevopr_diagnosticoclinico').ckeditor(config1);
$('#infomrevopr_situacionactual').ckeditor(config1);	 
$('#infomrevopr_recomendaciones').ckeditor(config1);	 

//-->
</script>