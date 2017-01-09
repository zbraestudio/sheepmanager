<?
template_getHeader();

$grid = new girafaGRID('Financeiro - Contas');
$grid->legends = array('Nome', 'Banco', 'Agência', 'Conta');


$sql = 'SELECT * FROM FinanceiroContas';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$contas = $db->LoadObjects($sql);

foreach($contas as $conta) {

  $field_nome = new girafaGRID_field($conta->Nome);
  $field_nome->orderAsc();

  $field_banco = new girafaGRID_field($conta->BancoNome);
  $field_banco->width = 250;
  $field_agencia = new girafaGRID_field($conta->BancoAgencia);
  $field_agencia->width = 150;
  $field_conta = new girafaGRID_field($conta->BancoConta);
  $field_conta->width = 200;

  $grid->addValues(array($field_nome, $field_banco, $field_agencia, $field_conta), $conta->ID);
}
$grid->PrintHTML();

template_getFooter();
?>