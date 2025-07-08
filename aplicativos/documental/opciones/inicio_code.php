<?php

if($_SESSION['datadarwin2679_sessid_inicio'])
{
	 //--------------------------------------
//$objcontenido_apl=new contenido_apl();	 

//$objcontenido_apl->despliega_menuapl_rapido(@$idvalor_opcion,$apl,$DB_gogess);


 }



if(!(@$variables_ext["tiporeg"]))
{

$variables_ext["tiporeg"]=1;

}


if($variables_ext["tiporeg"]==1)
{

include("aplicativos/documental/opciones/panel_clientes.php");

}
else
{
include("aplicativos/documental/opciones/panel_experto.php");

}
?>