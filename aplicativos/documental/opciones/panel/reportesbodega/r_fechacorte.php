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
$categ_id=$_POST["categ_id"];



if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();
$centro_id=55;
$b_periodoac="";
$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);

?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h3 class="text-white text-capitalize ps-3 panel-title">CLINICA LOS PINOS</h3>
                    </div><br />
                    <div class="col-6 d-flex align-items-center">
                        <span class="fs-5"><strong>Bodega: </strong>BODEGA PRINCIPAL</span>
                    </div><br />
                    <div class="col-6 d-flex align-items-center">
                        <span class="fs-5"><strong>Fecha de Corte: </strong><?php echo $fechai; ?></span>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="col-md-12 mb-lg-0 mb-4">
                        <div class="card mt-4">
                            <div class="card-header pb-0 p-3">
                                <div class="col-6 d-flex align-items-center">
                                    <?php
//$bu_fcorte="select distinct cm.cuadrobm_id,moviin_nlote,moviin_fechadecaducidad,moviin_preciocompra from dns_compras co inner join dns_principalmovimientoinventario det on co.compra_id=det.compra_id inner join cmb_dns_cuadrobasicomedicamentos cm on cm.cuadrobm_id=det.cuadrobm_id where compra_fechaaprobacion<='".$fechai."' and year(compra_fechaaprobacion)>='".$per_activo."' and cm.categ_id='".$categ_id."' and det.tipomov_id in (17,8,9,10,16) order by nombre_med asc";

$lista_partida="select distinct cuadrobm_partidapresupuest from dns_compras co inner join dns_principalmovimientoinventario det on co.compra_id=det.compra_id inner join cmb_dns_cuadrobasicomedicamentos cm on cm.cuadrobm_id=det.cuadrobm_id where compra_fechaaprobacion<='".$fechai."' and year(compra_fechaaprobacion)>='".$per_activo."' and cm.categ_id='".$categ_id."' and det.tipomov_id in (17,8,9,10,16) order by nombre_med asc";

$rs_partida = $DB_gogess->executec($lista_partida);
                   if($rs_partida)
				   {
						while (!$rs_partida->EOF) {
						
?>
                                    <span
                                        class="fs-5">PARTIDA:<?php  echo $rs_partida->fields["cuadrobm_partidapresupuest"]; ?></span>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <?php
$bu_fcorte="select distinct mp.cuadrobm_id,mp.moviin_nlote,mp.moviin_fechadecaducidad,mp.moviin_preciocompra,sum(centrorecibe_cantidad) as centrorecibe_cantidad  from dns_principalmovimientoinventario mp inner join cmb_dns_cuadrobasicomedicamentos cm on mp.cuadrobm_id=cm.cuadrobm_id where (mp.moviin_fechaenvio>='".$fechai."' and mp.moviin_fechaenvio<='".$fechaf."') and mp.perioac_id>='".$per_activo."' and cm.categ_id='".$categ_id."' and tipom_id=2 and cuadrobm_partidapresupuest='".$rs_partida->fields["cuadrobm_partidapresupuest"]."' group by cuadrobm_id,moviin_nlote  order by nombre_med asc";
?>
                                        <table class="table align-items-center mb-0" width="90%" border="1"
                                            align="center" cellpadding="0" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                                        <strong>C&oacute;digo</strong>
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                                        <strong>Lote</strong>
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                                        <strong>Fec. Cad.</strong>
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                                        <strong>Nombre del Producto</strong>
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                                        <strong>Consumo</strong>
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                                        <strong>Costo</strong>
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                                        <strong>Total</strong>
                                                    </th>
                                                </tr>

                                                <?php
  $somatt1=0;
  $somatt2=0;
  $somatt3=0;
  
  $saldo=0; 
  $rs_listafcorte = $DB_gogess->executec($bu_fcorte);
                   if($rs_listafcorte)
				   {
						while (!$rs_listafcorte->EOF) {
						
					$datop=array();				
					$datop=$objBodega->nombre_pr('',$rs_listafcorte->fields["cuadrobm_id"],$DB_gogess);	
				
					
					$stock_ac=$rs_listafcorte->fields["centrorecibe_cantidad"];				
					
					$total_valor=0;
					$total_valor=$stock_ac*$rs_listafcorte->fields["moviin_preciocompra"];					
					$total_valor=number_format($total_valor, 2, '.', '');
					if($stock_ac>0)
					{
					?>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $datop["codigo"]; ?></td>
                                                    <td><?php echo $rs_listafcorte->fields["moviin_nlote"]; ?>
                                                    </td>
                                                    <td nowrap="nowrap">
                                                        <?php echo $rs_listafcorte->fields["moviin_fechadecaducidad"];  ?>
                                                    </td>
                                                    <td><?php echo $datop["nombre"]; ?></td>
                                                    <td><?php echo $stock_ac; ?></td>
                                                    <td><?php echo $rs_listafcorte->fields["moviin_preciocompra"]; ?>
                                                    </td>
                                                    <td><?php echo $total_valor; ?></td>
                                                </tr>
                                                <?php	
                         $somatt1=$somatt1+$stock_ac;
                       $somatt2=$somatt2+$rs_listafcorte->fields["moviin_preciocompra"];
                       $somatt3=$somatt3+$total_valor;	
					   
					}
                         $rs_listafcorte->MoveNext();
                       }
				}	   
  
  
  ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                        <b>TOTALES</b></th>
                                                    <th>&nbsp;</th>
                                                    <th nowrap="nowrap">&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                        <?php //echo $somatt1; ?></th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                        <?php echo $somatt2; ?></th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                        <?php echo $somatt3; ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </li>
                                </ul>
                            </div>
                            <?php
                         $rs_partida->MoveNext();
                       }
				}	   
  

?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>