<?php
session_start();  
if ( $_SESSION["rolle"] === "lehrende" ){

 include "/var/www/html/swe2_2020team09/private/dbconnection.inc.php";
   $conn = mysqli_connect($servername, $username, $password, $db);
      if (!$conn) {
      echo "Das war wohl nichts!";
      }
   

  $veranstaltung = $_GET["veranstaltung"];
  $tag = $_GET["datum"];
  $von = $_GET["von"];
  $bis = $_GET["bis"];
  $zeit = $von . "-" . $bis;
  $raum = $_GET["raum"];
  $notiz = $_GET["notiz"];
  $user = $_SESSION["user"];
 
  
  if($veranstaltung == "" || $tag == "" || $zeit == ""){
    echo "-1";
  }else if(mysqli_query($conn,$abgleich)){
    echo "-2";
  }else{

    $eintrag = "INSERT INTO ANTRAG (veranstaltung,status,nutzer,datum,zeit,raum,notiz) VALUES ('$veranstaltung','offen','$user','$tag','$zeit','$raum','$notiz')";
    $eintragen = mysqli_query($conn, $eintrag);
    mysqli_close($conn);
    echo "0";
    }
}else{

  header("Location: ../../login.php");
}  
?>
