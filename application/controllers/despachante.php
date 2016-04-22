<?php

class Despachante extends CI_Controller {

    private $data = array();

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('isLoggedIn')) 
    {
            redirect('/Login/show_login');
        }
        $this->load->helper('form');
        $this->load->model('M_despachante');
        $this->load->library('Form_validation');
        $this->load->model('M_empresa');
        $this->load->model('M_contato');
        $this->load->model('M_numero');
        $this->load->model('M_endereco');
        $this->load->model('M_servico');
        $this->data['usuario'] = $this->session->userdata('isLoggedIn', 'nome');
    }

    function index() 
    {
        $mes = date("m");
        $ano= date("Y");
        
        $tipo = "";
        $status = "";
        $diasservicos =  $this->M_servico->diasServico($mes,$ano,$status,$tipo);
        $this->data['dias']=$diasservicos;//funcao p retornar a qtd de servicos por dia
        
        $userServico = $this->M_servico->selectPorDia();
        $this->data['userservico']=$userServico; //funcao para retornar os despachante que realizaram servicos nos dias determinados

        switch ($mes) {
            case '01':
                $this->data['mes'] = "Janeiro";
                break;
            case '02':
                $this->data['mes'] = "Fevereiro";
                break;
            case '03':
                $this->data['mes'] = "Março";
                break;
            case '04':
                $this->data['mes'] = "Abril";
                break;
            case '05':
                $this->data['mes'] = "Maio";
                break;
            case '06':
                $this->data['mes'] = "Junho";
                break;
            case '07':
                $this->data['mes'] = "Julho";
                break;
            case '08':
                $this->data['mes'] = "Agosto";
                break;
            case '09':
                $this->data['mes'] = "Setembro";
                break;
            case '10':
                $this->data['mes'] = "Outubro";
                break;
            case '11':
                $this->data['mes'] = "Novembro";
                break;
            case '12':
                $this->data['mes'] = "Dezembro";
                break;
            default:
                $this->data['mes'] = "Mês atual";
                break;
        }

        $this->data['title'] = "ADAPT Despachante";
        $this->load->view('layouts/default_header', $this->data);
        $this->load->view('despachante/index', $this->data);
        $this->load->view('layouts/default_footer', $this->data);
    }

    function create() 
    {
        $this->data['title'] = "Cadastro";
        $this->data['uf'] = $this->M_despachante->listar_uf();
        $this->load->view('despachante/create', $this->data);
    }

//fim do create



    function salvarteste()//salva os dados do despachante 
    {
            
            $campo = json_decode($this->input->post("campo"),true);
            parse_str($campo);
            //echo json_encode($campo);


            $matricula = $despachante_matricula;

           if(isset($check_empresa)){ 
            $existe_empresa=$check_empresa;
        }else{
            $existe_empresa="nao";
        }

            if ($matricula != "") {
                $matricula = $matricula;
            } else {
                $sql = $this->M_despachante->selectMatriculaLast();
                if ($sql->num_rows > 0) {
                    $row = $sql->row();
                    $val = $row->des_matricula;
                    $matricula = $val + 1;
                }
            }

            $despachante['des_matricula'] = $matricula;
            
            $cpf= $despachante_cpf;
            $cpf  = preg_replace("/\D+/", "", $cpf);
            $celular = $des_celular;
            $celular = preg_replace("/\D+/","",$celular);
            
            $datanascimento = $this->convertDate($despachante_data_nascimento);          
                  
            $despachante['des_matricula_SINDESAM']= $des_matricula_SINDESAM;
            $despachante['des_nome'] = $despachante_nome;
            $despachante['des_estado_civil'] = $despachante_estado_civil;
            $despachante['des_nome_pai'] = $despachante_nome_pai;
            $despachante['des_nome_mae'] = $despachante_nome_mae;
            $despachante['des_cod_naturalidade'] = $despachante_naturalidade;
            $despachante['des_forma_ingresso'] = $despachante_forma_ingresso;
            $despachante['des_data_nascimento'] = $datanascimento;
            $despachante['des_rg'] = $despachante_rg;
            $despachante['des_orgao_emissor'] = $despachante_rg_orgao_emissor;
            $despachante['des_cpf'] = $cpf;
            $despachante['des_grau_instrucao'] = $despachante_grau_de_instrucao;
            $despachante['des_titulo_eleitoral'] = $despachante_titulo_eleitoral;
            $despachante['des_zona_eleitoral'] = $despachante_titulo_eleitoral_zona;
            $despachante['des_sessao_eleitoral'] = $despachante_titulo_eleitoral_sessao;
            $despachante['des_sexo'] = $despachante_sexo;
            $despachante['des_telefone'] = preg_replace("/\D+/","",$des_telefone);
            $despachante['des_email']=$des_email;
            $despachante['des_celular']= preg_replace("/\D+/","",$celular);
            $data = date("Y-m-d");
            //$hora = date('H:i:s');
            $despachante['des_data_ingresso'] = $data;
            
            $endereco['end_codmunicipio'] =  $municipio;
            $endereco['end_coduf'] =  $uf;
            $endereco['end_complemento'] =  $end_complemento;
            $endereco['end_bairro'] =  $end_bairro;
            $endereco['end_descricao'] =  $end_descricao;
            $endereco['end_cep'] = preg_replace("/\D+/","",$end_cep);


            $empresa['emp_nome']=$des_emp_nome;
            $empresa['emp_cnpj']=$des_emp_cnpj;
            $empresa['emp_rua']=$des_emp_endereco;
            $empresa['emp_bairro']=$end_emp_bairro;
            $empresa['emp_complemento']=$des_emp_complemento;
            $empresa['emp_cep']=preg_replace("/\D+/","",$des_emp_cep);
            $empresa['emp_uf_codigo']=$des_uf_empresa;
            $empresa['emp_mun_codigo']=$des_empresa_municipio;
            $empresa['emp_telefone']= preg_replace("/\D+/","",$des_emp_telefone);
            $empresa['emp_fac_simile']=$des_emp_fac_simile;
            $empresa['emp_regiao_seccional']=$des_emp_reg_seccional;
            
            $res = $this->M_despachante->save($despachante,$endereco,$empresa,$existe_empresa); 
            //salvando o despachante
            if($res){
                echo "1";
                //redirect('despachante/listar');
            }else{
                echo "0";
            }

        
    }//fim d0 salvar


    function listar() 
    {
        $this->data['title'] = "Lista Despachante";
        $lista = $this->M_despachante->listar();
        $this->data['lista_despachante'] = $lista;
        $this->load->view('layouts/default_header', $this->data);
        $this->load->view('despachante/lista', $this->data);
        $this->load->view('layouts/default_footer', $this->data);
    }//fim listar



    function esqueciSenha() 
    {
        $this->load->view('despachante/lista', $this->data);
    }


    function editarStatus() {//function p excluir despachante
        $codigo = $_POST['codigo'];
        $status = "0";
        $editar = $this->M_despachante->editaStatus($codigo,$status);
        if ($editar) {
            echo '1';
        } else {
            echo '0';
        }
    }//fim excluir


    

    function editar($codigo) {// abre a view editar

        $this->data['title'] = "Atualizar";
        $this->data['description'] = "Atulize um novo despachante";
        $this->data['query'] = $this->M_despachante->editar($codigo);
        
        $data=$this->data['query']->row();
        $this->data['datanascimento']=$this->re_convertDate($data->des_data_nascimento);
        

        $this->data['uf'] = $this->M_despachante->listar_uf();
        
        $cidadeRes = $this->data['query']->row();
        $this->data['queryCidade'] = $this->M_despachante->listar_municipios($cidadeRes->uf_codigo);
        $this->data['queryCidade2'] = $this->M_despachante->listar_municipios($cidadeRes->end_coduf);
        $this->data['queryCidade3'] = $this->M_despachante->listar_municipios($cidadeRes->emp_uf_codigo);
        $this->load->view('despachante/update', $this->data);
    }//fim do editar





    function atualizaTeste() //atualiza o ficheiro do despachante
    {
        
       // $codigo = $this->input->post('codigo');
       
        $campo = json_decode($this->input->post('campo'), true);

        parse_str($campo);

        $codigo = $codigo_despachante;

        $cpf= $despachante_cpf;

        
        $cpf  = preg_replace("/\D+/", "", $cpf);
        $celular = $des_celular;
        $celular = preg_replace("/\D+/","",$celular);
        $rg = $despachante_rg;
        $rg = preg_replace("/\D+/", "", $rg);
        $datanascimento = $despachante_data_nascimento;
        
        $datanascimento = $this->convertDate($datanascimento);



        $despachante['des_matricula'] = $des_matricula;
        $despachante['des_matricula_SINDESAM']= $des_matricula_SINDESAM;
        $despachante['des_nome'] = $despachante_nome;
        $despachante['des_estado_civil'] = $despachante_estado_civil;
        $despachante['des_nome_pai'] = $despachante_nome_pai;
        $despachante['des_nome_mae'] = $despachante_nome_mae;
        $despachante['des_cod_naturalidade'] = $des_naturalidade;
        $despachante['des_forma_ingresso'] = $despachante_forma_ingresso;
        $despachante['des_data_nascimento'] = $datanascimento;
        $despachante['des_rg'] = $rg;
        $despachante['des_orgao_emissor'] = $despachante_rg_orgao_emissor;
        $despachante['des_cpf'] = $cpf;
        $despachante['des_estado_civil'] = $despachante_estado_civil;
        $despachante['des_grau_instrucao'] = $despachante_grau_de_instrucao;
        $despachante['des_titulo_eleitoral'] = $despachante_titulo_eleitoral;
        $despachante['des_zona_eleitoral'] = $despachante_titulo_eleitoral_zona;
        $despachante['des_sessao_eleitoral'] = $despachante_titulo_eleitoral_sessao;
        $despachante['des_sexo'] = $despachante_sexo;
        $despachante['des_telefone'] =preg_replace("/\D+/", "",$des_telefone);
        $despachante['des_email']=$des_email;
        $despachante['des_celular']=  $celular;
        $despachante['des_cod_end']=  $end_codigo;
        $data = date("Y-m-d");
     
      
        $codigoendereco = $end_codigo;
        $endereco['end_descricao'] = $end_descricao;
        $endereco['end_complemento'] = $end_complemento;
        $endereco['end_bairro'] = $end_bairro;
        $endereco['end_cep'] = preg_replace("/\D+/", "",$end_cep);
        $endereco['end_codmunicipio']=  $end_cod_mun;
        $endereco['end_coduf']= $uf;


        if(isset($emp_codigo)){
            $codigoempresa=$emp_codigo;
        }
           
            $empresa['emp_nome']=$des_emp_nome;
            $empresa['emp_cnpj']=$des_emp_cnpj;
            $empresa['emp_rua']=$des_emp_endereco;
            $empresa['emp_bairro']=$end_emp_bairro;
            $empresa['emp_complemento']=$des_emp_complemento;
            $empresa['emp_cep']= preg_replace("/\D+/", "",$des_emp_cep);
            $empresa['emp_uf_codigo']=$des_uf_empresa;
            $empresa['emp_mun_codigo']=$des_empresa_municipio;
            $empresa['emp_telefone']= preg_replace("/\D+/", "",$des_emp_telefone);
            $empresa['emp_fac_simile']=$des_emp_fac_simile;
            $empresa['emp_regiao_seccional']=$des_emp_reg_seccional;

            
           if(isset($check_empresa)){
            $check_empresa="sim";
           }else{
            $check_empresa="nao";
           }

            //echo json_encode($empresa);

        
        $return = $this->M_despachante->update($codigoendereco,$endereco,$codigo,$despachante,$codigoempresa,$empresa,$check_empresa);
       
        if($return)
        {
            echo "1";
        }
        else
        {
            echo 0;
        }

     
    }//FIM DO UPDATE

    function imprimir($codigo) 
    {

        $this->data['title'] = "Imprimir";
        $this->data['description'] = "Imprimir um novo despachante";
        $this->data['query'] = $this->M_despachante->editar($codigo);
        $this->data['uf'] = $this->M_despachante->listar_uf();

        $data=$this->data['query']->row();
        $this->data['datanascimento']=$this->re_convertDate($data->des_data_nascimento);
         
        $cidadeRes = $this->data['query']->row();
        
        $this->data['queryCidade'] = $this->M_despachante->listar_municipios($cidadeRes->uf_codigo);
        $this->data['queryCidade2'] = $this->M_despachante->listar_municipios($cidadeRes->end_coduf);
        $this->data['queryCidade3'] = $this->M_despachante->listar_municipios($cidadeRes->emp_uf_codigo);
        
        
        $this->load->view('despachante/imprimir', $this->data);
    }//fim listar

    function check_matricula() //verifica se existe matricula cadastrado no banco
    {
        $mat = $this->input->post('matricula');
        $sql = $this->M_despachante->selectMatricula($mat);
        if ($sql) {
            echo '1';
        } else {
            echo '0';
        }
    }//fim da function

     function check_cpf() //verifica se existe matricula cadastrado no banco
    {
        $mat = $this->input->post('cpf');
         $mat  = preg_replace("/\D+/", "", $mat);
        $sql = $this->M_despachante->selectCpf($mat);
        if ($sql) {
            echo '1';
        } else {
            echo '0';
        }
    }//fim da function

 function check_rg() //verifica se existe matricula cadastrado no banco
    {
        $mat = $this->input->post('rg');
        $mat  = preg_replace("/\D+/", "", $mat);
        $sql = $this->M_despachante->selectRg($mat);
        if ($sql) {
            echo '1';
        } else {
            echo '0';
        }
    }//fim da function



    function check_email()//verifica se existe email no banco
     {
        $email = $this->input->post('email');
        $sql = $this->M_contato->selectMatricula($email);
        if ($sql) {
            echo '1';
        } else {
            echo '0';
        }
    }//fim da function

    
    function listarMunicipios($codigouf)
	{
		
        $query = $this->M_despachante->listar_municipios($codigouf);
        $result = '';
        if ($query->num_rows() > 0) 
        {
            $result .= '<option value="">Selecione</option>';
            foreach ($query->result() as $row)
            {
                $result .= '<option value="'.$row->codigo.'">'.$row->nome.'</option>';
            }
        }
        else 
        {
            
            $result .= '<option value="">Selecione</option>';
        }
        echo $result;
		//$this->load->view('despachante/listaMunicipios',$dados);
	}//fim da function


    function convertDate($inputdate) //inputdate format dd/mm/yyyy
    { 
        $date=explode('/',$inputdate);
        $dated=$date[2].'-'.$date[1].'-'.$date[0];
        return $dated; //dated format yyyy-mm-dd
    }

    function re_convertDate($inputdate) //inputdate format yyyy-mm-dd
    { 
        $date=explode('-',$inputdate);
        $dated=$date[2].'/'.$date[1].'/'.$date[0];
        return $dated; //dated format dd/mm/yyyy
    }
  

}//fim da class

?>
