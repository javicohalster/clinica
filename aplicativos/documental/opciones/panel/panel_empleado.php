<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");


if(@$_SESSION['datadarwin2679_sessid_inicio'])

{



//Llamando objetos



//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));
$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

//saca datos de la tabla

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";
$subindice='_empleado';
$carpeta='empleado';

?>


<script type="text/javascript">
<!--
function desplegar_grid(tipo) {

    $("#grid<?php echo $subindice; ?>").load(
        "aplicativos/documental/opciones/grid/<?php echo $carpeta; ?>/grid<?php echo $subindice; ?>.php", {
            pVar2: <?php echo $_POST["pVar2"] ?>,
            todos: tipo,
            ci_medico: '<?php echo $_SESSION['datadarwin2679_sessid_inicio']; ?>',
            busca_valorci: $('#busca_valorci').val()
            //filtro_val:$('#filtro_val').val()


        },
        function(result) {


        });

    $("#grid<?php echo $subindice; ?>").html("Espere un momento");

}



function mensaje_borrado(mensaje) {

    alert(mensaje);

}


function borrar_registro(tabla, campo, valor) {

    if (confirm("Esta seguro que desea borrar este registro ?")) {

        $("#grid_borrar").load("aplicativos/documental/opciones/grid/grid_borrar.php", {
            ptabla: tabla,
            pcampo: campo,
            pvalor: valor

        }, function(result) {

            desplegar_grid(0);

        });

        $("#grid_borrar").html("Espere un momento");


    }

}
$(".messages").hide();
//queremos que esta variable sea global
var fileExtension = "";
//funci�n que observa los cambios del campo file y obtiene informaci�n


function informacion_archivo(campo) {

    //obtenemos un array con los datos del archivo
    var file = $("#" + campo + "imagen")[0].files[0];
    //obtenemos el nombre del archivo
    var fileName = file.name;
    //obtenemos la extensi�n del archivo
    fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
    //obtenemos el tama�o del archivo
    var fileSize = file.size;
    //obtenemos el tipo de archivo image/png ejemplo
    var fileType = file.type;
    //mensaje con la informaci�n del archivo
    var megas = 0;
    megas = eval(fileSize) / 1048576;

    showMessage("<span class='info" + campo +
        "' style='padding: 10px; border-radius: 10px; background: orange; color: #fff;font-family:Verdana, Arial, Helvetica, sans-serif;text-align: center;font-size:11px;' >Peso: " +
        megas.toFixed(4) + " MB.</span>", campo);

}


function subir_archivo(ncampo, table, anchot, altot, anchoor, altoor) {

    if (isImage(fileExtension)) {

        var formData = new FormData($("#form_" + table)[0]);
        formData.append("ncampo", ncampo);
        formData.append("anchot", anchot);
        formData.append("altot", altot);
        formData.append("anchoor", anchoor);
        formData.append("altoor", altoor);
        var nombre_campo = ncampo;
        var message = "";
        //hacemos la petici�n ajax  
        $.ajax({

            url: 'libreria/archivo/upload.php',
            type: 'post',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function() {
                message = $("<span class='before' >Subiendo imagen, por favor espere</span>");
                showMessage(message, nombre_campo)
            },
            //una vez finalizado correctamente
            success: function(data) {

                if (data.trim() != '') {

                    message = $("<span class='success' >Imagen ha subido correctamente.</span>");

                } else {
                    message = $("<span class='success' >Por favor seleccione un archivo.</span>");
                }


                showMessage(message, nombre_campo);
                if (isImage(fileExtension)) {

                    if (data.trim() != '') {

                        $(".showImage" + ncampo).html("&nbsp;<a href='archivo/" + data +
                            "' target='_blank' class='thumbnail' ><img src='images/pdf2.png' alt='125x125' width='50px' ></a>"
                        );

                    }
                } else {
                    if (data.trim() != '') {


                        $(".showImage" + ncampo).html("&nbsp;<a href='archivo/" + data +
                            "' target='_blank' class='thumbnail' ><img src='images/pdf2.png' alt='125x125' width='50px' ></a>"
                        );

                    }

                }


                $('#' + nombre_campo).val(data);
            },
            //si ha ocurrido un error
            error: function() {

                message = $("<span class='error' >Ha ocurrido un error. Seleccione el archivo</span>");
                showMessage(message, nombre_campo);
            }

        });


    } else {

        alert("Archivo no permitido solo (jpg,png,gif,pdf)");

    }


}

//como la utilizamos demasiadas veces, creamos una funci�n para 
//evitar repetici�n de c�digo
function showMessage(message, campo) {
    $(".messages" + campo).html("").show();
    $(".messages" + campo).html(message);
}


//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension) {

    switch (extension.toLowerCase()) {


        case 'jpg':
        case 'gif':
        case 'png':
        case 'jpeg':
        case 'pdf':
            return true;

            break;

        default:

            return false;

            break;
    }

}

function refreshFrame(nframe, path) {

    $('#' + nframe).attr('src', path);

}
//  End 
-->
</script>
<style type="text/css">
<!--
.alert-success {

    color: #000033;
    background-color: #FFFFFF;
    border-color: #ffffff;
}

.alert-success1 {
    color: #000033;
    background-color: #FFFFFF;
    border-color: #000000;
}
-->
</style>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
    <!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->
    <div class="container-fluid py-2" id="lista_manos">
        <!-- despliegue -->
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">
                            <h3 class="text-white text-capitalize ps-3 panel-title" style="color:#000033">FICHA DE
                                PERSONAL</h3>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <form id="form_<?php echo $rs_tabla->fields["tab_name"] ?>"
                            name="form_<?php echo $rs_tabla->fields["tab_name"] ?>" method="post" action=""
                            class="form-horizontal" enctype="multipart/form-data">



                            <div class="form-group">



                                <div class="col-xs-12">



                                    <?php
$comill_s="'";



$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_empleado.php'.$comill_s.','.$comill_s.'EMPLEADO'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.','.$comill_s.$comill_s.','.$comill_s.$_POST["pVar2"].$comill_s.',0,0,0,0,0)" style=cursor:pointer';	



echo '<div class="text-center">';

echo '<button type="button" class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';

//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-success" onClick="desplegar_grid(1)"  style="cursor:pointer"> MIS empleado </button>';
echo '</div>';
?>

                                </div>
                            </div>
                        </form>
                        <div class="table-responsive p-0">
                            <table border="0" align="center" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <div class="input-group input-group-outline my-3">
                                                    <input class="form-control" name="busca_valorci" type="text"
                                                        id="busca_valorci" size="50" placeholder="CÉDULA / NOMBRE" />
                                                </div>
                                                <input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary"
                                                    type="button" name="Button" value="BUSCAR"
                                                    onclick="desplegar_grid(0)" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div id="lista_clientes"></div>-->
        <div class="row">
            <div class="col-12">
                <div class="card my-4" id=grid<?php echo $subindice; ?>>&nbsp;</div>
            </div>
        </div><br><br>
        <script type="text/javascript">
        <!--
        //desplegar_grid();

        //  End 
        -->
        </script>

        <div id="divBody<?php echo $subindice; ?>"></div>



        <div id="grid_borrar"></div>
        <!-- despliegue -->
    </div>
</div>

<?php

}
else
{


echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Tu sesi&oacute;n ha expirado</div></center>';
echo '

<script type="text/javascript">
<!--

abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,0,0,0,0,0,0,0);

//  End -->

</script>



<div id="divBody_acsession"></div>

';


}

?>