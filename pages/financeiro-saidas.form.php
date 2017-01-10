<?

template_getHeader();


$form = new girafaFORM('Financeiro - Saídas', 'financeiro-saidas_action.php', 'FinanceiroMovimentacoes', 'Descricao');

/* DADOS  */
$box = new girafaFORM_box('Lançando nova Saída');

//Data
$html  = '<label class="col-sm-2 control-label">Data</label>';
$html .= '<div class="col-sm-3">' . form_field_date('data', @$form->reg->Data, 'TODAY') .'</div>';
$box->AddContent($html);

//Valor
$html  = '<label class="col-sm-1 col-sm-offset-3 control-label">Valor</label>';
$html .= '<div class="col-sm-3">' . form_field_number('valor', @$form->reg->Valor, '0.00') .'</div>';
$box->AddContent($html);

$box->AddContentBreakLine();

//Descrição
$html  = '<label class="col-sm-2 control-label">Descrição</label>';
$html .= '<div class="col-sm-10">' . form_field_string('descricao', @$form->reg->Descricao, 100) .'</div>';
$box->AddContent($html);


$box->AddContentBreakLine();

//Tipo de Conta
$html  = '<label class="col-sm-2 control-label">Tipo de Conta</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroTiposDeConta';
$sql .= ' WHERE Igreja = ' . $login->church_id . " AND TIPO = 'SAI'";
$sql .= ' ORDER BY Nome ASC';
$tipos = $db->LoadObjects($sql);

foreach($tipos as $tipo){
  $options[$tipo->ID] = $tipo->Nome;
}

$html .= '<div class="col-sm-3">' . form_field_list('tipoDeConta', $options, @$form->reg->TipoDeConta) .'</div>';
$box->AddContent($html);


//Contas
$html  = '<label class="col-sm-2 control-label">Conta</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroContas';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$tipos = $db->LoadObjects($sql);

foreach($tipos as $tipo){
  $options[$tipo->ID] = $tipo->Nome;
}

$html .= '<div class="col-sm-5">' . form_field_list('conta', $options, @$form->reg->Conta) .'</div>';
$box->AddContent($html);


//Contas Internas
$html  = '<label class="col-sm-2 control-label">Conta Interna</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroContasInternas';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$tipos = $db->LoadObjects($sql);

foreach($tipos as $tipo){
  $options[$tipo->ID] = $tipo->Nome;
}

$html .= '<div class="col-sm-3">' . form_field_list('contaInterna', $options, @$form->reg->ContaInterna) .'</div>';
$box->AddContent($html);

//Situacao
$html  = '<label class="col-sm-5 control-label">Situação</label>';
$options = array(
                        'NAO' => 'Não paga',
                        'PAG' => 'Paga'
);

$html .= '<div class="col-sm-2">' . form_field_list('situacao', $options, @$form->reg->Situacao, 'NAO') .'</div>';
$box->AddContent($html);




$form->AddBox($box);

/* DESTINATÁRIO */
$box = new girafaFORM_box('Destinatário', 'Caso essa saída tenha sido feita especificamente a alguém, informe abaixo');

//Membro
$html  = '<label class="col-sm-2 control-label">Membro</label>';
$options = array();

$sql  = 'SELECT * FROM Membros';
$sql .= ' WHERE Igreja = ' . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$membros = $db->LoadObjects($sql);

foreach($membros as $membro){
  $options[$membro->ID] = $membro->Nome;
}

$html .= '<div class="col-sm-5">' . form_field_list('membro', $options, @$form->reg->Membro, null, false) .'</div>';
$box->AddContent($html);


$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>