<?php require 'config.php';
 //on appelle notre fichier de config 
 $id = null; 
 if (!empty($_GET['id'])) { 
    $id = $_REQUEST['id']; 
 } 
 if ($id==null) { 
    header("location:accueil.php"); 
 } 
 else { //on lance la connection et la requete 
    $pdo = getDB();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) .
    $sql = "SELECT * FROM videogames where id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $pdo =  null;
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
      <div class="span10 offset1"><br/>
        <div class="row"><br/>
          <h3>Edition</h3>
        </div><br/>

        <div class="form-horizontal" ><br/>
          <div class="control-group">
            <label class="control-label">id</label><br/>
            <div class="controls">
              <label class="checkbox">
                <?php echo $data['id']; ?>
              </label>
            </div>
          </div><br/>
          <div class="control-group">
            <label class="control-label">Reference</label><br/>
            <div class="controls">
              <label class="checkbox">
                        <?php echo $data['Ref']; ?>
              </label>
            </div>
          </div><br/>
          <div class="control-group">
            <label class="control-label">Titre</label><br/>
            <div class="controls">
              <label class="control-label">
                  <?php echo $data['Title']; ?>
              </label>
            </div>
          </div><br/>
          <div class="control-group">
            <label class="control-label">Date d'actualisation</label><br/>
            <div class="controls">
              <label class="control-label">
                  <?php echo $data['ReleaseDate']; ?>
              </label>
            </div>
          </div><br/>
          <div class="control-group">
            <label class="control-label">idPlatform</label><br/>
            <div class="controls">
              <label class="control-label">
                    <?php echo $data['idPlatform']; ?>
              </label>
            </div>
          </div><br/>
          <div class="control-group">
            <label class="control-label">idPublisher</label><br/>
            <div class="controls">
              <label class="control-label">
                    <?php echo $data['idPublisher']; ?>
              </label>
            </div>
          </div><br/>
          <div class="control-group">
            <label class="control-label">idDeveloper</label><br/>
            <div class="controls">
              <label class="control-label">
                     <?php echo $data['idDeveloper']; ?>
              </label>
            </div>
               <p>
          </div><br/>
          <div class="form-actions">
              <a class="btn" href="accueil.php">Retour</a>
          </div>
        </div>
        
      </div>
    </div>
<!-- /container -->
  </body>
</html>