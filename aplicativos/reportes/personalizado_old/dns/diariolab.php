<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");


$objformulario= new  ValidacionesFormulario();

//echo $_POST["fecha_inicio"];
//echo $_POST["fecha_fin"];
$lista_estu=array();

$lista_tarifa=array();

//print_r($lista_estu);
  $cuenta_lis=0;
  $lista_nombres="select distinct * from pichinchahumana_reportes.lista_labtarifario where usua_id='".$_POST["usua_id"]."'";
  $rs_lnombres = $DB_gogess->executec($lista_nombres,array());
  if($rs_lnombres)
  {
     	while (!$rs_lnombres->EOF) {
		
		$lista_tarifa[$cuenta_lis]["prod_codigo"]=$rs_lnombres->fields["prod_codigo"];
		$lista_tarifa[$cuenta_lis]["prod_descripcion"]=$rs_lnombres->fields["prod_descripcion"];
		$cuenta_lis++;
				
		
		$rs_lnombres->MoveNext();	
		}
	}	

//print_r($lista_tarifa);

//busca datos
  $lista_tarifax=array();
  $cuenta_lisx=0;
  $lista_nombresx="select * from pichinchahumana_reportes.lista_clientelabtarifario where usua_id='".$_POST["usua_id"]."' and (cuabas_fecharegistro>='".$_POST["fecha_inicio"]." 00:00:00' and cuabas_fecharegistro<='".$_POST["fecha_inicio"]." 23:59:59')";
  $rs_lnombresx = $DB_gogess->executec($lista_nombresx,array());
  if($rs_lnombresx)
  {
     	while (!$rs_lnombresx->EOF) {
		
		$lista_tarifax[$cuenta_lisx]["prod_codigo"]=$rs_lnombresx->fields["prod_codigo"];
		$lista_tarifax[$cuenta_lisx]["prod_descripcion"]=$rs_lnombresx->fields["prod_descripcion"];
		$lista_tarifax[$cuenta_lisx]["clie_id"]=$rs_lnombresx->fields["clie_id"];
		
		$cuenta_lisx++;
				
		
		$rs_lnombresx->MoveNext();	
		}
	}	

//print_r($lista_tarifax);
?>
<div id="dvData">
<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_listat2 {font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.verticalText {
writing-mode: vertical-lr;
    transform: rotate(90deg);
	font-size:9px;
	margin-right: 30%;
	margin-left: 30%;
}
-->
</style>
<table width="1000" border="1" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
	<td class="css_listat">&nbsp;</td>
    <td colspan="5" class="css_listat">BENEFICIARIO</td>
    <td colspan="2" class="css_listat">SEXO</td>
    <td colspan="5" class="css_listat">EDAD</td>
    <td colspan="<?php echo $cuenta_lis+1; ?>" class="css_listat">&nbsp;</td>
  </tr>
  
  <tr>
    <td class="css_listat">No</td>
	<td nowrap="NOWRAP" class="css_listat">APELLIDOS y NOMBRES</td>
    <td nowrap="NOWRAP" class="css_listat">HISTORIA CLINICA </td>
    <td nowrap="nowrap" class="css_listat" >S. ACTIVO</td>
    <td nowrap="nowrap" class="css_listat">S. PASIVO</td>
    <td nowrap="nowrap" class="css_listat">MONTEPIO</td>
    <td nowrap="nowrap" class="css_listat">DEPENDIENTE </td>
    <td nowrap="nowrap" class="css_listat">NO APLICA</td>
    <td nowrap="nowrap" class="css_listat">HOMBRE</td>
    <td nowrap="nowrap" class="css_listat">MUJER</td>
    <td nowrap="nowrap" class="css_listat">1 - 4 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">5 - 14 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">15 - 24 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">25 - 44 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">45 A&Ntilde;OS Y MAS</td>
	<?php 
	  for($i=0;$i<count($lista_tarifa);$i++)
	  {
	    echo '<td  class="css_listat2">'.$lista_tarifa[$i]["prod_descripcion"].'</td>';
	  
	  }
	  echo '<td  class="css_listat2">TOTAL EXAMENES</td>';
	?>
   
  </tr>
 <?php
$cuenta_sql="select id_tbl,tabla,clie_id,usua_id,prenatal_p,prenatal_s,parto,postparto,planificacion_p,planificacion_s,uterino,mamario,fecharegistro,enlace,situ_id,clie_fechanacimiento,clie_apellido,clie_nombre,clie_rucci,clie_genero from pichinchahumana_reportes.registro_diario where (fecharegistro>='".$_POST["fecha_inicio"]." 00:00:00' and fecharegistro<='".$_POST["fecha_inicio"]." 23:59:59') and usua_id='".$_POST["usua_id"]."' and tabla in ('dns_laboratorio','dns_laboratorioinforme','dns_histopatologia')";	

$cntadores_code=array();
$numera=0;
 $rs_gogessform = $DB_gogess->executec($cuenta_sql,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		$cuenta_totales=0;
		$numera++;
		  // $busca_data_cliente="select * from app_cliente where clie_id='".$rs_gogessform->fields["clie_id"]."'";	
		  // $rs_cliente = $DB_gogess->executec($busca_data_cliente,array());
		   
		   
		   $sactivo='';
		   $spasivo='';
		   $montepio='';
		   $dependiente='';
		   $noaplica='';
		   if($rs_gogessform->fields["situ_id"]==1)
		   {
		      $sactivo='x';
		   
		   }
		    if($rs_gogessform->fields["situ_id"]==2)
		   {
		      $spasivo='x';
		   
		   }
		   
		   if($rs_gogessform->fields["situ_id"]==3)
		   {
		      $montepio='x';
		   
		   }
		   
		   if($rs_gogessform->fields["situ_id"]==4)
		   {
		      $dependiente='x';
		   
		   }
		   
		   if($rs_gogessform->fields["situ_id"]==5)
		   {
		      $noaplica='x';		   
		   }
		   
		   $hombre='';
		   if($rs_gogessform->fields["clie_genero"]=='M')
		   {
		     $hombre='x';
		   }
		   $mujer='';
		   if($rs_gogessform->fields["clie_genero"]=='F')
		   {
		      $mujer='x';
		   }
		   
		   
		   $prenatal_p='';
		   if($rs_gogessform->fields["prenatal_p"]=='1')
		   {
		      $prenatal_p='x';
		   }
		   
		   $prenatal_s='';
		   if($rs_gogessform->fields["prenatal_s"]=='1')
		   {
		      $prenatal_s='x';
		   }
		   
		   
		   $parto='';
		   if($rs_gogessform->fields["parto"]=='1')
		   {
		      $parto='x';
		   }
		   
		   $postparto='';
		   if($rs_gogessform->fields["postparto"]=='1')
		   {
		      $postparto='x';
		   }
		   //------------------------------------
		   
		   $planificacion_p='';
		   if($rs_gogessform->fields["planificacion_p"]=='1')
		   {
		      $planificacion_p='x';
		   }
		   
		   $planificacion_s='';
		   if($rs_gogessform->fields["planificacion_s"]=='1')
		   {
		      $planificacion_s='x';
		   }
		   //--------------------------------------
		   $uterino='';
		   if($rs_gogessform->fields["uterino"]=='1')
		   {
		      $uterino='x';
		   }
		   
		   $mamario='';
		   if($rs_gogessform->fields["mamario"]=='1')
		   {
		      $mamario='x';
		   }
		   //----------------------EDAD
		   $edad_alafechar=array();
		   $fechan=$rs_gogessform->fields["clie_fechanacimiento"];
		   $fechafin=$rs_gogessform->fields["fecharegistro"];
		   $edad_alafechar=calcular_edad($fechan,$fechafin);
		   
		   
		   //primera vez
		    $menur1anio_p='';
			$de1a4_p='';
			$aten_primera='';
		   if($rs_gogessform->fields["tabla"]=='dns_anamesisexamenfisico' or $rs_gogessform->fields["tabla"]=='dns_imagenologiainfo' or $rs_gogessform->fields["tabla"]=='dns_odontologia' or $rs_gogessform->fields["tabla"]=='dns_procediminetosinvasivos' or $rs_gogessform->fields["tabla"]=='dns_psicologia' or $rs_gogessform->fields["tabla"]=='dns_referencia' or $rs_gogessform->fields["tabla"]=='dns_interconsulta' or $rs_gogessform->fields["tabla"]=='dns_prehospitalario' or $rs_gogessform->fields["tabla"]=='dns_histopatologia' or $rs_gogessform->fields["tabla"]=='dns_laboratorio' or $rs_gogessform->fields["tabla"]=='dns_imagenologia' or $rs_gogessform->fields["tabla"]=='dns_enfermeria' or $rs_gogessform->fields["tabla"]=='dns_laboratorioinforme' or $rs_gogessform->fields["tabla"]=='dns_fisioterapia' or $rs_gogessform->fields["tabla"]=='dns_visitadomiciliaria')
		   {
		   
		      if($edad_alafechar["anio"]<1)
			  {
			     $menur1anio_p='x';
			  }
			  
			  
			  if($edad_alafechar["anio"]>=1 and $edad_alafechar["anio"]<=4)
			  {
			     $de1a4_p='x';
			  }
			  
		      $aten_primera='x';
		   }
		   
		   



		   $menur1anio_s='';
		   $de1a4_s='';
		   $aten_subsecuente='';
		   if($rs_gogessform->fields["tabla"]=='dns_consultaexterna' or $rs_gogessform->fields["tabla"]=='dns_subsecuenteodontologia' or $rs_gogessform->fields["tabla"]=='dns_subsecuentepsicologia' or $rs_gogessform->fields["tabla"]=='dns_regfisioterapia')
		   {
		   
		       if($edad_alafechar["anio"]<1)
			   {
			     $menur1anio_s='x';
			   }
			   
			   if($edad_alafechar["anio"]>=1 and $edad_alafechar["anio"]<=4)
			  {
			     $de1a4_s='x';
			  }
		      
			  $aten_subsecuente='x';
		   }
		   	   
		   //subsecuente	    

           //general
		   $de5a14anios='';
		   if($edad_alafechar["anio"]>=5 and $edad_alafechar["anio"]<=14)
			  {
			     $de5a14anios='x';
			  }
		   
		   $ado10a14anios='';
		   if($edad_alafechar["anio"]>=10 and $edad_alafechar["anio"]<=14)
			  {
			     $ado10a14anios='x';
			  }


           $ado15a19anios='';
		   if($edad_alafechar["anio"]>=15 and $edad_alafechar["anio"]<=19)
			  {
			     $ado15a19anios='x';
			  }

          $mayorigual20='';
		  if($edad_alafechar["anio"]>=20)
			  {
			     $mayorigual20='x';
			  }

          $menoraunmes='';
		  if($edad_alafechar["anio"]==0 and $edad_alafechar["mes"]<1)
			  {
			     $menoraunmes='x';
			  }
  
          $de1a11meses='';
		  if($edad_alafechar["anio"]==0 and ($edad_alafechar["mes"]>=1 and $edad_alafechar["mes"]<=11))
			  {
			     $de1a11meses='x';
			  }
			
		   $deunoa4anios='';
		   if($edad_alafechar["anio"]>=1 and $edad_alafechar["anio"]<=4)
			  {
			     $deunoa4anios='x';
			  }  

           $de5a14anios='';
		   if($edad_alafechar["anio"]>=5 and $edad_alafechar["anio"]<=14)
			  {
			     $de5a14anios='x';
			  }  

           $de10a14anios='';
		   if($edad_alafechar["anio"]>=10 and $edad_alafechar["anio"]<=14)
			  {
			     $de10a14anios='x';
			  }  
			  
		  $de15a24anios='';
		   if($edad_alafechar["anio"]>=15 and $edad_alafechar["anio"]<=24)
			  {
			     $de15a24anios='x';
			  } 
			  
		  $de25a44anios='';
		   if($edad_alafechar["anio"]>=25 and $edad_alafechar["anio"]<=44)
			  {
			     $de25a44anios='x';
			  }	
			  
		  $de36a49anios='';
		   if($edad_alafechar["anio"]>=36 and $edad_alafechar["anio"]<=49)
			  {
			     $de36a49anios='x';
			  }	 
			  
		 $de50a64anios='';
		   if($edad_alafechar["anio"]>=50 and $edad_alafechar["anio"]<=64)
			  {
			     $de50a64anios='x';
			  }  
			  
		 $de45a1000anios='';
		   if($edad_alafechar["anio"]>=45)
			  {
			     $de45a1000anios='x';
			  }  	     	  
		  

	
 ?> 
  <tr>
    <td class="css_listat"><?php echo $numera; ?></td>
	<td nowrap="NOWRAP" class="css_listat"><?php echo utf8_encode($rs_gogessform->fields["clie_apellido"]." ".$rs_gogessform->fields["clie_nombre"]); ?></td>
	<td nowrap="NOWRAP" class="css_listat"><?php echo utf8_encode($rs_gogessform->fields["clie_rucci"]); ?></td>    
    <td nowrap="nowrap" class="css_listat" ><?php echo $sactivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $spasivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $montepio; ?></td>
	<td nowrap="nowrap" class="css_listat"><?php echo $dependiente; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $noaplica; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $hombre; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $mujer; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $deunoa4anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de5a14anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de15a24anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de25a44anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de45a1000anios; ?></td>
	<?php 
	
	  for($i=0;$i<count($lista_tarifa);$i++)
	  {
	    $cuenta_enc=0;
		for($z=0;$z<count($lista_tarifax);$z++)
		{
		    if(($rs_gogessform->fields["clie_id"]==$lista_tarifax[$z]["clie_id"]) and ($lista_tarifa[$i]["prod_codigo"]==$lista_tarifax[$z]["prod_codigo"]))
			{
			   $cuenta_enc++;
			   $cntadores_code[$lista_tarifa[$i]["prod_codigo"]]++;
			   $cuenta_totales++;
			}
			
			//$lista_tarifax[$z]["prod_codigo"]=$rs_lnombresx->fields["prod_codigo"];
		    //$lista_tarifax[$z]["prod_descripcion"]=$rs_lnombresx->fields["prod_descripcion"];
		    //$lista_tarifax[$z]["clie_id"]=$rs_lnombresx->fields["clie_id"];
		}	
	    echo '<td  nowrap="nowrap" class="css_listat">'.$cuenta_enc.'</td>';
	  
	  }
	echo '<td  nowrap="nowrap" class="css_listat">'.$cuenta_totales.'</td>';
	?>
	
  </tr>
 <?php
        $cuenta_enc=0;
        $rs_gogessform->MoveNext();	
		}
 }
 ?> 
 
 
 <tr>
    <td class="css_listat"></td>
	<td nowrap="NOWRAP" class="css_listat"></td>
    <td nowrap="NOWRAP" class="css_listat"> </td>
    <td nowrap="nowrap" class="css_listat" ></td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"> </td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"></td>
    <td nowrap="nowrap" class="css_listat"></td>
	<?php 
	  $sumatodos_val=0;
	  for($i=0;$i<count($lista_tarifa);$i++)
	  {
	    echo '<td  class="css_listat2">'.$cntadores_code[$lista_tarifa[$i]["prod_codigo"]].'</td>';
	   
		$sumatodos_val=$sumatodos_val+$cntadores_code[$lista_tarifa[$i]["prod_codigo"]];
	  }
	  echo '<td  class="css_listat2">'.$sumatodos_val.'</td>';
	?>
   
  </tr>
 
</table>
</div>
<?php
}
?>