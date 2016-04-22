<?php

class M_veiculo extends CI_Model {

    private $table = "tb_veiculo";
    
    function __construct() {
        
    }
    
    function save($data) {
        return $this->db->insert($this->table,$data);
    }
    
    function listar() {
        $sql= $this->db->query("SELECT * FROM tb_veiculo, tb_outorgante WHERE vei_out_cpf_cnpj = out_cpf_cnpj");
        return $sql;
    }
    function delete($placa) {
        //$this->db->where('veiculo_placa',$placa);
        //$this->db->delete($table);
        $sql =  $this->db->query("delete from tb_veiculo where vei_placa='".$placa."'");
        return $sql;
    }
    
  /*  function selectPlaca($placa){
        $sql = $this->db->query("select * from tb_veiculo where vei_placa like '".$placa."'");
        return $sql;
    }
*/
    
function selectPlaca($placa) {
    $this->db->select('vei_placa');
    $this->db->like('vei_placa',$placa);
    $query = $this->db->get($this->table);
   return $query->result();
   
}//fim do select placa


}