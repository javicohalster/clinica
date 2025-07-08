<br /><br />
<div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0" border="1" align="center" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><strong>Tipo</strong></th>
                    <th><strong>Ruc/CI</strong></th>
                    <th><strong>Nombre Comercial </strong></th>
                    <th><strong>Nombre Representante </strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="input-group input-group-static my-3">
                            <select name="tipoper_id" id="tipoper_id" style="width:200px" class="form-control valid">
                                <option value="">--seleccionar--</option>
                                <option value="1">PROVEEDOR</option>
                                <option value="2">CLIENTE</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-outline my-3">
                            <input name="rucci_valor" type="text" id="rucci_valor" class="form-control valid" />
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-outline my-3">
                            <input name="ncomercial" type="text" id="ncomercial" class="form-control valid">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-outline my-3">
                            <input name="nrepresentante" type="text" id="nrepresentante" class="form-control valid">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br />
<div class="text-center">
    <input class="fs-5 btn bg-gradient-dark mb-0 btn btn-primary" type="button" name="Submit" value="Buscar"
        onClick="desplegar_grid()">
</div>