<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$sqltotal="";
$badera_stockmin=0;

$centro_idb=$_POST["pVar6"];
$egrec_id=$_POST["egrec_id"];
$egrec_id_v=$_POST["egrec_id"];

$objformulario= new  ValidacionesFormulario();
$cuadrobm_id=$_POST["cuadrobm_id"];

$b_categ="select categ_id from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_cate = $DB_gogess->executec($b_categ);
$insu_val=$rs_cate->fields["categ_id"];

$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);
?>
<table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  
			  <tr>
			  <td bgcolor="#AEDBE8"><strong>ID</strong></td>
			  <td bgcolor="#AEDBE8"><strong>C&oacute;digo</strong></td>
			  <?php
			  if($insu_val==1)
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>C&oacute;digo ISSPOL</strong></td>
			  <?php
			  }
			  ?>
			  <td bgcolor="#AEDBE8"><strong>Nombre</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Minimo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Actual</strong></td>
			  <?php
			  if($insu_val==1)
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>Precio Techo(Medicamentos)</strong></td>
			  <?php
			  }
			  ?>
			  
			  <?php
			  if($insu_val==1)
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>Precio (Medicamentos)</strong></td>
			  <?php
			  }
			  else
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>Precio (Dispositivos)</strong></td>
			  <?php
			  }
			  ?>
              <td bgcolor="#FFE6E6"><strong>ALERTA</strong></td>		  
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td><div id="alerstk">&nbsp;</div></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
  </tr>
			  
		  <?php
		          $lista_campor='';
				  
				 if($cuadrobm_id>0)
				 {
				  $lista_campor="select * from dns_cuadrobasicomedicamentos_vista where categ_id=".$insu_val." and (cuadrobm_id ='".$cuadrobm_id."')  order by  cuadrobm_principioactivo asc";			
				 }
				  
				  //echo $lista_campor;
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {
						
						
						//busca no procesados
						$compra_nsecx='';						
						$busca_npd="select distinct dns_invegresosvarios.egrec_id from dns_invtemporaldespacho inner join dns_invegresosvarios on 	dns_invtemporaldespacho.egrec_id=dns_invegresosvarios.egrec_id where dns_invtemporaldespacho.cuadrobm_id='".$rs_listacmp->fields["cuadrobm_id"]."' and egrec_anulado=0 and egrec_procesado=0 and dns_invegresosvarios.egrec_id!='".$egrec_id_v."'";
						
                        $rs_npd = $DB_gogess->executec($busca_npd);
						if($rs_npd)
						{
						   while (!$rs_npd->EOF) {
						   						   
						    $compra_nsecx.=str_pad($rs_npd->fields["egrec_id"], 10, "0", STR_PAD_LEFT).' - ';
						   
						    $rs_npd->MoveNext();
						   }						
						}
						
						//busca no procesados	
						
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'dns_cuadrobasicomedicamentos'";
						$campo_valor="'cuadrobm_id'";
						$ide_producto='cuadrobm_id';
						
						
						$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where stock_periodo='".$per_activo."'	and centro_id=".$centro_idb." and cuadrobm_id=".$rs_listacmp->fields["cuadrobm_id"];
						$rs_stactua = $DB_gogess->executec($stockactual);

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}

						
						echo '<tr '.$colortr.' >';
					
						
						$busca_compras="select * from dns_movimientoinventario where cuadrobm_id=".$rs_listacmp->fields[$ide_producto]." and  centro_id=".$centro_idb." order by moviin_id desc limit 1";
						$rs_bcompra = $DB_gogess->executec($busca_compras);
									       
						
						echo '<td>'.$cuenta.'.-</td>';
						
						$ncampo_val='cuadrobm_codigoatc';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';
						
						if($insu_val==1)
			            {
						$ncampo_val='cuadrobm_codigoispol';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';
					    }
					  						 
							  
						$ncampo_val='cuadrobm_principioactivo';
						$nom1='';					
						if($rs_listacmp->fields["cuadrobm_nombrecomercial"])
						{
						   $nom1=$rs_listacmp->fields["cuadrobm_nombrecomercial"].' ';
						}
						
						$nom2='';					
						if($rs_listacmp->fields["cuadrobm_primerniveldesagregcion"])
						{
						   $nom2=$rs_listacmp->fields["cuadrobm_primerniveldesagregcion"].' ';
						}
						
						$nom3='';					
						if($rs_listacmp->fields["cuadrobm_tercerniveldesagregcion"])
						{
						   $nom3=$rs_listacmp->fields["cuadrobm_tercerniveldesagregcion"].' ';
						}
						 
						$nom4='';					
						if($rs_listacmp->fields["cuadrobm_concentracion"])
						{
						   $nom4=$rs_listacmp->fields["cuadrobm_concentracion"].' ';
						}
	                    
						$concatena_nom=$nom1.$nom2.$nom3.$nom4;
						
						echo '<td width="310px" >'.utf8_encode($rs_listacmp->fields[$ncampo_val]).' '.utf8_encode($concatena_nom).'</td>';
						
						
						$ncampo_val='cuadrobm_stockminimo';					
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						$stockminimo=0;
						$stockminimo=$rs_listacmp->fields[$ncampo_val];			
						
						$ncampo_val='produ_stockactual';
						
						$st_actualvalor=0;
						if($rs_stactua->fields["stactual"])
						{
						  $st_actualvalor=$rs_stactua->fields["stactual"];
						}
						
						$badera_stockmin=0;
						if($st_actualvalor<=$stockminimo)
						{
						 $badera_stockmin=1;						
						}
						
						echo '<td>'.$st_actualvalor.'<input name="st_actual" type="hidden" id="st_actual" value="'.$st_actualvalor.'"></td>';						
						
						
						if($insu_val==1)
			            {
						$ncampo_val='cuadrobm_preciotecho';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						}
						
						if($insu_val==1)
			            {
						$ncampo_val='cuadrobm_preciomedicamento';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						}
						else
						{
						$ncampo_val='cuadrobm_preciodispositivo';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
                        }
						
						if($insu_val==1)
			            {
						//$ncampo_val='cuadrobm_valorplanilla';
						//echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						}
						else
						{
						//$ncampo_val='cuadrobm_valorplanilladispositivos';
						//echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						}
						
						$clickedit='';
						$clickedit="onclick=abrir_standar('producto/grid_producto_nuevo.php','Producto','divBody_producto','divDialog_producto',995,650,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$insu_val."')";
						 $nombre_boton='';
						
						echo '<td  bgcolor="#FFE6E6" >'.$compra_nsecx.'</td>';
						 
						//echo '<td><input type="button" name="Submit" value="Agregar" '.$clickedit.' /></td>';	
						//echo '<td><input type="button" name="Submit" value="Movimientos" onclick="compras_prk('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.','.$centro_idb.')" /></td>';  

							  
			             echo '</tr>';
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
		  
		  
		  <tr>
			    <td colspan="9" bgcolor="#AEDBE8"><div align="center"><strong>LISTA POR DISPONIBILIDAD DE LOTES</strong></div></td>
  </tr>
  
  <tr>
			    <td colspan="9">
			      <table width="100%" border="1">
                    <tr>
					  <td bgcolor="#DEF0F5"><div align="center"> </div></td>
                      <td bgcolor="#DEF0F5"><div align="center">No. Lote </div></td>
                      <td bgcolor="#DEF0F5"><div align="center">Registro Sanitario</div></td>
                      <td bgcolor="#BCE0EB"><div align="center">Fecha de Caducidad</div></td>
                      <td bgcolor="#DEF0F5"><div align="center">Fecha de Elaboraci&oacute;n</div></td>
                      <td bgcolor="#DEF0F5"><div align="center">Nombre del Fabricante</div></td>
                      <td bgcolor="#DEF0F5"><div align="center">Cantidad Unidad</div></td>
                      <td bgcolor="#DEF0F5"><div align="center">Precio unitario compra</div></td>
					   <td bgcolor="#FFE6E6"><div align="center">ALERT</div></td>
                    </tr>
					<?php
				   
				   $lista_compras='';
				   
				   if($cuadrobm_id>0)
					{					
					 $lista_compras="select * from dns_movimientoinventario where tipom_id=1 and cuadrobm_id='".$cuadrobm_id."' and centro_id='".$centro_idb."' and perioac_id='".$per_activo."'";
					}
					
					$rs_lcompras = $DB_gogess->executec($lista_compras);
                    if($rs_lcompras)
				    {
						while (!$rs_lcompras->EOF) {	
						
						
						//busca no procesados
						$compra_nsecx='';
						$busca_npd="select distinct dns_invegresosvarios.egrec_id from dns_invtemporaldespacho inner join dns_invegresosvarios on 	dns_invtemporaldespacho.egrec_id=dns_invegresosvarios.egrec_id where moviin_id='".$rs_lcompras->fields["moviin_id"]."' and egrec_anulado=0 and egrec_procesado=0 and dns_invegresosvarios.egrec_id!='".$egrec_id_v."'";
						
                        $rs_npd = $DB_gogess->executec($busca_npd);
						if($rs_npd)
						{
						   while (!$rs_npd->EOF) {
						   						   
						    $compra_nsecx.=str_pad($rs_npd->fields["egrec_id"], 10, "0", STR_PAD_LEFT).' - ';
						   
						    $rs_npd->MoveNext();
						   }						
						}
						
						//busca no procesados
						
						
						
						//busca_movimientos_fuera
						
						$lista_ent="select sum(moviin_totalenunidadconsumo) as entregadot from  dns_movimientoinventario where (moviincent_id='".$rs_lcompras->fields["moviin_id"]."' or entregamoviin_id='".$rs_lcompras->fields["moviin_id"]."') and centro_id='".$centro_idb."' and tipom_id=2";
						
						$rs_ent = $DB_gogess->executec($lista_ent);
						$entregadot=0;
						$entregadot=$rs_ent->fields["entregadot"];
						
						
						//busca_movimientos_fuera
						
						//busca lo ingresado en comprobante
						
						$busca_asig="select sum(cantidad_val) as totalegreso from dns_invtemporaldespacho inner join dns_invegresosvarios on 	dns_invtemporaldespacho.egrec_id=dns_invegresosvarios.egrec_id where moviin_id='".$rs_lcompras->fields["moviin_id"]."' and egrec_anulado=0 and dns_invegresosvarios.egrec_id='".$egrec_id."'";
                        $rs_asig = $DB_gogess->executec($busca_asig);
						
						$cantidad_asig=0;

						if(@$rs_asig->fields["totalegreso"])
						{
						  $cantidad_asig=$rs_asig->fields["totalegreso"];
						}
						else
						{
						  $cantidad_asig=0;
						}
						
						
						$valor_movimiento=0;
                        $valor_movimiento=$rs_lcompras->fields["moviin_totalenunidadconsumo"];
						
						//echo "TUC:".$valor_movimiento."<br>";
						
						$restante_valor=$valor_movimiento-$cantidad_asig-$entregadot;
						//busca lo ingresado en comporbante
					
					if($restante_valor>0)
					{	
					
					//echo $lista_ent."<br>";
					
					//echo "TUC:".$valor_movimiento."<br>";
					//echo $entregadot."<br>";
					//echo $busca_asig."<br>";
					
					
					?>
                    <tr>
					  <td><label>
					    <input name="radio_lote" id="radio_lote" type="radio" value="<?php echo $rs_lcompras->fields["moviin_id"]; ?>" />
				      </label></td>
                      <td><?php echo $rs_lcompras->fields["moviin_nlote"]; ?></td>
                      <td><?php echo $rs_lcompras->fields["moviin_rsanitario"]; ?></td>
                      <td bgcolor="#BCE0EB" ><?php echo $rs_lcompras->fields["moviin_fechadecaducidad"]; ?></td>
                      <td><?php echo $rs_lcompras->fields["moviin_fechadeelaboracion"]; ?></td>
                      <td><?php echo $rs_lcompras->fields["moviin_nombrefabricante"]; ?></td>
                      <td><div id="invdiv_<?php echo $rs_lcompras->fields["moviin_id"]; ?>"><?php echo $restante_valor; ?><?php "UnidaC:".$valor_movimiento."<br>"."CAntidad Asig:".$cantidad_asig."<br>"."Entregado:".$entregadot."<br>"; ?></div></td>
                      <td><?php echo $rs_lcompras->fields["moviin_preciocompra"]; ?></td>
					  <td><?php echo $compra_nsecx; ?></td>
                    </tr>
					<?php
					}
					
					
					               $rs_lcompras->MoveNext();
					                      }
					}					  
					
					?>
                  </table>
		<div id="btn_ejecuu">		  
		<table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>Cantidad:</td>
          <td><input name="cantidad_val" type="text" id="cantidad_val" value="0"></td>
          <td><!-- <input type="button" name="Button" value="Agregar" onClick="enviar_atemporal()"> -->
		  <input type="button" name="Button" value="Agregar" onClick="busca_disponibilidad()">
		  </td>
        </tr>
      </table>
	  </div>
				  
				  </td>
  </tr>
</table>

<script type="text/javascript">
<!--
function selecciona_prd()
{
 alert($('input:radio[name=radio_lote]:checked').val());
}

//  End -->
</script>

<?php
if($badera_stockmin==1)
{
?>

<script type="text/javascript">
<!--

$('#alerstk').html('<img src="../../../../../images/alert_gif.gif" width="25" height="24" />');

//  End -->
</script>


<?php
}


}
?>
		  