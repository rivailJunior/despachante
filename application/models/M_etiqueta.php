<?php

class M_etiqueta extends CI_Model {

    private $table = 'tb_etiqueta';
    
    function __construct() {
        
    }

    function save($data) 
    {
       return $this->db->insert($this->table,$data);
    }
}
