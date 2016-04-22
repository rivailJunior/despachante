<script>

    $(document).ready(function(){

        var vIn = 0;
        var vFim = 0;
        var chnInicio = 0;
        var taxa = 0;
        var kit = 0;

        $("#config_valKit").maskMoney({allowNegative: true, thousands: '', decimal: '.', affixesStay: false});
        $("#config_taxa").maskMoney({allowNegative: true, thousands: '', decimal: '.', affixesStay: false});

        $("#config_veiculo_in").mask("999999999999");
        $("#config_veiculo_fim").mask("999999999999");
        $("#config_cnh").mask("999999999999");

        $("#config_taxa").before("<span style='position: absolute; margin: 7px 0px 0px 5px; font-family: 'Gadugi', Arial;'>R$</span>");
        $("#config_valKit").before("<span style='position: absolute; margin: 7px 0px 0px 5px; font-family: 'Gadugi', Arial;'>R$</span>");


// ------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------


        $('#btEnviarSeq').click(function(){
            if ($(this).val() == 'editar') 
            {
                vIn = $('#config_veiculo_in').val();
                vFim = $('#config_veiculo_fim').val();
                chnInicio = $('#config_cnh').val();
                $('#confSeq input.input').removeAttr("disabled");
                $('#config_veiculo_in').focus();
                $(this).val('salvar');
                $('#btCancelarSeq').show();
            } 
            else if($(this).val() == 'salvar')
            {
                //salvar sequencias
                var veiculoIn = $('#config_veiculo_in').val();
                var veiculoFim = $('#config_veiculo_fim').val();
                var chnIn = $('#config_cnh').val();

                $.ajax({
                    url: "<?php echo site_url('administrador/configurar/salvarSeq'); ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'vIn': veiculoIn,
                        'vFim': veiculoFim,
                        'chnIn' : chnIn
                    },
                    success: function(res) {
                        console.log('res: ' + res);
                        if (res == '1') 
                        {
                            var n = noty({
                                layout: 'top',
                                type: 'success',
                                timeout: 2000,
                                text: 'Novas sequências salvas com sucesso.'
                            });
                            $('#confSeq input.input').attr("disabled",'disabled');
                            $('#btEnviarSeq').val('editar');
                            $('#btCancelarSeq').hide();
                        } 
                        else 
                        {
                            var n = noty({
                                layout: 'top',
                                type: 'error',
                                timeout: 2000,
                                text: 'Erro ao salvar novas sequências. Por favor contate o administrador.'
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log("Error occured: "+thrownError+" "+xhr.status+" "+ajaxOptions+' RESPONSE: '+xhr.responseText);
                    }
                }); 
            };
            
        })

        $('#btCancelarSeq').click(function(){
            $('#config_veiculo_in').val(vIn);
            $('#config_veiculo_fim').val(vFim);
            $('#config_cnh').val(chnInicio);

            vIn = 0;
            vFim = 0;
            chnInicio = 0;

            $('#confSeq input.input').attr("disabled",'disabled');
            $('#btEnviarSeq').val('editar');
            $(this).hide();
        })



// ------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------



        $('#btEnviarValKit').click(function(){
            if ($(this).val() == 'editar') 
            {
                kit = $('#config_valKit').val();
                $('#confValKit input.input').removeAttr("disabled");
                $('#config_valKit').focus();
                $(this).val('salvar');
                $('#btCancelarValKit').show();
            } 
            else if($(this).val() == 'salvar')
            {
                var kitVal = $('#config_valKit').val();

                $.ajax({
                    url: "<?php echo site_url('administrador/configurar/salvarKit'); ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'kit': kitVal
                    },
                    success: function(res) {
                        console.log('res: ' + res);
                        if (res == '1') 
                        {
                            var n = noty({
                                layout: 'top',
                                type: 'success',
                                timeout: 2000,
                                text: 'Valor do kit salvo com sucesso.'
                            });
                            $('#confValKit input.input').attr("disabled",'disabled');
                            $('#btEnviarValKit').val('editar');
                            $('#btCancelarValKit').hide();
                        } 
                        else 
                        {
                            var n = noty({
                                layout: 'top',
                                type: 'error',
                                timeout: 2000,
                                text: 'Erro ao salvar valor do kit. Por favor contate o administrador.'
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log("Error occured: "+thrownError+" "+xhr.status+" "+ajaxOptions+' RESPONSE: '+xhr.responseText);
                    }
                });
                
            };
            
        })

        $('#btCancelarValKit').click(function(){
            $('#config_valKit').val(kit);
            kit = 0;

            $('#confValKit input.input').attr("disabled",'disabled');
            $('#btEnviarValKit').val('editar');
            $(this).hide();
        })



// ------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------




        $('#btEnviarTaxa').click(function(){
            if ($(this).val() == 'editar') 
            {
                taxa = $('#config_taxa').val();
                $('#confTaxa input.input').removeAttr("disabled");
                $('#config_taxa').focus();
                $(this).val('salvar');
                $('#btCancelarTaxa').show();
            } 
            else if($(this).val() == 'salvar')
            {
                var taxaVal = $('#config_taxa').val();

                $.ajax({
                    url: "<?php echo site_url('administrador/configurar/salvarTaxa'); ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'taxa': taxaVal
                    },
                    success: function(res) {
                        console.log('res: ' + res);
                        if (res == '1') 
                        {
                            var n = noty({
                                layout: 'top',
                                type: 'success',
                                timeout: 2000,
                                text: 'Nova taxa salva com sucesso.'
                            });
                            $('#confTaxa input.input').attr("disabled",'disabled');
                            $('#btEnviarTaxa').val('editar');
                            $('#btCancelarTaxa').hide();
                        } 
                        else 
                        {
                            var n = noty({
                                layout: 'top',
                                type: 'error',
                                timeout: 2000,
                                text: 'Erro ao salvar nova taxa. Por favor contate o administrador.'
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log("Error occured: "+thrownError+" "+xhr.status+" "+ajaxOptions+' RESPONSE: '+xhr.responseText);
                    }
                });
                
            };
            
        })

        $('#btCancelarTaxa').click(function(){
            $('#config_taxa').val(taxa);
            taxa = 0;

            $('#confTaxa input.input').attr("disabled",'disabled');
            $('#btEnviarTaxa').val('editar');
            $(this).hide();
        })

    });


</script>

<?php $data = $query->row(); ?>

<div class="pageTitle" id="confTitle">
    configurações
</div>

<p align="justify" style="margin-top: 0; color: #3D3D3D;">Configure aqui o valor inicial e final das sequências do número do CHP das etiquetas assim como a taxa de retorno do valor das etiquetas para os Despachantes no final do mês. Clique em EDITAR para mudar as configurações pretendidas.</p> 

<div id="confWrapper">

    <div class="confMenu" id="confSeq" style="float: left; ">
        <span class="confSubTitle">sequências CHP</span>
        <hr>
        <table cellspacing="0" cellpadding="5" width="100%">
            <tr>
                <td colspan="2">
                    <span class="confSubSubTitle">CHP veículo</span>
                </td>
            </tr>
            <tr>
                <td style="width: 80px; text-align: right;">
                    <label for="config_veiculo_in">início</label>
                </td>
                <td>
                    <input type="text" disabled class="input" id="config_veiculo_in" name="config_veiculo_in" value="<?php echo $data->num_veiculo_in; ?>" />
                </td>
            </tr>
            <tr>
                <td style="width: 80px; text-align: right;">
                    <label for="config_veiculo_fim">final</label>
                </td>
                <td>
                    <input type="text" disabled class="input" id="config_veiculo_fim" name="config_veiculo_fim" value="<?php echo $data->num_veiculo_fim; ?>" />
                </td>
            </tr>
        </table>
        <br>
        <table cellspacing="0" cellpadding="5" width="100%">
            <tr>
                <td colspan="2">
                    <span class="confSubSubTitle">CHP CNH</span>
                </td>
            </tr>
            <tr>
                <td style="width: 80px; text-align: right;">
                    <label for="config_cnh">início</label>
                </td>
                <td>
                    <input type="text" disabled class="input" id="config_cnh" name="config_cnh" value="<?php echo $data->num_cnh_in; ?>" />
                </td>
            </tr>
        </table>
        <input class="formButton submit" type="submit" value="editar" id="btEnviarSeq">
        <input hidden class="formButton cancel" type="button" value="cancelar" id="btCancelarSeq">
    </div>

    <div class="confMenu" id="confValKit" style="float: right; ">
        <span class="confSubTitle">valor kit</span>
        <hr>
        <table cellspacing="0" cellpadding="5" width="100%">
            <tr>
                <td style="width: 80px; text-align: right;">
                    <label for="config_valKit">valor</label>
                </td>
                <td>
                    <input type="text" disabled class="input" id="config_valKit" name="config_valKit" value="<?php echo $data->conf_valor; ?>" style="padding-left: 26px;" />
                </td>
            </tr>
        </table>
        <input class="formButton submit" type="submit" value="editar" id="btEnviarValKit">
        <input hidden class="formButton cancel" type="button" value="cancelar" id="btCancelarValKit">
    </div>

    <div class="confMenu" id="confTaxa" style="float: right; ">
        <span class="confSubTitle">taxa de retorno</span>
        <hr>
        <table cellspacing="0" cellpadding="5" width="100%">
            <tr>
                <td style="width: 80px; text-align: right;">
                    <label for="config_taxa">taxa</label>
                </td>
                <td>
                    <input type="text" disabled class="input" id="config_taxa" name="config_taxa" value="<?php echo $data->conf_taxa_retorno; ?>" style="padding-left: 26px;" />
                </td>
            </tr>
        </table>
        <input class="formButton submit" type="submit" value="editar" id="btEnviarTaxa">
        <input hidden class="formButton cancel" type="button" value="cancelar" id="btCancelarTaxa">
    </div>

</div>