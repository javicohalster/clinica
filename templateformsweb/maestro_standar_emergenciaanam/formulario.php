<style>
  .ui-autocomplete {
    max-height: 400px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 400px;
  }

.tableScroll_grids {
        z-index:99;
        height:190px;	
        overflow: auto;
      }  

</style>
<?php
            
	        //---ENLACE
			$tipofor_id=0;
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['datadarwin2679_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$clie_id;		
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["centro_idx"]=$centro_id;
			$objformulario->sendvar["estaatenc_idx"]=4;
			$objformulario->sendvar["tipofor_idx"]=$tipofor_id;			
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
					

			//--------------------------------------------------
			//busca signos vitales			
			$objformulario->sendvar["atenc_enlacex"]=$rs_atencion->fields["atenc_enlace"];	
            $objformulario->sendvar["conext_etiquetasignosvx"]=$enlace_atencion;			
			//--------------------------------------------------
			
			$objformulario->sendvar["atenc_idx"]=$atenc_id;

			//asigna medico
           
			$objformulario->sendvar["usua_idx"]=@$_SESSION['datadarwin2679_sessid_inicio'];			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['datadarwin2679_sessid_cedula'].$_SESSION['datadarwin2679_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["anam_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
		
?>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  echo $rs_atencion->fields["atenc_hc"]; ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
	   <?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>

    </span></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">EDAD (A la fecha de atenci&oacute;n):</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	?></td>
  </tr>
    <tr>
    <td bgcolor="#D3E0EB"><span class="css_paciente">ESTABLECIMIENTO:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,77,$DB_gogess); ?> </td>
    <td bgcolor="#D3E0EB"><span class="css_paciente">PROFESIONAL:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,88,$DB_gogess); ?></td>
  </tr>
  
  
</table>


<p>&nbsp;</p>


<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
?>

<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
<div id="mujer_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
?>
</div>
<!--<input type="button" name="btn_antecedentesp_id" id="btn_antecedentesp_id" value="ANTECEDENTES PERSONALES" onclick="ocultar_mostrar('antecedentesp_id')"/>-->
<input onclick="ocultar_mostrar('antecedentesp_id')"/>
<!--<input type="button" name="btn_antecedentesf_id" id="btn_antecedentesf_id" value="ANTECEDENTES FAMILIARES" onclick="ocultar_mostrar('antecedentesf_id')" />-->
<div id="antecedentesp_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
?>
</div>
<!--<div id="antecedentesf_id">
<?php
//$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
?>
</div> -->
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
?>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
?>
<input type="button" name="btn_signos_id" id="btn_signos_id" value="SIGNOS VITALES"  onclick="ocultar_mostrar2('signos_id')" />
<!--<input type="button" name="btn_revicionorgf_id" id="btn_revicionorgf_id" value="REVISION ACTUAL DE ORGANOS Y SISTEMAS" onclick="ocultar_mostrar2('revicionorgf_id')" />-->
<input type="button" name="btn_examenfisico_id" id="btn_examenfisico_id" value="EXAMEN FÍSICO REGIONAL"  onclick="ocultar_mostrar2('examenfisico_id')"  />
<!--<div id="revicionorgf_id">
<?php
//$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess);
?>
</div>-->
<div id="signos_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
?>
</div>
<div id="examenfisico_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess); 
?>
</div>

<?php
$templateGridSectionAdditionals = [
    "<div class='col-md-12'><div class='form-group'><div class='col-xs-12' style='background-color:#000033;color:#FFFFFF' id='anam_etiquetatopografico_html'>9. DIAGRAMA TOPOGRAFICO </div></div></div>",
    <<<ITEM
        <div class='col-md-6'>
            <img src="templateformsweb/maestro_standar_emergenciaanam/images/diagramatopografico.jpg" width="450" height="425" />
            <svg style="z-index:999; border:1px solid green; position:absolute; top:0; left:0; " class='svg-img' width="450" height="425"></svg>
        </div>
    ITEM,
    <<<ITEM
        <div class='col-md-2'>
            <button type="button" onclick="deletePointDiagram()">Eliminar</button>
        </div>
    ITEM,
    "<div class='col-md-4 items-action-dragdrop'>###PUT###</div>",
];
$objformulario->generar_formulario_bootstrap_v2(@$submit,$table,12,$DB_gogess, $templateGridSectionAdditionals);
?>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess); 
?>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess); 
?>
<input type="button" name="btn_diagnostico_id" id="btn_diagnostico_id" value="DIAGNOSTICOS" onclick="ocultar_mostrar3('diagnostico_id')" />
<input type="button" name="btn_recetapres_id" id="btn_recetapres_id" value="RECETA / PRESCRIPCION"  onclick="ocultar_mostrar3('recetapres_id')" />
<input type="button" name="btn_dispositivos_id" id="btn_dispositivos_id"  value="DISPOSITIVOS MEDICOS"  onclick="ocultar_mostrar3('dispositivos_id')"  />
<!-- <input type="button" name="btn_tarifario_id" id="btn_tarifario_id" value="TARIFARIO"  onclick="ocultar_mostrar3('tarifario_id')"  /> -->
<div id="tarifario_id">
<?php
//$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
?>
</div>
<div id="diagnostico_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);
?>
</div>
<div id="recetapres_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,16,$DB_gogess);
?>
</div>
<div id="dispositivos_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,17,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,18,$DB_gogess);
//$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,19,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,20,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,21,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,22,$DB_gogess);
if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";
?>
<div id=div_<?php echo $table ?> > </div>


<script>
        var storeCoords = [];
         $(function() {
            $( "#diagn_ciex" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx').val(ui.item.descripcion);
					
			   }
            });
            
            //draganddrop items
            var titleDiagramTopo = null;
            $(".items-action-dragdrop").on("click", "input[type='checkbox']", function(){
                titleDiagramTopo = $(this).parent().parent().find("b");
                if(titleDiagramTopo.length > 0){
                    //console.log("click sobre check... ", $(this).attr("id"), " title ", titleDiagramTopo.text() )
                }
            });
            
            let UUID = function(size) {
                var HEX = "0123456789ABCDEF", id = "";
                if (arguments.length === 0) size = 16;
                for (var i = 0; i < size; i++) id = id + HEX[~~(Math.random() * 16)];
                return id;
            };
            
            
            //console.log(" svg length ", svg.length);
            //svg.setAttribute("src", "templateformsweb/maestro_standar_emergenciaanam/images/diagramatopografico.svg");
            //svg.setAttribute("width", "450");
            //svg.setAttribute("height", "425");
            
            function insertRect(posX, posY, color){
                let svg = document.querySelector('.svg-img');
                let shape = document.createElementNS("http://www.w3.org/2000/svg", 'rect');
                shape.setAttributeNS(null, 'x', posX);
                shape.setAttributeNS(null, 'y', posY);
                shape.setAttributeNS(null, 'width', 32);
                shape.setAttributeNS(null, 'height', 32);
                shape.setAttributeNS(null, 'fill', color);
                svg.appendChild(shape);
            }
            
            
            
            /*svg.addEventListener('keydown', event => {
                console.log('svg keydown: ', event.key);
            });*/
        
            let svg = document.querySelector('.svg-img');
            svg.addEventListener('dblclick', event => {
                    let bound = svg.getBoundingClientRect();
                    let style = getComputedStyle(svg);
                    let paddingLeft = parseFloat(style['padding-left'].replace('px', ''));
                    let paddingTop = parseFloat(style['padding-top'].replace('px', ''));
                    let x = event.clientX - bound.left - svg.clientLeft - paddingLeft;
                    let y = event.clientY - bound.top - svg.clientTop - paddingTop;

                    if(event.x === undefined)
                    {
                        x -= parseFloat(style['border-left-width'].replace('px', ''));
                        y -= parseFloat(style['border-top-width'].replace('px', ''));
                    }

                    let width = svg.width.baseVal.value;
                    let height = svg.height.baseVal.value;

                    if(x < 0 || y < 0 || x >= width || y >= height)
                    {
                        return;
                    }

                    //console.log(x, y);
                    //insertRect(x, y, "#a0a");
                    let nUUID = UUID();
                    insertText(x, y, titleDiagramTopo.text(), "#a0a", nUUID);
                    storeCoords.push({
                        uuid: nUUID,
                        x: x,
                        y: y,
                        title: titleDiagramTopo.text()
                    });
                    $("#anam_coordenadas").val(JSON.stringify(storeCoords));
            });
            
            
         });
            function insertText(posX, posY, val, color, uuid){
                let svg = document.querySelector('.svg-img');
                var svgNS = "http://www.w3.org/2000/svg";
                var newText = document.createElementNS(svgNS,"text");
                newText.setAttributeNS(null,"x",posX);     
                newText.setAttributeNS(null,"y",posY); 
                newText.setAttributeNS(null,"font-size","11");
                newText.innerHTML = val;
                newText.setAttribute("data-uuid", uuid);
                //var textNode = document.createTextNode(val);
                //newText.appendChild(textNode);
                
                $(newText).on("click", function(){
                    if(typeof $(this).attr("data-item-selected")!="undefined"){
                        $(this)[0].setAttributeNS(null,"fill","black");
                        $(this).removeAttr("data-item-selected");
                    } else {
                        $(this)[0].setAttributeNS(null,"fill","green");
                        $(this).attr("data-item-selected","");
                    }
                });
                
                svg.appendChild(newText);
            }
            
            if($("#anam_coordenadas").val().trim().length > 0){
                storeCoords = JSON.parse($("#anam_coordenadas").val());
                //console.log(" storeCoords ",storeCoords);
                for(let z of storeCoords){
                    insertText(z.x, z.y, z.title, "#a0a", z.uuid);
                }
            }
		 
		 $(function() {
            $( "#diagn_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagn_ciex').val(ui.item.codigo);
					
			   }
            });
         });
		 
		$(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#prod_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#prod_codigox').val(ui.item.codigo);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 function click_radiob()
		 {
		 	   
		   $("#div_estadoatencion").load("templateformsweb/maestro_standar_anamnesisclinica/estadog.php",{
			   atenc_id:$('#atenc_id').val(),
			   estaatenc_id:$('input:radio[name=estadomedi]:checked').val()
			
		
			  },function(result){  
			
			
			  });  
			
			  $("#div_estadoatencion").html("Espere un momento...");  
  
		 
		 }
		 
		function deletePointDiagram(){
                    let svg = document.querySelector('.svg-img');
                    let elems = svg.querySelectorAll("text[data-item-selected]");
                    //let nCoords = [];
                    
                    for(let z=0; z<elems.length; z++){
                        //save array points
                        let gUUID = elems[z].getAttribute("data-uuid");
                        storeCoords = storeCoords.filter(item => item.uuid != gUUID);
                        elems[z].remove();
                    }
                    //storeCoords = nCoords;
                    $("#anam_coordenadas").val(JSON.stringify(storeCoords));
                }
		 
	
	<?php
	if($rs_dcliente->fields["clie_genero"]=='M')
	{
	?>	 
		 $('#mujer_id').hide();
	<?php
	}
	else
	{
	?>
	   $('#mujer_id').show();
	<?php
	}
	?>	 
		 
		 
</script>


<script>
function genera_codproducto()
{

$.ajax({
    // la URL para la petición
    url : 'templateformsweb/maestro_standar_anamnesisclinica/searchpro.php',
    // la información a enviar
    // (también es posible utilizar una cadena de datos)
    data : { term : '99203' },
    // especifica si será una petición POST o GET
    type : 'GET',
    // el tipo de información que se espera de respuesta
    dataType : 'json',
    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
    success : function(json) {
        //console.log(json[0].codigo);
		$('#prod_codigox').val(json[0].codigo);
		$('#prod_descripcionx').val(json[0].descripcion);
	    $('#prod_preciox').val(json[0].precio);
		
    },
    // código a ejecutar si la petición falla;
    // son pasados como argumentos a la función
    // el objeto de la petición en crudo y código de estatus de la petición
    error : function(xhr, status) {
        ///alert('Disculpe, existió un problema');
    },
    // código a ejecutar sin importar si la petición falló o no
    complete : function(xhr, status) {
        ///alert('Petición realizada');
		grid_extras_4824($('#anam_enlace').val(),0,1);
    }
});


}

<?php
if($bloque_registro==0)
{
?>
//genera_codproducto();
<?php
}
?>
//grid_extras_4824($('#anam_enlace').val(),0,1);


  $(function() {
            $( "#plantra_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamento.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantra_medicamentox').val(ui.item.descripcion);
				  $('#plantra_concentracionx').val(ui.item.concentracion);
				  $('#plantra_presentacionx').val(ui.item.presentacion);
				  $('#plantra_viax').val(ui.item.via);
				  $('#plantra_preciotechox').val(ui.item.techo);
				  $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
				  $('#plantra_indicacionesx').val(ui.item.descripcion + ':');
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantra_medicamentox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamentotxt.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#plantra_codigox').val(ui.item.codigo);
				  $('#plantra_concentracionx').val(ui.item.concentracion);
				  $('#plantra_presentacionx').val(ui.item.presentacion);
				  $('#plantra_viax').val(ui.item.via);
				  $('#plantra_preciotechox').val(ui.item.techo);
				  $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
				  $('#plantra_indicacionesx').val(ui.item.label + ':');
					
			   }
            });
         });	  
		 
		 	  
		

$(function() {
            $( "#plantrai_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantrai_nombredispositivox').val(ui.item.descripcion);
				  $('#plantrai_preciox').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantrai_nombredispositivox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivotxt.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#plantrai_codigox').val(ui.item.codigo);
				  $('#plantrai_preciox').val(ui.item.precio);
					
			   }
            });
         });	



//busca cantidad de productos

  $( "#plantra_cantidadx" ).change(function() {
                     busca_disponibles();
				});
	
  $( "#plantra_frecuenciax" ).change(function() {
                     busca_disponibles();
				});				
				
  $( "#plantra_diasx" ).change(function() {
                     busca_disponibles();
				});
  				
				
  function busca_disponibles()
  {
	  $("#div_disponibilidad").load("templateformsweb/maestro_standar_anamnesisclinica/busca_disponibles.php",{
	   plantra_codigox:$('#plantra_codigox').val()
	

	  },function(result){  
	
	
	  });  
	
	  $("#div_disponibilidad").html("Espere un momento...");  
  
  }		
  
  function ocultar_mostrar(muestra)
  {

    $('#antecedentesp_id').hide();
	cambio_inactivo('antecedentesp_id',0);
	
    $('#antecedentesf_id').hide();
	cambio_inactivo('antecedentesf_id',0);
	
	$('#'+muestra).show();	
	cambio_inactivo(muestra,1);
  
  }	
  
   function ocultar_mostrar2(muestra)
  {
  
    $('#signos_id').hide();
	cambio_inactivo('signos_id',0);
    $('#revicionorgf_id').hide();
	cambio_inactivo('revicionorgf_id',0);
    $('#examenfisico_id').hide();
	cambio_inactivo('examenfisico_id',0);
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }	
  
  function ocultar_mostrar3(muestra)
  {
  
    $('#tarifario_id').hide();
	cambio_inactivo('tarifario_id',0);
    $('#diagnostico_id').hide();
	cambio_inactivo('diagnostico_id',0);
    $('#recetapres_id').hide();
	cambio_inactivo('recetapres_id',0);
	$('#dispositivos_id').hide();
	cambio_inactivo('dispositivos_id',0);
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }	
  

		
  ocultar_mostrar('antecedentesp_id');	
  ocultar_mostrar2('signos_id');
  ocultar_mostrar3('diagnostico_id');
  
  function cambio_inactivo(divdata,opcion)
  {  
    if(opcion==0)
	{
	$('#btn_'+divdata).css('background-color','#C5E0EB');
	$('#btn_'+divdata).css('color','#000000');
	$('#btn_'+divdata).css('border','#000000');
	$('#btn_'+divdata).css('border','solid');
	$('#btn_'+divdata).css('border-width','thin');   
	}
	else
	{
	$('#btn_'+divdata).css('background-color','#000033');
	$('#btn_'+divdata).css('color','#FFFFFF');
	$('#btn_'+divdata).css('border','#000000');
	$('#btn_'+divdata).css('border','solid');
	$('#btn_'+divdata).css('border-width','thin');	
	}
  }
  
  
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>