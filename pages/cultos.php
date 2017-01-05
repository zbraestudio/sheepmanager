<?

$login->verify();

set_config('TITLE', 'Cultos');



if(GetParam(0) == 'add' || GetParam(0) == 'edit'){
    /* INSERIR E EDITAR */

    template_getHeader();

    if (GetParam(0) == 'edit') {
        $sql = 'SELECT * FROM Cultos WHERE ID = ' . intval(GetParam(1)) . ' AND Igreja = ' . $login->church_id;
        $res = $db->LoadObjects($sql);

        if (count($res) <= 0) {
            die('<h4>Você não tem permissão pra visualizar esse registro!</h4>');
        }

        $reg = $res[0];
    }

    ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cultos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= GetLink('cultos'); ?>">Cultos</a>
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
                        <strong><?
                            $data = new girafaDate($reg->Data, ENUM_DATE_FORMAT::YYYY_MM_DD);
                            echo($data->GetFullDateForLong());
                            ?></strong>
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


            <form method="post" class="form-horizontal" action="<?= get_config('SITE_URL'); ?>/script/cultos_action.php">

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
                            <h5> Culto <small>Preencha abaixo as informações que correspondem ao Culto</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Data</label>

                                <div class="col-sm-3">
                                    <?= form_field_date('data', @$reg->Data, date('Y-m-d')); ?>
                                </div>


                            </div>



                            <!--</form>-->
                        </div>


                    </div>
                </div>


                <!-- Adultos  -->
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Adultos</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                <label class="col-sm-8 control-label">Membros</label>
                                <div class="col-sm-4">
                                    <?= form_field_integer('membrosAdultos', @$reg->MembrosAdultos); ?>
                                </div>

                                <label class="col-sm-8 control-label">Visitantes</label>
                                <div class="col-sm-4">
                                    <?= form_field_integer('visitantesAdultos', @$reg->VisitantesAdultos); ?>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>


                <!-- Crianças  -->
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Crianças</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                <label class="col-sm-8 control-label">Membros</label>
                                <div class="col-sm-4">
                                    <?= form_field_integer('membrosCriancas', @$reg->MembrosCriancas); ?>
                                </div>

                                <label class="col-sm-8 control-label">Visitantes</label>
                                <div class="col-sm-4">
                                    <?= form_field_integer('visitantesCriancas', @$reg->VisitantesCriancas); ?>
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

    $sql = 'DELETE FROM Cultos WHERE ID = ' . GetParam(1);
    $db->Execute($sql);

    $_SESSION['grid_msg'] = 'O registro foi excluído com sucesso     :)';
    header('LOCATION:' . GetLink('cultos'));

} else {
    /* LISTAR */

    template_getHeader();

    $grid = new girafaGRID('Cultos');
    $grid->legends = array('Data', 'Membros', 'Visitantes');


    $sql = 'SELECT * FROM Cultos';
    $sql .= ' WHERE Igreja = ' . $login->church_id;
    $sql .= ' ORDER BY Data DESC';
    $cultos = $db->LoadObjects($sql);

    foreach($cultos as $culto) {

        $data = new girafaDate($culto->Data, ENUM_DATE_FORMAT::YYYY_MM_DD);
        $field_data = new girafaGRID_field($data->GetDate('d/m/Y') . '  (' . $data->GetDayOfWeekLong() . ')');

        $field_membros = new girafaGRID_field(intval($culto->MembrosAdultos) + intval($culto->MembrosCriancas));
        $field_membros->alignRight();
        $field_membros->width = 100;

        $field_visitantes = new girafaGRID_field(intval($culto->VisitantesAdultos) + intval($culto->VisitantesCriancas));
        $field_visitantes->alignRight();
        $field_visitantes->width = 100;

        $grid->addValues(array($field_data, $field_membros, $field_visitantes), $culto->ID);
    }
    $grid->PrintHTML();

    template_getFooter();

}

?>
