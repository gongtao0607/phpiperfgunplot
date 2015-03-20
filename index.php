<?php
if($_POST["submit"]=="reboot"){
	shell_exec('sudo /sbin/reboot');
}else if($_POST["submit"]=="submit"){
	$dom = new DOMDocument('1.0','utf-8');
	$config=$dom->appendChild($dom->createElement("config"));
	$config->appendChild($dom->createElement("server",$_POST["server"]));
	$config->appendChild($dom->createElement("port",$_POST["port"]));
	$config->appendChild($dom->createElement("interval",$_POST["interval"]));
	$config->appendChild($dom->createElement("interval_cnt",$_POST["interval"]));
	$dom->formatOutput = ture;
	$dom->saveXML();
	$dom->save('config.xml');
	unlink('output.csv');
	header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
}
$xml = simplexml_load_file('config.xml');
$server=$xml->server;
$port=$xml->port;
$interval=$xml->interval;
shell_exec("cat template.gp | gnuplot");
?>
<html>
<head>
<meta charset="UTF-8">
<title>Setting Up</title>
</head>
<body>
<table align="center">
<form method=POST>
<tr>
	<td colspan=2><img src="output.png"/></td>
</tr>
<tr>
	<td>Server</td>
	<td><input type="text" name="server" value="<?echo $server?>"/></td>
</tr>
<tr>
	<td>Port</td>
	<td><input type="text" name="port" value="<?echo $port?>"/></td>
</tr>
<tr>
	<td>Measure Interval (every _ minuts)</td>
	<td><input type="text" name="interval" value="<?echo $interval?>"/></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="submit" value="submit"/></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="submit" value="reboot" onClick="return(confirm('Confirm to reboot?'))"/></td>
</tr>
</form>
</table>
</body>
</html>
