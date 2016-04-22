<?php

class Credito extends CI_Controller {

    private $data = array();
    
    function __construct() {
        parent::__construct();
         
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/Login/show_login');
    }
    $this->load->model('M_credito');
    $this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
       
    }
    
      function index() {
        $this->data['content']="conteudo da credito";
        $this->data['title']="Credito";
        $this->data['teste']="teste";
        $this->load->view('layouts/default_header',$this->data);
        $this->load->view('credito/index',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }//fim index
    
    
     function lancar_credito() {
         $this->data['teste']="teste";
         $this->load->view('layouts/default_header',$this->data);
         $this->load->view('credito/adicionar_credito', $this->data);
         $this->load->view('layouts/default_footer',$this->data);
         
         if(isset($_POST['btLancarCredito'])){
             $data = date("Y-m-d");
             $hora = date('H:i:s');
             $credito['cre_valor'] =  $this->input->post('valor');
             $credito['cre_des_matricula'] =  $this->input->post('matricula_des');
             $credito['cre_data_compra'] = $data;
             $credito['cre_hora_compra'] = $hora;
             $return = $this->M_credito->save($credito);
             
             if($return){
                 echo "<script>alert('credito lancado');</script>";
             }else{
                 echo "<script>alert('erro ao lancar credito');</script>";
             }
             
         }//fim btlancarcredito
         
    }//fim do lancar credito
    

}
