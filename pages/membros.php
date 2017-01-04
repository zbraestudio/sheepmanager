<?

set_config('TITLE', 'Membros');



if(GetParam(0) == 'add'){
    /* INSERIR E EDITAR */

    template_getHeader();

?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Membros</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= GetLink('membros'); ?>">Membros</a>
                </li>

                <li class="active">
                    <strong>Adicionando Novo</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
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
                    <form method="post" class="form-horizontal" action="#">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nome Completo</label>

                            <div class="col-sm-7"><input type="text" class="form-control" name="Nome" required></div>

                            <label class="col-sm-1 control-label">Situação</label>
                            <div class="col-sm-2">
                                <select class="form-control m-b" name="account" required>
                                    <option>Desligado</option>
                                    <option>Faltoso</option>
                                    <option selected>Membro</option>
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">Apelido</label>

                            <div class="col-sm-6"><input type="text" class="form-control" name="Nome" required></div>

                            <label class="col-sm-2 control-label">Situação Civil</label>
                            <div class="col-sm-2">
                                <select class="form-control m-b" name="account" required>
                                    <option></option>
                                    <option>Casado(a)</option>
                                    <option>Solteiro(a)</option>
                                    <option>Divorciado(a)</option>
                                    <option>Viúvo(a)</option>
                                </select>
                            </div>

                        </div>

                        <div class="hr-line-dashed"></div>

                        <h3 class="m-t-none m-b">Documentos</h3>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">RG</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="Nome" required></div>
                            <label class="col-sm-2 control-label">CPF</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="Nome" required></div>

                        </div>

                        <div class="hr-line-dashed"></div>

                        <h3 class="m-t-none m-b">Endereço</h3>
                        <p>[campos do endereço]</p>

                        <div class="hr-line-dashed"></div>

                        <h3 class="m-t-none m-b">Datas</h3>
                        <p>[campos do datas]</p>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group">

                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="<?= GetLink(GetPage()); ?>" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
    </div>
    <?

    template_getFooter();
} else {
    /* LISTAR */

    template_getHeader();

    $grid = new girafaGRID('Membros');
    $grid->legends = array('Nome Completo', 'Apelido', 'E-mail');

    $grid->values[] = array('Tiago Gonçalves', 'Tihh Gonçalves', '<a href="mailto:">tihhgoncalves@gmail.com</a>');
    $grid->values[] = array('Aline Ribeiro Nunes Gonçalves', 'Aline', '<a href="mailto:">alirnunes@gmail.com</a>');

    $grid->PrintHTML();

    template_getFooter();

}

?>
