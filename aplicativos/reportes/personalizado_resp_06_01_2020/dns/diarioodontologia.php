<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
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

$saca_citas='select odonto_id as id_tbl,clie_id,dns_cuadrobasicoodontologia.usua_id,odonto_fecharegistro as fecharegistro,"dns_odontologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,dns_odontologia.odonto_enlace as enlace,prod_codigo,prod_descripcion from dns_odontologia left join dns_cuadrobasicoodontologia on dns_odontologia.odonto_enlace=dns_cuadrobasicoodontologia.odonto_enlace union 

		select subsecodont_id as id_tbl,clie_id,dns_tarifariosubsecuenteodonto.usua_id,subsecodont_fecharegistro as fecharegistro,"dns_subsecuenteodontologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,dns_subsecuenteodontologia.subsecodont_enlace as enlace,prod_codigo,prod_descripcion from dns_subsecuenteodontologia left join dns_tarifariosubsecuenteodonto on dns_subsecuenteodontologia.subsecodont_enlace=dns_tarifariosubsecuenteodonto.subsecodont_enlace
			
		';
		
$saca_citas='select odonto_id as id_tbl,clie_id,usua_id,odonto_fecharegistro as fecharegistro,"dns_odontologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,dns_odontologia.odonto_enlace as enlace,"dns_cuadrobasicoodontologia" as tblenlace,"odonto_enlace" as campoenlace from dns_odontologia union 

		select subsecodont_id as id_tbl,clie_id,usua_id,subsecodont_fecharegistro as fecharegistro,"dns_subsecuenteodontologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,dns_subsecuenteodontologia.subsecodont_enlace as enlace,"dns_tarifariosubsecuenteodonto" as tblenlace,"subsecodont_enlace" as campoenlace  from dns_subsecuenteodontologia			
		';		
	
	
$array_tratamiento=array();

//print_r($lista_estu);

?>

<table width="1200" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="9">&nbsp;</td>
    <td colspan="30"><div align="center" class="css_listat"></div></td>
  </tr>
  <tr>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
    <td colspan="5" class="css_listat"><div align="center">BENEFICIARIO</div></td>
    <td colspan="2" class="css_listat"><div align="center">SEXO</div></td>
    <td colspan="10" class="css_listat"><div align="center">GRUPOS DE EDAD</div></td>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
    <td colspan="2" class="css_listat"><div align="center">TIPO  DE ATENCION</div></td>
    <td colspan="16" class="css_listat"><div align="center">TRATAMIENTOS REALIZADOS </div></td>
  </tr>
  
  <tr>
    <td class="css_listat">No</td>
    <td nowrap="NOWRAP" class="css_listat">HISTORIA CLINICA </td>
    <td nowrap="nowrap" class="css_listat" >S. ACTIVO</td>
    <td nowrap="nowrap" class="css_listat">S. PASIVO</td>
    <td nowrap="nowrap" class="css_listat">MONTEPIO</td>
    <td nowrap="nowrap" class="css_listat">DEPENDIENTE </td>
    <td nowrap="nowrap" class="css_listat">NO APLICA</td>
    <td nowrap="nowrap" class="css_listat">HOMBRE</td>
    <td nowrap="nowrap" class="css_listat">MUJER</td>
    <td nowrap="nowrap" class="css_listat">MENOR  DE 1 MES</td>
    <td nowrap="nowrap" class="css_listat">1 - 11 MESES</td>
    <td nowrap="nowrap" class="css_listat">1 - 4 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">5 - 9 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">10 - 14 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">15 - 19 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">20 - 35 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">36 - 49 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">50 - 64 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">65 A&Ntilde;OS Y MAS</td>
    <td nowrap="nowrap" class="css_listat">DIAGN&Oacute;STICO O SINDROME SEG&Uacute;N C.I.E.</td>
    <td nowrap="nowrap" class="css_listat">CODIFICACION  DIAGN&Oacute;STICO</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">CONSULTA</td>
    <td nowrap="nowrap" class="css_listat">R. DEFINITIVAS</td>
    <td nowrap="nowrap" class="css_listat">PROFILAXIS</td>
    <td nowrap="nowrap" class="css_listat">SELLANTES</td>
    <td nowrap="nowrap" class="css_listat">FLUORIZACION</td>
    <td nowrap="nowrap" class="css_listat">EXODONCIA</td>
    <td nowrap="nowrap" class="css_listat">PROTESIS FIJA</td>
    <td nowrap="nowrap" class="css_listat">PROT. PARCIAL REMOVIBLE</td>
    <td nowrap="nowrap" class="css_listat">PROTESIS TOTAL</td>
    <td nowrap="nowrap" class="css_listat">CIRUG&Iacute;A ORAL</td>
    <td nowrap="nowrap" class="css_listat">PERIODONCIA</td>
    <td nowrap="nowrap" class="css_listat">ENDODONCIA</td>
    <td nowrap="nowrap" class="css_listat">AJUSTE OCLUSAL</td>
    <td nowrap="nowrap" class="css_listat">RAYOS X</td>
    <td nowrap="nowrap" class="css_listat">PLACA MIORRELAJANTE</td>
    <td nowrap="nowrap" class="css_listat">TOTAL</td>
  </tr>
 <?php
$cuenta_sql="select id_tbl,tabla,clie_id,usua_id,prenatal_p,prenatal_s,parto,postparto,planificacion_p,planificacion_s,uterino,mamario,fecharegistro,enlace,tblenlace,campoenlace from (".$saca_citas.") tbl where fecharegistro>='".$_POST["fecha_inicio"]." 00:00:00' and fecharegistro<='".$_POST["fecha_fin"]." 23:59:59' and usua_id='".$_POST["usua_id"]."'";	
$numera=0;
 $rs_gogessform = $DB_gogess->executec($cuenta_sql,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		$numera++;
		   $busca_data_cliente="select * from app_cliente where clie_id='".$rs_gogessform->fields["clie_id"]."'";	
		   $rs_cliente = $DB_gogess->executec($busca_data_cliente,array());
		   $sactivo='';
		   $spasivo='';
		   $montepio='';
		   $dependiente='';
		   $noaplica='';
		   if($rs_cliente->fields["situ_id"]==1)
		   {
		      $sactivo='x';
		   
		   }
		    if($rs_cliente->fields["situ_id"]==2)
		   {
		      $spasivo='x';
		   
		   }
		   
		   if($rs_cliente->fields["situ_id"]==3)
		   {
		      $montepio='x';
		   
		   }
		   
		   if($rs_cliente->fields["situ_id"]==4)
		   {
		      $dependiente='x';
		   
		   }
		   
		   if($rs_cliente->fields["situ_id"]==5)
		   {
		      $noaplica='x';		   
		   }
		   
		   $hombre='';
		   if($rs_cliente->fields["clie_genero"]=='M')
		   {
		     $hombre='x';
		   }
		   $mujer='';
		   if($rs_cliente->fields["clie_genero"]=='F')
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
		   $fechan=$rs_cliente->fields["clie_fechanacimiento"];
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
		   $de5a9anios='';
		   if($edad_alafechar["anio"]>=5 and $edad_alafechar["anio"]<=9)
			  {
			     $de5a9anios='x';
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

           $de5a9anios='';
		   if($edad_alafechar["anio"]>=5 and $edad_alafechar["anio"]<=9)
			  {
			     $de5a9anios='x';
			  }  

           $de10a14anios='';
		   if($edad_alafechar["anio"]>=10 and $edad_alafechar["anio"]<=14)
			  {
			     $de10a14anios='x';
			  }  
			  
		  $de15a19anios='';
		   if($edad_alafechar["anio"]>=15 and $edad_alafechar["anio"]<=19)
			  {
			     $de15a19anios='x';
			  } 
			  
		  $de20a35anios='';
		   if($edad_alafechar["anio"]>=20 and $edad_alafechar["anio"]<=35)
			  {
			     $de20a35anios='x';
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
			  
		 $de65a1000anios='';
		   if($edad_alafechar["anio"]>=65)
			  {
			     $de65a1000anios='x';
			  }  	     	  
		  
		  //diagnosticos
		  
		  $busca_tbldiagnositco="select * from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(1) and gogess_sistable.tab_name='".$rs_gogessform->fields["tabla"]."' and fie_type='campogrid'";
	
	       $rs_tbldiag = $DB_gogess->executec($busca_tbldiagnositco,array());
		   
		   $lista_diag="select * from ".$rs_tbldiag->fields["fie_tablasubgrid"]." where ".$rs_tbldiag->fields["fie_campoenlacesub"]."='".$rs_gogessform->fields["enlace"]."' limit 1";
	       $rs_diag = $DB_gogess->executec($lista_diag,array());
		   
		   $definitivo='';
		   if($rs_diag->fields["diagn_tipo"]=='DEFINITIVO')
		   {
		   $definitivo='x';
		   }
		   
		   $definitivocontrol='';
		   if($rs_diag->fields["diagn_tipo"]=='DEFINITIVO CONTROL')
		   {
		   $definitivocontrol='x';
		   }
		   
		   $presuntivo='';
		   if($rs_diag->fields["diagn_tipo"]=='PRESUNTIVO')
		   {
		   $presuntivo='x';
		   }
		   
	//echo $numera."-->".$edad_alafechar["anio"]."-->".$edad_alafechar["mes"];	   
	
	 //list
	 $consulta='';
	 $rdefinitivas='';
	 $profilaxis='';
	 $sellantes='';
	 $fluorizacion='';
	 $exodoncia='';
	 $protesisfija='';
	 $protesisparcial='';
	 $protesistotal='';
	 $cirujiaoral='';
	 $periodoncia='';
	 $endodoncia='';
	 $ajusteoclusal='';
	 $rayosx='';
	 $placam='';
	 $busca_tarifa="";
	 $busca_tarifa="select * from ".$rs_gogessform->fields["tblenlace"]." where ".$rs_gogessform->fields["campoenlace"]."='".$rs_gogessform->fields["enlace"]."'";
	 $rs_gbtarifa = $DB_gogess->executec($busca_tarifa,array());
     if($rs_gbtarifa)
     {
     	while (!$rs_gbtarifa->EOF) {
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200001')
		{
		  $consulta++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200300' or $rs_gbtarifa->fields["prod_codigo"]=='200305' or $rs_gbtarifa->fields["prod_codigo"]=='200310' )
		{
		  $rdefinitivas++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200100' )
		{
		  $profilaxis++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200311' )
		{
		  $sellantes++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200315' )
		{
		  $fluorizacion++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200050' or $rs_gbtarifa->fields["prod_codigo"]=='200055' or $rs_gbtarifa->fields["prod_codigo"]=='200060')
		{
		  $exodoncia++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200465' or $rs_gbtarifa->fields["prod_codigo"]=='200466' or $rs_gbtarifa->fields["prod_codigo"]=='200467' or $rs_gbtarifa->fields["prod_codigo"]=='200468')
		{
		  $protesisfija++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200420' or $rs_gbtarifa->fields["prod_codigo"]=='200425' or $rs_gbtarifa->fields["prod_codigo"]=='200435' or $rs_gbtarifa->fields["prod_codigo"]=='200440'  or $rs_gbtarifa->fields["prod_codigo"]=='200445' or $rs_gbtarifa->fields["prod_codigo"]=='200450'  or $rs_gbtarifa->fields["prod_codigo"]=='200455' or $rs_gbtarifa->fields["prod_codigo"]=='200460' )
		{
		  $protesisparcial++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200400' or $rs_gbtarifa->fields["prod_codigo"]=='200405' or $rs_gbtarifa->fields["prod_codigo"]=='200410' or $rs_gbtarifa->fields["prod_codigo"]=='200411'  or $rs_gbtarifa->fields["prod_codigo"]=='200412' or $rs_gbtarifa->fields["prod_codigo"]=='200413' )
		{
		  $protesistotal++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200357' or $rs_gbtarifa->fields["prod_codigo"]=='200360' or $rs_gbtarifa->fields["prod_codigo"]=='200363' or $rs_gbtarifa->fields["prod_codigo"]=='200366'  or $rs_gbtarifa->fields["prod_codigo"]=='200369' or $rs_gbtarifa->fields["prod_codigo"]=='200372' or $rs_gbtarifa->fields["prod_codigo"]=='200378' )
		{
		  $cirujiaoral++;
		}
		
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200105' or $rs_gbtarifa->fields["prod_codigo"]=='200110' or $rs_gbtarifa->fields["prod_codigo"]=='200115' or $rs_gbtarifa->fields["prod_codigo"]=='200120'  or $rs_gbtarifa->fields["prod_codigo"]=='200125' )
		{
		  $periodoncia++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200010' or $rs_gbtarifa->fields["prod_codigo"]=='200015' or $rs_gbtarifa->fields["prod_codigo"]=='200020'  )
		{
		  $endodoncia++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200130'  )
		{
		  $ajusteoclusal++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='930005' or $rs_gbtarifa->fields["prod_codigo"]=='DNS008' )
		{
		  $rayosx++;
		}
		
		if($rs_gbtarifa->fields["prod_codigo"]=='200135' )
		{
		  $placam++;
		}
		
		$rs_gbtarifa->MoveNext();	
		}
	 }	
	
$suma_totales=0;	
$suma_totales=$consulta+$rdefinitivas+$profilaxis+$sellantes+$fluorizacion+$exodoncia+$protesisfija+$protesisparcial+$protesistotal+$cirujiaoral+$periodoncia+$endodoncia+$ajusteoclusal+$rayosx+$placam;
 ?> 
  <tr>
    <td class="css_listat"><?php echo $numera; ?></td>
    <td nowrap="NOWRAP" class="css_listat"><?php echo utf8_encode($rs_cliente->fields["clie_apellido"]." ".$rs_cliente->fields["clie_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_listat" ><?php echo $sactivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $spasivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $montepio; ?></td>
	<td nowrap="nowrap" class="css_listat"><?php echo $dependiente; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $noaplica; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $hombre; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $mujer; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $menoraunmes; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de1a11meses; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $deunoa4anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de5a9anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de10a14anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de15a19anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de20a35anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de36a49anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de50a64anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de65a1000anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $rs_diag->fields["diagn_descripcion"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $rs_diag->fields["diagn_cie"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $aten_primera; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $aten_subsecuente; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $consulta; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $rdefinitivas; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $profilaxis; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $sellantes; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $fluorizacion; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $exodoncia; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $protesisfija; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $protesisparcial; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $protesistotal; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $cirujiaoral; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $periodoncia; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $endodoncia; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $ajusteoclusal; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $rayosx; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $placam; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $suma_totales; ?></td>
  </tr>
 <?php
        $rs_gogessform->MoveNext();	
		}
 }
 ?> 
</table>

<?php
}
?>