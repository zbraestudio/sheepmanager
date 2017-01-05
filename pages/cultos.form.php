<?
template_getHeader();

$form = new girafaFORM('Cultos', 'cultos_action.php', 'Cultos', 'Data');

/* INFORMAÇÕES DO CULTO */
$box = new girafaFORM_box('Informações do Culto', 'Preencha abaixo as informações que correspondem ao Culto');

// Data
$html  = '<label class="col-sm-2 control-label">Data</label>';
$html .= '<div class="col-sm-3">' . form_field_date('data', @$form->reg->Data, date('Y-m-d')) . '</div>';
$box->AddContent($html);

$form->AddBox($box);

/* ADULTOS */
$box = new girafaFORM_box('Adultos', null, 6);

//Membros
$html  = '<label class="col-sm-8 control-label">Membros</label>';
$html .= '<div class="col-sm-4">' . form_field_integer('membrosAdultos', @$form->reg->MembrosAdultos, 0) . '</div>';
$box->AddContent($html);

//Visitantes
$html  = '<label class="col-sm-8 control-label">Visitantes</label>';
$html .= '<div class="col-sm-4">' . form_field_integer('visitantesAdultos', @$form->reg->VisitantesAdultos, 0) . '</div>';
$box->AddContent($html);

$form->AddBox($box);

/* CRIANÇAS */
$box = new girafaFORM_box('Crianças', null, 6);

//Membros
$html  = '<label class="col-sm-8 control-label">Membros</label>';
$html .= '<div class="col-sm-4">' . form_field_integer('membrosCriancas', @$form->reg->MembrosCriancas, 0) . '</div>';
$box->AddContent($html);

//Visitantes
$html  = '<label class="col-sm-8 control-label">Visitantes</label>';
$html .= '<div class="col-sm-4">' . form_field_integer('visitantesCriancas', @$form->reg->VisitantesCriancas, 0) . '</div>';
$box->AddContent($html);

$form->AddBox($box);


/* DESCRIÇÃO */
$box = new girafaFORM_box('Descrição');

//Descrição
$html = '<div class="col-sm-12">' . form_field_html('descricao', @$form->reg->Descricao, null, null, false) . '</div>';
$box->AddContent($html);

$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>