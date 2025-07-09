<table class="table align-items-center mb-0 dataTable" border="1" align="center" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><strong>Fecha Inicio:</strong></th>
            <th><strong>Fecha Fin:</strong></th>
            <th><strong>Persona:</strong></th>
            <th><strong>Descripcion:</strong></th>
            <th><strong>Documento:</strong></th>
            <th><strong>Pendientes:</strong></th>
            <th><strong>Estado Retencion SRI:</strong></th>
            <th><strong>C&oacute;digo:</strong></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="input-group input-group-static my-3">
                    <input name="compra_fechai" type="date" id="compra_fechai" size="12" class="form-control valid"
                        value="<?php echo $_POST["compra_fechai"]; ?>">
                </div>
            </td>
            <td>
                <div class="input-group input-group-static my-3">
                    <input name="compra_fechaf" type="date" id="compra_fechaf" size="12" class="form-control valid"
                        value="<?php echo $_POST["compra_fechaf"]; ?>">
                </div>
            </td>
            <td>
                <div class="input-group input-group-outline my-3">
                    <input name="provee_nombreb" type="text" id="provee_nombreb" class="form-control valid"
                        value="<?php echo $_POST["provee_nombreb"]; ?>">
                </div>
            </td>
            <td>
                <div class="input-group input-group-outline my-3">
                    <input name="compra_descripcionb" type="text" id="compra_descripcionb" class="form-control valid"
                        value="<?php echo $_POST["compra_descripcionb"]; ?>">
                </div>
            </td>
            <td>
                <div class="input-group input-group-outline my-3">
                    <input name="compra_nfacturab" type="text" id="compra_nfacturab" class="form-control valid"
                        value="<?php echo $_POST["compra_nfacturab"]; ?>">
                </div>
            </td>
            <td>
                <div class="input-group input-group-static my-3">
                    <select name="estado_pp" id="estado_pp" class="form-control valid">
                        <option value="">-seleccionar-</option>
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="PAGADO">PAGADO</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="input-group input-group-static my-3">
                    <select name="estado_sri" id="estado_sri" class="form-control valid">
                        <option value="">-seleccionar-</option>
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="RECIBIDA">RECIBIDA</option>
                        <option value="NO AUTORIZADO">NO AUTORIZADO</option>
                        <option value="DEVUELTA">DEVUELTA</option>
                        <option value="AUTORIZADO">AUTORIZADO</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="input-group input-group-outline my-3">
                    <input name="code_compra" type="text" id="code_compra" class="form-control valid"
                        value="<?php echo $_POST["code_compra"]; ?>">
                </div>
            </td>
        </tr>
    </tbody>
</table><br>

<div align="center">
    <input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="button" name="Submit" value="Buscar"
        onClick="desplegar_grid_compraproveedores()">
</div>

<script type="text/javascript">
<!--
$('#compra_fechai').datepicker({
    dateFormat: 'yy-mm-dd'
});
$('#compra_fechaf').datepicker({
    dateFormat: 'yy-mm-dd'
});

$('#estado_pp').val('<?php echo $_POST["estado_pp"]; ?>');
$('#estado_sri').val('<?php echo $_POST["estado_sri"]; ?>');

//  End 
-->
</script>