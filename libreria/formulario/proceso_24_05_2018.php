<?php

/**

 * Procesos formulario

 * 

 * Este archivo permite realizar los procesos del formulario

 * Crear formulario, guardar datos, editar datos, borrar datos

 * @author Ecohevea <franklin.aguas@hecoevea.com>

 * @version 1.0

 * @package FormularioProceso

 */



 

class FormularioProceso extends CamposFormulario
{ 



var $essri;
var $camposri;
var $contenid;
var $tab_historialmedico;

/**

 * Funcion para crear el formulario.

 * 

 * Crear el formulario.

 * 

 * @param string $table el nombre de la tabla string $campo el nombre del campo .

 * @return despliegua el campos.

 */	



function fecha_bloque_desc($formato,$ncampo,$valor,$obl)
{
    $rango_inicio=0;
   if(!(@$this->fechadesde[$ncampo]))
   {
    $rango_inicio=1900;
   }
   else
   {
   $rango_inicio=@$this->fechadesde[$ncampo];
   } 
   $listaformato=explode("-",$formato);
   $fechaac=date("Y");
    $fechaac=2025;
   
   $valor_biene=explode("-",$valor);
   
   //dia
   $select["d"]='<select class="form-control" name="dia_'.$ncampo.'" id="dia_'.$ncampo.'" onClick="fecha_bloqueasigna(\'dia_'.$ncampo.'\',\'mes_'.$ncampo.'\',\'anio_'.$ncampo.'\',\''.$ncampo.'\')" ><option value="00">-dia-</option>';
   for($i=1;$i<=31;$i++)
   {
    $valord=str_pad($i,2, "0", STR_PAD_LEFT);
	if(@$valor_biene[2]==$valord)
	{
    $select["d"].='<option value="'.$valord.'" selected >'.$valord.'</option>';
	}
	else
	{
	 $select["d"].='<option value="'.$valord.'">'.$valord.'</option>';
	}
   }
   $select["d"].='</select>';
   
   //mes
   $select["m"]='<select class="form-control" name="mes_'.$ncampo.'" id="mes_'.$ncampo.'" onClick="fecha_bloqueasigna(\'dia_'.$ncampo.'\',\'mes_'.$ncampo.'\',\'anio_'.$ncampo.'\',\''.$ncampo.'\')"  ><option value="00">-mes-</option>';
   for($i=1;$i<=12;$i++)
   {
    $valorm=str_pad($i,2, "0", STR_PAD_LEFT);
	if(@$valor_biene[1]==$valorm)
	{
    $select["m"].='<option value="'.$valorm.'" selected >'.$valorm.'</option>';
	}
	else
	{
	 $select["m"].='<option value="'.$valorm.'">'.$valorm.'</option>';
	}
	
	
   }
   $select["m"].='</select>';   
   
   //anio
   $select["Y"]='<select class="form-control" name="anio_'.$ncampo.'" id="anio_'.$ncampo.'" onClick="fecha_bloqueasigna(\'dia_'.$ncampo.'\',\'mes_'.$ncampo.'\',\'anio_'.$ncampo.'\',\''.$ncampo.'\')"  ><option value="00000">-a&ntilde;o-</option>';
   for($i=$rango_inicio;$i<=$fechaac;$i++)
   {
   
	if(@$valor_biene[0]==$i)
	{
    $select["Y"].='<option value="'.$i.'" selected >'.$i.'</option>';
	}
	else
	{
	$select["Y"].='<option value="'.$i.'" >'.$i.'</option>';
	}
	
   }
   $select["Y"].='</select>';  
   
$campo='<table border="0" cellpadding="0" cellspacing="0">
  <tr>';
  for($form=0;$form<count($listaformato);$form++)
  {
     $campo.='<td>'.$select[$listaformato[$form]].'</td>';
  }

$campo.='<td>'.$obl.'</td>';
$campo.='</tr>
</table>';
 
return $campo;
} 

function fecha_bloque($formato,$ncampo,$valor,$obl)
{
    $mes_array=array();
   $mes_array[1]="Enero";
   $mes_array[2]="Febrero";
   $mes_array[3]="Marzo";
   $mes_array[4]="Abril";
   $mes_array[5]="Mayo";
   $mes_array[6]="Junio";
   $mes_array[7]="Julio";
   $mes_array[8]="Agosto";
   $mes_array[9]="Septiembre";
   $mes_array[10]="Octubre";
   $mes_array[11]="Noviembre";
   $mes_array[12]="Diciembre";
   $rango_inicio=0;
   if(!(@$this->fechadesde[$ncampo]))
   {
    $rango_inicio=1900;
   }
   else
   {
   $rango_inicio=@$this->fechadesde[$ncampo];
   } 
   
   $listaformato=explode("-",$formato);
   $fechaac=date("Y");
   
   $valor_biene=explode("-",$valor);
   
   //dia
   $select["d"]='<select class="form-control" name="dia_'.$ncampo.'" id="dia_'.$ncampo.'" onClick="fecha_bloqueasigna(\'dia_'.$ncampo.'\',\'mes_'.$ncampo.'\',\'anio_'.$ncampo.'\',\''.$ncampo.'\')" ><option value="00">-dia-</option>';
   for($i=1;$i<=31;$i++)
   {
    $valord=str_pad($i,2, "0", STR_PAD_LEFT);
	if(@$valor_biene[2]==$valord)
	{
    $select["d"].='<option value="'.$valord.'" selected >'.$valord.'</option>';
	}
	else
	{
	 $select["d"].='<option value="'.$valord.'">'.$valord.'</option>';
	}
   }
   $select["d"].='</select>';
   
   //mes
   $select["m"]='<select class="form-control" name="mes_'.$ncampo.'" id="mes_'.$ncampo.'" onClick="fecha_bloqueasigna(\'dia_'.$ncampo.'\',\'mes_'.$ncampo.'\',\'anio_'.$ncampo.'\',\''.$ncampo.'\')"  ><option value="00">-mes-</option>';
   for($i=1;$i<=12;$i++)
   {
    $valorm=str_pad($i,2, "0", STR_PAD_LEFT);
	if(@$valor_biene[1]==$valorm)
	{
    $select["m"].='<option value="'.$valorm.'" selected >'.$mes_array[$i].'</option>';
	}
	else
	{
	 $select["m"].='<option value="'.$valorm.'">'.$mes_array[$i].'</option>';
	}
	
	
   }
   $select["m"].='</select>';   
   
   //anio
   $select["Y"]='<select class="form-control" name="anio_'.$ncampo.'" id="anio_'.$ncampo.'" onClick="fecha_bloqueasigna(\'dia_'.$ncampo.'\',\'mes_'.$ncampo.'\',\'anio_'.$ncampo.'\',\''.$ncampo.'\')"  ><option value="00000">-a&ntilde;o-</option>';
   for($i=$fechaac;$i>$rango_inicio;$i--)
   {
   
	if(@$valor_biene[0]==$i)
	{
    $select["Y"].='<option value="'.$i.'" selected >'.$i.'</option>';
	}
	else
	{
	$select["Y"].='<option value="'.$i.'" >'.$i.'</option>';
	}
	
   }
   $select["Y"].='</select>';  
   
$campo='<table border="0" cellpadding="0" cellspacing="0">
  <tr>';
  for($form=0;$form<count($listaformato);$form++)
  {
     $campo.='<td>'.$select[$listaformato[$form]].'</td>';
  }

$campo.='<td>'.$obl.'</td>';
$campo.='</tr>
</table>';
 
return $campo;
}





function numero_secuencial($camposec,$table,$DB_gogess)
{

   $obtiene_estb_punto="select estab_codigo,pemision_num,pemision_inicia from efacsistema_puntoemision inner join efacsistema_establecimiento on efacsistema_puntoemision.estab_id=efacsistema_establecimiento.estab_id where pemision_id=".$_SESSION['datadarwin2679_pemision_id'];

	 $rs_estbpunto= $DB_gogess->executec($obtiene_estb_punto,array());

	 

	    $banderaexistelote=1;
		$loteinicial=$rs_estbpunto->fields["pemision_inicia"];
		$lotefinal= 1000000000000000;	
		$idlotex= 1;		 

	 if($banderaexistelote==1)
	 {

	   $buscaultimonum="select 	".$camposec." from ".$table." order by ".$camposec." desc limit 1";
	   $rs_disponible= $DB_gogess->executec($buscaultimonum,array());
	   $banderanumeroinicial=0;

				 if($rs_disponible)
				 {

					  while (!$rs_disponible->EOF) {

					  $gastadofac=$rs_disponible->fields[$camposec];	
  			          $banderanumeroinicial=1;
					  $rs_disponible->MoveNext();

					  }

				}

	   

				   if($banderanumeroinicial==1)
				   {
			  //verifica si esta en rango

							  $numerodesarmado=explode("-",$gastadofac);
							  $mumeroactual=($numerodesarmado[2]*1)+1;

							   //verifica si esta en rango

							   $nuevonumero_sig=$numerodesarmado[0]."-".$numerodesarmado[1]."-".str_pad($mumeroactual,9, "0", STR_PAD_LEFT);

				   }
				   else
				   {

						 $nuevonumero_sig=$rs_estbpunto->fields["estab_codigo"]."-".$rs_estbpunto->fields["pemision_num"]."-".str_pad($loteinicial,9, "0", STR_PAD_LEFT);
	   

				   }

	   

	 }
	 else
	 {	 
	  // echo "Alerta Lote no asignado al sistema...";
	   $nuevonumero_sig=2;
	 }  

   return $nuevonumero_sig;

  // echo $lista_datoslote;

}


//secuencial historia clinica
 
function numero_secuencialhc($ci,$camposec,$table,$DB_gogess)
{


	    $banderaexistelote=1;
		$loteinicial=1;
		$lotefinal= 100000000000000000;	
		$idlotex= 1;		 

	 if($banderaexistelote==1)
	 {



	   $buscaultimonum="select ".$camposec." from ".$table." inner join app_cliente on ".$table.".clie_id=app_cliente.clie_id where clie_rucci='".$ci."' order by REPLACE(".$camposec.",'".$ci."-','') desc limit 1";
	   
	   $rs_disponible= $DB_gogess->executec($buscaultimonum,array());
	   $banderanumeroinicial=0;

				 if($rs_disponible)
				 {

					  while (!$rs_disponible->EOF) {

					  $gastadofac=$rs_disponible->fields[$camposec];	
  			          $banderanumeroinicial=1;
					  $rs_disponible->MoveNext();

					  }

				}

	   

				   if($banderanumeroinicial==1)
				   {
			  //verifica si esta en rango

							  $numerodesarmado=explode("-",$gastadofac);
							  $mumeroactual=($numerodesarmado[1]*1)+1;

							   //verifica si esta en rango

							   $nuevonumero_sig=$ci."-".$mumeroactual;

				   }
				   else
				   {

						 $nuevonumero_sig=$ci."-".$loteinicial;
	   

				   }

	   

	 }
	 else
	 {	 
	  // echo "Alerta Lote no asignado al sistema...";
	   $nuevonumero_sig=2;
	 }  

   return $nuevonumero_sig;

  // echo $lista_datoslote;

}
 
//secuencial historia clinica 

function generar_formulario_campos($submit,$table,$DB_gogess)
{



//print_r($this->sisfield_arr);

//Formulario de despliegue de campos

      $this->form_format_tabla($table,$DB_gogess);

	   foreach ($this->sisfield_arr as $campos) {

	 

		   //--------------------------------------

		    if(trim($campos["tab_name"])==trim($table) && trim($campos["fie_active"])==1 &&  trim($campos["fie_guarda"])==trim(1))

	            {

					

				

				      //----------------------------------------------

					  echo '<div id='.$campos["fie_name"] .'_div >';

					  echo "<table border='0' cellspacing='3' cellpadding='2'>";

					  $this->campo_gogess($table,$campos["fie_name"],$DB_gogess);

					  

					  if($campos["fie_activarbuscador"]==1)

							{

							  $funcionbuscar="pop_up_pantalla('libreria/extra/buscardor.php','Buscar','".$campos["fie_tablabusca"]."','".$campos["fie_camposbusca"]."','".$campos["fie_campodevuelve"]."','".$campos["fie_name"]."',0,0,0)";

							  $boton_buscar='<input type="button" name="Submit" value="..."  onclick="'.$funcionbuscar.'" />';

							}

							else

							{

							   $boton_buscar='';

							}

							

							$opcionesconca=$boton_buscar;

							

					        $nombre_campo=strtolower($campos["fie_name"]);	

							

							$this->txtobligatorio='';

							if ($campos["fie_obl"])

							 {

								 

								   if (!($this->imprpt))

								   {

									   $this->txtobligatorio="<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FF0000;'>*</span>";

									}  

								 

							 }

							  

							//Despliega un campo

							//En caso de cambiar formato de campo manual

					if(trim(@$this->campos_formatoc[$campos["fie_name"]]))

					{

					  $campos["fie_typeweb"]=trim($this->campos_formatoc[$campos["fie_name"]]);

					}

                    //En caso de cambiar formato de campo manual

					

					

					if ($campos["fie_typeweb"])

					{

					  if (!($this->imprpt))

	   					{

				  	     

						 include($this->pathexterno."libreria/campos/".$campos["fie_typeweb"].".php");

						 

						}

						else

						{

						  include($this->pathexternoimp."libreria/campos/".$campos["fie_typeweb"].".php");

						  

						}  

					}

					else

					{

					

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."libreria/campos/default.php");

						}

						else

						{

						  include($this->pathexternoimp."libreria/campos/default.php");

						} 

					

					}

					//--------------------------------------

				echo '</table>';

		        echo '</div>';

				

	            }

	   } 

	   

  

//Fin Formulario despliegue campso

}





/**

 * Funcion para crear el formulario.

 * 

 * Crear el formulario.

 * 

 * @param string $table el nombre de la tabla string $campo el nombre del campo .

 * @return despliegua el formulario con css.

 */	

function generar_formulario_css($submit,$table,$DB_gogess)

{



//print_r($this->sisfield_arr);

//Formulario de despliegue de campos

      $this->form_format_tabla($table,$DB_gogess);

	   foreach ($this->sisfield_arr as $campos) {

	 

		   //--------------------------------------

		    if(trim($campos["tab_name"])==trim($table) && trim($campos["fie_active"])==1 &&  trim($campos["fie_guarda"])==trim(1))

	            {

					

				echo '#'.$campos["fie_name"].'_div { top:'.$campos["fie_y"].'px; left:'.$campos["fie_x"].'px;

			 position: absolute;

			

			  }

			 ';

		   //--------------------------------------

				

	            }

	   } 

	   

  

//Fin Formulario despliegue campso

}







/**

 * Funcion para crear el formulario.

 * 

 * Crear el formulario.

 * 

 * @param string $table el nombre de la tabla string $campo el nombre del campo .

 * @return despliegua el formulario.

 */	

function generar_formulario($submit,$table,$grupof,$DB_gogess)

{

//print_r($this->sisfield_arr);
//Formulario de despliegue de campos

 $this->form_format_tabla($table,$DB_gogess);

	   foreach ($this->sisfield_arr as $campos) {

	 

		    if(trim($campos["tab_name"])==trim($table) && trim($campos["fie_active"])==1 &&  trim($campos["fie_group"])==trim($grupof))

	            {

					

				

	                  //----------------------------------------------

					  

					  $this->campo_gogess($table,$campos["fie_name"],$DB_gogess);

					  

					  if($campos["fie_activarbuscador"]==1)

							{

							  $funcionbuscar="pop_up_pantalla('libreria/extra/buscardor.php','Buscar','".$campos["fie_tablabusca"]."','".$campos["fie_camposbusca"]."','".$campos["fie_campodevuelve"]."','".$campos["fie_name"]."',0,0,0)";

							  $boton_buscar='<input type="button" name="Submit" value="..."  onclick="'.$funcionbuscar.'" />';

							}

							else

							{

							   $boton_buscar='';

							}

							

							$opcionesconca=$boton_buscar;

							

					        $nombre_campo=strtolower($campos["fie_name"]);	
$this->ncamponombre='';
							$this->ncamponombre=$nombre_campo;

							$this->txtobligatorio='';

							if ($campos["fie_obl"])

							 {

								 

								   if (!($this->imprpt))

								   {

									   $this->txtobligatorio="<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FF0000;'>*</span>";

									}  

								 

							 }

							  

							//Despliega un campo

							//En caso de cambiar formato de campo manual

					if(trim(@$this->campos_formatoc[$campos["fie_name"]]))

					{

					  $campos["fie_typeweb"]=trim($this->campos_formatoc[$campos["fie_name"]]);

					}

                    //En caso de cambiar formato de campo manual

//echo $campos["fie_typeweb"];
					

					if ($campos["fie_typeweb"])

					{

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."libreria/campos/".$campos["fie_typeweb"].".php");

						 

						}

						else

						{

						  include($this->pathexternoimp."libreria/campos/".$campos["fie_typeweb"].".php");

						  

						}  

					}

					else

					{

					

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."libreria/campos/default.php");

						}

						else

						{

						  include($this->pathexternoimp."libreria/campos/default.php");

						} 

					

					}

						printf("\n");

					     

					 //-----------------------------------------------

	            }

	   } 

	   


//Fin Formulario despliegue campso

}



/**

 * Funcion para crear el formulario.

 * 

 * Crear el formulario y genera por campo solo

 * 

 * @param string $table el nombre de la tabla string $campo el nombre del campo .

 * @return despliegua el formulario.

 */	

function generar_formulario_campossolos($table,$campo,$DB_gogess)

{

//Formulario de despliegue de campos

   $this->form_format_tabla($table,$DB_gogess);

	   if ($this->tab_formatotabla)

	   {

          printf("<table border='0' cellspacing='3' cellpadding='0'>");

	   }

	   

	   foreach ($this->sisfield_arr as $campos) {

	        if(trim($campos["tab_name"])==$table &&  trim($campos["fie_active"])==1 &&  trim($campos["fie_id"])==$campo)

	            {

	                  //----------------------------------------------

					  

					  $this->campo_gogess($table,$campos["fie_name"],$DB_gogess);

					  

					  if($campos["fie_activarbuscador"]==1)

							{

							  $funcionbuscar="pop_up_pantalla('libreria/extra/buscardor.php','Buscar','".$campos["fie_tablabusca"]."','".$campos["fie_camposbusca"]."','".$campos["fie_campodevuelve"]."','".$campos["fie_name"]."',0,0,0)";

							  $boton_buscar='<input type="button" name="Submit" value="..."  onclick="'.$funcionbuscar.'" />';

							}

							else

							{

							   $boton_buscar='';

							}

							

							$opcionesconca=$boton_buscar;

							

					        $nombre_campo=strtolower($campos["fie_name"]);	

							

							

							if ($campos["fie_obl"])

							 {

								 

								   if (!($this->imprpt))

								   {

									   $this->txtobligatorio="<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FF0000;'>*</span>";

									}  

								 

							 }

							  

							//Despliega un campo

							

					

					

					if ($campos["fie_typeweb"])

					{

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."libreria/campos/".$campos["fie_typeweb"].".php");

						}

						else

						{

						  include($this->pathexternoimp."libreria/campos/".$campos["fie_typeweb"].".php");

						}  

					}

					else

					{

					

					  if (!($this->imprpt))

	   					{

				  	      include($this->pathexterno."libreria/campos/default.php");

						}

						else

						{

						  include($this->pathexternoimp."libreria/campos/default.php");

						} 

					

					}

							

					     

					 //-----------------------------------------------

	            }

	   } 

	   

	  if ($this->tab_formatotabla)

	  {

        printf("</table>");

      }

 

  

//Fin Formulario despliegue campso

}





/**

 * Funcion para guardar formulario.

 * 

 * Guarda el formulario

 * 

 * @param string $table el nombre de la tabla string $_POSTX los datos en formato POST $campo el nombre del campo .

 * @return despliegua el formulario.

 */	





function formulario_guardar($table,$_POSTX,$typesql,$listab,$campo,$obp,$DB_gogess)

{

   $_POST=$_POSTX;

  //--------

	  foreach ($this->sisfield_arr as $campos) {	  	

		if(trim($campos["tab_name"])==$table &&  trim($campos["fie_active"])==1 && trim($campos["fie_guarda"])==1)

			{

			    //echo $campos["fie_name"];

				$tab_namesql=$campos["tab_name"];

		        $fie_namesql=$campos["fie_name"];

				$this->campo_gogess($tab_namesql,$fie_namesql,$DB_gogess);

				$typeSql  =$this->field_type;

		        $flags = $this->field_flags;

		        $autoincrement = strstr ($flags, 'auto_increment');

				

				$pka = strstr ($flags, 'primary');			      

				   if ($pka)

					{

					   $ncampoid=$fie_namesql;

					 }  

				

				if (!($autoincrement))

                 {

				     //if---------------

					 @$sqlcampos=@$sqlcampos.",".$fie_namesql;						 

					 switch ($typeSql) 

						{

						//----------------------------------------------						

						 case "int":

						  {

								 if (@$_POST[$fie_namesql])

								 {	  

								    @$sqlvalues=@$sqlvalues.",".$_POST[$fie_namesql];   

								 }

								 else

								 {

								   @$sqlvalues=$sqlvalues.",0";  

								 } 

						   }

						  break;

						  

						   case "date":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  @$sqlvalues=$sqlvalues.",'".$_POST[$fie_namesql]."'";   

							 }

							 else

							 {

							   @$sqlvalues=$sqlvalues.",NULL";  

							 } 

						   }

						  break; 

						  

						  case "time":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  @$sqlvalues=$sqlvalues.",'".$_POST[$fie_namesql]."'";   

							 }

							 else

							 {

							   @$sqlvalues=$sqlvalues.",NULL";  

							 } 

						   }

						  break;

						  

						 case "real":

						  {

							if ($_POST[$fie_namesql])

							{

							 @$sqlvalues=$sqlvalues.",".$_POST[$fie_namesql];

							 }

							 else

							 {

							 @$sqlvalues=$sqlvalues.",0";

							 }

						   }

						  break;

						  						

						 default:

							{

								switch ($this->fie_type) 

										{

												 case "checkboxmul":

												  {   

														   $icheck=0;

														   $valorcheck='';

														  /////////////////////////////////////////////////

															   $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

															   $rs_gogess1 = $DB_gogess->executec($sqlchek);															 

															   $icheck=1;

															   while (!$rs_gogess1->EOF) 

																	{	

																	  if (@$_POST[$fie_namesql.$icheck])
                                                                         {

																		   $valorcheck=$valorcheck.@$_POST[$fie_namesql.$icheck].",";

																		  }

																		  else

																		  {

																		  $valorcheck=$valorcheck."0".",";

																		  }																	 

																		  $icheck++;																		 

																		  $rs_gogess1->MoveNext();

																	}

																	

															$sqlvalues=$sqlvalues.",'".$valorcheck."'";	

														  ////////////////////////////////////////////////					                 

												   }

												   break;

												 case "password":

												  {   

														$textoformateado=md5($_POST[$fie_namesql]);

														$sqlvalues=$sqlvalues.",'".$textoformateado."'";						                 

												  }

												   break;

												 default:

													{

													 $textoformateado=$this->textorraro($_POST[$fie_namesql]);

													 @$sqlvalues=@$sqlvalues.",'".@$textoformateado."'";

													}	 

												break;

										  }

								

							}

						   break;					

						//----------------------------------------------

						}			 

					 //if---------------

				 }			 

			} 

			 

	  }

	  //--------

  

  

   $sql_1="insert into ".$table." (".substr ("$sqlcampos",1).") values (".substr ("$sqlvalues",1).")";

   $sql_bluque=$sql_1;

//echo $sql_1;

  //$this->essri;

 //$this->camposri;

   

   if($this->essri==1)
   {

         ///secuencial sri

	    $nfactura_num=$this->numero_secuencial($this->camposri,$table,$DB_gogess);

		if($nfactura_num=='1' or $nfactura_num=='2')
		{
			  $this->mensajelote=$nfactura_num;
			  $this->okinsertado=0;
		}
		else
		{
		//--------------------------------------------------------
	           $sql_1=str_replace("-documento-",$nfactura_num,$sql_1);
				//echo $sql_1;
			   $this->okinsertado=0; 
			   $ok=$DB_gogess->executec($sql_1,array());
			   $this->nuevoid=$DB_gogess->funciones_nuevoID(@$_POST[$ncampoid]);
			   if ($ok) 
			   {
				  $this->okinsertado=1;	  
				  $this->mensajelote=$nfactura_num;
			   }  
			   else 
			   {
				  $this->okinsertado=0;	 
					 do
					{
						 $nfactura_num=$this->numero_secuencial($this->camposri,$table,$DB_gogess);
						 if($nfactura_num=='1' or $nfactura_num=='2')
	                       {
						      $this->mensajelote=$nfactura_num;
							  $this->okinsertado=0;
							  $ok=1;
						   }
						 else
						   {
								  $sql_1=$sql_bluque;
								  $sql_1=str_replace("-documento-",$nfactura_num,$sql_1);
								  $ok=$DB_gogess->executec($sql_1,array());
								  $this->nuevoid=$DB_gogess->funciones_nuevoID(@$_POST[$ncampoid]);
								 // echo $sql_1."<br>";
								   if ($ok) 
								   {
									  $this->okinsertado=1;	  
									  $this->mensajelote=$nfactura_num;	  
								   }
							   else
								   {
									 $this->okinsertado=0;	
								   }
						   }
					 }while (!($ok));
			   }

    //--------------------------------------------------------
		}

		 

         ////secuencial sri
		 
		 

   }
   else
   {

		   
		   if($this->tab_historialmedico==1)
		   {
		   
		     
			       $nfactura_num=$this->numero_secuencialhc($_POST["clie_ci"],$this->camposri,$table,$DB_gogess);
				   if($nfactura_num=='1' or $nfactura_num=='2')
					{
						  $this->mensajelote=$nfactura_num;
						  $this->okinsertado=0;
					}
					else
					{
				//--------------------------------------------------------
					   $sql_1=str_replace("-documento-",$nfactura_num,$sql_1);
						//echo $sql_1;
					   $this->okinsertado=0; 
					   $ok=$DB_gogess->executec($sql_1,array());
					   $this->nuevoid=$DB_gogess->funciones_nuevoID(@$_POST[$ncampoid]);
					   if ($ok) 
					   {
						  $this->okinsertado=1;	  
						  $this->mensajelote=$nfactura_num;
					   }  
					   else 
					   {
						  $this->okinsertado=0;	 
							 do
							{
								 $nfactura_num=$this->numero_secuencialhc($_POST["clie_ci"],$this->camposri,$table,$DB_gogess);
								 if($nfactura_num=='1' or $nfactura_num=='2')
								   {
									  $this->mensajelote=$nfactura_num;
									  $this->okinsertado=0;
									  $ok=1;
								   }
								 else
								   {
										  $sql_1=$sql_bluque;
										  $sql_1=str_replace("-documento-",$nfactura_num,$sql_1);
										  $ok=$DB_gogess->executec($sql_1,array());
										  $this->nuevoid=$DB_gogess->funciones_nuevoID(@$_POST[$ncampoid]);
										 // echo $sql_1."<br>";
										   if ($ok) 
										   {
											  $this->okinsertado=1;	  
											  $this->mensajelote=$nfactura_num;	  
										   }
									   else
										   {
											 $this->okinsertado=0;	
										   }
								   }
							 }while (!($ok));
					   }
			//--------------------------------------------------------
					  }
			   
			   
			   
		   
		   }
		   else
		   {
		   
		   //insertado normal
		   $this->okinsertado=0; 
		   $ok=$DB_gogess->executec($sql_1,array());
		   $this->nuevoid=$DB_gogess->funciones_nuevoID($_POST[$ncampoid]);
		   if ($ok) 
		   {
			$this->okinsertado=1;	  
		   }  
		   else 
		   {
			 $this->okinsertado=0;	   
		   }
		   //insertado normal
		   }

   

   }

   

   

}

/**

 * Funcion para actualizar formulario.

 * 

 * Actualiza el formulario

 * 

 * @param string $table el nombre de la tabla string $_POSTX los datos en formato POST $campo el nombre del campo .

 * @return despliegua el formulario.

 */	



function formulario_update($table,$_POSTX,$typesql,$ids,$listab,$campo,$obp,$DB_gogess)

{

  $_POST=$_POSTX; 



  foreach ($this->sisfield_arr as $campos) {	  	

		if(trim($campos["tab_name"])==$table &&  trim($campos["fie_active"])==1 && trim($campos["fie_guarda"])==1)

			{

			      $tab_namesql=$campos["tab_name"];

				  $fie_namesql=$campos["fie_name"];				  		  

				  $this->campo_gogess($tab_namesql,$fie_namesql,$DB_gogess);				  

				  $typeSql  =$this->field_type;

				  $flags = $this->field_flags;

				  $autoincrement = strstr ($flags, 'auto_increment');		

				  $pka = strstr ($flags, 'primary');			      

				   if ($pka)

					{

					   $ncampoid=$fie_namesql;

						 switch ($typeSql) 

									{

											 case "int":

											  {   

													$operator="=";							                 

											   }

											   break;

											 case "real":

											  {   

													$operator="=";							                 

											  }

											  break;

											  default:

												$operator="like";

												break;

									  }

					}	

					//-----------------------

					if (!($autoincrement))

                     {

					 

					      switch ($typeSql) 

				           {						     

							  case "int":

								  {  

									//En caso de error en datos

									   if (@$_POST[$fie_namesql])

										   {

											@$sqlvalues=@$sqlvalues.",".$fie_namesql."=".$_POST[$fie_namesql];   

										   }

										else

											{

											@$sqlvalues=@$sqlvalues.",".$fie_namesql."=0";

											}

								   }

								break;	

								

								 case "real":

				  {         

					 if ($_POST[$fie_namesql])

					 {

					   $sqlvalues=$sqlvalues.",".$fie_namesql."=".$_POST[$fie_namesql];

					 }

					 else

					 {

					   $sqlvalues=$sqlvalues.",".$fie_namesql."=0";

					 }

				   }

				  break;

				  

				   case "date":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  $sqlvalues=$sqlvalues.",".$fie_namesql."='".$_POST[$fie_namesql]."'";   

							 }

							 else

							 {

							   $sqlvalues=$sqlvalues.",".$fie_namesql."=NULL";  

							 } 

						   }

						  break; 

						  

						  case "time":

						  {

							if ($_POST[$fie_namesql])

							{	  

							  $sqlvalues=$sqlvalues.",".$fie_namesql."='".$_POST[$fie_namesql]."'";  

							 }

							 else

							 {

							   $sqlvalues=$sqlvalues.",".$fie_namesql."=NULL"; 

							 } 

						   }

						  break;

								

								

								 default:

										{

										

										$icheck=0;

										   $valorcheck='';

										/////////////////////////////////////////////////////////////////////////////

										switch ($this->fie_type) 

												{

														 case "checkboxmul":

														  {   

																		 /////////////////////////////////////////////////																

																		 

																		   $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;

																		   $rs_gogess1 = $DB_gogess->executec($sqlchek,array());															 

																		   $icheck=1;

																		   while (!$rs_gogess1->EOF) 
                                                                            {	

																				  if (@$_POST[$fie_namesql.$icheck])
                                                                                  {

																				   $valorcheck=$valorcheck.$_POST[$fie_namesql.$icheck].",";

																				  }

																				  else

																				  {

																				  $valorcheck=$valorcheck."0".",";

																				  }

																				 

																				 $icheck++;

																				$rs_gogess1->MoveNext();

																			}

																			

																				

																			$sqlvalues=$sqlvalues.",".$fie_namesql."='".$valorcheck."'";

																	  ////////////////////////////////////////////////			                 

														   }

														   break;

														 case "password":

														  {   

															   if (strlen($_POST[$fie_namesql])<24)

															   {

																   $textoformateado=md5($_POST[$fie_namesql]);

																   $sqlvalues=$sqlvalues.",".$fie_namesql."='".$textoformateado."'";				

															   }                 

														  }

														   break;

														 default:

															{

															   @$textoformateado=$this->textorraro($_POST[$fie_namesql]);

															   @$sqlvalues=$sqlvalues.",".$fie_namesql."='".$textoformateado."'";							     

															}	 

														break;

												  }

					

						/////////////////////////////////////////////////////////////////////////////

										}

									   break;		

									   			   

						   }

					 

					 }

					//---------------------------

					

					

					 

			      

			

			}

	}


		   $sql_1="update ".$table." set ".substr ("$sqlvalues",1)." where ".$ids;  

		

//echo $sql_1;

   $this->okinsertado=0; 

   $ok=$DB_gogess->executec($sql_1,array());

   if ($ok) 

    {

      

	  $this->okinsertado=1;

	

	}

	else

	{

	

	   $this->okinsertado=0;

	 

	} 

	



}





/**

 * Funcion para borrar registro.

 * 

 * Borra registro seleccionado

 * 

 * @param string $table el nombre de la tabla string $_POSTX los datos en formato POST $campo el nombre del campo .

 * @return despliegua el formulario.

 */	



function formulario_delete($table,$idab,$listab,$campo,$obp,$DB_gogess)

{

  $selecTabla="select  * from ".$table.""." limit 1";

  

  $resultado = $DB_gogess->Execute($selecTabla);

  $ncampos = $resultado->FieldCount();

      

 

  $i = 0; 

while ($i < $ncampos) {



         

		

		 $fld=$resultado->FetchField($i);

	     $nombre_campo=strtolower($fld->name);

		 $type=$resultado->MetaType($fld->type);



         $this->campo_gogess($table,$nombre_campo,$DB_gogess);

		 $flags = $this->field_flags;

		  

    //$type  = mysql_field_type  ($resultado, $i);

	//$flags = mysql_field_flags($resultado, $i);	

	

	$pka = strstr ($flags, 'primary'); 

	if ($pka)

	{

	   $ncampoid=$nombre_campo;

	   switch ($type) 

									{

									     case "C":

									      {   

									        $operator="like";

							                 

									       }

										   break;

										 case "D":

									      {   

									        $operator="like";

							                 

									       }

										   break;

										    case "string":

									      {   

									        $operator="like";

							                 

									       }

										   break;

										 case "text":

									      {   

									        $operator="like";

							                 

									       }

      									 break;

										 case "I":

									      {   

									        $operator="=";

									       }

      									 break;



										case "N":

									      {   

										   $operator="=";

									       }

      									 break;

										 case "float":

									      {   

										   $operator="=";



									       }

      									 break;

										 case "bigint":

									      {   

									

                                          $operator="=";

									       }

      									 break;

										 case "tinyint":

									      {   

									      $operator="=";



									       }

      									 break;

										 case "smallint":

									      {   

										    $operator="=";

		 

									       }

      									 break;

										 case "mediumint":

									      {   

											$operator="=";

									       }

      									 break;									     										

										default:

									     $operator="=";

											break;

                                     }

	}



	$i++;

  }



  if ($operator=="like")

  {

   $sqlb="delete from ".$table." where ".$ncampoid." ".$operator." '".$idab."'";  

   }

   else

   {

   $sqlb="delete from ".$table." where ".$ncampoid." ".$operator." ".$idab;     

   }

   //echo $sqlb;



     //$result2 = mysql_query($sqlb);

	 $result2 = $DB_gogess->Execute($sqlb);

	 

	echo ' <div id="Layer1" style="position:absolute; left:184px; top:77px; width:152px; height:25px; z-index:1; font-size: 11px; font-family: Arial, Helvetica, sans-serif; font-weight: bold;"> Datos borrados...</div>';

	

}





/**

 * Funcion para buscar registro.

 * 

 * Buscar registro

 * 

 * @param string $table el nombre de la tabla string $csearch los datos a buscar $campo el nombre del campo .

 * @return despliegua el formulario.

 */	



function  formulario_buscar($table,$csearch,$listab,$campo,$obp,$DB_gogess)

{

  $selecTabla="select  * from ".$table." limit 1"; 



  $resultado = $DB_gogess->executec($selecTabla,array());  

  $i=0;

  $ncampos = $resultado->FieldCount();

  

  while ($i < $ncampos) {

  

    	

	

	$fld1=$resultado->FetchField($i);

	$nombre_campo=strtolower($fld1->name);

	$type=$resultado->MetaType($fld1->type);

    $this->existecampo=0;

    $this->campo_gogess($table,$nombre_campo,$DB_gogess);	

    $flags =$this->field_flags;

	//echo $nombre_campo."<br>";

    //$type  = mysql_field_type  ($resultado, $i);

	//$flags = mysql_field_flags($resultado, $i);	 

	//$nombre_campo  = mysql_field_name($resultado, $i);

	

	

	$primary = strstr ($flags, 'primary');  

	

	//Campos a desplegar

	   if ($this->existecampo)

   		{

            @$campos=$campos.",".$nombre_campo;

   		}

		

	if ($primary)

	{

	  $fieldsearch=$nombre_campo;	 

	  switch ($type) 

									{

									     case "C":

									      {   

									        $operator="like";

							                 

									       }

										  break; 

										  case "string":

									      {   

									        $operator="like";

							                 

									       }

										  break; 

										 case "varchar":

									      {   

									        $operator="like";

							                 

									       }

										   break;

										 case "text":

									      {   

									        $operator="like";

							                 

									       }

      									 break;

										 case "N":

									      {   

									        $operator="=";

									       }

      									 break;



										case "I":

									      {   

										   $operator="=";

									       }

      									 break;

										 case "float":

									      {   

										   $operator="=";



									       }

      									 break;

										 case "bigint":

									      {   

									

                                          $operator="=";

									       }

      									 break;

										 case "tinyint":

									      {   

									      $operator="=";



									       }

      									 break;

										 case "smallint":

									      {   

										    $operator="=";

		 

									       }

      									 break;

										 case "mediumint":

									      {   

											$operator="=";

									       }

      									 break;									     										

										default:

									     $operator="=";

											break;

                                     }

	}	   

	$i++;

  }

  if ($operator=="like")

  {

    $sqlsearch="select ".substr ("$campos",1)." from ".$table." where ".$fieldsearch." ".$operator." '".$csearch."'";  

  }	

 else

  {

	$sqlsearch="select ".substr ("$campos",1)." from ".$table." where ".$fieldsearch." ".$operator." ".$csearch;  

  }	

 //echo $sqlsearch;

 // $consulta1 = mysql_query($sqlsearch); 

$ncm =0;

  $consulta1 = $DB_gogess->executec($sqlsearch,array());

  

  if ($consulta1)

  {

  if ($csearch)

  {

    //$ncm = mysql_num_fields($consulta1);

	$ncm = $consulta1->FieldCount();

	

  }

  }

  $i=0;

  

  if ($consulta1)

  {

	    while (!$consulta1->EOF)

		 {

           $arreglocampos=$consulta1->fields;

            while ($i < $ncm) {



					$fldx=$consulta1->FetchField($i);

	                $nombre_campo=strtolower($fldx->name);

		 

					//$nombre_campo  = mysql_field_name($consulta1, $i);

					$this->contenid[$nombre_campo]= utf8_encode($arreglocampos[$nombre_campo]);

					

					//echo $nombre_campo."=".$this->contenid[$nombre_campo]."<br>";

                    $i++;

					$this->dedatos=1;



             {

			 

			 $consulta1->MoveNext();

			

     	}

		

	

   }

 //print_r($this->contenid);



//$consulta1 = mysql_query($sqlsearch); 

$consulta1 = $DB_gogess->executec($sqlsearch,array());



  if ($consulta1)

  {

	    while (!$consulta1->EOF) 

		{

		//	printf("<SCRIPT LANGUAGE=javascript>\n<!--\n");		

			//printf ("function despl()\n{");		

			$i=0;

			while ($i < $ncampos) {



			

			  //$nombre_campo  = mysql_field_name($resultado, $i); 

			  //$flags = mysql_field_flags($resultado, $i);	

			  $nombre_campo='';

			  $type='';

			    $fld1=$consulta1->FetchField($i);

				@$nombre_campo=strtolower($fld1->name);

				@$type=$consulta1->MetaType($fld1->type);

			  $this->existecampo=0;

				$this->campo_gogess($table,$nombre_campo,$DB_gogess);	

				$flags =$this->field_flags;

			  

			  

			  if ($this->existecampo)

   		       {

			     if (@$this->fie_typeweb=="select")

				    {

					 //printf("cargarcombo('window.document.fa.%s' ,'%s')\n",$nombre_campo,chop($resultado1[$nombre_campo]));					 			

					  $pk = strstr ($flags, 'primary');

					  if ($pk)

					  {

					     //printf("\nwindow.document.fa.idab.value='%s'\n",str_replace ("\n","+",quotemeta(chop($consulta1->fields[$this->maymin($nombre_campo)]))));

					  }

					  

					}

					else

					{					  

					 $pk = strstr ($flags, 'primary');

					  if ($pk)

					  {

					     //printf("\nwindow.document.fa.idab.value='%s'\n",chop($consulta1->fields[$this->maymin($nombre_campo)]));

					  }	

									 

					}                 

			   }

			   $i++; 

			}

			

			

			 $consulta1->MoveNext();

			

	     }    

   }





}

}

}







}



?>