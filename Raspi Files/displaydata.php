<?php

$servername = "localhost";
$username = "josh";
$password = "052103Hannah";
$dbname = "esp8266";
$tablename = "lightStatus";
$datenow = date('Y.m.d');
$timenow = date('G.i');

$sql_on = "select * from " . $tablename . " where lightState = '1'";
$sql_off = "select * from " . $tablename . " where lightState = '0'";

$conn = mysql_connect($servername, $username, $password) or die ("Fail");
mysql_select_db($dbname, $conn);

$result_on = mysql_query($sql_on, $conn);
$result_off = mysql_query($sql_off, $conn);

$totOn = mysql_num_rows($result_on);
$totOff = mysql_num_rows($result_off);

/*
$data = array("On" => $totOn, "Off" => $totOff);

$graph->addData($data);
$graph->setLabelTextColor(“black”);
$graph->setLegentTextColor(“black”);
$graph->setBackgroundColor(“pastel_green_1”);
$graph->createGraph();
*/

echo "<table><tr><th>On</th><th>Off</th></tr>";
echo "<table><tr><td>" . $totOn . "</td><td>" . $totOff . "</td></tr>";
echo "</table>";

$myfile = fopen("esp8266data.txt", "w") or die("Unable to open file!");
$txt = $timenow . "/n" . $totOn . "\n" . $totOff . "\n"; fwrite($myfile, $txt);
fclose($myfile);

mysql_close($conn);

 ?>
