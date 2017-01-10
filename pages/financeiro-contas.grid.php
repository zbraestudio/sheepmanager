<?
template_getHeader();

$grid = new girafaGRID('FinanceiroContas', 'Financeiro - Contas');
$grid->legends = array('Nome', 'Banco', 'Agência', 'Conta');



$field_nome = new girafaGRID_field('Nome');
$field_nome->orderAsc();

$field_banco = new girafaGRID_field('BancoNome', 'Banco');
$field_banco->width = 250;
$field_agencia = new girafaGRID_field('BancoAgencia', 'Agência');
$field_agencia->width = 150;
$field_conta = new girafaGRID_field('BancoConta', 'Conta');
$field_conta->width = 200;


$field_saldo = new girafaGRID_field('SALDO', 'Saldo');
$field_saldo->isCustom();
$field_saldo->width = 150;
$field_saldo->alignRight();

$grid->addFields(array($field_nome, $field_banco, $field_agencia, $field_conta, $field_saldo));

$grid->PrintHTML();

template_getFooter();


function macro_grid_before($field, $reg){

  if($field == 'SALDO'){

    $valor = financeiroContaSaldo($reg->ID);

    if($valor > 0)
      $color = 'success';
    elseif($valor == 0)
      $color = 'info';
    else
      $color = 'danger';

    return '<span class="label label-' . $color . '">R$ ' . number_format($valor, 2, ',', '.') . '</span>';
  }

}

?>