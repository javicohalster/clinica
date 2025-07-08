<style type="text/css">
<!--
.css_titulo {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_texto {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$director="../../../../director/";
include ("../../../../director/cfgclases/clases.php");


?>
<table width="500" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#D2E2EE"><span class="css_titulo">TERAPEUTA</span></td>
    <td bgcolor="#D2E2EE"><span class="css_titulo">No. EVALUACIONES</span></td>
  </tr>
  <?php
  //psicologia
  if($_POST["usua_id"])
  {
$lista_terapias="select ps.usua_id,count(psic_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_psicologia ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$_POST["fecha_inicio"]."' and asighor_fecha<='".$_POST["fecha_fin"]."') and ps.usua_id=".$_POST["usua_id"]." group by ps.usua_id";
}
else
{

$lista_terapias="select ps.usua_id,count(psic_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_psicologia ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$_POST["fecha_inicio"]."' and asighor_fecha<='".$_POST["fecha_fin"]."') group by ps.usua_id";

}

  $rs_gogessform = $DB_gogess->Execute($lista_terapias);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
  ?>
  <tr>
    <td><span class="css_texto"><?php echo $nusuario; ?></span></td>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
  
  
   <?php
   //pedagogia
  if($_POST["usua_id"])
  {
$lista_terapias="select ps.usua_id,count(pedago_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_pedagogia ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$_POST["fecha_inicio"]."' and asighor_fecha<='".$_POST["fecha_fin"]."') and ps.usua_id=".$_POST["usua_id"]." group by ps.usua_id";
}
else
{

$lista_terapias="select ps.usua_id,count(pedago_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_pedagogia ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$_POST["fecha_inicio"]."' and asighor_fecha<='".$_POST["fecha_fin"]."') group by ps.usua_id";

}

//echo $lista_terapias;
  $rs_gogessform = $DB_gogess->Execute($lista_terapias);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
  ?>
  <tr>
    <td><span class="css_texto"><?php echo $nusuario; ?></span></td>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
  <?php
  //lenguaje
  if($_POST["usua_id"])
  {
$lista_terapias="select ps.usua_id,count(lenguaj_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_lenguaje ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$_POST["fecha_inicio"]."' and asighor_fecha<='".$_POST["fecha_fin"]."') and ps.usua_id=".$_POST["usua_id"]." group by ps.usua_id";
}
else
{

$lista_terapias="select ps.usua_id,count(lenguaj_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_lenguaje ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$_POST["fecha_inicio"]."' and asighor_fecha<='".$_POST["fecha_fin"]."') group by ps.usua_id";

}

//echo $lista_terapias;
  $rs_gogessform = $DB_gogess->Execute($lista_terapias);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
  ?>
  <tr>
    <td><span class="css_texto"><?php echo $nusuario; ?></span></td>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
  
  
   <?php
  //terapia fisica
  if($_POST["usua_id"])
  {
$lista_terapias="select ps.usua_id,count(terfisic_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_terapiafisica ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$_POST["fecha_inicio"]."' and asighor_fecha<='".$_POST["fecha_fin"]."') and ps.usua_id=".$_POST["usua_id"]." group by ps.usua_id";
}
else
{

$lista_terapias="select ps.usua_id,count(terfisic_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_terapiafisica ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$_POST["fecha_inicio"]."' and asighor_fecha<='".$_POST["fecha_fin"]."') group by ps.usua_id";

}

//echo $lista_terapias;
  $rs_gogessform = $DB_gogess->Execute($lista_terapias);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
	   $noasi="";
	   if(!($nusuario))
	   {
	     $noasi="No asignado";
	   }
  ?>
  <tr>
    <td><span class="css_texto"><?php echo $nusuario.$noasi; ?></span></td>
    <td><span class="css_texto"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
  
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
</table>