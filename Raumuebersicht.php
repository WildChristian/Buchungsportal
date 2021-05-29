<?php
session_start();  
if ( $_SESSION["login"] === "true" ) :?>
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Raumübersicht</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<style>
table {
  border-collapse: collapse;
  margin: 0 auto;
}

table, th, td {
  border: 1px solid black;
  text-align:center;
}
#Buchung th{cursor:pointer;
            background-color: #F0F8FF}
</style>
<body>
<?php
echo "<nav class='navbar navbar-light' style='background-color: #e3f2fd;'>
       <a class='navbar-brand'>Raumübersicht - Buchungssystem für die Online-Lehre an der HS Bremerhaven</a>


         
         <form class='form-inline' action ='./logout.php'>
         <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Logout </button>
         </form>

        </nav>";

include "private/dbconnection.inc.php";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM raumübersicht";
 
$db_erg = mysqli_query( $conn, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}
echo "<br><br>";

echo '<table border ="1">';

echo "<tr>
<th>Raum</th>
<th>Betreuung</th>
<th>LAN/WLAN</th>
<th>Kamera</th>
<th>Tafel/Whiteboard</th>
<th>Dokumentenkamera</th>";
while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
{
  echo "<tr>";
  echo "<td>". $zeile['raum'] . "</td>";
  echo "<td>". $zeile['betreuung'] . "</td>";
  echo "<td>". $zeile['lanwlan'] . "</td>";
  echo "<td>". $zeile['kamera'] . "</td>";
  echo "<td>". $zeile['tafelwhiteboard'] . "</td>";
  echo "<td>". $zeile['dokumentenkamera'] . "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br><br>";

$rolle = $_SESSION["rolle"];

if ($rolle == "mitarbeitende") {
  
 
$sql1 = "SELECT * FROM ANTRAG where status='genehmigt'";

$db_erg1 = mysqli_query( $conn, $sql1);
if (! $db_erg1)
{
  die('Ungültige Abfrage: '. mysqli_error());
}



echo '<table id ="Buchung">';

echo "<tr>
<th onclick='sortTable(0)'>BuchungsID</th>
<th onclick='sortTable(1)'>Nutzer</th>
<th onclick='sortTable(2)'>Veranstaltung</th>
<th onclick='sortTable(3)'>Datum</th>
<th onclick='sortTable(4)'>Zeit</td>
<th onclick='sortTable(5)'>Raum</td>";

while ($zeile = mysqli_fetch_array( $db_erg1, MYSQLI_ASSOC))
{
  echo "<tr>";
  echo "<td>". $zeile['ID'] . "</td>";
  echo "<td>". $zeile['nutzer'] . "</td>";
  echo "<td>". $zeile['veranstaltung'] . "</td>";
  echo "<td>". $zeile['datum'] . "</td>";
  echo "<td>". $zeile['zeit'] . "</td>";
  echo "<td>". $zeile['raum'] . "</td>";
  echo "</tr>"; 
}

echo "</table>"; }else{


$sql2 = "SELECT ID,veranstaltung,datum,zeit,raum FROM ANTRAG where status='genehmigt'";

$db_erg2 = mysqli_query( $conn, $sql2);
if (! $db_erg2)
{
  die('UngÃ¼ltige Abfrage: '. mysqli_error());
}



echo '<table id ="Buchung">';

echo "<tr>
<th onclick='sortTable(0)'>BuchungsID</th>
<th onclick='sortTable(1)'>Veranstaltung</th>
<th onclick='sortTable(2)'>Datum</th>
<th onclick='sortTable(3)'>Zeit</td>
<th onclick='sortTable(4)'>Raum</td>";

while ($zeile = mysqli_fetch_array( $db_erg2, MYSQLI_ASSOC))
{
  echo "<tr>";
  echo "<td>". $zeile['ID'] . "</td>";
  echo "<td>". $zeile['veranstaltung'] . "</td>";
  echo "<td>". $zeile['datum'] . "</td>";
  echo "<td>". $zeile['zeit'] . "</td>";
  echo "<td>". $zeile['raum'] . "</td>";
  echo "</tr>"; 
}

echo "</table>"; 

}
echo '
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("Buchung");
  switching = true;
  
  dir = "asc"; 
  
  while (switching) {
    
    switching = false;
    rows = table.rows;
    
    for (i = 1; i < (rows.length - 1); i++) {
      
      shouldSwitch = false;
      
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      
      switchcount ++;      
    } else {
    
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>';

echo "<form class='form-inline' action ='./$rolle/dashboard.php?'>
         <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Zurück zum Portal</button>
         </form>
"
?>


</body>
</html>

<?php endif; ?>

<?php if ( $_SESSION["login"] != "true" ) {

  header("Location: login.php");
}
?>
