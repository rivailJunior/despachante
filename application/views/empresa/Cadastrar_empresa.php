
 <script>
 $(document).ready(function (){
     //alert('alo');
     $("#outorgante_cpf").mask("999.999.999-99");
     $("#outorgante_rg").mask("9999999-9");
     $("#data_nascimento").mask("99/99/99999");
     
    $("#create").validate({
        rules:{
            empresa_processo:{required:true},
            Empresa_FAC_Simile:{required:true},
            empresa_SSP:{required:true},
            empresa_regiao_seccional:{required:true}
               },
               messages:{
                   empresa_processo:{required:"preencher campo"},
                   Empresa_FAC_Simile:{required:"preencher campo"},
                   empresa_SSP:{required:"preencher campo"},
                   empresa_regiao_seccional:{required:"preencher campo"}
               }
    });
    
     
 });
 </script>

<section>
            <fieldset> 
                <legend> 
                Cadastro Empresa
                </legend>
                
                <form id="create" action="/Despachante_system/index.php/administrador/empresa/cadastrar" method="post">
                    <div>
                        <table id="" class="table">
                                <tr>
                                    <td><label>Prosesso</label></td>
                                    <td>
                                        <input id="empresa_processo" class="input" type="text" name="empresa_processo">
                                    </td>
                                    
                                </tr>
                                
                                 <tr>
                                    <td><label>SSP</label></td>
                                    <td>
                                        <input class="input" id="empresa_SSP" type="text" name="empresa_SSP"></td>
                                    
                                </tr>
                                
                                <tr><td><label>Fac Simile</label></td>
                                    <td>
                                        <input class="input" id="Empresa_FAC_Simile" type="text" name="Empresa_FAC_Simile"></td>
                                    
                                </tr>
                                
                                <tr><td><label>Regiao Seccional</label></td>
                                    <td>
                                    <input class="input" type="text" id="empresa_regiao_seccional" name="empresa_regiao_seccional"></td>
                                    
                                </tr>
                                <input class="input" type="hidden" value="1" id="empresa_despachante_codigo" name="empresa_despachante_codigo">
                                <tr>
                                    <td><input class="submit" type="submit" value="Enviar"></td>
                                </tr>
                                
                            </table>
                       
                    </div>
                    
                    
                </form>
            </fieldset>
    </section>
       
       