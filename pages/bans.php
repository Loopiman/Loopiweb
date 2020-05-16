<section class="table-content">
  <?php
  if ($_SESSION['connected'] == true) {
  
    $b = array();
    $ban = new BanDB($cnx);
    $b = $ban->getBan();
    $nbr = count($b);

  ?>
      <table class="table-contenu">
        <tr>
          <td class="avatar">Pseudo</td>
          <td class="name">Raison</td>
          <td class="date">Date du ban</td>
        </tr>
        <?php
        for ($i = 0; $i < $nbr; $i++) {
        ?>
          <tr>
            <td class="avatar">
              <img class="avatar-icon" src="<?= ($b[$i]->avatar ? $b[$i]->avatar : './admin/images/icon.png') ?>">
              <span class="tag"><?= $b[$i]->tag ?></span>
            </td>
            <td class="name"><?= $b[$i]->reason ? $b[$i]->reason: "raison inconnue" ?></td>
            <td class="date"><?= ($b[$i]->ban ? $b[$i]->ban : 'indisponible') ?></td>
          </tr>
      <?php
        }
      }
      ?>
      </table>
</section>