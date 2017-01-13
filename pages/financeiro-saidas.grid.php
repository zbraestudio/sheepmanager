<?
template_getHeader();

$grid = new girafaGRID('FinanceiroCompromissos', 'Financeiro - Saídas');
$grid->sqlWheres = "Tipo = 'SAI'";

$grid->AddFilter('Contas Pagas', "Situacao = 'PAG'");
$grid->AddFilter('Contas Pendentes', "Situacao = 'NAO'");


$field_tipo = new girafaGRID_field('TipoDeConta', 'Tipo de Conta');

$sql  = 'SELECT * FROM FinanceiroTiposDeConta';
$sql .= ' WHERE Igreja = ' . $login->church_id . " AND TIPO = 'SAI'";
$sql .= ' ORDER BY Nome ASC';
$tipos = $db->LoadObjects($sql);

foreach($tipos as $tipo){
  $options[$tipo->ID] = $tipo->Nome;
}
$field_tipo->isList($options);


//  $field_descricao = new girafaGRID_field('Descricao');

$field_data = new girafaGRID_field('Data');
$field_data->isDate();
$field_data->orderDesc();

$field_valorP = new girafaGRID_field('ValorPrevisto', 'Vl. Previsto');
$field_valorP->width = 150;
$field_valorP->isMoney();

$field_valorL = new girafaGRID_field('ValorLancado', 'Vl. Lançado');
$field_valorL->width = 150;
$field_valorL->isMoney();

$field_pago = new girafaGRID_field('PAGO', 'Pago');
$field_pago->alignCenter();
$field_pago->width = 50;
$field_pago->isCustom();

$grid->addFields(array($field_tipo, $field_data, $field_valorP, $field_valorL, $field_pago));

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