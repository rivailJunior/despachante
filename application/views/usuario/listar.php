<script type="text/javascript">
    
    $(document).on('click','.linkExcluir',function(e){
        var link = $("#btExcluir").val();
       
        var cpf = $(this).attr("id").split('_')[1];
        $.ajax({
            url:link,
            type:'POST',
            dataType:'json',
            data:{
                'cpf':cpf
            },
            success: function(res) 
            {
                console.log('res: '+res);
                if(res==1){
                    var n = noty({
                        layout: 'top',
                        type: 'success',
                        timeout: 2000,
                        text: 'Usuário excluido com sucesso.',
                        callback: {
                            afterClose: function() {window.location.reload();}
                        }
                    });
                    window.location.reload();
                }          
            },
            error: function(xhr, ajaxOptions, thrownError) 
            {
              // alert('Usuario nao pode ser excluido');      
                var w = window.open();
                var html = '<b>Resposta do servidor</b><br><hr>'+xhr.responseText+'<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>'+thrownError;                   
                $(w.document.body).html(html);
                callback();
           },
        });
        
    });
    
    $(document).ready(function(){

    	$('.listarCPF').mask('999.999.999-99');
     
        $('#abreNovoUsuario').click(function(){
            if (!$(this).hasClass('activeNovoButton')) 
            {
                var link = $(this).attr('href');
                if ($(this).is(':visible')) 
                {
                    $('#usuario').slideUp(function(){
                        $('#usuario').load(link, function(response, status, xhr){
                            if (status === 'error') 
                            {
                                alert('Erro: '+xhr.status+" "+xhr.statusText);
                            }
                            else
                            {
                                //goTop();

                                $(this).slideDown();
                                $('#abreNovoUsuario').addClass('activeNovoButton');
                            }
                        });
                    })
                } 
                else
                {
                    $('#usuario').load(link, function(response, status, xhr){
                        if (status === 'error') 
                        {
                            alert('Erro: '+xhr.status+" "+xhr.statusText);
                        }
                        else
                        {
                            //goTop();

                            $(this).slideDown();
                        }
                    });
                };
            }
                
        });

      $('.editar').click(function(){
                $('#abreNovoUsuario').removeClass('activeNovoButton');
                var link = $(this).attr('href');
                if ($(this).is(':visible')) 
                {
                    $('#usuario').slideUp(function(){
                        $('#usuario').load(link, function(response, status, xhr){
                            if (status === 'error') 
                            {
                                alert('Erro: '+xhr.status+" "+xhr.statusText);
                            }
                            else
                            {
                                // goTop();
                                $(this).slideDown();
                            }
                        });
                    })
                } 
                else
                {
                    $('#usuario').load(link, function(response, status, xhr){
                        if (status === 'error') 
                        {
                            alert('Erro: '+xhr.status+" "+xhr.statusText);
                        }
                        else
                        {
                            // goTop();
                            $(this).slideDown();
                        }
                    });
                };
    
        });
});
</script>

<div class="novoEditarDiv" id="usuario"></div>

<table width="100%">
    <tr>
        <td class="pageTitle">
            usuários
        </td>
        <td align="right">
            <a onclick="return false;" href="<?php echo site_url('administrador/usuario/cadastrar');?>" class="newButton" id="abreNovoUsuario">
                <div class="botaonovolistar">
                    <div class="botaonovoimg"></div>
                    <div class="botaonovolabel">novo usuário</div>
                </div>
            </a>
        </td>
    </tr>
</table>

<div style="padding: 5px 0px 5px 0px; height: 1px; width: 100%;"></div>

<table class="table" width="100%">
    <thead class="theadlistar">
        <tr>
            <th width="150">CPF</th>
            <th>Nome</th>
            <th width="100">Ações</th>
        </tr>
    </thead>
    <tbody class="tbodylistar">
    <?php if($usuarios->num_rows()>0){ foreach ($usuarios->result() as $value){ ?>
    
        <tr>
            <td align="center" class="listarCPF">
                <?php echo $value->usu_cpf;?>
            </td>
            <td>
                <?php echo $value->usu_nome;?>
            </td>
            <td>
                <div class="icone">
                    <a onclick="return false;" href="<?php echo site_url('administrador/usuario/editar/'.$value->usu_cpf);?>" id="ediUsuario" class="editar" title="Editar Usuário">
                        <img src="<?php echo base_url('/assets/img/editar.png');?>" width="25px" height="25px">
                    </a>
                    <a onclick="return false;" title="Excluir Usuário" class="linkExcluir" id="codigo_<?php echo $value->usu_cpf;?>">
                        <img src="<?php echo base_url('/assets/img/excluir.png');?>" width="25px" height="25px">
                    </a>
                </div>
            </td>
        </tr>
    <?php } } else{ ?>
        <tr>
            <td colspan="7" align="center">Nenhum registro encontrado. Por favor cadastre novos usuários.</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<input type="hidden" id="btExcluir" value="<?php echo site_url('administrador/usuario/excluir');?>">

</div>

