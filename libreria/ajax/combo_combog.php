<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
//echo getcwd();
/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
$$tags[$i]=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
$nombre_var='';
for($i=0;$i<$numero2;$i++){ 
$nombre_var=$tags2[$i];
$$nombre_var=$valores2[$i]; 
}

?>
<?php

//Llamando objetos
$director="../../";
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
//Conexion a la base de datos

$hoyfecha=date("Y-m-d H:i:s");
$hoyfechac=date("Y-m-d");

	$campoafecta=$_POST["q"];
	$datobusca=$_POST["q1"];
	$divdata=$_POST["q2"];
	$campoenlace=$_POST["q3"];
	$tabla=$_POST["q4"];
	$valor=$_POST["q5"];


$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$tabla.".json");
$gogess_sistable = json_decode($contenido, true);
//leer con json
$contenido = file_get_contents(@$director."jason_files/estructura/".$tabla.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 
	

$objformulario = new ValidacionesFormulario();
$objformulario->sisfield_arr = $gogess_sisfield;
$objformulario->sistable_arr = $gogess_sistable;

$objformulario->fie_campoafecta = '';
$objformulario->fie_camporecibe = '';
$objformulario->campo_gogess($tabla, $campoafecta, $DB_gogess);

if ($objformulario->fie_obl) {
    if (!($objformulario->fie_txtextra)) {
        if (!($objformulario->imprpt)) {
            $objformulario->fie_txtextra = "*";
        }
    }
}

// Evitamos creación dinámica chequeando si existen, o asignamos vacío
$fie_campoafecta = $objformulario->fie_campoafecta ?? '';
$fie_evitaambiguo = $objformulario->fie_evitaambiguo ?? '';
$contenid_val = isset($objformulario->contenid[$fie_campoafecta]) ? $objformulario->contenid[$fie_campoafecta] : '';

if ($fie_campoafecta) {
    if ($fie_evitaambiguo) {
        $clicdata = "onClick=showUser_combog('".$fie_campoafecta."', $('#".$campoafecta."').val(), 'div".$fie_campoafecta."', '".$fie_evitaambiguo.".".$campoafecta."', '".$objformulario->tab_name."', '".$contenid_val."', 0,0,0,0,0)";
    } else {
        $clicdata = "onClick=showUser_combog('".$fie_campoafecta."', $('#".$campoafecta."').val(), 'div".$fie_campoafecta."', '".$campoafecta."', '".$objformulario->tab_name."', '".$contenid_val."', 0,0,0,0,0)";
    }

    printf(
        "<select name='%s' id='%s' class='%s' %s %s>",
        $campoafecta,
        $campoafecta,
        $objformulario->fie_styleobj,
        $objformulario->fie_attrib,
        $clicdata
    );
    printf("<option value=''>---Seleccionar--</option>");
    $objformulario->fill_cmb(
        $objformulario->fie_tabledb,
        $objformulario->fie_datadb,
        $valor,
        " where ".$campoenlace."=".$datobusca." ".$objformulario->fie_sqlorder,
        $DB_gogess
    );
    printf("</select>%s", $objformulario->fie_txtextra);

} else {

    $tipocampo = "select ".$objformulario->fie_camporecibe." from ".$objformulario->fie_tabledb." ";

    $resultado1 = $DB_gogess->executec($tipocampo, array());
    if ($resultado1) {

        $fld = $resultado1->FetchField(0);
        $nombre_campo = strtolower($fld->name);
        $typecampo = $resultado1->MetaType($fld->type);

        if ($typecampo == "C") {
            printf(
                "<select name='%s' id='%s' class='%s' %s >",
                $campoafecta,
                $campoafecta,
                $objformulario->fie_styleobj,
                $objformulario->fie_attrib
            );
            printf("<option value=''>---Seleccionar--</option>");
            $objformulario->fill_cmb(
                $objformulario->fie_tabledb,
                $objformulario->fie_datadb,
                $valor,
                " where ".$objformulario->fie_camporecibe." = ".$datobusca." ".$objformulario->fie_sqlorder,
                $DB_gogess
            );
            printf("</select>%s", @$objformulario->txtobligatorio);
        } else {
            printf(
                "<select name='%s' id='%s' class='%s' %s >",
                $campoafecta,
                $campoafecta,
                $objformulario->fie_styleobj,
                $objformulario->fie_attrib
            );
            printf("<option value=''>---Seleccionar--</option>");
            $objformulario->fill_cmb(
                $objformulario->fie_tabledb,
                $objformulario->fie_datadb,
                $valor,
                " where ".$objformulario->fie_camporecibe."=".$datobusca." ".$objformulario->fie_sqlorder,
                $DB_gogess
            );
            printf("</select>%s", $objformulario->txtobligatorio);
        }
    }
}
							
?>
