<?php
session_start();  
if ( $_SESSION["rolle"] === "mitarbeitende" ) : ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

      
        <script>

        var antragsnummer = '<?php echo $_GET['number']; ?>';
     
        function fertigGeladen(event){
           let req = new XMLHttpRequest();
           req.onreadystatechange = function() {
           if (req.readyState == 4 && req.status == 200) {
             const tmp = req.responseText;
             var values = tmp.split(':');
             document.getElementById("name").innerHTML = values[1];
             document.getElementById("antragsnummer").innerHTML = values[0];
             document.getElementById("veranstaltung").innerHTML = values[2];
             document.getElementById("datum").innerHTML = values[3];
             document.getElementById("raum").innerHTML = values[4];
             document.getElementById("zeit").innerHTML = values[5];
             document.getElementById("notiz").innerHTML = values[6];
           };
        }
        req.open("GET", "antragabfrage.php?id=" + antragsnummer );  // Hier muss es noch Variabel gemacht werden
        req.send(); 
        }

       window.onload=fertigGeladen;


     function  entscheidung(){
       let req = new XMLHttpRequest();
       req.onreadystatechange = function() {
       if (req.readyState == 4 && req.status == 200) {
         if(req.responseText == 0){
          document.getElementById("alarm").className = "alert alert-success";
          document.getElementById("alarm").innerHTML = "Die Änderung wurde gespeichert.";
       }
      }
      }
      var statusantrag;
      if (document.status.status[0].checked == true) {
        statusantrag = "genehmigt";
      }else if (document.status.status[1].checked == true) {
      statusantrag = "abgelehnt";
      }      
      var sendnotiz = document.getElementById("notizen").value;
      req.open("GET", "antragsstatuschanged.php?bool="+ statusantrag + "&notizen=" + sendnotiz + "&id=" + antragsnummer); // Hier muss es noch Variabel gemacht werden
      req.send();
    }

    </script>
    <title>Antrag</title>
  </head>
  <body>
  <div class="container-sm">
    <h3>Antragsstatus ändern</h3>
    <p> Bearbeiten Sie hier den Antrag von: <div id="name"></div> mit der Antragsnummer:  <div id="antragsnummer" ></div> Die folgenden Angaben wurden zum Antrag gemacht:</p> 
    <div class="card" style="width: 18rem;">
    <ul class="list-group list-group-flush">
    <li class="list-group-item">Veranstaltung: <var id="veranstaltung"> </li>
    <li class="list-group-item">Datum: <var id="datum"> </li>
    <li class="list-group-item">Zeit: <var id="zeit">  </li>
    <li class="list-group-item">Vorgeschlagener Raum:  <var id="raum"> </li>
    <li class="list-group-item">Notiz:  <var id="notiz"> </li>
    </div>
    <br><p> Bearbeiten Sie im folgenden Abschnitt den  Antrag. Beim Ablehnen des Antrags geben Sie bitte eine Notiz als Hilfe zur einfachen Erstellung eines neuen Antrags an.
    <form name="status" class="form-check" >
      <fieldset>
       <input class="form-check-input"  name="status" value="true" type="radio"> genehmigen <br>
       <input class="form-check-input" name="status" value="false" type="radio" > ablehnen
      </fieldset>
    </form>
    </p>
  <div class="form-group">
    <label for="notizen">Notizen:</label>
    <input class="form-control" id="notizen">
  </div>
  <p>
<button onclick="entscheidung()" type="button" class="btn btn-primary btn-lg" >Antrag absenden</button>
  </p>

  <form class="form-inline my-2 my-lg-0" action="../dashboard.php">
      <button class="btn btn-primary" type="submit">Zurück zum Portal</button>
  </form>


<p> <div class="invisible"  ole="alert" id="alarm">
  </div>
  </body>

</html>


<?php endif; ?>

<?php if ( $_SESSION["rolle"] != "mitarbeitende" ) {

  header("Location: ../../login.php");
}
?>
