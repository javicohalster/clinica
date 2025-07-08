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
    <div id="lista_manos">
        <!-- despliegue -->
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
                            <h3 class="text-white text-capitalize ps-3 panel-title" style="color:#000033">PRECUENTAS
                            </h3>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="ms-3 pe-md-3 align-items-center">
                            <a href="aplicativos/reportes/personalizado/panel.php?ireport=56" target="_blank"
                                class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"
                                style="background-color:#000066"><span
                                    class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;REPORTE PRECUENTAS</a>
                        </div>
                        <div class="table-responsive p-0">
                            <table width="200" border="0" align="center" cellpadding="0" cellspacing="0"
                                class="display responsive cell-border">
                                <tr>
                                    <th>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <div class="input-group input-group-outline my-3">
                                                <input name="ci_paciente" type="text" id="ci_paciente"
                                                    class="form-control" placeholder="CI PACIENTE" />
                                            </div>
                                            <input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="button"
                                                name="Submit" value="OK" onclick="desplegar_precuenta()" />
                                        </div>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    if ($('#ci_paciente').val() == '') {
        alert("Ingrese la cedula del paciente");
        return false;
    }

    $("#lsta_precuenta").load("aplicativos/documental/opciones/panel/precuentaprincipal/precuenta.php", {

        ci_paciente: $('#ci_paciente').val()

    }, function(result) {


    });
    $("#lsta_precuenta").html("Espere un momento");
}

//  End 
-->
</script>