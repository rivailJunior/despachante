<?php

class M_credito extends CI_Model {

    private $table = "tb_credito";
    
    function __construct() {
        
    }

    function save($data) {
       return $this->db->insert($this->table,$data);
    }
    
}
