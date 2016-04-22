<?php

class M_testeajax extends CI_Model {

    function __construct() {
        
    }

  public function check_user_exist($usr)
{
 $this->db->where("des_nome",$usr);
 $query=$this->db->get("tb_despachante");
 if($query->num_rows()>0)
 {
  return true;
 }
 else
 {
  return false;
 }
}

}
