<script>
    $(document).ready(function() {
        //alert('alo');
        $("#veiculo_outorgante_cpf").mask("999.999.999-99");

        $("#veiculo_ano").mask("99/99/9999");
        $("#veiculo_placa").mask("AAA-9999");

        $("#create").validate({
            rules: {
                veiculo_outorgante_cpf: {required: true},
                veiculo_renavam: {required: true},
                veiculo_placa: {required: true},
                veiculo_marca: {required: true},
                veiculo_modelo: {required: true},
                veiculo_ano: {required: true},
                veiculo_chassi: {required: true},
            },
            messages: {
                veiculo_renavam: {required: "preencher campo"},
                veiculo_outorgante_cpf: {required: "preencher campo"},
                veiculo_placa: {required: "preencher campo"},
                veiculo_marca: {required: "preencher campo"},
                veiculo_modelo: {required: "preencher campo"},
                veiculo_ano: {required: "preencher campo"},
                veiculo_chassi: {required: "preencher campo"},
            }
        });


    });
</script>

<section>
    <fieldset> 
        <legend> 
            Cadastro de Poderes
        </legend>

        <form id="create" action="#/Despachante_system/index.php/administrador/veiculo/cadastrar" method="post">
            <div>
                <table id="" class="table">
                    <tr>
                        <td>
                            <textarea id="" placeholder="descricao" class="input" type="text" name="" value=""></textarea>
                        </td>
                    </tr>

                    <tr><td>
                            <input class="input" placeholder="valor" id="" type="text" name=""></td>

                    </tr>

                    <tr>
                        <td>
                            <input class="input" placeholder="motivo" id="" type="text" name=""></td>

                    </tr>

                 <tr>
                        <td><input class="submit" type="submit" value="Enviar"></td>
                    </tr>

                </table>

            </div>


        </form>
    </fieldset>
</section>

