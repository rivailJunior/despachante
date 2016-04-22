<?php

class Outorgante extends CI_Controller{

    private $data = array();
    
     function __construct() {
    parent::__construct();
    
        if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/Login/show_login');
    }
  
                $this->load->model('M_outorgante');
                $this->load->library('Form_validation');
                $this->load->model('M_empresa');
                $this->load->model('M_contato');
                $this->load->model('M_numero');
                $this->load->model('M_endereco');
                $this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
  }
    function index() {
    
        $this->data['title']="Outorgante";
        $this->data['content']="conteudo do autorgante";
        
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('outorgante/index',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }

    function novo()
    {
        $this->data['uf'] = $this->M_outorgante->listar_uf();
        $this->load->view('outorgante/cadastrar_outorgante',$this->data);
    }
    
    function cadastrar() 
    {  
       //DADOS PESSOAIS
        $outorgante['out_cpf_cnpj']     = $this->input->post('outorgante_cpf');
        $outorgante['out_rg']           = $this->input->post('outorgante_rg');
        $outorgante['out_org_emissor']  = $this->input->post('outorgante_org_emissor');
        $outorgante['out_nome']         = $this->input->post('outorgante_nome');
        $outorgante['out_telefone']     = $this->input->post('outorgante_telefone');
        $outorgante['out_celular']      = $this->input->post('outorgante_celular');
        $outorgante['out_email']        = $this->input->post('outorgante_email');
        
        //ENDERECO
        $endereco['end_descricao']      = $this->input->post('end_descricao');
        $endereco['end_complemento']    = $this->input->post('end_complemento');
        $endereco['end_bairro']         = $this->input->post('end_bairro');
        $endereco['end_cep']            = $this->input->post('end_cep');
        $endereco['end_codmunicipio']   = $this->input->post('end_municipio');
        $endereco['end_coduf']          = $this->input->post('end_uf');

        $query = $this->M_outorgante->save($outorgante, $endereco);        //salvando outorgante  
        //$query2 = $this->M_contato->save($contato);             //salvando o contato
        //$query4 = $this->M_endereco->saveendereco($endereco);   //salvando o numero
       

        //$this->load->view('despachante/lista',$this->data);

        if ($query) 
        {
            echo "<script>alert('Outorgante salvo com sucesso!');</script>";
            redirect('administrador/outorgante/listar', 'refresh');
        }
        else
        {
            echo "<script>alert('Erro!');</script>";
        }
     
    }//fim create
    
    function listar() {
        $this->data['title']="Outorgantes";
        $this->data['lista_outorgante']=$this->M_outorgante->listar();
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('outorgante/Listar_outorgante',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
        
    }

    function editar($codigo)
    {
         $this->data['query'] = $this->M_outorgante->editar($codigo);
         $this->load->view('outorgante/update_outorgante',$this->data);
    }

    function update($codigo){
    if(isset($_POST['btEnviar']))//se o botao enviar foi clicado
        {  
        //echo $codigo;
        $outorgante['out_cpf_cnpj']    = $codigo;
        $outorgante['out_nome']        =  $this->input->post('outorgante_nome');
        $outorgante['out_rg']          =  $this->input->post('outorgante_rg');
        $outorgante['out_org_emissor'] =  $this->input->post('outorgante_org_emissor');
    
        //CONTATO
        $contato['con_codigo']   = $this->input->post('con_codigo');
        $contato['con_email']    = $this->input->post('contato_email');
        $contato['con_telefone'] = $this->input->post('contato_numero');
        
        //ENDERECO
        $endereco['end_codigo']       = $this->input->post('end_codigo');
        $endereco['end_descricao']    = $this->input->post('end_descricao');
        $endereco['end_complemento']  = $this->input->post('end_complemento');
        $endereco['end_bairro']       = $this->input->post('end_bairro');
        $endereco['end_cep']          = $this->input->post('end_cep');
        $endereco['end_out_cpf_cnpj'] = $outorgante['out_cpf_cnpj'];
        
        $sql=$this->M_outorgante->update($codigo,$outorgante);
        $this->M_contato->updatecontato($contato['con_codigo'],$contato);
        $this->M_endereco->updateendereco($endereco['end_codigo'],$endereco);
        
        if($sql){
           echo "<script>alert('alterado');</script>"; 
        }

       }

        redirect('administrador/outorgante/listar', 'refresh');

        }//fim do alteracao do outorgante

        
    function excluir()
    {
        $codigo = $_POST['codigo'];
        $excluir = $this->M_outorgante->delete($codigo);
        if($excluir){
            echo '1';
        }else{
            echo '0';
        }
    }//fim excluir

    function listarMunicipios($codigouf)
    {
        if ($codigouf == '') 
        {
           echo '<option value="">Selecione primeiro a UF</option>';
        }
        else 
        {
            $options = '<option value="">Selecione</option>';
            $query = $this->M_outorgante->listar_municipios($codigouf);
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row) 
                {
                    $options .= '<option '.$select.' value="'.$row->codigo.'">'.$row->nome.'</option>';
                }
                echo $options;
            }
            else
            {
                echo '0';
            }
        }     
    }

}