<?
template_getHeader();

$grid = new girafaGRID('Financeiro - Entradas');
$grid->legends = array('Descrição', 'Data', 'Valor');


$sql = 'SELECT * FROM FinanceiroEntradas';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Data ASC';
$contas = $db->LoadObjects($sql);

foreach($contas as $conta) {

  $field_descricao = new girafaGRID_field($conta->Descricao);

  $field_data = new girafaGRID_field($conta->Data);
  $field_data->isDate();
  $field_data->width = 100;
  $field_data->orderDesc();
  $field_valor = new girafaGRID_field($conta->Valor);
  $field_valor->width = 150;
  $field_valor->isMoney();

  $grid->addValues(array($field_descricao, $field_data, $field_valor), $conta->ID);
}
$grid->PrintHTML();

template_getFooter();
?>