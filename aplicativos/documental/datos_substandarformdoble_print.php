<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44455000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['datadarwin2679_sessid_inicio'])
{

$clie_id=$_GET["pVar2"];
$mnupan_id=$_GET["pVar3"];
$atenc_id=$_GET["pVar4"];
$lab_id=@$_GET["pVar5"];
$tab_id=$_GET["iddata"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));


//$lista_tabla="select * from gogess_sistable where tab_id=".$tab_id;
$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$tab_id;
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente
//saca datos de la tabla
//echo $_POST["pVar1"];
//Llamando objetos
$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];  


$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=? and ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($atenc_id,@$clie_id,$lab_id));

$nomb_centro='';
$nomb_medico='';
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);

	

$psic_id_valor=0;
$psic_id_valor=@$rs_sihaydata->fields[$campo_primariodata];

$lista_tbldata=array('gogess_sisfield','gogess_sistable');
//include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
if($lista_tbldata[$itbl]=='gogess_sistable')
   {
       $contenido = file_get_contents(@$director."jason_files/estructura/".$lista_tbldata[$itbl].".json");
       $gogess_sistable = json_decode($contenido, true);
	   //include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
   } 
 } 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

//leer con json
$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json
//include(@$director."libreria/estructura/".$table.".php");

 if ($table)
  {

    //$objtableform->select_templateform(@$table,$DB_gogess);	
    $objtableform->select_templateform_rs(@$table,@$rs_tabla,$DB_gogess);

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
	
		//$template_reemplazo='templateformsweb_print/maestro_standar_print/';
		
		//if($rs_datosmenu->fields["mnupan_templatetabla"])
		//{
  		//$template_reemplazo='templateformsweb_print/'.$rs_datosmenu->fields["mnupan_templatetabla"].'_print/';
		//}
		//else
		//{
		$template_reemplazo='templateformsweb_print/maestro_standar_standar_print/';
		//}
		
		

?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reporte</title>

<link type="text/css" href="../../templates/page/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script src="../../templates/page/menu/js/1.11.2.jquery.min.js"></script>
<script type="text/javascript" src="../../templates/page/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="../../templates/page/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../templates/page/js/jquery.form.js"></script>
<style type="text/css">
<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.css_titulo{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.css_texto{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;

}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

-->

</style>

<style type="text/css">
<!--

.txt_titulo {

	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	border: 1px solid #666666;			
 }

.txt_txt {

	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #666666;			
 }

.Estilo1 {font-size: 10px}
-->
</style>



</head>

<body>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<?php
$imagenencabezado="select * from app_empresa where emp_id='".$_SESSION['datadarwin2679_sessid_emp_id']."'";
$rs_imagen = $DB_gogess->executec($imagenencabezado,array());
//echo $rs_imagen->fields["emp_logo"];

?>	
  <div align="center"><img src="../../archivo/<?php echo $rs_imagen->fields["emp_logo"]; ?>" width="120"  />
  </div>
  <div align="center" >
  <?php
  $nciudad='';
  $nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['datadarwin2679_centro_id'],$DB_gogess);
  echo $nciudad.", ";
  echo $objvarios->fechaCastellano(date("Y-m-d"));
   ?>
  </div>
  <br />
  <center> 
  <B> <?php echo $rs_tabla->fields["tab_title"]; ?> </B> </center><br /><br />
<?php		
		include("tablas_unicoprint.php");
?>	
</div>
<?php

}			

?>
</body>
</html>

