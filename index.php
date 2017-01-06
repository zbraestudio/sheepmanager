<?
include('includes/autoload.php');

//se for em branco, redireciona pro /home
if(empty($_GET['url'])){

    //se estiver logado, vai pro Dashboard (se não, vai pro site)
    if($login->verify(false))
        header('LOCATION: ' . get_config('SITE_URL') . 'dashboard');
    else
        header('LOCATION: ' . get_config('SITE_URL') . 'site');

}

//divide parâmetros da URL
$params = explode('/', $_GET['url']);
include(get_config('SITE_PATH') . 'pages/' . GetPage(true));
?>