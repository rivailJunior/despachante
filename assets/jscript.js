
function abrir(div, lvl) {
	if (lvl === 1) {
		if ($('#'+div).is(':visible')) {
			$('.divmenu1').slideUp('200');
			$('.divmenu2').slideUp('200');
			$('.titulo1').css('color','white');
			$('.titulo2').css('color','white');
		} else {
			$('.divmenu1').slideUp('200');
			$('.divmenu2').slideUp('200');
			$('#'+div).slideDown('200');
			$('.titulo1').css('color','white');
			$('.titulo2').css('color','white');
			
			$('#tit'+div).css('color','#FFE39E');			
		}
	}
	else
	{
		if($('#'+div).is(':visible'))
		{
			$('.divmenu2').slideUp('200');
			$('.titulo2').css('color','white');
		}
		else
		{
			$('.divmenu2').slideUp('200');
			$('#'+div).slideDown('200');
			$('.titulo2').css('color','white');
			$('#tit2'+div).css('color','#FFE8B5');
		}
	}
}

function GetClientUTC()
{
	var rightNow = new Date();

	var mes = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	document.getElementById("data").innerHTML = "Manaus, "+rightNow.getDate()+" de "+mes[rightNow.getMonth()]+" de "+rightNow.getFullYear()+"<br>";

	var saud;
	if(rightNow.getHours() > 0 && rightNow.getHours() < 12)
	{
		saud = "Bom dia!";
	}
	else if(rightNow.getHours() >= 12 && rightNow.getHours() < 18)
	{
		saud = "Boa tarde!";
	}
	else if(rightNow.getHours() >= 18 && rightNow.getHours() <= 23)
	{
		saud = "Boa noite!";
	}
	else if(rightNow.getHours() == 0)
	{
		saud = "Boa noite!";
	}
    var nome = $('INPUT#userName').val();
	document.getElementById("saud").innerHTML = saud+" "+nome;
	
	setTimeout(GetClientUTC, 3600000); //executa a função a cada hora
}

function closePop(rediret)
{
	$('.popup').hide('fast');
	$('.popup-modal').hide();
	window.location = rediret;
	
}
function closeAviso(rediret)
{
	$('.avisos').hide();
	$('.popup-modal').hide();
	window.location = rediret;
}

function fechar2()
{
	apprise('Pretende mesmo sair do sistema?', {'verify':true, 'textYes':'Sim', 'textNo':'Não'}, function(r) {
		if(r) {
            window.open('', '_self');
			window.close();
        }
	});


	var conf = confirm('Tem a certeza que pretende sair do sistema?');
	if (conf) 
	{
		window.open('', '_self');
		window.close();
	};
}
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') return false;
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
     
    // Valida 1o digito
    add = 0;
    for (i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
     
    // Valida 2o digito
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
         
    return true;
    
}

function validarCNPJ(cnpj) {
   cnpj = cnpj.replace(/[^\d]+/g,'');
   //if(cnpj == '') return true;  //Nao todos os campos CNPJ sao obrigatorios, pode ficar em branco
   var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
   digitos_iguais = 1;
 
   if (cnpj.length < 14 && cnpj.length < 15){
      return false;
   }
   for (i = 0; i < cnpj.length - 1; i++){
      if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
         digitos_iguais = 0;
         break;
      }
   }
 
   if (!digitos_iguais){
      tamanho = cnpj.length - 2
      numeros = cnpj.substring(0,tamanho);
      digitos = cnpj.substring(tamanho);
      soma = 0;
      pos = tamanho - 7;
 
      for (i = tamanho; i >= 1; i--){
         soma += numeros.charAt(tamanho - i) * pos--;
         if (pos < 2){
            pos = 9;
         }
      }
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(0)){
         return false;
      }
      tamanho = tamanho + 1;
      numeros = cnpj.substring(0,tamanho);
      soma = 0;
      pos = tamanho - 7;
      for (i = tamanho; i >= 1; i--){
         soma += numeros.charAt(tamanho - i) * pos--;
         if (pos < 2){
            pos = 9;
         }
      }
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(1)){
         return false;
      }
      return true;
   }else{
      return false;
   }
}
//**********************************************************************/
//********************VALIDACOES****************************************/
function validar_required(campo)
{
	if (!campo.val()){
		campo.removeClass('valido');
		campo.addClass('error');
		return false;
	}
	else
	{
		campo.removeClass('error');
		campo.addClass('valido');
		return true;
	}
}

//**********************************************************************/
//********************IMPRIMIR RELATORIOS******************************/
function printDiv(id, pg) {
	var oPrint, oJan;
	oPrint = window.document.getElementById(id).innerHTML;
	oJan = window.open(pg);
	oJan.document.write(oPrint);
	oJan.focus();
	oJan.window.print();
	oJan.document.close();
}