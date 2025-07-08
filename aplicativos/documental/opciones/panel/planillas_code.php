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
  //include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 



$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$anio_inic=2018;
$anio_finc=date("Y");
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

<div class="container-fluid py-2">
    <!-- 
<div align="center">


<table width="400" border="0" cellpadding="2" cellspacing="0">

  <tr>

    <td colspan="3"><div align="center" class="Estilo1">PLANILLAS</div></td>

    </tr>

  <tr>

    <td bgcolor="#D1E7EF"><div align="right"><span class="Estilo1">MES</span></div></td>

    <td bgcolor="#D1E7EF"><span class="Estilo1">

      <select name="mes_valor" id="mes_valor">

        <option value="01">ENERO</option>

        <option value="02">FEBRERO</option>

        <option value="03">MARZO</option>

        <option value="04">ABRIL</option>

        <option value="05">MAYO</option>

        <option value="06">JUNIO</option>

        <option value="07">JULIO</option>

        <option value="08">AGOSTO</option>

        <option value="09">SEPTIEMBRE</option>

        <option value="10">OCTUBRE</option>

        <option value="11">NOVIEMBRE</option>

        <option value="12">DICIEMBRE</option>

        </select>

    </span></td>

    <td rowspan="2" bgcolor="#D1E7EF">

	

	<div class="form-group">	

<div class="col-md-12">

<center>



	<div onclick="ver_reporte()">

	<img src="images/planilla.png" >

	</div>



</center>

</div>

</div>	</td>

  </tr>

  <tr>

    <td bgcolor="#D1E7EF"><div align="right"><span class="Estilo1">A&Ntilde;O</span></div></td>

    <td bgcolor="#D1E7EF"><span class="Estilo1">

      <select name="anio_valor" id="anio_valor">

        <option value="2018">2018</option>

        <option value="2019">2019</option>

        </select>

    </span></td>

    </tr>

  <tr>

    <td>&nbsp;</td>

    <td colspan="2">&nbsp;</td>

  </tr>

</table> -->

    <br /><br />


    <?php 
$centro_id_val=$_SESSION['datadarwin2679_centro_id'];

//echo print_r($_SESSION);
?>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 panel-title">PLANILLAJE ISSPOL</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <!--<table width="400" align="center" class="adminlist">-->
                    <table class="table align-items-center mb-0">
                        <tbody>
                            <tr>
                                <td style="width: 21%; word-wrap: break-word; white-space: normal;"
                                    class="fs-5 text-secondary mb-0 css_dos">PLANILLA CONSOLIDADA UNIDADES
                                    DE SALUD DE PRIMER NIVEL
                                </td>
                                <td style="width: 27%;">
                                    <div class="input-group input-group-static mb-4">
                                        <select name="centro_id" id="centro_id" class="form-control">
                                            <option value="">-Establecimiento-</option>
                                            <?php
			$objformulario->fill_cmb('dns_centrosalud','centro_id,centro_nombre',$centro_id_val,' order by centro_nombre asc',$DB_gogess);
			?>
                                        </select>
                                    </div>
                                </td>
                                <td style="width: 12%;">
                                    <div class="input-group input-group-static mb-4">
                                        <select name="mes_valor" id="mes_valor" class="form-control">
                                            <option value="">-MES-</option>
                                            <option value="01">ENERO</option>
                                            <option value="02">FEBRERO</option>
                                            <option value="03">MARZO</option>
                                            <option value="04">ABRIL</option>
                                            <option value="05">MAYO</option>
                                            <option value="06">JUNIO</option>
                                            <option value="07">JULIO</option>
                                            <option value="08">AGOSTO</option>
                                            <option value="09">SEPTIEMBRE</option>
                                            <option value="10">OCTUBRE</option>
                                            <option value="11">NOVIEMBRE</option>
                                            <option value="12">DICIEMBRE</option>
                                        </select>
                                    </div>
                                </td>
                                <td style="width: 7%;">
                                    <div class="input-group input-group-static mb-4">
                                        <select name="anio_valor" id="anio_valor" class="form-control">

                                            <?php
		for($ia=$anio_finc;$ia>=$anio_inic;$ia--)
		{
		   echo '<option value="'.$ia.'">'.$ia.'</option>';		
		}		
		?>

                                        </select>
                                    </div>
                                </td>
                                <td style="width: 4%;">
                                    <div class="input-group input-group-static mb-4">
                                        <select name="prase_valor" id="prase_valor" class="form-control">
                                            <option value="">-%-</option>
                                            <?php
			$objformulario->fill_cmb('dns_porcentajeasegurado','prase_valor,prase_nombre','',' order by prase_valor desc',$DB_gogess);
			?>
                                        </select>
                                    </div>
                                </td>
                                <td style="width: 4%;">
                                    <div onclick="ver_reporte_ispolxt()"> </div>
                                </td>
                                <td style="width: 8%;">
                                    <div onClick="ver_reporte_ispol()"
                                        style="position: relative; display: inline-block; width: 100px; height: 100px; text-align: center; cursor:pointer;">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 100px;">file_save</span>
                                        <span style="position: absolute; top: 52%; left: 70%; transform: translate(-50%, -60%);
                                          font-size: 12px; color: black; font-weight: bold;">PLANILLA
                                        </span>
                                    </div>
                                    <!--
                                    <div onClick="ver_reporte_ispol()">
                                        <img src="images/planilla.png">
                                    </div>
                                    -->
                                </td>
                                <td style="width: 4%;">
                                    <div onClick="ver_documento_ispol()"
                                        style="position: relative; display: inline-block; width: 95px; height: 95px; text-align: center; cursor:pointer;">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 95px;">file_open</span>
                                        <span style="position: absolute; top: 52%; left: 50%; transform: translate(-50%, -60%);
                                          font-size: 12px; color: black; font-weight: bold;">OFICIO
                                        </span>
                                    </div>
                                    <!--
                                    <div onClick="ver_documento_ispol()">
                                        <img src="images/oficio.png">
                                    </div>
                                    -->
                                </td>
                                <td style="width: 3%;">
                                    <div onClick="ver_reporte_ispoltxt()">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 panel-title">PLANILLAJE IESS</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <table class="table align-items-center mb-0">
                        <tbody>
                            <tr>
                                <td style="width: 21%; word-wrap: break-word; white-space: normal;"
                                    class="fs-5 text-secondary mb-0 css_dos">PLANILLA CONSOLIDADA UNIDADES DE SALUD DE
                                    SEGUNDO NIVEL
                                </td>
                                <td style="width: 27%;">
                                    <div class="input-group input-group-static mb-4">
                                        <select name="centro_idCIEC" id="centro_idCIEC" class="form-control">
                                            <option value="">-Establecimiento-</option>
                                            <?php
			$objformulario->fill_cmb('dns_centrosalud','centro_id,centro_nombre',$centro_id_val,' order by centro_id asc',$DB_gogess);
			?>
                                        </select>
                                    </div>
                                </td>
                                <td width="12%">
                                    <div class="input-group input-group-static mb-4">
                                        <select name="mes_valorCIEC" id="mes_valorCIEC" class="form-control">
                                            <option value="">-MES-</option>
                                            <option value="01">ENERO</option>
                                            <option value="02">FEBRERO</option>
                                            <option value="03">MARZO</option>
                                            <option value="04">ABRIL</option>
                                            <option value="05">MAYO</option>
                                            <option value="06">JUNIO</option>
                                            <option value="07">JULIO</option>
                                            <option value="08">AGOSTO</option>
                                            <option value="09">SEPTIEMBRE</option>
                                            <option value="10">OCTUBRE</option>
                                            <option value="11">NOVIEMBRE</option>
                                            <option value="12">DICIEMBRE</option>
                                        </select>
                                    </div>
                                </td>
                                <td width="7%">
                                    <div class="input-group input-group-static mb-4">
                                        <select name="anio_valorCIEC" id="anio_valorCIEC" class="form-control">
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                        </select>
                                    </div>
                                </td>
                                <td width="8%">
                                    <div class="input-group input-group-static mb-4">
                                        <select name="prase_valorCIEC" id="prase_valorCIEC" class="form-control">
                                            <option value="">-%-</option>
                                            <?php
			$objformulario->fill_cmb('dns_porcentajeasegurado','prase_valor,prase_nombre','',' order by prase_valor desc',$DB_gogess);
			?>
                                        </select>
                                    </div>
                                </td>
                                <td style="width: 8%;">
                                    <div onClick="ver_reporte_CIEC()"
                                        style=" position: relative; display: inline-block; width: 100px; height: 100px;
                                        text-align: center; cursor:pointer;">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 100px;">file_save</span>
                                        <span style="position: absolute; top: 52%; left: 70%; transform: translate(-50%, -60%);
                                          font-size: 12px; color: black; font-weight: bold;">PLANILLA
                                        </span>
                                    </div>
                                    <!--
                                    <div onClick="ver_reporte_CIEC()">
                                        <img src="images/planilla.png">
                                    </div>
                                    -->
                                </td>
                                <td style="width: 4%;">
                                    <div onClick="ver_documento_CIEC()"
                                        style="position: relative; display: inline-block; width: 95px; height: 95px; text-align: center; cursor:pointer;">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 95px;">file_open</span>
                                        <span style="position: absolute; top: 52%; left: 50%; transform: translate(-50%, -60%);
                                          font-size: 12px; color: black; font-weight: bold;">OFICIO
                                        </span>
                                    </div>
                                    <!--
                                    <div onClick="ver_documento_CIEC()">
                                        <img src="images/oficio.png">
                                    </div>
                                    -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br /><br />


</div><br><br>




<script type="text/javascript">
<!--
//------------------------------------------------------------
//RESPOTE ISSFA
//------------------------------------------------------------

function ver_reporte_issfa() {
    window.open('aplicativos/documental/opciones/report/report_issfa.php?opcion=e&prase_valor=' + $('#prase_valorissfa')
        .val() + '&centro_id=' + $('#centro_idissfa').val() + '&mes_valor=' + $('#mes_valorissfa').val() +
        '&anio_valor=' + $('#anio_valorissfa').val(), '_blank');

}

//------------------------------------------------------------
//RESPOTE SPPAT
//------------------------------------------------------------

function ver_reportesppat() {
    window.open('aplicativos/documental/opciones/report/report_sppat.php?opcion=e&prase_valor=' + $('#prase_valorsppat')
        .val() + '&centro_id=' + $('#centro_idsppat').val() + '&mes_valor=' + $('#mes_valorsppat').val() +
        '&anio_valor=' + $('#anio_valorsppat').val(), '_blank');

}

//------------------------------------------------------------
//RESPOTE ISSPOL SEGUNDO NIVEL
//------------------------------------------------------------

function ver_reporte_CIEC1() {
    window.open('aplicativos/documental/opciones/report/report_iessoriginal.php?opcion=e&prase_valor=' + $(
        '#prase_valorCIEC').val() + '&centro_id=' + $('#centro_idCIEC').val() + '&mes_valor=' + $(
        '#mes_valorCIEC').val() + '&anio_valor=' + $('#anio_valorCIEC').val(), '_blank');

}

function ver_reporte_CIEC() {
    window.open('aplicativos/documental/opciones/report/report_iess.php?opcion=e&prase_valor=' + $('#prase_valorCIEC')
        .val() + '&centro_id=' + $('#centro_idCIEC').val() + '&mes_valor=' + $('#mes_valorCIEC').val() +
        '&anio_valor=' + $('#anio_valorCIEC').val(), '_blank');

}


function ver_documento_CIEC() {
    window.open('aplicativos/documental/opciones/report/documentociec.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}


//-------------------------------------------------------------
// REPORTE MSP
//------------------------------------------------------------
function ver_reporte_msp() {
    window.open('aplicativos/documental/opciones/report/reportmsp.php?opcion=e&prase_valor=' + $('#prase_valormsp')
        .val() + '&centro_id=' + $('#centro_idmsp').val() + '&mes_valor=' + $('#mes_valormsp').val() +
        '&anio_valor=' + $('#anio_valormsp').val(), '_blank');

}



function ver_reporte_mspconsolidada() {
    window.open('aplicativos/documental/opciones/report/report_msp.php?prase_valor=' + $('#prase_valormsp').val() +
        '&centro_id=' + $('#centro_idmsp').val() + '&mes_valor=' + $('#mes_valormsp').val() + '&anio_valor=' + $(
            '#anio_valormsp').val(), '_blank');

}


function ver_documento_msp() {
    window.open('aplicativos/documental/opciones/report/documentomsp.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}

//---------------------------------------------------


function ver_reporte() {
    window.open('aplicativos/documental/opciones/report/report.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}


function ver_documento() {
    window.open('aplicativos/documental/opciones/report/documento.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}

//---------------------------------------------------------------------

function ver_reporteo() {
    window.open('aplicativos/documental/opciones/report/reporto.php?prase_valor=' + $('#prase_valoro').val() +
        '&centro_id=' + $('#centro_ido').val() + '&mes_valor=' + $('#mes_valoro').val() + '&anio_valor=' + $(
            '#anio_valoro').val(), '_blank');

}


function ver_documentoo() {
    window.open('aplicativos/documental/opciones/report/documento.php?prase_valor=' + $('#prase_valoro').val() +
        '&centro_id=' + $('#centro_ido').val() + '&mes_valor=' + $('#mes_valoro').val() + '&anio_valor=' + $(
            '#anio_valoro').val(), '_blank');

}


//-------------------------------------------------------------
// REPORTE ISPOL
//------------------------------------------------------------
function ver_reporte_ispol() {
    window.open('aplicativos/documental/opciones/report/report_ispol.php?opcion=e&prase_valor=' + $('#prase_valor')
        .val() + '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}


function ver_documento_ispol() {
    window.open('aplicativos/documental/opciones/report/documento_ispol.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

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