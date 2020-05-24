<?
if (!$_SESSION['connected']) header('Location: https://octogone.xyz/index.php?page=accueil');
$_SESSION['guild_id'] = $_GET['guild'];
$v = array();
$verif = new GuildDB($cnx);
$v = $verif->verifAdmin();
if (!$v[0]->isadmin) header('Location: https://octogone.xyz/index.php?page=overview');

$g = array();
$guild = new GuildDB($cnx);
$g = $guild->getGuildName();
?>

<section class="principal-content">
    <h1 class="titre text-center">DASHBOARD DE : <?= $g[0]->name ?></h1>
    <div class="container">
        <div class="row">
            <a class="link setting col-sm" href="https://octogone.xyz/index.php?page=commands">
                <img class="image" src="./admin/images/icon.png" alt="discord icon">
                <div class="informations">
                    <h2 class="titre">Commandes</h2>
                    <span class="infos">Pannel de commandes</span>
                </div>
            </a>
            <a class="link setting col-sm" href="https://octogone.xyz/index.php?page=members">
                <img class="image" src="./admin/images/icon.png" alt="discord icon">
                <div class="informations">
                    <h2 class="titre">Liste des membres</h2>
                    <span class="infos">La liste des membres</span>
                </div>
            </a>
            <a class="link setting col-sm" href="#">
                <img class="image" src="./admin/images/icon.png" alt="discord icon">
                <div class="informations">
                    <h2 class="titre">Modération</h2>
                    <span class="infos">Indisponible pour le moment</span>
                </div>
            </a>
        </div>
        <div class="row">
            <a class="link setting col-sm" href="https://octogone.xyz/index.php?page=bans">
                <img class="image" src="./admin/images/icon.png" alt="discord icon">
                <div class="informations">
                    <h2 class="titre">Liste des bans</h2>
                    <span class="infos">Affiche la liste des banissements</span>
                </div>
            </a>
        </div>
    </div>
</section>