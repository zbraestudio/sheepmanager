<?
include('includes/autoload.php');

//se for em branco, redireciona pro /home
if(empty($_GET['url']))
    header('LOCATION: ' . get_config('SITE_URL') . 'login');

//divide par�metros da URL
$params = explode('/', $_GET['url']);
include(get_config('SITE_PATH') . 'pages/' . GetPage(true));
?>