<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();

$buespe='';
$buespe="select distinct us.usua_id from app_usuario us inner join dns_gridfuncionprofesional espe on us.usua_enlace=espe.usua_enlace inner join pichinchahumana_extension.dns_profesion prof on espe.prof_id=prof.prof_id where prof.prof_id='".$_POST["prof_idtx"]."' and prof.prof_id not in (38,777,888,911116,77)";

?>
<select class="form-control" name="usua_idvalcambio" id="usua_idvalcambio"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >
<option value="" >--Seleccion Terapista--</option>
<?php
$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido',' ',' where usua_id in ('.$buespe.') and usua_agenda=1 order by usua_apellido asc',$DB_gogess);
?>
</select>