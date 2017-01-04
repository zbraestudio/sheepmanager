<?

set_config('TITLE', 'Membros');



if(GetParam(0) == 'add'){
    /* INSERIR E EDITAR */

    template_getHeader();
    echo('[inserir membro]');
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
