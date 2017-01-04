<?

include('../includes/autoload.php');

//pega dados
$mail = addslashes($_POST['mail']);
$pass = addslashes($_POST['pass']);

if($login->login($mail, $pass)){

  header('LOCATION:' . GetLink('dashboard'));

} else {

  $_SESSION['login_msg'] = 'E-mail ou senha incorreta.';
  header('LOCATION:' . GetLink('login'));

}
?>