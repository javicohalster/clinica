<?php

	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

		    $objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
			$objformulario->sendvar["cuadrobm_idx"]=$_POST["pVar7"];
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];

			

			 



?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
	   
	   ?></td>
	   <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess);
	   
	   ?></td>
     </tr>
     <tr>
       <td colspan="2"><?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
	   
	   ?></td>
     </tr>
   </table>



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
$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

$('#certif_contenido').ckeditor();
//  End -->
</script>