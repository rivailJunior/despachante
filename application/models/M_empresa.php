<?php

class M_empresa extends CI_Model {

     private $table = "tb_empresa";
     
    function __construct() {
        
    }
    
    function save($data) {
       return $this->db->insert($this->table,$data);
    }
    
    function listar() {
        $sql =  $this->db->query('select * from tb_empresa');
        return $sql;
    }
    

}

