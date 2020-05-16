
<?php
error_reporting(E_ALL);
define('OAUTH2_CLIENT_ID', '606160268648644630');
define('OAUTH2_CLIENT_SECRET', 'RZH64Eoiz9u-yB8Uq0aV6_dVkxBIPAnt');
$authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
$tokenURL = 'https://discordapp.com/api/oauth2/token';
$apiURLBase = 'https://discordapp.com/api/users/@me';
$revokeURL = 'https://discordapp.com/api/oauth2/token/revoke';
$apiURLguild = 'https://discordapp.com/api/users/@me/guilds';


if (get('action') == 'login') {
  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => 'https://octogone.xyz/index.php?page=redirect.php',
    'response_type' => 'code',
    'scope' => 'identify guilds email'
  );

  header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
  die();
}
if (get('code')) {

  $token = apiRequest($tokenURL, array(
    "grant_type" => "authorization_code",
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'redirect_uri' => 'https://octogone.xyz/index.php?page=redirect.php',
    'code' => get('code')
  ));
  $logout_token = $token->access_token;
  $_SESSION['access_token'] = $token->access_token;
  header('Location: ' . $_SERVER['PHP_SELF']);
}
if (session('access_token')) {
  $user = apiRequest($apiURLBase);
  $guild = apiRequest($apiURLguild);
 
  $_SESSION['guild'] = $guild;
  $_SESSION['guildo'] = array();
  $_SESSION['connected'] = true;
  $_SESSION['user'] = $user->id;
}
if (get('action') == 'logout') {
  apiRequest($revokeURL, array(
    'token' => session('access_token'),
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
  ));
  unset($_SESSION['access_token']);
  $_SESSION['connected'] = false;
  $_SESSION['user'] = null;
  header('Location: https://octogone.xyz/index.php?page=accueil.php');
  die();
}

function apiRequest($url, $post = FALSE, $headers = array())
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $response = curl_exec($ch);
  if ($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  $headers[] = 'Accept: application/json';
  if (session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec($ch);
  return json_decode($response);
}
function get($key, $default = NULL)
{
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}
function session($key, $default = NULL)
{
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}
?>