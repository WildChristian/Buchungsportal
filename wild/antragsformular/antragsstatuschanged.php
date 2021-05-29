<?php

 include "/var/www/html/swe2_2020team09/private/dbconnection.inc.php";
//include Datanbank zu gebuchten Zeiten

$status = $_GET["bool"];
$notiz = $_GET["notizen"];
$id = $_GET["id"];

    $conn = mysqli_connect($servername, $username, $password, $db);
      if (!$conn) {
      echo "Das war wohl nichts!";
    }
  
    if($status == genehmigt){
      $bestaetigen = "UPDATE ANTRAG SET status = 'genehmigt',adminnotiz = '$notiz' WHERE ID = $id"; 
      $bestaetigung = mysqli_query($conn, $bestaetigen);
      // Hier muss jetzt eine Verbindung zu der Datenbank für die Buchungen sein 
    }else if ($status == abgelehnt){
      $ablehnen = "UPDATE ANTRAG SET status = 'abgelehnt',adminnotiz = '$notiz' WHERE ID = $id"; 
      $ablehnen = mysqli_query($conn, $ablehnen);

    }
    mysqli_close($conn);
    echo "0";
?>
