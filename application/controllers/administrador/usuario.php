<?php
class Usuario extends CI_Controller{

    private $data = array();

	function __construct() 
	{
    	parent::__construct();
    
        if( !$this->session->userdata('isLoggedIn') ) 
        {
        	redirect('/Login/show_login');
    	}
		$this->load->library('Form_validation');
		$this->load->model('M_usuario');
		$this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
  	}

	function index()
	{
		
	}

	function listar()
	{
		$this->data['title']="Usuários";
        $this->data['usuarios']=$this->M_usuario->listar();
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('usuario/listar',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
	}

	function cadastrar()
	{
        $this->load->view('usuario/cadastrar');
	}

	function salvar()
	{
		$usuario['usu_nome'] = $this->input->post('nome');
		$cpf = preg_replace("/\D+/", "", $this->input->post('cpf'));
        $usuario['usu_cpf'] = $cpf;
        $usuario['usu_senha'] = md5($this->input->post('senha'));
        $return = $this->M_usuario->save($usuario);
        if($return)
        {
            echo '1';
        }
        else
        {
            echo '2';
        }
	}

    function editar($cpf)
    {
        $this->data['query'] = $this->M_usuario->editar($cpf);
        $this->load->view('usuario/update',$this->data);
    }

    function update()
    {
        $cpf = $this->input->post('cpf');
        $usuario['usu_nome'] = $this->input->post('nome');
        $senha = $this->input->post('senha');

        if ($senha == '') 
        {
            $usuario['usu_senha'] = '';
        } 
        else 
        {
            $usuario['usu_senha'] = md5($senha);
        }

        $return = $this->M_usuario->update($cpf,$usuario);
        if ($return) {
            echo '1';
        } else {
            echo '0';
        }
    }

    function excluir()
    {
        $cpf = $_POST['cpf'];
        $excluir = $this->M_usuario->delete($cpf);
        if($excluir){
            echo '1';
        }else{
            echo '0';
        }
    }

}
?>