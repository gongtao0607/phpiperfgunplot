<?php
$xml = simplexml_load_file('config.xml');
$server=$xml->server;
$port=$xml->port;
$interval=$xml->interval;
$interval_cnt=intval($xml->interval_cnt);
if($interval_cnt<$interval){
	$interval_cnt++;
	$xml->interval_cnt=$interval_cnt;
	$xml->asXml('config.xml');
	exit(0);
}else{
	$interval_cnt=1;
	$xml->interval_cnt=$interval_cnt;
	$xml->asXml('config.xml');
}
shell_exec("iperf -c {$server} -p {$port} -y C | cut -d, -f 1,9 >> output.csv");
?>
