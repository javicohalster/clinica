<?php
$tiempossss=4450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['datadarwin2679_sessid_inicio'])
{
$ic=0;
$lista_clientes="select * from dns_cuadrobasicomedicamentos where categ_id=1";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());
 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=$rs_clientes->fields["cuadrobm_codigoatc"];
	 $companies[$ic]["value"]=$rs_clientes->fields["cuadrobm_codigoatc"];
	 $companies[$ic]["codigo"]=$rs_clientes->fields["cuadrobm_codigoatc"];
	 $companies[$ic]["descripcion"]=utf8_encode($rs_clientes->fields["cuadrobm_principioactivo"]);
	 $companies[$ic]["via"]=utf8_encode($rs_clientes->fields["cuadrobm_primerniveldesagregcion"]);
	 $companies[$ic]["concentracion"]=utf8_encode($rs_clientes->fields["cuadrobm_concentracion"]);
	 $companies[$ic]["presentacion"]=utf8_encode($rs_clientes->fields["cuadrobm_presentacion"]);
	 $companies[$ic]["techo"]=utf8_encode($rs_clientes->fields["cuadrobm_preciotecho"]);
	 $companies[$ic]["techosinpr"]=utf8_encode($rs_clientes->fields["cuadrobm_preciotechomenosporcentaje"]);
	 
	  $ic++;
	  $rs_clientes->MoveNext();	
	  }
}	  

$term = $_GET[ "term" ];


$result = array();
foreach ($companies as $company) {
	$companyLabel = $company[ "label" ];
	if ( strpos( strtoupper($companyLabel), strtoupper($term) )
	  !== false ) {
		array_push( $result, $company );
	}
}

echo json_encode( $result );

}
?>