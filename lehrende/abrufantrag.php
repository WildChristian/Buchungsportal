<?php
session_start();  
if ( $_SESSION["rolle"] === "lehrende" ){
include "/var/www/html/swe2_2020team09/private/dbconnection.inc.php";
$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
  echo "Es hat sich nicht gelohnt";
}

$nutzer = $_SESSION["user"];
$result = mysqli_query($conn, "SELECT * FROM ANTRAG WHERE nutzer = '$nutzer' ");
while($row = mysqli_fetch_assoc($result)) {
  echo $row['ID'] . "#" . $row['nutzer'] . "#" .  $row['veranstaltung']."#".$row['datum']."#".$row['zeit']."#".$row['raum']."#" . $row['notiz'] . "#" . $row['adminnotiz'] . "#" . $row['status'] . ":#";
}
mysqli_close($conn);
}else{
  header("Location: ../login.php");
}
?>
