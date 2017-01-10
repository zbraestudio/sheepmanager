<?
template_getHeader();

$grid = new girafaGRID('FinanceiroTransferencias', 'Financeiro - Transferências');

$field_data = new girafaGRID_field('Data');
$field_data->isDate();

$field_deConta = new girafaGRID_field('DeConta', 'Da Conta');
$field_deConta->isTable('FinanceiroContas', 'Nome');

$field_deContaInterna = new girafaGRID_field('DeContaInterna', 'Da Conta Interna');
$field_deContaInterna->isTable('FinanceiroContasInternas', 'Nome');

$field_paraConta = new girafaGRID_field('ParaConta', 'Para Conta');
$field_paraConta->isTable('FinanceiroContas', 'Nome');

$field_paraContaInterna = new girafaGRID_field('ParaContaInterna', 'Para Conta Interna');
$field_paraContaInterna->isTable('FinanceiroContasInternas', 'Nome');

$field_valor = new girafaGRID_field('Valor', 'Valor');
$field_valor->isMoney();


$grid->addFields(array($field_data, $field_deConta, $field_paraConta, $field_deContaInterna, $field_paraContaInterna, $field_valor));

$grid->PrintHTML();

template_getFooter();
?>