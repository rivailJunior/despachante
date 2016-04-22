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
    #foot tr{
       
    }
    
</style>
<script>

   
$(document).ready(function (){
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

    $("#year").hide();
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

<div id="relServWrapper" style="position: absolute; width: 1200px; height: 200px; left: 0px; top: 60px;">
    <input type="hidden" id="reloadTableListar" value="<?php echo site_url('administrador/servico/relatorio_filtrado');?>">
    <input type="hidden" id="btExcluir" value="<?php echo site_url('despachante/excluir'); ?>">
    <input type="hidden" id="btListar"  value="<?php echo site_url('despachante/listar'); ?>">

    <div style="color: #4C4C4C; font-size: 26px;">Seja muito bem-vindo ao Sistema ADAPT Despachante, <?php echo '<b>'.$usuario['nome'].'</b>'; ?>.</div>
    <div style="color: #4C4C4C; font-size: 18px;">Utilize o menu, no canto superior esquerdo da tela, para acessar a todas as funcionalidades do Sistema.</div>

    <hr>

    <span align="left" class="pageTitle">Kits <?php echo $mes; ?></span>    
    <div style="padding: 5px 0px 5px 0px; height: 1px; width: 100%;"></div>
    <table width="100%" class="tableRelatorio" id="tableRelatorio" style="table-layout: fixed; font-family:'Gadugi' Arial;">
    </table>
</div>