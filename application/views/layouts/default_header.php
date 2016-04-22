<!DOCTYPE html>
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    
    <!-- MENU PRINCIPAL LATERAL -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/menu/files/lib/css/structure.css');?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/menu/files/lib/jquery/menu/css/normalize.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/menu/files/lib/jquery/menu/css/demo.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/menu/files/lib/jquery/menu/css/icons.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/menu/files/lib/jquery/menu/css/component.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/styles.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('/assets/apprise.css');?>" type="text/css" />
    

    
    <link rel="stylesheet"  href="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/development-bundle/themes/ui-lightness/jquery-ui.css')?>">



    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style_tabelas.css') ?>" />

    <script  src="<?php echo base_url('/assets/menu/files/lib/jquery/menu/js/modernizr.custom.js');?>" type="text/javascript"></script>

    <script src="<?php echo base_url('/assets/cal.js');?>" type="text/javascript"></script>
    
    <script src="<?php echo base_url('/assets/jQuery_1.9.x.js'); ?>" type="text/javascript"></script>
    
    <script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/development-bundle/jquery-1.9.1.js');?>"></script>              
    
    <script src="<?php echo base_url('/assets/jquery-1.10.1.js'); ?>" type="text/javascript"></script>
    
    <script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js'); ?>" type="text/javascript"></script>
    
    <script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.effect.js');?>"></script>
    
    <script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.effect-blind.js');?>"></script>
    
    <script src="<?php echo base_url('/assets/jquery.mask.min.js'); ?>" type="text/javascript"></script> 
    
    <script src="<?php echo base_url('/assets/js/jquery.validate.js'); ?>" type="text/javascript"></script>
    
    <script src="<?php echo base_url('/assets/jquery-maskmoney-master/jquery-maskmoney-master/dist/jquery.maskMoney.js'); ?>" type="text/javascript"></script>
    
    <script src="<?php echo base_url('/assets/jquery-maskmoney-master/jquery-maskmoney-master/dist/jquery.maskMoney.min.js'); ?>" type="text/javascript"></script>
    
    
    
    
    <script type="text/javascript" src="<?php echo base_url('/assets/jquery.livequery.js');?>"></script>

        <!--
        <script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.core.js');?>"></script>
        <script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.widget.js');?>"></script>
        <script src="<?php echo base_url('/assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.datepicker.js');?>"></script>
    --> 


    <script src="<?php echo base_url('/assets/noty/jquery.noty.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/noty/top.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/noty/inline.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/noty/topCenter.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/noty/default.js')?>" type="text/javascript"></script>   

    <script type="text/javascript" src="<?php echo base_url('/assets/apprise-1.5.js');?>"></script>


    

    <title><?php echo ($title); ?></title>
</head>

<body>

  
    <div class="container" >
        <!-- Push Wrapper -->
        <div class="mp-pusher" id="mp-pusher" >
            <!-- mp-menu -->
            <nav id="mp-menu" class="mp-menu" >

                <div class="mp-level" >
                    <h2 class="icon icon-world">Menu Principal</h2>
                    <ul>
                        
                        
                        <li class="icon icon-arrow">
                            <a class="icon icon-news" href="<?php echo site_url('despachante');?>">Início</a>
                        </li>
                        
                        
                        <li class="icon icon-arrow-left">
                            <a class="icon icon-settings" href="#">Gerênciar</a>
                            <div class="mp-level">
                                <h2 class="icon icon-display">Gerênciar</h2>
                                <a class="mp-back" href="#">Voltar</a>
                                <ul>
                                    <li class="icon icon-diamondt">
                                        <a class="icon icon-user" href="<?php echo site_url('administrador/usuario/listar');?>">Usuários</a>
                                    </li>

                                    <li class="icon icon-diamondt">
                                        <a class="icon icon-phone" href="<?php echo site_url('despachante/listar');?>">Despachantes</a>
                                    </li>
                                    
                                 <!--
                                <li class="icon icon-diamondt">
                                    <a class="icon icon-tv" href="<?php echo site_url('administrador/outorgante/listar');?>">Outorgantes</a>
                                </li>
                            --> 
                            
                            <li class="icon icon-diamondt">
                                <a class="icon icon-tv" href="<?php echo site_url('administrador/produto/listar');?>">Produtos</a>
                            </li>

                            <li class="icon icon-diamondt">
                                <a class="icon icon-settings" href="<?php echo site_url('administrador/configurar');?>">Configurações</a>
                            </li>

                                <!--<li class="icon icon-diamondt">
                                    <a class="icon icon-camera" href="<?php echo site_url('administrador/veiculo/listar');?>">Veículos</a>
                                </li>-->     
                                 <!--<li class="icon icon-diamondt">
                                    <a class="icon icon-camera" href="<?php echo site_url('administrador/poderes/');?>">Poderes</a>
                                </li> --> 
                            </ul>
                        </div>
                    </li>
                    

                    <li class="icon icon-arrow-left">
                        <a class="icon icon-display" href="#">Serviço</a>
                        <div class="mp-level">
                            <h2 class="icon icon-display">Serviço</h2>
                            <a class="mp-back" href="#">Voltar</a>
                            <ul>
                                <li class="icon icon-diamondt">
                                    <a class="icon icon-phone" href="<?php echo site_url('/administrador/servico/listando');?>">Kit</a>
                                </li>
                                
                                <li class="icon icon-diamondt">
                                    <a class="icon icon-tv" href="<?php echo site_url('administrador/venda/realizar_venda');?>">Venda</a>
                                    <!-- <ul>
                                        <li class="icon icon-diamondt">
                                            <a class="icon icon-phone" href="<?php echo site_url('administrador/venda/relatorioVendas');?>">Relatorio Vendas</a>
                                        </li>
                                    </ul>
                                     <ul>
                                        <li class="icon icon-diamondt">
                                            <a class="icon icon-phone" href="<?php echo site_url('administrador/servico/relatorio_kits');?>">Relatorio Servicos</a>
                                        </li>
                                    </ul> -->
                                </li>
                                
                            </ul>
                        </div>
                    </li>


                    <li class="icon icon-arrow-left">
                        <a class="icon icon-news" href="#">Relatórios</a>
                        <div class="mp-level">
                            <h2 class="icon icon-display">Relatórios</h2>
                            <a class="mp-back" href="#">Voltar</a>
                            <ul>
                                <li class="icon icon-diamondt">
                                    <a class="icon icon-phone" href="<?php echo site_url('administrador/servico/relatorio_kits');?>">Kits</a>
                                </li>
                                
                                <li class="icon icon-diamondt">
                                    <a class="icon icon-tv" href="<?php echo site_url('administrador/venda/relatorioVendas');?>">Vendas</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    
                    
                    <li>
                        <a class="icon icon-photo" href="<?php echo site_url('Login/logout_user');?>">Sair</a>
                    </li>

                </ul>
                
            </div>
        </nav>
        <!-- /mp-menu -->   

        <div class="modal"></div>

        <div id="safe-top">
            <div id="top">
                <span class="left">
                    <div id="menu">
                        <a href="#" id="trigger" class="menu-trigger" title="Menu Principal">
                            <div id="iconn"></div>
                            <div id="menuLabel">MENU</div>
                        </a>
                    </div>
                    <div id="logo" style="background-image: url('<?php echo base_url('assets/img/logoDespach.png'); ?>');"> 
                    </div>
                </span>
                <div class="right" id="perfilWrapper">
                    <div id="nomePerfil">
                        <?php echo $usuario['nome'];?>    
                    </div>
                    <div id="logoPerfil"></div>
                </div>
            </div>
        </div>

        <div id="centro">    
