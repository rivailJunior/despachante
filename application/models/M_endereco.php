<?php

class M_endereco extends CI_Model {

    private $table = "tb_endereco";
    
    function __construct()
    {
        
    }
    
    function saveendereco($data)
    {
    return $this->db->insert($this->table,$data);    
    }
    
    function selectLast() {
        $sql= $this->db->query("select end_codigo from tb_endereco order by end_codigo desc limit 1");
        return $sql;
    }
    

    function updateendereco($cod,$data){
       $this->db->where('end_codigo', $cod);
        return $this->db->update('tb_endereco', $data);
    
     }
     
     function selectendereco($matricula) {
         $sql =  $this->db->query("select * from tb_endereco where end_des_matricula = '".$matricula."'");
         return $sql;
     }

    

}