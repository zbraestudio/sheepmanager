<?

template_getHeader();


$form = new girafaFORM('Financeiro - Contas', 'financeiro-contas_action.php', 'FinanceiroContas', 'Nome');

/* DADOS  */
$box = new girafaFORM_box('Informações da Conta');


//Nome Completo
$html  = '<label class="col-sm-2 control-label">Nome</label>';
$html .= '<div class="col-sm-8">' . form_field_string('nome', @$form->reg->Nome, 100) .'</div>';
$box->AddContent($html);


$box->AddContentLine();
$box->AddContent('<h5>Banco</h5>');

//Banco - Nome
$html  = '<label class="col-sm-2 control-label">Nome</label>';
$html .= '<div class="col-sm-8">' . form_field_string('bancoNome', @$form->reg->BancoNome, 100, null, false) .'</div>';
$box->AddContent($html);

$box->AddContentBreakLine();

//Banco - Agência
$html  = '<label class="col-sm-2 control-label">Agência</label>';
$html .= '<div class="col-sm-3">' . form_field_string('bancoAgencia', @$form->reg->BancoAgencia, 50, null, false) .'</div>';
$box->AddContent($html);

//Banco - Conta
$html  = '<label class="col-sm-2 control-label">Conta</label>';
$html .= '<div class="col-sm-3">' . form_field_string('bancoConta', @$form->reg->BancoConta, 50, null, false) .'</div>';
$box->AddContent($html);


$box->AddContentLine();
$box->AddContent('<h5>Contato</h5>');

//Contato - Nome
$html  = '<label class="col-sm-2 control-label">Nome</label>';
$html .= '<div class="col-sm-8">' . form_field_string('bancoContatoNome', @$form->reg->BancoContatoNome , 100, null, false) .'</div>';
$box->AddContent($html);

$box->AddContentBreakLine();

//Contato - Nome
$html  = '<label class="col-sm-2 control-label">E-mail</label>';
$html .= '<div class="col-sm-6">' . form_field_string('bancoContatoEmail', @$form->reg->BancoContatoEmail , 150, null, false) .'</div>';
$box->AddContent($html);

$box->AddContentBreakLine();

//Contato - Nome
$html  = '<label class="col-sm-2 control-label">Telefone</label>';
$html .= '<div class="col-sm-4">' . form_field_string('bancoContatoTelefone', @$form->reg->BancoContatoTelefone , 50, null, false) .'</div>';
$box->AddContent($html);

$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>