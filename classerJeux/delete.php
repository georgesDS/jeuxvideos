<?php require 'config.php'; 
$id=0; 
if(!empty($_GET['id'])){ 
  $id=$_REQUEST['id']; 
} 
if(!empty($_POST)){ 
  $id= $_POST['id']; 
  $pdo=getDB(); 
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "DELETE FROM videogames  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $pdo = null;
        header("Location: accueil.php");
    
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
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

     <br/>
        <div class="container">
     <br/>
        <div class="span10 offset1">
     <br/>
        <div class="row">
     <br/>
          <h3>Suppprimer un jeu</h3>
          <p>
        </div>
          <p>
      <br/>
          <form class="form-horizontal" action="delete.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id;?>"/>
                  vous êtes sur de vouloir supprimer ?
      <br/>
        <div class="form-actions">
          <button type="submit" class="btn btn-danger">Yes</button>
          <a class="btn" href="accueil.php">No</a>
        </div>
          <p>
          </form>
          <p>
        </div>
          <p>
        </div>
          <p>
<!-- /container -->
  </body>
</html>