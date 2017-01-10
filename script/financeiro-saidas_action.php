<?
//print_r($_POST);exit;

include('../includes/autoload.php');

$login->verify();

$data             = dataDDMMYYYYtoYYYYMMDD($_POST['data']);
$valor            = decimalToDB($_POST['valor']);
$descricao        = trim($_POST['descricao']);
$tipoDeConta      = intval($_POST['tipoDeConta']);
$conta            = intval($_POST['conta']);
$contaInterna     = intval($_POST['contaInterna']);
$situacao         = trim($_POST['situacao']);
$membro           = trim($_POST['membro']);


$post = new girafaTablePost();
$post->table = 'FinanceiroMovimentacoes';

if(isset($_POST['id']) > 0){
  $post->id = intval($_POST['id']);
  $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);
$post->AddFieldString('Tipo', 'SAI');

$post->AddFieldString('Data',                   $data);
$post->AddFieldString('Valor',                  $valor);
$post->AddFieldString('Descricao',              $descricao);
$post->AddFieldString('TipoDeConta',            $tipoDeConta);
$post->AddFieldString('Conta',                  $conta);
$post->AddFieldString('ContaInterna',           $contaInterna);
$post->AddFieldString('Situacao',               $situacao);
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

header('LOCATION:' . GetLink('financeiro-saidas/edit/' . base64_encode($id)));

?>