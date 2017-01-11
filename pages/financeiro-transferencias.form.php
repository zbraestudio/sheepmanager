<?

template_getHeader();


$form = new girafaFORM('Financeiro - Transferências', 'financeiro-transferencias_action.php', 'FinanceiroTransferencias', 'Valor');

$tipo = false;
if(!empty(@$form->reg->DeConta)){
    $tipo = 'CON';
} elseif(!empty($form->reg->DeContaInterna)){
    $tipo = 'INT';
}

/* DADOS  */
$box = new girafaFORM_box('Informações');


//Nome
$html  = '<label class="col-sm-2 control-label">Data</label>';
$html .= '<div class="col-sm-3">' . form_field_date('Data', @$form->reg->Data, 100) .'</div>';
$box->AddContent($html);

$box->AddContentBreakLine();

//Nome
$html  = '<label class="col-sm-2 control-label">Tipo de Transferência</label>';
$options = array(
    'CON' => 'Contas',
    'INT' => 'Contas Internas'
);
$html .= '<div class="col-sm-3">' . form_field_list('TIPO', $options, '') .'</div>';
$box->AddContent($html);

$box->AddContentLine();

$box->AddContent('<div id="contas">');

//Origem - Conta
$html  = '<label class="col-sm-2 control-label">Da Conta</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroContas';
$sql .= " WHERE Igreja = " . $login->church_id;
$sql .= " ORDER BY Nome ASC";
$contas = $db->LoadObjects($sql);

foreach($contas as $conta){
    $options[$conta->ID] = $conta->Nome . ' (saldo: R$' . number_format(financeiroContaSaldo($conta->ID), 2, ',', '.') . ')';
}

$html .= '<div class="col-sm-3">' . form_field_list('DeConta', $options, @$form->reg->DeConta, null, false) .'</div>';
$box->AddContent($html);


//Destino - Conta
$html  = '<label class="col-sm-2 control-label">Para Conta</label>';
$options = array();

foreach($contas as $conta){
    $options[$conta->ID] = $conta->Nome . ' (saldo: R$' . number_format(financeiroContaSaldo($conta->ID), 2, ',', '.') . ')';
}

$html .= '<div class="col-sm-3">' . form_field_list('ParaConta', $options, @$form->reg->ParaConta, null, false) .'</div>';
$box->AddContent($html);


$box->AddContent('</div>');

$box->AddContent('<div id="contasinternas">');

//Origem - Conta Interna
$html  = '<label class="col-sm-2 control-label">Da Conta Interna</label>';
$options = array();

$sql  = 'SELECT * FROM FinanceiroContasInternas';
$sql .= " WHERE Igreja = " . $login->church_id;
$sql .= " ORDER BY Nome ASC";
$contasInternas = $db->LoadObjects($sql);

foreach($contasInternas as $conta){
    $options[$conta->ID] = $conta->Nome . ' (saldo: R$' . number_format(financeiroContaInternaSaldo($conta->ID), 2, ',', '.') . ')';
}

$html .= '<div class="col-sm-3">' . form_field_list('DeContaInterna', $options, @$form->reg->DeContaInterna, null, false) .'</div>';
$box->AddContent($html);


//Destino - Conta Interna
$html  = '<label class="col-sm-2 control-label">Para Conta Interna</label>';
$options = array();


foreach($contasInternas as $conta){
    $options[$conta->ID] = $conta->Nome . ' (saldo: R$' . number_format(financeiroContaInternaSaldo($conta->ID), 2, ',', '.') . ')';
}

$html .= '<div class="col-sm-3">' . form_field_list('ParaContaInterna', $options, @$form->reg->ParaContaInterna, null, false) .'</div>';
$box->AddContent($html);

$box->AddContent('</div>');

$box->AddContentLine();

//Valor

$html  = '<label class="col-sm-2 control-label">Valor</label>';
$html .= '<div class="col-sm-3">' . form_field_number('Valor',@$form->reg->Valor) .'</div>';
$box->AddContent($html);

$form->AddBox($box);

$form->PrintHTML();

template_getFooter();
?>
<script>

    function selecionaTipo(val){
        if(val == 'INT') {
            $('#contasinternas')
                                    .show()
                                    .find('select').attr('required', 'required')
                                    .parent().addClass('field_list_required');

            $('#contas select')
                                    .val('').trigger('chosen:updated')
                                    .removeAttr('required');
        } else if(val == 'CON') {
            $('#contas')
                                    .show()
                                    .find('select').attr('required', 'required')
                                    .parent().addClass('field_list_required');

            $('#contasinternas select')
                                    .val('').trigger('chosen:updated')
                                    .removeAttr('required');
        } else {
            $('#contasinternas, #contas').hide();
        }
    }

    $(document).ready(function(){

        $('#contasinternas, #contas').hide();

        $('select[name=TIPO]').change(function(){

            $('#contasinternas, #contas').hide();

            var val = $(this).val();
            selecionaTipo(val);


        });


        <?
        if($tipo != false){
        ?>
        $('select[name=TIPO]').val('<?= $tipo; ?>').trigger("chosen:updated");
        selecionaTipo('<?= $tipo; ?>');
        <?
        }
        ?>
    });

</script>