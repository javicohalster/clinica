<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
session_start();


if(@$_POST["usuario_valor_ac"])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//Conexion a la base de datos
$hoyfecha=date("Y-m-d H:i:s");
$hoyfechac=date("Y-m-d");
$obj_session_apl= new session_apl();
$obj_session_apl->seleccion_acc_apl(1,$DB_gogess);

// echo $_POST["ruc_valor"]."<br>";
//echo $_POST["usuario_valor"]."<br>";
//echo $_POST["clave_valor"]."<br>"; 
$buscausuario="select * from ".$obj_session_apl->ntabla_usuario." where ".$obj_session_apl->campo_usuario."=? and ".$obj_session_apl->campo_clave."=? and usua_estado=1";

//echo $buscausuario;
$rs_busuario = $DB_gogess->executec($buscausuario,array(@$_POST["usuario_valor_ac"],md5(@$_POST["clave_valor_ac"])));
	 if($rs_busuario)
	 {
	  while (!$rs_busuario->EOF) {
	  $idenlace=$rs_busuario->fields[$obj_session_apl->campo_campoenlace];	
	  //$nombreusuario=$rs_busuario->fields["usua_usuario"];
      $nombrecompleto=$rs_busuario->fields["usua_nombre"];
	  $nombreusuario=$nombrecompleto;
	  $cedulausuario=$rs_busuario->fields["usua_ciruc"];
      $emp_id=$rs_busuario->fields["emp_id"];
      $jobt_id=$rs_busuario->fields["jobt_id"];
	  $centro_id=$rs_busuario->fields["centro_id"];
	  
	  $estab_id=$rs_busuario->fields["estab_id"];
	  $pemision_id=$rs_busuario->fields["pemision_id"];
	  
	  $usua_adm=$rs_busuario->fields["usua_adm"];
	  $usua_subadm=$rs_busuario->fields["usua_subadm"];
	  
	  //acceso profesion	
	   $usua_especi_id= 3;
	   $busca_especi_id="select * from dns_gridfuncionprofesional grid inner join pichinchahumana_extension.dns_profesion prof on grid.prof_id=prof.prof_id where usua_enlace='".$rs_busuario->fields["usua_enlace"]."' order by grdifun_fecharegistro desc limit 1";
	   $rs_bespecialidad = $DB_gogess->executec($busca_especi_id,array());
	   if(@$rs_bespecialidad->fields["especi_id"])
	   {
	     $usua_especi_id=$rs_bespecialidad->fields["especi_id"];
	   } 
	  //acceso profesion
	  
	  
	  $rs_busuario->MoveNext();

	  }



	}  


	 if(@$idenlace)
	 {

	   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold" >Acceso permitido...</div>';
	 //Selecciona Periodo
	   $_SESSION['datadarwin2679_sessid_inicio']=$idenlace;
       $_SESSION['datadarwin2679_sessid_tabla']=$obj_session_apl->tabla_usuario;
       $_SESSION['datadarwin2679_sessid_nombreusuario']=$nombreusuario;
       $_SESSION['datadarwin2679_sessid_nombrecompleto']=$nombrecompleto;
	   $_SESSION['datadarwin2679_sessid_cedula']=$cedulausuario;
       $_SESSION['datadarwin2679_sessid_emp_id']=$emp_id;
	   $_SESSION['datadarwin2679_jobt_id']=$jobt_id;
	   $_SESSION['datadarwin2679_centro_id']=$centro_id;
      // $busca_empresa="select * from app_empresa where emp_id=?";
	  // $rs_busempresa = $DB_gogess->executec($busca_empresa,array($emp_id));

	   $_SESSION['fecha_uingreso']=date("Y-m-d H:i:s");
       $_SESSION['datadarwin2679_tipodespl']=0;

	  // $_SESSION['datadarwin2679_temp_id']=$rs_busempresa->fields["temp_id"];
	   //$_SESSION['tipo_ing']=$_POST["tipo_ing"];
	   
	  //establecimiento
	   
	   $_SESSION['datadarwin2679_pemision_id']=$pemision_id;
	   $_SESSION['datadarwin2679_pestab_id']=$estab_id;
	   $_SESSION['datadarwin2679_usua_adm']=$usua_adm;
	   $_SESSION['datadarwin2679_usua_subadm']=$usua_subadm;
	   $_SESSION['datadarwin2679_usua_especi_id']=$usua_especi_id;
	    
      $fechahoy=date("Y-m-d H:i:s");
      $horahoy=date("H:i:s");

//ultimo acceso
	  $actualiza="update ".$obj_session_apl->ntabla_usuario." set usua_fecha_uingreso=?,usua_hora_uingreso=? where usua_id=?";
	  $rs_ok = $DB_gogess->executec($actualiza,array($fechahoy,$horahoy,$_SESSION['datadarwin2679_sessid_inicio']));   

//ultimo acceso

// Guarda ingreso al sistema
	$insertahistorial="insert into app_historicoing (hiing_fecha,hiing_cedula,hiing_ip) values ('".$fechahoy."','".$_SESSION['datadarwin2679_sessid_cedula']."','".$_SERVER['REMOTE_ADDR']."')";
    $ac_oking = $DB_gogess->executec($insertahistorial,array());
// Guarda ingreso al sistema   
$var_datafuncion='';
$var_datafuncion=base64_decode($_POST["funciones_siguientes"]);

	   echo '.<script type="text/javascript">
		   <!--
		   $("#acceso_usuario1_ac").html("<div style=color:#000000; >Acceso permitido...</div>");
		   $("#divBody_ingreso_ac").html("<div style=color:#000000; >Tu sesi&oacute;n se a activado continue en el sistema.</div>");
		   '.$var_datafuncion.'
		   
		   //  End -->
       </script>.
	   ';
	 }
	 else
	 {

	     echo '<script type="text/javascript">
		   <!--

			$("#acceso_usuario1_ac").html("<div style=color:#FF0000; >Acceso negado...Usuario o clave incorrecta...</div>");

		   //  End -->

       </script>
	   ';

	 }

	} 


?>