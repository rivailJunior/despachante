<!-- ******************************************************************************************************************************* -->
<!-- ********************** RECIBO A IMPRIMIR ************************************************************************************** -->
<!-- ******************************************************************************************************************************* -->
<html>
<head>
	<style type="text/css" media="print">
		@page  
		{ 
		    size: 58mm auto; 
		    margin: 0mm;  
		}
		@media print {
		   body {width: 58mm; margin: 0mm;}
		}
		body
		{
			width: 58mm; 
			margin: 0mm; 
			padding:0mm;
		}

		* { margin:0mm; }
	</style>
</head>
<body>
        <div id="cupom4print" style="display:none; width:80mm; height: auto; margin: 0mm; padding:0mm; border:3mm; border-color:#000">

                <table width="250" cellpadding="0" cellspacing="0" id="tablecupomprint" >
                    <thead>
                        <tr>
                            <td align="center" colspan="2" style="vertical-align: middle; font-family: Arial; padding: 0px 0px 2px 0px; width: 100%;">
                                <span style="display: block; font-size: 15pt; font-weight: bold;">RECIBO</span>
                                <span style="display: block; font-size: 8pt; font-weight: bold;">
                                CRDD/AM
                                </span>
                                <!-- <span style="display: block; font-size: 6.75pt;">CNPJ:
								CNPJ</span> 
                                <span style="display: block; font-size: 6.75pt;">IE:
                                IE
                                </span> -->
                                <span style="display: block; font-size: 6.50pt; text-align: center;">
								Conselho Regional dos Despachantes<br>Documentalistas do Amazonas</span>
                                <span style="display: block; font-size: 6.75pt;">
								Travessa São Judas Tadeu, 452, Adrianópolis</span>
                            </td>
                        </tr>
                        <tr>
                        	<td align="center" colspan="2" style="border-top: 1px solid black; vertical-align: middle; font-family: Arial; padding: 2px 0px 2px 0px; width: 100%;">
                        		<span style="display: block; font-size: 6.75pt;">** Sem valor fiscal **</span>
                                <span style="display: block; font-size: 6.75pt;" id="emissaoRecibo"></span>
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
                    		<td style="width: 100%; font-family: Arial; border-top: 1px dashed black; padding: 0px 0px 2px 0px;" >
                    			
                    		</td>
                    	</tr>
                    	<tr id="cupomTotaisVenda">
                    		<td style="width: 100%; font-family: Arial; border-top: 1px dashed black;">
                    			
                    		</td>
                    	</tr>
                    	<tr id="cupomOutros">
                    		<td style="width: 100%; font-family: Arial; border-top: 1px solid black;">
                    			
                    		</td>
                    	</tr>
                    	<tr id="cupomConsumidor" >
                    		<td style="width: 100%; font-family: Arial; padding: 3px 0px 0px 0px; border-top: 1px dashed black;">
                    			
                    		</td>
                    	</tr>
                    </tbody>
                    <tfoot>
                        <tr id="cupomFooter">
                    		<td style="width: 100%; font-family: Arial; padding: 3px 0px 0px 0px; border-top: 1px solid black;">
                    			
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