<style>
.active-menu {
    background-color: #000 !important;
    color: #fff !important;
}
.active-menu .material-symbols-outlined {
    color: #fff !important;
}
</style>

<?php
$path_template='';
$path_template='templates/page/';
$busca_datosus="select usua_archivo,usua_nombre,usua_apellido,centro_nombre from app_usuario inner join dns_centrosalud  on app_usuario.centro_id=dns_centrosalud.centro_id where usua_id=?";
$rs_usuarios = $DB_gogess->executec($busca_datosus,array(@$_SESSION['datadarwin2679_sessid_inicio']));
$imagen_avatar='';

function encrypt($text) {

			return base64_encode($text);

   }


function sacaaleat()
	{

						$clave='';
						$max_chars = round(rand(3,3));  // tendr� entre 7 y 10 caracteres
						$chars = array();
						for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
						$chars[] = "z";
						for ($i=0; $i<$max_chars; $i++) {
							$clave .= round(rand(0, 9));
						}
					   return  $clave; 

	}

function variables_segura($linksvar)
	{

		 $valorext=sacaaleat();
		 $valoresencriptados=encrypt($linksvar);																						
		 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);
		 return $linksvarencri;

	}


//echo $es_proveedor;

if($rs_usuarios->fields["usua_archivo"])
{
$imagen_avatar=$rs_usuarios->fields["usua_archivo"];
}
else
{
$imagen_avatar='person.png';
}

?>
<!-- Bootstrap -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <div class="align-items-center">
                <a href="index.php"><img src="images/logosys.png"></a>
                <span class="hoe-sidebar-toggle"><a href="#"></a></span>
            </div>
        </div>
    </nav>
    <div id="hoeapp-wrapper" class="bg-gray-100 hoe-hide-lpanel" hoe-device-type="desktop">
        <div id="sidenav-main hoeapp-container" hoe-color-type="lpanel-bg2" hoe-lpanel-effect="shrink">
            <aside
                class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2 ps"
                id="sidenav-main hoe-left-panel" hoe-position-type="absolute">
                <div class="sidenav-header profile-box">
                    <i class="material-symbols-outlined cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-xl-none"
                        aria-hidden="true">close</i>
                    <div class="media">
                        <!-- <a class="pull-left" href="javascript:ver_formularioenpantalla('aplicativos/documental/datos_usuario.php','Perfil','divBody_ext','<?php echo $_SESSION['datadarwin2679_sessid_inicio'] ?>',0,0,0,0,0,0)"> -->
                        <a href="index.php">
                            <!-- <img class="img-circle" src="archivo/<?php echo $imagen_avatar; ?>"> -->
                            <img src="images/logosys.png" alt="main_logo" style="display: block; margin: auto;">
                        </a>
                        <!-- <div class="media-body">
                            <div class="ms-1 text-sm text-dark media-heading" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px"><b><?php echo $rs_usuarios->fields["usua_nombre"]." ".$rs_usuarios->fields["usua_apellido"]." <strong>".$rs_usuarios->fields["centro_nombre"]."</strong>"; ?></div>
                            <small><?php echo $rs_usuarios->fields["usua_nombre"]." ".$rs_usuarios->fields["usua_apellido"]; ?></small> esta linea estaba comentada
                        </b></div> -->
                    </div>
                </div>
                <hr class="horizontal dark mt-0 mb-2">
                <div class="collapse navbar-collapse w-auto ps" id="sidenav-collapse-main">
                    <ul class="navbar-nav panel-list">
                        <li class="fs-3 text-center text-dark nav-level">MENU</li>
                        <hr class="horizontal dark mt-2 mb-2">
                        <?php
					if($_SESSION['datadarwin2679_sessid_inicio']==75)
					{
					?>
                        <li><a
                                href="javascript:ver_formularioenpantalla('aplicativos/documental/opciones/panel/planillas_code.php','Perfil','divBody_ext','74','28',0,0,0,0,0)">
                                <img src="archivo/gogess_data95047DMGJS20190318.png" width="20" height="20"><span
                                    class="menu-text">Planillaje</span>
                                <span class="selected"></span>
                            </a></li>
                        <?php
					}
					?>
                        <?php
					//cliente
					//--------------------------------
					$lista_menu="select * from gogess_menupanel where mnupan_activo=1 and posp_id=1 and mnupan_id in (SELECT per_codobj FROM app_usuariosperfil WHERE per_activo=1 and usua_id=".@$_SESSION['datadarwin2679_sessid_inicio'].") order by 	mnupan_nombre asc ";

					$rs_listamenu = $DB_gogess->executec($lista_menu,array());
					  if($rs_listamenu)
                        {
                                $icon_val=''; 
						        while (!$rs_listamenu->EOF) {
								echo '<li class="nav-item">';
								switch ($rs_listamenu->fields["opcionpa_id"]) {
										case 1:
										   {
												if($rs_listamenu->fields["mnupan_grafico"])
												{
												   //$icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'" width="20" height="20" />';
												   $icon_val='<span class="material-symbols-outlined">'.$rs_listamenu->fields["mnupan_icono"].'</span>';
												}
												else
												{
												   //$icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												   $icon_val='<span class="material-symbols-outlined">'.$rs_listamenu->fields["mnupan_icono"].'</span>';
												}
											echo '<a id="menu_'.$rs_listamenu->fields["mnupan_id"].'" class="nav-link ms-0 text-dark" href="javascript:ver_formularioenpantalla(\'aplicativos/documental/opciones/panel/'.$rs_listamenu->fields["mnupan_archivo"].'\',\'Perfil\',\'divBody_ext\',\''.$_SESSION['datadarwin2679_sessid_inicio'].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)" >
												'.$icon_val.'
												<span class="nav-link-text fs-5 ms-1 menu-text" >'.$rs_listamenu->fields["mnupan_nombre"].'</span>
												<span class="selected"></span>
											</a>';
											}
											break;
										case 5:
										  {
										     if($rs_listamenu->fields["mnupan_grafico"])
												{
												   //$icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'" width="20" height="20" />';
												   $icon_val='<span class="material-symbols-outlined">'.$rs_listamenu->fields["mnupan_icono"].'</span>';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												   
												}
											echo '<a id="menu_'.$rs_listamenu->fields["mnupan_id"].'" class="nav-link ms-0 text-dark" href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_clave.php\',\'Clave\',\'divBody_ext\',\''.$_SESSION['datadarwin2679_sessid_inicio'].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)">
												'.$icon_val.'
												<span class="nav-link-text fs-5 ms-1 menu-text">'.$rs_listamenu->fields["mnupan_nombre"].'</span>
												<span class="selected"></span>
											</a>';
										  }	
											break;
										case 6:
										  {
										    if($rs_listamenu->fields["mnupan_grafico"])
												{
												   //$icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'" width="20" height="20" />';
												   $icon_val='<span class="material-symbols-outlined">'.$rs_listamenu->fields["mnupan_icono"].'</span>';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
										   echo '<a id="menu_'.$rs_listamenu->fields["mnupan_id"].'" class="nav-link ms-0 text-dark" href="javascript:salir_sistema()">
												'.$icon_val.'
												<span class="nav-link-text ms-1 menu-text">'.$rs_listamenu->fields["mnupan_nombre"].'</span>
												<span class="selected"></span>
											</a>';
										   }	
											break;
										case 7:
										  {
										   if($rs_listamenu->fields["mnupan_grafico"])
												{
												   $icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'" width="20" height="20" />';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												   //$icon_val='<span class="material-symbols-outlined">'.$rs_listamenu->fields["mnupan_icono"].'</span>';
												}
										   echo '<a id="menu_'.$rs_listamenu->fields["mnupan_id"].'" class="nav-link ms-0 text-dark" href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_contenido.php\',\'Perfil\',\'divBody_ext\',\''.$rs_listamenu->fields["con_id"].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)">
												'.$icon_val.'
												<span class="nav-link-text fs-5 ms-1 menu-text">'.$rs_listamenu->fields["mnupan_nombre"].'</span>
												<span class="selected"></span>
											</a>';
										   }
										   break;	
										case 8:
										  {
										    if($rs_listamenu->fields["mnupan_grafico"])
												{
													$icon_val='<span class="material-symbols-outlined">'.$rs_listamenu->fields["mnupan_icono"].'</span>';
												    //$icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'" width="20" height="20" />';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
											echo '<a id="menu_'.$rs_listamenu->fields["mnupan_id"].'" class="nav-link ms-0 text-dark" href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_standar.php\',\'Pago\',\'divBody_ext\',\''.@$_SESSION[$rs_listamenu->fields["mnupan_variablesession"]].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)" >
												'.$icon_val.'
												<span class="nav-link-text fs-5 ms-1 menu-text" >'.$rs_listamenu->fields["mnupan_nombre"].'</span>
												<span class="selected"></span>
											</a>';
										   }	
											break;   
										case 10:
										  {
										     if($rs_listamenu->fields["mnupan_grafico"])
												{
												    $icon_val='<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'" width="20" height="20" />';
												}
												else
												{
												   $icon_val='<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>';
												}
											echo '<a class="nav-link ms-0 text-dark" href="javascript:abrir_standar_pop(\'aplicativos/documental/opciones/panel/'.$rs_listamenu->fields["mnupan_archivo"].'\',\'POP\',\'divBody_ext\',\''.$_SESSION['datadarwin2679_sessid_inicio'].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)" >

												'.$icon_val.'
												<span class="nav-link-text fs-5 ms-1 menu-text" >'.$rs_listamenu->fields["mnupan_nombre"].'</span>
												<span class="selected"></span>
											</a>';
										  }	
											break;							
										default:
										   echo "";
									}
								echo '</li>';
								$rs_listamenu->MoveNext(); 
								}
						}		
					//--------------------------------

					?>
                    </ul>
                </div>
            </aside>
            <section id="main-content">
                <div id=acceso_panel><br>
                    <div id="divBody_ext" style="height:100%">
                        <?php
$buscaopcionapl="select * from gogess_opcionaplicativo where ap_id=? and opap_activo='?'";
$rs_aplopciones = $DB_gogess->executec($buscaopcionapl,array($apl,1));
  if($rs_aplopciones)
  {

     	while (!$rs_aplopciones->EOF) {
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["ejecuta"]=$rs_aplopciones->fields["opap_ejecuta"];
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["id"]=$rs_aplopciones->fields["opap_id"];
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["nombre"]=$rs_aplopciones->fields["opap_nombre"];

		if($rs_aplopciones->fields["opap_intro"]==1)
		{

		 $opcioninical=$rs_aplopciones->fields["opap_ejecuta"];
		 $idopcioninical=$rs_aplopciones->fields["opap_id"];
		}

		$rs_aplopciones->MoveNext(); 
		}
  }


 //print_r($arrayopciones);
  $idvalor_opcion=0;

  if(!(@$seccapl))
  {

     $idvalor_opcion=@$idopcioninical;

	// include("menu/menu.php");
	 include("opciones/".trim(@$opcioninical).".php");

  }
  else
  {

    $idvalor_opcion=$arrayopciones[$seccapl]["id"];
	$pantalla_nombre=$arrayopciones[$seccapl]["nombre"];
	//include("menu/menu.php");
	echo '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td bgcolor="#E7EFF5" ><b>'.trim($pantalla_nombre).'</b></td></tr></table>';
	//echo "opciones/".$arrayopciones[$seccapl]["ejecuta"].".php";
	include("opciones/".$arrayopciones[$seccapl]["ejecuta"].".php");

  }

?>
                    </div>
                </div>


                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </section>
        </div>
    </div>
</main>
<div id="reactiva_sess"></div>
<script>
function verifica_session() {

    $("#reactiva_sess").load("session.php", {

    }, function(result) {});
    $("#reactiva_sess").html("Wait a moment...");

}

setInterval(verifica_session, 600000);

document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.nav-link');

    links.forEach(link => {
        link.addEventListener('click', function () {
            // Quitar clase activa de todos
            links.forEach(l => l.classList.remove('active-menu'));
            // Agregar clase activa solo al clic actual
            this.classList.add('active-menu');
        });
    });
});
</script>