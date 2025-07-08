<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
?>



<script type="text/javascript">
//   jQuery(function($) { $('#clave_nueva').pwstrength(); });
</script>



<script type="text/javascript">
<!--
function guardar_clave()

{

    if ($('#clave_old').val() == '')

    {

        alert('Debe llenar el Campo Clave Anterior:');

        return false;

    }



    if ($('#clave_nueva').val() == '')

    {

        alert('Debe llenar el Campo Clave Nueva:');

        return false;

    }



    if ($('#clave_nueva').val() != $('#re_clave_nueva').val())

    {

        alert('Deben ser igual la confirmacion de la clave a la clave:');

        return false;

    }







    $("#guardar_clave").load("aplicativos/documental/cambioclave.php", {

        id_valor: '<?php echo $_SESSION['datadarwin2679_sessid_inicio']; ?>',
        clave_old: $('#clave_old').val(),
        clave_nueva: $('#clave_nueva').val(),
        re_clave_nueva: $('#re_clave_nueva').val()

    }, function(result) {



        if ($('#exito_val').val() == 1)

        {

            setTimeout(function() {
                location.reload()
            }, 2000);

        }



    });

    $("#guardar_clave").html("Espere un momento...");



}





//  End 
-->

</script>

<p>&nbsp;</p>

<p>&nbsp;</p>

<div class="container-fluid py-10 container">
    <!--style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:900px;"-->
    <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
                        <h3 class="text-white text-capitalize ps-3 panel-title">Desea cambiar su clave?</h3>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form role="form" class="ms-3 mx-3">
                        <div class="input-group input-group-outline my-3">
                            <input name="clave_old" type="password" id="clave_old" class="form-control"
                                placeholder="Clave Anterior" />
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <input name="clave_nueva" type="password" id="clave_nueva" class="form-control"
                                data-indicator="pwindicator" placeholder="Clave Nueva" />
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <input name="re_clave_nueva" type="password" id="re_clave_nueva" class="form-control"
                                placeholder="Confirmación de clave" />
                        </div>
                        <div id="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="guardar_clave()"
                                class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary">Cambiar clave</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id=guardar_clave>

        <input name="exito_val" type="hidden" id="exito_val" value="0" />

    </div>
    <p>&nbsp;</p>
</div>

                <!--  <td>&nbsp;</td>

			    <td><button type="button" class="mb-sm btn btn-danger" onclick="funcion_cerrar_pop('divDialog_ext')">Cancelar</button></td> -->
    <?php
}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000" align="center" >Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
}	
?>