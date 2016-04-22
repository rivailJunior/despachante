<?php

class Produto extends CI_Controller {

    private $data = array();
            
    function __construct() {
        parent::__construct();
        if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/Login/show_login');
    }
    $this->load->model('M_produto');
        $this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
    }//fim construct
    
    function index(){
        $this->data['title']="Produtos";
        $this->load->view('layouts/default_header',  $this->data);
        $this->load->view('produto/index',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }//fim index
    
    function cadastrar() {
        $this->load->view('produto/cadastrar_produto',$this->data);
    }
    
    function salvaproduto() {
        $produto['pro_descricao'] = $this->input->post('descricao');
        $produto['pro_valor_unitario'] = $this->input->post('valunitario');
        $return = $this->M_produto->save($produto);
        if($return){
            echo '1';
        }else{
            echo '2';
        }
    }
    function listar() {
        $this->data['title']="Produtos";
        $lista_produtos = $this->M_produto->select();
        $this->data['produtos']=$lista_produtos;
        $this->load->view('layouts/default_header',  $this->data);
        $this->load->view('produto/lista',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }
    
    function listar_desp() 
    {
       
        $array = array('despachantes' => array());
        $listaDespachantes = $this->M_produto->selectDesp();
        
        foreach ($listaDespachantes->result() as $row) 
        {
            $array['despachantes'][] = array
            (
                'codigo' => $row->des_codigo,
                'mSINDESDAM' => $row->des_matricula_SINDESAM,
                'mCRDD' => $row->des_matricula,
                'nome' => $row->des_nome,
                'cpf' => $row->des_cpf
            );
        }
        $arrayJSON = json_encode($array);
        echo $arrayJSON;
        
    }//fim listar
    
    function listar_ajax() 
    {
       
		$array = array('produtos' => array());
		$listaProdutos = $this->M_produto->select();
		
		foreach ($listaProdutos->result() as $row) 
		{
			$array['produtos'][] = array
			(
				'codigo' => $row->pro_codigo,
				'descricao' => $row->pro_descricao,
				'preco' => $row->pro_valor_unitario
			);
		}
		$arrayJSON = json_encode($array);
		echo $arrayJSON;
        
    }//fim listar
    
    function getStockProduto()
	{
		$produto = $_POST['produto'];

		$queryStock = $this->M_produto->getStock($produto);
                
		echo $queryStock->pro_qtd_atual;
	}




    function editar($codigo){
         $this->data['query'] = $this->M_produto->editar($codigo);
         $this->load->view('produto/update',$this->data);
    }

     function updateproduto() {
        $produto['pro_descricao'] = $this->input->post('descricao');
        $produto['pro_valor_unitario'] = $this->input->post('valunitario');
        $codigo = $this->input->post('codprod');
        
        $return = $this->M_produto->update($codigo,$produto);
        if ($return) {
            echo '1';
        } else {
            echo '0';
        }
    }

    function excluir()
    {
        //$codigo = $_POST['codigo'];
        $codigo = $this->input->post('codigo');
        $excluir = $this->M_produto->delete($codigo);
        if($excluir){
            echo '1';
        }else{
            echo '0';
        }
    }//fim excluir
}
