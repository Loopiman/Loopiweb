<?
if ($_SESSION['connected'] != true) header('Location: https://octogone.xyz/index.php?page=accueil.php');
$c = array();
$command = new CommandDB($cnx);
$c = $command->getCommand();
$nbr = count($c);
?>
<section class="principal-content">
  <div class="scroll">
    <table>
      <tr>
        <td class="name">Command name</td>
        <td class="name">Description</td>
        <td class="enabled">enabled</td>
      </tr>
      <?php
      for ($i = 0; $i < $nbr; $i++) {
      ?>
        <tr>
          <td class="name">!<?= $c[$i]->name ?></td>
          <td class="name"><?= $c[$i]->response ?></td>
          <td class="enabled">
            <!-- Rounded switch -->

            <label class="switch">
              <input <? if ($c[$i]->enabled == 1) echo 'checked' ?> type="checkbox" class="checkbox" id="<?= $c[$i]->command_id ?>" />
              <span class="slider round"></span>
            </label>
          </td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
  <div>

  </div>
  <div class="add">
    <div class="label">
      <label for="name">Command name :</label>
      <input type="text" id="name" name="user_name">
    </div>
    <div class="label">
      <label for="name">Return :</label>
      <input type="text" id="name" name="user_name">
    </div>

    <button type="submit" class="add_command">Save</button>
  </div>
</section>