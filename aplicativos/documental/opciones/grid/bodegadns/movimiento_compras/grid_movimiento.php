<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<style type="text/css">
<!--
table.dataTable tbody th,
table.dataTable tbody td {
    padding: 1px 10px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
}
-->
</style>
<?php
if(@$_SESSION['datadarwin2679_sessid_inicio'])
{
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$carpeta='movimiento';
$tabla="dns_temporalovimientoinventario";
$tabla_vista="dns_temporalovimientoinventario_vista";
$subindice="_movimiento";
$campos_paragrid="'moviin_id','nombre_med','tipom_nombre','tipomov_nombre ','moviin_nlote','moviin_fechadecaducidad','moviin_fecharegistro','moviin_totalenunidadconsumo','moviin_preciocompra','centrorecibe_observacion','moviin_verificado','moviin_descext'";
$campo_id="moviin_id";
$sqltotal="";
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 
 
$sql1='';
$sql2='';
$sql3='';
$sql4='';
$sql5='';
$sql6='';

@$compra_id=$_POST["compra_id"];
$insu_valorx=$_POST["insu_valorx"];
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$ntabla= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_title"," where tab_name like",$tabla,$DB_gogess);
$comillasimple="'";


$busca_cierre=$objformulario->replace_cmb("dns_compras","compra_id,compra_procesado"," where compra_id=",$compra_id,$DB_gogess);
$columna_ordena=4;
if($busca_cierre==0)
{
  $boto_borrar=1;
  $columna_ordena=5;
}

$boto_borrar=0;
//Crea tabla para grid
$objgrid_fk->campos_visualizar=$campos_paragrid;
$ordenlistado="order by ".$campo_id." desc";
$objgrid_fk->orden=$ordenlistado;
$objgrid_fk->leer_data($tabla_vista,"","","",90,$sqltotal,$DB_gogess);

$busca_eltotal="select sum(centrorecibe_cantidad*moviin_preciocompra) as totalc from dns_temporalovimientoinventario_vista where compra_id='".$compra_id."'";
$rs_eltotal = $DB_gogess->executec($busca_eltotal,array());

echo '<div class="container-fluid py-2">';
echo '<div class="row">';
echo '<div class="col-12">';
echo '<div style="font-size:17px"><b>Total de todos los ingresos de esta factura:'.number_format($rs_eltotal->fields["totalc"], 2, '.', '').'</b></div><br><br>';
echo '<div class="card my-4">';
echo '<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">';
echo '<div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 panel-heading">';
echo '<h3 class="text-white text-capitalize ps-3 panel-title">'.$ntabla.'<//h3>';
echo '</div>';
echo '</div>';
echo '<div class="card-body px-0 pb-2">';
echo '<div class="table-responsive p-0">';
echo '<table id="datatable1'.$tabla.'" class="table text-start mb-0" cellspacing="0" width="100%"><thead><tr>';
echo '<th class="text-uppercase text-secondary font-weight-bolder opacity-7">Editar</th>';
if($boto_borrar)
{

echo '<th class="text-uppercase text-secondary font-weight-bolder opacity-7">Borrar</th>';

}
		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';

	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{
		 echo '<th class="text-uppercase text-secondary font-weight-bolder opacity-7">'.$objgrid_fk->arrcampos_titulo[$i].'</th>';

	}            

echo '</tr></thead>';
echo '<tfoot><tr>';
echo '<th class="text-uppercase text-secondary font-weight-bolder opacity-7">Editar</th>';

if($boto_borrar)
{

echo '<th class="text-uppercase text-secondary font-weight-bolder opacity-7">Borrar</th>';
}

		//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';

	for ($i=0;$i<count($objgrid_fk->arrcampos_titulo);$i++)
	{

		 echo '<th class="text-uppercase text-secondary font-weight-bolder opacity-7">'.$objgrid_fk->arrcampos_titulo[$i].'</th>';

	}            
echo '</tr></tfoot>';		
echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

$concatena_camp='';
$concatena_data='';


foreach($objgrid_fk->arrcampos_nombre as $camposdata): 

if($campo_id==$camposdata or $camposdata=='centrorecibe_observacion' or $camposdata=='moviin_verificado')
	 {
	  $concatena_camp.= '{ "data": "'.$camposdata.'","visible": false },';

	 }
	 else
	 {
	  $concatena_camp.= '{ "data": "'.$camposdata.'" },';
	  }

	  $concatena_data.=$camposdata.",";

endforeach; 



//filtros

//insu_valorx

//if(@$_POST['cuadrobm_id'])
//{

 //  $sql1="cuadrobm_id = '".@$_POST['cuadrobm_id']."' and ";

//}


if(@$_POST['centro_id'])
{

   $sql2="centro_id = '".@$_POST['centro_id']."' and ";

}

if($insu_valorx)
{
  // $sql3="categ_id = '".@$insu_valorx."' and ";
}

if($compra_id)
{

  $sql4="compra_id = '".@$compra_id."' and ";
}



@$sqltotal=$sql1.$sql2.$sql3.$sql4;
echo $sqltotal=substr($sqltotal,0,-4);
$filtro_data=base64_encode($sqltotal);

//filtros
?>
<script type="text/javascript">
<!--
$('#datatable1<?php echo $tabla; ?>').DataTable({

    "aaSorting": [
        [<?php echo $columna_ordena; ?>, "asc"]
    ],
    "language": {
        "lengthMenu": "Ver _MENU_ registros por pag.",
        "zeroRecords": "No hay registros - sorry",
        "info": "Pag. _PAGE_ de _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst": "Primero",
            "sPrevious": "Anterior",
            "sNext": "Siguiente",
            "sLast": "Ultimo"
        }

    },
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "../../../../../libreria/grid/scripts/post.php",
        "data": function(d) {
            d.tabla = "<?php echo $tabla_vista; ?>";
            d.id = "<?php echo $campo_id; ?>";
            d.lista = "<?php echo $concatena_data; ?>";
            d.filtro = "<?php echo $filtro_data; ?>";
        },
        "type": "POST"
    },

    "columns": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button></button>",
            "mRender": function(data, type, full) {

                if (full["centrorecibe_observacion"] != '') {

                    if (full["moviin_verificado"] == '0') {
                        return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="desplegar_formulario(' +
                            full["<?php echo $campo_id ?>"] +
                            ')" style=cursor:pointer ><span class="ms-2 fs-1 material-symbols-outlined">edit_note</span></td></tr></table>'; //<center><img src="editarsv.png"  /></center>
                    } else {
                        return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="desplegar_formulario(' +
                            full["<?php echo $campo_id ?>"] +
                            ')" style=cursor:pointer ><span class="ms-2 fs-1 material-symbols-outlined">edit_note</span></td></tr></table>'; //<center><img src="editaral.png"  /></center>
                    }

                } else {
                    if (full["moviin_verificado"] == '0') {
                        return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="desplegar_formulario(' +
                            full["<?php echo $campo_id ?>"] +
                            ')" style=cursor:pointer ><span class="ms-2 fs-1 material-symbols-outlined">edit_note</span></td></tr></table>'; //<center><img src="editarsv.png"  /></center>
                    } else {
                        return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="desplegar_formulario(' +
                            full["<?php echo $campo_id ?>"] +
                            ')" style=cursor:pointer ><span class="ms-2 fs-1 material-symbols-outlined">edit_note</span></td></tr></table>'; //<center><img src="../../../../../images/editar.png"  /></center>
                    }
                }

            }

        }
        <?php 
		 if($boto_borrar)
		 {
		 ?>,
        {
            "targets": -1,
            "data": null,
            "defaultContent": "<button></button>",
            "mRender": function(data, type, full) {

                return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="borrar_registro_comp(\'<?php echo $tabla;  ?>\',\'<?php echo $campo_id; ?>\',' +
                    full["<?php echo $campo_id ?>"] +
                    ')" style=cursor:pointer ><span class="ms-2 fs-1 material-symbols-outlined">edit_note</span></td></tr></table>'; //<center><img src="../../../../../images/delete.png"  /></center>
            }
        }
        <?php
		 }
		 ?>,
        <?php
		  echo substr($concatena_camp,0,-1);
		  ?>
    ]
});
-->
</script>
<div id="divBody_causasdet"></div>
<div id="divBody_arbidet"></div>
<?php
}
else
{



echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000 ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';



}



?>