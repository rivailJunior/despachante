
<section>
    <fieldset> 
        <legend> 
            Listando Empresa
        </legend>

        <form id="create" action="#/Despachante_system/index.php/despachante/create" method="post">
            <div>

                <table id="" class="table_listar">
                    <tr>
                       
                        <th>Processo</th>
                        <th>SSP</th>
                        <th>FAC simile</th>
                        <th>Regiao seccional</th>
                        <th colspan="2">Acoes</th>
                    </tr>
                    <tr>
                        <td></td>
                    </tr> 
                    <?php 
            if($lista_empresa->num_rows()>0)
                {
                foreach ($lista_empresa->result()as $linha) {


?>
                    <tr>
                    
                    <td><?php  echo $linha->empresa_processo;?></td>
                    <td><?php  echo $linha->empresa_SSP;?></td>
                    <td><?php  echo $linha->empresa_regiao_seccional;?></td>
                    <td><a href="">X</a></td>
                    <td><a href="">E</a></td>
                    </tr>
                    <?php 
                                                    }

    }else{
        echo "Nada Encontrado";
    }
                    ?>
                </table>

            </div>


        </form>
    </fieldset>
</section>

