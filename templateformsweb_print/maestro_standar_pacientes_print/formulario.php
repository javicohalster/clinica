<?php
$anio_inicial=2018;
$subindice_at="_atencion";
$carpeta_at="atencion";

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['datadarwin2679_sessid_inicio'];
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["clie_enlacex"]=$aletorioid;	
?>

<br>
<?php

$formulario_path="../../".$template_reemplazo;
//busca grupos
$busca_g="select distinct fie_groupprint from gogess_sisfield where tab_name='".$table."' and fie_groupprint>0 order by fie_groupprint asc";
$rs_buscag = $DB_gogess->executec($busca_g,array());
				if($rs_buscag)
                   {
	                  while (!$rs_buscag->EOF) {	
					  
					  
					  //verifica si hay datos en el grupo
					  $datos_valordata='';
					  $concatena_data='';
					  $bandera_valor=0;
					   $obtiene_camposlleno="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." order by fie_orden asc";
					  $rs_bbcamposlleno = $DB_gogess->executec($obtiene_camposlleno,array());
					  if($rs_bbcamposlleno)					  
					  {
					     while (!$rs_bbcamposlleno->EOF) {
						 
						   // $datos_valordata='';
						   if($rs_bbcamposlleno->fields["fie_guarda"]==1)
						   {
								//-------------------------------
								$datos_valordata=$objformulario->contenid[$rs_bbcamposlleno->fields["fie_name"]];
								if($datos_valordata=='0')
								{
								 $datos_valordata='';
								}
								
								$concatena_data.=$datos_valordata;
								//-------------------------------
								
						   }	
						   else
						   {
						   
						        if($rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid2')
								{
								  $concatena_data.='si';
								}
								
								if($rs_bbcamposlleno->fields["fie_typeweb"]=='camposub_grid')
								{
								    
								   if($objformulario->contenid["psic_enlace"])
								   {
								      $busca_registros="select count(1) as cuenta_valor from ".$rs_bbcamposlleno->fields["fie_tablasubgrid"]." where ".$rs_bbcamposlleno->fields["fie_campoenlacesub"]."='".$objformulario->contenid["psic_enlace"]."'";
									  $rs_cuentareg = $DB_gogess->executec($busca_registros,array());
									  
									  if($rs_cuentareg->fields["cuenta_valor"]>0)
									  {
									    $concatena_data.='si';
									  }
								   
								   }
								
								}
						   
						   }
												 
						 $rs_bbcamposlleno->MoveNext();
						 }
					  
					  }
					  
					
					  
					  if($concatena_data)
					  {
					  //echo $rs_buscag->fields["fie_groupprint"]."<br>";
					  
					  $obtiene_campos="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." order by fie_orden asc";
					  $rs_bbcampos = $DB_gogess->executec($obtiene_campos,array());
					  if($rs_bbcampos)
					  {
					       while (!$rs_bbcampos->EOF) {
						   
						   //echo $rs_bbcampos->fields["fie_name"]."<br>";
						   
						   ///------------------------------------------------------
						   $fie_title="";
						   if (!($rs_bbcampos->fields["fie_tactive"]))
							{
								$fie_title="";
							}
							else
							{
							
							   $fie_title="<label><b>".$rs_bbcampos->fields["fie_title"]."</b></label> ";
							}
						   
						   
						   if($rs_bbcampos->fields["fie_guarda"]==1)
						   { 
							
						
							   if (!(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]==""))
							   {
									 if ($rs_bbcampos->fields["fie_value"]=="replace")
									 {
										$valorbus=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];
										$rmp= $objformulario->replace_cmb($rs_bbcampos->fields["fie_tabledb"],$rs_bbcampos->fields["fie_datadb"],$rs_bbcampos->fields["fie_sql"],$valorbus,$DB_gogess);  
									 }
									 else
									 {
										if($rs_bbcampos->fields["fie_typeweb"]=='tiempobloque')
										{
										   $separa_fecha=array();
										   $separa_fecha=explode("-",$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]);
										   
										   $rmp=@$separa_fecha[0]." a&ntilde;os ".@$separa_fecha[1]." meses";
										}
										else
										{
										$rmp=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];
										}
										
									 }
							        
									if(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]!='0')
									{
									 echo utf8_encode($fie_title).'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'">'.$rmp.'</span><br>';						                                     }
							   }
							   else
							   {
								    if($rs_bbcampos->fields["fie_sendvar"])
									{
									
									    //-------------------------------------------------------------------------------------
										
										if ($rs_bbcampos->fields["fie_value"]=="replace")
										 {
											$valorbus=$objformulario->sendvar[$rs_bbcampos->fields["fie_sendvar"]];
											$rmp= $objformulario->replace_cmb($rs_bbcampos->fields["fie_tabledb"],$rs_bbcampos->fields["fie_datadb"],$rs_bbcampos->fields["fie_sql"],$valorbus,$DB_gogess);  
										 }
										 else
										 {
											$rmp=$objformulario->sendvar[$rs_bbcampos->fields["fie_sendvar"]];
										 }
								   
										 echo utf8_encode($fie_title).'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'">'.$rmp.'</span><br>';	
										
										
										//--------------------------------------------------------------------------------------
									 
									
									}

							   
							   }
						   
						   
						   }
						   else
						   {
						   
						         //echo "../../".$template_reemplazo."".$rs_bbcampos->fields["fie_archivogrid"];
								 
								  if($rs_bbcampos->fields["fie_archivogrid"])
								  {
								   
								    include("../../".$template_reemplazo."".$rs_bbcampos->fields["fie_archivogrid"]);
								  }
						          else
								  {
			                            
									   if($rs_bbcampos->fields["fie_typeweb"]=='campo_subetiqueta')
										{
										echo "<br><div style='color:#666666' ><b>".utf8_decode($fie_title)."</b></div><br>";
										}
										else
										{
										echo "<br><b>".utf8_encode($fie_title)."</b><hr><br>";
										
										}	
								       
								       
								  }
								  
						   
						   }
						   ///-------------------------------------------------------
						   
						   
						   
						   $rs_bbcampos->MoveNext();
						   }
					  
					  }
					  
					  
					  }
					  
					  $rs_buscag->MoveNext();
					  }
				    }	  

?>