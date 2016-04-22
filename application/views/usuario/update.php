<script src="<?php echo base_url('/assets/jscript.js'); ?>" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        $("#btCancelar").click(function(){
            $('#abreNovoUsuario').removeClass('activeNovoButton');
            $("#usuario").slideUp();
        });

        $('#cpf').mask('999.999.999-99');

        $.validator.addMethod("validaCpf", function(value, element) {
            var checkCPF = validarCPF(value);
            return checkCPF;
        });

        validator = $("#update").validate({
            invalidHandler: function(){
                var n = noty({
                    layout: 'top',
                    type: 'error',
                    timeout: 2000,
                    text: 'Por favor preencha corretamente os campos assinalados para continuar.'
                });
            },
            rules: {
                nome: {required: true},
                confSenha: {
                    equalTo: "#senha"
                }
            },
            errorClass: 'invalido',
            errorPlacement: function(){return false;}
        });

        $("#update").submit(function() {
            var senha = $("#senha").val();
            var nome = $("#nome").val();
            var cpf = $('#cpfUsuario').val();
            var link = $('#linkSalvar').val();
            
            if (nome.length > 0) {
                $.ajax({
                    url: link,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'cpf': cpf,
                        'nome': nome,
                        'senha': senha
                    },
                    success: function(res) {
                        console.log('res: ' + res);
                        if (res == '1') {
                            var n = noty({
                                layout: 'top',
                                type: 'success',
                                timeout: 2000,
                                text: 'O usuário foi editado com sucesso.',
                                callback: {
                                    afterClose: function() {window.location.reload();}
                                }
                            });

                        } else {
                            var n = noty({
                                layout: 'top',
                                type: 'error',
                                timeout: 2000,
                                text: 'Erro ao editar o produto. Por favor contate o administrador.'
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
       
<span class="createnovotitle">editar usuário</span>
<hr>
<form method="post" id="update">
    <input type="hidden" id="linkSalvar" value="<?php echo site_url('administrador/usuario/update'); ?>">
    <input type="hidden" id="cpfUsuario" value="<?php echo $dados->usu_cpf; ?>">
    <table class="tableNovo">
        <tr>
            <td class="label">
                <label for="nome">Nome</label>
            </td>
            <td>
                <input id="nome" autocomplete="off" style="width: 300px;" placeholder="Nome" class="input" type="text" name="nome" value="<?php echo $dados->usu_nome; ?>" />
            </td>
            <td class="label">
                <label for="senha">Senha</label>
            </td>
            <td>
                <input class="input" autocomplete="off" placeholder="Senha" id="senha" type="password" name="senha" value="">
            </td>
        </tr>
        <tr>
            <td class="label">
                <label for="cpf">CPF</label>
            </td>
            <td>
                <input class="input" disabled autocomplete="off" placeholder="CPF" id="cpf" type="text" name="cpf" value="<?php echo $dados->usu_cpf; ?>">
            </td>
            <td class="label">
                <label for="confSenha">Confirmar Senha</label>
            </td>
            <td>
                <input class="input" autocomplete="off" placeholder="Confirmar senha" id="confSenha" type="password" name="confSenha" value="">
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