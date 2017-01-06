<?
template_getHeader();

$grid = new girafaGRID('Financeiro - Contas Internas');
$grid->legends = array('Nome');


$sql = 'SELECT * FROM FinanceiroContasInternas';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$contas = $db->LoadObjects($sql);

foreach($contas as $conta) {

  $field_nome = new girafaGRID_field($conta->Nome);

  $grid->addValues(array($field_nome), $conta->ID);
}
$grid->PrintHTML();

template_getFooter();
?>