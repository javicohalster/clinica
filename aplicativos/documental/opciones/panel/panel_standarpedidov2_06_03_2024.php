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

.alert-success
{

color:#000033;
background-color:#FFFFFF;
border-color:#ffffff;

}


.alert-success1
{

color:#000033;
background-color:#FFFFFF;
border-color:#000000;

}
.css_titulo {font-weight: bold}

.css_texto {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;

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
<div class="panel panel-default">
 <div class="panel-heading" style="background-color:#96C2C1;" >
    <h3 class="panel-title" style="color:#000033" >PEDIDOS DE MEDICAMENTOS / INSUMOS</h3>
 </div>
<div class="panel-body">


<div class="table-responsive" >
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="display responsive cell-border" >
    <tr>
      <td><div align="center">PACIENTE</div></td>
    </tr>
    <tr>
      <td><div align="center">
        <table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td nowrap="nowrap">
	 PARTE OPERATORIO:			</td>
            <td>
	 <select name="partop_id" id="partop_id"  style="font-size:11px; width:360px"  class="js-example-basic-single form-control">
          <?php
	          printf("<option value=''>--SELECCIONAR--</option>");  
			  
			  if($_SESSION['datadarwin2679_sessid_inicio']==284 or $_SESSION['datadarwin2679_sessid_inicio']==2 or $_SESSION['datadarwin2679_sessid_inicio']==295)
              {
			     $objformulario->fill_cmb("lpin_parteoperatorio","partop_id,partop_paciente",""," order by partop_paciente asc",$DB_gogess);
			  
			  }
			  else
			  {
			     $objformulario->fill_cmb("lpin_parteoperatorio","partop_id,partop_paciente",""," where partop_estado=1 order by partop_paciente asc",$DB_gogess);			  
			  }
			  
           ?>
      </select></td>
            </tr>
        </table>
      </div></td>
    </tr>
  </table>
  <div id="lsta_datossell"></div>
  
  
  <div id="lsta_precuenta"></div>
  
</div>  
  
  <p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>

<div id="divBody_precuenta" ></div>
<!--<div id="lista_clientes"></div>-->

<script type="text/javascript">
<!--

//  End -->
</script>


</div>
</div>


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

function ver_detalle(precu_id)
{
   abrir_standar('aplicativos/documental/opciones/panel/precuenta_detalle.php','DETALLES _PRECUENTA','divBody_precuenta','divDialog_precuenta',800,500,precu_id,0,0,0,0,0,0);
}
//-->
</SCRIPT>

<script type="text/javascript">
<!--
function desplegar_precuenta()
{
  if($('#partop_id').val()=='')
  {
    // alert("Seleccione el Paciente");
    // return false;
  }
  
   $("#lsta_precuenta").load("aplicativos/documental/opciones/panel/pedidoabodegav2/precuenta.php",{
      
	  partop_id:$('#partop_id').val()

  },function(result){  


  });  
  $("#lsta_precuenta").html("Espere un momento");  
}


$('.js-example-basic-single').select2();




function desplegar_data()
{

 $("#lsta_datossell").load("aplicativos/documental/opciones/panel/pedidoabodegav2/data_parteoperatorio.php",{
      
	  partop_id:$('#partop_id').val()

  },function(result){  


  });  
  $("#lsta_datossell").html("Espere un momento");  

}


$( "#partop_id" ).on( "change", function() {
  desplegar_precuenta()
} );


//  End -->
</script>