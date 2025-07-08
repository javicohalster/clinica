<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");


$objformulario= new  ValidacionesFormulario();

//echo $_POST["fecha_inicio"];
//echo $_POST["fecha_fin"];
$horas=8;
$horasxsemana=$horas*5;
$horasxmes=$horas*22;
?>
<div id="dvData">
<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>


<?php
if(@$_POST["centro_id"])
{
$lista_centros="select * from dns_centrosalud where centro_activo=1 and centro_id='".$_POST["centro_id"]."'";
}
else
{
$lista_centros="select * from dns_centrosalud where centro_activo=1";
}

$rs_centros = $DB_gogess->executec($lista_centros,array());
 if($rs_centros)
 {
     	while (!$rs_centros->EOF) {
		
		echo "<br><center><b>".utf8_encode($rs_centros->fields["centro_nombre"])."</center></b><br>";
?>


<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="css_listat">TIPO DE CONSULTORIO</div></td>
    <td><div align="center" class="css_listat">ESTANDART TIEMPO POR PROCEDIMIENTO</div></td>
	<td><div align="center" class="css_listat">HORAS DE APERTURA DE ACUERDO A TIPOLOGIA/DIA</div></td>
    <td><div align="center" class="css_listat">CAPACIDAD EN HORAS POR SEMANA</div></td>
    <td><div align="center" class="css_listat">CAPACIDAD EN HORAS POR MES</div></td>
    <td><div align="center" class="css_listat">OCUPACION EN HORAS CONSULTORIO REAL</div></td>
    <td><div align="center" class="css_listat">CAPACIDAD CONSULTAS MES</div></td>
    <td><div align="center" class="css_listat">OCUPACION DE CAPACIDAD INSTALADA</div></td>
	<!-- <td><div align="center" class="css_listat">COMPROBACION</div></td> -->
  </tr>
<?php
$busca_usuarios="select distinct usua_formaciondelprofesional from app_usuario where centro_id='".$rs_centros->fields["centro_id"]."' and usua_formaciondelprofesional!=''";
$rs_gogessform = $DB_gogess->executec($busca_usuarios,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		$busca_ideal="select * from pichinchahumana_extension.dns_profesion where prof_nombre='".trim($rs_gogessform->fields['usua_formaciondelprofesional'])."'";
        $rs_ideal = $DB_gogess->executec($busca_ideal,array());
		
		

        $capacidaxmes=$rs_ideal->fields["prof_citasideales"];
		
		$saca_citas='';
		$cuenta_sql='';
		$horas_valor=0;
		$capaxmes=0;
		if(trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='ENFERMERIA')
		{
		
		   $saca_citas="select clie_id,centro_id,fecharegistro from pichinchahumana_reportes.capacidadinstalada_enfermeria where (fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."') and centro_id='".$rs_centros->fields["centro_id"]."'";		
		      
		   $cuenta_sql="select count(clie_id) as total from (".$saca_citas.") tbl";	
		   
           $rs_totalreg = $DB_gogess->executec($cuenta_sql,array());
		   
		   $minutos_valor=0;
		   $minutos_valor=$rs_totalreg->fields["total"]*$rs_ideal->fields["prof_standartipoprocedimiento"];
		   $horas_valor=0;
		   $horas_valor=$minutos_valor/60;
		   
		   $capaxmes=($horas_valor/$horasxmes)*100;
		   

		}
		
		if(trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='PSICOLOGIA')
		{
		
		   $saca_citas="select clie_id,centro_id,fecharegistro from pichinchahumana_reportes.capacidadinstalada_psicologia where (fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."') and centro_id='".$rs_centros->fields["centro_id"]."'";	 
		     
		   $cuenta_sql="select count(clie_id) as total from (".$saca_citas.") tbl ";	
		   
           $rs_totalreg = $DB_gogess->executec($cuenta_sql,array());
		   
		   $minutos_valor=0;
		   $minutos_valor=$rs_totalreg->fields["total"]*$rs_ideal->fields["prof_standartipoprocedimiento"];
		   $horas_valor=0;
		   $horas_valor=$minutos_valor/60;
		   
		   $capaxmes=($horas_valor/$horasxmes)*100;
		   

		}
		
		if(trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='MEDICINA GENERAL')
		{
		
		   $saca_citas="select clie_id,centro_id,fecharegistro from pichinchahumana_reportes.capacidadinstalada_medicinageneral where (fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."') and centro_id='".$rs_centros->fields["centro_id"]."'";	   
		   
		   $cuenta_sql="select count(clie_id) as total from (".$saca_citas.") tbl ";	
		   
           $rs_totalreg = $DB_gogess->executec($cuenta_sql,array());
		   
		   $minutos_valor=0;
		   $minutos_valor=$rs_totalreg->fields["total"]*$rs_ideal->fields["prof_standartipoprocedimiento"];
		   $horas_valor=0;
		   $horas_valor=$minutos_valor/60;
		   
		   $capaxmes=($horas_valor/$horasxmes)*100;
		   

		}
		
		
		if(trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='MEDICINA FAMILIAR' or trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='MEDICINA INTERNA' )
		{
		
		   $saca_citas="select clie_id,centro_id,fecharegistro from pichinchahumana_reportes.capacidadinstalada_medicinafamiliar where (fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."') and centro_id='".$rs_centros->fields["centro_id"]."'";	   
		   
		   $cuenta_sql="select count(clie_id) as total from (".$saca_citas.") tbl ";	
		   
           $rs_totalreg = $DB_gogess->executec($cuenta_sql,array());
		   
		   $minutos_valor=0;
		   $minutos_valor=$rs_totalreg->fields["total"]*$rs_ideal->fields["prof_standartipoprocedimiento"];
		   $horas_valor=0;
		   $horas_valor=$minutos_valor/60;
		   
		   $capaxmes=($horas_valor/$horasxmes)*100;	   

		}
		
		
		
		if(trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='LABORATORIO CLINICO' )
		{
		
		   $saca_citas="select clie_id,centro_id,fecharegistro from pichinchahumana_reportes.capacidadinstalada_laboratorio where (fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."') and centro_id='".$rs_centros->fields["centro_id"]."'";		   
		   
		   $cuenta_sql="select count(clie_id) as total from (".$saca_citas.") tbl";	
		   
           $rs_totalreg = $DB_gogess->executec($cuenta_sql,array());
		   
		   $minutos_valor=0;
		   $minutos_valor=$rs_totalreg->fields["total"]*$rs_ideal->fields["prof_standartipoprocedimiento"];
		   $horas_valor=0;
		   $horas_valor=$minutos_valor/60;
		   
		   $capaxmes=($horas_valor/$horasxmes)*100;	   

		}
		
		
		if(trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='REHABILITACION' )
		{
		
		   $saca_citas="select clie_id,centro_id,fecharegistro from pichinchahumana_reportes.capacidadinstalada_fisioterapia where (fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."') and centro_id='".$rs_centros->fields["centro_id"]."'";		   
		   
		   $cuenta_sql="select count(clie_id) as total from (".$saca_citas.") tbl ";	
		   
           $rs_totalreg = $DB_gogess->executec($cuenta_sql,array());
		   
		   $minutos_valor=0;
		   $minutos_valor=$rs_totalreg->fields["total"]*$rs_ideal->fields["prof_standartipoprocedimiento"];
		   $horas_valor=0;
		   $horas_valor=$minutos_valor/60;
		   
		   $capaxmes=($horas_valor/$horasxmes)*100;	   

		}
		
		
		if(trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='BACHILLER' )
		{
		
		   $saca_citas="select clie_id,centro_id,fecharegistro from pichinchahumana_reportes.capacidadinstalada_bachiller where (fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."') and centro_id='".$rs_centros->fields["centro_id"]."'";	   
		   
		   $cuenta_sql="select count(clie_id) as total from (".$saca_citas.") tbl ";	
		   
           $rs_totalreg = $DB_gogess->executec($cuenta_sql,array());
		   
		   $minutos_valor=0;
		   $minutos_valor=$rs_totalreg->fields["total"]*$rs_ideal->fields["prof_standartipoprocedimiento"];
		   $horas_valor=0;
		   $horas_valor=$minutos_valor/60;
		   
		   $capaxmes=($horas_valor/$horasxmes)*100;	   

		}
		
		
		if(trim($rs_gogessform->fields['usua_formaciondelprofesional'])=='ODONTOLOGIA')
		{
		
		   $saca_citas="select clie_id,centro_id,fecharegistro from pichinchahumana_reportes.capacidadinstalada_odontologia where (fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."') and centro_id='".$rs_centros->fields["centro_id"]."'";	   
		   $cuenta_sql="select count(clie_id) as total from (".$saca_citas.") tbl ";	
		   
           $rs_totalreg = $DB_gogess->executec($cuenta_sql,array());
		   
		   $minutos_valor=0;
		   $minutos_valor=$rs_totalreg->fields["total"]*$rs_ideal->fields["prof_standartipoprocedimiento"];
		   $horas_valor=0;
		   $horas_valor=$minutos_valor/60;
		   
		   $capaxmes=($horas_valor/$horasxmes)*100;
		   

		}
		
		
?>
  <tr>
    <td class="css_lista" ><?php echo $rs_gogessform->fields["usua_formaciondelprofesional"]; ?></td>
    <td class="css_lista" ><?php echo $rs_ideal->fields["prof_standartipoprocedimiento"]; ?></td>
	<td class="css_lista" ><?php echo $horas; ?></td>
    <td class="css_lista" ><?php echo $horasxsemana; ?></td>
    <td class="css_lista" ><?php echo $horasxmes; ?></td>
    <td class="css_lista" ><?php echo number_format($horas_valor, 2, '.', ''); ?></td>
    <td class="css_lista" ><?php echo $capacidaxmes; ?></td>
    <td class="css_lista" ><?php echo number_format($capaxmes, 2, '.', ''); ?></td>
	<!-- <td class="css_lista" ><?php echo $rs_totalreg->fields["total"]; ?></td> -->
  </tr>
<?php
            $rs_totalreg=array();
			$rs_ideal=array();
			$capacidaxmes='';
            $rs_gogessform->MoveNext();	
       }
  }
		

?>  
</table>


<?php
         $rs_centros->MoveNext();	
       }
  }

?>

</div>
<?php
}
?>