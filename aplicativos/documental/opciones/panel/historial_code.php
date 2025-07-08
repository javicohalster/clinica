<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{


$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 


$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$busca_seguro="select * from app_usuario left join pichinchahumana_extension.dns_convenios conved on app_usuario.conve_id=conved.conve_id where usua_id='".$_SESSION['datadarwin2679_sessid_inicio']."'";
$rs_seg = $DB_gogess->executec($busca_seguro,array());

$nombre_seguro='';
$nombre_seguro=$rs_seg->fields["conve_nombre"];

?>

<style type="text/css">
<!--
.css_uno {

    font-size: 11px;

    font-family: Verdana, Arial, Helvetica, sans-serif;

    font-weight: bold;

    color: #000000;

}

.css_dos {

    font-size: 11px;

    font-family: Verdana, Arial, Helvetica, sans-serif;

}



/* standard list style table */

table.adminlist {

    background-color: #FFFFFF;

    margin: 0px;

    padding: 0px;

    border: 1px solid #ddd;

    border-spacing: 0px;

    width: 100%;

    border-collapse: collapse;

}



table.adminlist th {

    margin: 0px;

    padding: 6px 4px 2px 4px;

    height: 25px;

    background-repeat: repeat;

    font-size: 11px;

    color: #000;

}

table.adminlist th.title {

    text-align: left;

}



table.adminlist th a:link,
table.adminlist th a:visited {

    color: #c64934;

    text-decoration: none;

}



table.adminlist th a:hover {

    text-decoration: underline;

}



table.adminlist tr.row0 {

    background-color: #F9F9F9;

}

table.adminlist tr.row1 {

    background-color: #FFF;

}

table.adminlist td {

    border-bottom: 1px solid #e5e5e5;

    padding: 6px 4px 2px 15px;

}

table.adminlist tr.row0:hover {

    background-color: #f1f1f1;

}

table.adminlist tr.row1:hover {

    background-color: #f1f1f1;

}

table.adminlist td.options {

    background-color: #ffffff;

    font-size: 8px;

}

select.options,
input.options {

    font-size: 8px;

    font-weight: normal;

    border: 1px solid #999999;

}

.Estilo1 {
    font-size: 11px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-weight: bold;
}

/* standard form style table */
-->

</style><br /><br />

<div align="center">

    <?php
echo "<div style='font-size:14px' ><b>".$nombre_seguro."</b></div>";
?>
</div>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
                        <h3 class="text-white text-capitalize ps-3 panel-title">
                            HISTORIAL
                        </h3>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table width="200" align="center">
                            <!--<table width="400" align="center" class="adminlist">-->
                            <tbody>
                                <tr>
                                    <th>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <div class="input-group input-group-outline my-3">
                                                <input name="clie_rucci" type="text" id="clie_rucci"
                                                    placeholder="CI/NOMBRE">
                                            </div>
                                            <input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="reset"
                                                name="Reset" value="OK" onClick="lista_atencion()">
                                        </div>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-4" id="lista_atencion">&nbsp;</div>
            </div>
        </div>
        <div id="lista_data">&nbsp;</div>
    </div>
</div>

<script type="text/javascript">
<!--
//------------------------------------------------------------
//HISTORIAL MEDICO
//------------------------------------------------------------

function lista_historial(atenc_id, clie_rucci) {

    $("#lista_data").load("aplicativos/documental/opciones/historialmd/historial.php", {

        clie_rucci: clie_rucci,
        atenc_id: atenc_id

    }, function(result) {


    });
    $("#lista_data").html("Espere un momento...");

}


function lista_atencion() {

    $("#lista_atencion").load("aplicativos/documental/opciones/historialmd/atencion.php", {

        clie_rucci: $('#clie_rucci').val()

    }, function(result) {

        $("#lista_data").html("");

    });
    $("#lista_atencion").html("Espere un momento...");

}

//  End 
-->
</script>

<?php
}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000" align="center" >Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
}	
?>