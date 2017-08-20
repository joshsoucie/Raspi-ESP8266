<?php
# Setup connection info
  $servername = "localhost";
  $username = "josh";
  $password = "052103Hannah";
  $dbname = "esp8266";

# Set data for table and connect to db
  $lightState = $_GET['lightState'];
  $conn = mysql_connect($servername, $username, $password);

# Check connection and abort if not connected
  if(!$conn)
  {
    die('Could not connect: ' . mysql_error());
  }

# Write some data to the db (DATE and lightState into the table, lightStatus)
  $datenow = date('Y-m-d');
  $sql = sprintf("INSERT INTO lightStatus (logdate,lightState) VALUES ('%s',$lightState)", mysql_real_escape_string($datenow));
  echo "Light State is: ", $lightState, "\n";
  echo $sql, "\n";
  $result = mysql_query($sql);
  if(!result) {
    die('Invalid query: ' . mysql_error());
  }

  # Let me know it posted the data & close db
  echo "<h1>The data has been sent!</h1>\n";
  mysql_close($conn);
?>
