<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
      <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script>

  function init(){

      var response = "<?php echo $_GET['status'];?>";
    
      if(response == "uspwd")
      {
        document.getElementById("alarm").className = "alert alert-danger";
       
      }

    }

  window.onload=init;
    </script>
</head>
  <body>
      <div class="container-sm">

      <div class="jumbotron jumbotron-fluid">
        <div class="container">
        <h1 class="display-4">Buchungssystem zur Onlinelehre an der HS</h1>
        <p class="lead">Melden Sie sich mit Ihren Daten im Formular an.</p>
        </div>
      </div>
          <form action="checklogin.php" method="post">
        <div class="form-group" >
         <label for="user">Benutzername:</label>
         <input type="text" class="form-control" name="user" >
        </div>
        <div class="form-group">
        <label for="password">Passwort:</label>
        <input type="password" class="form-control" name="password">
       </div>
        <button type="submit" class="btn btn-primary">Absenden</button>

        

       </form>

      <br>
      <p id="alarm" class="invisible">Leider konnte kein Konto mit den angegeben Daten gefunden werden. Bitte probiere es nochmal.</p>  
       </div>

 
  </body>
</html>
