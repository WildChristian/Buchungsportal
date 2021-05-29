<?php
 include "/var/www/html/swe2_2020team09/private/dbconnection.inc.php";
   $conn = mysqli_connect($servername, $username, $password, $db);
      if (!$conn) {
      echo "Das war wohl nichts!";
      }
   

  $veranstaltung = $_GET["veranstaltung"];
  $tag = $_GET["datum"];
  $zeit = $_GET["zeit"];
  $raum = $_GET["raum"];
  $notiz = $_GET["notiz"];
 
  
  if($veranstaltung == "" || $tag == "" || $zeit == ""){
    echo "-1";
  }else if(mysqli_query($conn,$abgleich)){
    echo "-2";
  }else{

    $eintrag = "INSERT INTO ANTRAG (veranstaltung,status,datum,zeit,raum,notiz) VALUES ('$veranstaltung','offen','$tag','$zeit','$raum','$notiz')";
    $eintragen = mysqli_query($conn, $eintrag);
    mysqli_close($conn);
    echo "0";
    }
  
?>
