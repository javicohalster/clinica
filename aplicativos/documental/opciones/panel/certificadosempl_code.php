<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{


$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
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
    width: 70%;
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

/* standard form style table */
-->
</style><br /><br />
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
                            <h3 class="text-white text-capitalize ps-3 panel-title">CERTIFICADOS PARA EMPLEADOS</h3>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0  dataTable" width="800" border="0"
                                cellpadding="4" cellspacing="4">
                                <thead>
                                    <th><span class="css_uno">CI EMPLEADO: </span></th>
                                    <th><span class="css_uno">FECHA DESDE: </span></th>
                                    <th><span class="css_uno">FECHA HASTA: </span></th>
                                    <td><span class="css_uno">TIPO CERTIFICADO:</span></td>
                                    <td><span class="css_uno">N&Uacute;MERO D&Iacute;AS OTORGADOS:</span></td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="css_uno">
                                            <div class="input-group input-group-outline my-3">
                                                <input name="ci_paciente" type="text" id="ci_paciente"
                                                    style="width:220px" class="form-control" />
                                            </div>
                                        </td>
                                        <td class="css_uno">
                                            <div class="input-group input-group-static my-3">
                                                <input name="fechai" type="date" id="fechai" style="width:220px"
                                                    class="form-control" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-static my-3">
                                                <input name="fechaf" type="date" id="fechaf" style="width:220px"
                                                    class="form-control" />
                                            </div>
                                        </td>
                                        <td class="css_uno">
                                            <div class="input-group input-group-static my-3">
                                                <select name="certif_id" id="certif_id" style="width:220px"
                                                    class="form-control">
                                                    <?php
	         echo '<option value="">---Seleecionar--</option>';
			 $objformulario->fill_cmb("dns_emplcertificados","certif_id,certif_titulo ","","where certif_activo=1 order by certif_titulo asc",$DB_gogess);	
	  ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="css_uno">
                                            <div class="input-group input-group-outline my-3">
                                                <input name="nd_otorgado" type="text" id="nd_otorgado"
                                                    style="width:220px" class="form-control" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><br />
                        <div class="col-xs-12">
                            <div class="text-center">
                                <input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="button"
                                    name="Button" value="GENERAR CERTIFICADO" class="form-control"
                                    onClick="ver_pantalla()">
                            </div>
                        </div>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
        <div align="center">
            <div id="pantalla_word"></div>
        </div>
    </div>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
}
?>
<div id="pantalla_gword"></div>
<script type="text/javascript">
<!--
function imp_cert() {
    if ($('#id_gen').val() > 0) {

        window.open('certificadosempl/certificado_standarlog.php?id_gen=' + $('#id_gen').val(), '_blank');
    } else {
        alert("Guarde el Certificado para Imrimir");

    }
}

function ver_pantalla() {

    $("#pantalla_word").load("certificadosempl/word.php", {
        ireport: $('#certif_id').val(),
        c1: $('#ci_paciente').val(),
        fechai: $('#fechai').val(),
        fechaf: $('#fechaf').val(),
        nd_otorgado: $('#nd_otorgado').val()

    }, function(result) {



    });

    $("#pantalla_word").html("Espere un momento...");

}


function guarda_imp() {

    $("#pantalla_gword").load("certificadosempl/guardar_word.php", {
        ireport: $('#certif_id').val(),
        c1: $('#ci_paciente').val(),
        fechai: $('#fechai').val(),
        fechaf: $('#fechaf').val(),
        especi_id: $('#especi_id').val(),
        texto: $('#textarea_certificado').val()

    }, function(result) {


    });

    $("#pantalla_gword").html("Espere un momento...");

}

//  End 
-->
</script>

<script type="text/javascript">
<!--
$("#fechai").datepicker({
    dateFormat: 'yy-mm-dd'
});
$("#fechaf").datepicker({
    dateFormat: 'yy-mm-dd'
});


//  End 
-->
</script>