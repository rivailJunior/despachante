<?php

class M_usuario extends CI_Model 
{

	function listar()
	{
		$query = $this->db->query("
			SELECT * 
			FROM tb_usuario
			WHERE usu_cpf <> '00000000000';");
		return $query;
	}

	function save($usuario)
	{
		return $this->db->insert('tb_usuario',$usuario);
	}

	function editar($cpf)
	{
		$sql = $this->db->query("
			SELECT * FROM tb_usuario WHERE usu_cpf='".$cpf."'
		");
        return $sql;
	}

	function update($cpf, $usuario)
	{
		$this->db->where('usu_cpf',$cpf);
        return $this->db->update('tb_usuario',$usuario);
	}

	function delete($cpf)
	{
		$sql = $this->db->query("DELETE FROM tb_usuario WHERE usu_cpf = '".$cpf."'");
        return $sql;
	}
}
?>