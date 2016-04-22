<?php

class M_despachante extends CI_Model {

    private $table = 'tb_despachante';
   
    var $details = array();
    
    function __construct() {
        
    }

    function validate_user($cpf, $senha) 
    {// verifica o usuario a ser logado
        $sql = $this->db->query("select * from tb_usuario where usu_cpf ='".$cpf."' and usu_senha = '".$senha."';");
        if($sql->num_rows() == 1)
        {
            return $sql->result();
        }
        else
        {
            return false;
        }
    }//fim do validate

    function save($dadosdespachantes,$dadosendereco,$dadosempresa,$existe_empresa) 
    {
        $this->db->trans_start();
        
        if($existe_empresa=="sim")
        {
            $this->db->insert("tb_empresa",$dadosempresa);
            $dadosdespachantes['des_emp_codigo']=$this->db->insert_id();
        }
        else
        {
            $dadosdespachantes['des_emp_codigo']=null;
        }
        $this->db->insert("tb_endereco",$dadosendereco);
        $dadosdespachantes['des_cod_end'] =  $this->db->insert_id();
        
        $this->db->insert("tb_despachante", $dadosdespachantes);
        
        $this->db->trans_complete();
        if(!$this->db->trans_status())
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    function listar($tipo='adm') //adm Administrado (Usuario e Adapt) , des Despachante
	{
        // $sql=$this->db->query("SELECT d.*, e.* FROM tb_despachante d, tb_endereco e WHERE d.des_cod_end = e.end_codigo AND d.des_tipo<>'".$tipo."'");
        $sql=$this->db->query("select * from tb_despachante where des_estatus='1'");
        return $sql;
    }
    
    function listarUltimo() {
          $sql=$this->db->query("select des_matricula from tb_despachante order by des_matricula desc limit 1");
        return $sql;
    }
    
    function delete($codigo) {
        $sql = $this->db->query("delete from tb_despachante where des_codigo = ".$codigo."");
        return $sql;
    }

     function editar($codigo){//mostrar na view
        $query = $this->db->query("select *  from tb_despachante
         join tb_endereco on end_codigo = des_cod_end
         join tb_municipio on mun_codigo = des_cod_naturalidade
         join tb_uf on uf_codigo = municipio_coduf
         left join tb_empresa on des_emp_codigo = emp_codigo where des_codigo = ".$codigo."");
        return $query;
     }

     function editaStatus($codigo,$status)
     {
        $sql = $this->db->query("update tb_despachante set des_estatus='".$status."' where des_codigo = ".$codigo."");
        return $sql; 
     }

     function update($cod_endereco,$data_endereco,$cod_despachante,$data_despachante, $cod_empresa, $dados_empresa,$check_empresa){
   
         $this->db->trans_start();

         $this->db->where('end_codigo', $cod_endereco);
         $this->db->update('tb_endereco', $data_endereco);

         if(($check_empresa=="sim")&&($cod_empresa != ''))
         {
         $this->db->where('emp_codigo',$cod_empresa);
         $this->db->update('tb_empresa',$dados_empresa);
         }
         if(($check_empresa=="sim")&&($cod_empresa == ''))
         {
            
            $this->db->insert("tb_empresa",$dados_empresa);
            $data_despachante['des_emp_codigo']=$this->db->insert_id();
         }
         if(($check_empresa=="nao"))
         {
            $this->db->where("emp_codigo",$cod_empresa);
            $this->db->delete("tb_empresa");
         }

         $this->db->where('des_codigo',$cod_despachante);
         $this->db->update('tb_despachante',$data_despachante);

         $this->db->trans_complete();

         if($this->db->trans_status() === false){
             return false;
         }else{
             return true;
         }
    
     }//fim do update


     function selectMatricula($mat) {
         $this->db->where("des_matricula",$mat);
         $sql = $this->db->get("tb_despachante");
         if($sql->num_rows>0){
             return true;
         }else{
             return false;
         }
     }//fim da select matricula

     function selectCpf($cpf) {
         $this->db->where("des_cpf",$cpf);
         $sql = $this->db->get("tb_despachante");
         if($sql->num_rows>0){
             return true;
         }else{
             return false;
         }
     }//fim da select matricula
     
     function selectRg($rg) {
         $this->db->where("des_rg",$rg);
         $sql = $this->db->get("tb_despachante");
         if($sql->num_rows>0){
             return true;
         }else{
             return false;
         }
     }//fim da select matricula
     
     
     function selectMatriculaLast() {
        $sql = $this->db->query("select des_matricula from tb_despachante order by des_matricula desc limit 1");
        return $sql;
     }//fim da select matricula
     
     
     function listar_municipios($codigouf)
	{
	$query = $this->db->query("SELECT mun_codigo as codigo, mun_nome as nome FROM tb_municipio WHERE municipio_codUF = '".$codigouf."' ORDER BY nome ASC");
	return $query;
	}	
//**********************L I S T A R   D A D O S   D O   M U N I C I P O S ********************************//	
	
        	function listar_uf()
	{
	$query = $this->db->query("SELECT uf_codigo as codigo, uf_sigla as sigla, uf_unidadeFederacao as unidade FROM tb_uf
	ORDER BY sigla ASC");
	return $query;
	}
        
      
 
    
}



?>
