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
$lista_clientes="select * from dns_cuadrobasicomedicamentos  where categ_id=2";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());
 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	 $companies[$ic]["label"]=utf8_encode($rs_clientes->fields["cuadrobm_nombredispositivo"])." ".utf8_encode($rs_clientes->fields["cuadrobm_presentacion"]);
	 $companies[$ic]["value"]=utf8_encode($rs_clientes->fields["cuadrobm_nombredispositivo"]);
	 $companies[$ic]["descripcion"]=utf8_encode($rs_clientes->fields["cuadrobm_nombredispositivo"]);
	 $companies[$ic]["codigo"]=utf8_encode($rs_clientes->fields["cuadrobm_codigoitem"]);
	 $companies[$ic]["precio"]=utf8_encode($rs_clientes->fields["cuadrobm_preciodispositivo"]);
	 
	  $ic++;
	  $rs_clientes->MoveNext();	
	  }
}	  

$term = $_GET[ "term" ];


$result = array();
foreach ($companies as $company) {
	$companyLabel = trim($company["label"]);
	if ( strpos( strtoupper($companyLabel), strtoupper($term) )
	  !== false ) {
		array_push( $result, $company );
	}
}

echo json_encode( $result );

}
?>