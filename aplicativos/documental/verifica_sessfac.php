<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44564000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
echo $_SESSION['datadarwin2679_pemision_id'];
if(@$_SESSION['datadarwin2679_pemision_id']>0)
{
echo '<input name="estapunto" type="hidden" id="estapunto" value="1" />';


}
else
{

echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"",0,0,0,0,0,0);
//  End -->
</script>
<div id="divBody_acsession"></div>
';

echo '<input name="estapunto" type="hidden" id="estapunto" value="0" />';
}
?>