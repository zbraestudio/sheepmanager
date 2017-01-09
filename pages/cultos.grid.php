<?
template_getHeader();

$grid = new girafaGRID('Cultos');
$grid->legends = array('Data', 'Membros', 'Visitantes');

$sql = 'SELECT * FROM Cultos';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Data DESC';
$cultos = $db->LoadObjects($sql);

foreach($cultos as $culto) {

  $field_data = new girafaGRID_field($culto->Data);
  $field_data->isDate();
  $field_data->alignLeft();
  $field_data->orderDesc();

  $field_membros = new girafaGRID_field(intval($culto->MembrosAdultos) + intval($culto->MembrosCriancas));
  $field_membros->alignRight();
  $field_membros->width = 100;

  $field_visitantes = new girafaGRID_field(intval($culto->VisitantesAdultos) + intval($culto->VisitantesCriancas));
  $field_visitantes->alignRight();
  $field_visitantes->width = 100;

  $grid->addValues(array($field_data, $field_membros, $field_visitantes), $culto->ID);
}
$grid->PrintHTML();

template_getFooter();
?>