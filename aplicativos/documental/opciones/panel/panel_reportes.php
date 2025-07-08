<?php
include("lib_contable.php");
$obj_contable=new contable_funciones();
?>
<style>
#calendar {

    font-family: Arial;

    font-size: 12px;

}

#calendar caption {

    text-align: left;

    padding: 5px 10px;

    background-color: #003366;

    color: #fff;

    font-weight: bold;

}

#calendar th {

    background-color: #006699;

    color: #fff;

    width: 40px;

    border: thin solid #000000;

}

#calendar td {

    text-align: right;

    padding: 2px 5px;

    background-color: #eee;

    border: thin solid #1f1f2a;

}

#calendar .hoy {

    background-color: red;

}

.Estilo3 {
    font-size: 11px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
}
</style>


<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:1050px;">
    <!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->
    <div id="lista_manos">
        <!-- despliegue -->
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
                            <h3 class="text-white text-capitalize ps-3 panel-title" style="color:#000033">REPORTES</h3>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="col-md-12 mb-lg-0 mb-4">
                            <div class="card-header pb-0 p-3">
                                <div class="col-6 d-flex align-items-center">
                                    <span class="Estilo1">LIBRO DIARIO</span>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="table-responsive p-0">
                                    <form action="" method="post" name="fa_cen1" class="Estilo1" id="fa_cen1">
                                        <table class="table align-items-center mb-0" border="0" align="center"
                                            cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>DESDE:</td>
                                                    <td>
                                                        <div class="input-group input-group-static my-3">
                                                            <input class="form-control" name="fecha_i" type="date"
                                                                id="fecha_i" autocomplete="off" />
                                                        </div>
                                                    </td>
                                                    <td>HASTA:</td>
                                                    <td>
                                                        <div class="input-group input-group-static my-3">
                                                            <input class="form-control" name="fecha_f" type="date"
                                                                id="fecha_f" autocomplete="off" />
                                                        </div>
                                                    </td>
                                                    <td><input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"
                                                            type="button" name="Submit" value="Ver Libro Diario"
                                                            onclick="verlibrodiario_cen('aplicativos/documental/reportes/librodiario.php')" />
                                                    </td>
                                                    <td><input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"
                                                            type="button" name="Submit2" value="Ver Libro Diario EXCEL"
                                                            onclick="verlibrodiario_cen('aplicativos/documental/reportes/librodiario.php?exls=1')" />
                                                    </td>
                                                    <td><input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"
                                                            type="button" name="Submit2" value="Ver Libro Diario CSV"
                                                            onclick="verlibrodiario_cen('aplicativos/documental/reportes/librodiariocsv.php?exls=1')" />
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <BR />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<SCRIPT LANGUAGE=javascript>
<!--
function verlibrodiario_cen(url) {

    window.document.fa_cen1.action = url;
    window.document.fa_cen1.target = '_blank';
    window.document.fa_cen1.submit();
    window.document.fa_cen1.target = '_top';

}


$("#fecha_i").datepicker({
    dateFormat: 'yy-mm-dd'
});
$("#fecha_f").datepicker({
    dateFormat: 'yy-mm-dd'
});

//
-->
</SCRIPT>