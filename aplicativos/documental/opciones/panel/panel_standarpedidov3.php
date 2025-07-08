<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
//Llamando objetos
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
$comillasimple="'";



?>

<style type="text/css">
<!--
.alert-success {

    color: #000033;
    background-color: #FFFFFF;
    border-color: #ffffff;

}


.alert-success1 {

    color: #000033;
    background-color: #FFFFFF;
    border-color: #000000;

}

.css_titulo {
    font-weight: bold
}

.css_texto {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;

}

.TableScroll_lista {
    z-index: 99;
    width: 100%;
    height: 450px;
    overflow: auto;
}
-->
</style>

<div class="container" style="padding-top: 2em; padding-right:1em; padding-left:1em; max-width:100%;">
    <!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->
    <div class="container-fluid py-2" id="lista_manos">
        <!-- despliegue -->
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
                            <h3 class="text-white text-capitalize ps-3 panel-title" style="color:#000033">PEDIDOS DE
                                MEDICAMENTOS / INSUMOS VARIOS</h3>
                        </div><br />
                        <div class="fs-5" align="center">PACIENTE</div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table width="200" border="0" align="center" cellpadding="0" cellspacing="0"
                                class="display responsive cell-border">
                                <tbody>
                                    <tr>
                                        <td nowrap="nowrap">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <div class="input-group input-group-outline my-3">
                                                    <input name="ci_pacientepr" type="text" id="ci_pacientepr"
                                                        class="form-control" placeholder="C&Eacute;DULA" />
                                                </div>
                                                <input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"
                                                    type="button" name="Submit" value="OK"
                                                    onclick="desplegar_precuenta()" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="lsta_datossell"></div>
        <div class="row">
            <div class="col-12">
                <div class="card my-4" id="lsta_precuenta"></div>
            </div>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

        <div id="divBody_precuenta"></div>
        <!--<div id="lista_clientes"></div>-->

        <script type="text/javascript">
        <!--
        //  End 
        -->
        </script>
        <!-- despliegue -->
    </div>
</div>

<?php
}
else
{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}

?>

<SCRIPT LANGUAGE=javascript>
<!--
function ver_detalle(precu_id) {
    abrir_standar('aplicativos/documental/opciones/panel/precuenta_detalle.php', 'DETALLES _PRECUENTA',
        'divBody_precuenta', 'divDialog_precuenta', 800, 500, precu_id, 0, 0, 0, 0, 0, 0);
}
//
-->
</SCRIPT>

<script type="text/javascript">
<!--
function desplegar_precuenta() {
    if ($('#ci_pacientepr').val() == '') {
        alert("Ingrese la CEDULA del paciente");
        $("#lsta_precuenta").html("");
        return false;
    }

    $("#lsta_precuenta").load("aplicativos/documental/opciones/panel/pedidoabodegav3/precuenta.php", {

        ci_pacientepr: $('#ci_pacientepr').val()

    }, function(result) {


    });
    $("#lsta_precuenta").html("Espere un momento");
}


//$('.js-example-basic-single').select2();




function desplegar_data() {

    $("#lsta_datossell").load("aplicativos/documental/opciones/panel/pedidoabodegav3/data_parteoperatorio.php", {

        ci_pacientepr: $('#ci_pacientepr').val()

    }, function(result) {


    });
    $("#lsta_datossell").html("Espere un momento");

}


//$( "#ci_pacientepr" ).on( "change", function() {
// desplegar_precuenta()
//} );


//  End 
-->
</script>