<?

template_getHeader();


$form = new girafaFORM('Financeiro - Tipos de Conta', 'financeiro-tiposdeconta_action.php', 'FinanceiroTiposDeConta', 'Nome');

/* DADOS  */
$box = new girafaFORM_box('Geral');

//Tipo
$html  = '<label class="col-sm-2 control-label">Tipo</label>';
$options = array(
  'ENT' => 'Entrada',
  'SAI' => 'Saída'
);
$html .= '<div class="col-sm-4">' . form_field_list('tipo', $options, @$form->reg->Tipo) .'</div>';
$box->AddContent($html);

$box->AddContentBreakLine();

//Nome
$html  = '<label class="col-sm-2 control-label">Nome</label>';
$html .= '<div class="col-sm-8">' . form_field_string('nome', @$form->reg->Nome, 100) .'</div>';
$box->AddContent($html);


$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>