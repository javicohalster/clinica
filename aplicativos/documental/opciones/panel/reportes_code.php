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

</style>

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

<br />

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 panel-title">REPORTES GENERADOS</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <!--<table width="400" align="center" class="adminlist">-->
                    <table class="table align-items-center mb-0">
                        <tbody>
                            <?php
$ilistx=1;
$buscareporte="select * from rose_variabledeveloper where rept_publicado=1 and rept_activo=1";
$rs_gogessform = $DB_gogess->executec($buscareporte,array());

if($rs_gogessform)
 {

     	while (!$rs_gogessform->EOF) {
		
		    $ilistx++;	
            $css_fila='';

			if($ilist%2)
			{
			$css_fila='class="row0"';
			}
			else
			{
			$css_fila='class="row1"';
			}

		

	echo '<tr '.$css_fila.' >

    <td onclick="ver_reportedata('.$rs_gogessform->fields["vardev_id"].')" style="cursor:pointer; padding: 0;" ><a class="list-group-item list-group-item-action" style="border: none; padding: 0.75rem; display: block; width: 100%;">'.$rs_gogessform->fields["vardev_nombre"].'</a></td>

  </tr>';

		
		
		$rs_gogessform->MoveNext();	
		}
 }		


?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br />

    <?php 
//echo print_r($_SESSION);

$lista_categorias="select * from dns_categoriareporte where  categr_activo=1";
$rs_listacateg = $DB_gogess->executec($lista_categorias,array());
if($rs_listacateg)
 {
while (!$rs_listacateg->EOF) {
?>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 panel-title">
                            <?php echo utf8_decode($rs_listacateg->fields["categr_nombre"]); ?></h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <!--<table width="400" align="center" class="adminlist">-->
                    <table class="table align-items-center mb-0">
                        <tbody>
                            <?php

$ilist=1;

$buscareporte="select * from sth_report where rept_activo=1 and categr_id=".$rs_listacateg->fields["categr_id"];

   $rs_gogessform = $DB_gogess->executec($buscareporte,array());

 if($rs_gogessform)

 {

     	while (!$rs_gogessform->EOF) {

		

		$armaencrip="ireport=".$rs_gogessform->fields["rept_id"];

		$dataenc=$objformulario->encrypt($armaencrip);	

		

		if($rs_gogessform->fields["rept_archivopersonalizado"])

		{

		  $linkdinamico="aplicativos/reportes/personalizado/panel.php?".$armaencrip;

		}else

		{

		  $linkdinamico="templateformsweb/maestro_standar_report/verreporte.php?".$armaencrip;

		}

		

		$ilist++;		

            $css_fila='';

			if($ilist%2)

			{

			$css_fila='class="row0"';

			}

			else

			{

			$css_fila='class="row1"';

			}

		

	echo '<tr '.$css_fila.' >

    <td style="padding: 0;"><a class="list-group-item list-group-item-action" style="border: none; padding: 0.75rem; display: block; width: 100%;" href="'.$linkdinamico.'" target="_blank">'.$rs_gogessform->fields["rept_nombre"].'</a></td>

  </tr>';



	$rs_gogessform->MoveNext();	

	

	}

 }	



?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><br>

<?php
      $rs_listacateg->MoveNext();	

	

	}

 }

?>





<script type="text/javascript">
<!--
//------------------------------------------------------------
//RESPOTE ISSPOL SEGUNDO NIVEL
//------------------------------------------------------------

function ver_reporte_CIEC() {
    window.open('aplicativos/documental/opciones/report/reportmsp.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}


function ver_documento_CIEC() {
    window.open('aplicativos/documental/opciones/report/documentomsp.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}


//-------------------------------------------------------------
// REPORTE MSP
//------------------------------------------------------------
function ver_reporte_msp() {
    window.open('aplicativos/documental/opciones/report/reportmsp.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

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
    window.open('aplicativos/documental/opciones/report/report_ispol.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}


function ver_documento_ispol() {
    window.open('aplicativos/documental/opciones/report/documento_ispol.php?prase_valor=' + $('#prase_valor').val() +
        '&centro_id=' + $('#centro_id').val() + '&mes_valor=' + $('#mes_valor').val() + '&anio_valor=' + $(
            '#anio_valor').val(), '_blank');

}



function ver_reportedata(irep) {
    myWindow3 = window.open('director/templateforms/maestro_standar_developer/panel_developerdata.php?ireport=' + irep,
        'ventana_reporte', 'width=750,height=500,scrollbars=YES');
    myWindow3.focus();

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