<script>
    function goTop() {
        $('body,html').animate({
            scrollTop: 86
        }, 800);
    }


    $(document).ready(function() {

        //$('#despachante').hide();

        $('.linkExcluir').click(function() {
            var clicado = $(this);
            apprise("<Strong>Tem certeza que deseja DESABIlItAR o Despachante?</Strong>", {
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
                        url: "<?php echo site_url('despachante/editarStatus/')?>",
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

                        },
                        error: function(xhr, ajaxOptions, thrownError) 
                        {
                            //alert('Usuario nao pode ser excluido');  
                            var w = window.open();
                            var html = '<b>Resposta do servidor</b><br><hr>' + xhr.responseText + '<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>' + thrownError;
                            $(w.document.body).html(html);
                            callback();
                        },
                    });
                }

            });


        });

        $('#abreNovoDespachante').click(function() {

            var link = $(this).attr('href');
            $('#despachante').load(link, function(response, status, xhr) {
                if (status === 'error') {
                    alert('Erro: ' + xhr.status + " " + xhr.statusText);
                } else {
                    goTop();
                    $(this).slideDown();
                }
            });

        });
        $('.editar').click(function() {

            var link = $(this).attr('href');
            $('#despachante').load(link, function(response, status, xhr) {
                if (status === 'error') {
                    alert('Erro: ' + xhr.status + " " + xhr.statusText);
                } else {
                    goTop();
                    $(this).slideDown();
                }
            });

        });

        $('.imprimir').click(function() 
        {

            var link = $(this).attr('href');
            // $('#despachante').load(link, function(response, status, xhr)
            open(link, function(response, status, xhr) 
            {
                if (status === 'error') {
                    alert('Erro: ' + xhr.status + " " + xhr.statusText);
                } else {
                    goTop();
                    $(this).slideDown();
                }
            });

        });


    }); // FIM DO DOCUMENT READ
</script>



<div class="novoEditarDiv" id="despachante"></div>


<table width="100%">
    <tr>
        <td class="pageTitle">
            despachante
        </td>
        <td align="right">
            <a onclick="return false;" href="<?php echo site_url('despachante/create');?>" class="newButton" id="abreNovoDespachante">
                <div class="botaonovolistar">
                    <div class="botaonovoimg"></div>
                    <div class="botaonovolabel">novo despachante</div>
                </div>
            </a>
        </td>
    </tr>
</table>
<div style="padding: 5px 0px 5px 0px; height: 1px; width: 100%;"></div>
<table width="100%" class="table">

    <thead class="theadlistar">
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th colspan="4">Ações</th>
        </tr>
    </thead>
    <tbody class="tbodylistar">

        <?php if($lista_despachante->num_rows()>0) { foreach ($lista_despachante->result() as $linha) { ?>

        <tr>
            <td>
                <?php echo $linha->des_codigo;?></td>
            <td>
                <?php echo $linha->des_nome;?></td>
            <td>
                <?php echo $linha->des_cpf;?></td>
            <td>
                <?php echo $linha->des_telefone;?></td>
            <td>
                <?php echo $linha->des_email;?></td>
            <td>
                <div class="icone">
                    <a title="Excluir Despachante" class="linkExcluir" id="codigo_<?php echo $linha->des_codigo;?>">
                        <img src="<?php echo base_url('/assets/img/excluir.png');?>" width="25px" height="25px">
                    </a>
                    <a onclick="return false;" href="<?php echo site_url('despachante/editar/'.$linha->des_codigo);?>" id="ediDespachante" class="editar" title="Editar Despachante">
                        <img src="<?php echo base_url('/assets/img/editar.png');?>" width="25px" height="25px">
                    </a>
                    <a onclick="return false;" class="imprimir" href="<?php echo ('imprimir/'.$linha->des_codigo);?>" title="Imprimir Despachante">
                        <img src="<?php echo base_url('/assets/img/impressora.png');?>" width="33px" height="33px">
                    </a>
                </div>
            </td>
        </tr>


        <?php } } else { echo "<tr><td colspan='7' align='center'>Nenhum registro encontrado. Por favor cadastre novos despachantes.</td></tr>"; } ?>
    </tbody>
</table>
</div>
</form>
</div>
<input type="hidden" id="btExcluir" value="<?php echo site_url('despachante/excluir');?>">
<input type="hidden" id="btListar" value="<?php echo site_url('despachante/listar');?>">


</section>

</div>

