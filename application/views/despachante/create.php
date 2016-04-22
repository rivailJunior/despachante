<script src="<?php echo base_url('/assets/jscript.js'); ?>" type="text/javascript"></script>

<script>
    function show_municipio(tipo) {
        // alert('here');
        if (tipo == 'uf') 
        {
            var code = $("#uf").val();
            var element = $('#municipio');
        } 
        else if (tipo == 'estado') 
        {
            var code = $("#des_estado").val();
            var element = $('#municipio_des');
        };
        element.load('<?php echo site_url("despachante/listarMunicipios/'+code+'"); ?>');
    }

    function show_municipio_empresa() {
        var code = $("#des_uf_empresa").val();
        $('#des_empresa_municipio').load('<?php echo site_url(); ?>/despachante/listarMunicipios/' + code);
    }

    function verificaMatricula() {

        var matricula = $("#despachante_matricula").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('despachante/check_matricula'); ?>",
            data: {
                'matricula': matricula
            },
            success: function(res) {
                if (res == 1) {
                    alert("Atenção! A matricula inserida já está cadastrada, por favor digite nova matricula ou deixe o campo em branco para inserir uma matricula automatica.");
                    $('#despachante_matricula').val('');
                    $('#despachante_matricula').css('border', '1px solid #B40000');
                    $("#despachante_matricula").css("box-shadow", "0px 0px 1px #B40000");
                    $('#despachante_matricula').focus();
                } else {
                    //alert("matricula inexistente");
                    $('#despachante_matricula').css('border', '1px solid #228B22');
                    $("#despachante_matricula").css("box-shadow", "0px 0px 1px #228B22");
                }
            },
            error: function(res) {
                alert("nem entra no controller");
            }
        });

    } //fim da function



    function verificaRg() {

        var matricula = $("#despachante_rg").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('despachante/check_rg'); ?>",
            data: {
                'rg': matricula
            },
            success: function(res) {
                if (res == 1) {
                    alert("Atenção!Rg ja existe");
                    $('#despachante_rg').val('');
                    $('#despachante_rg').css('border', '1px solid #B40000');
                    $("#despachante_rg").css("box-shadow", "0px 0px 1px #B40000");
                    $('#despachante_rg').focus();
                } else {
                    //alert("matricula inexistente");
                    $('#despachante_rg').css('border', '1px solid #228B22');
                    $("#despachante_rg").css("box-shadow", "0px 0px 1px #228B22");
                }
            },
            error: function(res) {
                alert("nem entra no controller");
            }
        });

    } //fim da function


    function verificaCpf() {

        var matricula = $("#despachante_cpf").val();

        if (matricula.length > 5) {
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('despachante/check_cpf'); ?>",
                data: {
                    'cpf': matricula
                },
                success: function(res) {
                    if (res == 1) {
                        alert("Atenção!Cpf ja existe!");
                        $('#despachante_cpf').val('');
                        $('#despachante_cpf').css('border', '1px solid #B40000');
                        $("#despachante_cpf").css("box-shadow", "0px 0px 1px #B40000");
                        $('#despachante_cpf').focus();
                    } else {
                        //alert("matricula inexistente");
                        //$('#despachante_cpf').css('border', '1px solid #228B22');
                        //$("#despachante_cpf").css("box-shadow", "0px 0px 1px #228B22");
                    }
                },
                error: function(res) {
                    alert("nem entra no controller");
                }
            });
        }

    } //fim da function

    $(document).ready(function() {

        validator = $("#create").validate({
            rules: {
                contato_numero: {
                    required: true
                },
                despachante_naturalidade: {
                    required: true
                },
                despachante_estado: {
                    required: true
                },
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
                despachante_data_nascimento: {
                    required: true
                },
                despachante_titulo_eleitoral: {
                    required: true
                },
                des_email: {
                    required: true,
                    email: true
                },
                des_numero: {
                    required: true
                },
                end_descricao: {
                    required: true
                },
                end_cep: {
                    required: true
                },
                end_complemento: {
                    required: true
                },
                uf: {
                    required: true
                },
                municipio: {
                    required: true
                },
                end_bairro: {
                    required: true
                },
                des_emp_cnpj: {
                    validaCNPJ: {
                        depends: function(element){
                            return $("#sel_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                },
                des_emp_nome: {
                    required: {
                        depends: function(element){
                            return $("#sel_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                },
                des_emp_endereco: {
                    required: {
                        depends: function(element){
                            return $("#sel_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                },
                des_uf_empresa: {
                    required: {
                        depends: function(element){
                            return $("#sel_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                },
                des_emp_telefone: {
                    required: {
                        depends: function(element){
                            return $("#sel_empresa").is(':checked'); // depende do checkbox da empresa
                        }
                    }
                }
            },
            errorClass: 'invalido',
            ignore: ".ignore",
            errorPlacement: function() {
                return false;
            },
            submitHandler: function(form) {
                var campo = $('#create').serialize();

                $.ajax({
                    url: "<?php echo site_url('despachante/salvarteste/'); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'campo': JSON.stringify(campo)
                    },
                    success: function(res) {
                        // alert(JSON.stringify(res));
                        if (res == 1) {
                            var n = noty({
                                layout: 'top',
                                type: 'success',
                                timeout: 2000,
                                text: 'Despachante cadastrado com <b>sucesso</b>.',
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
                                text: '<b>Erro</b> ao cadastrar despachante.',
                                callback: {
                                    afterClose: function() {
                                        window.location.reload();
                                    }
                                }
                            });

                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log("Error occured: " + thrownError + " " + xhr.status + " " + ajaxOptions);
                    }
                });
            }
        });

        $.validator.addMethod("validaCpf", function(value, element) {
            var checkCPF = validarCPF($('#despachante_cpf').val());
            return checkCPF;
        });

        $.validator.addMethod("validaCNPJ", function(value, element) {
            var checkCPF = validarCNPJ($('#des_emp_cnpj').val());
            alert(checkCPF);
            return checkCPF;
        });

        $("#btCancelar").click(function() {
            $("#despachante").slideUp();
        });

        $("#despachante_cpf").mask("999.999.999-99");
        //$("#despachante_rg").mask("9999999-9");
        $("#despachante_data_nascimento").mask("99/99/9999");
        $("#contato_numero").mask("9999-9999");
        $("#des_emp_cnpj").mask("99.999.999/9999-99");
        $("#des_telefone").mask("(999)9999-9999");
        $("#end_cep").mask("99999-999");
        $("#des_emp_cep").mask("99999-999");

        $("#despachante_matricula").focusout(verificaMatricula);
        $("#despachante_rg").focusout(verificaRg);
        $("#despachante_cpf").focusout(verificaCpf);

        $('#sel_empresa').click(function(){
            $("#cad_empresa").toggle("blind");

            $("#des_emp_nome").val("");
            $("#des_emp_rua").val("");
            $("#des_emp_complemento").val("");
            $("#end_emp_bairro").val("");
            $("#des_emp_cep").val("");
            $("#des_emp_fac_simile").val("");
            $("#des_emp_reg_seccional").val("");
            $("#des_emp_telefone").val("");
            $("#des_emp_cnpj").val("");
            $("#des_uf_empresa").val("");
            $("#des_empresa_municipio").val("");
        })

        $("#btCancelar").click(function() {
            $('#abreNovoProduto').removeClass('activeNovoButton');
            $("#cadastardespachante").slideUp();
        });


    });
</script>


<span class="createnovotitle">novo despachante</span>
<hr>

<form id="create" method="POST">
    <table class="tableNovo" >


        <tr>
            <td class="label">
                <label for="despachante_nome">Nome</label>
            </td>
            <td>
                <input id="despachante_nome" style="width: 300px;" class="input" value="<?php set_value('despachante_nome'); ?>" type="text" name="despachante_nome" />
            </td>

            <td class="label">
                <label for="despachante_estado_civil">Estado civil</label>
            </td>
            <td>
                <select class="select" value="<?php set_value('despachante_estado_civil'); ?>" id="despachante_estado_civil" name="despachante_estado_civil">
                    <option value="">Selecione</option>
                    <option value="solteiro">Solteiro</option>
                    <option value="casado">Casado</option>
                    <option value="viuvo">Viuvo</option>
                    <option value="divorciado">Divorciado</option>
                </select>
            </td>
        </tr>


        <tr>
            <td class="label">
                <label for="despachante_nome_mae">Nome mãe</label>
            </td>
            <td>
                <input class="input" style="width: 300px;" id="despachante_nome_mae" type="text" value="<?php set_value('despachante_nome_mae'); ?>" name="despachante_nome_mae">
            </td>
            <td class="label">
                <label for="despachante_matricula">Matricula CRDD/AM</label>
            </td>
            <td>
                <input class="input" type="text" value="<?php set_value('despachante_matricula'); ?>" id="despachante_matricula" name="despachante_matricula">
            </td>
        </tr>


        <tr>
            <td class="label">
                <label for="despachante_nome_pai">Nome pai</label>
            </td>
            <td>
                <input class="input" style="width: 300px;" type="text" value="<?php set_value('despachante_nome_pai'); ?>" name="despachante_nome_pai" id="despachante_nome_pai">
            </td>

            <td class="label">
                <label for="des_matricula_SINDESAM">Matricula SINDESDAM</label>
            </td>
            <td width="115">
                <input class="input" type="text" name="des_matricula_SINDESAM" id="des_matricula_SINDESAM">
            </td>


        </tr>



        <!--estado naturalidade-->
        <tr>
            <td class="label">
                <label for="des_estado">Estado</label>
            </td>
            <td width="115">
                <select class="select" name="despachante_estado" id="des_estado" onchange="show_municipio('estado');">
                    <option value="">Selecione</option>
                    <?php if ($uf->num_rows() > 0) { foreach ($uf->result() as $row) { echo '
                    <option value="' . $row->codigo . '">' . $row->sigla . '-' . $row->unidade . '</option>'; } } ?>
                </select>
            </td>

            <td class="label">
                <label for="municipio_des">Naturalidade</label>
            </td>

            <td width="171">
                <select name="despachante_naturalidade" id="municipio_des" class="select" value="<?php set_value('despachante_naturalidade');?>">
                    <option value="">Selecione o estado</option>
                </select>
            </td>
        </tr>
        <!--estado naturalidade-->


        <tr>
            <td class="label">
                <label for="despachante_data_nascimento">Data Nascimento</label>
            </td>
            <td>
                <input class="input" id="despachante_data_nascimento" type="text" value="<?php set_value('despachante_data_nascimento'); ?>" name="despachante_data_nascimento">
            </td>

            <td class="label">
                <label for="despachante_sexo">Sexo</label>
            </td>
            <td>
                <select class="select" id="despachante_sexo" name="despachante_sexo" value="<?php set_value('despachante_sexo'); ?>">
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                </select>
            </td>
        </tr>




        <tr>
            <td class="label">
                <label for="despachante_rg">RG</label>
            </td>
            <td>
                <input class="input" id="despachante_rg" type="text" value="<?php set_value('despachante_rg'); ?>" name="despachante_rg">
            </td>

            <td class="label">
                <label for="despachante_rg_orgao_emissor">Orgao Emissor RG</label>
            </td>
            <td>
                <input class="input" type="text" id="despachante_rg_orgao_emissor" value="<?php set_value('despachante_rg_orgao_emissor'); ?>" name="despachante_rg_orgao_emissor">
            </td>
        </tr>




        <tr>
            <td class="label">
                <label for="despachante_cpf">CPF</label>
            </td>
            <td>
                <input class="input" type="text" id="despachante_cpf" value="<?php set_value('despachante_cpf'); ?>" name="despachante_cpf">
            </td>

            <td class="label">
                <label for="despachante_grau_de_instrucao">Grau Instrução</label>
            </td>
            <td>
                <input class="input" type="text" id="despachante_grau_de_instrucao" value="<?php set_value('despachante_grau_de_instrucao'); ?>" name="despachante_grau_de_instrucao">
            </td>
        </tr>



        <tr>
            <td class="label">
                <label for="despachante_titulo_eleitoral">Título Eleitoral</label>
            </td>
            <td>
                <input class="input" id="despachante_titulo_eleitoral" type="text" value="<?php set_value('despachante_titulo_eleitoral'); ?>" name="despachante_titulo_eleitoral">
            </td>

            <td class="label">
                <label for="despachante_titulo_eleitoral_zona">Zona Eleitoral</label>
            </td>
            <td>
                <input class="input" type="text" id="despachante_titulo_eleitoral_zona" name="despachante_titulo_eleitoral_zona" value="<?php set_value('despachante_titulo_eleitoral_zona'); ?>">
            </td>
        </tr>



        <tr>
            <td class="label">
                <label for="despachante_titulo_eleitoral_sessao">Sessao Eleitoral</label>
            </td>
            <td>
                <input class="input" type="text" id="despachante_titulo_eleitoral_sessao" name="despachante_titulo_eleitoral_sessao" value="<?php set_value('despachante_titulo_eleitoral_sessao'); ?>">
            </td>

            <td class="label">
                <label for="despachante_forma_ingresso">Forma Ingresso</label>
            </td>
            <td>
                <input class="input" type="text" id="despachante_forma_ingresso" value="<?php set_value('despachante_forma_ingresso'); ?>" name="despachante_forma_ingresso">
            </td>
        </tr>


        <tr>
            <td class="label">
                <label for="des_celular">Celular</label>
            </td>
            <td>
                <input type="text" class="input" name="des_celular" id="des_celular" value="<?php set_value('des_celular'); ?>">
            </td>

            <td class="label">
                <label for="des_telefone">Telefone</label>
            </td>
            <td>
                <input type="text" class="input" name="des_telefone" id="des_telefone" value="<?php set_value('des_telefone'); ?>">
            </td>
        </tr>



        <tr>
            <td class="label">
                <label for="des_email">E-Mail</label>
            </td>
            <td>
                <input type="text" style="width: 300px;" class="input" name="des_email" id="des_email" value="<?php set_value('des_email'); ?>">
            </td>
        </tr>


        <tr>
            <td class="label">
                <label for="end_descricao">Logradouro</label>
            </td>
            <td>
                <input type="text" style="width: 300px;" class="input" name="end_descricao" id="end_descricao" value="<?php set_value('end_descricao'); ?>">
            </td>

            <td class="label">
                <label for="end_cep">Cep</label>
            </td>
            <td>
                <input type="text" class="input" name="end_cep" id="end_cep" value="<?php set_value('end_cep'); ?>">
            </td>
        </tr>


        <tr>
            <td class="label">
                <label for="end_bairro">Bairro</label>
            </td>
            <td>
                <input type="text" class="input" name="end_bairro" id="end_bairro" value="<?php set_value('end_bairro'); ?>">
            </td>
            <td class="label">
                <label for="end_complemento">Complemento</label>
            </td>
            <td>
                <input type="text" class="input" name="end_complemento" id="end_complemento" value="<?php set_value('end_complemento'); ?>">
            </td>
        </tr>




        <!-- endereco-->
        <tr>
            <td class="label">
                <label for="uf">UF</label>
            </td>
            <td width="115">
                <select class="select" name="uf" id="uf" onchange="show_municipio('uf');">
                    <option value="">Selecione</option>
                    <?php if ($uf->num_rows() > 0) { foreach ($uf->result() as $row) { echo '
                    <option value="' . $row->codigo . '">' . $row->sigla . '-' . $row->unidade . '</option>'; } } ?>
                </select>
            </td>
            <td class="label">
                <label for="municipio">Cidade</label>
            </td>

            <td width="171">
                <select name="municipio" id="municipio" class="select" value="<?php set_value('des_cod_municipio'); ?>">
                    <option value="">Selecione a UF</option>
                </select>
            </td>

        </tr>
        <!--endereco-->

        <tr>
            <td class="label">
                <label for="sel_empresa">Cadastrar Empresa</label>
            </td>
            <td>
                <input type="checkbox" class="checkbox" name="check_empresa" id="sel_empresa" value="sim">
            </td>
        </tr>

    </table>

<!-- EMPRESA ********************************************************************************************************* -->

    <div id="cad_empresa" hidden>
        <table class="tableNovo" >
            <tr>
                <td class="label">
                    <label for="des_emp_nome">Nome Empresa</label>
                </td>
                <td>
                    <input type="text" class="input" id="des_emp_nome" style="width:300px;" name="des_emp_nome" value="<?php echo set_value('des_emp_nome')?>">
                </td>

                <td class="label">
                    <label for="des_emp_cnpj">CNPJ</label>
                </td>
                <td>
                    <input type="text" class="input" id="des_emp_cnpj" name="des_emp_cnpj" value="<?php echo set_value('des_emp_cnpj')?>">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="des_emp_rua">Endereco Comercial</label>
                </td>
                <td>
                    <input type="text" class="input" id="des_emp_rua" name="des_emp_endereco" value="<?php echo set_value('des_emp_endereco');?>">
                </td>

                <td class="label">
                    <label for="end_emp_bairro">Bairro</label>
                </td>
                <td>
                    <input type="text" class="input" id="end_emp_bairro" name="end_emp_bairro" value="<?php echo set_value('end_emp_bairro');?>">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="des_emp_complemento">Complemento</label>
                </td>
                <td>
                    <input type="text" class="input" id="des_emp_complemento" name="des_emp_complemento" value="<?php echo set_value('des_emp_complemento');?>">
                </td>

                <td class="label">
                    <label for="des_emp_cep">CEP</label>
                </td>
                <td>
                    <input type="text" class="input" id="des_emp_cep" name="des_emp_cep" value="<?php echo set_value('des_emp_cep');?>">
                </td>
            </tr>

            <!--empresa endereco-->
            <tr>
                <td class="label">
                    <label for="des_uf_empresa">Estado</label>
                </td>
                <td>
                    <select class="select" name="des_uf_empresa" id="des_uf_empresa" onchange="show_municipio_empresa();">
                        <option value="">Selecione</option>
                        <?php if ($uf->num_rows() > 0) { foreach ($uf->result() as $row) { echo '
                        <option value="' . $row->codigo . '">' . $row->sigla . '-' . $row->unidade . '</option>'; } } ?>
                    </select>
                </td>

                <td class="label">
                    <label for="des_empresa_municipio">Municipio</label>
                </td>
                <td>
                    <select name="des_empresa_municipio" id="des_empresa_municipio" class="select" value="<?php set_value('des_empresa_municipio'); ?>">
                        <option value="">Selecione</option>
                    </select>
                </td>
            </tr>
            <!--empresa endereco-->

            <tr>
                <td class="label">
                    <label for="des_emp_telefone">Telefone Comercial</label>
                </td>
                <td>
                    <input type="text" class="input" id="des_emp_telefone" name="des_emp_telefone" value="<?php echo set_value('des_emp_telefone');?>">
                </td>
                <td class="label">
                    <label for="des_emp_fac_simile">Fac Simile</label>
                </td>
                <td>
                    <input type="text" class="input" id="des_emp_fac_simile" name="des_emp_fac_simile" value="<?php echo set_value('des_emp_fac_simile');?>">
                </td>

            </tr>
            <tr>
                <td class="label">
                    <label for="des_emp_reg_seccional">Regional Seccional</label>
                </td>
                <td>
                    <input type="text" class="input" id="des_emp_reg_seccional" name="des_emp_reg_seccional" value="<?php echo set_value('des_emp_reg_seccional');?>">
                </td>

            </tr>
        </table>
    </div>

    <!--empresa-->

    <table>
        <tr colspan="2">
            <td>
                <input class="formButton submit" type="submit" id="btEnviar" name="btEnviar" value="enviar" />
            </td>
            <td>
                <input class="formButton cancel" type="button" id="btCancelar" name="btCancelar" value="cancelar" />
            </td>
        </tr>
    </table>

</form>