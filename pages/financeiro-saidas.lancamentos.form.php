<?

template_getHeader();


$form = new girafaFORM('Financeiro - Lançamento', 'financeiro-lancamento_action.php', 'FinanceiroLancamentos', 'Data');

$form->linkVoltar = GetLink(GetPage() . '/edit/' . GetParam(1));

/* DADOS  */
$box = new girafaFORM_box('Geral');

$box->AddContent('<input type="hidden" name="Compromisso" value="' . base64_decode(GetParam(1)) . '">');
$box->AddContent('<input type="hidden" name="Tipo" value="SAI">');

//Data
$html  = '<label class="col-sm-2 control-label">Data</label>';
$html .= '<div class="col-sm-3">' . form_field_date('Data', @$form->reg->Data, 'TODAY') .'</div>';
$box->AddContent($html);

//Valor
$html  = '<label class="col-sm-2 col-sm-offset-2 control-label">Valor</label>';
$html .= '<div class="col-sm-3">' . form_field_number('Valor', @$form->reg->Valor) .'</div>';
$box->AddContent($html);

$box->AddContentBreakLine();

//Conta
$html  = '<label class="col-sm-2 control-label">Conta</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroContas';
$sql .= " WHERE Igreja = " . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$contas = $db->LoadObjects($sql);
foreach($contas as $conta)
  $options[$conta->ID] = $conta->Nome . ' (saldo: R$' . number_format(financeiroContaSaldo($conta->ID), 2, ',', '.') . ')';

$html .= '<div class="col-sm-5">' . form_field_list('Conta', $options, @$form->reg->Conta) .'</div>';
$box->AddContent($html);

$box->AddContentBreakLine();


//Conta Interna
$html  = '<label class="col-sm-2 control-label">Conta Interna</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroContasInternas';
$sql .= " WHERE Igreja = " . $login->church_id;
$sql .= ' ORDER BY Nome ASC';
$contas = $db->LoadObjects($sql);
foreach($contas as $conta){
  $options[$conta->ID] = $conta->Nome . ' (saldo: R$' . number_format(financeiroContaInternaSaldo($conta->ID), 2, ',', '.') . ')';
}


$html .= '<div class="col-sm-3">' . form_field_list('ContaInterna', $options, @$form->reg->ContaInterna) .'</div>';
$box->AddContent($html);

$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>