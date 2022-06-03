<?php
  require_once "lib/db.php";
  // Validate login
  if(!isset($_SESSION['name']) || empty($_SESSION['name'])){
    header('location: login.php');
    exit;
  }
?>

<?php 
  //prepaer la requte sql
  $id_annonce=$_GET['id'];
  $sql = 'SELECT * FROM annonces WHERE id=:id';
  if($stmt = $pdo->prepare($sql)){
    $stmt->bindParam(':id', $id_annonce, PDO::PARAM_STR);
    if($stmt->execute()){
      //verifier si une annonce existe avec cet id
      if($stmt->rowCount() === 1){
        if($row = $stmt->fetch()){
          $produit=$row['produit'];
          $description=$row['description'];
          $produit_cible=$row['produit_cible'];
          $date_ajout=$row['date_ajout'];
           // pour extraire le nom de l'annonceur
           $user = $pdo->prepare("SELECT * FROM users WHERE id =:id LIMIT 1");
           $user->bindParam(':id', $row['user_id'], PDO::PARAM_STR);
           $user->execute();
           $r_user = $user->fetch();
           $annonceur=$r_user['name'];
        }

    }
  }
}

// Offre d'annonce 

  // Init vars
  $produit_offre = $description_offre ='';
  $produit_offre_err = $description_offre_err = '';

  // Si le formulaire est posté
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Récuperer les données
    $produit_offre =  trim($_POST['produit_offre']);
    $description_offre = trim($_POST['description_offre']);
    $date_ajout_offre = date('Now');
    $user_id_offre= $_SESSION['user_id'];
    $annonce_id_offre = $id_annonce;
    $accepter = 0;

    // Valider produit
    if(empty($produit_offre)){
      $produit_offre_err = 'Merci de sasir produit ';
    } 
    // Valider description
    if(empty($description_offre)){
      $description_offre_err = 'Merci de sasir la description ';
    } 


    // Vérifier si pas d'erreur dans le formualaire
    if(empty($produit_offre_err) && empty($description_offre_err)){
     
      // preparer la requete SQL
      $sql = 'INSERT INTO offres (	produit, description, 	user_id,	annonce_id,	date_ajout,	accepter	) VALUES (:produit, :description, :user_id, :annonce_id, :date_ajout, :accepter )';

      if($stmt = $pdo->prepare($sql)){
        // Bind les parametres
        $stmt->bindParam(':produit', $produit_offre, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description_offre, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id_offre, PDO::PARAM_INT);
        $stmt->bindParam(':annonce_id', $annonce_id_offre, PDO::PARAM_STR);
        $stmt->bindParam(':date_ajout', $date_ajout_offre, PDO::PARAM_STR);
        $stmt->bindParam(':accepter', $accepter, PDO::PARAM_INT);

        // Essai 
        if($stmt->execute()){
          // Redirect to index
          header('location: index.php');
        } else {
          die('Erreur !');
        }
      }
      unset($stmt);
    }

    // Fermer la connexion
    unset($pdo);
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange</title>
</head>
<body>
<div class="ui container padtop">
<?php
include_once("header.php"); 
?>
<div class="ui middle aligned center aligned grid segment">
  <div class="column">
    <h2 class="ui teal image header"> Deposer une Offre pour l'annonce  N° <?php echo $_GET['id']; ?></h2>
      <div class="content">
        
        <table class="ui celled striped table">
         <tr> <td>Produit</td>
         <td><?php echo $produit ;?></td>
         </tr>
         <tr> <td>Description</td>
         <td><?php echo $description ;?></td>
         </tr>
         <tr> <td>Produit cible</td>
         <td><?php echo $produit_cible ;?></td>
         </tr>
         <tr> <td>Annoncée par </td>
         <td><?php echo $annonceur ;?></td>
         </tr>
         <tr> <td>Publié le  </td>
         <td><?php echo $date_ajout ;?></td>
         </tr>
        </table>
<div class="ui segment">
<form class="ui large form" method="POST" >
      <div class="ui stacked segment">
        <div class="field">
        Porduit
          <div class="ui left icon input">
            <input type="text" name="produit_offre" placeholder="Produit" value="">
          </div>
          <?php if (!empty($produit_offre_err)) { ?>
              <div class="ui red message"><?php echo $produit_offre_err; ?></div>
            <?php } ?>
        </div>
        <div class="field">
        Description
          <div class="ui left icon input">
            <textarea name="description_offre"  value="<?php echo $description; ?>"></textarea>
          </div>
          <?php if (!empty($description_offre_err)) { ?>
              <div class="ui red message"><?php echo $description_offre_err; ?></div>
            <?php } ?>
        </div>
        <input type="submit" value="Ajouter" class="ui fluid large teal submit button">
      </div>

      <div class="ui error message"></div>

    </form>
</div>
      </div>
    
    

   
  </div>
</div> 
<?php
include_once("footer.php"); 
?>
</div> 
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha512-dqw6X88iGgZlTsONxZK9ePmJEFrmHwpuMrsUChjAw1mRUhUITE5QU9pkcSox+ynfLhL15Sv2al5A0LVyDCmtUw==" crossorigin="anonymous"></script>
</html>