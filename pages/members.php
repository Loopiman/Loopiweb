<?php
if ($_SESSION['connected'] == true) {

  $m = array();
  $member = new MemberDB($cnx);
  $m = $member->getMember();
  $nbr = count($m);

  $r = array();
  $role = new RoleDB($cnx);
  $r = $role->getRole();
  $nbr_role = count($r);


  $member_role;

?>
  <section class="table-content">
    <table class="table-contenu">
      <tr>
        <td class="name">Pseudo</td>
        <td class="name">Rang le plus élevé</td>
        <td class="date">Date d'hadésion</td>
      </tr>
      <?php
      for ($i = 0; $i < $nbr; $i++) {
        for($j = 0; $j < $nbr_role; $j++){
          if($m[$i]->pos == $r[$j]->pos){
            $member_role = $r[$j]->name;
            // print $member_role;
          }
        }

      ?>
        <tr>
          <td class="avatar">
            <img class="avatar-icon" src="<?= ($m[$i]->avatar ? $m[$i]->avatar : './admin/images/icon.png') ?>">
            <span class="tag"><?= $m[$i]->tag ?></span>
          </td>
          <td class="name"><?= $member_role ?></td>
          <td class="date"><?= $m[$i]->account_join ?></td>
        </tr>
      <?php
      }

      ?>
    </table>
    </div>


  </section>
<?php
}
