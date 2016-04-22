<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/apprise.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/selectize.default.css')?>" />

<script src="<?php echo base_url('/assets/apprise-1.5.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/selectize.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/jquery.noty.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/top.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/inline.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/topCenter.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/noty/default.js')?>" type="text/javascript"></script>

<script>

    var venda = new Array();                    //array com todos os itens da venda
    var totalVenda = new Array(0, 0.00);  //array com os totais da venda (quantidade de itens, valor total, codigo Despachante)
    var vendaDesp = new Array(); // 0 codigo, 1 nome, 2 CRDD
    var pendingItemData = new Array();  
    var detalhesPagamento =
    {
        'entregue' : 0.00,
        'troco' : 0.00,
        'tipoPag' : 0
    }

    function printableCupom(dados)
    {
        //var numeroDANFE = dados['venda_danfeNumero'];
        //var serieDANFE = dados['venda_danfeSerie'];
        //var chave = dados['chave'];
        //var data = dados['data'];
        //var hora = dados['hora'];
        //var hora = dados['tipodoc'];


        // venda[0] = codigo
        // venda[1] = descricao
        // venda[2] = quantidade
        // venda[3] = preco item
        // venda[4] = preco total item
        var now = new Date();
        
        var m = now.getMinutes(); 
        var h = now.getHours();
        var s = now.getSeconds();

        var dd = now.getDate();
        var mm = now.getMonth()+1;
        var yyyy = now.getFullYear();

        if(m<10){m='0'+m} if(s<10){s='0'+s}
        var time = h+':'+m+':'+s;
        if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} 
        var data = dd+'/'+mm+'/'+yyyy;

        var emissao = "Emissão: "+data+" "+time;

        $('#tablecupomprint > thead').find('tr td #emissaoRecibo').html(emissao);

        var result = '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
        for (var i = 0; i < venda.length; i++) {
            result += '<div style="display:block; width: 100%;">';
            result += '<span style="float:left; width: 20%; text-align: left;">- '+venda[i][0]+'</span>';
            result += '<span style="float:left; width: 80%; text-align: right;">'+venda[i][1]+'</span>';
            result += '</div>';

            result += '<div style="display:block; width: 100%;">';
            result += '<span style="float:left; width: 25%;">'+venda[i][2]+' UN</span>';                    //qtd
            result += '<span style="float:left; width: 30%;">'+venda[i][3]+'</span>';                       //preco unitario
            result += '<span style="float:left; width: 5%;">0.00</span>';                                   //desconto
            result += '<span style="float:left; width: 40%; text-align: right;">'+venda[i][4]+'</span>';    //total do item
            result += '</div>';
        };
        result += '</div>';
        $('#tablecupomprint > tbody').find('#cupomDetalheVenda td').html(result);


        //detalhesPagamento['desconto']
        //totalVenda[0] - qtd itens
        //totalVenda[1] - subtotal
        //totalVenda[2] - total
        var result2 = '';

        result2 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
        result2 += '<span style="float:left; width: 65%; text-align: left; font-weight: bold;">QTD. ITENS</span>';
        result2 += '<span style="float:left; width: 35%; text-align: right;">'+totalVenda[0]+'</span>';
        result2 += '</div>';

        result2 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
        result2 += '<span style="float:left; width: 65%; text-align: left; font-weight: bold;">VALOR TOTAL(R$)</span>';
        result2 += '<span style="float:left; width: 35%; text-align: right;">'+totalVenda[1]+'</span>';
        result2 += '</div>';

        result2 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
        result2 += '<span style="width: 60%; float:left; text-align: left; font-weight: bold;">PAGAMENTO</span>';
        result2 += '<span style="width: 40%; float:left; text-align: right;">'+detalhesPagamento['entregue']+'</span>';
        result2 += '</div>';

        if(detalhesPagamento['tipoPag'] == 0)
        {
            var formaPag = 'DINHEIRO';
        }
        else if(detalhesPagamento['tipoPag'] == 1)
        {
            var formaPag = 'CARTÂO';
        }
        else if(detalhesPagamento['tipoPag'] == 2)
        {
            var formaPag = 'DÉBITO';
        }

        result2 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
        result2 += '<span style="width: 60%; float:left; text-align: left; font-weight: bold;">FORMA PAGAMENTO</span>';
        result2 += '<span style="width: 40%; float:left; text-align: right;">'+formaPag+'</span>';
        result2 += '</div>';

        result2 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
        result2 += '<span style="float:left; width: 65%; text-align: left; font-weight: bold;">TROCO(R$)</span>';
        result2 += '<span style="float:left; width: 35%; text-align: right;">'+detalhesPagamento['troco']+'</span>';
        result2 += '</div>';

        
        
        //var pagamento = new Array();                // { codTipoPag, valor, entrada(0,1) }
        //var parcelas = new Array();                 // { codTipoPag, numParcelas, valorParcelas }

        $('#tablecupomprint > tbody').find('#cupomTotaisVenda td').html(result2);

        result4 = '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 7pt; text-align:center; border-bottom: 1px solid black;">RECIBO N° '+dados+'</div>';

        result4 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt; text-align:center; font-weight:bold; border-bottom: 1px dashed black;">DESPACHANTE</div>';
        
        if (vendaDesp.length > 0) 
        {
            result4 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt; text-align:center;">MATRICULA CRDD: '+vendaDesp[2]+'</div>';
            result4 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt; text-align:center;">NOME: '+vendaDesp[1]+'</div>';
        } 
        else
        {
            result4 += '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt; text-align:center;">NÃO IDENTIFICADO</div>';
        };
        
        $('#tablecupomprint > tbody').find('#cupomConsumidor td').html(result4);

        result5 = '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 5.60pt; text-align:center;">Emitido por: ADAPT Despachante<br><b>AdaptData - (92) 3308-4840</b></div>';

        $('#tablecupomprint > tfoot').find('#cupomFooter td').html(result5);
    }
    
    function finalizarCompra()//abre a caixa modal para receber o valor entregue e calc o troco
    {
        if(venda.length > 0)
        {
            $('#pagTotalValue').text('R$ '+totalVenda[1]);
            //vendaDesp
            if (vendaDesp[1] === undefined) 
            {
                $('#pagDespachante').val('Não informado');
            } 
            else
            {
                $('#pagDespachante').val(vendaDesp[1]);
            };
            

            $("#caixaModal").addClass("visibleModal");
            $("#pagamento").addClass("mostrar");
            $('#valor_entregue').focus();
        }
        else
        {
            alert("Nao existem itens na venda");
            focusSearch();
        }
    }//fim do finalizar compra
    
    function cancelarPagamento()
    {
        $('#caixaModal').removeClass('visibleModal');
        $('#pagamento').removeClass('mostrar');
        focusSearch();
    }
   
    function cancelarCompra()//cancela a compra inteira
    {
        if (totalVenda[0] > 0) 
        {
            apprise('Esta ação irá remover todos os produtos da compra atual assim como todos os pagamentos registrados.<br>Tem a certeza que deseja cancelar toda a compra atual?', 
                {'verify':true, 'textYes':'Sim (Enter)', 'textNo':'Não (Esc)', 'animate':'true'},
                function(r) {
                    if(r) { 
                        while (venda.length > 0) {
                            venda.pop();
                        }
                        
                        totalVenda[0] = 0;
                        totalVenda[1] = 0.00;

                        while (vendaDesp.length > 0) {
                            vendaDesp.pop();
                        }
                        
                        detalhesPagamento['entregue'] = 0.00;
                        detalhesPagamento['troco'] = 0.00;
                        detalhesPagamento['tipoPag'] = 0;
                        
                        //limparPagVista();
                        //limparPagParcelado();

                        $('#tbCupom').find('tbody').html("");

                        $('#qtd').val('1');
                        $('#qtdItens').text('0');
                        $('#totalCompra').text('0.00');
                         focusSearch();
                    }
                    
                }
            );
            focusSearch();
        } 
        focusSearch();
    }//fim do cancelarcompra()
    
    function updateList()//atualiza apos remocao ou adicao de produtos na compra
    {
        var novaQtdItens = 0;
        var novoTotalPedido = 0.00;

        if (venda.length == 0) 
        {
            novaQtdItens = 0;
            novoTotalPedido = parseFloat(0).toFixed(2);
        } 
        else
        {
            for(var i = 0; i < venda.length; i++) 
            {
                var indice = i+1;
                // venda[i][0] = codigo
                // venda[i][1] = descricao
                // venda[i][2] = quantidade
                // venda[i][3] = preco item
                // venda[i][4] = preco total item

                var bg;
                if (indice%2 == 0){
                    bg = "background-color: #92CC92;"; //par
                }
                else{
                    bg = "background-color: #AEF2AE;"; //impar
                }

                $('#tbCupom').find('tbody')
                .append($('<tr>')
                    .append($('<td>')
                        .attr({
                            align: 'right',
                            style: 'width: 30px; padding: 2px 5px 2px 0px; '+bg+' color: #545454; text-shadow: 0px 0px 0.1em grey;'
                        })
                        .append(indice)
                    )
                    .append($('<td>')
                        .attr({
                            align: 'left',
                            style: 'width: 500px; '+bg+' padding: 2px 0px 2px 0px;'
                            
                        })
                        .append(venda[i][3]+" x "+venda[i][2]+" "+venda[i][1])
                    )
                    .append($('<td>')
                        .attr({
                            align: 'left',
                            style: 'width: 100px; '+bg+' padding: 2px 0px 2px 0px;'
                        })
                        .append('R$ '+venda[i][4])
                    ).append($('<td>')
                        .attr({
                            align: 'left',
                            style: 'width: 30px; '+bg+' padding: 2px 0px 2px 0px;'
                        })
                        .append("<input type='button' onclick='cancelarItem("+indice+");' value='X' class='excluiritem'>")
                    )
                )

               // $("#divCupom").mCustomScrollbar("scrollTo","bottom");

                novaQtdItens = novaQtdItens + parseInt(venda[i][2]);
                novoTotalPedido = novoTotalPedido + parseFloat(venda[i][4]);

                //updateTotalVenda(venda[i][4], venda[i][2]);
            };
        };

        totalVenda[0] = parseInt(novaQtdItens);
        totalVenda[1] = parseFloat(novoTotalPedido).toFixed(2);

        $('#qtdItens').text(totalVenda[0]);
       
        $('#totalCompra').text(totalVenda[1]);
    }//fim do updatetolist
    
    
    function cancelarItem(item)//cancela o item selecionado
    {
        //var input = $('#itemACancelar');
        //var item = input.val();
        var pos = item - 1;
        venda.splice(pos, 1);
        $('#tbCupom').find('tbody').html("");
        updateList();
        focusSearch();
            
    }//fim do cancelaritem()
    
    function updateTotalVenda(valorUltimoItem, qtdUltimoItem)//atualiza o valor, apos remover ou adicionar novos produtos
    {
        /* ATUALIZAR ARRAY DOS TOTAIS E MOSTRAR NA VIEW */
        var currentQtdTotal = parseInt(totalVenda[0]);
        var lastQtdItem = parseInt(qtdUltimoItem);
        var newQtdTotal = currentQtdTotal + lastQtdItem;

        totalVenda[0] = newQtdTotal;

        var lastItem = parseFloat(valorUltimoItem);
        var currentTotal = parseFloat(totalVenda[1]);
        var newTotal = currentTotal + lastItem;
        totalVenda[1] = parseFloat(newTotal).toFixed(2);

        $('#qtdItens').text(totalVenda[0]);
     
        $('#totalCompra').text(totalVenda[1]);
        
    }//fim do updatetotalvenda
    
    function adicionarItem(codigo,descricao,precoUn)//adiciona os itens 
    {
        var qtd = $('#qtd').val();
        //var precoUn = parseFloat($('#valUnit').text()).toFixed(2);
        var total = parseFloat(qtd * precoUn).toFixed(2);

        saveToArray(codigo, descricao, qtd, precoUn, total);
        arrayToList();
        focusSearch();
        $('#qtd').removeClass('focused');
        $('#addItem').addClass('disabled');
    }//fim do acicionaritem
    
    function getStockProduto(codProduto)//verifica se ha produto disponivel no estoque
    {
        var stock;
        
        jQuery.ajax({
            async: false,
            url: "<?php echo site_url('administrador/produto/getStockProduto');?>",
            dataType: 'html',
            type: 'post',
            data:{
                'produto':codProduto
            },
            success: function(resposta){
                stock = resposta;  
            },
            error: function(xhr, ajaxOptions, thrownError){
                var w = window.open();
                var html = '<b>get stok Resposta do servidor</b><br><hr>'+xhr.responseText+'<br><br><b>Erro</b><br><hr>'+thrownError;
                $(w.document.body).html(html);
            }
        });
        return stock;
    }//fim do getstokproduto

    function saveToArray(cod, desc, qtd, preco, total)//salva os itens no array venda
    {
        var newItem = new Array(cod, desc, qtd, preco, total);
        venda.push(newItem);        
    }//fim do savetoarray()

    
    function arrayToList()//lista os itens selecionados 
    {
        var lastVenda = venda[venda.length - 1];
        // lastVenda[0] = codigo
        // lastVenda[1] = descricao
        // lastVenda[2] = quantidade
        // lastVenda[3] = preco item
        // lastVenda[4] = preco total item
        
        var bg;
        if (venda.length%2 == 0)
        {
            bg = "background-color: #92CC92;"; //par
        }
        else
        {
            bg = "background-color: #AEF2AE;"; //impar
        }

        $('#tbCupom').find('tbody')
        .append($('<tr>')
            .append($('<td>')
                .attr({
                    align: 'right',
                    style: 'width: 30px; padding: 2px 5px 2px 0px; '+bg+' color: #545454; text-shadow: 0px 0px 0.1em grey;'
                })
                .append(venda.length)
            )
            .append($('<td>')
                .attr({
                    align: 'left',
                    style: 'width: 500px; '+bg+' padding: 2px 0px 2px 0px;'
                    
                })
                .append(lastVenda[3]+" x "+lastVenda[2]+" "+lastVenda[1])
            )
            .append($('<td>')
                .attr({
                    align: 'left',
                    style: 'width: 100px; '+bg+' padding: 2px 0px 2px 0px;'
                })
                .append("R$ "+lastVenda[4])
            ).append($('<td>')
                .attr({
                    align: 'left',
                    style: 'width: 30px; '+bg+' padding: 2px 0px 2px 0px;'
                })
                .append("<input type='button' onclick='cancelarItem("+venda.length+");' value='X' class='excluiritem'>")
            )
        )
        
        //$("#divCupom").mCustomScrollbar("scrollTo","bottom");

        updateTotalVenda(lastVenda[4], lastVenda[2]);
        return false;

    }//fim do arraytolist()
                
    function salvarVenda()
    {
       // alert('salvar venda');
        // userData = array(codPessoa Caixa)
        // venda = 
        // totalVenda = array com os totais da venda (quantidade de itens, valor subtotal, valor total)
        // pagamento = { codTipoPag, valor, entrada(0,1) }
        // parcelas = { codTipoPag, numParcelas, valorParcelas }
        // detalhesPagamento = ['modo'] ['entregue'] ['troco'] ['desconto']
        // cliente = codPessoa Cliente
        // ramo = varejo/atacado

        detalhesPagamento['tipoPag'] = $('#selectDespTipoPag').val();

        //var link = $('#saveVenda').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('administrador/venda/salvarvenda');?>",
            dataType: "json",
            data: {
                //'userdata'          : JSON.stringify(userData),
                'venda'             : JSON.stringify(venda),
                'totalVenda'        : JSON.stringify(totalVenda),
                'pagamento'         : JSON.stringify(detalhesPagamento),
                'despachante'       : JSON.stringify(vendaDesp)
            },
            success: function (response) {
                console.log(JSON.stringify(response));
                if (response == 0) 
                {
                    var n = noty({
                        layout: 'top',
                        type: 'error',
                        timeout: 3000,
                        text: '<b>Erro!</b><br>Erro ao cadastrar a venda. Por favor contate o administrador.'
                    });                            
                } 
                else
                {
                    //alert('despachante length: '+vendaDesp.length);
                    printableCupom(response);

                    var w=window.open('','','');
                    w.document.write($('#cupom4print').html());
                    w.print();
                    w.close();

                    var n = noty({
                        layout: 'top',
                        type: 'success',
                        timeout: 3000,
                        text: '<b>Sucesso!</b><br>Venda cadastrada com sucesso.',
                        callback: {
                            afterClose: function() 
                            {
                                $('#caixaModal').removeClass('visibleModal');
                                $('#pagamento').removeClass('mostrar');
                                location.reload();
                            }
                        }
                    });
                    
                    // response:
                    // ['chave'], ['venda_danfeSerie'], ['venda_danfeNumero'], ['data'], ['hora'], ['codVenda']
                   

/*
                    printableCupom(response);

                    var w=window.open('','','');
                    w.document.write($('#cupom4print').html());
                    w.print();
                    w.close();

                    //novaCompra(0);
                    location.reload();
*/
                    
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var w = window.open();
                var html = xhr.responseText;
                $(w.document.body).html(html);
            }
        });
        
    };

    function focusSearch()
    {
        $('#qtd').val('1');
        selectProd[0].selectize.enable(); 
        selectProd[0].selectize.clear();
        selectProd[0].selectize.focus();
    }

    function focusDesp()
    {
        selectDesp[0].selectize.enable(); 
        selectDesp[0].selectize.clear();
        selectDesp[0].selectize.focus();
    }

    function finalizarPag()
    {
        var salvarVenda = false;
        if (parseFloat(detalhesPagamento['entregue']) < totalVenda[1]) 
        {
            var n = noty({
                layout: 'top',
                type: 'warning',
                timeout: 2000,
                text: '<b>Atenção!</b><br>Não é possível finalizar a compra. O valor total da compra ainda não foi atingido.',
                callback: {
                    afterClose: function() 
                    {
                        $('#valor_entregue').focus();
                    }
                }
            });
            $('#valor_entregue').focus();
            salvarVenda = false;
        } 
        else
        {
            if ($('#selectDespTipoPag').val() == '') 
            {
                var n = noty({
                    layout: 'top',
                    type: 'warning',
                    timeout: 2000,
                    text: '<b>Atenção!</b><br>Escolha o tipo de pagamento',
                    callback: {
                        afterClose: function() 
                        {
                            $('#selectDespTipoPag').focus();
                        }
                    }
                });
                $('#selectDespTipoPag').focus();
                salvarVenda = false;
            } 
            else
            {
                salvarVenda = true;
            };
        };
        return salvarVenda;
    }

    $(document).ready(function() {

        $('#qtd').mask('9999999');
        var val1 = $("#valor_entregue").maskMoney({allowNegative: false, thousands: '', decimal: '.', affixesStay: false});



        $("#valor_entregue").keyup(function (e){
            var valortotal = $("#totalCompra").text();
            var valorentregue = $("#valor_entregue").val();
            detalhesPagamento['entregue'] = parseFloat(valorentregue).toFixed(2);
            var troco = parseFloat(valorentregue)-parseFloat(valortotal);
            if (troco <= 0) 
            {
                $("#troco").val('0.00').css('font-weight','normal');
                detalhesPagamento['troco'] = parseFloat(0).toFixed(2);
            } 
            else
            {
                $("#troco").val(troco.toFixed(2)).css('font-weight','bold');
                detalhesPagamento['troco'] = parseFloat(troco).toFixed(2);
            };
            console.log('total: '+valortotal+' entregue: '+valorentregue+' troco: '+troco);
        });

        

        //seleciona os produtos digitados no campo select box...
        selectProd = $('#selectProd').selectize({
            valueField: 'codigo',
            labelField: 'descricao',
            loadThrottle: 100,
            create: false,
            hideSelected: true,
            preload: false,
            openOnFocus: false,
            searchField: ['codigo', 'descricao'],
            load: function(query, callback){
                if (!query.length) return callback();
                //console.log('load: '+linkGetProdutos); 
                $.ajax({
                    //async: false,
                    cache: false,
                    url: "<?php echo site_url('administrador/produto/listar_ajax');?>",
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        callback(res.produtos);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //var code = xhr.responseText.charCodeAt(0);
                        var w = window.open();
                        var html = '<b>Resposta do servidor</b><br><hr>'+xhr.responseText+'<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>'+thrownError;
                        $(w.document.body).html(html);
                        callback();
                    }
                });
            },
            render: {
                item: function(item, escape) {
                    return '<div>' +
                        '<span style="position: absolute; top: 10px; left: 40px;">' + escape(item.descricao) + '</span>' + 
                        '<span hidden>|</span>' +
                        '<span hidden>' + escape(item.preco) + '</span>' +
                        '<span hidden>|</span>' +
                        '<span style="position: absolute; top: 10px; right: 40px;">R$ ' + escape(item.preco) + '</span>' +
                    '</div>';
                },
                option: function(item, escape) {
                    return '<div style="text-align:left;">' +
                        '<span style="display: inline-block; text-align: right; padding-right:10px;width: 140px; font-size: 18px;">' + escape(item.codigo) + '</span>' +
                        '<span style="display: inline-block; text-align: left; width: 500px; font-family: Square721 BT, Arial;"><b>' + escape(item.descricao) + '</b></span>' +
                        '<span style="font-family: Square721 BT, Arial;">R$' + escape(item.preco) + '</span>'+
                    '</div>';
                }
            },
            onItemAdd: function(value, item){
                //alert('item add');
                this.disable();
                
                //calcularItem(this.getItem(value).text().split('|')[1]);

                var selectInputTextSplit = item.find('span').text().split('|');

                //pendingItemData[0] = selectInputTextSplit[0];   
                //pendingItemData[1] = this.getValue();           // codigo
                //pendingItemData[2] = selectInputTextSplit[2];   // preco
                //pendingItemData[3] = selectInputTextSplit[3];   // referencia

                pendingItemData[0] = this.getValue();
                pendingItemData[1] = selectInputTextSplit[0];
                pendingItemData[2] = selectInputTextSplit[1];

                $('#qtd').select();
                $('#qtd').addClass('focused');
                $('#addItem').removeClass('disabled');

                //adicionarItem(this.getValue(),selectInputTextSplit[0],selectInputTextSplit[1]);
                //codigo,descricao,precoUn                      
            }      
        });//fim do selectize

        selectDesp = $('#selectDesp').selectize({
            valueField: 'codigo',
            labelField: 'nome',
            loadThrottle: 100,
            create: false,
            hideSelected: true,
            preload: false,
            openOnFocus: false,
            searchField: ['mSINDESDAM', 'mCRDD', 'nome', 'cpf'],
            load: function(query, callback){
                if (!query.length) return callback();
                //console.log('load: '+linkGetProdutos); 
                $.ajax({
                    cache: false,
                    url: "<?php echo site_url('administrador/produto/listar_desp');?>",
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        //console.log(JSON.stringify(res.despachantes));
                        callback(res.despachantes);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //var code = xhr.responseText.charCodeAt(0);
                        var w = window.open();
                        var html = '<b>Resposta do servidor</b><br><hr>'+xhr.responseText+'<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>'+thrownError;
                        $(w.document.body).html(html);
                        callback();
                    }
                });
            },
            render: {
                item: function(item, escape) {
                    return '<div style="text-align:left; font-size: 16px; line-height: 16px; height: auto; padding: 0px;">' +
                        '<span id="selectDespItemNome" style="display: inline-block; width: 100%;">' + escape(item.nome) + '</span>' +
                        '<span id="selectDespItemCRDD" style="display: none; width: 100%;">' + escape(item.mCRDD) + '</span>' +
                    '</div>';
                },
                option: function(item, escape) {
                    return '<div style="text-align:left; font-size: 16px; line-height: 16px; height: auto; padding: 5px 3px;">' +
                        '<span style="display: inline-block; width: 12%;"><b>' + escape(item.mCRDD) + '</b></span>' +
                        '<span style="display: inline-block; width: 88%;">' + escape(item.nome) + '</span>' +
                    '</div>';
                }
            },
            onItemAdd: function(value, item){
                //alert(value);
                vendaDesp[0] = value;
                vendaDesp[1] = item.find('#selectDespItemNome').text();
                vendaDesp[2] = item.find('#selectDespItemCRDD').text();
                focusSearch();   
            }      
        });//fim do selectize

        $('#selectDespWrapper').find('.selectize-input').css('line-height','16px');
        $('#selectDespWrapper').find('.selectize-input input').css('font-size','16px');

        focusSearch();

        $('#addItem').click(function(){
            if (!$(this).hasClass('disabled')) 
            {
                adicionarItem(pendingItemData[0], pendingItemData[1], pendingItemData[2]);
            }
            else
            {
                focusSearch();
            }
        })

        $('#qtd').keydown(function(e){
            if ( e.keyCode == 13 ) 
            {
                e.preventDefault();
                if (pendingItemData[0] !== undefined) 
                {
                    adicionarItem(pendingItemData[0], pendingItemData[1], pendingItemData[2]);
                } 
                else
                {
                    alert('Por favor pesquise o produto a adicionar.');
                    focusSearch();
                };
                return false;
            }
        });

        $('#qtd').click(function(){
            $(this).select();
            $('#qtd').addClass('focused');
        })

        $('#qtd').focusout(function(){
            $('#qtd').removeClass('focused');
        })

        $('#qtd').keyup(function(){
            if ($(this).val() == '') 
            {
                $(this).val('1');
            };
        })

        $('#selectProd').click(function(){
            focusSearch();
        })

        $('#finalizarButton').click(function(){
            var fButton = $(this);
            if (!fButton.hasClass('submitted')) 
            {
                fButton.addClass('submitted');
                if (finalizarPag()) 
                {
                    salvarVenda();
                    // apprise('Tem a certeza que deseja finalizar e registrar a venda?', 
                    //     {'verify':true, 'textYes':'Sim', 'textNo':'Não'}, function(r) {
                    //     if(r) { console.log('SALVAR A VENDA'); salvarVenda(); } else { fButton.removeClass('submitted'); }
                    // });
                }
                else
                {
                    fButton.removeClass('submitted');
                }
            }
        })

     });
</script>
<style>
    #caixaModal
    {
    	position: fixed;
    	display: none;
    	background-color: #000;
    	opacity:0.8;
    	top: 0; bottom: 0; left: 0; right: 0;
    	z-index: 999999;
    	cursor: wait;
    	transition: all ease-in-out 0.1s;
    }
    	#caixaModal.visibleModal
    	{
    		display: block;
    	}
    
</style>
<!-- Abre caixa de dialogo  -->
<div id="caixaModal"></div>

<!-- div de pagamento da compra -->
<div id="pagamento">
    <div style="font-family: 'Raleway' 'Gadugi'; color: green; font-size: 32px;padding-bottom: 5px;">FINALIZAR COMPRA</div>

    <table width="100%">
        <tr>
            <td width="150" id="aPagarLabel">
                TOTAL A PAGAR
            </td>
            <td id="aPagarVal">
                <div id="pagTotalValue"></div>
            </td>
        </tr>
        <tr>
            <td width="150" style="padding: 10px 10px 0px 0px;" align="right">
                <label for="pagDespachante">DESPACHANTE</label>
            </td>
            <td style="padding: 10px 0px 0px 0px;">
                <input type="text" class="input" disabled id="pagDespachante" style="width: 100%;" />
            </td>
        </tr>
        <tr>
            <td width="150" style="padding: 10px 10px 0px 0px;" align="right">
                <label for="valor_entregue">PAGAMENTO</label>
            </td>
            <td style="padding: 10px 0px 0px 0px;">
                <div id="valor_entregueWrapper">
                    <input type="text" id="valor_entregue" />
                </div>
            </td>
        </tr>
        <tr>
            <td width="150" style="padding: 10px 10px 0px 0px;" align="right">
                <label for="pagDespachante">TIPO PAG.</label>
            </td>
            <td style="padding: 10px 0px 0px 0px;">
                <select id="selectDespTipoPag" class="select" style="width: 100%;">
                    <option value="">Selecione o tipo de pagamento</option>
                    <option value="0">Dinheiro</option>
                    <option value="1">Cartão</option>
                    <option value="2">Depósito</option>
                </select>
            </td>
        </tr>
        <tr>
            <td width="150" style="border-bottom: 1px solid black; padding: 10px 10px 10px 0px;" align="right">
                TROCO
            </td>
            <td style="border-bottom: 1px solid black; padding: 10px 0px 10px 0px; font-weight: normal;">
                <div id="trocoWrapper">
                    <input type="text" id="troco" disabled value="0.00" />
                </div>
            </td>
        </tr>
    </table>
    
    <input class="formButton submit" type="button" value="Finalizar" id="finalizarButton">
    <input class="formButton cancel" type="button" value="Cancelar" id="cancelar" onclick="cancelarPagamento();">
</div>

<div id="caixaWrapper">

    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="">
                <span style="font-family: 'Raleway' Arial; color: green; font-size: 36px;">VENDA</span>
            </td>
            <td width="30%" align="right" style="padding-right: 5px;">
                <span onclick="focusDesp();"><label for="selectDesp">Despachante</label></span>
            </td>
            <td width="30%" id="selectDespWrapper">
                <select id="selectDesp" name="selectDesp"></select>
            </td>
        </tr>
    </table>

    <input type="hidden" id="btBuscarProdutos" value="<?php echo site_url('administrador/produto/listar'); ?>">

    <select id="selectProd" name="selectProd"></select>

    <div id="caixaBody">

        <div id="caixaBodyTotais">

            <div id="qtdItemWrapper">
                <div id="qtdItemValue">
                    <input type="text" class="inputVenda" value="1" id="qtd">
                </div>
                <div id="qtdItemAdd">
                    <input type="button" class="disabled" id="addItem" value="+" />
                </div>
            </div>
            
            
            <div id="totalItensWrapper">
                <div id="totalItensLabel">Total itens</div>
                <div id="qtdItens">0</div>
            </div>
            
            <div id="valorVendaWrapper">
                <div id="valorVendaLabel">Total compra</div>
                <div id="totalCompra">R$ 0.00</div>
            </div>

            <div id="buttonsWrapper">
                <input class="compraButton" type="button" onclick="finalizarCompra();" id="finalizarCompraButton" value="finalizar comprar">
                <input class="compraButton" type="button" onclick="cancelarCompra();" id="cancelarCompraButton" value="cancelar">
            </div>
        </div>

        <div id="caixaBodyLista">
            <div id="cupomWrapper">
                <table id="tbCupom">
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<?php
    require_once APPPATH.'views/venda/recibo.php'; 
?>