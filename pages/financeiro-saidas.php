<?
set_config('TITLE', 'Financeiro - Saídas');
$tabela = 'FinanceiroMovimentacoes';

$login->verify();



if(GetParam(0) == 'add' || GetParam(0) == 'edit'){ // INSERIR E EDITAR

  include(get_config('SITE_PATH'). 'pages/' . GetPage() . '.form.php');

} elseif(GetParam(0) == 'del') { /*DELETAR */

  $sql = 'DELETE FROM ' . $tabela . ' WHERE Igreja = ' . $login->church_id . ' AND ID = ' . intval(base64_decode(GetParam(1)));
  if($db->Execute($sql)){
    $_SESSION['grid_msg'] = 'O registro foi excluído com sucesso     :)';
  } else {
    $_SESSION['grid_msg_error'] = 'Ops! Aconteceu um problema e não foi possível excluir esse registro.';
  }
  header('LOCATION:' . GetLink(GetPage()));

} else { /* LISTAR */

  include(get_config('SITE_PATH'). 'pages/' . GetPage() . '.grid.php');

}

?>
