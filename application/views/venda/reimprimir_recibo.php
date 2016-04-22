
<?php

     // echo $query;
    $produtos = $produtosVenda->row();
   	$dados = $reciboVenda2V->row();

   	if (empty($dados->des_nome)) {
   		$despachanteNome = "NAO IDENTIFICADO";
   	} else {
   		$despachanteNome = $dados->des_nome;
   	}
   	


   	$forma_pgto = $dados->forma_pagamento;
   	if ($forma_pgto==0) 
   	{
   		$forma_pagamento = "DINHEIRO";
   	} 
   	else if($forma_pgto==1)
   	{
   		$forma_pagamento = "CARTAO";
   	}
   	else
   	{
   		$forma_pagamento = "DEPOSITO BANCARIO";
   	}
   	
      //$produtos->des_nome;
        //$produtosVenda->result();
?>  
<script> function printview() { window.print(); } </script>
  
     <?php
    // window.close();
    //require_once APPPATH.'controllers/funcoes/funcoes.php';
/*
    $dados = $query->row_array(); $dados_estab = $queryEstab->row_array();
    $itens = $queryItens->result_array();
    $itensPgto = $queryPgtos->result_array();

    $ramo = $dados['venda_ramo']; $pgto = $dados['venda_tipoPgto'];
    if ($ramo=='v'){$vendaramo='Varejo';}if ($ramo=='a'){$vendaramo='Atacado';}
    if ($pgto=='0'){$tipopgto='À VISTA';}if ($pgto=='1'){$tipopgto='À PRAZO';}if ($pgto=='2'){$tipopgto='OUTROS';}
    */?>
 
 <html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style >
  
#tablecupomprint
{
    width: 300px;
    font-size: 6.75pt;
}

        @media print{
        
        #tablecupomprint{
            width: 100%;
            padding: 5px;
            
        }
        }
	</style>
</head>
<body onLoad="printview()">
        <div id="cupom4print" style="display: block;  height: auto; margin: 0mm; padding:0mm; border:0mm;">

                <table id="tablecupomprint" cellspacing="0" cellpadding="0" >
                    <thead>
                        <tr>
                            <td align="center" colspan="2" style="vertical-align: middle; font-family: Arial; padding: 0px 0px 2px 0px; width: 100%;">
                                <span style="display: block; font-size: 15pt; font-weight: bold;">RECIBO</span>
                                <span style="display: block; font-size: 7.5pt; font-weight: bold;">
								<!--<?php echo $dados_estab['estabelecimento_razaosocial'];?>!-->
								CRDD/AM 

								</span>
								 <span style="display: block; font-size: 6.50pt; text-align: center;">
								Conselho Regional dos Despachantes<br>Documentalistas do Amazonas</span>
                                <span style="display: block; font-size: 6.75pt;">
								Travessa São Judas Tadeu, 452, Adrianópolis</span>

     
                            </td>
                        </tr>
                        <tr>
                        	<td align="center" colspan="2" style="border-top: 1px dotted black; vertical-align: middle; font-family: Arial; padding: 2px 0px 2px 0px; width: 100%;">
                        		
                        		<span style="display: block; font-size: 6.75pt;"></span>
                        		<span style="display: block; font-size: 6.75pt;"> ** Sem valor fiscal **</span>
                        		<span style="display: block; font-size: 6.75pt;"> Emissão: <?php echo $dados->ven_data."  ".$dados->ven_hora; ?> </span>
                        	</td>
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>
                    		<td style="text-align: center; font-size: 6.75pt; font-weight: bold; font-family: Arial; border-top: 1px solid black;width: 100%; padding: 2px 0px 2px 0px;">
                    			DETALHE DA VENDA
                    		</td>
                    	</tr>
                    	<tr>
                    		<td style="text-align: center; font-size: 6.75pt; font-family: Arial; width: 100%; border-top: 1px solid black; font-weight: bold;">
                    			<div style="display:block; width: 100%;">
				                    <span style="float:left; width: 20%; text-align: left;">CÓDIGO</span>
				                    <span style="float:left; width: 80%; text-align: right;">DESCRIÇÃO</span>
			                    </div>
                    			<div style="display:block; width: 100%;">
	                    			<span style="float:left; width: 23%; text-align: left;">QTD. UN</span>
				                    <span style="float:left; width: 32%; text-align: left;">PREÇO(R$)</span>
				                    <span style="float:left; width: 5%; ">DESC.</span>
				                    <span style="float:left; width: 40%; text-align: right;">TOTAL(R$)</span>
				                </div>
                    		</td>
                    	</tr>
                    	<tr id="cupomDetalheVenda">
                    		<td style="width: 100%; font-family: Arial; border-top: 1px dotted black; padding: 0px 0px 2px 0px;" >
                <div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">
<?php
		if($produtosVenda->num_rows() > 0)
		{	$qtdItens=0;
			foreach($produtosVenda->result() as $row)
			{		
				$qtdItens = $row->itv_quantidade+$qtdItens;
				//$qtdItens ++;	
				echo '<div style="display:block; width: 100%;">';
              	echo '<span style="float:left; width: 20%; text-align: left;">'.$row->pro_codigo.'</span>';
               	echo '<span style="float:left; width: 80%; text-align: right;">'.$row->pro_descricao.'</span>';
               	echo '</div>'; 

                echo '<div style="display:block; width: 100%;">';
                echo '<span style="float:left; width: 25%;">'.$row->itv_quantidade.' UN</span>';
                echo '<span style="float:left; width: 30%;">'.number_format($row->pro_valor_unitario,2,',','.').'</span>';
                echo '<span style="float:left; width: 5%;">0.00</span>';
                echo '<span style="float:left; width: 40%; text-align: right;">'.number_format($row->pro_valor_unitario*$row->itv_quantidade,2,',','.').'</span>';
                echo '</div>';
			}			 
		}
?>	                         </div>
                    		</td>
                    	</tr>
                    	<tr id="cupomTotaisVenda">
                    		<td style="width: 100%; font-family: Arial; border-top: 1px dotted black;">
<?php
                echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
                echo '<span style="float:left; width: 65%; text-align: left; font-weight: bold; padding: 2px 0px 0px 0px;">QTD. ITENS</span>';
                echo '<span style="float:left; width: 35%; text-align: right; padding: 2px 0px 0px 0px;">'.$qtdItens .'</span>';
                
                echo '<span style="float:left; width: 65%; text-align: left; font-weight: bold; padding: 2px 0px 0px 0px;">VALOR TOTAL(R$)</span>';
                echo '<span style="float:left; width: 35%; text-align: right; padding: 2px 0px 0px 0px;">'.number_format($dados->valor_total,2,',','.').'</span>';
                echo '</div>';

                echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
                echo '<span style="float:left; width: 65%; text-align: left; font-weight: bold;">PAGAMENTO</span>';
                echo '<span style="float:left; width: 35%; text-align: right;">'.number_format($dados->pagamento,2,',','.').'</span>';
                echo '</div>';
        
               

                echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
                echo '<span style="width: 60%; float:left; text-align: left; font-weight: bold;">FORMA PAGAMENTO</span>';
                echo '<span style="width: 40%; float:left; text-align: right;">'.$forma_pagamento.'</span>';
                echo '</div>';

                echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
                echo '<span style="float:left; width: 65%; text-align: left; font-weight: bold;">TROCO(R$)</span>';
                echo '<span style="float:left; width: 35%; text-align: right;">'.number_format($dados->troco,2,',','.').'</span>';
                echo '</div>';

               /* echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; font-size: 6.75pt; font-weight: bold;">';
                echo '<span style="width: 60%; float:left; text-align: left; border-top:1px dotted black; padding-top: 2px;">TIPO PAGAMENTO</span>';
                echo '<span style="width: 40%; float:left; text-align: right; border-top:1px dotted black; padding-top: 2px;">VALOR PAGO</span>';
                echo '</div>';	*/			
                /*if ($pgto=='0')  // a vista
                {
                    echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
                    foreach ($itensPgto as $key => $array_dados){
						echo '<span style="width: 60%; float:left; text-align: left;">'.$array_dados['tipopgto'].'</span>';
						echo '<span style="width: 40%; float:left; text-align: right;">'.number_format($array_dados['valor'],2,',','.').'</span>';

                    };
                    echo '</div>';
                }else // parcelado
                {
                    echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt; text-align:center;">ENTRADA</div>';
                    echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
                    foreach ($itensPgto as $key => $array_dados){
                        if ($array_dados['entrada']=='1') 
                        {
						echo '<span style="width: 60%; float:left; text-align: left;">'.$array_dados['tipopgto'].'</span>';
						echo '<span style="width: 40%; float:left; text-align: right;">'.number_format($array_dados['valor'],2,',','.').'</span>';
                        };
                    };
                    echo '</div>';

                    echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt; text-align:center;">A PRAZO</div>';
                    echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt;">';
                    foreach ($itensPgto as $key => $array_dados){
                        if ($array_dados['entrada']=='0') 
                        {
						echo '<span style="width: 60%; float:left; text-align: left;">'.$array_dados['tipopgto'].'</span>';
						echo '<span style="width: 40%; float:left; text-align: right;">'.$array_dados['nroParcelas'].' x '.number_format(($array_dados['valor']/$array_dados['nroParcelas']),2,',','.').'</span>';
                        };
                    };
                    echo '</div>';
                };*/
                echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; font-size: 6.75pt;">';
                echo '<span style="width: 60%; float:left; text-align: right; border-top:1px dotted black; padding: 2px 0px 2px 0px;">RECIBO Nº</span>';
                echo '<span style="width: 40%; float:left; text-align: left; border-top:1px dotted black; padding: 2px 0px 2px 0px;">'.$dados->ven_codigo.'</span>';
                echo '</div>';				
?>                    			
                    		</td>
                    	</tr>
                    	<tr id="cupomOutros">
                    		<td style="width: 100%; font-family: Arial; border-top: 1px solid black;">
<?php
                
                echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; ">';
                echo '<span style="width: 50%; padding-left: 30%; float:left; text-align: center; font-size: 6.75pt;">Despachante</span>';
                echo '</div>';
                echo '</td></tr>';
                echo '<tr><td style="width: 100%; font-family: Arial; border-top: 1px solid black;">';
                echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; ">';
                echo '<span style="width: 50%; padding-left: 30%;float:left; text-align: center; font-size: 6.75pt;">'.$despachanteNome.'</span><br>';
                echo '</div>';
                echo '</td></tr>';
				/*
				echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 6.75pt; text-align:center;">Emissão: '.$dados->ven_data.' </div>';
				*/
             			
                ?>                  			
                    		
                    </tbody>
                    <tfoot>
                        <tr id="cupomFooter">
                    		<td style="width: 100%; font-family: Arial; border-top: 1px dotted black;">
<?php
                echo '<div style="display: block; width: 100%; margin: 0mm 0mm 0mm 0mm; padding:0mm; border:0mm; font-size: 5.30pt; text-align:center;">Emitido por. ADAPT Despachante
                		<br>
                		<strong>AdaptData - (92) 3308-4840</strong>
                </div>';
?>                    			
                    		</td>
                    	</tr>
                    </tfoot>
                </table>               
        </div>
</body> 
</html>

<!-- ******************************************************************************************************************************* -->
<!-- ******************************************************************************************************************************* -->
<!-- ******************************************************************************************************************************* -->

 