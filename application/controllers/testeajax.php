<?php

class Testeajax extends CI_Controller {

    private $data = array();
    function __construct() {
        parent::__construct();
        $this->load->model('M_testeajax');
    }

    function index() {
        $this->data['teste']="testando ajax";
        $this->load->view('testeAjax',  $this->data);
    }
   
    public function check_user()
{
 $usr=$this->input->post('name');
 $result=$this->M_testeajax->check_user_exist($usr);
 if($result)
 {
  echo '1';
  }
 else{
  echo "0";
  }
}
} 
