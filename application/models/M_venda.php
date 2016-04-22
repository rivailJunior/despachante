<?php

class M_venda extends CI_Model {

    private $table = "tb_venda";
    
    private $item = "tb_itemvenda";
     
            function __construct() {
        
    }
    
    function save($codvenda,$dadosVenda,$produtos) {
       $this->db->trans_start();
       
       $this->db->insert($this->table,$dadosVenda);

       // venda[i][0] = codigo
      // venda[i][1] = descricao
      // venda[i][2] = quantidade
      // venda[i][3] = preco item
      // venda[i][4] = preco total item
       foreach ($produtos as $prod) {
           $dadosprod['itv_pro_codigo']=$prod[0];
           $dadosprod['itv_ven_codigo']=$codvenda;
           $dadosprod['itv_quantidade']=$prod[2];
           $this->db->insert("tb_itemvenda",$dadosprod);
            //$this->db->query("update tb_produtos set pro_qtd_atual = pro_qtd_atual-".$prod[2]." where pro_codigo = ".$prod[0].""); 
       }
        
       
       
        $this->db->trans_complete();

    		if (!$this->db->trans_status())
    		{
    		    return "0";
    		}
    		else
    		{
    			 return $codvenda;
    		}
    }

    function selectlastVenda() {
        $sql = $this->db->query("select ven_codigo from tb_venda order by ven_codigo desc limit 1");
        return $sql;
    }
    
    function relatorioVendas($data,$codigo,$mat) 
    {
        $sql = $this->db->query("select ven_codigo, des_matricula, ven_data,ven_hora, 
        	sum(itv_quantidade) as itv_quantidade, count(pro_codigo) as total_produtos,
        	pro_descricao, ven_valor, ven_valor_entregue, ven_troco
            from tb_venda
        inner join tb_itemvenda on itv_ven_codigo = ven_codigo 
        inner join tb_produtos on pro_codigo = itv_pro_codigo
        left join tb_despachante on des_codigo = ven_des_codigo
        where  ".$data." ".$codigo."  ".$mat." group by ven_codigo");
        return $sql;
    }

    function valor_total_venda($data)
    {
    	$sql = $this->db->query("select sum(ven_valor) as valor_total_venda from tb_venda where ".$data."");
    	return $sql;
    }

    function lista_produto_venda($codigo)
    {
      $sql = $this->db->query("SELECT *, des_nome FROM tb_itemvenda
      inner join tb_produtos on pro_codigo = itv_pro_codigo 
      inner join tb_venda on ven_codigo = itv_ven_codigo
      left join tb_despachante on des_codigo = ven_des_codigo
      WHERE itv_ven_codigo = ".$codigo."");
      return $sql;
    }

    function segundaViaReciboVenda($codigo_venda)
    {
    	$sql = $this->db->query("
    		SELECT ven_codigo,ven_data,ven_hora, des_nome, ven_valor AS valor_total, SUM( itv_quantidade ) AS qtd_itens, 
    		ven_tipopag AS forma_pagamento, ven_valor_entregue AS pagamento, ven_troco AS troco
			FROM  `tb_venda` 
			LEFT JOIN tb_despachante ON des_codigo = ven_des_codigo
			INNER JOIN tb_itemvenda ON itv_ven_codigo = ven_codigo
			WHERE ven_codigo =".$codigo_venda." ");
    	return $sql;
    }

    
}