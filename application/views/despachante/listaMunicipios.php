<?php 
if ($query->num_rows() > 0) 
{
	echo "<option value='' >Selecione</option>";
	foreach ($query->result() as $row)
	{
		echo '<option value="'.$row->codigo.'">'.$row->nome.'</option>';	
	}
} 
else 
{
	echo "<option value='' >Selecione a UF</option>";
}

?>