<script>
 $(document).ready(function (){
     //alert('alo');
     $("#veiculo_outorgante_cpf").mask("999.999.999-99");
     
     $("#veiculo_ano").mask("99/99/9999");
     $("#veiculo_placa").mask("AAA-9999");
     
    $("#create").validate({
        rules:{
            veiculo_outorgante_cpf:{required:true},
            veiculo_renavam:{required:true},
            veiculo_placa:{required:true},
            veiculo_marca:{required:true},
            veiculo_modelo:{required:true},
            veiculo_ano:{required:true},
            veiculo_chassi:{required:true},
            
               },
               messages:{
                   veiculo_renavam:{required:"preencher campo"},
                   veiculo_outorgante_cpf:{required:"preencher campo"},
                   veiculo_placa:{required:"preencher campo"},
                   veiculo_marca:{required:"preencher campo"},
                   veiculo_modelo:{required:"preencher campo"},
                   veiculo_ano:{required:"preencher campo"},
                   veiculo_chassi:{required:"preencher campo"},
               }
    });
    
     
 });
 </script>

<section>
            <fieldset> 
                <legend> 
                Cadastro de Autorgante
                </legend>
                
                <form id="create" action="/Despachante_system/index.php/administrador/veiculo/cadastrar" method="post">
                    <div>
                        <table id="" class="table">
                                <tr>
                                    <td><label>Placa*</label></td>
                                    <td>
                                        <input id="veiculo_placa" class="input" type="text" name="veiculo_placa" value="">
                                    </td>
                                    
                                </tr>
                                
                                 <tr>
                                    <td><label>Renavam*</label></td>
                                    <td>
                                        <input class="input" id="veiculo_renavam" type="text" name="veiculo_renavam"></td>
                                    
                                </tr>
                                
                                <tr><td><label>Marca*</label></td>
                                    <td>
                                        <input class="input" id="veiculo_marca" type="text" name="veiculo_marca"></td>
                                    
                                </tr>
                                
                                <tr><td><label>Modelo</label></td>
                                    <td>
                                        <input class="input" type="text" id="veiculo_modelo" name="veiculo_modelo"></td>
                                    
                                </tr>
                                  
                                <tr><td><label>Ano*</label></td>
                                    <td>
                                        <input class="input" type="text" id="veiculo_ano" name="veiculo_ano"></td>
                                    
                                </tr>
                                  
                                <tr><td><label>Chassi*</label></td>
                                    <td>
                                        <input class="input" type="text" id="veiculo_chassi" name="veiculo_chassi"></td>
                                    
                                </tr>
                                    <td>
                                        <input  class="input" type="hidden" id="veiculo_despachante_codigo" value="1" name="veiculo_despachante_codigo"></td>
                                    
                                </tr>
                                  
                                <tr><td><label>Outorgante CPF*</label></td>
                                    <td>
                                        <input class="input" type="text" id="veiculo_outorgante_cpf" name="veiculo_outorgante_cpf"></td>
                                    
                                </tr>
                                <tr>
                                    <td><input class="submit" type="submit" value="Enviar"></td>
                                </tr>
                                
                            </table>
                       
                    </div>
                    
                    
                </form>
            </fieldset>
    </section>
       
       