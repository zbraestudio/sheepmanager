<?
template_getHeader();

$grid = new girafaGRID('FinanceiroContas', 'Financeiro - Contas');
$grid->legends = array('Nome', 'Banco', 'Agência', 'Conta');



$field_nome = new girafaGRID_field('Nome');
$field_nome->orderAsc();

$field_banco = new girafaGRID_field('BancoNome', 'Banco');
$field_banco->width = 250;
$field_agencia = new girafaGRID_field('BancoAgencia', 'Agência');
$field_agencia->width = 150;
$field_conta = new girafaGRID_field('BancoConta', 'Conta');
$field_conta->width = 200;

$grid->addFields(array($field_nome, $field_banco, $field_agencia, $field_conta));

$grid->PrintHTML();

template_getFooter();
?>