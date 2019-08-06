<?php
include("config.php");
include('userClass.php');
$userClass = new userClass();

/*$errorMsgReg='';*/
$errorMsgLogin='';
/* Login Form */
if (!empty($_POST['username']) && !empty($_POST['password'])) {

	$username=$_POST['username'];
	$password=$_POST['password'];
	
	if(strlen(trim($username))>1 && strlen(trim($password))>1){
		$id=$userClass->userLogin($username,$password);

		if($id){

				header("Location: accueil.php"); // Page redirecting to home.php 
		}
		else{

			$errorMsgLogin="Please check login details.";
		}
	}
}

/* Signup Form */
/*if (!empty($_POST['signupSubmit'])) {
$username=$_POST['usernameReg'];
$email=$_POST['emailReg'];
$password=$_POST['passwordReg'];
$name=$_POST['nameReg'];*/

/* Regular expression check */
/*$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

if($username_check && $email_check && $password_check && strlen(trim($name))>0) 
{
$uid=$userClass->userRegistration($username,$password,$email,$name);
if($uid)
{
$url=BASE_URL.'home.php';
header("Location: $url"); // Page redirecting to home.php 
}
else
{
$errorMsgReg="Username or Email already exists.";
}
}
}*/
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Die & Retry</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="style.css">
      <script type="text/javascript" src="script.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  </head>
  <body>
  	<header>
  		<button id="login" class="btn btn-dark " onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
		<div class="jumbotron text-center" style="margin-bottom:0">
		<div><img src="logoDie.png"></div>
		  <p>Jouez et rejouez comme si votre vie en dépendait!</p>

 
		</div>

		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		  <a class="navbar-brand" href="#">Navbar</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="collapsibleNavbar">
		    <ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="#">Accueil</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">L'association</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Jeux</a>
		      </li> 
		      <li class="nav-item">
		        <a class="nav-link" href="#">Blog</a>
		      </li>   
		    </ul>
		  </div>  
		</nav>
	</header>

	<main>
	<div id="login9">
		<h3>Login</h3>
		<form method="post" action="" name="login">
			<label>Pseudo</label>
			<input type="text" name="username"  autocomplete="off" />
			<label>Password</label>
			<input type="password" name="password"  autocomplete="off"/>
			<div class="errorMsg"><?php echo $errorMsgLogin; ?></div>
			<input type="submit" class="button" name="loginSubmit" value="OK">
		</form>
	</div>


<!-- 	<form action="search.php" method="post">
  		Rechercher un titre ou partie de titre:
 		<input type="search" name="search">
  		<input class="btn btn-success" type="submit" value="OK">
	</form>

	<div>             
        <a href="add.php" class="btn btn-success">Ajouter un jeu</a>
    </div>


	<div class="container">

		<div id="id01" class="modal">
		  
		  <form class="modal-content animate" action="index.php">
		    <div class="closeContainer">
		      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		    </div>

		    <div class="container">
		      <label for="pseudo"><b>Pseudo</b></label>
		      <input type="text" placeholder="saisissez votre pseudo" name="pseudo" required>

		      <label for="password"><b>Password</b></label>
		      <input type="password" placeholder="saisissez votre mot de passe" name="password" required>
		        
		      <button type="submit">Login</button>
		      <label>
		        <input type="checkbox" checked="checked" name="remember"> Remember me
		      </label>
		    </div>

		    <div class="container" style="background-color:#f1f1f1">
		      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
		      <span class="psw">Forgot <a href="#">password?</a></span>
		    </div>
		  </form>
		</div> -->

<!-- 		base de données -->

<!-- 	<div class="row">

		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
					<th>id</th>
					<th>Ref</th>
					<th>titre</th>
					<th>genre</th>
					<th>platform</th>
					<th>constructor</th>
					<th>Editer</th>
					<th>Modifier</th>
					<th>Sup.</th>
				</thead>
				<tbody>
 -->


	<?php
/*	 include 'database.php'; //on inclut notre fichier de connection
	$pdo = Database::connect(); //on se connecte à la base
	$sql = 'SELECT videogames.id as id, videogames.Ref as Ref, videogames.title as title, genres.name as genre, platform.name as platform, constructor.name as constructor FROM videogames LEFT JOIN platform ON platform.id = videogames.idPlatform LEFT JOIN gamesgenres ON gamesgenres.idVideoGame = videogames.id LEFT JOIN genres ON genres.id= gamesgenres.idGenre LEFT JOIN constructor ON constructor.id = platform.idConstructor'; //on formule notre requete
	foreach ($pdo->query($sql) as $row)

	{ //on cree les lignes du tableau avec chaque valeur retournée
        echo '<tr>';
        echo'<td>' . $row['id'] . '</td>';
        echo'<td>' . $row['Ref'] . '</td>';
        echo'<td>' . $row['title'] . '</td>';
        echo'<td>' . $row['genre'] . '</td>';
        echo'<td>' . $row['platform'] . '</td>';
        echo'<td>' . $row['constructor'] . '</td>';
        echo '<td>';
        echo '<a class="btn btn-success" href="edit.php?id=' . $row['id'] . '"><i class="fas fa-edit"></a>';// un autre td pour le bouton d'edition
        echo '</td>';
        echo '<td>';
        echo '<a class="btn btn-success" href="update.php?id=' . $row['id'] . '"><i class="fas fa-sync-alt"></a>';// un autre td pour le bouton de correction
        echo '</td>';
        echo'<td>';
        echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . ' "><i class="fas fa-trash-alt"></a>';// un autre td pour le bouton de suppression
        echo '</td>';
        echo '</tr>';
    }
        Database::disconnect(); //on se deconnecte de la base*/
    
    ?>  


<!-- 				</tbody>
			</table>

		</div>
	</div> -->

<!-- fin base de donnée -->

    </main>
    <footer>
   		<p id="footer">****c'est mon footer****</p>
    </footer>
  </div>
    

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
  </body>
</html>
