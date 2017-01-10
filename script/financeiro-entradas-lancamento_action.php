<?
//print_r($_POST);exit;

include('../includes/autoload.php');

$login->verify();

$compromisso        = intval($_POST['Compromisso']);
$data               = dataDDMMYYYYtoYYYYMMDD($_POST['Data']);
$valor              = decimalToDB($_POST['Valor']);
$conta              = intval($_POST['Conta']);
$contaInterna       = intval($_POST['ContaInterna']);

$post = new girafaTablePost();
$post->table = 'FinanceiroCompromissosLancamentos';

if(isset($_POST['id']) > 0){
  $post->id = intval($_POST['id']);
  $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);

$post->AddFieldInteger('Compromisso',           $compromisso);
$post->AddFieldString('Data',                  $data);
$post->AddFieldString('Valor',                 $valor);
$post->AddFieldInteger('Conta',                 $conta);
$post->AddFieldInteger('ContaInterna',          $contaInterna);

$sql = $post->GetSql();
//die($sql);
$db->Execute($sql);

if(!isset($id)){
  $id = $db->GetLastIdInsert();
  $_SESSION['form_msg'] = 'O registro foi adicionado com sucesso     :)';
} else {
  $_SESSION['form_msg'] = 'O registro foi atualizado com sucesso     :)';
}

financeiroFechaCompromisso($compromisso);

header('LOCATION:' . GetLink('financeiro-entradas/edit/' . base64_encode($compromisso) . '/lancamento/edit/' . base64_encode($id)));

?>