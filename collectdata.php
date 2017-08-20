<?php
# Setup connection info
  $servername = "localhost";
  $username = "josh";
  $password = "052103Hannah";
  $dbname = "esp8266_test1";

# Set data for table and connect to db
  $lightstatus = $_GET['lightstatus'];
  $conn = mysql_connect("localhost", $username, $password);

# Check connection and abort if not connected
  if(!$conn)
  {
    die('Could not connect: ' . mysql_error());
  }

# Write some data to the db (date and lightstatus)
  $datenow = date('Y-m-d');
  $sql = "INSERT INTO 'test1'('logdate','lightstatus') VALUES (\"$datenow\",\"$lightstatus\")";
  $result = mysql_query($sql);
  if(!result) {
    die('Invalid query: ' . mysql_error());
  }

  # Let me know it posted the data & close db
  echo "<h1>The data has been sent!</h1>";
  mysql_close($conn);
?>
