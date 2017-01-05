<?
set_config('TITLE', 'Membros');
$tabela = 'Membros';

$login->verify();



if(GetParam(0) == 'add' || GetParam(0) == 'edit'){ // INSERIR E EDITAR

  include(get_config('SITE_PATH'). 'pages/' . GetPage() . '.form.php');

} elseif(GetParam(0) == 'del') { /*DELETAR */

    $sql = 'DELETE FROM ' . $tabela . ' WHERE Igreja = ' . $login->church_id . ' AND ID = ' . intval(base64_decode(GetParam(1)));
    $db->Execute($sql);

    $_SESSION['grid_msg'] = 'O registro foi excluído com sucesso     :)';
    header('LOCATION:' . GetLink(GetPage()));

} else { /* LISTAR */

  include(get_config('SITE_PATH'). 'pages/' . GetPage() . '.grid.php');

}

?>
