<script>
    $(document).ready(function() {
 $("#btCancelar").click(function(){
    $('#abreNovoProduto').removeClass('activeNovoButton');
   $("#produto").slideUp();
  });
      

        var val1 = $("#valor_unitario").maskMoney({allowNegative: true, thousands: '', decimal: '.', affixesStay: false});

        $("#create").validate({
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

        $("#create").submit(function() {
            var descricao = $("#descricao").val();
            var valorunitario = $("#valor_unitario").val();

            if ((descricao.length > 1) && (valorunitario.length > 1)) {
                $.ajax({
                    url: "<?php echo site_url('administrador/produto/salvaproduto'); ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'descricao': descricao,
                        'valunitario': valorunitario
                    },
                    success: function(res) {
                        console.log('res: ' + res);
                        if (res == 1) {
                            var n = noty({
                                layout: 'top',
                                type: 'success',
                                timeout: 2000,
                                text: 'O produto foi salvo com sucesso.',
                                callback: {
                                    afterClose: function() {window.location.reload();}
                                }
                            });

                        } else {
                            var n = noty({
                                layout: 'top',
                                type: 'error',
                                timeout: 2000,
                                text: 'Erro ao salvar produto. Por favor contate o administrador.'
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

        <span class="createnovotitle">novo produto</span>
        <hr>
        <form id="create" method="post">

            <table class="tableNovo">
                <tr>
                    <td class="label">
                        <label for="descricao">Descrição</label>
                    </td>
                    <td>
                        <input id="descricao" style="width: 300px;" placeholder="descricao" class="input" type="text" name="descricao" value="<?php echo set_value('descricao') ?>" />
                    </td>
                    <td class="label">
                        <label for="valor_unitario">Valor unitário</label>
                    </td>
                    <td>
                        <input class="input" placeholder="Valor Unitário" id="valor_unitario" type="text" name="valor_unitario" value="<?php echo set_value('valor_unitario') ?>">
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