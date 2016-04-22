<script src="<?php echo base_url('/assets/selectize.min.js')?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/selectize.input.css')?>" />
<script>
    var des_selecionado;
    var resCheckCHP;
    var dadosKit;
    var salvarKits = 0;

    function checkCHPs(qtd, tipoKit)
    {
        //alert(qtd+' '+tipoKit);
        $.ajax({
            url: "<?php echo site_url('administrador/servico/checkCHPs'); ?>",
            type: 'POST',
            dataType: 'json',
            data: {
                'qtd': qtd,
                'tipo':tipoKit
            },
            success: function(res) {
                console.log('res: ' + JSON.stringify(res));
                resCheckCHP = res;
                if (res[0] == 'xx') 
                {
                    $('.aviso').remove();
                    $('#quantidade').removeClass('inputWarning');
                    $('#quantidade').after('<span class="aviso warning qtdWarning">!</span>');
                    $('#quantidade').addClass('inputWarning');
                    $('#btCancelar').after('<span class="aviso warning">A quantidade indicada ultrapassa em <b>'+resCheckCHP[1]+'</b> o limite da sequência de CHP.</span>');
                    $('#btEnviar').val('continuar');
                } 
                else
                {
                    $('.aviso').remove();
                    $('#quantidade').removeClass('inputWarning');
                    $('#btCancelar').after('<span class="aviso success">Sequência de CHP OK.</span>');
                    $('#btEnviar').val('gerar');
                };
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var w = window.open();
                var html = '<b>Resposta do servidor</b><br><hr>'+xhr.responseText+'<br><br><b>Erro</b><br><hr>'+thrownError;
                $(w.document.body).html(html);
            }
        });
    }

    function validarNovaSeq(seqFim)
    {
        var pass = 1;
        var vals = [];
        $('#gerar .input').each(function(index){
            if ($(this).val() == '' || !$.isNumeric($(this).val())) 
            {
                $(this).addClass('invalido');
                $('#gerar .invalido:first').focus();
                pass = pass && 0;
            }
            else
            {
                $(this).removeClass('invalido');
                pass = pass && 1;

                vals[index] = $(this).val();

                if (index == 1) 
                {
                    if (parseInt(vals[0]) < parseInt(seqFim)) 
                    {
                        $('#gerar .input').eq(0).addClass('invalido');
                        $('#gerar .invalido:first').focus();
                        pass = pass && 0;
                    }
                    else
                    {
                        if (parseInt(vals[0]) >= parseInt(vals[1])) 
                        {
                            $('#gerar .input').addClass('invalido');
                            $('#gerar .invalido:first').focus();
                            pass = pass && 0;
                        } 
                        else if (parseInt(vals[0]) < parseInt(vals[1])) 
                        {
                            $('#gerar .input').removeClass('invalido');
                            pass = pass && 1;
                        };
                    }
                }
            }
        })
        return pass;
    }

    $(document).ready(function(){

    	$("#quantidade").mask("9999999");

    	$("#btCancelar").click(function(){
    		$("#kit").slideUp();
            $('#gerar_kit').removeClass('activeNovoButton');
    	});

        $("#create").validate({
    		rules:{
                quantidade:{required:true},
                hidden_mat:{required:true},
                tipoPagamento:{required:true},
                tipoKit:{required:true}
            },
            errorClass: 'invalido',
            errorPlacement: function() {
                return false;
            },
    		submitHandler: function(form){
                var kit = $('#create').serializeArray();
                dadosKit = kit;
                console.log(kit);
                if ($('#btEnviar').val() == 'continuar') 
                {
                    var qtd = $('#quantidade').val();
                    $('#gerarKitOpt').load("<?php echo site_url('administrador/servico/loadGerarKitOpt'); ?>",{res:resCheckCHP, qtd: qtd}, function(){
                        $('.modal').addClass('showModal');
                        $(this).addClass('show');
                    });
                } 
                else
                {
                    alert('gerar');
                };
                return false;
                //console.log(kit);
    		}
        });
        

        //seleciona os produtos digitados no campo select box...
        selectProd = $('#despachante').selectize({
            valueField: 'codigo',
            labelField: 'nome',
            loadThrottle: 100,
            create: false,
            hideSelected: true,
            preload: false,
            openOnFocus: false,
            searchField: ['mCRDD', 'nome', 'mSINDESDAM', 'cpf'],
            load: function(query, callback){
                if (!query.length) return callback(); 
                $.ajax({
                    cache: false,
                    url: "<?php echo site_url('administrador/produto/listar_desp');?>",
                    type: 'POST',
                    dataType: 'json',
                   
                    success: function(res) {
                        callback(res.despachantes);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //var code = xhr.responseText.charCodeAt(0);
                        var w = window.open();
                        var html = '<b>Resposta do servidor</b><br><hr>'+xhr.responseText+'<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>'+thrownError;
                        $(w.document.body).html(html);
                        callback();
                    }
                });
            },
            render: {
                item: function(item, escape) {
                    return '<div>' +
                        '<span>' + escape(item.nome) + '</span>' + 
                        '<span hidden>|</span>' +
                        '<span hidden>' + escape(item.mCRDD) + '</span>' +
                    '</div>';
                },
                option: function(item, escape) {
                    return '<div style="text-align:left; font-size: 16px;">' +
                        '<span style="display: inline-block; text-align: right; padding-right:10px;width: 10%;"><b>' + escape(item.mCRDD) + '</b></span>' +
                        '<span style="display: inline-block; text-align: left; width: 90%; font-family: "Gadugi", Arial;">' + escape(item.nome)+ '</span>' +
                    '</div>';
                }
            },  
            onItemAdd: function(value, item){
                des_selecionado = value;
				$("#hidden_mat").val(value);
            },
            onItemRemove: function(){
                $("#hidden_mat").val('');
            }
        });//fim do selectize

        $('#quantidade').keyup(function(e){
            if ($('#tipoKit').val() != '' && $.isNumeric($(this).val())) 
            {
                checkCHPs($(this).val(), $('#tipoKit').val());
            }
            else
            {
                $('.aviso').remove();
                $('#quantidade').removeClass('inputWarning');
            }
        })

        $('#tipoKit').change(function(){
            if ($('#quantidade').val() > 0 && $(this).val() != '') 
            {
                checkCHPs($('#quantidade').val(), $(this).val());
            }
            else
            {
                $('.aviso').remove();
                $('#quantidade').removeClass('inputWarning');
            }
        })

        
        $('#gerarKitOpt').on('click', '#btGerarCancelar', function(){
            $('#gerarKitOpt').removeClass('show');
            $('.modal').removeClass('showModal');
        })

        $('#gerarKitOpt').on('click', '#btGerarAlguns', function(){
            alert('gerar alguns');
        })

        $('#gerarKitOpt').on('click', '#btGerarTodos', function(){
            $('#divGerarKitBody').slideUp(function(){
                $('#divNovaSeq').slideDown(function(){
                    $('#novaSeqIn').focus();
                });
            });
        })

            $('#gerarKitOpt').on('click', '#btGerarCancelarFinal', function(){
                $('#divNovaSeq').slideUp(function(){
                    $('#divGerarKitBody').slideDown();
                    $('#gerar .input').removeClass('invalido');
                })
            })

            $('#gerarKitOpt').on('click', '#btGerarTodosFinal', function(){
                if(validarNovaSeq($('#seqFim').val()))
                {
                    var sIn = $('#novaSeqIn').val();
                    var sFim = $('#novaSeqFim').val();
                    $.ajax({
                        cache: false,
                        url: "<?php echo site_url('administrador/servico/checkSalvarKit/1');?>",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'formKit': JSON.stringify(dadosKit),
                            'inicio': sIn,
                            'fim': sFim
                        },
                        success: function(res) {
                            console.log(res);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var w = window.open();
                            var html = '<b>Resposta do servidor</b><br><hr>'+xhr.responseText+'<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>'+thrownError;
                            $(w.document.body).html(html);
                        }
                    });
                }
                else
                {
                    var n = noty({
                        layout: 'top',
                        type: 'error',
                        timeout: 3000,
                        text: 'Por favor preencha corretamente os campos. Note que o início da nova sequência não pode ser menor do que o final da sequência antiga.',
                        callback: {
                            afterClose: function() {$('#gerar .invalido:first').focus();}
                        }
                    });
                    $('#gerar .invalido:first').focus();
                }
            })
            


    });

</script>
<style type="text/css">
    
    #quantidade.inputWarning
    {
        border: 1px solid #D39700;
    }
    .aviso
    {
        display: inline-block;
        width: auto;
        text-align: center;  
        font-weight: normal;
        font-size: 15px;
        padding: 5px 10px 5px 10px;
        margin-left: 10px;
    }
    .warning
    {
        border: 1px solid #D39700;
        background: #FFC672;
        color: #B27900;
    }
    .success
    {
        border: 1px solid #007900;
        background: #8BE08B;
        color: #007900; 
    }
    .qtdWarning
    {
        width: 31px;
        height: 31px;        
        border-left: 0px;
        font-weight: bold;
        font-size: 21px; 
        padding: 0px;
        color: #D39700;
        margin: 0;
    }

</style>

<?php 
    if ($valor->num_rows() == 0)
    { 
        $valorkit = '0.00'; 
    }
    else 
    { 
        $dadoValorKit = $valor->row(); 
        $valorkit = $dadoValorKit->valorkit;  
    }
?>
 
<span class="createnovotitle">gerar kit</span>
<hr>

<form id="create" method="post">
    <input type="hidden" id="btCadastrarKits" value="<?php echo site_url('administrador/servico/pegarvalores');?>">
    <input type="hidden" id="btListar" value="<?php echo site_url('administrador/servico/listando');?>">

    <table class="tableNovo">
        <tbody>
            <tr>
                <td class="label"><label for="despachante">Despachante</label></td>
                <td width="400">
                    <select id="despachante" name="despachante">
                    </select>
                    <input type="hidden" id="hidden_mat" name="hidden_mat" value="">
                </td>
                <td class="label">
                    <label>Valor</label>
                </td>
                <td width="400">
                    <input type="text" disabled="disabled" class="input" value="<?php echo 'R$ '.$valorkit; ?>">
                    <input type="text" hidden class="input" id="valorKit" name="valorKit" value="<?php echo $valorkit; ?>">
                </td>
            </tr>
            <tr> 
                <td class="label">
                    <label for="quantidade">Quantidade</label>
                </td>
                <td>
                    <input name="quantidade" type="text" class="input" id="quantidade" value="<?php echo set_value('quantidade')?>">
                </td>
                <td class="label"><label for="tipoKit">Tipo kit</label></td>
                <td>
                    <select class="select" id="tipoKit" name="tipoKit">
                        <option value="">Selecione</option>
                        <option value="c">CNH</option>
                        <option value="v">Veículo</option>
                    </select>
                </td>
                
            </tr>
            <tr>
                <td colspan="2" rowspan="2" align="center" style="color: #353535;">
                    <span style="display: block; font-weight: bold; padding-bottom: 10px;">IMPRESSÃO</span>

                    <div style="display: inline-block; padding: 0px 8px 0px 8px;">
                        <input type="checkbox" class="checkbox" value="sim" id="checkProcuracao" checked="checked" name="checkProcuracao" style="vertical-align: text-bottom;">
                        <label for="checkProcuracao">Procuração</label>
                    </div>
                    <div style="display: inline-block; padding: 0px 8px 0px 8px;">
                        <input type="checkbox" class="checkbox" value="sim" id="checkRequerimento" checked="checked" name="checkRequerimento" style="vertical-align: text-bottom;">
                        <label for="checkRequerimento">Requerimento</label>
                    </div>
                    <div style="display: inline-block; padding: 0px 8px 0px 8px;">
                        <input type="checkbox" class="checkbox" value="sim" id="checkEtiqueta" checked="checked" name="checkEtiqueta" style="vertical-align: text-bottom;">
                        <label for="checkEtiqueta">Etiqueta</label>
                    </div>

                </td>
                <td class="label"><label for="tipoPagamento">Tipo pagamento</label></td>
                <td valign="top">
                    <select class="select" id="tipoPagamento" name="tipoPagamento">
                        <option value="">Selecione</option>
                        <option value="d">Dinheiro</option>
                        <option value="c">Cartão</option>
                        <option value="db">Depósito Bancário</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label"><label for="numPag">Comprovante pag.</label></td>
                <td>
                    <input name="numPag" type="text" class="input" id="numPag" placeholder="" value="<?php echo set_value('numPag')?>">
                </td> 
            </tr>
            <tr>
                <td colspan="4">
                    <input class="formButton submit" type="submit" value="gerar" id="btEnviar" name="btEnviar" />
                    <input class="formButton cancel" type="button" value="cancelar" id="btCancelar" />
                </td>
            </tr>
        </tbody>
    </table>
</form>   
