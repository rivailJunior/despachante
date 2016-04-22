<?php

class Poderes extends CI_Controller {

    private $data = array();
            function __construct() {
        parent::__construct();
        if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/Login/show_login');
    }
    $this->load->model('M_poderes');
    $this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
    }//fim construct

    function index() {
        $this->data['title']="Poderes";
        $this->data['content']="Conteudo poderes";
         $this->load->view('layouts/default_header',$this->data);
        $this->load->view('poderes/index',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }
    
    function cadastrarPoderes() {
         $this->data['title']="Cadastro Poderes";
        $this->data['content']="Conteudo poderes";
         $this->load->view('layouts/default_header',$this->data);
        $this->load->view('poderes/cadastro_poderes',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }
}