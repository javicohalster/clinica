<?php

$objformulario->react_id=$react_id;
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];
            $valoralet=mt_rand(1,50000);
			$aletorioid='02'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["genr_enlacex"]=$aletorioid;
			$objformulario->sendvar["genr_aniox"]=date("Y");
			$objformulario->sendvar["genr_mesx"]=date("m");
			


$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 

?>
<center>
<input type="button" name="Button" value="GENERAR ROLES" onclick="genera_datos()" /><br /><br /><br />
<?php
echo '<div onclick="ver_datos()" style="cursor:pointer"  ><img src="images/pdfrol.png" border="0"  /></a></center>';
?>
</center>
<br />
<div id="despl_roldepagos" align="center"></div>
<br /><br /><br />
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

<script type="text/javascript">
<!--

function genera_datos()
{
   if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }
   
   $("#despl_roldepagos").load("templateformsweb/maestro_standar_generarroles/generar_rol.php",{
   genr_id:$('#genr_id').val()

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  }); 
  $("#despl_roldepagos").html("Espere un momento"); 

}

function ver_datos()
{

if($('#genr_id').val()=='')
   {
     alert("Guarde el Registro Primero.");
     return false;
   }

location.href='pdfroles/roles_varios.php?genr_id='+$('#genr_id').val();

}

$( "#genr_fechacierre" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>