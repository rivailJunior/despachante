<!DOCTYPE html>

<script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.datepicker.js'); ?>"></script>

<style type="text/css">

@media print{
    div#listar{
        margin: auto;
        margin-top: 10px;
        -webkit-print-margin-adjust:exact;
    }
    td.oi2{
        display:none;
        -webkit-print-display-adjust:exact;
    }
    div#divBtimprimir{
        display:none;
        -webkit-print-display-adjust:exact;
    }
    div.divTopo{
        display:none;
        -webkit-print-display-adjust:exact;
    }
    div#top, #thProdutos, .openBody{
        display:none;
        -webkit-print-display-adjust:exact;
    }
    div#tituloPagina{
       display:block;
        -webkit-print-display-adjust:exact; 
        text-align: center;
    }
    span#total,#totalIten{
    	margin-left: 5px;
    }
       
}

span#total,#totalIten{
	margin-left: 5px;
}

</style>


<script>
        function enviaFormulario()
        {
          
          var data =  $("#datepicker").val();
          var data2 =  $("#to").val();
          var matricula =  $("#mat_despachante").val();
          var codigo =  $("#codigo_venda").val();
          var select = $("#selectFiltros").val();
          //alert("ate "+data2+ "de" +data+ "mat" +matricula+ "codigo" +codigo);
          $.ajax({
            type:'POST',
            url:"<?php echo site_url('administrador/venda/relatorio_kit_filtros')?>",
            dataType:'HTML',
            data:{
                'de':data,
                'ate':data2,
                'matricula':matricula,
                'codigo':codigo,
                'sel':select
            },
            
            success: function(res)
            {
                
                //alert(res);
                $("#tableRelatorio").html(res);
                
            },
            error: function(res)
            {
                console.log("erro: "+res);
                //alert(JSON.stringfy(res));
            }

          });
        }

    $(document).ready(function() {

        $("#mat_despachante").mask("999");
        $("#codigo_venda").mask("999999");

        $("datepicker").datepicker({dateFormat: 'yy-mm-dd'});


        $(function() {
            $("#datepicker").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: 'yy-mm-dd'

            });
            $("#to").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: 'yy-mm-dd'

            });
        });//fim do date
                
         $("#tdvenda").hide();
         $("#tdmatricula").hide();
         $("#selectFiltros").show();
         $("#selectFiltros").change( function(){
                
            if($(this).val()=="1")
            {
                $("#tdvenda").show("blind");
                $("#codigo_venda").focus();
                $("#tdmatricula").hide();
                $("#data_inicial").hide("blind");
                $("#data_final").hide("blind");
                $("#datepicker").val("");
                $("#to").val("");
            }
            else if($(this).val()=="2")
            {   
                $("#data_inicial").show();
                $("#data_final").show();
                $("#tdmatricula").show("blind");
                $("#mat_despachante").focus();
                $("#tdvenda").hide();
                $("#datepicker").val("");
                $("#to").val("");
                
            }
            else
            {
                $("#tdvenda").hide("blind");
                $("#tdmatricula").hide("blind");
                $("#data_inicial").show("blind");
                $("#data_final").show("blind"); 
                $("#datepicker").val("");
                $("#to").val(""); 
            }
        });


        $("#to").change( function(){
            
            enviaFormulario();
        });

        $("#codigo_venda").keyup(function(){
            
            enviaFormulario();
        });
     
        $('#tableRelatorio').on('click','.verProdutos', function(){
            var tr = $(this).parents('tr');
            var codVenda = $(this).attr('id').split('-')[1];
            var trIndex = tr.index();
            //$('<tr><td colspan="8">'+codVenda+'</td></tr>').insertAfter($('.tbodylistar').find('tr').eq(trIndex));
            
            
            if($(tr).hasClass("open"))
            {
                var i = trIndex + 1;
                $('#tableRelatorio tbody tr:eq('+i+')').remove();
                // remover tr dos produtos
                $(tr).removeClass("open");
            }
            else
            {
                $('#tableRelatorio tbody tr').removeClass("open");
                $('#tableRelatorio tbody tr.openBody').remove();
                $.ajax({
                    type:'POST',
                    dataType:'HTML',
                    url:"<?php echo site_url('administrador/venda/lista_produtos_venda/');?>",
                    data:
                    {
                        'codigo':codVenda
                    },
                    success: function(res)
                    {
                       $(tr).addClass("open");
                        //alert(res);
                        //$("#produtos").html(res).insertAfter(".oi").find('tr').eq(trIndex);
                        //$('#tableRelatorio tbody').find('tr').eq(trIndex).insertAfter("<tr><td colspan='8'>teste</td></tr>");
                      $(res).insertAfter($('#tableRelatorio tbody tr.open'));
                      //$("tableRelatorio tbody tr.oi open").css("background-color","red");
                      //$(res).insertAfter($('#tableRelatorio tbody').toggle());
                       
                    },
                    error: function(res)
                    {
                        console.log("erro: "+res);
                    }
                });
                
            }
        });

    $("#btImprimir").click(function(){
    var myDropDown = document.getElementById('listar');
    window.title="bla bla";
    //Whatever other elements to hide.
    window.print();
    myDropDown.style.display = "block";
    return true;
    });    

 
   });//fim do document

	
</script>
<?php 
	if(isset($valor_mes_atual))
	{
	 $val_mes = $valor_mes_atual->valor_total_venda;
	}
	$qtdVendas = 0;
	$qtdProdutosVendidos=0;
	foreach ($relatoriovenda->result() as $value) 
	{      
	   $qtdVendas ++;
	   $qtdProdutosVendidos +=$value->itv_quantidade;
	}
?>
 
    <div hidden id="tituloPagina" >
        <span class="pageTitle">Relatorio de Vendas <hr></span>
    </div>

    <div id="relServWrapper" class="divTopo">
   
        <table id="relatorio_vendas" width="100%">  
        		        
                 <tr>
                <td align="left" class="pageTitle">Vendas</td>
                  <td>
                        <select id="selectFiltros" name="selectFiltros" class="select">
                            <option>Pesquisar</option>
                            <option value="1">Codigo Venda</option>
                            <option value="2">Matricula Despachante</option>
                        </select>
                    </td>
                    
                    <form id="FormListar" >
                   
                    <td id="tdvenda"  align="rigth" class="titleMain">
                        <input class="input" type="text" name="codigo" id="codigo_venda" value="<?php echo set_value('codigo'); ?>">
                   </td>
                   
                    <td id="tdmatricula"  align="rigth" class="titleMain">
                        <input  class="input" placeholder="Matricula" type="text" name="matricula" value="<?php echo set_value('matricula'); ?>" id="mat_despachante" >
                    </td>

                    <td id="data_inicial" align="rigth">
                        <input  class="input" placeholder="Data Inicial" type="text" name="data" value="<?php echo set_value('data'); ?>" id="datepicker" >
                    </td>
                    <td id="data_final" align="rigth"class="titleMain" >
                        <input class="input" placeholder="Data Final"  type="text"  name="data2" value="<?php echo set_value('data2'); ?>" id="to" >
                    </td>
                   <td align="rigth" class="titleMain">
                   <input class="formButton submit"  type="hidden" name="btListar" id="btListar" value="listar">
                   </td>
                    </form>
                </tr>
        </table>
    </div>

<div id="listar">

    <table class="tableRelatorio" id="tableRelatorio" >   
       		 
        <thead class="theadlistar">
		<tr>
			<td id="valor_vendas"  colspan="10">
				<span class="pageTitle">Qtd Vendas: </span>
				<span style=" font-size:40px; color:black; "><?php echo $qtdVendas;?></span>
				<span id="totalIten" id="total" class="pageTitle">Total Itens: </span>
				<span style=" font-size:40px; color:black; "><?php echo $qtdProdutosVendidos;?></span>
				<span id="total" class="pageTitle">Total R$: </span>
				<span style=" font-size:40px; color:black; "><?php echo $val_mes;?></span>
			</td>
			
	</tr>  
            <tr>
            
                <th width="40" class="titleMain">CODIGO VENDA</th>
                <th width="40" class="titleMain">MATRICULA</th>
                <th width="40" class="titleMain">DATA</th>
                <th width="40" class="titleMain">HORA</th>
                <th width="40" class="titleMain">QTD ITENS</th>
                <th width="40" class="titleMain">QTD PRODUTOS</th>
                <th width="40" class="titleMain">VALOR</th>
                <th width="40" class="titleMain">PAGO</th>
                <th width="40" class="titleMain">TROCO</th>
                <th id="thProdutos" width="10" class="titleMain" colspan="2">OPCOES</th>
            
            </tr>
                        </thead>    
    <tbody class="tbodylistar" align="center">
                <?php
                if (isset($relatoriovenda)) {
                    if ($relatoriovenda->num_rows > 0) {
                        foreach ($relatoriovenda->result() as $value) {
                            ?>
                            <tr class="oi">
                                <td><?php echo $value->ven_codigo; ?></td>
                                <td><?php echo $value->des_matricula; ?></td>
                                <td><?php echo $value->ven_data; ?></td>
                                <td><?php echo $value->ven_hora; ?></td>
                                <td><?php echo $value->itv_quantidade; ?></td>
                                <td><?php echo $value->total_produtos; ?></td>
                                <td><?php echo $value->ven_valor; ?></td>
                                <td><?php echo $value->ven_valor_entregue; ?></td>
                                <td><?php echo $value->ven_troco; ?></td>
                                <td class="oi2" width="10" ><a class="verProdutos" id="verProd-<?php echo $value->ven_codigo;?>"><img src="<?php echo base_url('/assets/img/pesquisar.png');?>" width="33px" height="33px"></a></td>
                           		 <td width="10"><a href="<?php echo site_url('administrador/venda/recibo_venda_2via/'.$value->ven_codigo);?>" class="imprimeRecibo"><img src="<?php echo base_url('/assets/img/impressora.png');?>" width="33px" height="33px"></a></td> 
                            </tr>

                        <?php
                    }
                }
            } else {
                echo "<td align='CENTER' colspan='10'><span>Nenhum Ficheiro Encontrado</span></td>";
            }
            ?>          
                    <tr id="produtos"></tr>
                                
            </tbody> 
    </table>

</div>
<div id="divBtimprimir">
    <input type="button"  value="Imprimir" class="formButton submit" id="btImprimir">
</div>