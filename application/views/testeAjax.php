<!DOCTYPE html>
<html>
    <head>
        <script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js');?>"></script>
        <script src="<?php echo base_url('/assets/selectize.min.js')?>" type="text/javascript"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/selectize.default.css')?>" />

        <meta charset="UTF-8">
        
    <script>
      
     
   function verifica(){  
       alert("aqui");
   $(document).ready(function (){
  var nome = $("#user_name").val();
  $.ajax({
   type: "POST",
   url: "<?php echo site_url('testeajax/check_user');?>",
   data: {
       'name':nome
   },  success: function(res) {
                        console.log("res: "+res);
                        if(res==1){
                            alert('existe');
                          }else{
                            alert("nao existe");
                        }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
            alert('fracassoou total');                                
            var w = window.open();
            var html = '<b>Resposta do servidor</b><br><hr>' + xhr.responseText + '<br>Codigo primeiro char: <br><br><b>Erro</b><br><hr>' + thrownError;
            $(w.document.body).html(html);                    
        }
  });
 });
        }
        
</script>
 
        <title></title>
    </head>
    <body>
        <?php
       echo $teste;
        ?>
  <p>
 <label for="user_name">User Name:</label>
 <select id="selectDes" name="selectDes">  
 </select>
  </p>
  
  <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name');?>">
  <input type="button" name="botao"  value="verifica" onclick="verifica();">
    </body>
</html>
