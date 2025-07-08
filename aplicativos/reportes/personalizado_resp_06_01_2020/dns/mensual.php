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

//saca dias
$date1 = new DateTime($_POST["fecha_inicio"]);
$date2 = new DateTime($_POST["fecha_fin"]);
$diff = $date1->diff($date2);
// will output 2 days
//echo $diff->days . ' days ';
$lista_date=array();
$nuevo_dia=$_POST["fecha_inicio"];
for($i=1;$i<=$diff->days;$i++)
{
   
  $lista_date[$i]=$nuevo_dia;
  $nuevo_dia=date("Y-m-d",strtotime($nuevo_dia."+ 1 days")); 
  
  
}
$lista_date[$i++]=$nuevo_dia;
//print_r($lista_date);

//saca dias

//echo $_POST["fecha_inicio"];
//echo $_POST["fecha_fin"];
$lista_estu=array();

$saca_citas='select imginfo_id as id_tbl,clie_id,usua_id,imginfo_fecharegistro as fecharegistro,"dns_imagenologiainfo" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,imginfo_enlace as enlace from dns_imagenologiainfo union 
		select anam_id as id_tbl,clie_id,usua_id,anam_fecharegistro as fecharegistro,"dns_anamesisexamenfisico" as tabla,anam_atprevprenatal as prenatal_p,"" as prenatal_s,anam_parto as parto,anam_posparto as postparto,anam_atprevplanificacionf as planificacion_p,"" as planificacion_s,anam_cervicouterino as uterino,anam_mamario as mamario,anam_enlace as enlace from dns_anamesisexamenfisico union 
		select conext_id as id_tbl,clie_id,usua_id,conext_fecharegistro as fecharegistro,"dns_consultaexterna" as tabla,"" as prenatal_p,conext_atprevprenatal as prenatal_s,conext_parto as parto,conext_posparto as postparto,"" planificacion_p,conext_atprevplanificacionf as planificacion_s,conext_cervicouterino as uterino,conext_mamario as mamario,conext_enlace as enlace from dns_consultaexterna union 
		select odonto_id as id_tbl,clie_id,usua_id,odonto_fecharegistro as fecharegistro,"dns_odontologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,odonto_enlace as enlace from dns_odontologia union 
		select prinvas_id as id_tbl,clie_id,usua_id,prinvas_fecharegistro as fecharegistro,"dns_procediminetosinvasivos" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,prinvas_enlace as enlace  from dns_procediminetosinvasivos union 
		select psicolo_id as id_tbl,clie_id,usua_id,psicolo_fecharegistro as fecharegistro,"dns_psicologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,psicolo_enlace as enlace  from dns_psicologia union 
		select referencia_id as id_tbl,clie_id,usua_id,referencia_fecharegistro as fecharegistro,"dns_referencia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,referencia_enlace as enlace from dns_referencia union 
		select intercon_id as id_tbl,clie_id,usua_id,intercon_fecharegistro as fecharegistro,"dns_interconsulta" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,intercon_enlace as enlace from dns_interconsulta union 
		select subsecodont_id as id_tbl,clie_id,usua_id,subsecodont_fecharegistro as fecharegistro,"dns_subsecuenteodontologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,subsecodont_enlace as enlace from dns_subsecuenteodontologia union 
		select prehosp_id as id_tbl,clie_id,usua_id,prehosp_fecharegistro as fecharegistro,"dns_prehospitalario" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,prehosp_enlace as enlace from dns_prehospitalario union 
		select histopa_id as id_tbl,clie_id,usua_id,histopa_fecharegistro as fecharegistro,"dns_histopatologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,histopa_enlace enlace from dns_histopatologia union 
		select lab_id as id_tbl,clie_id,usua_id,lab_fecharegistro as fecharegistro,"dns_laboratorio" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,lab_enlace as enlace from dns_laboratorio union 
		select imgag_id as id_tbl,clie_id,usua_id,imgag_fecharegistro as fecharegistro,"dns_imagenologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,imgag_enlace as enlace from dns_imagenologia union 
		select enferm_id as id_tbl,clie_id,usua_id,enferm_fecharegistro as fecharegistro,"dns_enfermeria" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,enferm_enlace as enlace from dns_enfermeria union 
		select labinfor_id as id_tbl,clie_id,usua_id,labinfor_fecharegistro as fecharegistro,"dns_laboratorioinforme" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,labinfor_enlace as enlace from dns_laboratorioinforme union 
		select fisiot_id as id_tbl,clie_id,usua_id,fisiot_fecharegistro as fecharegistro,"dns_fisioterapia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,fisiot_enlace as enlace from dns_fisioterapia union 
		select subsecpsico_id as id_tbl,clie_id,usua_id,subsecpsico_fecharegistro as fecharegistro,"dns_subsecuentepsicologia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,subsecpsico_enlace as enlace from dns_subsecuentepsicologia union 
		select vidomici_id as id_tbl,clie_id,usua_id,vidomici_fecharegistro as fecharegistro,"dns_visitadomiciliaria" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,vidomici_enlace as enlace from dns_visitadomiciliaria union
        select regterapia_id as id_tbl,clie_id,dns_regfisioterapia.usua_id,regterapia_fecha as fecharegistro,"dns_fisioterapia" as tabla,"" as prenatal_p,"" as prenatal_s,"" as parto,"" as postparto,"" planificacion_p,"" as planificacion_s,"" as uterino,"" as mamario,dns_fisioterapia.fisiot_enlace as enlace from dns_fisioterapia inner join dns_regfisioterapia on dns_fisioterapia.fisiot_enlace=dns_regfisioterapia.fisiot_enlace		
		';
		

$cuenta_sql="select id_tbl,tabla,clie_id,usua_id,prenatal_p,prenatal_s,parto,postparto,planificacion_p,planificacion_s,uterino,mamario,fecharegistro,enlace,DATE_FORMAT(fecharegistro,'%Y-%m-%d') as solofecharegistro from (".$saca_citas.") tbl where fecharegistro>='".$_POST["fecha_inicio"]."' and fecharegistro<='".$_POST["fecha_fin"]."' and usua_id='".$_POST["usua_id"]."'";	
$numera=0;

$array_data=array();

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
      if($sactivo=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["sactivo"]++;
	  }	
	  
	  if($spasivo=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["spasivo"]++;
	  }
	  
	  if($montepio=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["montepio"]++;
	  }
	  
	  if($dependiente=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["dependiente"]++;
	  }
	  

	  if($noaplica=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["noaplica"]++;
	  }
	  
	  if($hombre=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["hombre"]++;
	  }
	  
	  if($mujer=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["mujer"]++;
	  }
	  
	  if($prenatal_p=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["prenatal_p"]++;
	  }
	  
	  if($prenatal_s=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["prenatal_s"]++;
	  }
	  
	  if($parto=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["parto"]++;
	  }
	  
	  if($postparto=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["postparto"]++;
	  }
	  
	   if($planificacion_p=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["planificacion_p"]++;
	  }
	  
	   if($planificacion_s=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["planificacion_s"]++;
	  }
	  
	   if($uterino=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["uterino"]++;
	  }
	  
	  if($mamario=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["mamario"]++;
	  }
	  
	  if($menur1anio_p=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["menur1anio_p"]++;
	  }
	  
	  if($menur1anio_s=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["menur1anio_s"]++;
	  }
	  
	  if($de1a4_p=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de1a4_p"]++;
	  }
	  
	  if($de1a4_s=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de1a4_s"]++;
	  }
	  
	  if($de5a9anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de5a9anios"]++;
	  }
	  
	  
	  if($ado10a14anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["ado10a14anios"]++;
	  }
	  
	  if($ado15a19anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["ado15a19anios"]++;
	  }
	  
	  if($mayorigual20=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["mayorigual20"]++;
	  }
	  
	  if($menoraunmes=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["menoraunmes"]++;
	  }
	  
	  if($de1a11meses=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de1a11meses"]++;
	  }
	  
	  if($deunoa4anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["deunoa4anios"]++;
	  }
	  
	  if($de5a9anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de5a9anios"]++;
	  }
	  
	  if($de10a14anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de10a14anios"]++;
	  }
	  
	  if($de15a19anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de15a19anios"]++;
	  }
	  
	   if($de20a35anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de20a35anios"]++;
	  }
	  
	   if($de36a49anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de36a49anios"]++;
	  }
	  
      if($de50a64anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de50a64anios"]++;
	  }
	  
	  if($de65a1000anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de65a1000anios"]++;
	  }
	  
	  if($de65a1000anios=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["de65a1000anios"]++;
	  }
	  
	  if($presuntivo=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["presuntivo"]++;
	  }
	  
	  if($definitivo=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["definitivo"]++;
	  }
	  
	   if($definitivocontrol=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["definitivocontrol"]++;
	  }
	  
	  if($aten_primera=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["aten_primera"]++;
	  }
	  
	  if($aten_subsecuente=='x')
	  {    
        $array_data[$rs_gogessform->fields["solofecharegistro"]]["aten_subsecuente"]++;
	  }

        $rs_gogessform->MoveNext();	
		}
 }
 
// foreach($array_data as $obj){
 
   // print_r($obj);
 
 //}





 //print_r($array_data);
 ?> 

<table width="1200" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="8">&nbsp;</td>
    <td colspan="15"><div align="center" class="css_listat">ATENCI&Oacute;N PREVENTIVA</div></td>
	<td colspan="18"><div align="center" class="css_listat"></div></td>
  </tr>
  <tr>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td colspan="5" rowspan="2" class="css_listat">BENEFICIARIO</td>
    <td colspan="2" rowspan="2" class="css_listat">SEXO</td>
    <td colspan="8" class="css_listat">MUJERES</td>
    <td colspan="5" class="css_listat">NI&Ntilde;OS</td>
    <td colspan="2" class="css_listat">ADOLECENTES</td>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td colspan="10" rowspan="2" class="css_listat">GRUPOS DE EDAD   -   MORBILIDAD</td>
    <td colspan="5" class="css_listat">DIAGN&Oacute;STICO</td>
    <td colspan="2" rowspan="2" class="css_listat">TIPO  DE ATENCION</td>
  </tr>
  <tr>
    <td colspan="2" class="css_listat">PRENATAL</td>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
    <td colspan="2" class="css_listat">PLANIF. FAMILIAR</td>
    <td colspan="2" class="css_listat">D.O.C</td>
    <td colspan="2" class="css_listat">&lt; 1 A&Ntilde;O</td>
    <td colspan="2" class="css_listat">1-4 A&Ntilde;OS</td>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
    <td colspan="3" class="css_listat">CLASE</td>
    <td colspan="2" class="css_listat">&nbsp;</td>
  </tr>
  <tr>
    <td class="css_listat">No</td>
    <td nowrap="nowrap" class="css_listat" >S. ACTIVO</td>
    <td nowrap="nowrap" class="css_listat">S. PASIVO</td>
    <td nowrap="nowrap" class="css_listat">MONTEPIO</td>
    <td nowrap="nowrap" class="css_listat">DEPENDIENTE </td>
    <td nowrap="nowrap" class="css_listat">NO APLICA</td>
    <td nowrap="nowrap" class="css_listat">HOMBRE</td>
    <td nowrap="nowrap" class="css_listat">MUJER</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">PARTO</td>
    <td nowrap="nowrap" class="css_listat">POSTPARTO</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA </td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">CERVICO UTERINO</td>
    <td nowrap="nowrap" class="css_listat">MAMARIO</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">5-9 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">10 - 14 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">15-19 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">20 A&Ntilde;OS Y MAS</td>
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
    <td nowrap="nowrap" class="css_listat">PRESUNTIVO</td>
    <td nowrap="nowrap" class="css_listat">DEFINITIVO</td>
    <td nowrap="nowrap" class="css_listat">DEFINITIVO CONTROL</td>
    <td nowrap="nowrap" class="css_listat">A.I.E.P.I.</td>
    <td nowrap="nowrap" class="css_listat">ALERTA-ACION</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
  </tr>
<?php
$lista_fechaarray=array();

for($i=1;$i<=count($lista_date);$i++)
{
    //echo $lista_date[$i]."<br>";

   $lista_fechaarray=explode("-",$lista_date[$i]);
?>
  <tr>
    <td class="css_listat"><?php echo $lista_fechaarray[2]; ?></td>
    <td nowrap="nowrap" class="css_listat" ><?php echo @$array_data[$lista_date[$i]]["sactivo"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["spasivo"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["montepio"]; ?></td>
	<td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["dependiente"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["noaplica"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["hombre"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["mujer"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["prenatal_p"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["prenatal_s"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["parto"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["postparto"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["planificacion_p"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["planificacion_s"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["uterino"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["mamario"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["menur1anio_p"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["menur1anio_s"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de1a4_p"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de1a4_s"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de5a9anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["ado10a14anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["ado15a19anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["mayorigual20"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["menoraunmes"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de1a11meses"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["deunoa4anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de5a9anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de10a14anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de15a19anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de20a35anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de36a49anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de50a64anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["de65a1000anios"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["presuntivo"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["definitivo"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["definitivocontrol"]; ?></td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["aten_primera"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo @$array_data[$lista_date[$i]]["aten_subsecuente"]; ?></td>
  </tr>
<?php
}
?>  
</table>

<?php
}
?>