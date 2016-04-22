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

        validator = $("#create").validate({
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
                cpf: {required: true, validaCpf: true},
                senha: {required: true},
                confSenha: {
			      	equalTo: "#senha"
			    }
            },
            errorClass: 'invalido',
            errorPlacement: function(){return false;}
        });

        $("#create").submit(function() {
            var nome = $("#nome").val();
            var cpf = $("#cpf").val();
            var senha = $("#senha").val();

            if ((nome.length > 1) && (cpf.length > 1) && (senha.length > 1)) {
                $.ajax({
                    url: "<?php echo site_url('administrador/usuario/salvar'); ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'nome': nome,
                        'cpf': cpf,
                        'senha': senha
                    },
                    success: function(res) {
                        console.log('res: ' + res);
                        if (res == 1) {
                            var n = noty({
                                layout: 'top',
                                type: 'success',
                                timeout: 2000,
                                text: 'O usuário foi salvo com sucesso.',
                                callback: {
                                    afterClose: function() {window.location.reload();}
                                }
                            });

                        } else {
                            var n = noty({
                                layout: 'top',
                                type: 'error',
                                timeout: 2000,
                                text: 'Erro ao salvar usuário. Por favor contate o administrador.'
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

<span class="createnovotitle">novo usuário</span>
<hr>
<form id="create" method="post">

    <table class="tableNovo">
        <tr>
            <td class="label">
                <label for="nome">Nome</label>
            </td>
            <td>
                <input id="nome" autocomplete="off" style="width: 300px;" placeholder="Nome" class="input" type="text" name="nome" value="<?php echo set_value('nome') ?>" />
            </td>
            <td class="label">
                <label for="senha">Senha</label>
            </td>
            <td>
                <input class="input" autocomplete="off" placeholder="Senha" id="senha" type="password" name="senha" value="<?php echo set_value('senha'); ?>">
            </td>
        </tr>

        <tr>
            <td class="label">
                <label for="cpf">CPF</label>
            </td>
            <td>
                <input class="input" autocomplete="off" placeholder="CPF" id="cpf" type="text" name="cpf" value="<?php echo set_value('cpf') ?>">
            </td>
            <td class="label">
                <label for="confSenha">Confirmar Senha</label>
            </td>
            <td>
                <input class="input" autocomplete="off" placeholder="Confirmar senha" id="confSenha" type="password" name="confSenha" value="<?php echo set_value('confSenha') ?>">
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