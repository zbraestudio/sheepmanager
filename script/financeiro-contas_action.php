<?
//print_r($_POST);exit;

include('../includes/autoload.php');

$login->verify();

$nome                       = trim($_POST['nome']);
$bancoNome                  = trim($_POST['bancoNome']);
$bancoAgencia               = trim($_POST['bancoAgencia']);
$bancoConta                 = trim($_POST['bancoConta']);
$bancoContatoNome           = trim($_POST['bancoContatoNome']);
$bancoContatoEmail          = trim($_POST['bancoContatoEmail']);
$bancoContatoTelefone       = trim($_POST['bancoContatoTelefone']);



$post = new girafaTablePost();
$post->table = 'FinanceiroContas';

if(isset($_POST['id']) > 0){
  $post->id = intval($_POST['id']);
  $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);

$post->AddFieldString('Nome',                   $nome);
$post->AddFieldString('BancoNome',             $bancoNome);
$post->AddFieldString('BancoAgencia',          $bancoAgencia);
$post->AddFieldString('BancoConta',            $bancoConta);
$post->AddFieldString('BancoContatoNome',      $bancoContatoNome);
$post->AddFieldString('BancoContatoTelefone',  $bancoContatoTelefone);
$post->AddFieldString('BancoContatoEmail',     $bancoContatoEmail);

$sql = $post->GetSql();
//die($sql);
$db->Execute($sql);

if(!isset($id)){
  $id = $db->GetLastIdInsert();
  $_SESSION['form_msg'] = 'O registro foi adicionado com sucesso     :)';
} else {
  $_SESSION['form_msg'] = 'O registro foi atualizado com sucesso     :)';
}

header('LOCATION:' . GetLink('financeiro-contas/edit/' . base64_encode($id)));

?>