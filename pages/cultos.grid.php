<?
template_getHeader();

$grid = new girafaGRID('Cultos', 'Cultos');
$grid->fnc_before = 'before_grid';

$sql = 'SELECT * FROM Cultos';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Data DESC';
$cultos = $db->LoadObjects($sql);

foreach($cultos as $culto) {

  $field_data = new girafaGRID_field('Data', 'Data');
  $field_data->isDate();
  $field_data->alignLeft();
  $field_data->orderDesc();

  $field_membros = new girafaGRID_field('MEMBROS', 'Membros');
  $field_membros->alignRight();
  $field_membros->width = 100;
  $field_membros->isCustom();

  $field_visitantes = new girafaGRID_field('VISITANTES', 'Visitantes');
  $field_visitantes->alignRight();
  $field_visitantes->width = 100;
  $field_visitantes->isCustom();

  $grid->addFields(array($field_data, $field_membros, $field_visitantes));
}
$grid->PrintHTML();

template_getFooter();

function macro_grid_before($fieldname, $reg){

  if($fieldname == 'MEMBROS'){
    return intval($reg->MembrosAdultos + $reg->MembrosCriancas);
  }

  if($fieldname == 'VISITANTES'){
    return intval($reg->VisitantesAdultos + $reg->VisitantesCriancas);
  }
}

?>