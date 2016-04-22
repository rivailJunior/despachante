<?php
	$status = false;
	
	if ($status) {
		$ad = mysql_connect('localhost', '', '') or die(mysql_error());
		$database_ad = mysql_select_db('', $ad);
	} else {
		$ad = mysql_connect('localhost', 'root', '') or die(mysql_error());
		$database_ad = mysql_select_db('adaptdata_system', $ad);
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
?>