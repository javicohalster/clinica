<?php


	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

		    $objformulario->sendvar[$enlace_general]=$_POST["pVar7"];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['datadarwin2679_centro_id'];
			
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];

			

			 

$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 

?>

   



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
$( "#vaca_fechafin" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>