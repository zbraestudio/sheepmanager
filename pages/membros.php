<?

$login->verify();

set_config('TITLE', 'Membros');



if(GetParam(0) == 'add' || GetParam(0) == 'edit'){
/* INSERIR E EDITAR */

template_getHeader();

if (GetParam(0) == 'edit') {
    $sql = 'SELECT * FROM Membros WHERE ID = ' . intval(GetParam(1));
    $res = $db->LoadObjects($sql);

    if (count($res) <= 0) {
        header('LOCATION:' . GetLink('membros'));
        exit;
    }

    $reg = $res[0];
}

?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Membros</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= GetLink('membros'); ?>">Membros</a>
            </li>


                <?
                if (GetParam(0) == 'add') {
                    ?>
                    <li class="active">
                        <strong>Adicionando Novo</strong>
                    </li>
                <?
                } else {
                ?>
                <li>Editando</li>
                    <li class="active">
                        <strong><?= $reg->Nome; ?></strong>
                    </li>
                <?
                }
                    ?>

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <?
    if(isset($_SESSION['form_msg'])) {
        ?>
        <div class="wrapper wrapper-content msg-form">
            <div class="alert alert-success" role="alert"><?= $_SESSION['form_msg']; ?></div>
        </div>
    <?
        unset($_SESSION['form_msg']);
    }
        ?>



    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">


            <form method="post" class="form-horizontal" action="<?= get_config('SITE_URL'); ?>/script/membros_action.php">

                <?
                if(isset($reg->ID)){
                    ?>
                <input name="id" value="<?= $reg->ID?>" type="hidden">
                <?
                }
                ?>

                <!-- Dados -->
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Dados do Membro <small>Preencha abaixo as informações que correspondem ao Membro</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">


                            <!--<form method="post" class="form-horizontal" action="#">-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome Completo</label>

                                <div class="col-sm-7">
                                    <?= form_field_string('nome', @$reg->Nome, 200); ?>
                                </div>

                                <label class="col-sm-1 control-label">Situação</label>
                                <div class="col-sm-2">
                                    <?
                                    $options = array(
                                        'MEM' => 'Membro',
                                        'FAL' => 'Faltoso',
                                        'DES' => 'Desligado'
                                    );
                                    echo form_field_list('situacao', $options, @$reg->Situacao, 'MEM');
                                    ?>
                                </div>

                                <label class="col-sm-2 control-label">Apelido</label>

                                <div class="col-sm-6">
                                    <?= form_field_string('apelido', @$reg->Apelido, 75); ?>
                                </div>

                                <label class="col-sm-2 control-label">Situação Civil</label>
                                <div class="col-sm-2">
                                    <?
                                    $options = array(
                                        'CAS' => 'Casado(a)',
                                        'SOL' => 'Solteiro(a)',
                                        'DIV' => 'Divorciado(a)',
                                        'VIU' => 'Viúvo(a)'
                                    );
                                    echo form_field_list('situacaoCivil', $options, @$reg->SituacaoCivil, null, false);
                                    ?>
                                </div>

                                <label class="col-sm-2 control-label">E-mail</label>

                                <div class="col-sm-5">
                                    <?= form_field_string('email', @$reg->Email, 150); ?>
                                </div>

                            </div>



                            <!--</form>-->
                        </div>


                    </div>
                </div>

                <!-- Endereço -->
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Endereço <small>Preencha com o Endereço completo do Membro</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Logradouro</label>

                                <div class="col-sm-10">
                                    <?= form_field_string('enderecoLogradouro', @$reg->EnderecoLogradouro, 250, null, false); ?>
                                </div>

                                <label class="col-sm-2 control-label">Complemento</label>
                                <div class="col-sm-6">
                                    <?= form_field_string('enderecoComplemento', @$reg->EnderecoComplemento, 250, null, false); ?>
                                </div>

                                <label class="col-sm-1   control-label">Bairro</label>
                                <div class="col-sm-3">
                                    <?= form_field_string('enderecoBairro', @$reg->EnderecoBairro, 75, null, false); ?>
                                </div>

                                <label class="col-sm-2 control-label">Cidade</label>

                                <div class="col-sm-6">
                                    <?= form_field_string('enderecoCidade', @$reg->EnderecoCidade, 250, null, false); ?>
                                </div>

                                <label class="col-sm-1 control-label">UF</label>
                                <div class="col-sm-3">

                                    <?
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
                                    echo form_field_list('enderecoUF', $options, @$reg->EnderecoUF, null, false);
                                    ?>

                                </div>

                                <label class="col-sm-2 control-label">CEP</label>

                                <div class="col-sm-2">
                                    <?= form_field_string('enderecoCEP', @$reg->EnderecoCEP, 9, null, false, '00000-000'); ?>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Documentos -->
                <div class="col-lg-6">

                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Documentos <small>Preencha abaixo a documentação do Membro</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">RG</label>
                                <div class="col-sm-8">
                                    <?= form_field_string('documentoRG', @$reg->DocumentoRG, 30, null, false); ?>
                                </div>
                                <label class="col-sm-4 control-label">CPF</label>
                                <div class="col-sm-8">
                                    <?= form_field_string('documentoCPF', @$reg->DocumentoCPF, 14, null, false, '000.000.000-00'); ?>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Datas -->
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Data <small>Preencha abaixo com as Datas Importantes do Membro</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nascimento</label>
                                <div class="col-sm-8">
                                    <?= form_field_date('dataNascimento', @$reg->DataNascimento, null, false); ?>
                                </div>

                                <label class="col-sm-4 control-label">Batismo</label>
                                <div class="col-sm-8">
                                    <?= form_field_date('dataBatismo', @$reg->DataBatismo, null, false); ?>
                                </div>

                                <label class="col-sm-4 control-label">Casamento</label>
                                <div class="col-sm-8">
                                    <?= form_field_date('dataCasamento', @$reg->DataCasamento, null, false); ?>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="clearboth"></div>
                <!-- ACTIONS -->
                <div class="col-lg-12">

                            <div class="form-group">

                                <div class="pull-right btn-actions">
                                    <a href="<?= GetLink(GetPage()); ?>" class="btn btn-white" type="submit">Cancelar</a>
                                    <button class="btn btn-primary" type="submit"><?= (GetParam(0) == 'add')?'Adicionar':'Atualizar';?></button>
                                </div>
                            </div>

                    </div>
                </div>


            </form>

    </div>
    <?

    template_getFooter();

} elseif(GetParam(0) == 'del') {

    $sql = 'DELETE FROM Membros WHERE ID = ' . GetParam(1);
    $db->Execute($sql);

    $_SESSION['grid_msg'] = 'O registro foi excluído com sucesso     :)';
    header('LOCATION:' . GetLink('membros'));

} else {
    /* LISTAR */

    template_getHeader();

    $grid = new girafaGRID('Membros');
    $grid->legends = array('Nome Completo', 'Apelido', 'E-mail');


    $sql = 'SELECT * FROM Membros ORDER BY Nome ASC';
    $pessoas = $db->LoadObjects($sql);

    foreach($pessoas as $pessoa) {

        $field_nome = new girafaGRID_field($pessoa->Nome);
        $field_apelido = new girafaGRID_field($pessoa->Apelido);
        $field_apelido->width = 250;
        $field_email = new girafaGRID_field('<a href="mailto:' . $pessoa->Email . '">' . $pessoa->Email . '</a>');
        $field_email->width = 250;

        $grid->addValues(array($field_nome, $field_apelido, $field_email), $pessoa->ID);
    }
    $grid->PrintHTML();

    template_getFooter();

}

?>
