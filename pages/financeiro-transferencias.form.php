<?

template_getHeader();


$form = new girafaFORM('Financeiro - Transferências', 'financeiro-transferencias_action.php', 'FinanceiroTransferencias', 'Valor');

/* DADOS  */
$box = new girafaFORM_box('Informações');


//Nome
$html  = '<label class="col-sm-2 control-label">Data</label>';
$html .= '<div class="col-sm-3">' . form_field_date('Data', @$form->reg->Data, 100) .'</div>';
$box->AddContent($html);

//$box->AddContentBreakLine();
$box->AddContentLine();
$box->AddContent('<h4>Contas de Origem</h4>');

//Origem - Conta
$html  = '<label class="col-sm-2 control-label">Conta</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroContas';
$sql .= " WHERE Igreja = " . $login->church_id;
$sql .= " ORDER BY Nome ASC";
$contas = $db->LoadObjects($sql);

foreach($contas as $conta){
    $options[$conta->ID] = $conta->Nome;
}

$html .= '<div class="col-sm-3">' . form_field_list('DeConta', $options, @$form->reg->DeConta, null, false) .'</div>';
$box->AddContent($html);


//Origem - Conta Interna
$html  = '<label class="col-sm-2 control-label">Conta Interna</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroContasInternas';
$sql .= " WHERE Igreja = " . $login->church_id;
$sql .= " ORDER BY Nome ASC";
$contasInternas = $db->LoadObjects($sql);

foreach($contasInternas as $conta){
    $options[$conta->ID] = $conta->Nome;
}

$html .= '<div class="col-sm-3">' . form_field_list('DeContaInterna', $options, @$form->reg->DeContaInterna, null, false) .'</div>';
$box->AddContent($html);


//$box->AddContentBreakLine();
$box->AddContentLine();
$box->AddContent('<h4>Contas de Destino</h4>');

//Origem - Conta
$html  = '<label class="col-sm-2 control-label">Conta</label>';
$options = array();

foreach($contas as $conta){
    $options[$conta->ID] = $conta->Nome;
}

$html .= '<div class="col-sm-3">' . form_field_list('ParaConta', $options, @$form->reg->ParaConta, null, false) .'</div>';
$box->AddContent($html);


//Origem - Conta Interna
$html  = '<label class="col-sm-2 control-label">Conta Interna</label>';
$options = array();


foreach($contasInternas as $conta){
    $options[$conta->ID] = $conta->Nome;
}

$html .= '<div class="col-sm-3">' . form_field_list('ParaContaInterna', $options, @$form->reg->ParaContaInterna, null, false) .'</div>';
$box->AddContent($html);

$box->AddContentLine();

//Valor

$html  = '<label class="col-sm-2 control-label">Valor</label>';
$html .= '<div class="col-sm-3">' . form_field_number('Valor',@$form->reg->Valor) .'</div>';
$box->AddContent($html);

$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>