<?
template_getHeader();

$grid = new girafaGRID('FinanceiroTransferencias', 'Financeiro - Transferências');

$grid->AddFilter('Entre Contas', 'DeConta IS NOT NULL');
$grid->AddFilter('Entre Contas Internas', 'DeContaInterna IS NOT NULL');

$field_data = new girafaGRID_field('Data');
$field_data->isDate();

$field_tipo = new girafaGRID_field('TIPO', 'Tipo de Transferência');
$field_tipo->isCustom();

$field_contas = new girafaGRID_field('CONTAS', 'Contas');
$field_contas->isCustom();

$field_valor = new girafaGRID_field('Valor', 'Valor');
$field_valor->isMoney();


$grid->addFields(array($field_data, $field_tipo, $field_contas, $field_valor));

$grid->PrintHTML();

template_getFooter();


function macro_grid_before($field, $reg){

  if($field == 'TIPO'){

    if(!empty($reg->DeConta))
      return 'Entre Contas';
    elseif(!empty($reg->DeContaInterna))
      return 'Entre Contas Internas';
  }


  if($field == 'CONTAS'){

    if(!empty($reg->DeConta)) {
      $contaA = $reg->DeConta;
      $contaAtable = LoadRecord('FinanceiroContas', $contaA);
      $contaAnome = $contaAtable->Nome;
      $contaB = $reg->ParaConta;
      $contaBtable = LoadRecord('FinanceiroContas', $contaB);
      $contaBnome = $contaBtable->Nome;

      return $contaAnome . ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' . $contaBnome;

    } elseif(!empty($reg->DeContaInterna)){
      $contaA = $reg->DeContaInterna;
      $contaAtable = LoadRecord('FinanceiroContasInternas', $contaA);
      $contaAnome = $contaAtable->Nome;
      $contaB = $reg->ParaContaInterna;
      $contaBtable = LoadRecord('FinanceiroContasInternas', $contaB);
      $contaBnome = $contaBtable->Nome;

      return $contaAnome . ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' . $contaBnome;
    }
  }

}
?>