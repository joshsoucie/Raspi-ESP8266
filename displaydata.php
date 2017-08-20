<!DOCTYPE html>
<html>
<head>
  <style>
  table, th, td {
    border: 1px solid black;
  }
  </style>
  <meta charset="utf-8"> <title>ESP8266 Output Data</title>
</head> <body>

    <?php

$servername = "localhost";
$username = "josh";
$password = "052103Hannah";
$dbname = "esp8266_test1";
$tablename = "test1";
$datenow = date('Y.m.d');
$timenow = date('G.i');

$sql = "select * from " . $tablename . " where lightstatus = 'On'";
$sql1 = "select * from " . $tablename . " where lightstatus = 'Off'";

$conn = mysql_connect($servername, $username, $password) or die ("Fail");
mysql_select_db($dbname, $conn);

$result = mysql_query($sql, $conn);
$result1 = mysql_query($sql1, $conn);

$totOn = mysql_num_rows($result);
$totOff = mysql_num_rows($result1);

echo "<table><tr><th>On</th><th>Off</th></tr>";
echo "<table><tr><td>" . $totOn . "</td><td>" . $totOff . "</td></tr>";
echo "</table>";

$myfile = fopen("esp8266data.txt", "w") or die("Unable to open file!");
$txt = $timenow . "/n" . $totOn . "\n" . $totOff . "\n"; fwrite($myfile, $txt);
fclose($myfile);

$conn->close();

 ?>

</body>
</html>
