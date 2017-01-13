<?
//print_r($_POST);exit;

include('../includes/autoload.php');

$login->verify();

$data             = dataDDMMYYYYtoYYYYMMDD($_POST['data']);
$valor            = decimalToDB($_POST['valorPrevisto']);
$descricao        = trim($_POST['descricao']);
$observacoes      = trim($_POST['observacoes']);
$tipoDeConta      = intval($_POST['tipoDeConta']);
$situacao         = trim($_POST['situacao']);

$post = new girafaTablePost();
$post->table = 'FinanceiroCompromissos';

if(isset($_POST['id']) > 0){
  $post->id = intval($_POST['id']);
  $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);
$post->AddFieldString('Tipo', 'ENT');

$post->AddFieldString('Data',                   $data);
$post->AddFieldString('ValorPrevisto',          $valor);
$post->AddFieldString('Descricao',              $descricao);
$post->AddFieldString('Observacoes',            $observacoes);
$post->AddFieldString('TipoDeConta',            $tipoDeConta);
$post->AddFieldString('Situacao',               $situacao);

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


header('LOCATION:' . GetLink('financeiro-entradas/edit/' . base64_encode($id)));

?>