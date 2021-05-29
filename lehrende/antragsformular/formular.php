<?php
session_start();  
if ( $_SESSION["rolle"] === "lehrende" ) : ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script>
 

     function antrag() {
       let req = new XMLHttpRequest();
       req.onreadystatechange = function() {
       if (req.readyState == 4 && req.status == 200) {
         if(req.responseText == 0){
           document.getElementById("alarm").className = "alert alert-success";
           document.getElementById("alarm").innerHTML = "Dein Antrag wurde gespeichert!";
         }else if (req.responseText == -2){
           document.getElementById("alarm").className = "alert alert-warning";
           document.getElementById("alarm").innerHTML = "Leider ist zu diesem Zeitpunkt der Raum bereits gebucht! Wähle einen anderen.";
         }else if(req.responseText == -1){
           document.getElementById("alarm").className = "alert alert-warning"
           document.getElementById("alarm").innerHTML = "Leider wurden nicht alle Pflichtfelder ausgefüllt!";
         }
      };
      }
      req.open("GET", "formularajax.php?veranstaltung=" + document.getElementById("veranstaltung").value+ "&datum="+   document.getElementById("datum").value + "&von="+  document.getElementById("von").value + "&bis=" + document.getElementById("bis").value + "&raum=" +  document.getElementById("raum").value + "&notiz=" +  document.getElementById("notizen").value );
      req.send();
    }
    </script>
    <title>Antragsformular</title>
  </head>
  <body>
  <div class="container-sm">
    <h1>Antragsformular</h1>
    <p>Bitte füllen Sie diesen Antrag zum Buchen eines Raumes für Online-Lehre aus.<br> Mit "*" gekennzeichnete Felder sind Pflichtfelder.</p>
    <form>
 <div class="form-group">
    <label for="veranstaltung">*Wählen Sie die Art der Veranstaltung aus:</label>
    <select class="form-control" id="veranstaltung">
      <option value="uebung">Übung</option>
      <option value="vorlesung">Vorlesung</option>
      <option value="labor">Labor</option>
    </select>
  </div>
 
  <div class="form-group">
    <label for="datum">*Wählen Sie das gewünschtes Datum aus:(Format: xx.xx.xxxx)</label>
    <input type="email" class="form-control" id="datum" placeholder="z.B. 01.01.2020">
  </div> 
 <p>Hier haben Sie die Möglichkeit die gewünschte Zeit einzutragen.</p>
   <div class="form-group">
    <label for="von">*Von: (Format: XX:XX)</label>
    <input type="email" class="form-control" id="von" placeholder="z.B. 09:30">
  </div>
    <div class="form-group">
    <label for="bis">*Bis: (Format: xx:xx)</label>
    <input type="email" class="form-control" id="bis" placeholder="z.B. 10:15">
  </div> 
   
    <div class="form-group">
    <label for="raum">Wählen Sie den gewünschten Raum aus:</label>
    <select multiple class="form-control" id="raum">
      <option value="01">Raum 01</option>
      <option value="02">Raum 02</option>
      <option value="03">Raum 03</option>
   </select>
  </div>
  <div class="form-group">
    <label for="notizen">Notizen:</label>
    <input class="form-control" id="notizen">
  </div>
</form>
<button onclick="antrag()" type="button" class="btn btn-primary btn-lg" >Antrag absenden</button>
<br>
<p> <div class="invisible"  ole="alert" id="alarm">

</div></p>
   <form class="form-inline my-2 my-lg-0" action="../dashboard.php">
      <button class="btn btn-primary" type="submit">Zurück zum Portal</button>
    </form>
  </div>
  </body>

</html>


<?php endif; ?>

<?php if ( $_SESSION["rolle"] != "lehrende" ) {

  header("Location: ../../login.php");
}
?>
