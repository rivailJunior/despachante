<?php

class M_outorgante extends CI_Model {

    function save($outorgante, $endereco) {

        $this->db->trans_start();

        $this->db->insert("tb_endereco", $endereco);
        $outorgante['out_cod_end'] = $this->db->insert_id();
        $this->db->insert("tb_outorgante", $outorgante);

        $this->db->trans_complete();

        if (!$this->db->trans_status())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    function listar() {
        $sql = $this->db->query("
            SELECT * 
            FROM tb_outorgante o, tb_endereco e 
            WHERE o.out_cod_end = e.end_codigo;
        ");
        return $sql;
    }
    
    function listarUltimo() {
        $sql = $this->db->query("select out_cpf_cnpj from tb_outorgante order by out_cpf_cnpj desc limit 1");
        return $sql;
    }

    function editar($codigo){

        $query = $this->db->query("
            SELECT * 
            FROM tb_outorgante o, tb_endereco e
            WHERE o.out_cpf_cnpj = '".$codigo."'
            AND e.end_codigo = o.out_cod_end;
        ");
        return $query;
    }

    function update($codigo,$data){

        $this->db->where('out_cpf_cnpj', $codigo);
        return $this->db->update('tb_outorgante',$data);
    }


    function delete($codigo) {
        $sql = $this->db->query("delete from tb_outorgante where out_cpf_cnpj = '".$codigo."'");
        return $sql;
    }

    function listar_uf()
    {
        $query = $this->db->query("
            SELECT uf_codigo as codigo, uf_sigla as sigla, uf_unidadeFederacao as unidade 
            FROM tb_uf
            ORDER BY sigla ASC");
        return $query;
    }

    function listar_municipios($codigouf)
    {
        $query = $this->db->query("
            SELECT mun_codigo as codigo, mun_nome as nome 
            FROM tb_municipio
            WHERE municipio_codUF = '".$codigouf."' ORDER BY nome ASC");
        return $query;
    }   
    
}
