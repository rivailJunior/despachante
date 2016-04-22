<?php

class M_produto extends CI_Model {

 private   $table = "tb_produtos";
    function __construct() {
        
    }
    
    function save($data) {
        return $this->db->insert($this->table,$data);
    }
    
    function select() {
        $sql = $this->db->query("select * from tb_produtos");
        return $sql;
    }
    function selectDesp() {
        $sql = $this->db->query("select * from tb_despachante");
        return $sql;
    }

    function getStock($prod)
    {
    	$query = $this->db->query('
    		SELECT pro_qtd_atual
    		FROM tb_produtos
    		WHERE pro_codigo = "'.$prod.'";
    	');
    	return $query->row();
    }

     function editar($codigo) {
        $sql = $this->db->query("SELECT * FROM tb_produtos WHERE pro_codigo='".$codigo."'");
        return $sql;
    }

    function update($codigo,$data){

        $this->db->where('pro_codigo',$codigo);
        return $this->db->update('tb_produtos',$data);
    }

     function delete($codigo) {
        $sql = $this->db->query("DELETE FROM tb_produtos WHERE pro_codigo = '".$codigo."'");
        return $sql;
    }

    

}
