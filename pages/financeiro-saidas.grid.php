<?
template_getHeader();

$grid = new girafaGRID('FinanceiroMovimentacoes', 'Financeiro - Saídas');
$grid->sqlWheres = "Tipo = 'SAI'";

$grid->AddFilter('Contas Pagas', "Situacao = 'PAG'");
$grid->AddFilter('Contas Pendentes', "Situacao = 'NAO'");

$field_descricao = new girafaGRID_field('Descricao');

$field_data = new girafaGRID_field('Data');
$field_data->isDate();
$field_data->orderDesc();

$field_valor = new girafaGRID_field('Valor');
$field_valor->width = 150;
$field_valor->isMoney();

$field_pago = new girafaGRID_field('PAGO', 'Pago');
$field_pago->alignCenter();
$field_pago->width = 50;
$field_pago->isCustom();

$grid->addFields(array($field_descricao, $field_data, $field_valor, $field_pago));

$grid->PrintHTML();

template_getFooter();


function macro_grid_before($field, $reg){

  if($field = 'PAGO'){

    if($reg->Situacao == 'PAG')
      return '<i class="fa fa-check text-navy"></i>';
    else
      return ' ';
  }

}
//
?>