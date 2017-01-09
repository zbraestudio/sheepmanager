<?
template_getHeader();

$grid = new girafaGRID('FinanceiroContasInternas', 'Financeiro - Contas Internas');

$field_nome = new girafaGRID_field('Nome');
$field_nome->orderAsc();

$grid->addFields(array($field_nome));

$grid->PrintHTML();

template_getFooter();
?>