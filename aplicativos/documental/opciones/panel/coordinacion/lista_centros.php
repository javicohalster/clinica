<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44040000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
$objformulario= new  ValidacionesFormulario();

?>

<?php
  $lista_zona="select * from dns_zona order by zona_id asc";
			  $cuenta=0;
			  $rs_zona = $DB_gogess->executec($lista_zona);
              if($rs_zona)
				{
						while (!$rs_zona->EOF) {
						
						
?>

<div class="col-md-12 mb-lg-0 mb-4">
    <div class="card mt-4">
        <div class="card-header pb-0 p-3">
            <div class="col-6 d-flex align-items-center">
                ZONA:<b>&nbsp;<?php echo $rs_zona->fields["zona_nombre"]; ?></b>
            </div>
        </div>
        <div class="card-body p-3">
            <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="table-responsive p-0">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                            class="table align-items-center mb-0 table-hover record_table" id="tabla">
                            <thead>
                                <tr>
                                    <th bgcolor="#AEDBE8"
                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                        <strong>ID</strong>
                                    </th>
                                    <th nowrap="nowrap" bgcolor="#AEDBE8"
                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                        <strong>Nombre</strong>
                                    </th>
                                    <th bgcolor="#AEDBE8"
                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                        <strong>Direcci&oacute;n</strong>
                                    </th>
                                    <th bgcolor="#AEDBE8"
                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                        <strong>Activar Despachos Medicamentos</strong>
                                    </th>
                                    <th bgcolor="#AEDBE8"
                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                        <strong>Activar Despachos Dispositivos</strong>
                                    </th>
                                    <th bgcolor="#AEDBE8"
                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                        <strong>Activar Movimientos en Centros (Medicamentos)</strong>
                                    </th>
                                    <th bgcolor="#AEDBE8"
                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 sorting">
                                        <strong>Activar Movimientos en Centros (Dispositivos)</strong>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
			  $lista_campor="select * from dns_centrosalud where centro_activosistema=1 and zona_id='".$rs_zona->fields["zona_id"]."' order by zona_id asc";
			  $cuenta=0;
			  $rs_listacmp = $DB_gogess->executec($lista_campor);
              if($rs_listacmp)
				{
						while (!$rs_listacmp->EOF) {
						
						$comulla_simple="'";
						$tabla_valordata="'dns_centrosalud'";
						$campo_valor="'centro_id'";
						$ide_producto='centro_id';
						
						$cuenta++;	
						$colortr='';
						$grafico_gif='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";								
								$grafico_gif='alert_gif2.gif';
						}else{
							    $colortr="style='background-color:#ffffff'";
								$grafico_gif='alert_gif.gif';
						}
						
						echo '<tr>';
						echo '<td>'.$cuenta.'.-</td>';
						$ncampo_val='centro_nombre';
						echo '<td nowrap="nowrap" >'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						$ncampo_val='centro_direccion';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						 $ncampo_val='centro_activodespacho';		
						echo '<td><div class="input-group input-group-static my-3"><select class="form-control css_select" style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('gogess_sino','value,etiqueta',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></div></td>';
						
						
						$ncampo_val='centro_activodispositivos';		
						echo '<td><div class="input-group input-group-static my-3"><select class="form-control css_select" style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('gogess_sino','value,etiqueta',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></div></td>';
						
						
						$ncampo_val='centro_activoentrecentros';		
						echo '<td><div class="input-group input-group-static my-3"><select class="form-control css_select" style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="">--Tipo--</option>';
                               $objformulario->fill_cmb('gogess_sino','value,etiqueta',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></div></td>';
						
						
						$ncampo_val='centro_disposentrecentros';		
						echo '<td><div class="input-group input-group-static my-3"><select class="form-control css_select" style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('gogess_sino','value,etiqueta',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></div></td>';
						
							
							
						
						echo '</tr>';
			  
			
			               $rs_listacmp->MoveNext();
			            }
				  }	
			  ?>
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
                              $rs_zona->MoveNext();
			            }
				  }	

?>

<div id="campo_valor"></div>
<SCRIPT LANGUAGE=javascript>
<!--
function guardar_campos(tabla, campo, id, valor, campoidtabla) {

    $("#campo_valor").load("aplicativos/documental/opciones/panel/coordinacion/guarda_campo.php", {

        tabla: tabla,
        campo: campo,
        id: id,
        valor: valor,
        campoidtabla: campoidtabla

    }, function(result) {

    });

    $("#campo_valor").html("Espere un momento...");



}

//
-->
</SCRIPT>

<?php
}

?>