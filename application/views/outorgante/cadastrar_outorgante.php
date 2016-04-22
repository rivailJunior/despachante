<script src="<?php echo base_url('/assets/jscript.js'); ?>" type="text/javascript"></script>
<script>
    function show_municipio()
    {
        var code = $("#end_uf").val();
        $.ajax({
            url:"<?php echo site_url('administrador/outorgante/listarMunicipios');?>"+"/"+code,
            type:'POST',
            dataType:'html',
            success: function(res) 
            {
                console.log('res: '+res);
                if(res == '0')
                {
                    alert('Erro');
                }   
                else
                {
                    $('#end_municipio').html(res);
                }      
            },
            error: function(xhr, ajaxOptions, thrownError) 
            {
               //alert('Usuario nao pode ser excluido');  
                var w = window.open();
                var html = '<b>Resposta do servidor</b><br><hr>'+xhr.responseText+'<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>'+thrownError;                   
                $(w.document.body).html(html);
                callback();                       
           },
        });
    }

    $(document).ready(function (){
        //alert('alo');
        $("#outorgante_cpf").mask("999.999.999-99");
        $("#data_nascimento").mask("99/99/9999");
        $("#end_cep").mask("99999-999");
        
        $.validator.addMethod("validaCpf", function (value, element) {
    		var checkCPF = validarCPF($('#outorgante_cpf').val());
    		return checkCPF;
        });
         
        validator= $("#create").validate({
            rules:{
                outorgante_cpf:{required:true,validaCpf:true},
                outorgante_rg:{required:true},
                outorgante_nome:{required:true, minlength: 10},
                outorgante_email:{required:true,email:true},
                outorgante_celular:{required:true},
                end_cep:{required:true},
                end_bairro:{required:true},
                end_descricao:{required:true},
                end_uf:{required:true},
                end_municipio:{required:true}
            },
            errorClass: 'invalido',
            errorPlacement: function(){return false;}
        });
        
    $("#btCancelar").click(function(){
        $('#newButton').removeClass('activeNovoButton');
       $("#outorgante").slideUp();
      });
       
     });
</script>

<span class="createnovotitle">novo outorgante</span>
<hr>
<form id="create" action="<?php echo site_url('administrador/outorgante/cadastrar');?>" method="post">
        <table class="tableNovo">
            <tr>
                <td class="label">
                    <label for="outorgante_nome">Nome</label>
                </td>
                <td >
                    <input id="outorgante_nome" style="width: 400px;" class="input" type="text" name="outorgante_nome" value="<?php echo set_value('outorgante_nome');?>">
                </td>
                <td class="label">
                    <label for="outorgante_cpf">CPF</label>
                </td>
                <td >
                    <input class="input" type="text" id="outorgante_cpf" name="outorgante_cpf" value="<?php echo set_value('outorgante_cpf');?>">
                </td>
                
            </tr>

            <tr>
                <td class="label">
                    <label for="outorgante_email">E-mail</label>
                </td>
                <td >
                    <input class="input" type="text" id="outorgante_email" style="width: 400px;" name="outorgante_email" value="<?php echo set_value('outorgante_email');?>">
                </td>
                <td class="label">
                    <label for="outorgante_rg">RG</label>
                </td>
                <td >
                    <input class="input" id="outorgante_rg" type="text" name="outorgante_rg" value="<?php echo set_value('outorgante_rg');?>">
                </td>

                
            </tr>

            <tr>
                <td class="label">
                    <label for="outorgante_telefone">Telefone</label>
                </td>
                <td >
                    <input class="input" type="text" id="outorgante_telefone" name="outorgante_telefone" value="<?php echo set_value('outorgante_telefone');?>">
                </td>
                <td class="label">
                    <label for="outorgante_org_emissor">Orgão emissor</label>
                </td>
                <td >
                    <input class="input" id="outorgante_org_emissor" style="background: transparent;" type="text" name="outorgante_org_emissor" value="<?php echo set_value('outorgante_org_emissor');?>">
                </td>
            </tr>

            <tr>
                <td class="label">
                    <label for="outorgante_celular">Celular</label>
                </td>
                <td >
                    <input class="input" type="text" id="outorgante_celular" name="outorgante_celular" value="<?php echo set_value('outorgante_celular');?>">
                </td>
            </tr>

            <tr>
                <td class="label">
                    <label for="end_descricao">Logradouro</label>
                </td>
                <td >
                    <input id="end_descricao" class="input" type="text" style="width: 400px;" name="end_descricao" value="<?php echo set_value('end_descricao');?>">
                </td>
                <td class="label">
                    <label for="end_complemento">Complemento</label>
                </td>
                <td >
                    <input id="end_complemento" class="input" type="text" name="end_complemento" value="<?php echo set_value('end_complemento');?>">
                </td>
            </tr>

            <tr>
                <td class="label">
                    <label for="end_uf">UF</label>
                </td>
                <td>
                    <select class="select" name="end_uf" id="end_uf" onchange="show_municipio();">
                        <option value="">Selecione</option>
                        <?php 
                        if ($uf->num_rows() > 0)
                        {
                            foreach ($uf->result() as $row) 
                            { 
                                echo '<option value="'.$row->codigo.'">'.$row->sigla.' - '.$row->unidade.'</option>'; 
                            }
                        }
                        ?>
                    </select> 
                </td>
                <td class="label">
                    <label for="end_bairro">Bairro</label>
                </td>
                <td >
                    <input id="end_bairro" class="input" type="text" name="end_bairro" value="<?php echo set_value('end_bairro');?>">
                </td>
            </tr>

            <tr>
                <td class="label">
                    <label for="end_municipio">Munícipio</label>
                </td>
                <td>
                    <select name="end_municipio" id="end_municipio" class="select" >
                        <option value="">Selecione primeiro a UF</option>
                    </select>
                </td>
                <td class="label">
                    <label for="end_cep">CEP</label>
                </td>
                <td >
                    <input id="end_cep" class="input" type="text" name="end_cep" value="<?php echo set_value('end_cep');?>">
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
