<?php

class M_servico extends CI_Model {

    private $table = 'tb_servico';
    
    function __construct() {
        
    }

	function getIdServico()
	{
		$query = $this->db->query("SELECT max(ser_codigo) AS id FROM tb_servico order by id desc limit 1");
		if ($query->num_rows() == 0)
        {
			$newid = 1;
		}
        else
        {
			$lastid = $query->row()->id;
			$newid = $lastid + 1;
		}
		return $newid;
	}
	
	function dadosProcuracao($codDesp)
	{
		$query = $this->db->query("
            SELECT d.des_codigo as codigo, 
            d.des_matricula as matricula, 
            d.des_matricula_SINDESAM as matriculaS, 
            d.des_nome as nome, 
            d.des_rg as rg, 
            d.des_cpf as cpf, 
            d.des_orgao_emissor as oemissor, 
            d.des_telefone as telefone, 
            d.des_celular as celular, 
            CONCAT_WS (' ', e.end_descricao, e.end_complemento) as endereco, 
            e.end_bairro as bairro, 
            e.end_cep as cep, 
            m.mun_nome as cidade, 
            uf.uf_sigla as sigla 
            FROM tb_despachante d, tb_endereco e, tb_municipio m, tb_uf uf
            WHERE d.des_codigo = '".$codDesp."'
            AND e.end_codigo = d.des_cod_end
            AND e.end_codmunicipio = m.mun_codigo 
            AND e.end_coduf = uf.uf_codigo 
        ");
		return $query;
	}

// -----------------------------------------------------------------------------------------------------------------------------
// -- GERAR KIT ----------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------

    function getNumero()
    {
        $sql= $this->db->query("
            SELECT *
            FROM tb_numero
        ");
        return $sql;
    }

    function getUltimoRegistro($tipoKit)
    {
        $sql= $this->db->query("
            SELECT cast(mid(ser_chp, 1) as UNSIGNED) as chp 
            FROM tb_servico
            WHERE ser_tipo = '".$tipoKit."'
            order by chp desc LIMIT 1
        ");
        return $sql;    
    }

    function getDadosSalvarKit($tipoKit)
    {
        $result = array();
        $this->db->trans_start();        

        $sqlNumero = $this->db->query("
            SELECT *
            FROM tb_numero
        ");
        $numero = $sqlNumero->row();

        $sqlLastReg = $this->db->query("
            SELECT cast(mid(ser_chp, 1) as UNSIGNED) as chp 
            FROM tb_servico
            WHERE ser_tipo = '".$tipoKit."'
            ORDER BY chp DESC
            LIMIT 1
        ");
        if ($sqlLastReg->num_rows() > 0) 
        {
            $lastReg = $sqlLastReg->row()->chp;
        } 
        else 
        {
            $lastReg = 'x';
        }
        
        

        $result['vIn'] = $numero->num_veiculo_in;
        $result['vFim'] = $numero->num_veiculo_fim;
        $result['cIn'] = $numero->num_cnh_in;
        $result['lastCHP'] = $lastReg;

        $this->db->trans_complete();

        if($this->db->trans_status() === false)
        {
            return false;
        }
        else
        {
            return $result;
        }
    }
	
    function save($kits) 
    {
        $this->db->trans_start();

        for ($i=0; $i < count($kits); $i++) { 
            $this->db->insert("tb_servico",$kits[$i]);
        }

        $this->db->trans_complete();

        if($this->db->trans_status() === false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function salvarNovaSequencia($in, $fim)
    {
        $query = $this->db->query("
            UPDATE tb_numero 
            SET num_veiculo_in = '.$in.', num_veiculo_fim = '.$fim.';
        ");
        return $query;
    }

// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------

    
    function insere($data) 
    {
       return $this->db->query("INSERT INTO tb_servico(ser_des_matricula, ser_out_cpf_cnpj, ser_vei_placa, ser_pod_codigo, ser_data, ser_hora) VALUES ('".$data."', null, null, null, '".$data."', '".$data."')");
    }
    
    function select() {
        $sql= $this->db->query("
            SELECT *
            FROM tb_servico
            inner join tb_despachante on des_codigo = ser_des_codigo
            order by ser_codigo 
            desc
        ");
        return $sql;
    }
    
    //fazer relatorio de servico---------------------------------//
    
    
    function selectPorDia() {// funcao para retornar os despachante que realizaram servicos nos dias determinados
             $sql= $this->db->query("
                SELECT sum(ser_valor) as valorFinalTotal,ser_des_codigo, des_matricula, des_nome, ser_data ,ser_valor, count(ser_valor) as qtd 
                FROM tb_servico
                INNER JOIN tb_despachante on des_codigo = ser_des_codigo
                GROUP BY ser_des_codigo");
        return $sql;
    }
    

    function diasServico($mes,$ano,$tipo = '',$estado='') {//funcao p retornar a qtd de servicos por dia
       /* $sql= $this->db->query("
            SELECT sum(ser_valor) as valorDia,count(ser_codigo)as qtddia, ser_data as data ,day(ser_data) as ser_data 
            FROM tb_servico  
            GROUP BY ser_data");
        return $sql;
        */
        /* modificar assim q a view css estiver finalizada*/
        $sql= $this->db->query("
            SELECT sum(ser_valor) as valorDia,count(ser_codigo)as qtddia, ser_data as data ,day(ser_data) as ser_data 
            FROM tb_servico
            where month(ser_data)='".$mes."' 
            and year(ser_data)='".$ano."' 
            ".$tipo." 
            ".$estado."
            GROUP BY ser_data
        ");
        return $sql;
                
    }
    
      function somenteqtd($data,$codigo, $status, $tipo) {//retorna qtd de servicos gerados por cada despachante
        $sql= $this->db->query("
            SELECT  ser_data, count(ser_codigo) as qtd 
            FROM tb_servico
            WHERE ser_data = '".$data."' 
            AND ser_des_codigo = '".$codigo."'
            ".$tipo." 
            ".$status."  
            GROUP BY ser_data
        ");
        return $sql;
    }
    
    function totalServicoDesp($mes,$ano, $codigo, $status, $tipo) {//retorna valor total de servicos por despachante
        $sql= $this->db->query("
            SELECT count(ser_codigo) as total, sum(ser_valor)as valorfinal 
            FROM tb_servico
            WHERE ser_des_codigo = '".$codigo."'
            AND month(ser_data)='".$mes."' 
            AND year(ser_data)='".$ano."'
            ".$tipo." 
            ".$status."
        ");
        return $sql;
    }
    
    //----------------------------------------------//
     function selectTotal() {//retorna qtd de servicos e o valor total de todos eles
        $sql= $this->db->query("select count(ser_codigo)as qtd,sum(ser_valor)as total from tb_servico");
        return $sql;
    }
	
//------------------VALOR KIT ------------------------------------------//

    function kitValor_save($data) {
        return $this->db->insert($this->table,$data);
    }
    
    function kitValor_select() {
        return $this->db->query("select conf_valor as valorkit from tb_config");
    }
    
    function kitValor_editar($valor){
        $sql = $this->db->query("UPDATE tb_config set conf_valor = '".$valor."'");
        return $sql;
    }

    
	
}
