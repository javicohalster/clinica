<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
//header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
?>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

.table-bordered {
    border: 1px solid #ddd;
}
-->
</style>
<?php
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
	     $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}


if($_SESSION['datadarwin2679_sessid_inicio'])
{

$griddata='';
$valor_total=0;
$valorsiniva_total=0;
$valornograbado=0;
$pathextrap='';

 $director='../';
 include("../cfg/clases.php");
 include("../cfg/declaracion.php");
 include(@$director."libreria/estructura/aqualis_master.php");
 $objformulario= new  ValidacionesFormulario();


$idfac=$xml;
 
$lista_data="select * from  dns_egresocentros where egrec_id='".$xml."'";
$registros_data = $DB_gogess->executec($lista_data,array());
  
// 

$table='dns_egresocentros';

$plantilla='';
$plantilla='<table width="90%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17%"><b>No.Doc:</b></td>
    <td width="83%">-egrec_id-</td>
  </tr>
  <tr>
    <td><b>Tipo documento:</b> </td>
    <td>EGRESOS VARIOS</td>
  </tr>
  <tr>
    <td><b>Entrega:</b></td>
    <td>-egrec_responsableentrega-</td>
  </tr>
   <tr>
    <td><b>Recibe:</b></td>
    <td>-egrec_personalrecibe-</td>
  </tr>
</table>
';

$plantilla=$objvarios->llena_plantilladata($plantilla,$table,$DB_gogess,$objformulario,$registros_data);

echo $plantilla;
 
$contadord=0;

$lista_data="select * from  lpin_comprobantecontable where comcont_tabla='dns_egresocentros' and comcont_idtabla='".$xml."'";
$registros_data = $DB_gogess->executec($lista_data,array());

 if($registros_data)
 {
	  while (!$registros_data->EOF) {	
	  
$contadord++;	  
$plantilla='';
$plantilla='<br>'.$contadord.'<table width="90%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#D8EDEC"><div align="center"><b>ASIENTOS CONTABLES</b></div></td>
  </tr>
  <tr>
    <td><b>C&oacute;digo:</b></td>
    <td>-comcont_id-</td>
  </tr>
  <tr>
    <td><b>Tipo:</b></td>
    <td>-tipoa_id-</td>
  </tr>  
  <tr>
    <td><b>Fecha:</b></td>
    <td>-comcont_fecha-</td>
  </tr>
  <tr>
    <td><b>Concepto:</b></td>
    <td>-comcont_concepto-</td>
  </tr>
</table>
';

$table='lpin_comprobantecontable';
$plantilla=$objvarios->llena_plantilladata($plantilla,$table,$DB_gogess,$objformulario,$registros_data);

echo $plantilla;
	  
$sumadebe=0;
 $sumahaber=0;
 	  
?>	  
<br />	  
<table class="table table-bordered"  style="width:100%" >
  <tr>
    <td bgcolor="#DFE9EE" ><b>Cuenta</b></td>
	<td bgcolor="#DFE9EE" ><b>Debe</b></td>
	<td bgcolor="#DFE9EE" ><b>Haber</b></td>
	<td bgcolor="#DFE9EE" ><b>Centro de Costos</b></td>
	<td bgcolor="#DFE9EE" ><b>Fecha Registro</b></td>
  </tr>
 <?php
 $lista_asientos="select * from lpin_detallecomprobantecontable left join lpin_plancuentas on lpin_detallecomprobantecontable.detcc_cuentacontable=lpin_plancuentas.planc_codigoc where comcont_enlace='".$registros_data->fields["comcont_enlace"]."' order by detcc_tipo asc";
 $lista_asientos = $DB_gogess->executec($lista_asientos,array());
 if($lista_asientos)
 {
	  while (!$lista_asientos->EOF) {	
	  
	  $busca_ccostos="select * from lpin_centrodecostos where centcost_id='".$lista_asientos->fields["centcost_id"]."'";
	  $lista_ccostos = $DB_gogess->executec($busca_ccostos,array());
 ?>   
  <tr>
    <td><?php echo $lista_asientos->fields["planc_codigoc"]." ".$lista_asientos->fields["planc_nombre"]; ?></td>
	<td><?php echo $lista_asientos->fields["detcc_debe"]; ?></td>
	<td><?php echo $lista_asientos->fields["detcc_haber"]; ?></td>
	<td><?php echo $lista_ccostos->fields["centcost_nombre"]; ?></td>
	<td><?php echo $lista_asientos->fields["detcc_fecharegistro"]; ?></td>
  </tr>
 <?php
 
 $sumadebe=$sumadebe+$lista_asientos->fields["detcc_debe"];
 $sumahaber=$sumahaber+$lista_asientos->fields["detcc_haber"];
 
            $lista_asientos->MoveNext();	
			
		   }
 }
 ?> 
 
  <tr>
    <td><b>Totales</b></td>
	<td><b><?php echo $sumadebe; ?></b></td>
	<td><b><?php echo $sumahaber; ?></b></td>
	<td></td>
	<td></td>
  </tr>
</table> 

<?php	  
	   $registros_data->MoveNext();
	  }
 }	  



 
}   
?>