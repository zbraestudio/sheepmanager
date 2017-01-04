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


            <form method="post" class="form-horizontal" action="#">

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



                            <!--</form>-->
                        </div>


                    </div>
                </div>

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

                                <div class="col-sm-7"><input type="text" class="form-control" name="Nome" required></div>

                                <label class="col-sm-1 control-label">Complemento</label>
                                <div class="col-sm-2"><input type="text" class="form-control" name="Nome" required></div>

                                <label class="col-sm-2 control-label">Cidade</label>

                                <div class="col-sm-7"><input type="text" class="form-control" name="Nome" required></div>

                                <label class="col-sm-1 control-label">UF</label>
                                <div class="col-sm-2">
                                    <select class="form-control m-b" name="account" required>
                                        <option value="">Selecione</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espirito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>


                                <label class="col-sm-2 control-label">CEP</label>

                                <div class="col-sm-2"><input type="text" class="form-control" name="Nome" required></div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-lg-12">
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
                                <label class="col-sm-2 control-label">RG</label>
                                <div class="col-sm-4"><input type="text" class="form-control" name="Nome" required></div>
                                <label class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-4"><input type="text" class="form-control" name="Nome" required></div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-lg-12">
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
                                <label class="col-sm-2 control-label">Data Nasc.</label>
                                <div class="col-sm-2"><input type="text" class="form-control" name="Nome" required></div>

                                <label class="col-sm-2 control-label">Data Batismo</label>
                                <div class="col-sm-2"><input type="text" class="form-control" name="Nome" required></div>

                                <label class="col-sm-2 control-label">Data Casamento</label>
                                <div class="col-sm-2"><input type="text" class="form-control" name="Nome" required></div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-lg-12">



                            <div class="form-group">

                                <div class="pull-right btn-actions">
                                    <a href="<?= GetLink(GetPage()); ?>" class="btn btn-white" type="submit">Cancelar</a>
                                    <button class="btn btn-primary" type="submit">Salvar</button>
                                </div>
                            </div>

                    </div>
                </div>


            </form>
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
