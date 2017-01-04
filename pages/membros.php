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
    echo('[listar membros]');
    template_getFooter();

}





?>