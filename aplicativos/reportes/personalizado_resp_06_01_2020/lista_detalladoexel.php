<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."rep_".$fechahoy.".xls");
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$ireport=$_GET["ireport"];
$director="../../../adm_ministry/";
include ("../../../adm_ministry/cfgclases/clases.php");
?>
<style type="text/css">
<!--
.style5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.style8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<table border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#E8F3F4"><span class="style5">No.</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Foto</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Fecha registro</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Nombre</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Apellido</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Genero</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Edad</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Estado Civil </span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Direcci&oacute;n</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Celular</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Tel&eacute;fono fijo </span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Email</span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Horario contacto </span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Como te enteraste? </span></td>
    <td bgcolor="#E8F3F4"><span class="style5">Detalle</span></td>
    
  </tr>
  <?php
  $contador=0;
$listacampos1="select distinct app_cliente.clie_id,clie_registro,clie_nombre,clie_apellido,clie_genero,clie_estadocivil,clie_direccion,clie_celular,clie_telefono,clie_email,clie_horariocontacto,clie_comoteenteraste,clie_megustaria,clie_foto from app_cliente inner join app_asistencia on app_cliente.clie_id=app_asistencia.clie_id order by clie_registro desc";
 $rs_gogessform = $DB_gogess->Execute($listacampos1);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		$desplegar=1;
		//reglas
		if($desplegar==1)
		{
		$contador++;
  ?>
  <tr>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo $contador; ?></span></td>
    <?php
	if($rs_gogessform->fields["clie_foto"])
	{
	?>
    <td bgcolor="#E8F3F4"><span class="style8"></span></td>
    <?php
	}
	else
	{
	?>
    <td bgcolor="#E8F3F4"><span class="style8"></span></td>
    <?php
	}
	?>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo $rs_gogessform->fields["clie_registro"]; ?></span></td>
    <td bgcolor="#E8F3F4" ><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_nombre"]); ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_apellido"]); ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo $rs_gogessform->fields["clie_genero"]; ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php //echo $rs_gogessform->fields["clie_id"]; ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo $rs_gogessform->fields["clie_estadocivil"]; ?></span></td>
	 <td bgcolor="#E8F3F4"><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_direccion"]); ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo $rs_gogessform->fields["clie_celular"]; ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo $rs_gogessform->fields["clie_telefono"]; ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo $rs_gogessform->fields["clie_email"]; ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_horariocontacto"]); ?></span></td>
    <td bgcolor="#E8F3F4"><span class="style8"><?php echo utf8_encode($rs_gogessform->fields["clie_comoteenteraste"]); ?></span></td>
    <td >
      <span class="style8">
      
      <?php
	  $lista_eventos_asis="select app_asistencia.even_id,even_nombre,count(app_asistencia.even_id) as total from app_asistencia inner join app_eventos on app_asistencia.even_id=app_eventos.even_id where app_asistencia.clie_id=".$rs_gogessform->fields["clie_id"]." group by app_asistencia.even_id" ;
	  ?>
      
        
      </span>
    
      <table width="300" border="0" cellpadding="1" cellspacing="1">
        <tr class="style5">
          <td width="186" bgcolor="#E8F3F4">Evento </td>
          <td width="98" bgcolor="#E8F3F4">Total asistencia</td>
        </tr>
        <?php
		 $rs_gogessformas = $DB_gogess->Execute($lista_eventos_asis);
		 if($rs_gogessformas)
		 {
     	    while (!$rs_gogessformas->EOF) {
		?>
        <tr class="style8">
          <td bgcolor="#E8F3F4"><?php echo utf8_encode($rs_gogessformas->fields["even_nombre"]); ?></td>
          <td bgcolor="#E8F3F4"><?php echo $rs_gogessformas->fields["total"] ?></td>
        </tr>
        <?php
		       $rs_gogessformas->MoveNext();	
			}
		 }
		?>
    </table></td>
    
  </tr>
  
  <?php
     }
  
  	$rs_gogessform->MoveNext();	
		}
		
		echo'<tr>
    <td colspan="13">Total encontrados: '.$contador.'</td>
  </tr>';
		
 }
  ?>
</table>
