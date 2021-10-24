<?php
  $serverName = "localhost";
  $databaseName = "pmsdb";
  $userName = "PMS";
  $password = "pmspwd";

  $con=mysqli_connect($serverName, $userName, $password, $databaseName);
  if(mysqli_connect_errno()){
    echo "Connection Failed: ".mysqli_connect_error();
  }
?>