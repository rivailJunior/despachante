<?php

class Configurar extends CI_Controller{

    private $data = array();

    function __construct() 
    {
        parent::__construct();
        if( !$this->session->userdata('isLoggedIn') ) {
            redirect('/Login/show_login');
        }
        $this->load->model("M_configurar");
        $this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
    }
    
    function index() 
    {
        $this->data['title']="Configurações";

        $this->data['query'] = $this->M_configurar->getConfigs();

        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('configurar/index',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }

    function salvarSeq()
    {
        $data['num_veiculo_in'] = $this->input->post('vIn');
        $data['num_veiculo_fim'] = $this->input->post('vFim');
        $data['num_cnh_in'] = $this->input->post('chnIn');

        $result = $this->M_configurar->salvarSeq($data);

        if ($result) 
        {
            echo '1';
        } 
        else 
        {
            echo '0';
        }
    }

    function salvarTaxa()
    {
        $data['conf_taxa_retorno'] = $this->input->post('taxa');

        $result = $this->M_configurar->salvarTaxa($data);

        if ($result) 
        {
            echo '1';
        } 
        else 
        {
            echo '0';
        }
    }

    function salvarKit()
    {
        $data['conf_valor'] = $this->input->post('kit');

        $result = $this->M_configurar->salvarKit($data);

        if ($result) 
        {
            echo '1';
        } 
        else 
        {
            echo '0';
        }
    }
    
    
    
    
}


