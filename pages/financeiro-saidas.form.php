<?

template_getHeader();


$form = new girafaFORM('Financeiro - Saídas', 'financeiro-saidas_action.php', 'FinanceiroCompromissos', 'Descricao');

/* DADOS  */
$box = new girafaFORM_box('Compromisso');


$lancadoTotal = financeiroLancamentosTotal(@$form->reg->ID);
$saldo = floatval(floatval(@$form->reg->ValorPrevisto) - $lancadoTotal);

//Data
$html  = '<label class="col-sm-2 control-label">Data</label>';
$html .= '<div class="col-sm-3">' . form_field_date('data', @$form->reg->Data, 'TODAY') .'</div>';
$box->AddContent($html);

//Situacao
if(isset($form->reg->ID)) {
  $html  = '<label class="col-sm-3 control-label col-sm-offset-2 ">Situação</label>';

  if($lancadoTotal >= $form->reg->ValorPrevisto)
    $html .= '<div class="col-sm-2"><small class="label label-success"><i class="fa fa-check"></i> Compromisso Pago</small></div>';
  else
    $html .= '<div class="col-sm-2"><small class="label label-info"><i class="fa fa-clock-o"></i> Compromisso Pendente</small></div>';

  $box->AddContent($html);
}

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


//Valor Previsto
$html  = '<label class="col-sm-2 col-sm-offset-2  control-label">Valor Previsto</label>';
$html .= '<div class="col-sm-3">' . form_field_number('valorPrevisto', @$form->reg->ValorPrevisto, '0.00') .'</div>';
$box->AddContent($html);

if(!empty($form->reg->ID)) {
  $box->AddContentBreakLine();

//Valor Lançado
  $html = '<label class="col-sm-2 col-sm-offset-7 control-label">Valor Lançado</label>';
  $html .= '<div class="col-sm-3"><input class="form-control" style="text-align: right" readonly value="R$ ' . number_format($lancadoTotal, 2, ',', '.') . '"></div>';
  $box->AddContent($html);

  $box->AddContentBreakLine();

//Saldo
  $html = '<label class="col-sm-2 col-sm-offset-7 control-label">Saldo</label>';
  $html .= '<div class="col-sm-3"><input class="form-control" style="text-align: right" readonly value="R$ ' . number_format(($saldo * -1), 2, ',', '.') . '"></div>';
  $box->AddContent($html);

}

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


if(!empty($form->reg->ID)) {
  $box = new girafaFORM_box('Lançamentos');

  $html = '<table class="table table-striped">';
  $html .= '                            <thead>';
  $html .= '                            <tr>';
  $html .= '                                <th>#</th>';
  $html .= '                                <th>Data</th>';
  $html .= '                                <th>Conta</th>';
  $html .= '                                <th>Conta Interna</th>';
  $html .= '                                <th style="text-align: center;">Referente a</th>';
  $html .= '                                <th  style="text-align: right;">Valor</th>';
  $html .= '                                <th  style="text-align: center;">Ações</th>';
  $html .= '                            </tr>';
  $html .= '                            </thead>';
  $html .= '                            <tbody>';

  $sql  = 'SELECT * FROM FinanceiroLancamentos';
  $sql .= " WHERE Igreja = " . $login->church_id . " AND Compromisso = " . $form->reg->ID;
  $sql .= ' ORDER BY Data ASC';
  $lancamentos = $db->LoadObjects($sql);

  if(count($lancamentos) > 0) {
    foreach ($lancamentos as $x => $lancamento) {

      $data = new girafaDate($lancamento->Data);
      $conta = LoadRecord('FinanceiroContas', $lancamento->Conta);
      $contaInterna = LoadRecord('FinanceiroContasInternas', $lancamento->ContaInterna);

      $valor = floatval($lancamento->Valor);
      $valor_previsao = floatval($form->reg->ValorPrevisto);

      if ($valor_previsao > 0)
        $perc = floatval(($valor * 100) / $valor_previsao);
      else
        $perc = 0.00;

      $html .= '                            <tr>';
      $html .= '                                <td>' . ($x + 1) . '</td>';
      $html .= '                                <td>' . $data->GetDate('d/m/Y') . ' (' . $data->GetDayOfWeekShorten() . ') </td>';
      $html .= '                                <td>' . $conta->Nome . '</td>';
      $html .= '                                <td>' . $contaInterna->Nome . '</td>';
      $html .= '                                <td class="text-navy"  style="text-align: center;"> ' . number_format($perc, 1, ',', '.') . '% </td>';
      $html .= '                                <td  style="text-align: right;"> R$ ' . number_format($valor, 2, ',', '.') . '</td>';

      $html .= '                                <td  style="text-align: center;">';
      $html .= '                                  <a href="' . GetLink(GetPage() . '/edit/' . GetParam(1) . '/lancamento/edit/' . base64_encode($lancamento->ID)) . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
      $html .= '                                  <a href="' . GetLink(GetPage() . '/edit/' . GetParam(1) . '/lancamento/del/' . base64_encode($lancamento->ID)) . '" data-toggle="confirmation" data-popout="true" data-singleton="true" data-title="Tem certeza que deseja excluir esse registro?"><i class="fa fa fa-trash" aria-hidden="true"></i></a>';
      $html .= '                                </td>';

      $html .= '                            </tr>';

    }
  } else {
    $html .= '<td colspan="7" style="text-align: center; padding: 15px;">Ainda não foi registrado nenhum Lançamento!</td>';
  }

  $html .= '                            </tbody>';
  $html .= '                        </table>';
  $box->AddContent($html);

  $box->AddContent('<a href="' . GetLink(GetPage() . '/edit/' . GetParam(1)) . '/lancamento/add" class="btn btn-info btn-xs" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> lançamento</a>');

  $form->AddBox($box);
}
$form->PrintHTML();

template_getFooter();
?>