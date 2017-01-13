<?
//print_r($_POST);exit;

include('../includes/autoload.php');

$login->verify();

$data             = dataDDMMYYYYtoYYYYMMDD($_POST['data']);
$valor            = decimalToDB($_POST['valorPrevisto']);
$descricao        = trim($_POST['descricao']);
$obsercacoes      = trim($_POST['obsercacoes']);
$tipoDeConta      = intval($_POST['tipoDeConta']);
$membro           = trim($_POST['membro']);

$post = new girafaTablePost();
$post->table = 'FinanceiroCompromissos';

if(isset($_POST['id']) > 0){
  $post->id = intval($_POST['id']);
  $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);
$post->AddFieldString('Tipo', 'SAI');

$post->AddFieldString('Data',                   $data);
$post->AddFieldString('ValorPrevisto',          $valor);
$post->AddFieldString('Descricao',              $descricao);
$post->AddFieldString('Observacoes',            $obsercacoes);
$post->AddFieldString('TipoDeConta',            $tipoDeConta);
$post->AddFieldString('Membro',                 $membro);

$sql = $post->GetSql();

//die($sql);
$db->Execute($sql);

if(!isset($id)){
  $id = $db->GetLastIdInsert();
  $_SESSION['form_msg'] = 'O registro foi adicionado com sucesso     :)';
} else {
  $_SESSION['form_msg'] = 'O registro foi atualizado com sucesso     :)';
}

financeiroFechaCompromisso($id);


header('LOCATION:' . GetLink('financeiro-saidas/edit/' . base64_encode($id)));

?>