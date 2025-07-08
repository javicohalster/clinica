<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$codigo_pr=$_POST["codigo_pr"];
$lote_pr=$_POST["lote_pr"];
$fechai=$_POST["fechai"];
$fechaf=$_POST["fechaf"];
$tipomov_id=$_POST["tipomov_id"];


if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();


$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);

$fecha_inicoper='';
$fecha_inicoper=$per_activo."-01-01";

$busca_nmedic="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$codigo_pr."'";
$rs_nmedic= $DB_gogess->executec($busca_nmedic);
$nom1='';					
if($rs_nmedic->fields["cuadrobm_nombrecomercial"])
{
   $nom1=$rs_nmedic->fields["cuadrobm_nombrecomercial"].' ';
}

$nom2='';					
if($rs_nmedic->fields["cuadrobm_primerniveldesagregcion"])
{
   $nom2=$rs_nmedic->fields["cuadrobm_primerniveldesagregcion"].' ';
}

$nom3='';					
if($rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"])
{
   $nom3=$rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"].' ';
}
 
$nom4='';					
if($rs_nmedic->fields["cuadrobm_concentracion"])
{
   $nom4=$rs_nmedic->fields["cuadrobm_concentracion"].' ';
}

$nom5='';					
if($rs_nmedic->fields["cuadrobm_nombredispositivo"])
{
   $nom5=$rs_nmedic->fields["cuadrobm_nombredispositivo"].' ';
}


$concatena_nom=$nom1.$nom2.$nom3.$nom4.$nom5;
$nombre_medic='';
$nombre_medic=$rs_nmedic->fields["cuadrobm_codigoatc"].' '.utf8_encode($rs_nmedic->fields["cuadrobm_principioactivo"]).' '.utf8_encode($concatena_nom);

if($lote_pr)
{
$busca_lote="select * from dns_principalmovimientoinventario where  moviin_nlote='".$lote_pr."' and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'";
}
else
{
$busca_lote="select * from dns_principalmovimientoinventario where  cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'";
}

$rs_dlote= $DB_gogess->executec($busca_lote);

$moviin_fechadecaducidad=$rs_dlote->fields["moviin_fechadecaducidad"];
?>
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header pb-0 p-3">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <div align="center"><strong>LOS PINOS</strong></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center"><strong>Kardex BODEGA DNS Lote: </strong><?php echo $lote_pr; ?>
                                <strong>Fecha
                                    Cad.</strong><?php echo $moviin_fechadecaducidad; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center"><strong>Producto:</strong> <?php echo $nombre_medic; ?> </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center"><strong>Desde:</strong> <?php echo $fechai; ?> <strong>Hasta:
                                </strong><?php echo $fechai; ?> </div>
                        </td>
                    </tr>
                </table>

                <?php
$bu_kardex="select * from dns_kardex where (fecha>='".$fechai."' and fecha<='".$fechaf."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'  order by tipom_id,fecha asc";


if($lote_pr)
{
//saldo a la fecha
$bu_kardexn0="select * from dns_principalmovimientoinventario  where moviin_nlote='".$lote_pr."' and (date_format(moviin_fecharegistro, '%Y-%m-%d')>='".$fecha_inicoper."' and date_format(moviin_fecharegistro, '%Y-%m-%d')<'".$fechai."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'  order by moviin_id asc";
}
else
{
$bu_kardexn0="select * from dns_principalmovimientoinventario  where (date_format(moviin_fecharegistro, '%Y-%m-%d')>='".$fecha_inicoper."' and date_format(moviin_fecharegistro, '%Y-%m-%d')<'".$fechai."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'  order by moviin_id asc";

}


$saldoi=0; 
  $rs_listakardexn0 = $DB_gogess->executec($bu_kardexn0);
                   if($rs_listakardexn0)
				   {
						while (!$rs_listakardexn0->EOF) {
						
						$compra_nsec='';
						$compra_recibe='';
						$compra_nseceg='';
					if($rs_listakardexn0->fields["tipom_id"]==1 )
					{	
						$busca_documento="select * from dns_compras where compra_id='".$rs_listakardexn0->fields["compra_id"]."'";
                        $rs_docu= $DB_gogess->executec($busca_documento);			
						$compra_recibe='';
						$compra_recibe=$rs_docu->fields["compra_recibe"];						
						$valor_recibe='';						
						if($rs_docu->fields["compra_id"]!=0)
						{
						$compra_nsec='';
		                $compra_nsec=str_pad($rs_docu->fields["compra_id"], 10, "0", STR_PAD_LEFT);						
						$valor_recibe="COMPRAS (".$compra_recibe.")";						
						}
						
						if($rs_listakardexn0->fields["egrecentrecentro_id"]!=0)
						{
						   $compra_nsec='';
						   $compra_nsec=str_pad($rs_listakardexn0->fields["egrecentrecentro_id"], 10, "0", STR_PAD_LEFT);
						   $compra_nsec="T-".$compra_nsec;						   
						   $valor_recibe="TRANSFERENCIA";
						 }
		               $saldoi=$saldoi+$rs_listakardexn0->fields["moviin_totalenunidadconsumo"];
						
						$busca_movnom="select * from dns_motivomovimiento where  tipomov_id='".$rs_listakardexn0->fields["tipomov_id"]."'";
						$rs_movnom = $DB_gogess->executec($busca_movnom);
						
						$nmovi='';
						if($rs_movnom->fields["tipomov_nombre"])
						{
						  $nmovi=' '.$rs_movnom->fields["tipomov_nombre"];
						}
						
						
					}
					
					if($rs_listakardexn0->fields["tipom_id"]==2)
					{	
					    
						
						$busca_tmpd="select * from dns_temporaldespacho where tempdsp_id='".$rs_listakardexn0->fields["tempdsp_id"]."'";
                        $rs_tmpd= $DB_gogess->executec($busca_tmpd);		
						
						
						$busca_documentoeg="select * from dns_egresocentros where egrec_id='".$rs_tmpd->fields["egrec_id"]."'";
                        $rs_docueg= $DB_gogess->executec($busca_documentoeg);			
						$compra_recibeeg='';
						$compra_recibeeg=$rs_docueg->fields["egrec_personalrecibe"];
						
						$centrod_id=$rs_docueg->fields["centrod_id"];
						
						$compra_nseceg='';
		                $compra_nseceg=str_pad($rs_docueg->fields["egrec_id"], 10, "0", STR_PAD_LEFT);

                        $saldoi=$saldoi-$rs_listakardexn0->fields["moviin_totalenunidadconsumo"];
						
						$color='';
						if($rs_docueg->fields["egrec_recibido"]!=1 and $rs_listakardexn0->fields["tipomov_id"]==5)
						{
						  $color='bgcolor="#FFE1E1"';
						}
						
						$busca_movnom="select * from dns_motivomovimiento where tipom_id=2 and tipomov_id='".$rs_listakardexn0->fields["tipomov_id"]."'";
						$rs_movnom = $DB_gogess->executec($busca_movnom);
						
						$nmovi='';
						if($rs_movnom->fields["tipomov_nombre"])
						{
						  $nmovi=' '.$rs_movnom->fields["tipomov_nombre"];
						}
						
						
						$busca_cor="select * from dns_centrosalud where centro_id='".$centrod_id."'";
						$rs_cdor = $DB_gogess->executec($busca_cor);
						
					}
						

                         $rs_listakardexn0->MoveNext();
                       }
				}	  


//saldo a la fecha

//echo $saldoi;

$total1=0;
$total2=0;
$total3=0;
$valordestino='';
$valordorigen='';

$cuentav=0;

if($lote_pr)
{

$bu_kardex="select *,date_format(moviin_fecharegistro, '%Y-%m-%d') as solofecha from dns_principalmovimientoinventario  where moviin_nlote='".$lote_pr."' and (date_format(moviin_fecharegistro, '%Y-%m-%d')>='".$fecha_inicoper."' and date_format(moviin_fecharegistro, '%Y-%m-%d')<='".$fechaf."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'  and tipomov_id='".$tipomov_id."' order by moviin_id asc";

$bu_kardex="select *,date_format(moviin_fecharegistro, '%Y-%m-%d') as solofecha from dns_principalmovimientoinventario  where moviin_nlote='".$lote_pr."' and (date_format(moviin_fecharegistro, '%Y-%m-%d')>='".$fecha_inicoper."' and date_format(moviin_fecharegistro, '%Y-%m-%d')<='".$fechaf."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'  order by moviin_id asc";
}
else
{

$bu_kardex="select *,date_format(moviin_fecharegistro, '%Y-%m-%d') as solofecha from dns_principalmovimientoinventario  where (date_format(moviin_fecharegistro, '%Y-%m-%d')>='".$fecha_inicoper."' and date_format(moviin_fecharegistro, '%Y-%m-%d')<='".$fechaf."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'  and tipomov_id='".$tipomov_id."' order by moviin_id asc";

$bu_kardex="select *,date_format(moviin_fecharegistro, '%Y-%m-%d') as solofecha from dns_principalmovimientoinventario  where (date_format(moviin_fecharegistro, '%Y-%m-%d')>='".$fecha_inicoper."' and date_format(moviin_fecharegistro, '%Y-%m-%d')<='".$fechaf."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'  order by moviin_id asc";

}

//echo $bu_kardex;
?>
                <br>
                <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <div align="center"><b>Despacho aun no esta aceptado en el centro</b></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" width="100%" border="0" align="center"
                                cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>No</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Fecha</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>N&uacute;mero de Comprobante</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Movimiento</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Destino</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Responsable de Recepci&oacute;n</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Ingreso</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Egreso</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Saldo</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Unidad</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Precio </strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Unidad Descargo</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Precio</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Observaci&oacute;n</strong></div>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <div align="center"><strong>Lote</strong></div>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
  if($saldoi>0)
  {
  ?>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                        <td><?php echo $saldoi; ?></td>
                                    </tr>
                                </tbody>
                                <?php
  }
  $saldo=0; 
  $rs_listakardex = $DB_gogess->executec($bu_kardex);
                   if($rs_listakardex)
				   {
						while (!$rs_listakardex->EOF) {
						
						$ajuspr_id=$rs_listakardex->fields["tomfis_id"];
						$data_ajus='';
						if($ajuspr_id>0)
						{
						  $data_ajus='POR AJUSTE-> '.$ajuspr_id;
						}
						
						$obs='';
						
						$unidad_almacena=$objformulario->replace_cmb("dns_unidad","unid_id,unid_nombre"," where unid_id=",$rs_listakardex->fields["unid_id"],$DB_gogess); 
						$unidad_consumo=$objformulario->replace_cmb("dns_unidad","unid_id,unid_nombre"," where unid_id=",$rs_listakardex->fields["uniddesg_id"],$DB_gogess); 
						
						$compra_nsec='';
						$compra_recibe='';
						$compra_nseceg='';
					if($rs_listakardex->fields["tipom_id"]==1 )
					{	
						$busca_documento="select * from dns_compras where compra_id='".$rs_listakardex->fields["compra_id"]."'";
                        $rs_docu= $DB_gogess->executec($busca_documento);			
						$compra_recibe='';
						$compra_recibe=$rs_docu->fields["compra_recibe"];
						
						$valor_recibe='';
						$clickverl="";
						
						if($rs_docu->fields["compra_id"]!=0)
						{
						$compra_nsec='';
		                $compra_nsec=str_pad($rs_docu->fields["compra_id"], 10, "0", STR_PAD_LEFT);
						
						$valor_recibe="COMPRAS (".$compra_recibe.")";
						$clickverl="onclick=tablas_verlista('../../../opciones/grid/bodegadns/compras/verlista.php','".base64_encode($rs_docu->fields["compra_id"])."')"; 
						
						}
						
						$valordestino='';
						$valordorigen='';
						if($rs_listakardex->fields["egrecentrecentro_id"]!=0)
						{
						   $compra_nsec='';
						   $compra_nsec=str_pad($rs_listakardex->fields["egrecentrecentro_id"], 10, "0", STR_PAD_LEFT);
						   $compra_nsec="T-".$compra_nsec;
						   
						   $valor_recibe="TRANSFERENCIA";
						   $clickverl="onclick=tablas_verlista('../../../opciones/grid/inventariocentros/egresovarios/verlista.php','".base64_encode($rs_listakardex->fields["egrecentrecentro_id"])."')"; 
						    
							$lista_tsql="select * from  dns_invegresosvarios where egrec_id='".$rs_listakardex->fields["egrecentrecentro_id"]."'";
                            $lista_t = $DB_gogess->executec($lista_tsql,array());
							
							
								
	                        $valordestino=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$lista_t->fields["centrod_id"],$DB_gogess); 

						    $valordorigen=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$lista_t->fields["centro_id"],$DB_gogess); 

						   
						}
		
		

                        $saldo=$saldo+$rs_listakardex->fields["moviin_totalenunidadconsumo"];
						
						$busca_movnom="select * from dns_motivomovimiento where  tipomov_id='".$rs_listakardex->fields["tipomov_id"]."'";
						$rs_movnom = $DB_gogess->executec($busca_movnom);
						
						$nmovi='';
						if($rs_movnom->fields["tipomov_nombre"])
						{
						  $nmovi=' '.$rs_movnom->fields["tipomov_nombre"];
						}
						
						if($rs_listakardex->fields["solofecha"]>=$fechai)
						{
						
						$obs=' '.$rs_listakardex->fields["centrorecibe_cantidad"].' '.$unidad_almacena.' tiene '.$rs_listakardex->fields["moviin_totalenunidadconsumo"].' '.$unidad_consumo;
						
						$datsospaciente='';
						if($rs_listakardex->fields["moviin_nombrerecibe"])
						{
						  $datsospaciente=$rs_listakardex->fields["moviin_nombrerecibe"]." ".$rs_listakardex->fields["moviin_cedularecibe"];
						}
					?>
                                <tbody>
                                    <tr>
                                        <td><?php  $cuentav++;
						echo $cuentav." - > ".$rs_listakardex->fields["moviin_id"]; ?></td>
                                        <td><?php //echo $rs_listakardex->fields["moviin_id"]; ?><?php echo $rs_listakardex->fields["moviin_fecharegistro"]; ?>
                                        </td>
                                        <td <?php echo $clickverl; ?> style="color:#0033CC; cursor:pointer">
                                            <?php echo $compra_nsec.' '.$data_ajus; ?>
                                        </td>
                                        <td><?php echo $rs_listakardex->fields["bodega"].$valordorigen.' - '.$nmovi.$rs_listakardex->fields["tipomov_id"]; ?>
                                        </td>
                                        <td><?php echo $valordestino." ".$datsospaciente; ?></td>
                                        <td><?php echo  $valor_recibe; ?></td>
                                        <td><?php echo $rs_listakardex->fields["moviin_totalenunidadconsumo"]; ?></td>
                                        <td>&nbsp;</td>
                                        <td><?php echo $saldo; ?></td>
                                        <td><?php echo $unidad_almacena; ?></td>
                                        <td><?php echo $rs_listakardex->fields["moviin_total"]; ?></td>
                                        <td><?php echo $unidad_consumo; ?></td>
                                        <td><?php echo $rs_listakardex->fields["moviin_preciocompra"]; ?></td>
                                        <td><?php echo $obs; ?></td>
                                        <td><?php echo $rs_listakardex->fields["moviin_nlote"]; ?></td>

                                    </tr>
                                </tbody>
                                <?php
					
					      $total1=$total1+$rs_listakardex->fields["moviin_totalenunidadconsumo"];
					     }
					}
					
					if($rs_listakardex->fields["tipom_id"]==2)
					{	
					    
						
						$busca_tmpd="select * from dns_temporaldespacho where tempdsp_id='".$rs_listakardex->fields["tempdsp_id"]."'";
                        $rs_tmpd= $DB_gogess->executec($busca_tmpd);		
						
						
						$busca_documentoeg="select * from dns_egresocentros where egrec_id='".$rs_tmpd->fields["egrec_id"]."'";
                        $rs_docueg= $DB_gogess->executec($busca_documentoeg);			
						$compra_recibeeg='';
						$compra_recibeeg=$rs_docueg->fields["egrec_personalrecibe"];
						
						$centrod_id=$rs_docueg->fields["centrod_id"];
						
						$compra_nseceg='';
		                $compra_nseceg=str_pad($rs_docueg->fields["egrec_id"], 10, "0", STR_PAD_LEFT);
						
						
						$clickverl="onclick=tablas_verlista('../../../opciones/grid/bodegadns/egresocentros/verlista.php','".base64_encode($rs_docueg->fields["egrec_id"])."')"; 

                        $saldo=$saldo-$rs_listakardex->fields["moviin_totalenunidadconsumo"];
						
						$color='';
						if($rs_docueg->fields["egrec_recibido"]!=1 and $rs_listakardex->fields["tipomov_id"]==5)
						{
						  $color='bgcolor="#FFE1E1"';
						}
						
						$busca_movnom="select * from dns_motivomovimiento where tipom_id=2 and tipomov_id='".$rs_listakardex->fields["tipomov_id"]."'";
						$rs_movnom = $DB_gogess->executec($busca_movnom);
						
						$nmovi='';
						if($rs_movnom->fields["tipomov_nombre"])
						{
						  $nmovi=' '.$rs_movnom->fields["tipomov_nombre"];
						}
						
						
						$busca_cor="select * from dns_centrosalud where centro_id='".$centrod_id."'";
						$rs_cdor = $DB_gogess->executec($busca_cor);
						
						if(!($rs_cdor->fields["centro_nombre"]))
						{
						$busca_cor="select * from cmb_destino_vista where centro_id='".$centrod_id."'";
						$rs_cdor = $DB_gogess->executec($busca_cor);
						}
						
						  
						$unidad_almacena=$objformulario->replace_cmb("dns_unidad","unid_id,unid_nombre"," where unid_id=",$rs_listakardex->fields["unid_id"],$DB_gogess); 
						$unidad_consumo=$objformulario->replace_cmb("dns_unidad","unid_id,unid_nombre"," where unid_id=",$rs_listakardex->fields["uniddesg_id"],$DB_gogess); 
						
						if($rs_listakardex->fields["solofecha"]>=$fechai)
						{
						
						$datsospaciente='';
						if($rs_listakardex->fields["moviin_nombrerecibe"])
						{
						  $datsospaciente=$rs_listakardex->fields["moviin_nombrerecibe"]." ".$rs_listakardex->fields["moviin_cedularecibe"];
						}
					?>
                                <tbody>
                                    <tr <?php echo $color; ?>>
                                        <td><?php $cuentav++;
						echo $cuentav." - > ".$rs_listakardex->fields["moviin_id"]; ?></td>
                                        <td><?php echo $rs_listakardex->fields["moviin_fecharegistro"]; ?></td>
                                        <td <?php echo $clickverl; ?> style="color:#0033CC; cursor:pointer">
                                            <?php echo $compra_nseceg.' '.$data_ajus; ?>
                                        </td>

                                        <td><?php echo utf8_encode($rs_listakardex->fields["bodega"].$nmovi.$rs_listakardex->fields["tipomov_id"]); ?>
                                        </td>
                                        <td><?php echo utf8_encode($rs_cdor->fields["centro_nombre"])." ".$datsospaciente; ?>
                                        </td>
                                        <td><?php echo utf8_encode($compra_recibeeg.' - '.$rs_cdor->fields["centro_nombre"]); ?>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><?php echo $rs_listakardex->fields["moviin_totalenunidadconsumo"]; ?></td>
                                        <td><?php echo $saldo; ?></td>
                                        <td><?php echo $unidad_consumo; ?></td>
                                        <td><?php echo $rs_listakardex->fields["moviin_total"]; ?></td>
                                        <td><?php echo $unidad_consumo; ?></td>
                                        <td><?php echo $rs_listakardex->fields["moviin_preciocompra"]; ?></td>
                                        <td><?php  ?></td>
                                        <td><?php echo $rs_listakardex->fields["moviin_nlote"]; ?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <?php
					    
						$total2=$total2+$rs_listakardex->fields["moviin_totalenunidadconsumo"];
					     
					    }
					}
						

                         $rs_listakardex->MoveNext();
                       }
				}	   
  
  
  ?>
                                <tfoot>
                                    <tr>
                                        <th><b></b></th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <b>TOTAL</b></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <?php echo  $total1; ?></th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            <?php echo $total2; ?></th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><?php  ?>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><?php  ?>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><?php  ?>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><?php  ?>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><?php  ?>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><?php  ?>
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7"><?php  ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><br>

<?php
}
?>

<script type="text/javascript">
<!--
function tablas_verlista(link_url, id) {

    myWindow4 = window.open(link_url + '?aleat=' + id, 'ventana_lista', 'width=990,height=700,scrollbars=YES');
    myWindow4.focus();

}
//  End 
-->
</script>