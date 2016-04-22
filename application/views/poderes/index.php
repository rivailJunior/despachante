<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title;?></title>
    </head>
    <body>
        <?php
        echo $content;
        ?>
        <div>
            <button><a href="<?php echo site_url('administrador/poderes/cadastrarPoderes');?>">Cadastrar Poderes</a></button>
        </div>
    </body>
</html>
