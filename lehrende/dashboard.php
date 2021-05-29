<?php
session_start();  
if ( $_SESSION["rolle"] === "lehrende" ) : ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script>
        </script>

     </head>
     <body>
       <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
         <a class="navbar-brand">Dashboard - Buchungssystem für die Online-Lehre an der HS Bremerhaven  |  User : <?php echo $_SESSION["user"];?></a>
         <form class="form-inline" action ="./antragsformular/formular.php">
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Antrag stellen </button>
         </form>

         <form class="form-inline" action ="../logout.php">
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout </button>
         </form>

        </nav>

        <br>

        <div class="card">
         <div class="card-header">
           Raumübersicht
        </div>
        <div class="card-body">
         <p class="card-text">Schauen Sie sich hier ganz einfach alle gebuchten Räume zu den verschiedenen Zeiten an.</p>
          <form class="form-inline" action ="https://informatik.hs-bremerhaven.de/swe2_2020team09/Raumuebersicht.php">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Raumübersicht</button>
         </form>
         </div>
        </div>
 
        <br>
        <br>
        <div class="card">
         <div class="card-header">
           Antragsübersicht
        </div>
        <div class="card-body">
         <p class="card-text">Schauen Sie sich hier ganz einfach den Status der Anträge an.</p>
         <form class="form-inline" action ="https://informatik.hs-bremerhaven.de/swe2_2020team09/lehrende/antragsübersicht.php">
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Antragsübersicht</button>
         </form>

         </div>
        </div>

        </body>
</html>


<?php endif; ?>

<?php if ( $_SESSION["rolle"] != "lehrende" ) {

  header("Location: ../login.php");
}
?>
