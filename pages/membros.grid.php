<?
template_getHeader();

$grid = new girafaGRID('Membros', 'Membros');

$grid->AddFilter('Somente Membros', "SITUACAO = 'MEM'", true);
$grid->AddFilter('Somente Faltosos', "SITUACAO = 'FAL'");
$grid->AddFilter('Somente Desligado', "SITUACAO = 'DES'");

$field_nome = new girafaGRID_field('Nome');
$field_nome->orderAsc();

$field_apelido = new girafaGRID_field('Apelido');
$field_apelido->width = 250;

$field_email = new girafaGRID_field('Email');
$field_email->width = 250;
$field_email->isMail();

$grid->addFields(array($field_nome, $field_apelido, $field_email));

$grid->PrintHTML();

template_getFooter();
?>