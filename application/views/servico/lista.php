<script>
$(document).ready(function(){
     
    $('#gerar_kit').click(function(){
        if (!$(this).hasClass('activeNovoButton')) 
        {
            var link = $(this).attr('href');
            if ($(this).is(':visible')) 
            {
                $('#kit').slideUp(function(){
                    $('#kit').load(link, function(response, status, xhr){
                        if (status === 'error') 
                        {
                            alert('Erro: '+xhr.status+" "+xhr.statusText);
                        }
                        else
                        {
                            $(this).slideDown();
                            $('#gerar_kit').addClass('activeNovoButton');
                        }
                    });
                })
            } 
            else
            {
                $('#kit').load(link, function(response, status, xhr){
                    if (status === 'error') 
                    {
                        alert('Erro: '+xhr.status+" "+xhr.statusText);
                    }
                    else
                    {
                        $(this).slideDown();
                    }
                });
            };
        }

    });

});
</script>

<div id="gerarKitOpt"></div>

<div class="novoEditarDiv" id="kit"></div>

<table width="100%">
    <tr>
        <td class="pageTitle">
            kits
        </td>
        <td align="right">
            <a onclick="return false;" href="<?php echo site_url('administrador/servico');?>" class="newButton" id="gerar_kit">
                <div class="botaonovolistar">
                    <div class="botaonovoimg"></div>
                    <div class="botaonovolabel">gerar kit</div>
                </div>
            </a>
        </td>
    </tr>
</table>

<div style="padding: 5px 0px 5px 0px; height: 1px; width: 100%;"></div>

<table class="table" width="100%">
    <thead class="theadlistar">    
        <tr>
            <th>CHP</th>
            <th>Tipo</th>
            <th>Despachante</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody class="tbodylistar">
        <?php 
        if($listaServicos->num_rows()>0)
        {
            foreach ($listaServicos->result() as $value)
            { ?>
                <tr>
                    <td><?php echo $value->ser_chp;?></td>
                    <td align="center"><?php if($value->ser_tipo == 'c'){echo 'CNH';}else{echo 'Veículo';} ?></td>
                    <td><?php echo $value->des_nome;?></td>
                    <td align="center"><?php echo $value->ser_data;?></td>
                    <td align="center"><?php echo $value->ser_hora;?></td>
                    <td>R$ <?php echo $value->ser_valor;?></td>
                </tr>
            <?php }
        }
        ?>
    </tbody>
    <tfoot>
        <?php 
        if($total->num_rows()>0)
        {
            $row = $total->row();?>
            <tr>
                <td>Total de servicos</td>
                <td><?php echo $row->qtd;?></td>
                <td>Valor Total Dos Servicos</td>
                <td><?php echo $row->total;?></td>
            </tr>
        <?php 
        }
        ?>
   </tfoot>
</table>