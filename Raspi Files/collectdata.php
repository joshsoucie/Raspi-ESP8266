<?php
# Setup connection info
  $servername = "localhost";
  $username = "josh";
  $password = "052103Hannah";
  $dbname = "esp8266";

# Set data for table and connect to db
  $lightState = $_GET['lightState'];
  $conn = mysqli_connect($servername, $username, $password, $dbname);

# Check connection and abort if not connected
  if(!$conn)
  {
    die('Could not connect: ' . mysqli_error());
  }

  echo "Connected Successfully!";

# Write some data to the db (DATE and lightState into the table, lightStatus)
  $datenow = date('Y-m-d');
  $sql = sprintf("INSERT INTO lightStatus (logdate,lightState) VALUES ('$datenow',$lightState)");
  echo $sql, "\n";

  if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  # Let me know it posted the data & close db
  mysqli_close($conn);
?>
