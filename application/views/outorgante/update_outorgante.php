<script>
    $(document).ready(function (){

        $("#outorgante_cpf").mask("999.999.999-99");
        $("#outorgante_rg").mask("9999999-9");
        $("#data_nascimento").mask("99/99/99999");
         
        $("#update").validate({
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
       
    });
</script>
<?php $dados=$query->row();?>

<span class="createnovotitle">editar outorgante</span>
<hr>
<form id="update" action="<?php echo site_url('/administrador/outorgante/update/'.$dados->out_cpf_cnpj);?>" method="post">
    <input type="hidden" name="out_cpf_cnpj" value="<?php echo $dados->out_cpf_cnpj;?>" />
    <input type="hidden" name="end_codigo" value="<?php echo $dados->end_codigo;?>" />
    <table class="tableNovo">

        <tr>
            <td class="label" >
                <label>Nome</label>
            </td>
            <td>
                <input id="outorgante_nome" class="input" type="text" name="outorgante_nome" value="<?php echo $dados->out_nome;?>">
            </td>
            <td class="label">
                <label>CPF</label>
            </td>
            <td>
                <input class="input" type="text" id="outorgante_cpf" name="outorgante_cpf" value="<?php echo $dados->out_cpf_cnpj;?>" readonly/>
            </td>

        </tr>

        <tr>
            <td class="label">
                <label>E-mail</label>
            </td>
            <td>
                <input class="input" type="text" id="outorgante_email" name="outorgante_email" value="<?php echo $dados->out_email;?>">
            </td>
            <td class="label">
                <label>RG</label>
            </td>
            <td>
                <input class="input" id="outorgante_rg" type="text" name="outorgante_rg" value="<?php echo $dados->out_rg;?>">
            </td>
            
        </tr>



        <tr>
            <td class="label">
                <label for="outorgante_telefone">Telefone</label>
            </td>
            <td>
                <input class="input" type="text" id="outorgante_telefone" name="outorgante_telefone" value="<?php echo $dados->out_telefone;?>">
            </td>
            <td class="label">
                <label>Orgão Emissor</label>
            </td>
            <td>
                <input class="input" id="outorgante_org_emissor" style="background: transparent;" type="text" name="outorgante_org_emissor" value="<?php echo $dados->out_org_emissor;?>">
            </td>
            
        </tr>

        <tr>
            <td class="label">
                <label for="outorgante_celular">Celular</label>
            </td>
            <td >
                <input class="input" type="text" id="outorgante_celular" name="outorgante_celular" value="<?php echo $dados->out_celular;?>">
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
                <input id="end_bairro" class="input" type="text" name="end_bairro" value="<?php echo $dados->end_bairro;?>">
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
                <input id="end_cep" class="input" type="text" name="end_cep" value="<?php echo $dados->end_cep;?>">
            </td>
        </tr>


        <tr>
            <td class="label">
                <label>Logradouro</label>
            </td>
            <td>
                <input id="end_descricao" class="input" type="text" name="end_descricao" value="<?php echo $dados->end_descricao;?>">
            </td>
            <td class="label">
                <label>Complemento</label>
            </td>
            <td>
                <input id="end_complemento" class="input" type="text" name="end_complemento" value="<?php echo $dados->end_complemento;?>">
            </td>            
        </tr>

        <tr>
            <td colspan="4">
                <input class="formButton submit" type="submit" value="salvar" name="btEnviar" id="btEnviar">
                <input class="formButton cancel" type="button" value="cancelar" id="btCancelar">
            </td>
        </tr>

    </table>
   
</form>
     