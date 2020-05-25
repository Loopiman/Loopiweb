<?php
session_start();
if (!$_SESSION['connected']) header('Location: https://octogone.xyz/index.php?page=accueil');
$nbr = count($_SESSION['guild']);
for ($i = 0; $i < $nbr; $i++) {
  if ($_SESSION['guild'][$i]->owner || strcmp($_SESSION['guild'][$i]->permissions, '2147483647') == 0) {
    array_push($_SESSION['guildo'], $_SESSION['guild'][$i]);
  }
}
$g = array();
$guild = new GuildDB($cnx);
$g = $guild->getGuild();
$nbr = count($_SESSION['guildo']);

?>
<input type="hidden" id="nbr" name="nbr" value="<?php echo ($nbr); ?>" />
<section class="principal-content">
  <div class="container">
    <div class="table-responsive">
      <table class="table table-striped table-dark">
        <tr>
          <td scope="col" class="name text-center" colspan="2">Serveurs</td>
        </tr>
        <?php
        for ($i = 0; $i < $nbr; $i++) {
        ?>
          <tr>
            <td scope="row" class="avatar">
              <img src="<?= $_SESSION['guildo'][$i]->icon ? 'https://cdn.discordapp.com/icons/' . $_SESSION['guildo'][$i]->id . '/' . $_SESSION['guildo'][$i]->icon . '.png' : './admin/images/icon.png' ?>">
              <span class="colname tag" id="<?= $nbr[$i] ?>"><?= $_SESSION['guildo'][$i]->name ?></span>
            </td>
            <td  style="vertical-align:middle" class="colname">
              <?php
              if ($g[$i]->available == true) {
              ?>
                <a class="lien" href="https://octogone.xyz/index.php?page=dashboard&guild=<?= $_SESSION['guildo'][$i]->id; ?>"><button type="button" class="btn btn-danger add_command">Configurer</button></a>
              <?php
              } else {
              ?>
                <a class="lien" href="https://discordapp.com/oauth2/authorize?client_id=606160268648644630&scope=bot&permissions=8&response_type=code&redirect_uri=https%3A%2F%2Foctogone.xyz%2Findex.php%3Fpage%3Dredirect&guild_id=<?= $_SESSION['guildo'][$i]->id; ?>"><button type="button" class="btn btn-danger add_command">Ajouter</button></a>
              <?php
              }
              ?>
            </td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>
  </div>
</section>