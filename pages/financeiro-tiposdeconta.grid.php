<?
template_getHeader();

$grid = new girafaGRID('Financeiro - Tipos de Conta');
$grid->legends = array('Nome', 'Tipo');


$sql = 'SELECT * FROM FinanceiroTiposDeConta';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$contas = $db->LoadObjects($sql);

foreach($contas as $conta) {

  $field_nome = new girafaGRID_field($conta->Nome);
  $field_nome->orderAsc();
  $field_tipo = new girafaGRID_field(($conta->Tipo == 'ENT'?'Entrada':'Saída'));
  $field_tipo->width = 150;


  $grid->addValues(array($field_nome, $field_tipo), $conta->ID);
}
$grid->PrintHTML();

template_getFooter();
?>