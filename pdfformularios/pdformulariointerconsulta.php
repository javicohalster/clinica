<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='ssr')
	{
	///
	     $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$decodifica='';
$separa_campos=explode("|",$_GET["ssr"]);
$decodifica=base64_decode($separa_campos[0]);

$splitvar=explode("&",@$decodifica);
$nombreget='';

for($ivari=0;$ivari<count($splitvar);$ivari++)
{
  $sacadatav=explode("=",$splitvar[$ivari]);  
  $nombreget=$sacadatav[0];
  @$$nombreget=$sacadatav[1];
}

$clie_id=$pVar2;
$mnupan_id=$pVar3;
$atenc_id=$pVar4;
$eteneva_id=$pVar5;
$valor_id=$separa_campos[1];

 $director='../';
 include("../cfg/clases.php");
 include("../cfg/declaracion.php");
 
 if($table)
 {
 $lista_tbldata=array('gogess_sisfield','gogess_sistable');
 $contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
 $gogess_sistable = json_decode($contenido, true);
 }
 
 $objformulario= new  ValidacionesFormulario();
 $objtableform= new templateform();
 
 //leer con json
 if($table)
 {
 $contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
 $gogess_sisfield = json_decode($contenido, true);
 }
 //leer con json 
 

 if($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);
  }

  $objformulario->sisfield_arr=$gogess_sisfield;
  $objformulario->sistable_arr=$gogess_sistable;
  $comillasimple="'";
  
  
  //========================================================================
  
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());

$nombre_paciente=$rs_dcliente->fields["clie_nombre"];
$apellido_paciente=$rs_dcliente->fields["clie_apellido"];
$clie_genero=$rs_dcliente->fields["clie_genero"];
$hc=$rs_dcliente->fields["clie_rucci"];
$civil_id=$rs_dcliente->fields["civil_id"];
$clie_instruccion=$rs_dcliente->fields["clie_instruccion"];
$clie_dondetrabaja=$rs_dcliente->fields["clie_dondetrabaja"];
$tipopac_id=$rs_dcliente->fields["tipopac_id"];
 	

$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));

$intercon_normal=$rs_sihaydata->fields["intercon_normal"];
$intercon_urgente=$rs_sihaydata->fields["intercon_urgente"];
$intercon_fecharegistro=$rs_sihaydata->fields["intercon_fecharegistro"];

$saca_hora=array();
$saca_hora=explode(" ",$intercon_fecharegistro);

$nomb_centro='';
$nomb_medico='';
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);
$usua_msp=$objformulario->replace_cmb("app_usuario","usua_id,usua_msp","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);



$intercon_enlace =$rs_sihaydata->fields["intercon_enlace"];
  //=========================================================================
  
  
  $url="plantillas/form007anversointerconsultasolicitud.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);  
  $lee_plantilla=str_replace("-codigo-",$usua_msp,$lee_plantilla);
  
  $centro_codigo=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
  
  $prob_codigo=$objformulario->replace_cmb("dns_centrosalud","centro_id,prob_codigo","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);  
  $cant_codigo=$objformulario->replace_cmb("dns_centrosalud","centro_id,cant_codigo","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
  $centro_parroquia=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_parroquia","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
  
  
  
  $provinciav=$objformulario->replace_cmb("app_provincia","prob_codigo,prob_nombre","where prob_codigo like ",$prob_codigo,$DB_gogess);
  $cantonv=$objformulario->replace_cmb("app_canton","cant_codigo,cant_nombre","where cant_codigo like ",$cant_codigo,$DB_gogess);
	
  
  $lee_plantilla=str_replace("-ccodigo-",str_replace(utf8_encode('UNI-C�DIGO'),'',$centro_codigo),$lee_plantilla);
  $lee_plantilla=str_replace("-canton-",$cantonv,$lee_plantilla);
  $lee_plantilla=str_replace("-provincia-",$provinciav,$lee_plantilla);
  $lee_plantilla=str_replace("-parroquia-",$centro_parroquia,$lee_plantilla);
  
  if($clie_genero=='M')
  {
  $lee_plantilla=str_replace("-g1-","X",$lee_plantilla);
  $lee_plantilla=str_replace("-g2-","",$lee_plantilla);
  }
  else
  {
  $lee_plantilla=str_replace("-g1-","",$lee_plantilla);
  $lee_plantilla=str_replace("-g2-","X",$lee_plantilla);
  }
  
  
  
  switch ($civil_id) {
    case 1:
        {
		  $lee_plantilla=str_replace("-s-","X",$lee_plantilla);
		  $lee_plantilla=str_replace("-c-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-d-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-v-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-ul-","",$lee_plantilla);
		}
        break;
    case 2:
         {
		  $lee_plantilla=str_replace("-s-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-c-","X",$lee_plantilla);
		  $lee_plantilla=str_replace("-d-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-v-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-ul-","",$lee_plantilla);
		}
        break;
    case 3:
        {
		  $lee_plantilla=str_replace("-s-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-c-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-d-","X",$lee_plantilla);
		  $lee_plantilla=str_replace("-v-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-ul-","",$lee_plantilla);
		}
        break;
	 case 4:
        {
		  $lee_plantilla=str_replace("-s-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-c-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-d-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-v-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-ul-","X",$lee_plantilla);
		}
        break;
	  case 5:
        {
		  $lee_plantilla=str_replace("-s-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-c-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-d-","X",$lee_plantilla);
		  $lee_plantilla=str_replace("-v-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-ul-","",$lee_plantilla);
		}
        break;	
	    case 6:
        {
			  $lee_plantilla=str_replace("-s-","",$lee_plantilla);
			  $lee_plantilla=str_replace("-c-","",$lee_plantilla);
			  $lee_plantilla=str_replace("-d-","",$lee_plantilla);
			  $lee_plantilla=str_replace("-v-","X",$lee_plantilla);
			  $lee_plantilla=str_replace("-ul-","",$lee_plantilla);
		}
        break;		
  }

          $lee_plantilla=str_replace("-s-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-c-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-d-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-v-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-ul-","",$lee_plantilla);


switch ($clie_instruccion) {
    case 1:
        {		  
		  $lee_plantilla=str_replace("-sin-","X",$lee_plantilla);
		  $lee_plantilla=str_replace("-bas-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bach-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-sup-","",$lee_plantilla);
          $lee_plantilla=str_replace("-esp-","",$lee_plantilla);		  
		}
        break;
    case 2:
        {		  
		  $lee_plantilla=str_replace("-sin-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bas-","X",$lee_plantilla);
		  $lee_plantilla=str_replace("-bach-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-sup-","",$lee_plantilla);
          $lee_plantilla=str_replace("-esp-","",$lee_plantilla);		  
		}
        break;
    case 3:
         {		  
		  $lee_plantilla=str_replace("-sin-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bas-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bach-","X",$lee_plantilla);
		  $lee_plantilla=str_replace("-sup-","",$lee_plantilla);
          $lee_plantilla=str_replace("-esp-","",$lee_plantilla);		  
		}
        break;
	 case 4:
         {		  
		  $lee_plantilla=str_replace("-sin-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bas-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bach-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-sup-","X",$lee_plantilla);
          $lee_plantilla=str_replace("-esp-","",$lee_plantilla);		  
		}
        break;	
	  case 5:
         {		  
		  $lee_plantilla=str_replace("-sin-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bas-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bach-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-sup-","",$lee_plantilla);
          $lee_plantilla=str_replace("-esp-","X",$lee_plantilla);		  
		}
        break;		

}

          $lee_plantilla=str_replace("-sin-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bas-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-bach-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-sup-","",$lee_plantilla);
          $lee_plantilla=str_replace("-esp-","",$lee_plantilla);
		  
		  $lee_plantilla=str_replace("-clie_dondetrabaja-",$clie_dondetrabaja,$lee_plantilla);
		  
		  
		  

		  
		  if($intercon_normal)
		  {
		  $lee_plantilla=str_replace("-m1-","X",$lee_plantilla);
		  $lee_plantilla=str_replace("-m2-","",$lee_plantilla);
		  }
		  if($intercon_urgente)
		  {
		  $lee_plantilla=str_replace("-m1-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-m2-","X",$lee_plantilla);		  
		  }
		  
		  $lee_plantilla=str_replace("-m1-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-m2-","",$lee_plantilla);
		  
		  
		  
		  $lee_plantilla=str_replace("-hora-",$saca_hora[1],$lee_plantilla);
		  
		  $n_seguro='';
		  $n_seguro=$objformulario->replace_cmb("faesa_tipopaciente","tipopac_id,tipopac_nombre","where tipopac_id =",$tipopac_id,$DB_gogess);
		  
          $lee_plantilla=str_replace("-tipopac_id-",$n_seguro,$lee_plantilla);

  ///lee campos 

$lista_standar='intercon_fecharegistro,intercon_planeducacional,intercon_planterapeutico,intercon_pruebasdiagnosticas,intercon_clinicoactual,intercon_estadestino,intercon_servconsultado,intercon_servsolicita,intercon_medicointerconsulta';
$lista_standararray=array();
$lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
 //$lab_marca=genera_x($lab_marca);
 $lab_marca=str_replace(PHP_EOL, '<br>', $lab_marca);
 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
  } 
  
  ///lee campos
  
   ///edad actual
 
 	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["intercon_fecharegistro"]);
	$lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
 
 //edad actual
 
 
  
  
  // salto linea planes de tratamiento
 $lista_standar='anam_emferpactual,anam_planes';
$lista_standararray=array();
$lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
 //$lab_marca=genera_x($lab_marca);
 $lab_marca=str_replace(PHP_EOL, '<br>', $lab_marca);
 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
  }
 
 // fin salto linea
 
 
  
  
  //antecedentes personales
  $datos_ap='';
  $antecedentes_personales="select * from pichinchahumana_extension.dns_antecedentespersonales a inner join pichinchahumana_combos.dns_opcionantecedentes b on a.opcioante_id=b.opcioante_id where clie_id='".$clie_id."'";
  $rs_ap = $DB_gogess->executec($antecedentes_personales,array());
  if($rs_ap)
	{
		while (!$rs_ap->EOF) {
		
		  $datos_ap.=$rs_ap->fields["opcioante_id"]." ".$rs_ap->fields["antep_descripcion"].", ";
		
		  $rs_ap->MoveNext();
		}
	}	



 
  if($anam_biopsia==1)
  {     
	 $datos_ap.=", Biopsia:".$anam_biopsiatext; 
	 $anam_biopsia='SI'; 
  }
  else
  {
     $anam_biopsia='';
  }
  
  if($anam_metodopfamiliar==1)
  {     
	 $datos_ap.=", Metodo P.Familiar:".$anam_metodopfamiliartex; 
	 $anam_metodopfamiliar='SI'; 
  } 
  else
  {
     $anam_metodopfamiliar=''; 
  } 

  if($anam_terapiahormonal==1)
  {     
	 $datos_ap.=", Terapia hormonal:".$anam_terapiahormonaltext; 
	 $anam_terapiahormonal='SI'; 
  }  
  else
  {
    $anam_terapiahormonal='';
  }
  
  if($anam_colposcopia==1)
  {     
	 $datos_ap.=", Colposcopia:".$anam_colposcopiatext; 
	 $anam_colposcopia='SI'; 
  } 
  else
  {
     $anam_colposcopia='';   
  }
 

  if($anam_mamografia==1)
  {     
	 $datos_ap.=", Mamograf&iacute;a:".$anam_mamografiatxt; 
	 $anam_mamografia='SI'; 
  } 
  else
  {
     $anam_mamografia='';   
  }
  
  
  $datos_ap.=" ".$rs_sihaydata->fields["anam_observacionap"];
  //antecedentes personales
  
  
  //antecedentes familiares
  $datos_af='';
  $antecedentes_familiares="select * from pichinchahumana_extension.dns_antecedentesfamiliares a inner join pichinchahumana_combos.dns_tipofamiliar b on a.tipfam_id=b.tipfam_id where clie_id='".$clie_id."'";
  $rs_af = $DB_gogess->executec($antecedentes_familiares,array());
  if($rs_af)
	{
		while (!$rs_af->EOF) {
		
		  $datos_af.=$rs_af->fields["tipfam_id"]." ".$rs_af->fields["antef_descripcion"].", ";
		  
		  $lee_plantilla=str_replace("-af".$rs_af->fields["tipfam_id"]."-",'X',$lee_plantilla); 
		
		  $rs_af->MoveNext();
		}
	}	

  $lee_plantilla=str_replace("-af1-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af2-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af3-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af4-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af5-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af6-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af7-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af8-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af9-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af10-",'',$lee_plantilla); 
  	
  //antecedentes familiares
  
  $datos_af.=" ".$rs_sihaydata->fields["anam_observacionaf"];
  
  //Revicion actual de organos  
  $datos_ro='';
  $rebicion_organos="select * from pichinchahumana_extension.dns_traumatologiagridorgano a inner join pichinchahumana_combos.dns_opcionorgano b on a.opcorg_id=b.opcorg_id where tiporg_nombre='CP' and anam_enlace='".$anam_enlace."'";
  $rs_ro = $DB_gogess->executec($rebicion_organos,array());
  if($rs_ro)
	{
		while (!$rs_ro->EOF) {
		
		  $datos_ro.=$rs_ro->fields["opcorg_id"]." ".$rs_ro->fields["gorgano_observacion"].", ";		  
		  $lee_plantilla=str_replace("-rocp".$rs_ro->fields["opcorg_id"]."-",'X',$lee_plantilla); 
		  $lee_plantilla=str_replace("-rosp".$rs_ro->fields["opcorg_id"]."-",'',$lee_plantilla);
		
		  $rs_ro->MoveNext();
		}
	}	
  
  $rebicion_organossp="select * from pichinchahumana_combos.dns_opcionorgano";
  $rs_rosp = $DB_gogess->executec($rebicion_organossp,array());
  if($rs_rosp)
	{
		while (!$rs_rosp->EOF) {
			  
		  $lee_plantilla=str_replace("-rocp".$rs_rosp->fields["opcorg_id"]."-",'',$lee_plantilla); 
		  $lee_plantilla=str_replace("-rosp".$rs_rosp->fields["opcorg_id"]."-",'X',$lee_plantilla);
		
		  $rs_rosp->MoveNext();
		}
	}	
  
  //$lee_plantilla=str_replace("-rocp".$rs_ro->fields["opcorg_id"]."-",'X',$lee_plantilla); 
  
  $lee_plantilla=str_replace("-ro-",$datos_ro,$lee_plantilla);
  //Revicion actual de organos
  
  $lee_plantilla=str_replace("-ap-",$datos_ap,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_menarquiaedad-",$anam_menarquiaedad,$lee_plantilla); 
  $lee_plantilla=str_replace("-anam_menopausiaedad-",$anam_menopausiaedad,$lee_plantilla);  
  $lee_plantilla=str_replace("-anam_ciclos-",$anam_ciclos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_vidasexualactiva-",$anam_vidasexualactiva,$lee_plantilla);
  
if($clie_genero=='F')
{
//================================================== 
  $lee_plantilla=str_replace("-anam_gesta-",$anam_gesta,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_partos-",$anam_partos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_abortos-",$anam_abortos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_cesareas-",$anam_cesareas,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fum-",$anam_fum,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fup-",$anam_fup,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fuc-",$anam_fuc,$lee_plantilla);
//==================================================
}
else
{
//================================================== 
  $lee_plantilla=str_replace("-anam_gesta-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_partos-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_abortos-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_cesareas-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fum-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fup-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fuc-",'',$lee_plantilla);
//==================================================
}
  
  
  $lee_plantilla=str_replace("-anam_hijosvivos-",$anam_hijosvivos,$lee_plantilla);

  $lee_plantilla=str_replace("-anam_biopsia-",$anam_biopsia,$lee_plantilla);
  
  $lee_plantilla=str_replace("-anam_metodopfamiliar-",$anam_metodopfamiliar,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_terapiahormonal-",$anam_terapiahormonal,$lee_plantilla);
  
  $lee_plantilla=str_replace("-anam_colposcopia-",$anam_colposcopia,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_mamografia-",$anam_mamografia,$lee_plantilla);

  $lee_plantilla=str_replace("-af-",$datos_af,$lee_plantilla);
  
  $lee_plantilla=str_replace("-anam_emferpactual-",$anam_emferpactual,$lee_plantilla);
  
  
  //signos vitales 
  $odonto_fecharegistro=$rs_sihaydata->fields["anam_fecharegistro"]; 
  $solo_fechareg=array();
  $solo_fechareg=explode(" ",$odonto_fecharegistro);

  $sig_vitales="select * from dns_signosvitales where atenc_enlace='".$rs_atencion->fields["atenc_enlace"]."' and DATE_FORMAT(signovita_fecharegistro, '%Y-%m-%d')='".$solo_fechareg[0]."' order by signovita_fecharegistro desc limit 1";
  
  $rs_svitales = $DB_gogess->executec($sig_vitales,array());
  if($rs_svitales)
	{
		while (!$rs_svitales->EOF) {
			  
		  $lee_plantilla=str_replace("-signovita_presionarterial-",$rs_svitales->fields["signovita_presionarterial"],$lee_plantilla); 
		  $lee_plantilla=str_replace("-signovita_frecuenciacardiaca-",$rs_svitales->fields["signovita_frecuenciacardiaca"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_frecuenciarespiratoria-",$rs_svitales->fields["signovita_frecuenciarespiratoria"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_temperaturabucal-",$rs_svitales->fields["signovita_temperaturabucal"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_peso-",$rs_svitales->fields["signovita_peso"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_talla-",$rs_svitales->fields["signovita_talla"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_perimetrocefalico-",$rs_svitales->fields["signovita_perimetrocefalico"],$lee_plantilla);
		
		  $rs_svitales->MoveNext();
		}
	}
  
  $lee_plantilla=str_replace("-signovita_presionarterial-","",$lee_plantilla); 
  $lee_plantilla=str_replace("-signovita_frecuenciacardiaca-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_frecuenciarespiratoria-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_temperaturabucal-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_peso-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_talla-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_perimetrocefalico-","",$lee_plantilla);
  //signos vitales
  
 //examen fisco regional  
   
 $datos_freg='';
 $fisco_regional="select * from pichinchahumana_extension.dns_traumatologiagridexamenfisico a inner join pichinchahumana_combos.dns_opcionexamenfisico b on a.opcexa_id=b.opcexa_id where tiporg_nombre='CP' and anam_enlace='".$anam_enlace."'";
  $rs_freg = $DB_gogess->executec($fisco_regional,array());
  if($rs_freg)
	{
		while (!$rs_freg->EOF) {
		
		  $datos_freg.=$rs_freg->fields["opcexa_orden"]." ".$rs_freg->fields["opcexa_tipo"]." ".$rs_freg->fields["gexamfis_observacion"].", ";		  
		  $lee_plantilla=str_replace("-".$rs_freg->fields["opcexa_orden"].strtolower($rs_freg->fields["opcexa_tipo"])."cp-",'X',$lee_plantilla); 
		  $lee_plantilla=str_replace("-".$rs_freg->fields["opcexa_orden"].strtolower($rs_freg->fields["opcexa_tipo"])."sp-",'',$lee_plantilla); 
		
		  $rs_freg->MoveNext();
		}
	}	
	

  $fisicoreg_fr="select * from pichinchahumana_combos.dns_opcionexamenfisico";
  $rs_fregv = $DB_gogess->executec($fisicoreg_fr,array());
  if($rs_fregv)
	{
		while (!$rs_fregv->EOF) {
			  
		  $lee_plantilla=str_replace("-".$rs_fregv->fields["opcexa_orden"].strtolower($rs_fregv->fields["opcexa_tipo"])."cp-",'',$lee_plantilla); 
		  $lee_plantilla=str_replace("-".$rs_fregv->fields["opcexa_orden"].strtolower($rs_fregv->fields["opcexa_tipo"])."sp-",'X',$lee_plantilla);
		
		  $rs_fregv->MoveNext();
		}
	}		
  
  $lee_plantilla=str_replace("-freg-",$datos_freg,$lee_plantilla);
 //examen fisico regional
 
 //diagnosticos
   $datos_diagnostico='';
   $cuentase=0;
   //$diagosticos_rv="select * from pichinchahumana_extension.dns_traumatologiadiagnosticoanamnesis where anam_enlace='".$anam_enlace."' limit 6";
   $diagosticos_rv="select * from dns_diagnosticointerconsulta where intercon_enlace ='".$intercon_enlace."' limit 6";
   $rs_dgnostico = $DB_gogess->executec($diagosticos_rv,array());
   if($rs_dgnostico)
	{
		while (!$rs_dgnostico->EOF) {
	
		   $cuentase++;
		   
		   $lee_plantilla=str_replace("-diagnostico".$cuentase."-",utf8_decode($rs_dgnostico->fields["diagn_descripcion"]),$lee_plantilla);
		   $lee_plantilla=str_replace("-cie".$cuentase."-",$rs_dgnostico->fields["diagn_cie"],$lee_plantilla);
		   
		   
		   if($rs_dgnostico->fields["diagn_tipo"]=='PRESUNTIVO')
		   {
		   
		   $lee_plantilla=str_replace("-pre".$cuentase."-","X",$lee_plantilla);
		   $lee_plantilla=str_replace("-def".$cuentase."-","",$lee_plantilla);
		   
		   }
		   
		   if($rs_dgnostico->fields["diagn_tipo"]=='DEFINITIVO')
		   {
		   
		   $lee_plantilla=str_replace("-pre".$cuentase."-","",$lee_plantilla);
		   $lee_plantilla=str_replace("-def".$cuentase."-","X",$lee_plantilla);
		   
		   }
		   
		   
		
		  $rs_dgnostico->MoveNext();
		}
	}	
	
 for($iv=1;$iv<=6;$iv++)
 {
    $lee_plantilla=str_replace("-diagnostico".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-cie".$iv."-","",$lee_plantilla);
    $lee_plantilla=str_replace("-pre".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-def".$iv."-","",$lee_plantilla);
 
 }	
 //diagnosticos
 
 
 $lee_plantilla=str_replace("-anam_planes-",$anam_planes,$lee_plantilla);
 
 $separa_fecha_hora=explode(" ",$anam_fecharegistro);
 
 $lee_plantilla=str_replace("-anam_fecharegistro-",$separa_fecha_hora[0],$lee_plantilla);
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla);
 
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
  



$comprobantepdf=$lee_plantilla;
  
$xml="Imp";
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'portrait');
$dompdf->load_html($comprobantepdf, 'UTF-8');
$dompdf->render();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();

    ////$canvas->line(10,730,800,730,array(0,0,0),1);
//$canvas->page_text(530, 833, "", $font, 10, array(0,0,0));

$canvas->close_object();
$canvas->add_object($footer, "all");

$dompdf->stream($xml."_".$hc."_".$separa_fecha_hora[0].".pdf");


}
?>