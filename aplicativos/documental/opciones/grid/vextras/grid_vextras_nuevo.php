<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar3"]));
$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//busca datos del paciente

$datos_cliente="select * from app_usuario where usua_id=".$_POST["pVar2"];
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//----busca atenion cerrada

//---busca atencion cerrada


$table=$rs_tabla->fields["tab_name"]; 
//leer con json
$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);
$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 

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
$campo_cmb1='';

if(@$_SESSION['datadarwin2679_sessid_inicio']=='74')
{

 $campo_cmb1='';   


}



$lista_camposv=explode(';',$rs_datosmenu->fields["mnupan_camposforma"].$campo_cmb1);

$campos_tipo=array();

for($i=0;$i<count($lista_camposv);$i++)
{
    $separa_campo=explode(',',$lista_camposv[$i]);
	if($separa_campo[0])
	{
	$campos_tipo[$separa_campo[0]]=$separa_campo[1];
    }
}

//print_r($campos_tipo);
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

		//echo $csearch; 
		 $comillasimple="'";
		 $botonenvio='
<div align="center">

		 <div class="form-group">

         <div class="col-xs-12">

			<button type="submit" class="mb-sm btn btn-primary" >Guardar Registro</button>

		</div>

		</div>

</div>
';	


		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";
		@$funcionextrag="  desplegar_grid_vextras();
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

<br>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<p></p>
<div class="alert alert-success"> <B> <?php //echo utf8_encode($rs_tabla->fields["tab_title"]); ?></B>
<div class="row">


</div>


</div>



<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 

<?php		

		include("../../../tablas.php");

?>	

</form>

</div>

<?php



}	

else

{

echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado</div>';

//enviar

//$varable_enviafunc=base64_encode("desplegar_grid_atencion();");

$varable_enviafunc='';

//enviar

echo '

<script type="text/javascript">

<!--

abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);

//  End -->

</script>



<div id="divBody_acsession"></div>

';



}		

?>



<script type="text/javascript">
<!--
$( "#atenc_fecha" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>
<?php
//echo numero_secuencialhc('1711467884','atenc_hc','dns_atencion',$DB_gogess);
?>