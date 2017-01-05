<?
include('../includes/autoload.php');

$login->verify();

$data               = dataDDMMYYYYtoYYYYMMDD($_POST['data']);
$membrosAdultos     = intval($_POST['membrosAdultos']);
$visitantesAdultos  = intval($_POST['visitantesAdultos']);
$membrosCriancas    = intval($_POST['membrosCriancas']);
$visitantesCriancas = intval($_POST['visitantesCriancas']);
$descricao          = addslashes($_POST['descricao']);


$post = new girafaTablePost();
$post->table = 'Cultos';

if(isset($_POST['id']) > 0){
    $post->id = intval($_POST['id']);
    $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);

$post->AddFieldString('Data',                 $data);
$post->AddFieldInteger('MembrosAdultos',      $membrosAdultos);
$post->AddFieldInteger('MembrosCriancas',     $membrosCriancas);
$post->AddFieldInteger('VisitantesAdultos',   $visitantesAdultos);
$post->AddFieldInteger('VisitantesCriancas',  $visitantesCriancas);
$post->AddFieldString('Descricao',            $descricao);

$sql = $post->GetSql();
//die($sql);
$db->Execute($sql);

if(!isset($id)){
    $id = $db->GetLastIdInsert();
    $_SESSION['form_msg'] = 'O registro foi adicionado com sucesso     :)';
} else {
    $_SESSION['form_msg'] = 'O registro foi atualizado com sucesso     :)';
}

header('LOCATION:' . GetLink('cultos/edit/' . $id));

?>