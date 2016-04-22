<script src="<?php echo base_url('/assets/toastmessage.js'); ?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/toastmessage.css'); ?>" />
<script src="<?php echo base_url('/assets/noty/jquery.noty.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/top.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/inline.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/topCenter.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/default.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/jscript.js'); ?>" type="text/javascript"></script>

<script>
    function show_municipio() //municipio p o endereco
    {
        // alert('here');
        var code = $("#uf").val();
        $('#end_cod_mun').load('<?php echo site_url(); ?>/despachante/listarMunicipios/' + code);

    }

    function mostra_municipios() //municipio p naturalidade
    {
        var code = $("#des_estado").val();
        $('#naturalidade').load('<?php echo site_url(); ?>/despachante/listarMunicipios/' + code);
    }

    function show_municipio_empresa() //municipio p empresa
    {
        var codeufEMpresa = $("#des_uf_empresa").val();
        $('#des_empresa_municipio').load('<?php echo site_url(); ?>/despachante/listarMunicipios/' + codeufEMpresa);
    }

    function cad_empresa() {
        //$("#check_empresa").prop("checked",false);
        var empresa = document.getElementById("check_empresa");
        if (empresa.checked) {
            $("#div_empresa").show("blind");
        } else {
            if ($("#emp_codigo").val() > 0) {
                apriseDesmarcar();
            } else {
                $("#div_empresa").hide("blind");
            }

        }
    }

    function setNullCampos() //funcao p deixar campos vazios
    {
        $("#emp_nome").val("");
        $("#emp_rua").val("");
        $("#emp_complemento").val("");
        $("#emp_bairro").val("");
        $("#emp_cep").val("");
        $("#emp_fac_simile").val("");
        $("#emp_reg_seccional").val("");
        $("#emp_telefone").val("");
        $("#des_emp_cnpj").val("");
    }

    function apriseDesmarcar() {

        apprise('Essa opção anulará todos os dados de sua empresa, você tem certeza disso?', {
            'verify': true,
            'animate': true
        }, function(r) {
            if (r) {
                // user clicked 'Yes'
                setNullCampos();
                //
                $("#check_empresa").prop("checked", false);
                //cad_empresa();
                $("#div_empresa").hide("blind");
            } else {
                $("#check_empresa").prop("checked", true);
            }
        });

    } //fim


    function enviaViaAjax() {
        event.preventDefault();
        var campo = $("#update").serialize();
        $.ajax({
            url: "<?php echo site_url('despachante/atualizaTeste/');?>",
            type: 'POST',
            dataType: 'json',
            data: {
                'campo': JSON.stringify(campo)
            },

            success: function(res) {


                if (res == 1) {

                    var n = noty({
                        layout: 'top',
                        type: 'success',
                        timeout: 2000,
                        text: '<b><br>Alterado com Sucesso</b>',
                        callback: {
                            afterClose: function() {
                                window.location.reload();
                            }
                        }
                    });

                } else {
                    var n = noty({
                        layout: 'top',
                        type: 'error',
                        timeout: 2000,
                        text: '<b><br>Erro ao tentar alterar</b>',
                        callback: {
                            afterClose: function() {
                                window.location.reload();
                            }
                        }
                    });

                };

            },
            error: function(xhr, ajaxOptions, thrownError) {

                var w = window.open();
                var html = '<b>Resposta do servidor</b><br><hr>' + xhr.responseText + '<br><br><b>Erro</b><br><hr>' + thrownError;
                $(w.document.body).html(html);
            }
        });

    } //fim




    $(document).ready(function() {

        $("#despachante_cpf").mask("999.999.999-99");
        //$("#despachante_rg").mask("9999999-9");
        $("#despachante_data_nascimento").mask("99/99/9999");
        $("#emp_telefone").mask("(999)9999-9999");
        $("#des_telefone").mask("(999)9999-9999");
        $("#des_emp_cnpj").mask("99.999.999/9999-99");
        $("#end_cep").mask("99999-999");
        $("#emp_cep").mask("99999-999");


        $("#check_empresa").click(function() { //funcao 
            cad_empresa();
        });

        $.validator.addMethod("validaCpf", function(value, element) {
            var checkCPF = validarCPF($('#despachante_cpf').val());
            return checkCPF;
        });

        $.validator.addMethod("validaCNPJ", function(value, element) {
            var checkCPF = validarCNPJ($("#des_emp_cnpj").val());
            return checkCPF;
        });

        validator = $("#update").validate({ //validacao de campos
            rules: {
                despachante_cpf: {
                    required: true,
                    validaCpf: true
                },
                despachante_rg: {
                    required: true
                },
                despachante_nome: {
                    required: true,
                    minlength: 10
                },
                naturalidade_despachante: {
                    required: true
                },
                despachante_data_nascimento: {
                    required: true
                },
                despachante_titulo_eleitoral: {
                    required: true
                },
                contato_email: {
                    required: true,
                    email: true
                },
                des_emp_cnpj: {
                    validaCNPJ: true
                },
                 des_emp_cnpj: {
                    validaCNPJ: {
                        depends: function(element){
                            return $("#check_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                },
                des_emp_nome: {
                    required: {
                        depends: function(element){
                            return $("#check_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                },
                des_emp_endereco: {
                    required: {
                        depends: function(element){
                            return $("#check_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                },
                des_uf_empresa: {
                    required: {
                        depends: function(element){
                            return $("#check_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                },
                des_emp_telefone: {
                    required: {
                        depends: function(element){
                            return $("#check_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                }
            

            },
            errorClass: 'invalido',
            errorPlacement: function() {
                return false;
            },
            submitHandler: function(form) {
                enviaViaAjax();
            }
        });

        $("#btCancelar").click(function() {
            $('#abreNovoProduto').removeClass('activeNovoButton');
            $("#despachante").slideUp();
        });



        $("#div_empresa").hide();
        var empresa = $("#des_emp_codigo").val();
        if (empresa > 0) {
            $("#div_empresa").show();
            $("#check_empresa").prop("checked", true);
        }


    });
</script>




<style>
    /*
		INPUTS ------------------------------------------------------------------------------------------------------------------
		*/
    select.select {
        padding: 5px;
        border: 1px solid #4C4C4C;
        outline: 0;
        background: transparent;
        margin: 1px 0px 1px 0px;
        width: 183px;
    }
    select.select:focus {
        box-shadow: inset 0px 0px 2px #4C4C4C;
    }
    select.select.invalido {
        border: 1px solid #B40000;
        box-shadow: 0px 0px 1px #B40000;
    }
    select.select.invalido:focus {
        box-shadow: inset 0px 0px 2px #B40000, 0px 0px 1px #B40000;
    }
    /*
		-------------------------------------------------------------------------------------------------------------------------------
		*/
</style>


<?php $dados=$query->row(); $cidade = $queryCidade->result(); //print_r($datanascimento); //exit(); ?>

<span class="createnovotitle">Atualizar Despachante</span>
<hr>
<form id="update" method="POST">
    <table class="tableNovo">

        <!--hidden fields-->
        <tr>
            <td>
                <input type="hidden" id="codigo_despachante" name="codigo_despachante" value="<?php echo $dados->des_codigo; ?>">

                <input type="hidden" value="<?php echo  $dados->end_codigo;?>" name="end_codigo">

                <input type="hidden" id="des_emp_codigo" value="<?php echo $dados->des_emp_codigo;?>">

                <input type="hidden" id="emp_codigo" name="emp_codigo" value="<?php echo $dados->emp_codigo;?>">
            </td>
        </tr>
        <!--hidden fields-->

        <tr>
            <td class="label">
                <label>Nome</label>
            </td>

            <td>
                <input style="width:300px;" id="despachante_nome" style="width: 300px;" class="input" value="<?php echo $dados->des_nome; ?>" type="text" name="despachante_nome">
            </td>
            <td class="label">
                <label>Estado civil</label>
            </td>

            <td>
                <select class="select" id="estado_civil" name="despachante_estado_civil">
                    <?php if ($dados->des_estado_civil == "") { $sel1 = "selected"; $sel2= $sel3= $sel4= $sel5 = ''; } else if ($dados->des_estado_civil == "solteiro") { $sel2 = "selected"; $sel3= $sel4= $sel5= $sel1 = ''; } else if ($dados->des_estado_civil == "casado") { $sel3 = "selected"; $sel1= $sel2= $sel4= $sel5 = ''; } else if ($dados->des_estado_civil == "viuvo") { $sel4 = "selected"; $sel1= $sel2=$sel3= $sel5 = ''; } else if ($dados->des_estado_civil == "divorciado") { $sel5 = "selected"; $sel1= $sel2 =$sel4= $sel3 = ''; } ?>
                    <option <?php echo $sel1; ?>value="">Selecione</option>
                    <option <?php echo $sel2; ?>value="solteiro">Solteiro</option>
                    <option <?php echo $sel3; ?>value="casado">Casado</option>
                    <option <?php echo $sel4; ?>value="viuvo">Viuvo</option>
                    <option <?php echo $sel5; ?>value="divorciado">Divorciado</option>
                </select>
            </td>
        </tr>

        <tr>
            <td class="label">
                <label>Nome Mae</label>
            </td>

            <td>
                <input class="input" style="width: 300px;" type="text" value="<?php echo $dados->des_nome_mae; ?>" name="despachante_nome_mae">
            </td>

            <td class="label">
                <label>Matricula CRDD/AM</label>
            </td>

            <td>
                <input class="input" type="text" value="<?php echo $dados->des_matricula; ?>" id="despachante_matricula" name="des_matricula">
            </td>

        </tr>


        <tr>
            <td class="label">
                <label>Nome Pai</label>
            </td>

            <td>
                <input class="input" style="width: 300px;" type="text" value="<?php echo $dados->des_nome_pai; ?>" name="despachante_nome_pai">
            </td>
            <td class="label">
                <label>Matricula SINDESDAM</label>
            </td>

            <td>
                <input class="input" type="text" value="<?php echo $dados->des_matricula_SINDESAM; ?>" id="despachante_matricula_sindesam" name="des_matricula_SINDESAM">
            </td>
        </tr>



        <tr>
            <!--estado naturalidade-->
            <td class="label">
                <label>Estado</label>
            </td>
            <td>

                <select class="select" name="despachante_estado" id="des_estado" onchange="mostra_municipios();">
                    <option value="">Selecione</option>
                    <?php if ($uf->num_rows() > 0) { foreach ($uf->result() as $row) { if($row->codigo == substr($dados->des_cod_naturalidade, 0,2)){ $selected = 'selected'; }else{ $selected = ''; } echo "
                    <option " . $selected ." value='" . $row->codigo . "'>" . $row->sigla . "-" . $row->unidade . "</option>"; } }else{ echo "
                    <option>nada encontrado</option>"; } ?>
                </select>
            </td>
            <!--estado naturalidade-->

            <!-- cidade natural--selecionado pelo banco-->
            <td class="label">
                <label>Naturalidade</label>
            </td>
            <td id="naturalidade_td">

                <select class="select" name="des_naturalidade" id="naturalidade">
                    <?php if ($queryCidade->num_rows() > 0) { foreach ($queryCidade->result() as $row) { if ($row->codigo == $dados->des_cod_naturalidade) { $selected = 'selected'; } else { $selected = ''; } echo "
                    <option " . $selected . " value='" . $row->codigo . "'>" . $row->nome . "</option>"; } } else { echo "
                    <option>nada encontrado</option>"; } ?>
                </select>
                <!-- cidade natural--selecionado pelo banco-->
            </td>
        </tr>


        <tr>
            <td class="label">
                <label>Data Nascimento</label>
            </td>
            <td>
                <input class="input" id="despachante_data_nascimento" type="text" value="<?php echo $datanascimento; ?>" name="despachante_data_nascimento">
            </td>

            <td class="label">
                <label>Sexo</label>
            </td>

            <td>
                <select class="select" name="despachante_sexo" value="<?php set_value('despachante_sexo'); ?>">
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                </select>
            </td>



        </tr>

        <tr>
            <td class="label">
                <label>RG</label>
            </td>

            <td>
                <input class="input" id="despachante_rg" type="text" value="<?php echo $dados->des_rg; ?>" name="despachante_rg">
            </td>

            <td class="label">
                <label>Orgao Emissor</label>
            </td>

            <td>
                <input class="input" type="text" value="<?php echo $dados->des_orgao_emissor; ?>" name="despachante_rg_orgao_emissor">
            </td>

        </tr>

        <tr>
            <td class="label">
                <label>CPF</label>
            </td>

            <td>
                <input class="input" type="text" id="despachante_cpf" value="<?php echo $dados->des_cpf; ?>" name="despachante_cpf">
            </td>

            <td class="label">
                <label>Grau Instrucao</label>
            </td>

            <td>
                <input class="input" type="text" value="<?php echo $dados->des_grau_instrucao; ?>" name="despachante_grau_de_instrucao">
            </td>
        </tr>

        <tr>
            <td class="label">
                <label>Titulo Eleitoral</label>
            </td>

            <td>
                <input class="input" id="despachante_titulo_eleitoral" type="text" value="<?php echo $dados->des_titulo_eleitoral; ?>" name="despachante_titulo_eleitoral">
            </td>

            <td class="label">
                <label>Zona Eleitoral</label>
            </td>
            <td>
                <input class="input" type="text" name="despachante_titulo_eleitoral_zona" value="<?php echo $dados->des_zona_eleitoral ?>">
            </td>
        </tr>

        <tr>
            <td class="label">
                <label>Sessao Eleitoral</label>
            </td>


            <td>
                <input class="input" type="text" name="despachante_titulo_eleitoral_sessao" value="<?php echo $dados->des_sessao_eleitoral ?>">
            </td>

            <td class="label">
                <label>Forma Ingresso</label>
            </td>

            <td>
                <input class="input" type="text" value="<?php echo $dados->des_forma_ingresso; ?>" name="despachante_forma_ingresso">
            </td>


        </tr>

        <tr>

            <td class="label">
                <label>Telefone</label>
            </td>

            <td>
                <input type="text" class="input" name="des_telefone" id="des_telefone" value="<?php echo $dados->des_telefone; ?>">
            </td>

            <td class="label">
                <label>Celular</label>
            </td>

            <td>
                <input type="text" class="input" name="des_celular" id="des_celular" value="<?php echo $dados->des_celular; ?>">
            </td>


        </tr>

        <tr>

            <td class="label">
                <label>E-Mail</label>
            </td>

            <td>
                <input type="text" style="width: 300px;" class="input" name="des_email" id="des_email" value="<?php echo $dados->des_email; ?>">
            </td>
        </tr>


        <tr>
            <td class="label">
                <label>Logradouro</label>
            </td>

            <td>
                <input type="text" style="width: 300px;" class="input" name="end_descricao" id="end_descricao" value="<?php echo $dados->end_descricao; ?>">
            </td>

            <td class="label">
                <label>CEP</label>
            </td>
            <td>
                <input id="end_cep" class="input" type="text" value="<?php echo $dados->end_cep; ?>" name="end_cep">
            </td>

        </tr>

        <tr>

            <td class="label">
                <label>Bairro</label>
            </td>

            <td>
                <input id="end_bairro" class="input" type="text" value="<?php echo $dados->end_bairro; ?>" name="end_bairro">
            </td>


            <td class="label">
                <label>Complemento</label>
            </td>

            <td>
                <input type="text" class="input" name="end_complemento" id="end_complemento" value="<?php echo $dados->end_complemento; ?>">
            </td>

        </tr>



        <!-- endereco-->
        <tr id="selecionando_uf">
            <td class="label">
                <label for="uf">UF</label>
            </td>
            <td width="115">
                <select class="select" name="uf" id="uf" onchange="show_municipio();">
                    <option value="">Selecione</option>
                    <?php if ($uf->num_rows() > 0) { foreach ($uf->result() as $row) { if($row->codigo == $dados->end_coduf) { $selected = 'selected'; }else{ $selected = ''; } echo "
                    <option " . $selected ." value='" . $row->codigo . "'>" . $row->sigla . "-" . $row->unidade . "</option>"; } } ?>
                </select>
            </td>

            <td class="label">
                <label for="municipio">Municipio</label>
            </td>

            <td id="naturalidade_td">

                <!--selecionado pelo banco-->
                <select class="select" name="end_cod_mun" id="end_cod_mun">
                    <?php if ($queryCidade2->num_rows() > 0) { foreach ($queryCidade2->result() as $endCidade) { $bla .= 'c: '.$endCidade->codigo.', m: '.$dados->end_codmunicipio.'
                    <br>'; if ($endCidade->codigo == $dados->end_codmunicipio) { $selected = 'selected=selected'; } else { $selected = ''; } echo "
                    <option " . $selected . " value='" . $endCidade->codigo . "'>" . $endCidade->nome . "</option>"; } } else { echo "
                    <option>nada encontrado</option>"; } ?>
                </select>

                <!--selecionado pelo banco-->
            </td>
        </tr>
        <tr>
            <td class="label">
                <label>Possui Empresa?</label>
            </td>
            <td>
                <input type="checkbox" class="checkbox" value="sim" id="check_empresa" name="check_empresa">
            </td>
            <tr>
                <!-- endereco -->
    </table>

    <!--empresa-->

    <div id="div_empresa">
        <?php if ($dados->emp_codigo != '') { $disabled = "disabled='disabled'"; } else { $disabled = ''; } ?>
        <table class="tableNovo">
            <tr>
                <td class="label">
                    <label for="nome_empresa">Nome Empresa</label>
                </td>
                <td>
                    <input type="text" id="emp_nome" class="input" style="width:300px;" name="des_emp_nome" value="<?php echo $dados->emp_nome;?>">
                </td>

                <td class="label">
                    <label for="cnpj_empresa">CNPJ</label>
                </td>
                <td>
                    <input type="text" id="des_emp_cnpj" class="input" name="des_emp_cnpj" value="<?php echo $dados->emp_cnpj;?>">
                </td>


            </tr>
            <tr>
                <td class="label">
                    <label for="endereco_empresa">Endereco Comercial:</label>
                </td>
                <td>
                    <input type="text" id="emp_rua" class="input" name="des_emp_endereco" value="<?php echo $dados->emp_rua;?>">
                </td>

                <td class="label">
                    <label for="bairro_empresa">Bairro:</label>
                </td>
                <td>
                    <input type="text" id="emp_bairro" class="input" name="end_emp_bairro" value="<?php echo $dados->emp_bairro;?>">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="complemento_empresa">Complemento:</label>
                </td>
                <td>
                    <input type="text" id="emp_complemento" class="input" name="des_emp_complemento" value="<?php echo $dados->emp_complemento;?>">
                </td>

                <td class="label">
                    <label for="cep_empresa">CEP:</label>
                </td>
                <td>
                    <input type="text" id="emp_cep" class="input" name="des_emp_cep" value="<?php echo $dados->emp_cep;?>">
                </td>
            </tr>

            <!--empresa endereco-->
            <tr>
                <td class="label">
                    <label for="estado_empresa">Estado:</label>
                </td>
                <td>
                    <select class="select" name="des_uf_empresa" id="des_uf_empresa" onchange="show_municipio_empresa();">
                        <option value="">Selecione</option>
                        <?php if ($uf->num_rows() > 0) { foreach ($uf->result() as $row) { if($row->codigo == $dados->emp_uf_codigo) { $selected = 'selected'; } else { $selected = ''; } echo "
                        <option " . $selected ." value='" . $row->codigo . "'>" . $row->sigla . "-" . $row->unidade . "</option>"; } } ?>
                    </select>
                </td>

                <td class="label">
                    <label for="municipio_empresa">Municipio:</label>
                </td>
                <td>
                    <select name="des_empresa_municipio" id="des_empresa_municipio" class="select">
                        <?php if($queryCidade3->num_rows()>0) { foreach ($queryCidade3->result() as $cidEmp) { if($cidEmp->codigo == $dados->emp_mun_codigo) { $selected = "selected"; } else { $selected = ""; } echo "
                        <option ".$selected." value=".$cidEmp->codigo.">".$cidEmp->nome."</option>"; } } ?>
                        <option value="">Selecione</option>
                    </select>
                </td>
            </tr>
            <!--empresa endereco-->

            <tr>
                <td class="label">
                    <label for="empresa_telefoone">Telefone Comercial:</label>
                </td>
                <td>
                    <input type="text" id="emp_telefone" class="input" name="des_emp_telefone" value="<?php echo  $dados->emp_telefone;?>">
                </td>

                <td class="label">
                    <label for="fac_simile_empresa">Fac Simile:</label>
                </td>
                <td>
                    <input type="text" id="emp_fac_simile" class="input" name="des_emp_fac_simile" value="<?php echo  $dados->emp_fac_simile;?>">
                </td>

            </tr>
            <tr>
                <td class="label">
                    <label for="resgional_seccional">Regional Seccional:</label>
                </td>
                <td>
                    <input type="text" id="emp_reg_seccional" class="input" name="des_emp_reg_seccional" value="<?php echo  $dados->emp_regiao_seccional;?>">
                </td>

            </tr>
        </table>
    </div>
    <!--empresa-->

    <table class="tableNovo">
        <tr>
            <td colspan="4">
                <input class="formButton submit" type="submit" value="salvar" id="btEnviar">
                <input class="formButton cancel" type="button" value="cancelar" id="btCancelar">
            </td>
        </tr>

    </table>

</form>