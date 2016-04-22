<script>
$(document).ready(function (){
   //alert('exclusao de veiculos haha');
   
        $(document).on('click','.LinkExcluir',function(e){
        
        var link = $("#btExcluir").val();
        var listar =$("#btListar").val();
        var codigo = $(this).attr("id").split('_')[1];
      
      $.ajax({
        url: link,
        type: 'POST',
        dataType: 'json',
        data: {
            'codigo': codigo
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
</script>
<section>
        <form action="#/Despachante_system/index.php/despachante/create" method="post">
            <div>

                <table width="100%" class="tablelistar">
                    <caption class="captionlistar">Listar Veiculos</caption>
                    <thead class="theadlistar">
                    <tr>
                        <th>Outorgante</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th colspan="2">Acoes</th>
                    </tr>
                   </thead>
                    <?php 
            if($listando_veiculos->num_rows()>0)
                {
                foreach ($listando_veiculos->result() as $linha) {

?>
                <tbody class="tbodylistar">
                        <tr>
                            <td><?php  echo $linha->out_nome;?></td>
                            <td><?php  echo $linha->vei_placa;?></td>
                            <td><?php  echo $linha->vei_marca;?></td>
                            <td><?php  echo $linha->var_modelo;?></td>
                            <td><?php  echo $linha->vei_ano;?></td>
                            <td>
                        <div id="icone">
                        <a  href="#" title="Editar Despachante" onclick="return false">
                        <img src="<?php echo base_url('/assets/img/editar.png');?>" width="25px" height="25px">
                        </a>-
                    <a href="#" title="Excluir Despachante" id="placaVeiculo_<?php echo $linha->vei_placa;?>" class="LinkExcluir">
                         <img src="<?php echo base_url('/assets/img/fechar.png');?>" width="25px" height="25px">
                        </a>
                    </div>
                    </td>
                        </tr>
                </tbody>
                    <?php 
                                                    }

    }else{
        echo "Nada Encontrado";
    }
                    ?>
                </table>
                <input type="hidden" value="<?php echo site_url('administrador/veiculo/delete');?>" id="btExcluir">
                
            </div> 
        </form>
        <div id="listarNovo">
            
        </div>
</section>

