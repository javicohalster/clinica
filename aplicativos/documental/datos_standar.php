<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//saca datos de la tabla


$mnupan_id=$_POST["pVar2"];
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));

$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

$tab_id=$rs_datosmenu->fields["tab_id"];
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];



//saca datos de la tabla

//echo $_POST["pVar1"];

//Llamando objetos



$table=$rs_tabla->fields["tab_name"];  



$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);


$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

//leer con json
$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 
//include(@$director."libreria/estructura/".$table.".php");

 if ($table)

  {

  $objtableform->select_templateform(@$table,$DB_gogess);	

  }

$objformulario->sisfield_arr=$gogess_sisfield;

$objformulario->sistable_arr=$gogess_sistable;

$comillasimple="'";



//para cambiar el formato de algunos campos



$lista_camposv=explode(';',$rs_datosmenu->fields["mnupan_camposforma"]);

$campos_tipo=array();

for($i=0;$i<count($lista_camposv);$i++)

{

    $separa_campo=explode(',',$lista_camposv[$i]);

	if($separa_campo[0])

	{

	$campos_tipo[$separa_campo[0]]=$separa_campo[1];

    }

}



//para cambiar el formato de algunos campos     

	

	$em_id_val=0;	

		



	$variableb=0;

			if($_POST["pVar1"]=='undefined')

				  {

					 $variableb=0;

				  }

				  else

				  {

					 $variableb=$_POST["pVar1"];

					 $_REQUEST["opcion_".$table]="buscar";

			         $csearch=$_POST["pVar1"];				 

				  }

		 

		 $comillasimple="'";

		 $botonenvio='<br><br>
<div class="text-center">
	<button type="submit" class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" >GUARDAR '.$rs_tabla->fields["tab_title"].'</button>
</div>

';	


 $botonenvio='

<div class="text-center">
	<button type="button" class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" onclick="guarda_data()"  > GRABAR </button>
	<div id="mensaje_gsistema" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>
</div><br><br>
';

$botonenvio2='
<br><br><div class="text-center">
	<button type="button" class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" onclick="guarda_data()"  > GRABAR</button>
	<div id="mensaje_gsistema2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>
</div><br><br>
';



		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";

		@$funcionextrag=" 
		setTimeout(function () { $('#mensaje_gsistema').fadeIn(); },1);
		setTimeout(function () { $('#mensaje_gsistema2').fadeIn(); },1);
		
		$('#mensaje_gsistema').html('Registro guardado con exito...');
		$('#mensaje_gsistema2').html('Registro guardado con exito...');
		
		setTimeout(function () { $('#mensaje_gsistema').fadeOut(); }, 2000);
		setTimeout(function () { $('#mensaje_gsistema2').fadeOut(); }, 2000);

		$('#div_".$table."').html('.');

		";
		
	

		if($rs_datosmenu->fields["mnupan_templatetabla"])
		{

  		$template_reemplazo='templateformsweb/'.$rs_datosmenu->fields["mnupan_templatetabla"].'/';

		}
		else
		{
		$template_reemplazo='templateformsweb/maestro_standar_standar/';	

		}	

		//echo $template_reemplazo;

?>

<style>
label.error {

    color: red;

    font-family: Verdana, Arial, Helvetica, sans-serif;

    font-style: italic;

    font-size: 11px;

}

div.error {

    display: none;

}

input {}

input.checkbox {

    border: none
}

input:focus {

    border: 1px dotted black;

}

input.error {

    border: 1px dotted red;

}
</style>

<style type="text/css">
<!--
.titulo_suscripcion {
    font-size: 13px;
    font-family: Arial, Verdana;
    font-weight: bold;
}

.espacio_css {

    font-size: 7px;

    font-family: Arial, Helvetica, sans-serif;

}
-->

</style>

<br>



<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
                            <h3 class="text-white text-capitalize ps-3 panel-title">
                                <?php echo $rs_tabla->fields["tab_title"]; ?></h3>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="ms-3 pe-md-3 align-items-center">
                            <button type="button" class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"
                                onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_standar.php','Perfil','divBody_ext',0,'<?php echo $_POST["pVar2"]; ?>',0,0,0,0,0)"
                                style="cursor:pointer"><span
                                    class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;&nbsp;Regresar
                            </button>
                            <?php
$linkimprimir='onClick=imprimir_datos();';
echo '<button type="button" class="btn btn-outline-primary btn-sm mb-0" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;&nbsp;IMPRIMIR </button>';

?>
                            <button type="button" class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"
                                onclick="ver_formularioenpantalla('aplicativos/documental/datos_standar.php','TARIFARIO','divBody_ext',0,'<?php echo $mnupan_id; ?>',0,0,0,0,0)"
                                style="cursor:pointer"><span
                                    class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;NUEVO
                                REGISTRO</button>
                        </div><br><br>
                        <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""
                            class="form-horizontal">

                            <?php		
        echo $botonenvio;
		include("tablas.php");
        echo $botonenvio2;
?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

}

else

{

echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Su sesi&oacute;n a caducado de precione F5 para continuar...</div>';

	

}		

?>

<script type="text/javascript">
<!--
$("#usua_fechanacimiento").datepicker({
    dateFormat: 'yy-mm-dd'
});



function guarda_data() {
    <?php
    $comillasimple="'";
    echo 'enviar_formulario('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}


function imprimir_datos() {

    if ($('#<?php echo $campo_primariodata; ?>').val() > 0) {
        myWindow3 = window.open(
            'aplicativos/documental/datos_substandarprint_print.php?iddata=<?php echo $tab_id ?>&pVar2=&pVar4=&pVar5=' +
            $('#<?php echo $campo_primariodata; ?>').val() + '&pVar3=<?php echo $mnupan_id; ?>',
            'ventana_reporteunico', 'width=850,height=700,scrollbars=YES');

        myWindow3.focus();
    } else {
        alert("Por favor guarde el resgistro para imprimir");


    }


}


//  End 
-->

</script>