<?
//print_r($_POST);exit;

include('../includes/autoload.php');

$login->verify();

$data               = dataDDMMYYYYtoYYYYMMDD($_POST['Data']);
$deConta            = trim($_POST['DeConta']);
$deContaInterna     = trim($_POST['DeContaInterna']);
$paraConta          = trim($_POST['ParaConta']);
$paraContaInterna   = trim($_POST['ParaContaInterna']);
$valor              = decimalToDB($_POST['Valor']);


$post = new girafaTablePost();
$post->table = 'FinanceiroTransferencias';

if(isset($_POST['id']) > 0){
    $post->id = intval($_POST['id']);
    $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);

$post->AddFieldString('Data',                  $data);
$post->AddFieldString('DeConta',              $deConta);
$post->AddFieldString('DeContaInterna',       $deContaInterna);
$post->AddFieldString('ParaConta',            $paraConta);
$post->AddFieldString('ParaContaInterna',     $paraContaInterna);
$post->AddFieldString('Valor',                 $valor);

$sql = $post->GetSql();
//die($sql);
$db->Execute($sql);

if(!isset($id)){
    $id = $db->GetLastIdInsert();
    $_SESSION['form_msg'] = 'O registro foi adicionado com sucesso     :)';
} else {
    $_SESSION['form_msg'] = 'O registro foi atualizado com sucesso     :)';
}

header('LOCATION:' . GetLink('financeiro-transferencias/edit/' . base64_encode($id)));

?>