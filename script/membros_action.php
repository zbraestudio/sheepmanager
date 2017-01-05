<?
include('../includes/autoload.php');

$login->verify();

$nome                 = $_POST['nome'];
$situacao             = $_POST['situacao'];
$apelido              = $_POST['apelido'];
$situacaoCivil        = $_POST['situacaoCivil'];
$email                = $_POST['email'];
$enderecoLogradouro   = $_POST['enderecoLogradouro'];
$enderecoBairro       = $_POST['enderecoBairro'];
$enderecoComplemento  = $_POST['enderecoComplemento'];
$enderecoCidade       = $_POST['enderecoCidade'];
$enderecoUF           = $_POST['enderecoUF'];
$enderecoCEP          = $_POST['enderecoCEP'];
$documentoRG          = $_POST['documentoRG'];
$documentoCPF         = $_POST['documentoCPF'];
$dataNascimento       = dataDDMMYYYYtoYYYYMMDD($_POST['dataNascimento']);
$dataBatismo          = dataDDMMYYYYtoYYYYMMDD($_POST['dataBatismo']);
$dataCasamento        = dataDDMMYYYYtoYYYYMMDD($_POST['dataCasamento']);




$post = new girafaTablePost();
$post->table = 'Membros';

if(isset($_POST['id']) > 0){
  $post->id = intval($_POST['id']);
  $id = intval($_POST['id']);
}

$post->AddFieldString('Igreja', $login->church_id);

$post->AddFieldString('Nome',                 $nome);
$post->AddFieldString('Situacao',             $situacao);
$post->AddFieldString('Apelido',              $apelido);
$post->AddFieldString('Email',                $email);
$post->AddFieldString('SituacaoCivil',        $situacaoCivil);
$post->AddFieldString('EnderecoLogradouro',   $enderecoLogradouro);
$post->AddFieldString('enderecoBairro',       $enderecoBairro);
$post->AddFieldString('EnderecoComplemento',  $enderecoComplemento);
$post->AddFieldString('EnderecoCidade',       $enderecoCidade);
$post->AddFieldString('EnderecoUF',           $enderecoUF);
$post->AddFieldString('EnderecoCEP',          $enderecoCEP);
$post->AddFieldString('DocumentoRG',          $documentoRG);
$post->AddFieldString('DocumentoCPF',         $documentoCPF);
$post->AddFieldString('DataNascimento',       $dataNascimento);
$post->AddFieldString('DataBatismo',          $dataBatismo);
$post->AddFieldString('DataCasamento',        $dataCasamento);

$sql = $post->GetSql();
$db->Execute($sql);

if(!isset($id)){
  $id = $db->GetLastIdInsert();
  $_SESSION['form_msg'] = 'O registro foi adicionado com sucesso     :)';
} else {
  $_SESSION['form_msg'] = 'O registro foi atualizado com sucesso     :)';
}

header('LOCATION:' . GetLink('membros/edit/' . base64_encode($id)));

?>