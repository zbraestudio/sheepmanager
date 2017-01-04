<?

include('../includes/autoload.php');

$login->logout();
header('LOCATION:' . GetLink('login'));

?>