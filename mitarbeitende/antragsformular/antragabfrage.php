<?php
session_start();  
if ( $_SESSION["rolle"] === "mitarbeitende" ) {

   include "/var/www/html/swe2_2020team09/private/dbconnection.inc.php";
    $antragsnummer= $_GET["id"];
    $conn = mysqli_connect($servername, $username, $password, $db);
      if (!$conn) {
      echo "Das war wohl nichts!";
    }
    $tmp = mysqli_query($conn, "SELECT * FROM ANTRAG WHERE ID = $antragsnummer");
    $values = mysqli_fetch_assoc($tmp);
    $antragsnummer = $values['ID'];
    $nutzer = $values['nutzer'];
    $veranstaltung = $values['veranstaltung'];
    $datum = $values['datum'];
    $zeit = $values['zeit'];
    $raum = $values['raum'];
    $notiz = $values['notiz'];

    mysqli_close($conn);
    echo $antragsnummer . ':' .   $nutzer . ':' . $veranstaltung . ':' .  $datum . ':' .  $raum . ':' . $zeit . ':' . $notiz ;
}else {
  header("Location: ../../login.php");
}
?>
