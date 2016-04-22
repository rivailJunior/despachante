<?php

class M_configurar extends CI_Model {

 private  $table = "tb_config"; 
    function __construct() {
        
    }

    function getConfigs()
    {
        $query = $this->db->query("
            SELECT * 
            FROM tb_numero, tb_config
            LIMIT 1;
        ");
        return $query;
    }

    function salvarSeq($data)
    {
        $query = $this->db->query('
            UPDATE tb_numero
            SET num_veiculo_in = '.$data['num_veiculo_in'].', num_veiculo_fim = '.$data['num_veiculo_fim'].', num_cnh_in = '.$data['num_cnh_in'].';
        ');
        return $query;
    }

    function salvarTaxa($data)
    {
        $query = $this->db->query('
            UPDATE tb_config
            SET conf_taxa_retorno = '.$data['conf_taxa_retorno'].';
        ');
        return $query;
    }

    function salvarKit($data)
    {
        $query = $this->db->query('
            UPDATE tb_config
            SET conf_valor = '.$data['conf_valor'].';
        ');
        return $query;
    }
    
    function save($data) {
        return $this->db->insert($this->table,$data);
    }
    
    function select() {
        return $this->db->query("select * from tb_config");
    }
    
    function editar($valor){
        $sql = $this->db->query("update tb_config set conf_valor = '".$valor."'");
        return $sql;
    }

}