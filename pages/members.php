<?php
if (!$_SESSION['connected']) header('Location: https://octogone.xyz/index.php?page=accueil');
$m = array();
$member = new MemberDB($cnx);
$m = $member->getMember();
$nbr = count($m);
?>
<section class="member-content">
  <div class="container-fluid">
    <div class="row top">
      <div class="col-sm-2 retour">
        <a class="link" href="index.php?page=dashboard&guild=<?= $_SESSION['guild_id'] ?>">
          <div class="titre  text-center">
            <svg class="bi bi-caret-left-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M3.86 8.753l5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 00-1.659-.753l-5.48 4.796a1 1 0 000 1.506z" />
            </svg>
            <span>retour</span>
          </div>
        </a>
      </div>
      <div class="col-sm-8 text-center">
        <h1 class="titre text-center">Liste des membres (<?= $nbr ?>)</h1>
      </div>
      <div class="col-sm-2  col-sm-2 text-center">
        <div>
          <input type="text" class="form-control" id="search" placeholder="Pseudo">
        </div>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-dark">
      <tr id="tri">
        <td style="vertical-align:middle" scope="col" class="name col-4">
          <span id="tag">Pseudo</span>
          <span id="arrowtag">
          </span>
        </td>
        <td style="vertical-align:middle" scope="col" class="name col-4">
          <span id="pos">Role</span>
          <span id="arrowr">
          </span>
        </td>
        <td style="vertical-align:middle" scope="col" class="name col-4">
          <span id="account_join">Date adhésion</span>
          <span id="arrowd">
          </span>
        </td>
      </tr>
      <?php
      for ($i = 0; $i < $nbr; $i++) {
      ?>
        <tbody id="tdata">

        </tbody>
      <?php
      }
      ?>
    </table>
  </div>
</section>