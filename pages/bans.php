<section class="principal-content">
  <?php
  if (!$_SESSION['connected']) header('Location: https://octogone.xyz/index.php?page=accueil');

  $b = array();
  $ban = new BanDB($cnx);
  $b = $ban->getBan();
  $nbr = count($b);
  if ($nbr > 0) {
  ?>
    <div class="container-fluid">
        <div class="row top">
          <div class="col-md-2 retour">
            <a class="link" href="index.php?page=dashboard&guild=<?= $_SESSION['guild_id'] ?>">
              <div class="titre text-center">
                <svg class="bi bi-caret-left-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.86 8.753l5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 00-1.659-.753l-5.48 4.796a1 1 0 000 1.506z" />
                </svg>
                <span>retour</span>
              </div>
            </a>
          </div>
          <div class="col-md-8 text-center">
            <h1 class="titre text-center">Liste des bans</h1>
          </div>
          <div class="col-md-2"></div>
        </div>
      <div class="table-responsive">
        <table class="table table-striped table-dark">
          <tr>
            <td style="vertical-align:middle" scope="col" class="name text-center">Pseudo</td>
            <td style="vertical-align:middle" scope="col" class="name text-center">Raison</td>
            <td style="vertical-align:middle" scope="col" class="name text-center">Date du ban</td>
          </tr>
          <?php
          for ($i = 0; $i < $nbr; $i++) {
          ?>
            <tr>
              <td scope="row" class="avatar">
                <img src="<?= ($b[$i]->avatar ? $b[$i]->avatar : './admin/images/icon.png') ?>">
                <span class="colname tag"><?= $b[$i]->tag ?></span>
              </td>
              <td style="vertical-align:middle" class="colname"><?= $b[$i]->reason ? $b[$i]->reason : "raison inconnue" ?></td>
              <td style="vertical-align:middle" class="colname"><?= ($b[$i]->ban ? $b[$i]->ban : 'indisponible') ?></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    <?
  } else {
    ?>
      <h1>Aucune personne n'a été bannie de ton serveur</h1>
    <?
  }
    ?>
    </div>
</section>