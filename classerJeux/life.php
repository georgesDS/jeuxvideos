//The lives of session is one hour 60*60=3600 

<?php
session_start();

if(isset($_SESSION['user'])){
if((time() - $_SESSION['time_start_login']) > 3600){
    header("location: logout.php");
} else {
    $_SESSION['time_start_login'] = time();
}
} else {
header("location: logout.php");
}
 ?>