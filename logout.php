<?php
  // Init session
  session_start();

  // Désactiver toutes les valeurs de session
  $_SESSION = array();

  // Supprimer la session
  session_destroy();

  // Regiriger vers login
  header('location: login.php');
  exit;