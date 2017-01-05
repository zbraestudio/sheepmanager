<?
template_getHeader();

$grid = new girafaGRID('Membros');
$grid->legends = array('Nome Completo', 'Apelido', 'E-mail');


$sql = 'SELECT * FROM Membros';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$pessoas = $db->LoadObjects($sql);

foreach($pessoas as $pessoa) {

  $field_nome = new girafaGRID_field($pessoa->Nome);
  $field_apelido = new girafaGRID_field($pessoa->Apelido);
  $field_apelido->width = 250;
  $field_email = new girafaGRID_field('<a href="mailto:' . $pessoa->Email . '">' . $pessoa->Email . '</a>');
  $field_email->width = 250;

  $grid->addValues(array($field_nome, $field_apelido, $field_email), $pessoa->ID);
}
$grid->PrintHTML();

template_getFooter();
?>