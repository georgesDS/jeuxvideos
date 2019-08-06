<?php require 'config.php';
  $id = null;
  if ( !empty($_GET['id'])) {
      $id = $_REQUEST['id'];
    } 
  if ( $id==null ) {
      header("Location: accueil.php");
    }

  if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

   // on initialise nos erreurs 
      $idError = '';
      $titleError = '';
      $idPlatformError=''; 
      $idGenreError =''; 
      $idPublisherError =''; 
      $idDeveloperError=''; 
       // On assigne nos valeurs 
/*      $id = $_POST['id']; */
      $titleUD = $_POST['TitleUD']; 
      $releaseDateUD= $_POST['ReleaseDateUD']; 
      $idPlatformUD = $_POST['idPlatformUD']; 
      $idGenreUD= $_POST['idGenreUD']; 
      $idPublisherUD = $_POST['idPublisherUD']; 
      $idDeveloperUD= $_POST['idDeveloperUD'];
      $ididGenreINI= $_POST['idGenreINI'];

    // On verifie que les champs sont remplis 
        $valid = true;

        if (empty($titleUD)) { $titleError = 'Please enter title'; 
        $valid = false; 
        }

        if (empty($idPlatformUD)) { 
          $idPlatformError = 'Please select platform'; 
          $valid = false; 
        } 

        if (empty($idGenreUD)) { 
          $idGenreError = 'Please select genre'; 
          $valid = false; 
        } 
        if (empty($idPublisherUD)) { 
          $idPublisherError = 'Please select publisher'; 
          $valid = false; 
        }

        if (!isset($idDeveloperUD)) { 
          $idDeveloperError = 'Please select a developer'; 
          $valid = false; 
        } 
    // mise à jour des donnés 
        if ($valid) { 
          $pdo = getDB(); 
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                     
          $sql = "UPDATE videogames SET Title = ?,ReleaseDate = ?,idPlatform = ?,idPublisher = ?, idDeveloper = ?
          WHERE id = ?";
          $q = $pdo->prepare($sql);
          $q->execute(array($titleUD, $releaseDateUD, $idPlatformUD, $idPublisherUD, $idDeveloperUD, $id));

          $sql2 = "UPDATE gamesgenres SET idGenre = ?,idVideoGame = ?
          WHERE idGenre = ? AND idVideoGame = ? ";
          $q2 = $pdo->prepare($sql2);
          $q2->execute(array($idGenreUD, $id, $ididGenreINI, $id));
          $pdo = null;
          header("Location: accueil.php");
            } 
  }

  else {

    $pdo = getDB();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM videogames
    WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    $id = $data['id'];
    $Ref = $data['Ref'];
    $title = $data['Title'];
    $releaseDate= $data['ReleaseDate']; 
    $idPlatform = $data['idPlatform']; 
    $idPublisher = $data['idPublisher']; 
    $idDeveloper= $data['idDeveloper'];
    echo $data['idDeveloper'];

    $sql2 = "SELECT * FROM gamesgenres
    WHERE idVideoGame = ? ";
    $q2 = $pdo->prepare($sql2);
    $q2->execute(array($id));
    $data2 = $q2->fetch(PDO::FETCH_ASSOC);
    $idGenre= $data2['idGenre'];

    $pdo = null;
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
    <body><br/>
      <div class="container"><br/>
        <div class="row"><br/>
          <h3>Modifier un jeu</h3>
        </div>

        <form method="post" action="update.php?id=<?php echo $id ;?>"><br/>
          <div class="control-group <?php echo !empty($titleError)?'error':''; ?>">
            <label class="control-label">Title</label>
            <div class="controls">
              <input name="TitleUD" type="text" placeholder="Title" value="<?php echo !empty($title)?$title:'';?>">

              <?php if (!empty($titleError)): ?>
                <span class="help-inline"><?php echo $titleError;?></span>
              <?php endif; ?>
            </div>
              
          </div><br>
            
          <div class="control-group<?php echo !empty($releaseDateError)?'error':'';?>">
            <label class="control-label">releaseDate</label>
            <div class="controls">
              <input type="date" name="ReleaseDateUD" value="<?php echo !empty($releaseDate)?$releaseDate:''; ?>">
            </div>
          </div><br>
            
          <div class="control-group<?php echo !empty($idPlatformError)?'error':'';?>">
            <label class="control-label">Platform</label>
            <div class="controls">
              <select name="idPlatformUD">
                 <option value="">Selectionner une platform:</option>
                 <option value="1" <?php if ($idPlatform == 1) echo "selected" ?>>Playstation</option>
                 <option value="2" <?php if ($idPlatform == 2) echo "selected" ?>>Playstation2</option>
                 <option value="3" <?php if ($idPlatform == 3) echo "selected" ?>>Playstation3</option>
                 <option value="4" <?php if ($idPlatform == 4) echo "selected" ?>>PSP</option>
                 <option value="5" <?php if ($idPlatform == 5) echo "selected" ?>>NES</option>
                 <option value="6" <?php if ($idPlatform == 6) echo "selected" ?>>SuperNES</option>
                 <option value="7" <?php if ($idPlatform == 7) echo "selected" ?>>Nitendo 64</option>
                 <option value="8" <?php if ($idPlatform == 8) echo "selected" ?>>Gameboy</option>
                 <option value="9" <?php if ($idPlatform == 9) echo "selected" ?>>Gameboy Color</option>
                 <option value="10" <?php if ($idPlatform == 10) echo "selected" ?>>Gameboy Advance</option>
                 <option value="11" <?php if ($idPlatform == 11) echo "selected" ?>>PS Vita</option>
                 <option value="12" <?php if ($idPlatform == 12) echo "selected" ?>>Sega Master System</option>
                 <option value="13" <?php if ($idPlatform == 13) echo "selected" ?>>Mega Drive</option>
                 <option value="14" <?php if ($idPlatform == 14) echo "selected" ?>>Saturn</option>
                 <option value="15" <?php if ($idPlatform == 15) echo "selected" ?>>Dreamcast</option>
                 <option value="16" <?php if ($idPlatform == 16) echo "selected" ?>>Game Gear</option>
                 <option value="17" <?php if ($idPlatform == 17) echo "selected" ?>>Xbox</option>
                 <option value="18" <?php if ($idPlatform == 18) echo "selected" ?>>Xbox 360</option>
                 <option value="19" <?php if ($idPlatform == 19) echo "selected" ?>>Xbox One</option>
                 <option value="20" <?php if ($idPlatform == 20) echo "selected" ?>>PC Engine</option>
                 <option value="21" <?php if ($idPlatform == 21) echo "selected" ?>>Playstation4</option>
                 <option value="22" <?php if ($idPlatform == 22) echo "selected" ?>>Wii</option>
                 <option value="23" <?php if ($idPlatform == 23) echo "selected" ?>>Nitendo 3DS</option>
                 <option value="24" <?php if ($idPlatform == 24) echo "selected" ?>>GameCube</option>
                 <option value="25" <?php if ($idPlatform == 25) echo "selected" ?>>Nitendo DS</option>
              </select>

              <?php if(!empty($idPlatformError)):?>
              <span class="help-inline"><?php echo $idPlatformError ;?></span>

              <?php endif;?>
            </div>        
          </div><br>
            
          <input type="hidden" name="idGenreINI" value="<?php echo !empty($idGenre)?$idGenre:'';; ?>" >

          <div class="control-group <?php echo !empty($idGenreError)?'error':'';?>">
            <label class="control-label">Genre</label>
            <div class="controls">
              <select name="idGenreUD">
                 <option value="">Selectionner un genre:</option>
                 <option value="1" <?php if ($idGenre == 1) echo "selected" ?>>FPS</option>
                 <option value="2" <?php if ($idGenre == 2) echo "selected" ?>>Action/Adventure</option>
                 <option value="3" <?php if ($idGenre == 3) echo "selected" ?>>Action</option>
                 <option value="4" <?php if ($idGenre == 4) echo "selected" ?>>Racing</option>
                 <option value="5" <?php if ($idGenre == 5) echo "selected" ?>>Simulation</option>
                 <option value="6" <?php if ($idGenre == 6) echo "selected" ?>>RPG</option>
                 <option value="7" <?php if ($idGenre == 7) echo "selected" ?>>Fighting</option>
                 <option value="8" <?php if ($idGenre == 8) echo "selected" ?>>Sports</option>
                 <option value="9" <?php if ($idGenre == 9) echo "selected" ?>>Adventure</option>
                 <option value="10" <?php if ($idGenre == 10) echo "selected" ?>>Shooter</option>
                 <option value="11" <?php if ($idGenre == 11) echo "selected" ?>>Platformer</option>
                 <option value="12" <?php if ($idGenre == 12) echo "selected" ?>>Strategy</option>
                 <option value="13" <?php if ($idGenre == 13) echo "selected" ?>>Puzzle</option>
                 <option value="14" <?php if ($idGenre == 14) echo "selected" ?>>Survival Horror</option>
                 <option value="15" <?php if ($idGenre == 15) echo "selected" ?>>Hunting</option>
                 <option value="16" <?php if ($idGenre == 16) echo "selected" ?>>Driving</option>
                 <option value="17" <?php if ($idGenre == 17) echo "selected" ?>>Flight Simulation</option>
                 <option value="18" <?php if ($idGenre == 18) echo "selected" ?>>Battle</option>
                 <option value="19" <?php if ($idGenre == 19) echo "selected" ?>>Party</option>
                 <option value="20" <?php if ($idGenre == 20) echo "selected" ?>>Hack & Slash</option>
                 <option value="21" <?php if ($idGenre == 21) echo "selected" ?>>Music</option>
                 <option value="22" <?php if ($idGenre == 22) echo "selected" ?>>Entertainment</option>
              </select>

              <?php if (!empty($idGenreError)): ?>
              <span class="help-inline"><?php echo $idGenreError;?></span>

              <?php endif;?> 
            </div>       
          </div><br>
            
          <div class="control-group <?php echo !empty($idPublisherError)?'error':'';?>">
            <label class="control-label">Publisher</label>
            <div class="controls">          
              <input type="text" name="idPublisherUD" value="<?php echo !empty($idPublisher)?$idPublisher:''; ?>">
            
            <?php if (!empty($idPublisherError)): ?>
            <span class="help-inline"><?php echo $idPublisherError;?></span>

            <?php endif;?>  
            </div>          
          </div><br>
            
          <div class="control-group<?php echo !empty($idDeveloperError)?'error':'';?>">
            <label class="control-label">Developper</label>
              <div class="controls"> 
               <input type="text" name="idDeveloperUD" value="<?php echo !empty($idDeveloper)?$idDeveloper:''; ?>">
              <?php if (!empty($idDeveloperError)): ?>

              <span class="help-inline"><?php echo $idDeveloperError;?></span>

              <?php endif;?>
            </div>
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