       <html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <script src="<?php echo base_url('/assets/jquery-1.9.0.js'); ?>" type="text/javascript"></script>
       <script src="<?php echo base_url('/assets/jquery.PrintArea.js'); ?>" type="text/javascript"></script>
       
<style type="text/css">
 

 .imprimir
 {
 	width: 900px;
 	margin-left: 50px;
 }
 .imprimir .topo
 {
 	height: 25mm;

 	
 }
 .imprimir td
 {
 	padding: 10px;
 	line-height: 20px;
 	height: 20mm;
 	display: block;
 }
 .titulo_dados
 {
 background: #FFCC66;
 height: 25mm;
 }
 .imprimir .fundo 
 {
 height: 100mm;	
 }
 
 .table_impressao
 {
 	width: 900px;
 	border-style: solid;
 	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
 
 .table_impressao td
 {
 border-style: solid;
 border-width: 1px;
 }
 

/* a parte na qual o usuario ve*/
@media screen{

tr.titulo_dados
{
background-color:  #FFCC66 !important;
       -webkit-print-color-adjust: exact;
}
table .table_impressao
{
	border: 1px;
	-webkit-print-border-adjust:exact;
}

div.imprimir
{
	margin: auto;
	-webkit-print-margin-adjust:exact;

}
table#cabecalho td
{
	border: hidden;
	-webkit-print-border-adjust:exact;
}
table#cabecalho2 
{
	display: none;
	-webkit-print-display-adjust:exact;
}



 }


/* a parte na qual sera impresso*/
@media print{

table#cabecalho td
{
	border: hidden;
	-webkit-print-border-adjust:exact;
}
table#cabecalho2 td
{
	border: hidden;
	-webkit-print-border-adjust:exact;
}



tr.titulo_dados
{
background-color:  #FFCC66 !important;
       -webkit-print-color-adjust: exact;
}
table .table_impressao
{
	border: 1px;
	-webkit-print-border-adjust:exact;
}

div.imprimir
{
	margin: auto;
	margin-top: 10px;
	-webkit-print-margin-adjust:exact;

}


div#imprimir
{
	page-break-after: right;
	-webkit-print-page-break-before-adjust:exact;
}
div#icone
{
	display: none;
	-webkit-print-display-adjust:exact;
}

 }

 </style>

 <script type="text/javascript">


  
$(document).ready(function(){

  $('#impressao').click(function(){
	
   
    var myDropDown = document.getElementById('imprimir');
    var icone = document.getElementById('icone');
 
   	icone.style.display="none";
   	window.title="bla bla";
    //Whatever other elements to hide.

    window.print();
    myDropDown.style.display = "block";
    return true;
    

    //$("#imprimir").printArea();
   
  });


  });

 </script>



 <?php 

 	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');
 
	$date = date("d-M-Y");
	$dataAtual = strftime("%A, %d de %B de %Y", strtotime( $date ));
	//$date = date("d-M-Y");

 	$dados = $query->row();

 	$ufdados = $uf->row();
	if ($uf->num_rows() > 0) {
	foreach ($uf->result() as $row) {

		if($row->codigo == substr($dados->des_cod_naturalidade, 0,2))
		{
			$estado=$row->sigla ;
		}
		if($row->codigo==$dados->end_coduf)
		{
			$estadoEndereco = $row->sigla;
		}

	}
}


if ($queryCidade2->num_rows() > 0) {
	foreach ($queryCidade2->result() as $row) 
	{
		if ($row->codigo == $dados->end_codmunicipio) 
		{
			$cidadeEndereco=$row->nome;
		} 		
	
	}
} 

if ($queryCidade3->num_rows() > 0) {
	foreach ($queryCidade3->result() as $cidade) 
	{
		if($cidade->codigo == $dados->emp_mun_codigo)
		{
			$cidadeEmpresa = $cidade->nome;
		}

	}
	
}else
{
	$cidadeEmpresa="";
} 




 ?>

 <div id="imprimir" class="imprimir">

 <table  id="cabecalho" class="table_impressao">
	   <tr >
	   <td align="left" id="brasao">
			<img src="<?php echo base_url('assets/img/brasao.png');?>" width="70px" height="70px">
		</td>
		<td align="left" id="titulo" colspan="2">
			<span style="color:#00923E; text-align:center;"><p>CONSELHO FEDERAL DOS DESPACHANTES DOCUMENTALISTAS<br/>DO BRASIL - CFDD/BR<br/>
			DIREX - Diretoria Executiva</p></span>
		</td>
		</tr>
		<tr>
		<td colspan="3">
		<br/>
			<p>ANEXO 1 - Direito Adquirido ba forma da Lei Federal n&ordm;. 10.602, de dezembro de 2012.</p>
		</td>
		</tr>
</table>


<table class="table_impressao">


	<tr class="topo" rowspan="2">
		<td><p><br>Ficha de Inscrição:<?php echo "Ficha";?></p></td>
		<td colspan="5"><p><br>Codigo:<?php echo $dados->des_matricula;?></p></td>
	</tr>

	<tr class="topo">
		<td><p>Forma de ingresso:<strong><u><?php echo $dados->des_forma_ingresso;?></u></strong>
			pela Lei Federal Nº 10.602, de 12 de dezembro de 2002
			</p>
		</td>

		<td colspan="5"><p>Data do ingresso:<?php echo $dados->des_data_ingresso;?></p></td>
	</tr>

	<tr class="topo">
		<td><p>Documento que coomprova a qualidade de despachante:
			</p>
		</td>

		<td colspan="5"><strong><p>Órgão: SINDESDAM </p></strong></td>
	</tr>

	<tr class="titulo_dados">
		<td colspan="10" align="center"><h2><strong>DADOS PESSOAIS</strong></h2></td>
	</tr>

	<tr>
		<td colspan="10"><strong> Nome:</strong><p> <?php echo $dados->des_nome;?></p></td>
	</tr>

	<tr>
		<td><strong> Sexo:</strong><p> <?php echo $dados->des_sexo;?></p></td>
		<td colspan="5"><strong> Estado Civil:</strong><p> <?php echo $dados->des_estado_civil;?></p></td>
	</tr>

	<tr>
		<td colspan="10"><strong> Nome Pai: </strong><p><?php echo $dados->des_nome_pai;?></p></td>
	</tr>

	<tr>
		<td colspan="10"><strong> Nome Mae:</strong><p> <?php echo $dados->des_nome_mae;?></p></td>
	</tr>

	<tr>
		<td><strong> Naturalidade:</strong><p><?php echo $dados->mun_nome;?></p></td>
		<td><strong> Estado:</strong><p> <?php echo $estado;?></p></td>
		<td colspan="5" width="25%"><strong> Nacionalidade: </strong><p> <?php echo "Brasileiro";?></p></td>
	</tr>

	<tr>
		<td colspan="10"><strong>Endereço:</strong><p> <?php echo $dados->end_descricao;?></p></td>
	</tr>

	<tr>
		<td><strong>Complemento:</strong><p> <?php echo $dados->end_complemento;?></p></td>
		<td colspan="5"><strong>Bairro:</strong><p> <?php echo $dados->end_bairro;?></p></td>
	</tr>

	<tr>
		<td><strong>Municipio:</strong><p> <?php echo $cidadeEndereco;?></p></td>
		<td><strong>Estado:</strong><p> <?php echo $estadoEndereco;?></p></td>
		<td><strong>Cep:</strong><p> <?php echo $dados->end_cep;?></p></td>
	</tr>

	<tr>
		<td><strong>Telefone:</strong><p> <?php echo $dados->des_telefone;?></p></td>
		<td colspan="5"><strong>Celular:</strong><p> <?php echo $dados->des_celular;?></p></td>
	</tr>
	</table>
	</div>

	<div id="imprimir" class="imprimir">

		 <table  id="cabecalho2" class="table_impressao">
	   <tr >
	   <td align="left" id="brasao">
			<img src="<?php echo base_url('assets/img/brasao.png');?>" width="70px" height="70px">
		</td>
		<td align="left" id="titulo" colspan="2">
			<span style="color:#00923E; text-align:center;"><p>CONSELHO FEDERAL DOS DESPACHANTES DOCUMENTALISTAS<br/>DO BRASIL - CFDD/BR<br/>
			DIREX - Diretoria Executiva</p></span>
		</td>
		</tr>
		<tr>
		<td colspan="3">
		<br/>
			<p>ANEXO 1 - Direito Adquirido ba forma da Lei Federal n&ordm;. 10.602, de dezembro de 2012.</p>
		</td>
		</tr>
	</table>



	<table id="content"  class="table_impressao">

	<tr>
		<td ><strong>Data de Nascimento:</strong><p> <?php echo $datanascimento;?></p></td>
		<td width="25%"><strong>RG:</strong><p> <?php echo $dados->des_rg;?></p></td>
		<td><strong>Orgão:</strong><p> <?php echo $dados->des_orgao_emissor;?></p></td>
	</tr>

	<tr>
		<td><strong>CPF:</strong><p> <?php echo $dados->des_cpf;?></p></td>
		<td colspan="5"><strong>Grau de Ensino:</strong><p> <?php echo $dados->des_grau_instrucao;?></p></td>
	</tr>

	<tr>
		<td><strong>Título Eleitoral:</strong><p> <?php echo $dados->des_titulo_eleitoral;?></p></td>
		<td><strong>Zona:</strong><p> <?php echo $dados->des_zona_eleitoral;?></p></td>
		<td><strong>Sessão:</strong><p> <?php echo $dados->des_sessao_eleitoral;?></p></td>
	</tr>

	<tr>
		<td colspan="10"><strong>E-mail:</strong><p> <?php echo $dados->des_email;?></p></td>
	</tr>

	<tr class="titulo_dados">
		<td colspan="10" align="center"><h2><strong>DADOS COMERCIAIS E DA SOCIEDADE EMPRESARIA</strong></h2></td>
	</tr>

	<tr>
	</tr>

	<tr>
		<td><strong>Complemento:</strong><p> <?php echo $dados->emp_complemento;?> </p></td>
		<td colspan="5"><strong>Bairro:</strong><p> <?php echo $dados->emp_bairro;?> </p></td>
	</tr>

	<tr>
		<td><strong>Municipio:</strong><p> <?php echo $cidadeEmpresa;?> </p></td>
		<td><strong>Estado:</strong><p> <?php echo $dados->emp_rua;?> </p></td>
		<td><strong>Cep:</strong><p> <?php echo $dados->emp_cep;?> </p></td>
	</tr>
	<tr>
		<td colspan="5"><strong>Regiao e Seccional:</strong><p> <?php echo $dados->emp_regiao_seccional;?></p></td>
	</tr>

	<tr class="fundo">
		<td align="center"><p>Foto 3x4</p></td>
		<td align="center"><p>Polegar Direito</p></td>
		<td colspan="5" width="50%"><p>Nos termos legais, satisfeitas as exigencias, venho requerer a Inscrição
			no Conselho regionaldos Despachantes Documentalistas do Amazonas.<br/><br/>
			Manaus, <?php echo $dataAtual; ?><br/><br/>

			_______________________________________________________ <br/>Assinatura do Despachante
		<br>Matricula CRDD: <?php echo $dados->des_matricula;?></td>
	</tr>
	
</table>
</div>
	

<div class="imprimir" id="icone">
<table class="table_impressao" >
<tr>
<td>
               <form>
                <div >
                <a onclick="return false();" class="impressao" id="impressao" title="Imprimir Despachante">
                 <img src="<?php echo base_url('/assets/img/impressora.png');?>" width="33px" height="33px">
                </a>
            </div>
            </td>
</form>
</tr>
</table>
<div>





