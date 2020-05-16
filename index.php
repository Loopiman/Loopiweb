<?php
session_start();
require './admin/lib/php/admin_liste_include.php';
$cnx = Connection::getInstance($dsn, $user, $pass);
include './admin/lib/php/login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loopi - The Discord Bot</title>
  <link rel="shortcut icon" href="./admin/images/inf.png">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- <link rel="stylesheet" href="./admin/lib/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="css/wickedcss.min.css">
  <link rel="stylesheet" href="./admin/lib/css/hover-min.css">
  <link rel="stylesheet" href="./admin/lib/css/style.css">
  <script type="text/javascript" src="./admin/lib/js/fonctionsJquery.js"></script>
  <meta name="viewport" content="width-device-width, initial-scale=1" />
</head>

<body>
  <nav class="menu">
    <div class="menu-content">
      <a href="index.php?page=accueil.php" class="hvr-float-shadow logo lien">
        <span>Loopi</span>
      </a>
      <?php
      if (file_exists("./lib/php/menu.php")) {
        include('./lib/php/menu.php');
      }
      ?>
    </div>
    <?php if ($_SESSION['connected'] == false) echo ('<div class="login-button"><a href="?action=login" id="test" class="lien lien2">Login</a></div>'); ?>
    <?php if ($_SESSION['connected'] == true) echo ('<div class="login-button"><a href="?action=logout" class="lien lien2">Logout</a></div>'); ?>
  </nav>
  <div>
    <main>
      <?php
      if (!isset($_SESSION['page'])) {
        $_SESSION['page'] = "accueil.php";
      }
      if (isset($_GET['page'])) {
        $_SESSION['page'] = $_GET['page'];
      }
      if (file_exists("pages/" . $_SESSION['page'])) {
        include("pages/" . $_SESSION['page']);
      } else {
        include('./admin/pages/page404.php');
      }
      ?>
    </main>
  </div>
</body>

</html>