<?php
session_start();  
if ( $_SESSION["rolle"] === "mitarbeitende" ) : ?>
<!Doctype html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>Antragsübersicht</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <script>

       function fertigGeladen(event){
      let req = new XMLHttpRequest ();
      req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
          var tmp = req.responseText;
          var tmp2 = tmp.split(':#');
          var arraylaenge = tmp2.length;
          var values = new Array();
          for(var i = 0 ; i < arraylaenge; i++){
              values[i] = tmp2[i].split('#'); 
          }
        var header = ['Antragsnummer','User','Veranstaltung','Datum','Zeit','Raum','Notiz Lehrende','Notiz Mitarbeitende'];

        var table = document.createElement('table');

        for (var i = 0 ; i < header.length; i++){
          var tmp = document.createElement('td');
          tmp.innerHTML = header[i];
          table.appendChild(tmp);
        }
                                        
        for(var i=0; i< arraylaenge; i++) {
         	var tr = document.createElement('tr');
          for(var j=0; j<  values[i].length ;j++){
           var td = document.createElement('td');
		       td.innerHTML = values[i][j];
		       tr.appendChild(td);
        	}
      	table.appendChild(tr);
        }
        document.getElementById('tabellenrahmen').innerHTML = "";
        document.getElementById('tabellenrahmen').appendChild(table);
        document.getElementById('tabellenrahmen').className = "table table-striped";
      
      }
     }
      req.open("GET", "abrufantrag.php");
      req.send();
    }

   
   window.onload = fertigGeladen; 
   window.setInterval(fertigGeladen, 5000);
   
 

  </script>
  </head>
  <body>
    <div class="container-sm">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" >Übersicht über die offenen Anträge                                       </a>
    <form class="form-inline my-2 my-lg-0" action="./antragsformular/antrag.php" method="get">
      <input class="form-control mr-sm-2" id="number" name="number" type="text" placeholder="z.B. 3" >
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Antrag bearbeiten</button>
    </form>

    <form class="form-inline my-2 my-lg-0" action="./dashboard.php">
      <button class="btn btn-primary" type="submit">Zurück zum Portal</button>
    </form>
    </nav>
     <br>
     <br>
    <p> Hier werden Ihnen alle offenen Anträge angezeigt. Sie können die Aufträge bearbeiten, indem Sie die Auftragsnummer in das Feld eingeben und auf den Button klicken.</p>
    <p> Hinweis: Die Liste wird alle 5 Sekunden automatisch aktualisiert. </p>
    <div id="tabellenrahmen"></table></div>
    
    </div>
  </body>

</html>


<?php endif; ?>

<?php if ( $_SESSION["rolle"] != "mitarbeitende" ) {

  header("Location: ../login.php");
}
?>
