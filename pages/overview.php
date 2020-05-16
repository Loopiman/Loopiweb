<section class="principal-content">
  <?php
  session_start();
  $nbr = count($_SESSION['guild']);
  for ($i = 0; $i < $nbr; $i++) {
    if ($_SESSION['guild'][$i]->owner) {
      array_push($_SESSION['guildo'], $_SESSION['guild'][$i]);
      // print($_SESSION['guildo'][$i]->icon);
    }
  }
  // var_dump($_SESSION['guildo']);
  $g = array();
  $guild = new GuildDB($cnx);
  $g = $guild->getGuild();
  if ($_SESSION['connected'] == true) {
    $nbr = count($_SESSION['guildo']);
    // print $nbr;
    for ($i = 0; $i < $nbr; $i++) {
      // print($_SESSIOkN['guildo'][$i]->icon);
  ?>
      <div class="contenu">
        <div class="avatar">
          <img class="avatar-icon" src="<?= $_SESSION['guildo'][$i]->icon ? 'https://cdn.discordapp.com/icons/' . $_SESSION['guildo'][$i]->id . '/' . $_SESSION['guildo'][$i]->icon . '.png' : './admin/images/icon.png' ?>">
          <span class="name tag"><?= $_SESSION['guildo'][$i]->name ?></span>
        </div>
        <?php
        if ($g[$i]->available == true) {
        ?>
          <a class="lien" href="https://octogone.xyz/index.php?page=dashboard.php&guild=<?= $_SESSION['guildo'][$i]->id; ?>">Config</a>
        <?php
        } else {
        ?>
          <a class="lien" href="https://discordapp.com/oauth2/authorize?client_id=606160268648644630&scope=bot&permissions=8&response_type=code&redirect_uri=https%3A%2F%2Foctogone.xyz%2Findex.php%3Fpage%3Dredirect.php&guild_id=<?= $_SESSION['guildo'][$i]->id; ?>">ajouter</a>
        <?php
        }
        ?>
      </div>
  <?php
    }
  } else {
    header('Location: https://octogone.xyz/index.php?page=accueil.php');
  }
  ?>
</section>