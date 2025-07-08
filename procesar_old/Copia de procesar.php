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

require_once "Classes/PHPExcel.php";

$url = "productos.xlsx";
$filecontent = file_get_contents($url);
$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
file_put_contents($tmpfname,$filecontent);

$lista_tabs=explode(",","Hoja2");


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
							  @$datos[$array_nombrecampo[$ilet]]='0';
							  }
							  
					   }
					   
				}
				
			   

			}
			$datos[$sub_index."file"]=trim($rs_files->fields["source_file"]);
			$datos[$sub_index."dateregister"]=date("Y-m-d");
			$datos[$sub_index."tab"]=$lista_tabs[$iexcl];
			
			
			if($datos[$array_nombrecampo[1]]!='0')
			{
              //echo $datos[$array_nombrecampo[1]]."<br>";
			  $array_camposdata=array();
			  $array_camposdata=explode(",",$campos_data.",".$sub_index."file".",".$sub_index."dateregister".",".$sub_index."tab");
			  $sql_inserta='';
			  $sql_inserta=$objvarios->genera_insert_general($nombre_tabla,$datos,$array_camposdata);
			  
			  echo $sql_inserta."<br>";
			 // $rs_sitienedata = $link_mysqlserver->Execute($sql_inserta);
			  
			  
	        }
	  
	  }
 
 


}


?>