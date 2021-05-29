<?php
include "private/dbconnection.inc.php";

$passwort= $_POST["password"];
$user= $_POST["user"];

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql= "Select * FROM login WHERE user=?";
$result= mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($result,'s',$user);
mysqli_stmt_execute($result);

$getData = mysqli_stmt_get_result($result);
$data = mysqli_fetch_assoc($getData);

$originuser= $data['user'];
$originpassword= $data['password'];
$salt= $data['salt'];
$rolle= $data['rolle'];
$saltedpassword= "$passwort" . "$salt";
$hashedpassword= hash('sha512',"$saltedpassword");

if ("$hashedpassword" === "$originpassword" && "$user" === "$originuser" && "$rolle" === "lehrende" ) {

  session_start();
  $_SESSION["user"] = "$user";
  $_SESSION["rolle"] = "$rolle";
  $_SESSION["login"] = "true";
 header("Location: lehrende/dashboard.php"); 

}
elseif ("$hashedpassword" === "$originpassword" && "$user" === "$originuser" && "$rolle" === "mitarbeitende" ) {

  session_start();
  $_SESSION["user"] = "$user";
  $_SESSION["rolle"] = "$rolle";
  $_SESSION["login"] = "true";

 header("Location: mitarbeitende/dashboard.php");

}else {
  
  header("Location: login.php?status=uspwd");
} 
