<?
session_start();

include('config.php');
include('functions.php');
include('girafa.db.php');
include('girafa.tablepost.php');

include('obj.grid.php');

//$db = new nbrDB(get_config('DB_HOST'), get_config('DB_DB'), get_config('DB_USER'), get_config('DB_PASS'));

/* Envia E-mail */
require_once(get_config('SITE_PATH') . 'bower_components/PHPMailer/PHPMailerAutoload.php');

/* E-mails */
/*
include(SITE_PATH . '/mails/templates/template_aula_assistindo.php');
include(SITE_PATH . '/mails/templates/template_aula_respostas.php');
*/
$mailer = new PHPMailer;

$mailer->isSMTP();
$mailer->Host =             'smtp.ielbc.com.br';
$mailer->SMTPAuth =         true;
$mailer->Username =         'tiago@ielbc.com.br';
$mailer->Password =         'nw041203';
//$mailer->SMTPSecure =       'tls';
$mailer->Port =             587;

$mailer->CharSet = "UTF-8";
$mailer->addEmbeddedImage(get_config('SITE_PATH') . 'mails/templates/images/logo.png', 'logo');
$mailer->setFrom('tiago@ielbc.com.br', 'LIVRES EaD');
$mailer->isHTML(true);
?>