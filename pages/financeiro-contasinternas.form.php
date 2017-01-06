<?

template_getHeader();


$form = new girafaFORM('Financeiro - Contas Internas', 'financeiro-contasinternas_action.php', 'FinanceiroContasInternas', 'Nome');

/* DADOS  */
$box = new girafaFORM_box('Informações da Conta');


//Nome
$html  = '<label class="col-sm-2 control-label">Nome</label>';
$html .= '<div class="col-sm-8">' . form_field_string('nome', @$form->reg->Nome, 100) .'</div>';
$box->AddContent($html);

$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>