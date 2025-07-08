<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$clie_id=$_POST["pVar2"];
$mnupan_id=$_POST["pVar3"];
$atenc_id=$_POST["pVar4"];

$id_llega=$_POST["pVar5"];
$tabla_llega=$_POST["pVar6"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
$titulo_btn='';
$titulo_btn='GRABAR';

$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tabsecundario_id"];
//$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tabsecundario_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());


//tabla primaria
$lista_tablaprimaria="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tablaprimaria = $DB_gogess->executec($lista_tablaprimaria,array());

//
//tabla primaria

//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente


$table=$rs_tabla->fields["tab_name"];  
$tab_id=$rs_tabla->fields["tab_id"];
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 

//busca data
$busca_sihaydata="select * from ".$table." where ".$rs_tablaprimaria->fields["tab_campoprimario"]."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array(@$_POST["pVar7"]));
$psic_id_valor=0;
$psic_id_valor=@$rs_sihaydata->fields[$campo_primariodata];
//busca data


//include(@$director."libreria/estructura/aqualis_master.php");
$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);


$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

if($id_llega>0)
			{
            $objformulario->subtabla='1';
			}

//leer con json
$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json
 if ($table)
  {
     //$objtableform->select_templateform(@$table,$DB_gogess);	
     $objtableform->select_templateform_rs(@$table,@$rs_tabla,$DB_gogess);
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

//para cambiar el formato de algunos campos
$lista_camposv=explode(';',$rs_datosmenu->fields["mnupan_camposformasecundaria"]);
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
//----------------------------------------------------------

if($csearch)
{

    $fech_fecharegistro='';
    if($table=='dns_laboratorioinforme')
	{
	   $fech_fecharegistro='labinfor_fecharegistro';	
	}
	
	 if($table=='dns_newimagenologiainfo')
	{
	   $fech_fecharegistro='imginfo_fecharegistro';
	
	}
	
	$busca_fecha="select *,DATE_ADD(".$fech_fecharegistro.",INTERVAL 3 DAY) as fechacierre from ".$table." where ".$campo_primariodata."='".$csearch."'";
	$rs_bufecha = $DB_gogess->executec($busca_fecha,array());
	
	$bloque_registro=0;
	if(@$rs_bufecha->fields["fechacierre"])
	{
	  //echo $rs_sihaydata->fields["fechacierre"];
	   if(date("Y-m-d")>$rs_bufecha->fields["fechacierre"])
	   {
	   
	   $bloque_registro=1;
	   }
	   
	}
	//echo $bloque_registro;
}
//----------------------------------------------------------			
		
		
		 $comillasimple="'";
		 $botonenvio='<br><br>

<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
		   
			<button type="submit" class="mb-sm btn btn-primary" > GRABAR </button>
		
		</div>
		</div>
</div>
';	


$botonenvio='<div class="alert alert-info" role="alert">
  <p><b>Nota importante!</b>
  Por favor no olvide guardar el registro cuando termine de ingresar datos, si no lo hace los datos se perder&aacute;n</p>
</div>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_data'.$id_llega.'()"  > '.$titulo_btn.'  </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
';

$botonenvio2='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata2">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_data'.$id_llega.'()"  > '.$titulo_btn.' </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
<div class="alert alert-info" role="alert">
  <p><b>Nota importante!</b>
  Por favor no olvide guardar el registro cuando termine de ingresar datos, si no lo hace los datos se perder&aacute;n</p>
</div>
';

if($bloque_registro==1)
{
   $botonenvio='';
   $botonenvio2='';
}

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
		
		
		if($rs_datosmenu->fields["mnupan_templatetablasec"])
		{
  		$template_reemplazo='templateformsweb/'.$rs_datosmenu->fields["mnupan_templatetablasec"].'/';
		}
		else
		{
		$template_reemplazo='templateformsweb/maestro_standar_substandar/';
		
		}
		//echo $template_reemplazo;
	
?>	

<br>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/datos_substandarformimagennew.php','Perfil','divBodylab_ext','<?php echo $_POST["pVar7"]; ?>','<?php echo @$clie_id; ?>','<?php echo $mnupan_id; ?>','<?php echo $atenc_id; ?>','<?php echo $id_llega; ?>','<?php echo $tabla_llega; ?>',0)" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar a Pedido </button>

<?php
$linkimprimir='onClick=imprimir_datosinfoimagen();';
//echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

if($table=='dns_newimagenologiainfo')
{
$linkimprimir='onClick=genera_pdfimgnew();';
echo '&nbsp;<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span></button>';
}


?>
&nbsp;&nbsp;&nbsp;<B> IMAGENOLOGIA - INFORME </B>

<?php
//cambio de fecha registro
$linkcambior="onclick=abrir_standar('aplicativos/documental/cambio_fecha.php','CAMBIO','divBody_foto','divDialog_foto',500,300,'informeimagen',$('#imginfo_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkcambior.'  style="cursor:pointer"> CAMBIAR FECHA REGISTRO </button>';

$linkhistorialr="onclick=abrir_standar('aplicativos/documental/historial_fecha.php','CAMBIO','divBody_foto','divDialog_foto',790,300,'informeimagen',$('#imginfo_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkhistorialr.'  style="cursor:pointer"> HISTORIAL CAMBIO </button>';
echo '<div id="divBody_foto"></div>';
//cambio de fecha registro
?>

<br />
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php		
		echo $botonenvio;
		include("tablas.php");
		echo $botonenvio2;
?>	
</form>
</div>
<?php
}			
?>
<script type="text/javascript">
<!--

function imprimir_datosinfoimagen()
{
	
     if($('#<?php echo $campo_primariodata; ?>').val()>0)
	 {
   myWindow3=window.open('aplicativos/documental/datos_substandarformdoble_print.php?iddata=<?php echo $tab_id ?>&pVar2=<?php echo @$clie_id; ?>&pVar4=<?php echo $atenc_id; ?>&pVar5='+$('#<?php echo $campo_primariodata; ?>').val()+'&pVar3=<?php echo $mnupan_id; ?>','ventana_reporteunico','width=850,height=700,scrollbars=YES');

   myWindow3.focus();
   }
   else
   {
      alert("Por favor guarde el resgistro para imprimir");
   
   }
    
}

function guarda_data<?php echo $id_llega; ?>()
{

  
  if($('#diagn_numval<?php echo $id_llega; ?>').val()==0)
  {
    alert("Por favor agrege al menos un DIAGNOSITCO");
    return false;
  }
  <?php
    echo $rs_tabla->fields["tab_valextguardar"];
	
    $comillasimple="'";
    echo 'enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}

<?php
if($table=='dns_newimagenologiainfo')
{
  $linkpdf="pdfnewimageninforme";
  
$campos_data='';
$campos_data64='';
//$campos_data='iddata='.$rs_datosmenu->fields["tabsecundario_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=90';
$campos_data='iddata='.$rs_datosmenu->fields["tabsecundario_id"].'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3=218';
$campos_data64=base64_encode($campos_data); 
  
}
?>

function genera_pdfimgnew()
{
  if($('#<?php echo $campo_primariodata; ?>').val()>0)
	 {
	 
	    location.href = "pdfformularios/<?php echo $linkpdf; ?>.php?ssr=<?php echo $campos_data64."|" ?>"+$('#<?php echo $campo_primariodata; ?>').val();
	 }
	 else
	 {
       alert("Por favor guarde el resgistro para imprimir"); 	 
	 
	 }

}

//  End -->
</script>