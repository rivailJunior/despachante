<script>
    $(document).ready(function() {
        //alert('alo');
        $("#des_matricula").mask("999");
        $("#outorgante_cpf").mask("999.999.999-99");
        $("#veiculo_placa").mask("AAA-9999");
        $("#contato_numero").mask("9999-9999");
        $("#outorgante_rg").mask("9999999-9");
        $("#out_cpf").mask("999.999.999-99");
        $("#vei_placa").mask("AAA-9999");
        $("#veiculo_outorgante_cpf").mask("999.999.999-99");
       
       
   
       
       
        $("#create").validate({
            rules: {
                des_matricula:{required:true, minlength: 3},
                outorgante_cpf: {required: true},
               des_codigo: {required: true},
                etiqueta_veiculo_placa: {required: true},
                contato_email:{required:true, email:true},
                contato_numero:{required:true}
            },
            messages: {
                des_matricula:{required:"preencher campo", minlength: "minimo 3 caracteres"},
                etiqueta_outorgante_cpf: {required: "preencher campo"},
                des_codigo: {required: "preencher campo"},
                etiqueta_veiculo_placa: {required: "preencher campo"},
                contato_email:{required:"preencher campo", email:"digite email valido"},
                contato_numero:{required:"preencher campo"}
            }
        });
        
       $("#btFinalizar").click(function (){
       var link = $("#buttonFinalizar").val();
       var codigo = $("#des_codigo").val();
       var placa = $("#vei_placa").val();
       var cpf = $("#out_cpf").val();
        
        //alert("entrou aqui");
        $.ajax({
        url: link,
        type: 'POST',
        dataType: 'json',
        data: {
            'codigo': codigo,
            'placa':placa,
            'cpf':cpf
            
        },
        success: function(res) {
        console.log('res: '+res);
        if(res == 1){
            alert('sucesso');
            window.location.reload();
        }else{
            alert('fracasso');
        }
        
        },error: function(xhr, ajaxOptions, thrownError) {
            alert('fracassoou total');                                
            var w = window.open();
            var html = '<b>Resposta do servidor</b><br><hr>' + xhr.responseText + '<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>' + thrownError;
            $(w.document.body).html(html);                    
        }
      });
      
        });

    });
    
    
    
    
    $(function() {
                $("#outorgante_dados").hide(); 
                $("#veiculo_dados").hide();
               		
                // run the currently selected effect
		function runEffectOutorgante(){
			// get effect type from
			var selectedEffect = $("#effectTypes").val();
			// most effect types need no options passed by default
			var options = {};
			// some effects have required parameters
			if (selectedEffect === "scale") {
				options = { percent: 100 };
			} else if ( selectedEffect === "size" ) {
				options = { to: { width: 280, height: 185 } };
			}                     
			// run the effect
			$("#outorgante_dados").show( selectedEffect, options, 500 );
		};
                
                       // run the currently selected effect
		function runEffectVeiculo(){
			// get effect type from
			var selectedEffect = $("#effectTypes").val();
			// most effect types need no options passed by default
			var options = {};
			// some effects have required parameters
			if (selectedEffect === "scale") {
				options = { percent: 100 };
			} else if ( selectedEffect === "size" ) {
				options = { to: { width: 280, height: 185 } };
			}                     
			// run the effect
			$("#veiculo_dados").show( selectedEffect, options, 500 );
		};
              
	
		//callback function to bring a hidden box back
		function callback() {
			setTimeout(function() {
				$("#outorgante_dados:visible").removeAttr("style").fadeOut();
			}, 1000);
		};
           

		// set effect from select menu value
		$("#novo_outorgante").click(function() {
			runEffectOutorgante();
			return false;
		});
                
                // set effect from select menu value
		$("#novo_veiculo").click(function() {
			runEffectVeiculo();
			return false;
		});
                
           
                $("#fechar_veiculo").click(function (){
                    var option = {};
                  $("#veiculo_dados").hide("blind",option,1000);
                });
                
                $("#fechar_outorgante").click(function (){
                    var option = {};
                    $("#outorgante_dados").hide("blind",option,500);
                });
	});
        
        
      

</script>
<style type="text/css">
    #outorgante_org_emissor
    {
    size: 20;   
    }
</style>


<section>

    <div>
<select hidden="" name="effects" id="effectTypes">
	<option value="blind">Blind</option>
</select>
        <?php
      
            //echo $codigo;
    
        ?>
        
   </div>

        <form id="create" action="#/Despachante_system/index.php/administrador/veiculo/cadastrar" method="post">
            <div>
                <fieldset><legend>Despachante</legend>
                    <table  class="table">
                        <tr><td><input class="input" type="text" placeholder="Matricula Despachante" name="des_matricula" value="<?php echo set_value('des_matricula');?>" id="des_codigo"></td></tr>
                        <tr><td><input class="input" type="text" placeholder="CPF Outorgante" name="out_cpf" value="<?php echo set_value('out_cpf');?>" id="out_cpf"></td>
                            <td><button id="novo_outorgante" class="submit">Novo Outorgante</button></td>
                        </tr>
                        <tr><td><input class="input" type="text" placeholder="Placa Veiculo" name="vei_placa" value="<?php echo set_value('vei_placa');?>" id="vei_placa"></td>
                         <td><button id="novo_veiculo" class="submit">Novo Veiculo</button></td></tr>
                        <tr>
                            <td><input type="submit" class="submit" value="Finalizar" id="btFinalizarServico" name="btFinalizarServico"></td>
                        </tr>
                        
                    </table>
                </fieldset>
            </div>
        </form>
    
            <div id="outorgante_dados" >
                <form id="create" method="post" action="/Despachante_system/index.php/administrador/servico/cadastrar">
                <fieldset>
                    <legend>Outorgante Dados</legend>
                    <table id="" class="table">
                                <tr>
                                    <td>
                                        <input id="outorgante_nome" placeholder="Nome" class="input" type="text" name="outorgante_nome" value="<?php echo set_value('outorgante_nome');?>">
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <input class="input" id="outorgante_rg" placeholder="Rg" type="text" name="outorgante_rg" value="<?php echo set_value('outorgante_rg');?>"></td>
                               
                                    <td>
                                        <input class="input" id="outorgante_org_emissor" placeholder="Orgao Emissor" type="text" name="outorgante_org_emissor" value="<?php echo set_value('outorgante_org_emissor');?>"></td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <input class="input" type="text" id="outorgante_cpf" name="outorgante_cpf" placeholder="CPF" value="<?php echo set_value('outorgante_cpf');?>"></td>
                                </tr>
                                <tr>
                                    <td><input placeholder="Telefone" class="input" type="text" name="contato_numero" id="contato_numero" value="<?php set_value('contato_numero');?>"></td>
                                </tr>
                                <tr>
                                    <td><input placeholder="E-Mail" type="text" class="input" name="contato_email" id="contato_email" value="<?php set_value('contato_email');?>"></td>
                                </tr>
                                <tr>
                                    <td><a href="#" id="fechar_outorgante" class="submit">Fechar</a></td>
                                    <td><input type="submit" name="btCadastrarOutorgante" id="btCadastrarOutorgante" class="submit"></td>
                                </tr>
                             
                            </table>
        
             </fieldset>
        </form>
            </div>
    
    
    <div id="veiculo_dados">
    
      
        <form id="create" method="post" action="/Despachante_system/index.php/administrador/servico/cadastrar">
            <fieldset><legend>Dados Veiculo</legend>
           <table id="" class="table">
                                <tr>
                             
                                    <td>
                                        <input placeholder="Placa" id="veiculo_placa" class="input" type="text" value="<?php echo set_value('veiculo_placa');?>" name="veiculo_placa">
                                    </td>
                                    
                                </tr>
                                
                                 <tr>
                               
                                    <td>
                                        <input placeholder="Renavam" class="input" id="veiculo_renavam" type="text" value="<?php echo set_value('veiculo_renavam');?>" name="veiculo_renavam"></td>
                                    
                                </tr>
                                
                                <tr>
                                    <td>
                                        <input placeholder="Marca" class="input" id="veiculo_marca" type="text" value="<?php echo set_value('veiculo_marca');?>" name="veiculo_marca"></td>
                                    
                                </tr>
                                
                                <tr>
                                    <td>
                                        <input placeholder="Modelo" class="input" type="text" id="veiculo_modelo" value="<?php echo set_value('veiculo_modelo');?>" name="veiculo_modelo"></td>
                                    
                                </tr>
                                  
                                <tr>
                                    <td>
                                        <input placeholder="Ano" class="input" type="text" id="veiculo_ano" value="<?php echo set_value('veiculo_ano');?>" name="veiculo_ano"></td>
                                    
                                </tr>
                                  
                                <tr>
                                    <td>
                                        <input placeholder="Chassi" class="input" type="text" id="veiculo_chassi" value="<?php echo set_value('veiculo_chassi');?>" name="veiculo_chassi"></td>
                                    
                                </tr>
                                    <td>
                                        <input  class="input" type="hidden" id="veiculo_despachante_codigo" value="1" name="veiculo_despachante_codigo"></td>
                                    
                                </tr>
                                  
                                <tr>
                                    <td>
                                        <input placeholder="Cpf Outorgante" class="input" type="text" id="veiculo_outorgante_cpf" value="<?php echo set_value('veiculo_outorgante_cpf');?>" name="veiculo_outorgante_cpf"></td>
                                    
                                </tr>
                                <tr>
                                    <td><a href="#"  id="fechar_veiculo" class="submit">Fechar</a></td>
                                    <td><input type="submit" name="btCadastrarVeiculo" id="btCadastrarVeiculo" class="submit"></td>
                                </tr>
                                
                            </table>
               </fieldset>          
        </form>
           
  
 </div>
   
    <div>
        <input type="hidden" id="buttonFinalizar" value="<?php echo site_url('administrador/servico/finalizarServico');?>">
        <input type="hidden" id="btBuscarOutorgante" value="<?php echo site_url('administrador/servico/buscarOutorgante');?>">
    </div>

   
</section>

