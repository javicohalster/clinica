<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$clie_id=$_POST["pVar2"];
$mnupan_id=$_POST["pVar3"];
$atenc_id=$_POST["pVar4"];
$eteneva_id=@$_POST["pVar5"];
$centro_id=$_POST["pVar7"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$areas_id=array();
//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));

$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$enlace_atencion='';
$enlace_atencion=$rs_atencion->fields["atenc_enlace"];

$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];

$rs_tabla = $DB_gogess->executec($lista_tabla,array());



//busca datos del paciente

$datos_cliente="select * from app_cliente where clie_id=".$clie_id;

$rs_dcliente = $DB_gogess->executec($datos_cliente,array());

//busca datos del paciente

//Llamando objetos



$table=$rs_tabla->fields["tab_name"];  

$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];  



if($eteneva_id)

{

$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=? and eteneva_id=?";

$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($atenc_id,@$clie_id,@$eteneva_id));

}

else

{

$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=? and centro_id=?";

$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($atenc_id,@$clie_id,$centro_id));

}

//$centro_id
///obtener doc y fecha

///obtener doc y fecha



$psic_id_valor=0;

$psic_id_valor=@$rs_sihaydata->fields[$campo_primariodata];



include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
   if($lista_tbldata[$itbl]=='gogess_sistable')
   {
    include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
   }
 } 
include(@$director."libreria/estructura/".$table.".php");

$objformulario= new  ValidacionesFormulario();

$objtableform= new templateform();

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

	$csearch=0;	



	$variableb=0;

			if($psic_id_valor==0)

				  {

					 $variableb=0;

				  }

				  else

				  {

					 $variableb=$psic_id_valor;

					 $_REQUEST["opcion_".$table]="buscar";

			         $csearch=$psic_id_valor;				 

				  }

		//echo $csearch; 

		 $comillasimple="'";

		 $botonenvio='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
			<button type="submit" class="mb-sm btn btn-primary" > GRABAR Y PLANILLAR '.utf8_encode($rs_tabla->fields["tab_title"]).'</button>
		</div>
		</div>
</div>

';	


 $botonenvio='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata">
			<button type="button" class="mb-sm btn btn-primary" onclick="enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')"  > GRABAR Y PLANILLAR </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
';

$botonenvio2='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata2">
			<button type="button" class="mb-sm btn btn-primary" onclick="enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')"  > GRABAR Y PLANILLAR </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
';



		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

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

		$template_reemplazo='templateformsweb/maestro_standar_substandar/';

		

		}

		//echo $template_reemplazo;

	

?>	

<style>

label.error{

color:red;

font-family:Verdana, Arial, Helvetica, sans-serif;

font-style:italic;

font-size:11px;

}

div.error{

display:none;

}

input{

}

input.checkbox{

border:none

}

input:focus{

border:1px dotted black;

}

input.error{

border:1px dotted red;

}



</style> 

<style type="text/css">

<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }

.espacio_css {

	font-size: 7px;

	font-family: Arial, Helvetica, sans-serif;

}

.texto_caja{

font-size: 11px; 

font-family: Verdana, Arial, Helvetica, sans-serif

}

-->

</style>


<?php
$lista_turnos="select gridtur_id from pichinchahumana_extension.dns_gridturnos inner join dns_atencion on pichinchahumana_extension.dns_gridturnos.atenc_enlace=dns_atencion.atenc_enlace where especi_id=".$rs_datosmenu->fields["especi_id"]." and gridtur_fecha='".date("Y-m-d")."' and dns_atencion.centro_id=".$centro_id." and gridtur_estado='' limit 1";
$lista_turnos="";


$rs_turnos = $DB_gogess->executec($lista_turnos,array());
if(@$rs_turnos->fields["gridtur_id"]>0)
{
	echo '<div align="right" onclick="ver_turnos()" style="cursor:pointer" ><span style="color:#FF0000; font-size:12px; font-weight:bold"><img src="images/notificacionicon.png" />Alerta!!! Tiene turnos para hoy</span></div>';
	
}
?>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 

<?php		

		echo $botonenvio;

		include("tablas_unico.php");

		echo $botonenvio2;

?>	

</form>

</div>

<?php

}			

?>
<div id="verifica_sess"></div>
<script type="text/javascript">

<!--

$( "#usua_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#lab_fechasolicitud" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#lab_fechatoma" ).datepicker({dateFormat: 'yy-mm-dd'});

function guarda_data()
{
  <?php
    $comillasimple="'";
    echo 'enviar_formulario('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}

function ver_turnos()
{
	
	abrir_standar_pop("aplicativos/documental/listados_turnos.php","TURNOS","divBody_turnos","divDialog_turnos",400,400,"<?php echo $rs_datosmenu->fields["especi_id"]; ?>","<?php echo $centro_id; ?>",0,0,0,0,0);
	
}


//  End -->

</script>
<div id="divBody_turnos"></div>