<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['datadarwin2679_sessid_inicio'])
{

	//--------------------------------------
	echo $_SESSION['datadarwin2679_pemision_id'];
	if(@$_SESSION['datadarwin2679_pemision_id']>0)
	{
	   include("lq.php");
	}
	else
	{
	  include("lqestablecimiento.php");
	}	
	//----------------------------------------

}			
else
{

	$varable_enviafunc=base64_encode("ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_lq.php','Perfil','divBody_ext','','34',0,0,0,0,0)");
		
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