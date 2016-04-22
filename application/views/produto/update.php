<script>
    $(document).ready(function() {

        $("#btCancelar").click(function(){
            $("#produto").slideUp();
        });

        var val1 = $("#valor_unitario").maskMoney({allowNegative: true, thousands: '', decimal: '.', affixesStay: false});
        var val2 = $("#valor_venda").maskMoney({allowNegative: true, thousands: '', decimal: '.', affixesStay: false});

        $("#update").validate({
            invalidHandler: function(){
                var n = noty({
                    layout: 'top',
                    type: 'error',
                    timeout: 2000,
                    text: 'Por favor preencha corretamente os campos assinalados para continuar.'
                });
            },
            rules: {
                descricao: {required: true},
                valor_unitario: {required: true}

            },
            errorClass: 'invalido',
            errorPlacement: function(){return false;}
        });

        $("#update").submit(function() {
            var descricao = $("#descricao").val();
            var valorunitario = $("#valor_unitario").val();
            var codProduto = $('#codigoProduto').val();
            var link = $('#linkSalvar').val();
            
            if ((descricao.length > 0) && (valorunitario.length > 0)) {
                $.ajax({
                    url: link,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'descricao': descricao,
                        'valunitario': valorunitario,
                        'codprod' : codProduto
                    },
                    success: function(res) {
                        console.log('res: ' + res);
                        if (res == '1') {
                            var n = noty({
                                layout: 'top',
                                type: 'success',
                                timeout: 2000,
                                text: 'O produto foi editado com sucesso.',
                                callback: {
                                    afterClose: function() {window.location.reload();}
                                }
                            });

                        } else {
                            var n = noty({
                                layout: 'top',
                                type: 'error',
                                timeout: 2000,
                                text: 'Erro ao editar produto. Por favor contate o administrador.'
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log("Error occured: "+thrownError+" "+xhr.status+" "+ajaxOptions);
                    }
                });
            }
            return false;
        });

    });
</script>

<?php $dados = $query->row();?>
       
    <span class="createnovotitle">editar produto</span>
    <hr>
    <form method="post" id="update">
        <input type="hidden" id="linkSalvar" value="<?php echo site_url('administrador/produto/updateproduto/'); ?>">
        <input type="hidden" id="codigoProduto" value="<?php echo $dados->pro_codigo; ?>">
        <table class="tableNovo">
            <tr>
                <td class="label">
                    <label for="descricao">Descrição</label>
                </td>
                <td>
                    <input type="text" id="descricao" placeholder="descricao" class="input" type="text" name="descricao" value="<?php echo $dados->pro_descricao; ?>">
                </td>
                <td class="label">
                    <label for="valor_unitario">Valor unitário</label>
                </td>
                <td>
                    <input class="input" placeholder="Valor Unitario" id="valor_unitario" type="text" name="valor_unitario" value="<?php echo $dados->pro_valor_unitario;?>">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input class="formButton submit" type="submit" value="salvar" id="btEnviar">
                    <input class="formButton cancel" type="button" value="cancelar" id="btCancelar">
                </td>
            </tr>
        </table>
    </form>
    

