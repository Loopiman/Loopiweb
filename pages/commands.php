<?
if (!$_SESSION['connected']) header('Location: https://octogone.xyz/index.php?page=accueil');
$c = array();
$command = new CommandDB($cnx);
$c = $command->getCommand();
$nbr = count($c);
?>
<section class="principal-content">
  <div class="container-fluid">
    <div class="row top">
      <div class="col-md-2 retour">
        <a class="link" href="index.php?page=dashboard&guild=<?= $_SESSION['guild_id']?>">
          <div class="titre text-center">
            <svg class="bi bi-caret-left-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M3.86 8.753l5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 00-1.659-.753l-5.48 4.796a1 1 0 000 1.506z" />
            </svg>
            <span>retour</span>
          </div>
        </a>
      </div>
      <div class="col-md-8 text-center">
        <h1 class="titre text-center">Panneau de commandes</h1>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-dark">
        <tr>
          <td style="vertical-align:middle" scope="col" class="name">nom</td>
          <td style="vertical-align:middle" scope="col" class="name">Description</td>
          <td style="vertical-align:middle" scope="col" class="name">Active</td>
          <td style="vertical-align:middle" scope="col" class="name">supprimer</td>
        </tr>
        <?php
        for ($i = 0; $i < $nbr; $i++) {
        ?>
          <tr>
            <td style="vertical-align:middle" scope="row" class="colname">!<?= $c[$i]->name ?></td>
            <td style="vertical-align:middle" class="colname"><?= $c[$i]->response ?></td>
            <td style="vertical-align:middle" class="colenabled">

              <label class="switch">
                <input <? if ($c[$i]->enabled == 1) echo 'checked' ?> type="checkbox" class="checkbox" id="<?= $c[$i]->command_id ?>" />
                <span class="slider round"></span>
              </label>
            </td>
            <td style="vertical-align:middle" class="colname">
              <button id="<?= $c[$i]->command_id ?>" type="button" class="delete btn btn-danger<? if ($c[$i]->command_id <= 5) print ' hvr-buzz-out disabled' ?>" <? if ($c[$i]->command_id <= 5) print ' data-toggle="tooltip" title="Default Bot command, you can not delete it"' ?>>
                Delete
              </button>
            </td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>
  </div>
  <div class="container-fluid formulaire">
    <div class="row text-white">
      <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
        <h2 id="titreform">Commande Personalisée</h2>
        <div class="px-2">
          <form class="justify-content-center">
            <div class="form-group">
              <input type="text" class="form-control" id="command_name" placeholder="Nom de la commande">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="return" placeholder="Réponse">
            </div>
            <button type="button" class="add_command btn btn-danger btn-lg">Sauvegarder</button>
          </form>
        </div>
      </div>
    </div>
  </div>


</section>