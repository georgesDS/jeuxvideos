<?php require 'config.php'; 
    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){ 
    //on initialise nos messages d'erreurs; 
    $titleError = ''; 
    $idPlatformError=''; 
    $idGenreError =''; 
    $idPublisherError =''; 
    $idDeveloperError=''; 

    // on recupère nos valeurs 
    $title = htmlentities(trim($_POST['Title'])); 
    $releaseDate=htmlentities(trim($_POST['ReleaseDate'])); 
    $idPlatform = htmlentities(trim($_POST['idPlatform'])); 
    $idGenre=htmlentities(trim($_POST['idGenre'])); 
    $idPublisher = htmlentities(trim($_POST['idPublisher'])); 
    $idDeveloper=htmlentities(trim($_POST['idDeveloper'])); 

    // on vérifie nos champs 
    $valid = true; 
    if (empty($title)) { $titleError = 
        'Please enter title'; 
    $valid = false; 
    }

    if (empty($idPlatform)) { 
    	$idPlatformError = 'Please select platform'; 
    	$valid = false; 
    } 

    if (empty($idGenre)) { 
    	$idGenreError = 'Please select genre'; 
    	$valid = false; 
    } 
    if (empty($idPublisher)) { 
    	$idPublisherError = 'Please select publisher'; 
    	$valid = false; 
    }

    if (!isset($idDeveloper)) { 
    	$idDeveloperError = 'Please select a developer'; 
    	$valid = false; 
    } 
  
    // si les données sont présentes et bonnes, on se connecte à la base 
    if ($valid) {
        $pdo = getDB();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*Partie de code pour insérer une référence au jeu*/
        $sql2 = "SELECT CodeConstructor FROM platform WHERE id = ? ";
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($idPlatform));
        $data2 = $q2->fetch(PDO::FETCH_ASSOC);
        $ref1= $data2['CodeConstructor'];

//je recupere le nombre de titres identiques à celui du jeu que je rajoute
        $sql3 = "SELECT COUNT(id) as nbrTitresIdent, Ref, title, idPlatform FROM videogames WHERE title = ? AND idPlatform = ?";
        $q3 = $pdo->prepare($sql3);
        $q3->execute(array($title, $idPlatform));
        $data3 = $q3->fetch(PDO::FETCH_ASSOC);

//je recupere le nombre de titres déjà présents dans la platform
        $sql4 = "SELECT COUNT(id) as nbrTitresPlat, title, idPlatform FROM videogames WHERE idPlatform = ?";
        $q4 = $pdo->prepare($sql4);
        $q4->execute(array($idPlatform));
        $data4 = $q4->fetch(PDO::FETCH_ASSOC);

/*Si des titres identiques sont déjà présents dans la même plateforme, je garde sa numération et j'incrémente la lettre finale*/
/*SINON Je récupère la reference numérique correspondante au nombre de titres déjà présent dans la plateforme et incrémente si existants*/
/*je rajoute la lettre en fonction de la présence de titres+platform identiques*/
            
        $letter = '';
        $ref3 = 'A';
        $letter = $ref3;

        if ($data3['nbrTitresIdent'] > 0) {

            $ref = substr($data3['Ref'], 0, -1) ; // FAIRE SAUTER LA LETTRE FINALE
            for ($i=0; $i < $data3['nbrTitresIdent'] ; $i++) { 
                $letter++;
            }
            $ref = $ref.$letter;
        }
        else {
            $ref2 =$data4['nbrTitresPlat']+1;
            $ref2 = str_pad($ref2, 3, "0", STR_PAD_LEFT);
            $ref = $ref1.$ref2.$ref3;
        }


/* Fin de Partie de code pour insérer une référence au jeu*/

        $sql = "INSERT INTO videogames ( Title, Ref, ReleaseDate, idPlatform, idPublisher, idDeveloper) values(?, ?, ?, ? , ? , ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array( $title, $ref, $releaseDate, $idPlatform, $idPublisher, $idDeveloper));
        //on récupère l'id auto-incrémentée du nouveau videogame
        $last_id = $pdo->lastInsertId();
/*                echo $last_id;*/

        $sql2 = "INSERT INTO gamesgenres (idGenre, idVideoGame) values(?, ?)";
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($idGenre, $last_id));
        $pdo = null;
        header("Location: accueil.php");
        }
    }
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
    </head>

    <body>


<!-- Code HTML  --> 
    <div class="container">

    <div class="row">
        <h3>Ajouter un jeu</h3>      
    </div><br>

    <form method="post" action="add.php">
        <div class="control-group <?php echo !empty($titleError)?'error':''; ?>">
            <label class="control-label">Title</label>
            <div class="controls">
                <input name="Title" type="text"  placeholder="Title" value="<?php echo !empty($title)?$title:'';?>" required>
                <?php if (!empty($titleError)): ?>
                <span class="help-inline"><?php echo $titleError;?></span>
                <?php endif; ?>
            </div>
            
        </div><br>
            
        <div class="control-group">
            <label class="control-label">releaseDate</label>
            <div class="controls">
                <input type="date" name="ReleaseDate" value="<?php echo !empty($releaseDate)?$releaseDate:''; ?>">
            </div>
        </div><br>
            
        <div class="control-group<?php echo !empty($idPlatformError)?'error':'';?>">
            <select name="idPlatform">
                 <option value="">Selectionner une platform:</option>
                 <option value="1">Playstation</option>
                 <option value="2">Playstation2</option>
                 <option value="3">Playstation3</option>
                 <option value="4">PSP</option>
                 <option value="5">NES</option>
                 <option value="6">SuperNES</option>
                 <option value="7">Nitendo 64</option>
                 <option value="8">Gameboy</option>
                 <option value="9">Gameboy Color</option>
                 <option value="10">Gameboy Advance</option>
                 <option value="11">PS Vita</option>
                 <option value="12">Sega Master System</option>
                 <option value="13">Mega Drive</option>
                 <option value="14">Saturn</option>
                 <option value="15">Dreamcast</option>
                 <option value="16">Game Gear</option>
                 <option value="17">Xbox</option>
                 <option value="18">Xbox 360</option>
                 <option value="19">Xbox One</option>
                 <option value="20">PC Engine</option>
                 <option value="21">Playstation4</option>
                 <option value="22">Wii</option>
                 <option value="23">Nitendo 3DS</option>
                 <option value="24">GameCube</option>
                 <option value="25">Nitendo DS</option>
            </select> 
            <?php if(!empty($idPlatformError)):?>
            <span class="help-inline"><?php echo $idPlatformError ;?></span>
             <?php endif;?>
                    
        </div><br>
            
        <div class="control-group <?php echo !empty($idGenreError)?'error':'';?>">
            <select name="idGenre">
                 <option value="">Selectionner un genre:</option>
                 <option value="1">FPS</option>
                 <option value="2">Action/Adventure</option>
                 <option value="3">Action</option>
                 <option value="4">Racing</option>
                 <option value="5">Simulation</option>
                 <option value="6">RPG</option>
                 <option value="7">Fighting</option>
                 <option value="8">Sports</option>
                 <option value="9">Adventure</option>
                 <option value="10">Shooter</option>
                 <option value="11">Platformer</option>
                 <option value="12">Strategy</option>
                 <option value="13">Puzzle</option>
                 <option value="14">Survival Horror</option>
                 <option value="15">Hunting</option>
                 <option value="16">Driving</option>
                 <option value="17">Flight Simulation</option>
                 <option value="18">Battle</option>
                 <option value="19">Party</option>
                 <option value="20">Hack & Slash</option>
                 <option value="21">Music</option>
                 <option value="22">Entertainment</option>
            </select>
            <?php if (!empty($idGenreError)): ?>
            <span class="help-inline"><?php echo $idGenreError;?></span>
            <?php endif;?>        
        </div><br>
            
        <div class="control-group <?php echo !empty($idPublisherError)?'error':'';?>">
            <input type="text" name="idPublisher" value="<?php echo !empty($idPublisher)?$idPublisher:''; ?>">
            <?php if (!empty($idPublisherError)): ?>
            <span class="help-inline"><?php echo $idPublisherError;?></span>
            <?php endif;?>            
        </div><br>
            
        <div class="control-group<?php echo !empty($idDeveloperError)?'error':'';?>">
               <input type="text" name="idDeveloper" value="<?php echo !empty($idDeveloper)?$idDeveloper:''; ?>">
            <?php if (!empty($idDeveloperError)): ?>
            <span class="help-inline"><?php echo $idDeveloperError;?></span>
            <?php endif;?>
        </div><br>
            
            
        <div class="form-actions">
            <input type="submit" class="btn btn-success" name="submit" value="submit">
            <a class="btn btn-success" href="accueil.php">Retour</a>
        </div>
        
    </form>
        
    </div>
        
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>

 </body>
</html>