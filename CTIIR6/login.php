
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
      
      $sql = 'SELECT name, email, password FROM users WHERE email = :email ';
      if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        if($stmt->execute()){
          
          if($stmt->rowCount() === 1){
            if($row = $stmt->fetch()){
              if($password===$row['password']){
                
                
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
              
                
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
<?php include "header.php"; ?> 
<header class="major">
<h1> login to account </h1>
<section>
		<form method="post">
			<div class="fields">
			<div class="field">
			<label for="email">email</label>
											
				<input type="text" name="email" id="email" />
				<?php if (!empty($email_err)){ ?>
							<div class="box">
								<?php echo $email_err ;?>
							</div>

						<?php }?>
			</div>
            <div class="field">
			<label for="password">password</label>
				<input type="password" name="password" id="password" />
				<?php if (!empty($password_err)){ ?>
							<div class="box">
								<?php echo $password_err ;?>
							</div>

						<?php }?>
			</div>
			</div>
			<button style="text-align:center;"> log in </button>
        </form>
	
</section>
<?php include "footer.php"; ?>