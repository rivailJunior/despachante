<?php

class M_numero extends CI_Model {

    private $table = "tb_numero";
            function __construct() {
        
    }
    
    function save($data) {
        return $this->db->insert($this->table,$data);
    }

     function updatenumero($cod,$data){
       $this->db->where('num_con_codigo', $cod);
        return $this->db->update('tb_numero', $data);
    
     }

      function ultimo() {
        $sql= $this->db->query("SELECT con_codigo FROM tb_contato order by con_codigo desc limit 1"); 
        return $sql;
    }

}