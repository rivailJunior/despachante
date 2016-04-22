<?php

class Veiculo extends CI_Controller {

    private $data = array();
    
   function __construct() {
        parent::__construct();
    
  
             if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/Login/show_login');
    }
                $this->load->model('M_despachante');
                $this->load->library('Form_validation');
                $this->load->model('M_empresa');
                $this->load->model('M_veiculo');
                $this->load->model('M_contato');
                $this->load->model('M_numero');
                $this->load->model('M_outorgante');
                $this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
    }
    function index() {
     
        
        $this->data['title']="Veiculo";
        $this->data['content']="Conteudo Veiculo";
        
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('veiculo/index',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }
    
    /*
      pagina nao requisitada no sistema, caso sim, atualizar o formulario e o controller
    function cadastrar() {
        $this->data['title']="Cadastro Veiculo";
      
        if(is_array($_POST) && count($_POST)>0){
            $data= $_POST;
            $res =  $this->M_veiculo->save($data);
            
            if($res){
                echo "<script>alert('salvo com sucesso')</script>";
            }else{
                 echo "<script>alert('erro')</script>";
            }
        }
        
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('veiculo/cadastrar_veiculo',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }*/
    
    function listar() {
        $this->data['title']="Listando Veiculos";
        $lista=$this->M_veiculo->listar();
        $this->data['listando_veiculos']=$lista;
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('veiculo/Listar_veiculo',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }
   
    
    function delete() 
    {
        $placa = $_POST['codigo'];
        $sql =  $this->M_veiculo->delete($placa);
        if($sql){
            echo '1';  
        }else{
            echo '2';
        }
    }

}
