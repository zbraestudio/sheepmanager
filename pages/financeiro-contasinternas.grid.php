<?
template_getHeader();

$grid = new girafaGRID('FinanceiroContasInternas', 'Financeiro - Contas Internas');

$field_nome = new girafaGRID_field('Nome');
$field_nome->orderAsc();

$field_saldo = new girafaGRID_field('SALDO', 'Saldo');
$field_saldo->isCustom();
$field_saldo->width = 150;
$field_saldo->alignRight();

$grid->addFields(array($field_nome, $field_saldo));

$grid->PrintHTML();


function macro_grid_before($field, $reg){

  if($field == 'SALDO'){

    $valor = financeiroContaInternaSaldo($reg->ID);

    if($valor > 0)
      $color = 'success';
    elseif($valor == 0)
      $color = 'info';
    else
      $color = 'danger';

    return '<span class="label label-' . $color . '">R$ ' . number_format($valor, 2, ',', '.') . '</span>';
  }

}

template_getFooter();
?>