<style >
    #foot
    {
        text-align: center;
        color: #fff;
        background-color: #00993D;
        border-collapse: collapse;
    }

    #foot tr td
    {
        border-bottom: 1px solid #007D00;
        padding: 5px;
    }



    /* css da impressao*/
 @media print{

 #top{
    display: none;
     -webkit-print-display-adjust:exact;
}
.tbodylistar{
    
    -webkit-print-color-adjust:exact;
}
 #trvalor_dia, #trqtd_total,.titleDia{
   
    -webkit-print-color-adjust:exact;
}

#titulo_pag_impressao{
    display: block;
    -webkit-print-display-adjust:exact;
    padding-left: 50%;
    -webkit-print-padding-adjust:exact;
    width: 100%;
     -webkit-print-width-adjust:exact;
    color: #000;
    font-size: 40px;
    
}

#impressao,#tituloTabela,.select{
    display: none;
    
}
#divRelatorio{
  padding: 30px;  
}
#divTipo,#divAno,#divEstado,#divMonths{
   
    display: block;
    float: left;
    font-family: inherit;
    font-size: 30px;
    color: #000;
    border-bottom: 1px;
    /*padding: 10px;*/
    margin-left: 15px;
    padding-left: 8%;

}


 }
    
</style>
<script>

           
    $(document).ready(function ()
    {
            var mes = document.getElementById('months');
            var m = mes.options[mes.selectedIndex].text;
            $("#divMonths").text(m);

            
            $("#tipo").change(function(){
            var textoTipo = this.options[this.selectedIndex].text;
            $("#divTipo").text(textoTipo);
            });

            $("#months").change(function(){
                var textoTipo = this.options[this.selectedIndex].text;
                $("#divMonths").text(textoTipo);
            });

            $("#year").change(function(){
                var textoTipo = this.options[this.selectedIndex].text;
                $("#divAno").text(textoTipo);
            });

            $("#estado").change(function(){
                var textoTipo = this.options[this.selectedIndex].text;
                $("#divEstado").text(textoTipo);
            });


            
            $('#impressao').click(function(){
                
                var myDropDown = document.getElementById('divRelatorio');
                
                window.title="bla bla";
                //Whatever other elements to hide.

                window.print();
                myDropDown.style.display = "block";
                return true;
                

                //$("#imprimir").printArea();
               
              });




            var m = $('#centro').css('margin-left');
            var mm = m.split('p')[0] - 120;
            $('#relServWrapper').css('margin-left',mm);

            $("#tableRelatorio").delegate('thead tr th','mouseover mouseleave', function(e) 
            {
                var index = $(this).index();
                var theadTH = $(this);
                if (index > 2) 
                {
                    $("#tableRelatorio tbody tr").each(function(){
                        if (e.type == 'mouseover') 
                        {
                            $(this).find('td').eq(index).addClass('hover');
                            theadTH.addClass('hover');
                            $("#tableRelatorio tfoot tr").each(function(){
                                $(this).find('td').eq(index - 2).addClass('hover');
                            })
                        } 
                        else
                        {
                            $(this).find('td').eq(index).removeClass('hover');
                            theadTH.removeClass('hover');
                            $("#tableRelatorio tfoot tr").each(function(){
                                $(this).find('td').eq(index - 2).removeClass('hover');
                            })
                        };
                    });
                }; 
            });

            $("#tableRelatorio").delegate('td.qtd','mouseover mouseleave', function(e) 
            {
                var index = $(this).index();
                $("#tableRelatorio tbody tr").each(function(){
                    if (e.type == 'mouseover') 
                    {
                        $('#tableRelatorio thead tr th').eq(index).addClass('hover');
                        $(this).find('td').eq(index).addClass('hover');
                        $("#tableRelatorio tfoot tr").each(function(){
                            $(this).find('td').eq(index - 2).addClass('hover');
                        })
                    } 
                    else
                    {
                        $('#tableRelatorio thead tr th').eq(index).removeClass('hover');
                        $(this).find('td').eq(index).removeClass('hover');
                        $("#tableRelatorio tfoot tr").each(function(){
                            $(this).find('td').eq(index - 2).removeClass('hover');
                        })
                    };
                });
            });

            $("#tableRelatorio").delegate('tfoot tr td','mouseover mouseleave', function(e) 
            {
                var index = $(this).index() + 2;
                var footTD = $(this);
                if (index > 2) 
                {
                    $("#tableRelatorio tbody tr").each(function(){
                        if (e.type == 'mouseover') 
                        {
                            $('#tableRelatorio thead tr th').eq(index).addClass('hover');
                            $(this).find('td').eq(index).addClass('hover');
                            $("#tableRelatorio tfoot tr").each(function(){
                                $(this).find('td').eq(index - 2).addClass('hover');
                            })
                        } 
                        else
                        {
                            $('#tableRelatorio thead tr th').eq(index).removeClass('hover');
                            $(this).find('td').eq(index).removeClass('hover');
                            $("#tableRelatorio tfoot tr").each(function(){
                                $(this).find('td').eq(index - 2).removeClass('hover');
                            })
                        };
                    });
                }; 
            });

            //$("#year").hide();
            $("#tableRelatorio").load("<?php echo site_url('administrador/servico/relatorio_filtrado');?>");
           
            $("#months").change(function (){
                $("#year").show("blind");
                var months = $("#months").val();
                var ano = $("#year").val();
                var tipo = $("#tipo").val();
                var status = $("#estado").val();
                 var table = $("#reloadTableListar").val();
                 $.ajax({
                    url: "<?php echo site_url('administrador/servico/relatorio_filtrado');?>",
                    type: 'POST',
                    dataType:'HTML',
                    data: {
                        'months':months,
                        'year':ano,
                        'status':status,
                        'tipo':tipo
                    },
                    success: function (res) {
                      
                      $("#tableRelatorio").html(res);
                    },
                    error: function (res) {
                                alert("nem entra la: "+JSON.stringify(res));
                            }
                
            });
                
            });
            $("#tipo").change(function (){
                $("#year").show("blind");
                var months = $("#months").val();
                var ano = $("#year").val();
                var tipo = $("#tipo").val();
                var status = $("#estado").val();
                 var table = $("#reloadTableListar").val();

                 $.ajax({
                    url: "<?php echo site_url('administrador/servico/relatorio_filtrado');?>",
                    type: 'POST',
                    dataType:'HTML',
                    data: {
                        'months':months,
                        'year':ano,
                        'status':status,
                        'tipo':tipo
                    },
                    success: function (res) {
                      
                      $("#tableRelatorio").html(res);
                    },
                    error: function (res) {
                                alert("nem entra la: "+JSON.stringify(res));
                            }
                
            });
                
            });
            $("#estado").change(function (){
                $("#year").show("blind");
                var months = $("#months").val();
                var ano = $("#year").val();
                var tipo = $("#tipo").val();
                var status = $("#estado").val();
                 var table = $("#reloadTableListar").val();
                 $.ajax({
                    url: "<?php echo site_url('administrador/servico/relatorio_filtrado');?>",
                    type: 'POST',
                    dataType:'HTML',
                    data: {
                        'months':months,
                        'year':ano,
                        'status':status,
                        'tipo':tipo
                    },
                    success: function (res) {
                      
                      $("#tableRelatorio").html(res);
                    },
                    error: function (res) {
                                alert("nem entra la: "+JSON.stringify(res));
                            }
                
            });
                
            });


              $("#year").change(function (){
                $("#year").show("blind");
                var months = $("#months").val();
                var ano = $("#year").val();
                 var table = $("#reloadTableListar").val();
                 var tipo = $("#tipo").val();
                  var status = $("#estado").val();
                 var table = $("#reloadTableListar").val();
                
                 $.ajax({
                    url: "<?php echo site_url('administrador/servico/relatorio_filtrado');?>",
                    type: 'POST',
                    dataType:'HTML',
                    data: {
                        'months':months,
                        'year':ano,
                        'status':status,
                        'tipo':tipo
                    },
                    success: function (res) {
                      
                      $("#tableRelatorio").html(res);
                    },
                    error: function (res) {
                                alert("nem entra la: "+JSON.stringify(res));
                            }
                
            });
                
            });
            
    });
</script>  
<div hidden id="titulo_pag_impressao">Relatorio Kit</div>
<div id="divTipo" hidden> Todos os tipos </div>
<div id="divEstado" hidden>Todos os Status</div>
<div id="divMonths" hidden></div>
<div id="divAno" hidden><?php echo date('Y');?></div>

<div id="relServWrapper" style="position: absolute; width: 1200px; height: 200px; left: 0px; top: 60px;">
<input type="hidden" id="reloadTableListar" value="<?php echo site_url('administrador/servico/relatorio_filtrado');?>">
<input type="hidden" id="btExcluir" value="<?php echo site_url('despachante/excluir'); ?>">
<input type="hidden" id="btListar"  value="<?php echo site_url('despachante/listar'); ?>">
<table width="100%">
    <tr id="opcoes_escolha">
        <td align="left" id="tituloTabela" class="pageTitle">Relatório Kits</td>
        <td align="rigth"  width="100px">
             <select id="tipo" name="tipo" class="select">
                <option value="">Todos os tipos</option>
                <option value="v">Veículo</option>
                <option value="c">CNH</option>
                
            </select>
       </td> 
        <td align="rigth" width="100px">
         
             <select id="estado" name="estado" class="select">
                <option value="">Todos os status</option>
                <option value="trocado">Trocado</option>
                <option value="normal">Normal</option>
                
            </select>
        </td>
        <td align="right" width="100px">
        <?php
            $mes = date('m');
        ?>
            <select id="months" name="months" class="select">
                <option value="">Selecione o mês</option>
                <?php 
                $selected="selected='selected'";
                if ($mes==1) 
                {
                echo ' <option '.$selected.' value="1">Janeiro</option>';
                }
                if($mes==2) 
                {
                    
                    echo '<option '.$selected.' value="2">Fevereiro</option>';
                }
                if($mes==3)
                {
                    echo '<option '.$selected.' value="3">Março</option>';
                }
                if($mes==4)
                {
                    echo '<option '.$selected.' value="4">Abril</option>';
                }
                if($mes==5)
                {
                    echo '<option '.$selected.' value="5">Maio</option>';
                }
                if($mes==6)
                {
                    echo '<option '.$selected.' value="6">Junho</option>';
                }
                if($mes==7)
                {
                    echo '<option '.$selected.' value="6">Julho</option>';
                }
                if($mes==8)
                {
                   echo '<option '.$selected.' value="7">Agosto</option>';
                }
                if($mes==9)
                {
                    echo '<option '.$selected.'  value="7">Setembro</option>';
                }
                if($mes==10)
                {
                    echo '<option '.$selected.' value="7">Outubro</option>';
                }if($mes==11)
                {
                    echo '<option '.$selected.' value="11">Novembro</option>';
                }
                if($mes==12)
                {
                    echo '<option '.$selected.' value="12">Dezembro</option>';
                }
                
                ?>
                
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Marco</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
        </td>
        <td align="right" width="100px"> 
            <select id="year" name="year" class="select">
                <option value="">Selecione o ano</option>
                <?php
                    $ano = date("Y");
                    for($i=2013;$i<=$ano;$i++)
                    {
                        if($ano==$i){
                            $selected="selected='selected'";
                        }
                        else
                        {
                            $selected="";
                        }
                        echo "<option ".$selected." value='".$i."'>".$i."</option>";
                    }
                ?>
               
            </select>
        </td>
       
          
        <td>
        <a  onclick="return false();" id="impressao"><img width="45px" height="25px" src="<?php echo base_url('/assets/img/impressora.png');?>"></a>
        </td>
    </tr> 
</table>

<div style="padding: 5px 0px 5px 0px; height: 1px; width: 100%;"></div>

<div id="divRelatorio">
<table width="100%" class="tableRelatorio" id="tableRelatorio" style="table-layout: fixed; font-family:'Gadugi' Arial;">
</div>
</table>
</div>