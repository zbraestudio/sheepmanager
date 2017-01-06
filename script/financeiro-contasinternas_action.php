<?
//print_r($_POST);exit;

include('../includes/autoload.php');

$login->verify();

$nome                       = trim($_POST['nome']);


$post = new girafaTablePost();
$post->table = 'FinanceiroContasInternas';

if(isset($_POST['id']) > 0){
  $post->id = intval($_POST['id']);
  $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);

$post->AddFieldString('Nome',                   $nome);

$sql = $post->GetSql();
//die($sql);
$db->Execute($sql);

if(!isset($id)){
  $id = $db->GetLastIdInsert();
  $_SESSION['form_msg'] = 'O registro foi adicionado com sucesso     :)';
} else {
  $_SESSION['form_msg'] = 'O registro foi atualizado com sucesso     :)';
}

header('LOCATION:' . GetLink('financeiro-contasinternas/edit/' . base64_encode($id)));

?>