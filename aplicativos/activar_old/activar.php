<style type="text/css">
<!--
.activa_css1 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	font-style: italic;
	color: #006600;
}
.activa_css2 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-style: italic;
	color: #003366;
	font-weight: bold;
}
.activa_css3 {
	font-family: Arial, Helvetica, sans-serif;
	color: #003366;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<?php

$selecTabla="select * from  media_usuario where usua_id=? and usua_code='?' and  usua_estado='0'";    
$rs_aplopciones = $DB_gogess->executec($selecTabla,array(@$variables_ext["idactv"],@$variables_ext["cj"]));
$usua_ide=$rs_aplopciones->fields["usua_id"];

			
	if ($usua_ide)
	{
			  $sqlc="update media_usuario set usua_estado='1' where usua_id=?";
			  $resultadoac = $DB_gogess->executec($sqlc,array($usua_ide));
			
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><p align="center" class="activa_css1">&nbsp;</p>
      <p align="center" class="activa_css1">&nbsp;</p>
      <p align="center" class="activa_css2">SU CUENTA ESTA ACTIVA.</p>
      <p align="center" class="activa_css3">Bienvenido</p>
    <p align="center" class="activa_css3">INGRESE CON SU CUENTA Y CLAVE AL SISTEMA.</p>
    <p align="center" class="activa_css1">&nbsp;</p>
    <p align="center" class="activa_css1"><a href="index.php"><img src="images/irhome.png"  border="0" /></a></p>
    <p align="center" class="activa_css1">&nbsp;</p></td>
  </tr>
</table>

<?php
}
else
{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><p align="center" class="activa_css1">&nbsp;</p>
        <p align="center" class="activa_css3">CODIGO DE ACTIVACION YA EXPIRO..</p>
        <p align="center" class="activa_css1">&nbsp;</p>
      <p align="center" class="activa_css1">&nbsp;</p>
	  <p align="center" class="activa_css1"><a href="index.php"><img src="images/irhome.png"  border="0" /></a></p>
    </td>
  </tr>
</table>
<?php
}
?>
