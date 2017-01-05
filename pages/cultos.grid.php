<?
template_getHeader();

$grid = new girafaGRID('Cultos');
$grid->legends = array('Data', 'Membros', 'Visitantes');

$sql = 'SELECT * FROM Cultos';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Data DESC';
$cultos = $db->LoadObjects($sql);

foreach($cultos as $culto) {

  $data = new girafaDate($culto->Data, ENUM_DATE_FORMAT::YYYY_MM_DD);
  $field_data = new girafaGRID_field($data->GetDate('d/m/Y') . '  (' . $data->GetDayOfWeekLong() . ')');

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