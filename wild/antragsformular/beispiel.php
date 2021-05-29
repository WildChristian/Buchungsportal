<?php
    include "./private/dbconnection.inc.php";
    $conn = mysqli_connect($servername, $username, $password, $db);
      if (!$conn) {
      echo "Das war wohl nichts!";
      }
    $result = mysqli_query($conn, "SELECT * FROM ANTRAG WHERE status = 'offen'");
    while($row = mysqli_fetch_assoc($result)) {
     echo $row['ID']." ".$row['raum']."\n";
    }
   

    mysqli_close($conn);
?>   
