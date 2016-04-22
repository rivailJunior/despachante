<?php
//tcpdf();
//$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$obj_pdf->SetCreator(PDF_CREATOR);
//$title = "PDF Report";
//$obj_pdf->SetTitle($title);
//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
//$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//$obj_pdf->SetDefaultMonospacedFont('helvetica');
//$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$obj_pdf->SetFont('helvetica', '', 9);
//$obj_pdf->setFontSubsetting(false);
//$obj_pdf->AddPage();
//ob_start();
    // we can have any view part here like HTML, PHP etc

$dadosDespachante = $dadosDesp->row_array();
?>

<div id="procuracao">
<table border="1" align="center" style="border-collapse: collapse; text-align:justify; font-family: Arial;" width="70%">
<tr>

	<td>
	<!--CABECALHO-->
	<table align="center" width="88%" height="100px">
	    <tr>
		    <td align="center">
			<span style=""><img src="<?php echo base_url('assets/img/brasao.png');?>" width="70px" height="70px"></span>
			</td>
		    <td align="center">
			<span style=""><img src="<?php echo base_url('assets/img/crdd.png');?>" width="150px" height="75px"></span>
			</td>
		</tr>
		<tr>
		    <td align="center">
				<span style="font-size:13px"><p><strong>CFDD/BR - CONSELHO FEDERAL DOS<br/>DESPACHANTES DOCUMENTALISTAS DO BRASIL</strong></p></span>
			</td>
		    <td align="center">
			<span style="font-size:13px"><p><strong>CRDD/AM CONSELHO REGIONAL DOS DESPACHANTES<br/> DOCUMENTALITAS DO ESTADO DO AMAZONAS</strong></p></span>	
			</td>
		</tr>
	</table>
	<!--FIM CABECALHO-->
		<table width="50%" height="100px"  align="center" cellpadding="2">
			<tr>
				<td align="center">
				<strong><hr></strong>
				</td>
			</tr>
			<tr>
				<td colspan="10" align="center">
					<strong><h1>PROCURAÇÃO</h1>
					<h4>Lei 10406/02 art. 653 e segs.</h4></strong>
				</td>
			</tr>
			
			<tr>
				<td colspan="10" align="left">
					<strong><u><h3>OUTORGANTE</h3></u></strong>
				</td>
			</tr>
			
			<tr>
				<td>
					Nome:_______________________________________________________________________________________________
				</td>
			</tr>
			
			<tr>
				<td>
					RG:___________________________Org. Emissor:___________________CPF/CNPJ:_____________________________
				</td>
			</tr>
			
			<tr>
				<td>
					Endereço:___________________________________________________________________________________________
				</td>
			</tr>
			
			<tr>
				<td>
					BAIRRO:_____________________________CIDADE:___________________UF:__________ CEP:____________________
				</td>
			</tr>
			
			<tr>
				<td colspan="10" align="left">
					<br/><strong><u><h3>OUTORGADO</h3></u></strong>
				</td>
			</tr>
			
			<tr>
				<td>
				<p>Nome: <strong><?php echo strtoupper($dadosDespachante['nome']); ?></strong> Despachante Documentalista cadastrado(a) no <strong>CRDD/AM</strong>
				 sob o nº<strong> <?php echo $dadosDespachante['matricula']; ?>, SINDESDAM</strong> nº <strong><?php echo $dadosDespachante['matriculaS']; ?>,<br/> 
				 RG:</strong><?php echo $dadosDespachante['rg']; ?>,<strong>
				 Órgão Emissor</strong> <?php echo $dadosDespachante['oemissor']; ?>, <strong>CPF: </strong><?php echo $dadosDespachante['cpf']; ?><br/>
				 <strong>Endereço: </strong><?php echo $dadosDespachante['endereco']; ?><br/>
				 <strong>Bairro:</strong> <?php echo $dadosDespachante['bairro']; ?>, <strong>Cidade:</strong> <?php echo $dadosDespachante['cidade']; ?>, <strong>UF:</strong><?php echo $dadosDespachante['sigla']; ?>, 
				 <strong>CEP: </strong> <?php echo $dadosDespachante['cep']; ?>.
				 </p>
				</td>
			</tr>
			
			<tr>
				<td colspan="10" align="left">
					<br/><strong><u><h3>PODERES</h3></u></strong>
				</td>
			</tr>
			<tr>
				<td>
				<p >Com poderes de representa&ccedil;&atilde;o junto a reparti&ccedil;&otilde;es, &oacute;rg&atilde;os e autarquias
				federais estaduais, municipais e entidades paraestatais bem como especificamos para o <strong>DETRAN/AM RECEITA
				FEDERAL, SEFAZ - AM, SMTU E MANAUSTRANS</strong> com fins espec&iacute;ficos para realizar os seguintes servi&ccedil;os:
				( ) <u>BAIXA TRIBUT&Aacute;RIA;</u>( ) <u>2&ordf; VIA CRV/CRLV; </u>( ) 
				<u>LIBERA&Ccedil;&Atilde;O DE VE&Iacute;CULO APREENDIDO</u> e outros:__________________________________________________
				do ve&iacute;culo da abaixo discriminado.
				 </p>
				</td>
			</tr>
			
			<tr>
				<td colspan="10" align="left">
					<br/><strong><u><h3>DADOS DO VE&Iacute;CULO</h3></u></strong>
				</td>
			</tr>
			
			<tr>
				<td>
					Placa:_____________________________RENAVAM:__________________________Marca:_________________________
				</td>
			</tr>
			<tr>
				<td>
					Modelo:_______________________________Ano:__________________Chassi:____________________________________
				</td>
			</tr>
			<tr>
				<td height="80px">
				<p >Podendo, para tanto, assinar, requerer, desistir, receber documentos, enfim tudo fazer e praticar no fiel 
				cumprimento e desempenho do presente mandato.
				 </p>
				</td>
			</tr>
			<tr>
				<td align="center" height="50px">
					Manaus/AM,_________de__________________de 20______________.
				</td>
			</tr>
				<tr>
				<td align="center" height="50px">
					________________________________________<br/>Assinatura do Outorgante
				</td>
			</tr>
			
			<tr>
				<td align="center" height="30px">&nbsp;
					
				</td>
			</tr>
			<tr>
				<td align="center">
				<strong><hr></strong>
				</td>
			</tr>
			<tr>
				<td>
				<span style="font-family: Times,Arial; font-size:9px; text-align:center;"><p>Endere&ccedil;o: Travessa S&atilde;o Judas Tadeu,
				452,Adrian&oacute;polis - Cep: 69055-730<br/>
				Fones:(092)3184-8077<br/>
				CNPJ:05.654.240/00001-23<br/>
			    Site:<a href="#">www.crddam.com</a>/E-mail:<a href="#">crdd.am@hotmail.com<a></p></span>
				
				</td>
			</tr>
		</table>
	</td>

</tr>
</table>
<br/>
</div>



<div id="requerimento">
<table border="1" align="center" style="border-collapse: collapse; text-align:justify; font-family: Arial;" width="70%">
<tr>

	<td>
	<!--CABECALHO-->
	<table align="center" width="88%" height="100px">
	    <tr>
		    <td align="center">
				<span style=""><img src="<?php echo base_url('assets/img/brasao.png');?>" width="70px" height="70px"></span>
			</td>
		    <td align="center">
				<span style=""><img src="<?php echo base_url('assets/img/crdd.png');?>" width="150px" height="75px"></span>
			</td>
		</tr>
		<tr>
		    <td align="center">
				<span style="font-size:13px"><p><strong>CFDD/BR - CONSELHO FEDERAL DOS<br/>DESPACHANTES DOCUMENTALISTAS DO BRASIL</strong></p></span>
			</td>
		    <td align="center">
			<span style="font-size:13px"><p><strong>CRDD/AM CONSELHO REGIONAL DOS DESPACHANTES<br/> DOCUMENTALITAS DO ESTADO DO AMAZONAS</strong></p></span>	
			</td>
		</tr>
	</table>
	<!--FIM CABECALHO-->
		<table align="center" width="50%" height="100px">
			<tr>
				<td align="center">
				<strong><hr></strong>
				</td>
			</tr>
			<tr>
				<td colspan="10" align="center">
					<strong><u><h3>REQUERIMENTO PADR&Atilde;O DE SOLICITA&Ccedil;&Atilde;O DE SERVI&Ccedil;OS DOS DESPACHANTES</h3></u></strong>
				</td>
			</tr>
			
			<tr>
				<td colspan="10" align="left">
					AO DETRAN-AM
				</td>
			</tr>
			
			<tr>
				<td>
				<p>EU,<strong><u><?php echo strtoupper($dadosDespachante['nome']); ?></u></strong> Despachante Documentalista no CRDD/AM sob o n&ordm; <strong><?php echo $dadosDespachante['matricula']; ?></strong>
				e no <strong>SINDESDAM</strong> sob o n&ordm; <strong><u>254</u></strong>, representante legal da Empresa ou do Sr.(a): 
				________________________________________________________________ RG n&ordm; _________________ 
				CNPJ/CPF n&ordm; ___________________________ vem solicitar a Vossa Senhoria o seguinte servi&ccedil;o: </p>
				</td>
			</tr>
		
			<tr>
				<td height="110px">
				<p>( )<u>2&ordf; VIA CRV</u>( )<u>2&ordf; VIA CRLV</u> pelo fato de ter sido ( ) EXTRAVIADO;( )FURTADO/ROUBADO;
				OU( )DILACERADO<br/> ( )<u>LIBERA&Ccedil;&Atilde;O DE VE&Iacute;CULO APREENDIDO</u> do ve&iacute;culo abaixo discriminado.
				</p>
				</td>
			</tr>
			
			<tr>
				<td colspan="10" align="left">
					<strong><u><h3>DADOS DO VE&Iacute;CULO</h3></u></strong>
				</td>
			</tr>
			
			<tr>
				<td>
					Placa:_____________________________RENAVAM:__________________________Marca:_________________________
				</td>
			</tr>
			<tr>
				<td>
					Modelo:_______________________________Ano:__________________Chassi:____________________________________
				</td>
			</tr>
			<tr>
				<td height="80px">
				<p >Juntando para tal os documentos necess&aacute;rios.<br/>
				Declaro ainda, serem verdadeiras as informa&ccedil;&otilde;es supracitas, sujeitando-me as comina&ccedil;&otilde;es
				dispostas no art.229 do C&oacute;digo Penal Brasileiro.
				</p>
				</td>
			</tr>
				<tr>
				<td height="110px" align="center">
				<p > N.Termos.<br>
					 P.Deferimento.
				</p>
				</td>
			</tr>
			<tr>
				<td align="center" height="80px">
					Manaus/AM,_________de__________________de 20______________.
				</td>
			</tr>
				<tr>
				<td align="center" height="80px">
					________________________________________<br/>Assinatura do propriet&aacute;rio ou representante legal
					<br/>(com firma reconhecida no cart&oacute;rio por autenticidade ou verdadeira)
				</td>
			</tr>
			<tr>
				<td align="center">
				<strong><hr></strong>
				</td>
			</tr>
			<tr>
				<td>
				<span style="font-family: Times,Arial; font-size:8px; text-align:center;"><p>Endere&ccedil;o: Travessa S&atilde;o Judas Tadeu,
				452,Adrian&oacute;polis - Cep: 69055-730</p>
				<p>Fones:(092)3184-8077</p>
				<p>CNPJ:05.654.240/00001-23</p>
				<p>Site:<a href="#">www.crddam.com</a>/E-mail:<a href="#">crdd.am@hotmail.com<a></p></span>
				
				</td>
			</tr>
		</table>
	</td>

</tr>

</table>
</div>

<div id="divPrintEtiqueta">
<?php
$id = 0;
foreach($gerados as $row){
?>
    <div id="etiqueta">
    <table width="441" border="1" align="center" style="border-collapse: collapse; text-align:justify; font-family: Arial;">
    <tr>
        <td>
        <!--CABECALHO-->
        <table align="center" height="34">
              <tr>
                <td height="21" colspan="3" align="center"><p style="font-size:9px">CABEÇALHO PADRAO</p></td>
              </tr>
        </table>
        <!--FIM CABECALHO-->
            <table height="100px"  align="center">
                <tr>
                    <td align="center">
                        <strong>
                        <span style="font-size:10px">CERTIFICADO DE HABILITAÇÃO PROFISSIONAL - CHP</span>
                        </strong>
                    </td>
                </tr>
                
                <tr>
                    <td align="left"><p style="font-size:10px">Certificamos que o Despachante Documentalista Sr.(a) <?php echo strtoupper($dadosDespachante['nome']); ?>, matricula nro <?php echo $dadosDespachante['matricula']; ?> está habilitado a tramitar documentação de seus comitentes juntos aos orgãos públicos Federais, Estaduais e Municipais onde com esse se apresentar.</p></td>
                </tr>
                
                <tr>
                    <td><p style="font-size:10px">07/08/2013<br />
                    10:00<br />
                    CHP - No <?php echo $row[$id]; ?></p></td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
    </div>
<?php
$id =+ 1;
}
?>
    
</div><!--End div Print Etiqueta -->