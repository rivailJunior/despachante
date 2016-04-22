<!DOCTYPE html>
    <head> 
        <title>AdaptData Despachante :: Login</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style_login.css') ?>" />
        <link rel="stylesheet"  href="<?php echo base_url('/assets/jquery-ui.css') ?>">
        <script type="text/javascript" src="<?php echo base_url('/assets/jquery-2.0.2.js'); ?>" ></script>
        <script src="<?php echo base_url('/assets/js/rainbows.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/assets/jquery.mask.min.js'); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('/assets/js/jquery.validate.js'); ?>" type="text/javascript"></script>
        <script>

            $(document).ready(function() {

                $('#cpf').focus();

                $("#cpf").mask("999.999.999-99", {
                    onComplete: function() {
                        $("#senha").focus();
                    }
                });

                $('.inputLogin').focus(function(){
                    $(this).parent().addClass('focused');
                })

                $('.inputLogin').blur(function(){
                    $(this).parent().removeClass('focused');
                })

                $("#create").validate({
                    rules:{
                        cpf:{required:true},
                        senha:{required:true,password:true}
                    },
                    messages:{
                        cpf:{required:"preencher campo"},
                        senha:{required:"preencher campo"}
                    }
                });
                
                $("#submit1").hover(function() {
                    $(this).animate({"opacity": "0"}, "normal");
                }, function() {
                    $(this).animate({"opacity": "1"}, "normal");
                });

            });

        </script>
    </head>
    <body>

        <?php echo form_open('Login'); ?>

            <div id="wrapper">

                <span>Login</span>

                <div id="inputWrapperCPF" class="inputWrapper focused">
                    <input type="text" id="cpf" autocomplete="off" class="inputLogin" placeholder="CPF" name="cpf" value="<?php echo set_value('cpf') ?>">
                </div>

                <div class="spacer"></div>

                <div id="inputWrapperSENHA" class="inputWrapper">
                    <input type="password" autocomplete="off" id="senha" class="inputLogin" placeholder="Senha"  name="senha"  value="<?php echo set_value('senha') ?>">
                </div>

                <div class="errorWrapper">
                    <?php echo '<div>'.validation_errors('<a class="erro">', '</a>').'</div>'; ?>
                </div>

                <input type="submit" name="submit" id="submit" value="login" />

            </div>

        </form>

    </body>
</html>