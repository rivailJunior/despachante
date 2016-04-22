<?php

class Empresa extends CI_Controller {

    private $data = array();
            
    function __construct() {
        parent::__construct();
    
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/Login/show_login');
    }
                $this->load->model('M_despachante');
                $this->load->library('Form_validation');
                $this->load->model('M_empresa');
                $this->load->model('M_contato');
                $this->load->model('M_numero');
                $this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
    }
    
    function index() {
        $this->data['content']="conteudo da empresa";
        $this->data['title']="Empresa";
        
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('empresa/index',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }
    
       function cadastrar() {
        $this->data['content']="conteudo da empresa";
        $this->data['title']="Cadastrar Empresa";
        
        if(is_array($_POST) && count($_POST)>0){
            $data = $_POST;
            $res = $this->M_empresa->save($data);
            if($res){
                echo "<script>alert('salvo com sucesso');</script>";
            }else{
                echo "<script>alert('salvo com sucesso');</script>";
            }
        }
        //$this->load->view('layouts/default_header',$this->data);
        $this->load->view('empresa/Cadastrar_empresa',$this->data);
        //$this->load->view('layouts/default_footer',$this->data);
    }
    
    function listar() {
        $res =  $this->M_empresa->listar();
        
        $this->data['lista_empresa']=$res;
        
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('empresa/Listar_empresa',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }

}

