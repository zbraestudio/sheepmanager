<?

template_getHeader();


$form = new girafaFORM('Membros', 'membros_action.php');

/* DADOS PESSOAIS */
$box = new girafaFORM_box('Dados Pessoais', 'Informe abaixo as informações que correspondem ao membro.');

//Nome Completo
$html  = '<label class="col-sm-2 control-label">Nome Completo</label>';
$html .= '<div class="col-sm-7">' . form_field_string('nome', @$form->reg->Nome, 200) .'</div>';
$box->AddContent($html);

//Situação
$html  = '<label class="col-sm-1 control-label">Situação</label>';
$html .= '<div class="col-sm-2">';
$options = array(
                        'MEM' => 'Membro',
                        'FAL' => 'Faltoso',
                        'DES' => 'Desligado'
);
$html .= form_field_list('situacao', $options, @$form->reg->Situacao, 'MEM');
$html .= '</div>';
$box->AddContent($html);

//Apelido
$html  = '<label class="col-sm-2 control-label">Apelido</label>';
$html .= '<div class="col-sm-6">' . form_field_string('apelido', @$form->reg->Apelido, 75) .'</div>';
$box->AddContent($html);

//Situação Civil
$html  = '<label class="col-sm-2 control-label">Situação Civil</label>';
$html .= '<div class="col-sm-2">';
$options = array(
                        'CAS' => 'Casado(a)',
                        'SOL' => 'Solteiro(a)',
                        'DIV' => 'Divorciado(a)',
                        'VIU' => 'Viúvo(a)'
);
$html .= form_field_list('situacaoCivil', $options, @$form->reg->SituacaoCivil, null, false);
$html .= '</div>';
$box->AddContent($html);

//E-mail
$html  = '<label class="col-sm-2 control-label">E-mail</label>';
$html .= '<div class="col-sm-5">' . form_field_string('email', @$form->reg->Email, 150) .'</div>';
$box->AddContent($html);

$form->AddBox($box);



/* ENDEREÇO */
$box = new girafaFORM_box('Endereço');

//Logradouro
$html  = '<label class="col-sm-2 control-label">Logradouro</label>';
$html .= '<div class="col-sm-10">' . form_field_string('enderecoLogradouro', @$form->reg->EnderecoLogradouro, 250, null, false) .'</div>';
$box->AddContent($html);

//Complemento
$html  = '<label class="col-sm-2 control-label">Complemento</label>';
$html .= '<div class="col-sm-6">' . form_field_string('enderecoComplemento', @$form->reg->EnderecoComplemento, 250, null, false) .'</div>';
$box->AddContent($html);

//Bairro
$html  = '<label class="col-sm-1 control-label">Bairro</label>';
$html .= '<div class="col-sm-3">' . form_field_string('enderecoBairro', @$form->reg->EnderecoBairro, 75, null, false) .'</div>';
$box->AddContent($html);

//Cidade
$html  = '<label class="col-sm-2 control-label">Cidade</label>';
$html .= '<div class="col-sm-6">' . form_field_string('enderecoCidade', @$form->reg->EnderecoCidade, 250, null, false) .'</div>';
$box->AddContent($html);

//UF
$html  = '<label class="col-sm-1 control-label">UF</label>';
$html .= '<div class="col-sm-3">';
$options = array(
                        'AC' => 'Acre',
                        'AL' => 'Alagoas',
                        'AP' => 'Amapá',
                        'AM' => 'Amazonas',
                        'BA' => 'Bahia',
                        'CE' => 'Ceará',
                        'DF' => 'Distrito Federal',
                        'ES' => 'Espirito Santo',
                        'GO' => 'Goiás',
                        'MA' => 'Maranhão',
                        'MS' => 'Mato Grosso do Sul',
                        'MT' => 'Mato Grosso',
                        'MG' => 'Minas Gerais',
                        'PA' => 'Pará',
                        'PB' => 'Paraíba',
                        'PR' => 'Paraná',
                        'PE' => 'Pernambuco',
                        'PI' => 'Piauí',
                        'RJ' => 'Rio de Janeiro',
                        'RN' => 'Rio Grande do Norte',
                        'RS' => 'Rio Grande do Sul',
                        'RO' => 'Rondônia',
                        'RR' => 'Roraima',
                        'SC' => 'Santa Catarina',
                        'SP' => 'São Paulo',
                        'SE' => 'Sergipe',
                        'TO' => 'Tocantins',
);
$html .= form_field_list('enderecoUF', $options, @$form->reg->EnderecoUF, null, false);
$html .= '</div>';
$box->AddContent($html);

//CEP
$html  = '<label class="col-sm-2 control-label">CEP</label>';
$html .= '<div class="col-sm-2">' . form_field_string('enderecoCEP', @$form->reg->EnderecoCEP, 9, null, false, '00000-000') .'</div>';
$box->AddContent($html);

$form->AddBox($box);



/* DOCUMENTOS */
$box = new girafaFORM_box('Documentos', null, 6);

//RG
$html  = '<label class="col-sm-4 control-label">RG</label>';
$html .= '<div class="col-sm-8">' . form_field_string('documentoRG', @$form->reg->DocumentoRG, 30, null, false) .'</div>';
$box->AddContent($html);

//CPF
$html  = '<label class="col-sm-4 control-label">CPF</label>';
$html .= '<div class="col-sm-8">' . form_field_string('documentoCPF', @$form->reg->DocumentoCPF, 14, null, false, '000.000.000-00') .'</div>';
$box->AddContent($html);

$form->AddBox($box);


/* DATA IMPORTANTES */
$box = new girafaFORM_box('Datas Importantes', null, 6);

//Nascimento
$html  = '<label class="col-sm-4 control-label">Nascimento</label>';
$html .= '<div class="col-sm-8">' . form_field_date('dataNascimento', @$form->reg->DataNascimento, null, false) .'</div>';
$box->AddContent($html);

//Batismo
$html  = '<label class="col-sm-4 control-label">Batismo</label>';
$html .= '<div class="col-sm-8">' . form_field_date('dataBatismo', @$form->reg->DataBatismo, null, false) .'</div>';
$box->AddContent($html);

//Casamento
$html  = '<label class="col-sm-4 control-label">Casamento</label>';
$html .= '<div class="col-sm-8">' . form_field_date('dataCasamento', @$form->reg->DataCasamento, null, false) .'</div>';
$box->AddContent($html);

$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>