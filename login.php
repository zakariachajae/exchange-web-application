<?php
  
  require_once 'lib/db.php';
  $email = $password = '';
  $email_err = $password_err = '';


  if($_SERVER['REQUEST_METHOD'] === 'POST'){
  
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

   
    if(empty($email)){
      $email_err = 'Merci de saisir votre email';
    }

   
    if(empty($password)){
      $password_err = 'Merci de saisir votre mot de passe';
    }

   
    if(empty($email_err) && empty($password_err)){
      
      $sql = 'SELECT id,name, email, password FROM users WHERE email = :email ';
      if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        if($stmt->execute()){
          
          if($stmt->rowCount() === 1){
            if($row = $stmt->fetch()){
              if($password===$row['password']){
                
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['id'];
                header('location: index.php');
              } else {
               
                $password_err = 'Le mot de passe que vous avez entré est invalide !';
              }
            }
          } 
          else {
            $email_err = 'Aucun compte avec cet email';
          }
        } else {
          die('Erreur !');
        }
      }
      
      unset($stmt);
    }

    
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
    <h2 class="ui teal image header">
      <div class="content">
        Se connecter
      </div>
    </h2>
    <form class="ui large form" method="POST">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="email" placeholder="E-mail" value="<?php echo $email; ?>">
          </div>
          <?php if (!empty($email_err)) { ?>
              <div class="ui red message"><?php echo $email_err; ?></div>
            <?php } ?>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="Mot de passe">
          </div>
          <?php if (!empty($password_err)) { ?>
              <div class="ui red message"><?php echo $password_err; ?></div>
            <?php } ?>
        </div>
        <input  class="ui fluid large teal submit button" type="submit" value="Se connecter">
      </div>

      <div class="ui error message"></div>

    </form>

    <div class="ui message">
      Vous n'avez pas de compte? <a href="compte.php">Créer un compte</a>
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