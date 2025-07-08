<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="54445000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['datadarwin2679_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();
$objUtil=new util_funciones();
$sqlconcatenado='';

//$_SESSION['datadarwin2679_centro_id']

$centro_idlocal=55;

?>


<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
        <h3 class="text-white text-capitalize ps-3 panel-title">ORIGEN DE CENTROS</h3>
    </div>
</div>
<div class="card-body px-0 pb-2">
    <div class="table-responsive p-0" style="max-height: 500px; overflow-y: auto;">
        <table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla"
            class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7"></th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>ID</strong>
                    </th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>N. Comprobante</strong>
                    </th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>Memo</strong>
                    </th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>Origen</strong>
                    </th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>Centro Destino</strong>
                    </th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>Fecha</strong>
                    </th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>Responsable Entrega</strong>
                    </th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>Personal Recibe</strong>
                    </th>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>Fecha Registro</strong>
                    </th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong>Usuario Registra</strong>
                    </th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong></strong>
                    </th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong></strong>
                    </th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong></strong>
                    </th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong></strong>
                    </th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <strong></strong>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
		          
				   //$lista_campor="select * from dns_egresocentros where categ_id='".$_POST["insu"]."' and  dns_compras.emp_id='".@$_SESSION['datadarwin2679_sessid_emp_id']."'  order by  compra_fecha desc";	  
				   if($sqlconcatenado)
				   { 
				   $lista_campor="select *,dns_invegresosvarios.centro_id as centroor_id from dns_invegresosvarios inner join cmb_destinocentro_vista on  dns_invegresosvarios.centrod_id=cmb_destinocentro_vista.centro_id where ".$sqlconcatenado." and dns_invegresosvarios.emp_id='".@$_SESSION['datadarwin2679_sessid_emp_id']."' and centrod_id='".$centro_idlocal."' order by  	egrec_id desc";
				   }
				   else
				   {
				   $lista_campor="select *,dns_invegresosvarios.centro_id as centroor_id from dns_invegresosvarios inner join cmb_destinocentro_vista on  dns_invegresosvarios.centrod_id=cmb_destinocentro_vista.centro_id where  dns_invegresosvarios.emp_id='".@$_SESSION['datadarwin2679_sessid_emp_id']."' and egrec_procesado=1 and centrod_id='".$centro_idlocal."' order by  	egrec_id desc";
				   }
				  
				 //echo $lista_campor;
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						//genera alerta			
						$bprincipal='';
						$bprincipal=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centro_id"],$DB_gogess);
						
						$bdestino='';
						$bdestino=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centrod_id"],$DB_gogess);
						
						$borigen='';
						$borigen=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centroor_id"],$DB_gogess);
						
						$busuario='';
						$busuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_listacmp->fields["usua_id"],$DB_gogess);
						
						//genera alerta
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'dns_invegresosvarios'";
						$campo_valor="'egrec_id'";
						$ide_producto='egrec_id';
											

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}

						
						echo '<tr>';	
						
						if($rs_listacmp->fields["egrec_procesado"]==1)
						{
						echo '<td></td>';
						}
						else
						{
						$link_borrar="borrar_registro_bu('dns_invegresosvarios','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";						
						echo '<td onclick="'.$link_borrar.'" style="cursor:pointer" ><span class="material-symbols-outlined">scan_delete</span></td>'; //<img src="borrar.png" >
						}
						$sining='';						
						echo '<td>'.$cuenta.'.-'.$sining.'</td>';			
							
                        $compra_nsec=str_pad($rs_listacmp->fields["egrec_id"], 10, "0", STR_PAD_LEFT);
                        
						echo '<td>'.$compra_nsec.'</td>';		
						echo '<td>'.utf8_encode($rs_listacmp->fields["egrec_nmemo"]).'</td>';	
						
						echo '<td>'.$borigen.'</td>';			
						echo '<td>'.$bdestino.'</td>';
						
						$ncampo_val='egrec_fecha';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_responsableentrega';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_personalrecibe';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_fecharegistro';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						echo '<td>'.$busuario.'</td>';
												
						
						$clickedit='';					
						 
						 
						$clickverl="onclick=tablas_verlista('aplicativos/documental/opciones/grid/inventariocentros/egresovarios/verlista.php','".base64_encode($rs_listacmp->fields["egrec_id"])."')"; 
						 
						if($rs_listacmp->fields["egrec_procesado"]==1)
						{
						echo '<td>Procesado</td>'; 
						}
						else
						{
						 
						echo '<td></td>'; 
						}
						
						$clickedit="onclick=abrir_standarv2('aplicativos/documental/opciones/grid/bodegadns/recibircenbp.php','Ingreso','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,0)";
						
						$clickrechazar="onclick=rechazar_documento('".$rs_listacmp->fields[$ide_producto]."')";
						
						echo '<td><input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="button" name="Submit" value="Ver" '.$clickverl.' /></td>';	
						
						if($rs_listacmp->fields["egrec_recibido"]==1)
						{	
						echo '<td>Recibido</td>';
						echo '<td>&nbsp;&nbsp;</td>';
						echo '<td></td>';
						}
						else
						{			 
						echo '<td><input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="button" name="Submit" value="Recibir Comprobante"  '.$clickedit.' /></td>';
                        echo '<td>&nbsp;&nbsp;</td>';
						echo '<td><div id="rechazar_documento'.$rs_listacmp->fields["egrec_id"].'" ><input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="button" name="Submit" value="Rechazar Comprobante"  '.$clickrechazar.' /></div></td>';	
												
						}	
										
						echo '
					  
			             </tr>';						
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
            </tbody>
            <tfoot>
                <tr>
                    <th bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7"></th>
                    <th colspan="4" bgcolor="#AEDBE8"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        <div align="center" style="font-weight: bold"><b>TOTAL COMPROBANTES:
                            </b><?php echo $cuenta; ?>
                        </div>
                    </th>

                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                    <th bgcolor="#A3D6E4"
                        class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                        &nbsp;</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<script type="text/javascript">
<!--
function tablas_verlista(link_url, id) {

    myWindow4 = window.open(link_url + '?aleat=' + id, 'ventana_lista', 'width=990,height=700,scrollbars=YES');
    myWindow4.focus();

}


function rechazar_documento(egrec_id) {

    var txt;
    var r = confirm("Si esta seguro que desea rechazar el documento.");
    if (r == true) {


        $("#rechazar_documento" + egrec_id).load(
            "aplicativos/documental/opciones/grid/bodegadns/rechazar_doc.php", {

                egrec_id: egrec_id

            },
            function(result) {
                listar_ingresos();
            });

        $("#rechazar_documento" + egrec_id).html("Espere un momento...");


    }

}

//  End 
-->
</script>
<?php
}

?>