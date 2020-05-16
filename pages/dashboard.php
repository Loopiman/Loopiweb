<?
$_SESSION['guild_id'] = $_GET['guild'];
if ($_SESSION['connected'] != true) header('Location: https://octogone.xyz/index.php?page=accueil.php');
$g = array();
$guild = new GuildDB($cnx);
$g = $guild->getGuildName();
?>

<section class="principal-content">

    <h1 id="titre">dashboard de <?=$g[0]->name ?></h1>
    <div class="dashboard">
        <div class="setting">
            <img src="./admin/images/icon.png" alt="coucou je suis un avatar">
            <div class="informations">
                <h2 class="titre"><a class="lien" href="https://octogone.xyz/index.php?page=commands.php">Commands</a></h2>
                <span class="infos">Add commands to your server !</span>
            </div>
        </div>
        <div class="setting">
            <img src="./admin/images/icon.png" alt="coucou je suis un avatar">
            <div class="informations">
                <h2 class="titre"><a class="lien" href="https://octogone.xyz/index.php?page=members.php">Members list</a></h2>
                <span class="infos">show the members'list</span>
            </div>
        </div>
        <div class="setting">
            <img src="./admin/images/icon.png" alt="coucou je suis un avatar">
            <div class="informations">
                <h2 class="titre">Moderator</h2>
                <span class="infos"></span>
            </div>
        </div>
        <div class="setting">
            <img src="./admin/images/icon.png" alt="coucou je suis un avatar">
            <div class="informations">
                <h2 class="titre"><a class="lien" href="https://octogone.xyz/index.php?page=bans.php">Ban List</a></h2>
                <span class="infos">fetch all banned user and the reason</span>
            </div>
        </div>
    </div>
</section>