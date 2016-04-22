<?php

class M_contato extends CI_Model {

    private $table = "tb_contato";
    
    function __construct()
    {
        
    }
    
    function save($data)
    {
    return $this->db->insert($this->table,$data);    
    }
    
    function selectLast() {
        $sql= $this->db->query("select con_codigo from tb_contato order by con_codigo desc limit 1");
        return $sql;
    }
    

    function updatecontato($cod,$data){
       $this->db->where('con_codigo', $cod);
        return $this->db->update('tb_contato', $data);
    
     }
     
       function selectEmail($email) {
         $this->db->where("con_email",$email);
         $sql = $this->db->get("tb_contato");
         if($sql->num_rows>0){
             return true;
         }else{
             return false;
         }
     }//fim da select matricula
     

    

}