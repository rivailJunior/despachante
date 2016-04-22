<!DOCTYPE html>

<script>
    $(document).ready(function (){
        //$("#valor").mask("");
        
    });
    
</script>

<section>
            <fieldset> 
                <legend> 
                Adicionar Creditos
                </legend>
                
                <form id="create" action="/Despachante_system/index.php/administrador/credito/lancar_credito" method="post">
                    <div>
                        <table id="" class="table">
                                <tr>
                                    <td><input id="valor" name="valor" placeholder="Valor Credito" class="input" type="text" name="" value="<?php echo set_value('valor');?>" ></td>
                                    <td><input class="input" placeholder="Matricula Despachante" id="matricula_des" name="matricula_des" type="text" value="<?php echo set_value('matricula_des');?>" name=""></td>
                                    <td><input class="submit" type="submit" id="btLancarCredito" name="btLancarCredito" value="Enviar"></td>
                                   </tr>
                            </table>
                    </div>
                </form>
            </fieldset>
    </section>
