<script type="text/javascript">

    $(document).on('click','.excluir',function(e){
        var link = $("#btExcluir").val();
       
        var codigo = $(this).attr("id").split('_')[1];;
        $.ajax({
            url:link,
            type:'POST',
            dataType:'json',
            data:{
                'codigo':codigo
            },
            success: function(res) 
            {
                console.log('res: '+res);
                if(res==1){
                    alert('Outorgante excluido com sucesso');
                    window.location.reload();
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
        
    });
    
    $(document).ready(function(){

        $('#newButton').click(function(){
            if (!$(this).hasClass('activeNovoButton')) 
            {
                var link = $(this).attr('href');
                if ($(this).is(':visible')) 
                {
                    $('#outorgante').slideUp(function(){
                        $('#outorgante').load(link, function(response, status, xhr){
                            if (status === 'error') 
                            {
                                alert('Erro: '+xhr.status+" "+xhr.statusText);
                            }
                            else
                            {
                                //goTop();

                                $(this).slideDown();
                                $('#newButton').addClass('activeNovoButton');
                            }
                        });
                    })
                } 
                else
                {
                    $('#outorgante').load(link, function(response, status, xhr){
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
            $('#newButton').removeClass('activeNovoButton');
            var link = $(this).attr('href');
            if ($(this).is(':visible')) 
            {
                $('#outorgante').slideUp(function(){
                    $('#outorgante').load(link, function(response, status, xhr){
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
                $('#outorgante').load(link, function(response, status, xhr){
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

<div class="novoEditarDiv" id="outorgante"></div>

<table width="100%">
    <tr>
        <td class="pageTitle">
            outorgantes
        </td>
        <td align="right">
            <a onclick="return false;" href="<?php echo site_url('administrador/outorgante/novo');?>" class="newButton" id="newButton">
                <div class="botaonovolistar">
                    <div class="botaonovoimg"></div>
                    <div class="botaonovolabel">novo outorgante</div>
                </div>
            </a>
        </td>
    </tr>
</table>

<div style="padding: 5px 0px 5px 0px; height: 1px; width: 100%;"></div>

<table class="table" width="100%">
    <thead class="theadlistar">
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>RG</th>
            <th>E-mail</th>
            <th>Celular</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody class="tbodylistar">
    <?php if($lista_outorgante->num_rows()>0) { foreach ($lista_outorgante->result()as $linha) { ?>
        <tr>
            <td>
                <?php echo $linha->out_nome;?></td>
            <td>
                <?php echo $linha->out_cpf_cnpj;?></td>
            <td>
                <?php echo $linha->out_rg;?></td>
            <td>
                <?php echo $linha->out_email;?></td>
            <td>
                <?php echo $linha->out_celular;?></td>
            <td>
                <div class="icone">
                    <a onclick="return false;" class="editar" href="<?php echo site_url('administrador/outorgante/editar/'.$linha->out_cpf_cnpj);?>" title="Editar Outorgante">
                        <img src="<?php echo base_url('/assets/img/editar.png');?>" width="25px" height="25px">
                    </a>
                    <a onclick="return false;" class="excluir" id="codigo_<?php echo $linha->out_cpf_cnpj;?>" title="Excluir Outorgante">
                        <img src="<?php echo base_url('/assets/img/excluir.png');?>" width="25px" height="25px">
                    </a>
                </div>
            </td>
        </tr>
    <?php } }else{ ?>
        <tr>
            <td colspan="6" align="center">Nenhum registro encontrado. Por favor cadastre novos outorgantes.</td>
        </tr>
    <?php    } ?>
    </tbody>
</table>
<input type="hidden" id="btExcluir" value="<?php echo site_url('administrador/outorgante/excluir');?>">


