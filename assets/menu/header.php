<?php 
	//conexão como banco de dados
	//require_once 'conexao/conexao.php';
	//include do conteudo via parameto GET
	//$pg = $_GET['pg']; if(empty($pg)){ $pg = 'home'; } 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Layout 1 - Sistemas Adapt Data</title>
	<!-- CSS -->
    <link href="files/lib/css/structure.css" rel="stylesheet" type="text/css" />
    
    <!-- MENU PRINCIPAL LATERAL -->
    <link rel="stylesheet" type="text/css" href="files/lib/jquery/menu/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="files/lib/jquery/menu/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="files/lib/jquery/menu/css/icons.css" />
    <link rel="stylesheet" type="text/css" href="files/lib/jquery/menu/css/component.css" />
    <script src="files/lib/jquery/menu/js/modernizr.custom.js"></script>
    
  
</head>

<body>
<!--<form name="teste">
        <input type="text" name="cpf" onkeyup="maskIt(this,event,'###.###.###-##')" />
</form>-->
<div class="container">
    <!-- Push Wrapper -->
    <div class="mp-pusher" id="mp-pusher">

<?php 
	require_once'files/lib/jquery/menu/menu.php';
?>