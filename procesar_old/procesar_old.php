<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$system=1;
@$director="../";
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/variables/variables.php");

$rs_ok = $DB_gogess->executec("TRUNCATE dns_inventariopr",array());

require_once "Classes/PHPExcel.php";

$url = "importar_COMPLETO.xlsx";
$filecontent = file_get_contents($url);
echo $tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
file_put_contents($tmpfname,$filecontent);

$lista_tabs=explode(",","Hoja1");

$concatena_campos='';
$concatena_campos_valores='';

$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$sheetnames = $excelReader->listWorksheetNames($tmpfname);


for($iexcl=0;$iexcl<count($lista_tabs);$iexcl++)
{

    $index_val=0;
	for($i=0;$i<count($sheetnames);$i++)
	{
	   if($sheetnames[$i]==trim($lista_tabs[$iexcl]))
	   {
		 $index_val=$i;
	   }
	}
	
	
	$worksheet = $excelObj->getSheet($index_val);
    $lastRow = $worksheet->getHighestRow();
	
	//echo $lastRow."<br>";
	
	$array_letra=array();
	$array_tipo=array();
	$array_nombrecampo=array();
	
	$contador_letra=0;
	
			 
			 $array_letra[$contador_letra]="A";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="1";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="B";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="2";
			 
			  $contador_letra++;
			 
			 $array_letra[$contador_letra]="C";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="3";
			 
			  $contador_letra++;
			 
			 $array_letra[$contador_letra]="D";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="4";
			 
			  $contador_letra++;
			 
			 $array_letra[$contador_letra]="E";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="5";
			 
			  $contador_letra++;
			 
			 $array_letra[$contador_letra]="F";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="6";
		  
		  
		    $contador_letra++;
			 
			 $array_letra[$contador_letra]="G";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="7";
			
			$contador_letra++;
			 
			 $array_letra[$contador_letra]="H";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="8";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="I";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="9";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="J";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="10";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="K";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="11";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="L";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="12";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="M";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="13";
	
	  
	  $campos_data=implode(",",$array_nombrecampo);
	  
	 // print_r($array_letra);
	 
	  $row='';
	  for ($row = 1; $row <= $lastRow; $row++) {
	      $datos=array();
		  
		  for ($ilet=0;$ilet<count($array_letra);$ilet++)
			{
			
				switch ($array_tipo[$ilet]) {
					case 'DATE':
					    {
						    $valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
			                $datos[$array_nombrecampo[$ilet]] = PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD");
						}
						break;
					case 'DATETIME':
						{
						    $date='';
							$valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
						    $date = date_create($valorfecha);
					        $datos[$array_nombrecampo[$ilet]]=@date_format($date, 'Y-m-d H:i:s');
						}
						break;
					default:
					   {
					   
					     // @$datos[$array_nombrecampo[$ilet]]=$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue();
						    @$datos[$array_nombrecampo[$ilet]]=str_replace("'", "\'",$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue());
							if(@$datos[$array_nombrecampo[$ilet]]=='')
							  {
							  @$datos[$array_nombrecampo[$ilet]]='';
							  }
							  
					   }
					   
				}
				
			   

			}
			//---------------
			//arreglo data
			//print_r($datos);
			

			
			$emp_id=1;
			if($datos[5])
			{
			  $inven_codigo=$datos[5];
			}
			else
			{
			
			 $valoralet=mt_rand(1,500);
			 $aletorioid='01'.date("Ymdhis").$valoralet;
			 $inven_codigo=$aletorioid;
			}
			
			$categ_id=1;
			$inven_nombre=$datos[2];
			$inven_marca=$datos[3];
			$inven_modelo=$datos[4];
			$inven_medidas=$datos[6];
			$inven_color=$datos[7];
			$inven_ubicacion='QUITO';
			$inven_descripcion=$datos[8];
			$inven_observacion=$datos[11];
			$inven_cantidadalafecha=$datos[1];
			$inven_valorunit=0;
			
			$estinv_id=0;
			if($datos[10]=='Bueno')
			{
			$estinv_id=5;
			}
		
			if($datos[10]=='Regular')
			{	
			$estinv_id=4;
			}
			
			if($datos[10]=='Buen estado')
			{	
			$estinv_id=1;
			}
			
			if($datos[10]=='Deteriorada')
			{	
			$estinv_id=6;
			}
			
			if($datos[10]=='mal estado')
			{	
			$estinv_id=7;
			}
			
			
			if($datos[10]=='incompleto')
			{	
			$estinv_id=8;
			}
			
			if($datos[10]=='incompleto, remendado')
			{	
			$estinv_id=9;
			}
			
			if($datos[10]=='DEPRECIADO')
			{	
			$estinv_id=10;
			}
			
			$inven_activo=1;
			$centro_id=1;
			$usua_id=$datos[9];
			$usuar_id=93;
			$inven_fecharegistra=date("Y-m-d");
			$invenm_vidautil='';
			$invenm_fechaadquisicion='';
			$invenm_area='';
			$invenm_proveedor='';
			$invenm_fechamantenimiento='';
			$invenm_responsableexterno='';
			$invenm_actividades='';
			$permant_id='0';
			$invenm_tipo=$datos[12];
            $inven_area=$datos[13];
			
			$array_campos=array();
			
			$array_campos[0]= 'emp_id';
			$array_campos[1]= 'inven_codigo';
			$array_campos[2]= 'categ_id';
			$array_campos[3]='inven_nombre';
			$array_campos[4]='inven_marca';
			$array_campos[5]= 'inven_modelo';
			$array_campos[6]= 'inven_medidas';
			$array_campos[7]= 'inven_color';
			$array_campos[8]= 'inven_ubicacion';
			$array_campos[9]= 'inven_descripcion';
			$array_campos[10]='inven_observacion';
			$array_campos[11]= 'inven_cantidadalafecha';
			$array_campos[12]= 'inven_valorunit';
			$array_campos[13]= 'estinv_id';
			$array_campos[14]= 'inven_activo';
			$array_campos[15]= 'centro_id';
			$array_campos[16]= 'usua_id';
			$array_campos[17]= 'usuar_id';
			$array_campos[18]= 'inven_fecharegistra';
			$array_campos[19]= 'invenm_vidautil';
			$array_campos[20]='invenm_fechaadquisicion';
			$array_campos[21]='invenm_area';
			$array_campos[22]= 'invenm_proveedor';
			$array_campos[23]='invenm_fechamantenimiento';
			$array_campos[24]= 'invenm_responsableexterno';
			$array_campos[25]= 'invenm_actividades';
			$array_campos[26]= 'permant_id';
			$array_campos[27]= 'invenm_tipo';
			$array_campos[28]= 'inven_area';
			 	 
			
			$concatena_campos='';
			$concatena_campos_valores='';
			for($i=0;$i<count($array_campos);$i++)
			{
			   $concatena_campos.=$array_campos[$i].",";
			   $concatena_campos_valores.="'".$$array_campos[$i]."',";
			}
			
			if($datos[12])
			{
			$inserta_datos="insert into dns_inventariopr (".substr($concatena_campos,0,-1).") values (".substr($concatena_campos_valores,0,-1).");";
			
			//echo $inserta_datos."<br>";
			
			$rs_ok = $DB_gogess->executec($inserta_datos,array());
			}
			//$insert_data="insert into beko_migrar (migra_codigo,migra_nombre,migra_almacen,migra_valorcompra,migra_valorventa,migra_valormayorista,migra_nombreingrediente,migra_cantidadingrediente,	migra_valoringrediente) values ('".$datos[3]."','".$datos[4]."','1','".$datos[8]."','".$datos[9]."','".$datos[10]."','".$datos[11]."','".$datos[12]."','".$datos[13]."');";
			
			//$rs_ok = $DB_gogess->executec($insert_data,array());
			
	  
	  }
 
 


}

echo "Fin"
?>