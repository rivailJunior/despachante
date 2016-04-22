<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('M_despachante');
        $this->load->library('Form_validation');
        
        $this->load->model('M_empresa');
        $this->load->model('M_contato');
        $this->load->model('M_numero');
    }
    

    function index() 
    {
        $this->form_validation->set_rules('cpf','CPF','trim|required');
        $this->form_validation->set_rules('senha','senha','trim|required|callback_checklogin');
        if ($this->form_validation->run() == FALSE)
    	{
            $this->load->view('Login/Login');
    	}
    	else
    	{
            redirect('despachante');
    	}
    }

    function checklogin($senha)
    {
        $cpf = $this->cpf_removemask($this->input->post('cpf'));
        $senhafinal = md5($senha);
        $result = $this->M_despachante->validate_user($cpf,$senhafinal);
        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'cpf' => $row->usu_cpf,
                    'nome' => $row->usu_nome
                );
                $this->session->set_userdata('isLoggedIn', $sess_array);
            }
            return TRUE; 
        }
        else
        {
            $this->form_validation->set_message('checklogin', 'CPF ou senha inválidos');
            return false;
        }
    }
        
    function show_login($show_error = false)
    {
        $data['error'] = $show_error;
        $this->load->helper('form');
        $this->load->view('Login/Login', $data);
    }
    
    function logout_user() 
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    
    function cpf_putmask($cpf)
    {
        $cpf1 = substr_replace($cpf,'.',3,0);
        $cpf2 = substr_replace($cpf1,'.',7,0);
        $cpf_with_mask = substr_replace($cpf2,'-',11,0);
        return $cpf_with_mask;
    }
    
    function cpf_removemask($cpf)
    {
        $chrs = array('.','-');
        $cpf_without_mask = str_replace($chrs,'',$cpf);
        return $cpf_without_mask;
    }
}