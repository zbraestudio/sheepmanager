<?
template_getHeader();

$grid = new girafaGRID('FinanceiroTiposDeConta', 'Financeiro - Tipos de Conta');

$grid->AddFilter('de Saída', "Tipo = 'SAI'");
$grid->AddFilter('de Entrada', "Tipo = 'ENT'");

$field_nome = new girafaGRID_field('Nome');
$field_nome->orderAsc();

$field_tipo = new girafaGRID_field('Tipo', 'Tipo');
$field_tipo->isList(array('ENT' => 'Entrada', 'SAI' => 'Saída'));


$grid->addFields(array($field_nome, $field_tipo));

$grid->PrintHTML();

template_getFooter();
?>