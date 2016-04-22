<?php

class M_itemvenda extends CI_Model {

    private $table = "tb_itemvenda";
    function __construct() {
        
    }
    
    function save($data) {
        return $this->db->insert($this->table,$data);
    }

    function selectVendas($venda) {
        $sql = $this->db->query("select pro_descricao, ven_data, itv_quantidade, pro_valor_venda, (itv_quantidade*pro_valor_venda) as valor from tb_venda
inner join tb_itemvenda on itv_ven_codigo = ven_codigo 
inner join tb_produtos on pro_codigo = itv_pro_codigo
where ven_codigo = '".$venda."'");
        return $sql;
    }
    
}