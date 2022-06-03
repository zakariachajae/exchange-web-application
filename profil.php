<?php 
 // Init session
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
 ?>

  <DOCTYPE html>
  <html>
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
      profil
    </div>
    <div class="ui grid">
  <div class="four wide column">
    <img src="img/avi.png" width=1100 height=400>
  </div>
  <div class="nine wide column">
    <p>
    <div class="ui list">
    
    <?php 
    if(isset($_SESSION['email']) && !empty($_SESSION['email']))
    {   
    ?>
    <div class="header">email:</div>
    <p>
    <?php echo $_SESSION['email'];?>
    <p>
  </div>
  <?php }
  ?>
  <div class="item">
  <?php 
    if(isset($_SESSION['name']) && !empty($_SESSION['name']))
    {   
    ?>
    <div class="header">name:</div>
    <p>
    <?php echo $_SESSION['name'];?>
    <p>
  </div>
  <?php }
  ?>
 
</div>
    </p>
  </div>
  <div class="three wide column">
    <p></p>
  </div>
</div>
    

</body>