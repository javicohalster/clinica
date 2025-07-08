<?php
ini_set('display_errors',0);
ini_set('memory_limit',-1);
error_reporting(E_ALL);
@$tiempossss=55544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

include("lib_contablecb.php");



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

/* Todas las pestañas: fondo negro, letras blancas */
.ui-tabs .ui-tabs-nav li a {
    background-color: #000 !important;
    color: #fff !important;
    border: 1px solid #444;
    margin-right: 2px;
    border-radius: 5px 5px 0 0;
}

/* Solo la pestaña activa: fondo blanco, letras negras */
.ui-tabs .ui-tabs-nav li.ui-tabs-active a {
    background-color: #fff !important;
    color: #000 !important;
}
</style>
<?php
$lista_mdulos[1]["nombre"]='Compra/Proveedores';
$lista_mdulos[1]["tipo"]='1';
$lista_mdulos[1]["archivo"]='';
$lista_mdulos[1]["namemodulo"]='compraproveedores';
$lista_mdulos[1]["mnupan_id"]='174';
$lista_mdulos[1]["camposbuscar"]='compra_fechai,compra_fechaf,provee_nombreb,compra_descripcionb,compra_nfacturab,estado_pp,estado_sri,code_compra';

//$lista_mdulos[2]["nombre"]='Cobros/Pagos';
//$lista_mdulos[2]["tipo"]='1';
//$lista_mdulos[2]["archivo"]='';
//$lista_mdulos[2]["namemodulo"]='cobrospagos';
//$lista_mdulos[2]["mnupan_id"]='184';
//$lista_mdulos[2]["camposbuscar"]='';


$obj_contable->DB_gogess=$DB_gogess;
?>
<div id="tabs">
    <ul class="nav nav-tabs bg-dark text-white">
        <?php
   for($i=1;$i<=count($lista_mdulos);$i++)
   {
     echo '<li class="nav-item"><a class="nav-link ' . $activeClass . '" data-bs-toggle="tab" href="#tabs-'.$i.'">'.$lista_mdulos[$i]["nombre"].'</a></li>';      
   }
   ?>
    </ul>

    <?php
   for($i=1;$i<=count($lista_mdulos);$i++)
   {
    
		if($lista_mdulos[$i]["tipo"]==1)
		{
			echo '<div id="tabs-'.$i.'" style="font-size:11px">
			<p>';
		    echo $obj_contable->despliegue_form($lista_mdulos[$i]["namemodulo"],$lista_mdulos[$i]["mnupan_id"]);	      
			echo '</p>
			 </div>';   
		}
	
   }
  ?>
</div>

<script type="text/javascript">
<!--
$(function() {
    $("#tabs").tabs();
});


<?php
for($i=1;$i<=count($lista_mdulos);$i++)
   {
      $obj_contable->camposbusqueda='';
	  $obj_contable->camposbusqueda=$lista_mdulos[$i]["camposbuscar"];
      echo $obj_contable->despliegue_scripts($lista_mdulos[$i]["mnupan_id"],$lista_mdulos[$i]["namemodulo"]);	
   }

?>

//  End 
-->
</script>