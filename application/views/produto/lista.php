<script type="text/javascript">
    
  
    $(document).ready(function(){
     
        $('#abreNovoProduto').click(function(){
            if (!$(this).hasClass('activeNovoButton')) 
            {
                var link = $(this).attr('href');
                if ($(this).is(':visible')) 
                {
                    $('#produto').slideUp(function(){
                        $('#produto').load(link, function(response, status, xhr){
                            if (status === 'error') 
                            {
                                alert('Erro: '+xhr.status+" "+xhr.statusText);
                            }
                            else
                            {
                                //goTop();

                                $(this).slideDown();
                                $('#abreNovoProduto').addClass('activeNovoButton');
                            }
                        });
                    })
                } 
                else
                {
                    $('#produto').load(link, function(response, status, xhr){
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

         $('.linkExcluir').click(function() {
            var clicado = $(this);
            apprise("<Strong>Tem certeza que deseja EXCLUIR o produto?</Strong>", {
                'animate': true,
                'verify': true
                }, 
                function(e) 
                {
                if (e) 
                    {
                    var codigo = clicado.attr("id").split('_')[1];
                    //alert(codigo);
                    $.ajax({
                        url: "<?php echo site_url('administrador/produto/excluir')?>",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'codigo': codigo
                              },
                        success: function(res) 
                        {

                            //console.log('res: '+res);
                            if (res == 1) {
                                var n = noty({
                                    layout: 'top',
                                    type: 'success',
                                    timeout: 2000,
                                    text: '<b><br>Excluido com Sucesso</b>',
                                    callback: {
                                        afterClose: function() {
                                            window.location.reload();
                                        }
                                    }
                                });

                            }
                            else
                            {
                                  var n = noty({
                                    layout: 'top',
                                    type: 'error',
                                    timeout: 2000,
                                    text: '<b><br>Erro na exclusao!</b>',
                                    callback: {
                                        afterClose: function() {
                                            window.location.reload();
                                        }
                                    }
                                });
                            }

                        },
                        error: function(xhr, ajaxOptions, thrownError) 
                        {
                            //alert('Usuario nao pode ser excluido');  
                            /*var w = window.open();
                            var html = '<b>Resposta do servidor</b><br><hr>' + xhr.responseText + '<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>' + thrownError;
                            $(w.document.body).html(html);
                            callback();*/
                             var n = noty({
                                    layout: 'top',
                                    type: 'error',
                                    timeout: 2000,
                                    text: '<b><br>O Item nao pode ser Excluido!</b>',
                                    callback: {
                                        afterClose: function() {
                                            window.location.reload();
                                        }
                                    }
                                });

                        },
                    });
                }

            });


        });//fim do excluir




      $('.editar').click(function(){
                $('#abreNovoProduto').removeClass('activeNovoButton');
                var link = $(this).attr('href');
                if ($(this).is(':visible')) 
                {
                    $('#produto').slideUp(function(){
                        $('#produto').load(link, function(response, status, xhr){
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
                    $('#produto').load(link, function(response, status, xhr){
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

<div class="novoEditarDiv" id="produto"></div>

<table width="100%">
    <tr>
        <td class="pageTitle">
            produtos
        </td>
        <td align="right">
            <a onclick="return false;" href="<?php echo site_url('administrador/produto/cadastrar');?>" class="newButton" id="abreNovoProduto">
                <div class="botaonovolistar">
                    <div class="botaonovoimg"></div>
                    <div class="botaonovolabel">novo produto</div>
                </div>
            </a>
        </td>
    </tr>
</table>

<div style="padding: 5px 0px 5px 0px; height: 1px; width: 100%;"></div>

<table class="table" width="100%">
    <thead class="theadlistar">
        <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Valor Unitário</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody class="tbodylistar">
    <?php if($produtos->num_rows()>0){ foreach ($produtos->result() as $value){ ?>
    
        <tr>
            <td width="100" align="center">
                <?php echo $value->pro_codigo;?>
            </td>
            <td>
                <?php echo $value->pro_descricao;?>
            </td>
            <td width="140" align="center">
                <?php echo 'R$ '.$value->pro_valor_unitario;?>
            </td>
            <td width="100">
                <div class="icone">
                    <a onclick="return false;" href="<?php echo site_url('administrador/produto/editar/'.$value->pro_codigo);?>" id="ediDespachante" class="editar" title="Editar Produto">
                        <img src="<?php echo base_url('/assets/img/editar.png');?>" width="25px" height="25px">
                    </a>
                    <a onclick="return false;" title="Excluir Produto" class="linkExcluir" id="codigo_<?php echo $value->pro_codigo;?>">
                        <img src="<?php echo base_url('/assets/img/excluir.png');?>" width="25px" height="25px">
                    </a>
                </div>
            </td>
        </tr>
    <?php } } else{ ?>
        <tr>
            <td colspan="4" align="center">Nenhum registro encontrado. Por favor cadastre novos produtos.</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<input type="hidden" id="btExcluir" value="<?php echo site_url('administrador/produto/excluir');?>">

</div>

