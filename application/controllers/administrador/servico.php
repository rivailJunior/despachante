<?php
class Servico extends CI_Controller {

	private $data = array();
	
	function __construct() {
		parent::__construct();
		
		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/Login/show_login');
		}

		$this->load->model('M_despachante');
		$this->load->library('Form_validation');
		$this->load->helper('pdf_helper');
		$this->load->model('M_empresa');
		$this->load->model('M_contato');
		$this->load->model('M_numero');
		$this->load->model('M_outorgante');
		$this->load->model('M_servico');
		$this->load->model('M_configurar');
		$this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
	}

	
	function index(){
		$this->data['title']="Servico";        
		$this->data['content']="conteudo Servico";
		$valor=$this->M_servico->kitValor_select();
		$this->data['valor']=$valor;
				//$this->load->view('layouts/default_header',  $this->data);
		$this->load->view('servico/index',$this->data);
				//$this->load->view('layouts/default_footer',$this->data);
	}
	

/*-----------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------
NAO ESTA MAIS SENDO USADO	


function cadastrar() {  
		$this->load->view('layouts/default_header',  $this->data);
		$this->load->view('servico/realizar_servico',$this->data);
		$this->load->view('layouts/default_footer',$this->data);
		
		if(isset($_POST['btFinalizarServico'])){
		 
			
						//remove a mascara do cpf
			$data = date("Y-m-d");
			$hora = date('H:i:s');
			$servico['ser_des_matricula']=  $this->input->post('des_matricula');
			$servico['ser_out_cpf_cnpj'] =  $this->input->post('out_cpf');
			$servico['ser_vei_placa'] =  $this->input->post('vei_placa');
			$servico['ser_pod_codigo'] =  $this->input->post('pod_codigo');
			$servico['ser_data']=$data;
			$servico['ser_hora']=$hora;
			$res = $this->M_servico->save($servico);
			if($res){
			 echo "<script>alert('servico realizado');</script>";   
		 }else{
			 echo "<script>alert('erro ao realizar servico');</script>";
		 }             
				}//fim do btFinalizarServico
				
				if(isset($_POST['btCadastrarOutorgante']))//se o botao enviar foi clicado
				{  
					$outorgante['out_cpf_cnpj'] = $this->input->post('outorgante_cpf');
					$outorgante['out_nome'] =  $this->input->post('outorgante_nome');
					$outorgante['out_rg'] =  $this->input->post('outorgante_rg');
					$outorgante['out_org_emissor']=  $this->input->post('outorgante_org_emissor');
					
				$res=$this->M_outorgante->save($outorgante);//salvando outorgante
				
				$out_cod = $this->M_outorgante->listarUltimo();//listando o ultimo despachante cadastrado
				
					 if($out_cod->num_rows()>0){//se ha registros nesse contato
					 foreach ($out_cod->result() as $value) {//lista esse registro
					 $cpf_cnpj_out = $value->out_codigo;//pega o codigo do ultimo
				 }
			 }
			 
			 if($res){
				echo "<script>alert('salvo com sucesso');</script>";
				
							$contato['con_out_cpf_cnpj']=$cpf_cnpj_out;//pega codigo despachante p salvar o contato
							$contato['con_tipo'] =  "outorgante";
							$contato['con_email'] = $this->input->post('contato_email');
							
							$con = $this->M_contato->save($contato);//salvando o contato
							
							$con_codigo = $this->M_contato->selectLast();//listando o ultimo contato cadastrado
							
							if($con_codigo->num_rows()>0){//se ha registro
									foreach ($con_codigo ->result()as $value) {//lista esse registro
											$cod_contato = $value->con_codigo;//pega o codigo do ultimo
										}
									}
									if($con){
										echo "<script>alert('contato salvo com sucesso');</script>";
										
										$numero['con_numero']=  $this->input->post('contato_numero');
										$numero['num_con_codigo']=$cod_contato;

								$num = $this->M_numero->save($numero);//salvando o numero
								if($num){echo "<script>alert('numero salvo');</script>";}else{echo "<script>alert('erro numero');</script>";}
								
							}else{
							 echo "<script>alert('erro no contato');</script>";
						 }
						 
					 }else{
						 echo "<script>alert('Erro ao salvar Outorgante');</script>";
					 }

				}//fim do cadastro do outorgante
				
				if(isset($_POST['btCadastrarVeiculo'])){
					
					$veiculo['vei_placa']=  $this->input->post('veiculo_placa');
					$veiculo['vei_marca']=  $this->input->post('veiculo_marca');
					$veiculo['vei_modelo']=  $this->input->post('veiculo_modelo');
					$veiculo['vei_ano']=  $this->input->post('veiculo_ano');
					$veiculo['vei_chassi']=  $this->input->post('veiculo_chassi');
					$veiculo['vei_renavam']=  $this->input->post('veiculo_renavam');
					$veiculo['vei_out_cpf']= $this->input->post('veiculo_outorgante_cpf');

					$return = $this->M_veiculo->save($veiculo);
					
					if($return){
						echo "<script>alert('veiculo salvo com sucesso');</script>";
					}else{
						echo "<script>alert('erro ao salvar veiculo');</script>";
					}

				}//fim do cadastrar veiculo
				

		}//fim do cadastrar*/
		
		function finalizarServico() {
		 $codigo = $_POST['codigo'];
		 $placa = $_POST['placa'];
		 $cpf = $_POST['cpf'];
		 
		 if($codigo){
			 echo '1';
		 }
		 $this->data['codigo']=$codigo;
		 
		 $this->load->view('servico/realizar_servico',$this->data);
		 
		}//fim do finalizarservico
		
		function segestions() {
			$placa =  $this->input->post('placa',true);
			$vei = $this->M_veiculo->selectPlaca($placa);
			$jsonArray = array();
			foreach ($vei as $value) {
			 array_push($jsonArray, $value->vei_placa);
			 echo json_encode($jsonArray);
		 }
		}//fim do sugestion
		
		
		function gerarQntKits(){
				 //$this->data['usuario']="";
			$this->data['title']="Kits";
			$lista = $this->M_servico->select();
			$this->data['listaServicos']=$lista;
			$this->load->view('layouts/default_header',  $this->data);
			$this->load->view('servico/index',$this->data);
			$this->load->view('layouts/default_footer',$this->data);
			
			if(isset($_POST['btEnviar'])){
				$mat = $this->input->post('des_matricula');
				$qnt = $this->input->post('quantidade');
				$contator=1;
				
				$data = date("Y-m-d");
				$hora = date('H:i:s');
				$servico['ser_des_matricula']= $mat;
				$servico['ser_out_cpf_cnpj'] = null;
				$servico['ser_vei_placa'] =  null;
				$servico['ser_pod_codigo'] = null;
				$servico['ser_data']=$data;
				$servico['ser_hora']=$hora;
				$res = $this->M_servico->save($servico);
				if($res){
					echo "<script>alert('salvo');</script>";
				}else{
					echo "<script>alert('erro');</script>";
				}
			}
			
		}

		function checkCHPs()
		{
			$qtd = $this->input->post('qtd');
			$tipoKit = $this->input->post('tipo');
			
			$dadosSalvarKit = $this->M_servico->getDadosSalvarKit($tipoKit); 	// pega dados da tabela tb_numero e o ultimo CHP do tipo $tipoKit
			if (!$dadosSalvarKit) 												// se não pegar dados
	        {
	        	$result[0] = 'x';												// salva codigo do erro 'x'
			    $result[1] = '';
			    $result[2] = 0;
	        	echo json_encode($result); 										// retorna o erro
			    exit();                       									// sai da função, não faz nada	
	        }
	        // $dadosSalvarKit['vIn'] 		: inicio da sequencia do CHP de veiculos
	        // $dadosSalvarKit['vFim'] 		: fim da sequencia do CHP de veiculos
	        // $dadosSalvarKit['cIn'] 		: inicio da sequencia do CHP de CNH
	        // $dadosSalvarKit['lastCHP'] 	: ultimo CHP do tipo $tipoKit registrado no banco ( = 'x' se nao encontrar registros )

	        $startCHP = '';
			if ($tipoKit == 'v') 
			{
				// $dadosSalvarKit['lastCHP'] : ultimo CHP
			    if ($dadosSalvarKit['lastCHP'] == 'x')          				// se não tiver nenhum Kit de veiculo registrado
			    {
			        $startCHP = $dadosSalvarKit['vIn']; 							// usa o valor inicial da sequencia
			        $result[0] = 1;
			        $result[1] = '';
			    } 
			    else 															// se tiver kits de veiculos registrados
			    {
			        $totalCHPs = $dadosSalvarKit['lastCHP'] + $qtd;      // ultimo CHP + quantidade
			        if ($totalCHPs > $dadosSalvarKit['vFim'])                  	// se a quantidade indicada passar o limite da sequencia
			        {
			        	$startCHP = $dadosSalvarKit['lastCHP'] + 1;
			            $count = ($dadosSalvarKit['vFim'] - $dadosSalvarKit['lastCHP']) - 1;

			            $result[0] = 'xx';										// salva o codigo do erro 'xx'
			            $result[1] = $totalCHPs - $dadosSalvarKit['vFim'];		// salva por quantos CHPs ultrapassou o limite
			            $result[2] = 0;
			        } 
			        else if ($totalCHPs < $dadosSalvarKit['vFim'])             	// se a quantidade indicada não passar o limite da sequencia
			        {
			        	$startCHP = $dadosSalvarKit['lastCHP'] + 1;				// calcula novo CHP de veiculos

			        	$dif = $dadosSalvarKit['vFim'] - $totalCHPs;			// calcula quantos CHP faltam para chegar ao limite da sequencia
			        	if ($dif > 20) 											// se faltarem mais de 20 CHPs
			        	{
			        		$result[0] = 1;
			        		$result[1] = '';
			        	} 
			        	else 													// se faltarem 20 ou menos CHPs
			        	{
			        		$result[0] = 2;
			        		$result[1] = $dif;
			        	}
			        }
			        else if ($totalCHPs == $dadosSalvarKit['vFim']) 
			        {
			        	$startCHP = $dadosSalvarKit['lastCHP'] + 1;				// calcula novo CHP de veiculos
			        	$result[0] = 2;
			        	$result[1] = 0;
			        }
			    }
			} 
			else if ($tipoKit == 'c')
			{
				// $dadosSalvarKit['lastCHP'] : ultimo CHP
				if ($dadosSalvarKit['lastCHP'] == 'x')
				{
					$startCHP = $dadosSalvarKit['cIn'];
				}
				else
				{
					$startCHP = $dadosSalvarKit['lastCHP'] + 1;
				}
				$result[0] = 1;
			    $result[1] = '';
			}

			echo json_encode($result);


		}

		function loadGerarKitOpt()
		{
			$res = $this->input->post('res');
			$qtd = $this->input->post('qtd');
			//parse_str($kit);

			$dadosSalvarKit = $this->M_servico->getDadosSalvarKit('v');
			// $dadosSalvarKit['vIn'] 		: inicio da sequencia do CHP de veiculos
	        // $dadosSalvarKit['vFim'] 		: fim da sequencia do CHP de veiculos
	        // $dadosSalvarKit['cIn'] 		: inicio da sequencia do CHP de CNH
	        // $dadosSalvarKit['lastCHP'] 	: ultimo CHP do tipo $tipoKit registrado no banco ( = 'x' se nao encontrar registros )

	        $difFimEnd = $dadosSalvarKit['vFim'] - $dadosSalvarKit['lastCHP'];

			$html = '';

			$html .= "<span class='pageTitle'>sequência CHP ultrapassada</span><hr>";
			$html .= "
				<table width='100%' cellpadding='0' cellspacing='0'>
					<tr>
						<td align='right' style='padding-right: 10px;'>quantidade indicada</td>
						<td><input type='text' class='input' disabled='disabled' value='".$qtd."' /></td>
					</tr>
					<tr>
						<td align='right' style='padding-right: 10px;'>último CHP utilizado</td>
						<td><input type='text' class='input' disabled='disabled' value='".$dadosSalvarKit['lastCHP']."' /></td>
					</tr>
					<tr>
						<td align='right' style='padding-right: 10px;'>sequência CHP atual</td>
						<td>
							<input type='text' class='input' disabled='disabled' value='".$dadosSalvarKit['vIn']."' />
							a
							<input type='text' class='input' disabled='disabled' id='seqFim' value='".$dadosSalvarKit['vFim']."' />
						</td>
					</tr>
				</table>
				<hr>
				<div id='divGerarKitBody'>
					<span style='text-align: justify;'>
						A quantidade indicada ultrapassa em <b>".$res[1]."</b> o limite da sequência. Você poderá escolher entre as seguintes opções:
					</span>
			";

			$html .= "
					<ul>
						<li><b>Gerar quantidade indicada (".$qtd." kits)</b><br>Gerar o kit usando os últimos códigos CHP da sequência atual e os códigos CHP de uma nova sequência. Será pedida uma nova sequência de códigos CHP.</li>
						<li><b>Gerar apenas ".$difFimEnd." kits</b><br>Gerar o kit usando <b>apenas</b> os últimos códigos CHP da sequência atual. Serão gerados apenas <b>".$difFimEnd."</b> kits.</li>
						<li><b>Cancelar</b><br> Voltar à tela anterior para alterar os campos.</li>
					</ul>
			";

			$html .= "
					<input class='formButton submit' type='button' value='gerar quantidade indicada' id='btGerarTodos' />
					<input class='formButton submit' type='button' value='gerar os ".$difFimEnd." kits' id='btGerarAlguns' />
					<input class='formButton cancel' type='button' value='cancelar' id='btGerarCancelar' />
				</div>
			";

			$html .= "
				<div id='divNovaSeq'>
					<form id='gerar' method='post'>
						<table width='100%' cellpadding='0' cellspacing='0'>
							<tr>
								<td colspan='2'><p style='margin: 5px 0px 5px 0px; text-align: justify;'>Por favor, cadastre abaixo uma nova sequência de números CHP de veiculos.<br>Quando terminar, pressione <b>gerar</b> para salvar a nova sequência e gerar os kits indicados.</p></td>
							</tr>
							<tr>
								<td align='right' style='padding-right: 10px; font-weight: bold;'>nova sequência CHP</td>
								<td>
									<input type='text' class='input' id='novaSeqIn' placeholder='".($dadosSalvarKit['vFim']+1)."' name='novaSeqIn' />
									a
									<input type='text' class='input' id='novaSeqFim' name='novaSeqFim' />
								</td>
							</tr>
						</table>
						<input class='formButton submit' type='button' value='gerar' id='btGerarTodosFinal' />
						<input class='formButton cancel' type='button' value='cancelar' id='btGerarCancelarFinal' />
					</form>
				</div>
			";

			echo $html;
		}

		function salvarNovaSeq($in, $fim) 										// salvar nova sequencia
		{
			$query = $this->M_servico->salvarNovaSequencia($in, $fim);
			return $query;
		}

		function checkSalvarKit($seq)
		{
			// $seq = 1: salvar nova sequencia e gerar os kits
			// $seq = 0: apenas gerar os kits
			$dados = json_decode($this->input->post('formKit'));

			//$dadosSalvarKit = $this->M_servico->getDadosSalvarKit();

			if ($seq == 0) 
			{
				echo json_encode($dados);
			} 
			else if ($seq == 1) 
			{
				$newSeqIn = $this->input->post('inicio');
				$newSeqFim = $this->input->post('fim');

				if ($this->salvarNovaSeq($newSeqIn, $newSeqFim)) 
				{
					$kits = $this->gerarArrayKits($seq, $dados); 		// gerar array de todos os kits a salvar
					$this->salvarKits($kits); 							// apenas inserir o array $kits no banco
					//echo 'passed';
					
				} 
				else 
				{
					//echo 'not passed';
					// echo erro ao salvar nova sequencia
				}
			}
		}	

		function gerarArrayKits($seq, $dados)
		{

		}	

		function salvarKits($kits)
		{

		}


// -------------------------------------------------------------------------------------------------------------------------------
// NAO USADO --------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------	
/*

		function salvarKit()
		{
			$kit = json_decode($this->input->post('kit'), true);
			parse_str($kit);

			//quantidade
            //valorKit
            //despachante
            //numPag
            //checkProcuracao
            //checkRequerimento
            //checkEtiqueta
            //tipoPagamento
            //tipoKit
	        

			$result = array('','');                             				// [0] 		: resultado                                     [1] - info 								[2] - salvou?
																				// --------------------------------------------------------------------------------------------------------------------------
				        														// = 'x' 	: erro ao pegar dados iniciais					= ''									= 0 : não salvou
																				//			: nao fez nada
						                                                    	// = 'xx' 	: passou limite da sequencia 					= por quantos passou o limite 			= 0 : não salvou
																				//			: nao fez nada    
						                                                    	// = 1 		: não passou limite da sequencia				= ''									= 1 : salvou
																				//			: faltam mais de 20 CHPs para atingir limite
																				// = 2 		: não passou limite da sequencia				= quantos faltam para atingir o limite 	= 1 : salvou
																				// 			: faltam 20 ou menos CHPs para atingir limite
																				// --------------------------------------------------------------------------------------------------------------------------------

	        $dadosSalvarKit = $this->M_servico->getDadosSalvarKit($tipoKit); 	// pega dados da tabela tb_numero e o ultimo CHP do tipo $tipoKit
	        if (!$dadosSalvarKit) 												// se não pegar dados
	        {
	        	$result[0] = 'x';												// salva codigo do erro 'x'
			    $result[1] = '';
			    $result[2] = 0;
	        	echo json_encode($result); 										// retorna o erro
			    exit();                       									// sai da função, não faz nada	
	        } 
	        // $dadosSalvarKit['vIn'] 		: inicio da sequencia do CHP de veiculos
	        // $dadosSalvarKit['vFim'] 		: fim da sequencia do CHP de veiculos
	        // $dadosSalvarKit['cIn'] 		: inicio da sequencia do CHP de CNH
	        // $dadosSalvarKit['lastCHP'] 	: ultimo CHP do tipo $tipoKit registrado no banco ( = 'x' se nao encontrar registros )

	        
	        $startCHP = '';
			if ($tipoKit == 'v') 
			{
				// $dadosSalvarKit['lastCHP'] : ultimo CHP
			    if ($dadosSalvarKit['lastCHP'] == 'x')          				// se não tiver nenhum Kit de veiculo registrado
			    {
			        $startCHP = $dadosSalvarKit['vIn']; 							// usa o valor inicial da sequencia
			        $result[0] = 1;
			        $result[1] = '';
			    } 
			    else 															// se tiver kits de veiculos registrados
			    {
			        $totalCHPs = $dadosSalvarKit['lastCHP'] + $quantidade;      // ultimo CHP + quantidade
			        if ($totalCHPs > $dadosSalvarKit['vFim'])                  	// se a quantidade indicada passar o limite da sequencia
			        {
			        	$startCHP = $dadosSalvarKit['lastCHP'] + 1;
			            $count = ($dadosSalvarKit['vFim'] - $dadosSalvarKit['lastCHP']) - 1;

			            $result[0] = 'xx';										// salva o codigo do erro 'xx'
			            $result[1] = $totalCHPs - $dadosSalvarKit['vFim'];		// salva por quantos CHPs ultrapassou o limite
			            $result[2] = 0;
			        } 
			        else if ($totalCHPs < $dadosSalvarKit['vFim'])             	// se a quantidade indicada não passar o limite da sequencia
			        {
			        	$startCHP = $dadosSalvarKit['lastCHP'] + 1;				// calcula novo CHP de veiculos

			        	$dif = $dadosSalvarKit['vFim'] - $totalCHPs;			// calcula quantos CHP faltam para chegar ao limite da sequencia
			        	if ($dif > 20) 											// se faltarem mais de 20 CHPs
			        	{
			        		$result[0] = 1;
			        		$result[1] = '';
			        	} 
			        	else 													// se faltarem 20 ou menos CHPs
			        	{
			        		$result[0] = 2;
			        		$result[1] = $dif;
			        	}
			        }
			        else if ($totalCHPs == $dadosSalvarKit['vFim']) 
			        {
			        	$startCHP = $dadosSalvarKit['lastCHP'] + 1;				// calcula novo CHP de veiculos
			        	$result[0] = 2;
			        	$result[1] = 0;
			        }
			    }
			} 
			else if ($tipoKit == 'c')
			{
				// $dadosSalvarKit['lastCHP'] : ultimo CHP
				if ($dadosSalvarKit['lastCHP'] == 'x')
				{
					$startCHP = $dadosSalvarKit['cIn'];
				}
				else
				{
					$startCHP = $dadosSalvarKit['lastCHP'] + 1;
				}
				$result[0] = 1;
			    $result[1] = '';
			}






			$data = date("Y-m-d");
	        $hora = date('H:i:s');

	        $arrayKits = array();
	        $chpKit = $startCHP;
	        for ($i=0; $i < $quantidade; $i++) 
	        { 
	        	$kit = array();
	        	$kit['ser_data'] = $data;
	        	$kit['ser_hora'] = $hora;
	        	$kit['ser_valor'] = $valorKit;
	        	$kit['ser_des_codigo'] = $despachante;
	        	
	        	$kit['ser_tipo'] = $tipoKit;
	        	$kit['ser_estado'] = 'normal';
	        	$kit['ser_num_comp_pag'] = $numPag;
	        	$kit['ser_tipoPag'] = $tipoPagamento;

	        	if ($result[0] == 'xx') 
	        	{
	        		if ($i <= $count) 
	        		{
	        			$kit['ser_chp'] = $chpKit;
	        		} 
	        		else 
	        		{
	        			$kit['ser_chp'] = '';
	        		}
	        	} 
	        	else 
	        	{
	        		$kit['ser_chp'] = $chpKit;
	        	}

	        	$arrayKits[] = $kit;

	        	$chpKit++;
	        }

	        if ($result[0] == 'xx') 
	        {
	        	$result[3] = $arrayKits;
	        	echo json_encode($result);
	        } 
	        else 
	        {
	        	$res = $this->M_servico->save($arrayKits);
				if($res)
				{
					$result[2] = 1;
					//$this->data['gerados'] = $ser_gerados;
					//$this->data['dadosDesp'] = $this->M_servico->dadosProcuracao($codDesp);
					//$this->load->view('servico/procuracao',$this->data);
				}
				else
				{
					$result[2] = 0;
				}
				echo json_encode($result);
	        }
		}
*/
// -------------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------	
				
		function listando() {
			$this->data['title']="Kits";
			
			$this->data['listaServicos'] = $this->M_servico->select();
			$this->data['total'] = $this->M_servico->selectTotal();
			$this->load->view('layouts/default_header',  $this->data);
			$this->load->view('servico/lista',$this->data);
			$this->load->view('layouts/default_footer',$this->data);
		}
		
		function relatorio_kits() {

			
			$this->data['title']="Relatório Kits";

			$mes = date("m");
			$ano= date("Y");
			
			$tipo = "";
			$status = "";
			$diasservicos =  $this->M_servico->diasServico($mes,$ano,$status,$tipo);
			$this->data['dias']=$diasservicos;//funcao p retornar a qtd de servicos por dia
			
			$userServico = $this->M_servico->selectPorDia();
			$this->data['userservico']=$userServico; //funcao para retornar os despachante que realizaram servicos nos dias determinados

			$this->load->view('layouts/default_header',$this->data);
			$this->load->view('servico/relatorio_kit',$this->data);
			$this->load->view('layouts/default_footer',$this->data);
			
			//$mes = $this->input->post('months');
			//if($mes){
			//    echo '1';
			//}else{
			//    echo '2';
			//}
		}
			
		function kitShowValor() 
		{
			$valor=$this->M_servico->kitValor_select();
			$this->data['valor']=$valor;
			$this->data['title']="Confgurar";
			$this->load->view('servico/kit_valor',$this->data);
		}
		
		function kitUpdateValor() {
			$valor = $this->input->post('kitvalor');
			$edit = $this->M_servico->kitValor_editar($valor);
			if($edit)
			{
				echo "1";
			}
			else
			{
			 	echo "2";
		 	}        
		}


		function relatorio_filtrado()
		{
			$mes = $this->input->post("months");
			$ano = $this->input->post("year");
			$status = $this->input->post("status");
			$tipo = $this->input->post("tipo");

			if(empty($mes))
			{
				$mes = date ("m");	
			}
			if(empty($ano))
			{
				$ano = date ("Y");
			}
			if($status == '')
			{
				$ser_status = "";	
			}
			else
			{
				$ser_status = "AND ser_estado = '".$status."'";
			}
			if($tipo == '')
			{
				$ser_tipo ="";
			}
			else
			{
				$ser_tipo = "AND ser_tipo = '".$tipo."'";
			}
			

			//print_r($mes."/".$ano."|".$status."|".$tipo);
			//exit();
		
			$dias =  $this->M_servico->diasServico($mes,$ano,$ser_tipo,$ser_status);
				//$this->data['dias']=$diasservicos;//funcao p retornar a qtd de servicos por dia

			if($dias->num_rows()<=0){
				
				
				$htmlPage = "<tr><td colspan='3'>Não existem registros a apresentar para as definições indicadas. Por favor reveja os filtros de pesquisa acima.</td></tr>";
				

			}else{

				$userservico = $this->M_servico->selectPorDia();
				//$this->data['userservico']=$userServico; //funcao para retornar os despachante que realizaram servicos nos dias determinados
				
				$htmlPage = '<colgroup></colgroup>
				<colgroup></colgroup>
				<colgroup></colgroup>';

				if ($dias->num_rows() > 0) {
					foreach ($dias->result() as $value) 
					{         
						$htmlPage .= "<colgroup></colgroup>";
					}
				}
				
				$htmlPage .=' <colgroup></colgroup>
				<colgroup></colgroup>
				<thead class="theadlistar">
				<tr>
					<th width="40" class="titleMain">Nº</th>
					<th width="50" class="titleMain">MAT. CRDD</th>
					<th width="150" class="titleMain" style="border-right: 2px solid #00661B;">NOME</th>
					';
					
					if ($dias->num_rows() > 0) {
						foreach ($dias->result() as $value) 
						{
							if ($value->ser_data < 10) {
								$dia = '0'.$value->ser_data;
							} else {
								$dia = $value->ser_data;
							}
							
							$htmlPage .='<th class="titleDia">DIA '. $dia.'</th>';
						}
					}
					
					
					
					$htmlPage .=  '<th width="70" class="titleMain" style="border-left: 2px solid #00661B;">TOTAL MENSAL</th>
					<th width="100" class="titleMain">VALOR MENSAL</th>
				</tr>
			</thead>
			<tbody class="tbodylistar">
				';
				
				$valorTotalFinal = 0;
				$qtdtotal=0;
				if ($userservico->num_rows() > 0) {
					$index = 1;

					foreach ($userservico->result()as $linha) {
						
						
					 $htmlPage .=' <tr>
					 <td align="center">'.$index.'</td>
					 <td align="center">'.$linha->des_matricula.'</td>
					 <td style="font-size: 12px; border-right: 2px solid #00661B;">'.$linha->des_nome.'</td>
					 ';
					 
					 if ($dias->num_rows() > 0) 
					 {
					 	$c = 0;
						foreach ($dias->result() as $value) 
						{
							$this->load->model("M_servico");
							$cont = $this->M_servico->somenteqtd($value->data, $linha->ser_des_codigo, $ser_status, $ser_tipo);
							
							$total = $this->M_servico->totalServicoDesp($mes,$ano, $linha->ser_des_codigo, $ser_status, $ser_tipo);

							if ($total->num_rows() > 0) 
							{
								if ($total->row()->total == 0) {
									$row = '-';
								} else {
									$row = $total->row()->total;
								}
								if ($total->row()->valorfinal == '') {
									$valorFinal = '-';
								} else {
									$valorFinal = $total->row()->valorfinal;
									if ($c < 1) {
										$valorTotalFinal += $valorFinal;
										$c++;
									}
									
								}
								
							}
							if ($cont->num_rows() > 0) 
							{
								foreach ($cont->result() as $contador) 
								{
									$htmlPage .= '<td align="center" class="qtd">'.$contador->qtd.'</td>';
								}
							} 
							else 
							{
								$htmlPage .= "<td class='qtd' align='center'><b>-</b></td>";
							}
						}
					}
					
					$htmlPage .='<td align="center" style="border-left: 2px solid #00661B;">'.$row.'</td>
					<td align="center">'.$valorFinal.'</td>
				</tr>
				';
				
				$index++;
			}
		} 
		else 
		{
			$htmlPage .= "<tr><td colspan='36'>Nada Encontrado</td></tr>";
		}
		
		$htmlPage .= '
	</tbody>
	<tfoot id="foot">
		<tr id="trqtd_total">
			<td colspan="3" style="background: transparent; font-weight: bold; text-align: right; border-right: 2px solid #00661B;">QUANTIDADE TOTAL DIA</td>
			';
			if ($dias->num_rows() > 0) 
			{
				foreach ($dias->result() as $value) 
				{
					$qtdtotal= $qtdtotal + $value->qtddia;
					
					$htmlPage .='<td>'.$value->qtddia.'</td>';
				}
			}
			$htmlPage .= '
			<td style="border-left: 2px solid #00661B;">'.$qtdtotal.'</td>
			<td>-</td>
		</tr>
		<tr id="trvalor_dia">
			<td colspan="3" style="background: transparent; font-weight: bold; text-align: right; border-right: 2px solid #00661B;">VALOR TOTAL DIA</td>
			';

			if ($dias->num_rows() > 0) 
			{
				foreach ($dias->result() as $value) 
				{
				 $htmlPage .= '<td style="font-size: 12px;">'.$value->valorDia.'</td>';
			 }
		 }

		 $htmlPage .= '<td align="center" style="border-left: 2px solid #00661B;">-</td>
		 <td>'.number_format($valorTotalFinal, 2).'</td>
	 </tr>
 </tfoot>
 ';
}
echo $htmlPage;    
}






}