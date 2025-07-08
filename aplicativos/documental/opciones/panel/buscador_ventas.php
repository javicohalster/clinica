<br /><br />
<div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0" border="1" align="center" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">FECHA INICIO: </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">FECHA FIN: </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">IDENTIFICACIÓN/RUC: </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">NOMBRE: </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">NO. DOC: </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">PENDIENTES: </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">ESTADO SRI: </th>
                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">ANULADO: </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="input-group input-group-static my-3">
                            <input name="fechai" type="date" id="fechai" size="12" class="form-control valid" value="">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-static my-3">
                            <input name="fechaf" type="date" id="fechaf" size="12" class="form-control valid" value="">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-outline my-3">
                            <input name="doccab_rucci_cliente" type="text" id="doccab_rucci_cliente"
                                class="form-control valid">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-outline my-3">
                            <input name="doccab_nombrerazon_cliente" type="text" id="doccab_nombrerazon_cliente"
                                class="form-control valid">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-outline my-3">
                            <input name="doccab_ndocumento" type="text" id="doccab_ndocumento"
                                class="form-control valid">
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
                        <div class="input-group input-group-static my-3">
                            <select name="doccab_anulado" id="doccab_anulado" class="form-control valid">
                                <option value="">-seleccionar-</option>
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                            </select>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><br/>
    <div class="col-xs-12">
        <div class="text-center">
            <input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="button" name="Submit" value="BUSCAR" onClick="desplegar_grid()">
        </div>
    </div>
</div>

<script type="text/javascript">
<!--
$('#fechai').datepicker({
    dateFormat: 'yy-mm-dd'
});
$('#fechaf').datepicker({
    dateFormat: 'yy-mm-dd'
});


//  End 
-->
</script>