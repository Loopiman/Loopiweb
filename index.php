<?php
session_start();
require './admin/lib/php/admin_liste_include.php';
$cnx = Connection::getInstance($dsn, $user, $pass);
include './admin/lib/php/login.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Loopi - The Discord Bot</title>
  <link rel="shortcut icon" href="./admin/images/inf.png">
  <link rel="stylesheet" href="./admin/lib/css/hover-min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../admin/lib/css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
  <script type="text/javascript" src="./admin/lib/js/fonctionsJquery.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<?php
if (file_exists('./lib/php/menu.php')) {
  include('./lib/php/menu.php');
}
?>

<body>
  <div>
    <main>
      <?php
      if (!isset($_SESSION['page'])) {
        $_SESSION['page'] = "accueil.php";
      }
      if (isset($_GET['page'])) {
        $_SESSION['page'] = $_GET['page'] . ".php";
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