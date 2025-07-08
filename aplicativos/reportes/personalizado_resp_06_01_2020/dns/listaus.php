<?php
//header('Content-Type: text/html; charset=UTF-8');
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

?>
<select name="usua_id" id="usua_id">
      <option value="">--seleccionar--</option>
	  <?php
	    $busca_usuarios="select * from app_usuario where usua_estado=1 and centro_id='".$_POST["centro_id"]."' order by usua_apellido asc ";
	    $rs_gogessform = $DB_gogess->executec($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			echo '<option value="'.$rs_gogessform->fields["usua_id"].'">'.utf8_encode($rs_gogessform->fields["usua_apellido"].' '.$rs_gogessform->fields["usua_nombre"]).'</option>';
			$rs_gogessform->MoveNext();
			}
		}
	  
	   // $objformulario->fill_cmb("app_usuario","usua_id,usua_apellido,usua_nombre",@$usua_id," where usua_estado=1 and centro_id='".$_POST["centro_id"]."' order by usua_apellido asc ",$DB_gogess);
	  ?> 
    </select>

<?php
}
?>