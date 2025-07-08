<script language="javascript">
<!--
//referencia
function aceptar_us(manolid, usuaid) {

    $("#aceptar_onoff" + manolid).load("aplicativos/documental/opciones/requerimiento/aceptar_experto.php", {
        usuaidp: usuaid,
        manolidp: manolid
    }, function(result) {

    });

    $("#aceptar_onoff" + manolid).html("...");


}


//
-->
</script>
<style type="text/css">
<!--
.Estilo1 {
    font-size: 10px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-weight: bold;
}

.caracter_error {
    font-size: 10px;
    font-family: Verdana, Arial, Helvetica, sans-serif;

}

.css_inicio4 {
    font-size: 10px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
}


.TableScroll {
    z-index: 99;
    width: 100%;
    height: 220px;
    overflow: auto;
}

.TableScrolldiario {
    z-index: 99;
    width: 100%;
    height: 220px;
    overflow: auto;
}
-->
</style>


<div class="container-fluid py-2 container" style="padding-top: 1em; padding-right:1em; ">
    <div class="row">



        <div class="ms-4">
            <h4 class="fs-2 mb-4 font-weight-bolder">ACCESOS</h4>
        </div>

        <div class="form-group" align="center">

            <?php
					//cliente
					//--------------------------------
					$lista_menu="select * from gogess_menupanel where mnupan_activo=1 and posp_id=1 and mnupan_id in (SELECT per_codobj FROM app_usuariosperfil WHERE per_activo=1 and usua_id=".@$_SESSION['datadarwin2679_sessid_inicio'].") order by mnupan_orden asc ";

					$rs_listamenu = $DB_gogess->executec($lista_menu,array());
					  if($rs_listamenu)
                        {
                                $icon_val=''; 
						        while (!$rs_listamenu->EOF) {
								echo 	'<div class="col-xl-4 col-sm-4 mb-xl-0">
										    <div class="card">';
								switch ($rs_listamenu->fields["opcionpa_id"]) {
										case 1:
										   {
												if($rs_listamenu->fields["mnupan_iconog"])
												{
												   //$icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_iconog"].'" width="180"  />';
												   $icon_val='<div class="card-header p-2 ps-3"><span class="material-symbols-outlined fs-1 mt-3 mb-3">'.$rs_listamenu->fields["mnupan_icono"].'</span></div><hr class="dark horizontal my-0"><div class="card-footer p-2 ps-3 mt-3 mb-3">
              <p"><span class="nav-link-text fs-4 ms-1 menu-text">'.$rs_listamenu->fields["mnupan_nombre"].'</span></p>
            </div>';
												}
												else
												{
													$icon_val='<div class="card-header p-2 ps-3"><span class="material-symbols-outlined fs-1 mt-3 mb-3">'.$rs_listamenu->fields["mnupan_icono"].'</span></div><hr class="dark horizontal my-0"><div class="card-footer p-2 ps-3 mt-3 mb-3">
              <p"><span class="nav-link-text fs-4 ms-1 menu-text">'.$rs_listamenu->fields["mnupan_nombre"].'</span></p>
            </div>';
												   //$icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/opciones/panel/'.$rs_listamenu->fields["mnupan_archivo"].'\',\'Perfil\',\'divBody_ext\',\''.$_SESSION['datadarwin2679_sessid_inicio'].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)" >
												'.$icon_val.'
												<span class="menu-text" ></span>
												<span class="selected"></span>
											</a>';
											}
											break;
										case 5:
										  {
										     if($rs_listamenu->fields["mnupan_iconog"])
												{
												    //$icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_iconog"].'" width="180"  />';
													$icon_val='<div class="card-header p-2 ps-3"><span class="material-symbols-outlined fs-1 mt-3 mb-3">'.$rs_listamenu->fields["mnupan_icono"].'</span></div><hr class="dark horizontal my-0"><div class="card-footer p-2 ps-3 mt-3 mb-3">
              <p"><span class="nav-link-text fs-4 ms-1 menu-text">'.$rs_listamenu->fields["mnupan_nombre"].'</span></p>
            </div>';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_clave.php\',\'Clave\',\'divBody_ext\',\''.$_SESSION['datadarwin2679_sessid_inicio'].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)">
												'.$icon_val.'
												<span class="menu-text"></span>
												<span class="selected"></span>
											</a>';
										  }	
											break;
										case 6:
										  {
										    if($rs_listamenu->fields["mnupan_iconog"])
												{
												    //$icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_iconog"].'" width="180"  />';
													$icon_val='<div class="card-header p-2 ps-3"><span class="material-symbols-outlined fs-1 mt-3 mb-3">'.$rs_listamenu->fields["mnupan_icono"].'</span></div><hr class="dark horizontal my-0"><div class="card-footer p-2 ps-3 mt-3 mb-3">
              <p"><span class="nav-link-text fs-4 ms-1 menu-text">'.$rs_listamenu->fields["mnupan_nombre"].'</span></p>
            </div>';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
										   echo '<a href="javascript:salir_sistema()">
												'.$icon_val.'
												<span class="menu-text"></span>
												<span class="selected"></span>
											</a>';
										   }	
											break;
										case 7:
										  {
										   if($rs_listamenu->fields["mnupan_iconog"])
												{
												    $icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_iconog"].'" width="180"  />';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
										   echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_contenido.php\',\'Perfil\',\'divBody_ext\',\''.$rs_listamenu->fields["con_id"].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)">
												'.$icon_val.'
												<span class="menu-text"></span>
												<span class="selected"></span>
											</a>';
										   }
										   break;	
										case 8:
										  {
										    if($rs_listamenu->fields["mnupan_grafico"])
												{
												   //$icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_iconog"].'" width="180"  />';
													$icon_val='<div class="card-header p-2 ps-3"><span class="material-symbols-outlined fs-1 mt-3 mb-3">'.$rs_listamenu->fields["mnupan_icono"].'</span></div><hr class="dark horizontal my-0"><div class="card-footer p-2 ps-3 mt-3 mb-3">
              <p"><span class="nav-link-text fs-4 ms-1 menu-text">'.$rs_listamenu->fields["mnupan_nombre"].'</span></p>
            </div>';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_standar.php\',\'Pago\',\'divBody_ext\',\''.@$_SESSION[$rs_listamenu->fields["mnupan_variablesession"]].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)" >
												'.$icon_val.'
												<span class="menu-text" ></span>
												<span class="selected"></span>
											</a>';
										   }	
											break;   
										case 10:
										  {
										     if($rs_listamenu->fields["mnupan_iconog"])
												{
												   $icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_iconog"].'" width="180"  />';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
											echo '<a href="javascript:abrir_standar_pop(\'aplicativos/documental/opciones/panel/'.$rs_listamenu->fields["mnupan_archivo"].'\',\'POP\',\'divBody_ext\',\''.$_SESSION['datadarwin2679_sessid_inicio'].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)" >

												'.$icon_val.'
												<span class="menu-text" ></span>
												<span class="selected"></span>
											</a>';
										  }	
											break;							
										default:
										   echo "";
									}
								echo '</div><br>
								</div>';
								$rs_listamenu->MoveNext();
								}
						}	
					//--------------------------------
					?>

        </div>
    </div>






    <div class="form-group">

        <div class="col-xs-12" align="center">
            <?php 
$fecha_hoy=date("Y-m-d");
$usua_id=$_SESSION['datadarwin2679_sessid_inicio'];

?>


        </div>
    </div>
    <p>&nbsp; </p>

    <div class="container-fluid py-2 form-group">
        <div class="row">
            <div class="col-6 col-xs-12">
                <div class="card my-6">
                    <!-- /* <table width="100" border="0" align="center" cellpadding="0" cellspacing="0"> */ -->
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <div>
                                <span class="text-white text-capitalize fs-4 ps-3 Estilo1">CEDULAS ERRONEAS
                                    VERIFICAR</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <tr>
                                <td valign="top">
                                    <div class=TableScroll>
                                        <table class="table align-items-center mb-0" width="100%" border="0"
                                            cellpadding="0" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                        CEDULA</th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                                        ERROR</th>
                                                </tr>
                                            </thead>
                                            <?php
  $lista_cedulas="select * from app_cliente where LENGTH(clie_rucci)!=10";
  $rs_listacedulas = $DB_gogess->executec($lista_cedulas,array());
  if($rs_listacedulas)
   {
     	while (!$rs_listacedulas->EOF) {
		 $num_digi=strlen($rs_listacedulas->fields["clie_rucci"]);
		 if($num_digi!=10)
		 {
		?>
                                            <tr>
                                                <td class="mb-0 fs-5 caracter_error">
                                                    <?php echo $rs_listacedulas->fields["clie_rucci"]?>
                                                </td>
                                                <td class="mb-0 fs-5 caracter_error">
                                                    <?php echo "Numero digitos incorrecto: ".$num_digi;?>
                                                </td>
                                            </tr>
                                            <?php 
		 } 
		 $rs_listacedulas->MoveNext(); 
		}
		
	}	

  ?>

                                        </table>
                                    </div>
                                </td>
                                <!-- /*<td>&nbsp;</td>
                            <td valign="top">
                                <div class=TableScroll>
                                    <table width="500" border="1" cellpadding="0" cellspacing="1">
                                        <tr>
                                            <td colspan="2" bgcolor="#CEDCE3">
                                                <div align="center"><span class="Estilo1">NUMERO PACIENTES</span></div>
                                            </td>
                                        </tr>
                                        <?php
  $lista_cedulas="select count(app_cliente.centro_id) total,centro_nombre from app_cliente inner join dns_centrosalud on app_cliente.centro_id=dns_centrosalud.centro_id group by app_cliente.centro_id";
  $rs_listacedulas = $DB_gogess->executec($lista_cedulas,array());
  if($rs_listacedulas)
   {
     	while (!$rs_listacedulas->EOF) {
		
		?>
                                        <tr>
                                            <td class="caracter_error">
                                                <b><?php echo utf8_encode($rs_listacedulas->fields["centro_nombre"]); ?></b>
                                            </td>
                                            <td class="caracter_error"><?php echo $rs_listacedulas->fields["total"]; ?>
                                            </td>
                                        </tr>
                                        <?php 
		 
		 $rs_listacedulas->MoveNext(); 
		}
		
	}	

  ?>
                                    </table>
                                </div> */-->

                                </td>
                            </tr>
                        </div>
                    </div>
                    <!-- /*</table>*/ -->
                </div>
            </div>
            <div class="col-6 col-xs-12">
                <div class="card my-6">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <div>
                                <span class="text-white text-capitalize fs-4 ps-3 Estilo1">NUMERO PACIENTES</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <tr>
                                <td valign="top">
                                    <div class=TableScroll>
                                        <table class="table align-items-center mb-0" width="100%" border="0"
                                            cellpadding="0" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                        CENTRO</th>
                                                    <th
                                                        class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                                        TOTAL</th>
                                                </tr>
                                            </thead>
                                            <?php
  $lista_cedulas="select count(app_cliente.centro_id) total,centro_nombre from app_cliente inner join dns_centrosalud on app_cliente.centro_id=dns_centrosalud.centro_id group by app_cliente.centro_id";
  $rs_listacedulas = $DB_gogess->executec($lista_cedulas,array());
  if($rs_listacedulas)
   {
     	while (!$rs_listacedulas->EOF) {
		
		?>
                                            <tr>
                                                <td class="mb-0 fs-5 caracter_error">
                                                    <?php echo utf8_encode($rs_listacedulas->fields["centro_nombre"]); ?>
                                                </td>
                                                <td class="mb-0 fs-5 caracter_error">
                                                    <?php echo $rs_listacedulas->fields["total"]; ?>
                                                </td>
                                            </tr>
                                            <?php 
		 
		 $rs_listacedulas->MoveNext(); 
		}
		
	}	

  ?>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12"></div>
    </div>
</div>

<script language="javascript">
<!--
function fecha_datadiario() {


    $("#grid_diario").load("aplicativos/documental/listados_diario.php", {

        fecha_at: $('#fecha_at').val()

    }, function(result) {



    });



    $("#grid_diario").html("Espere un momento...");



}


function imp_facdiaria() {
    window.open('aplicativos/documental/listados_diarioexcel.php?fecha_at=' + $('#fecha_at').val(), 'ventanad',
        'width=750,height=500,scrollbars=YES');

}

//
-->

</script>