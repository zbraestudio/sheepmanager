<?
set_config('TITLE', 'Financeiro - Saídas');
$tabela = 'FinanceiroCompromissos';

$login->verify();

if(GetParam(2) == 'lancamento') {

  if( (GetParam(3) == 'edit') || (GetParam(3) == 'add')) {

    include(get_config('SITE_PATH') . 'pages/financeiro-saidas.lancamentos.form.php');

  } elseif(GetParam(3) == 'del'){/* DELETAR LANÇAMENTO */

    $sql = 'DELETE FROM FinanceiroCompromissosLancamentos WHERE Igreja = ' . $login->church_id . ' AND ID = ' . intval(base64_decode(GetParam(4)));
    if($db->Execute($sql)){
      $_SESSION['form_msg'] = 'O lançamento foi excluído com sucesso     :)';
    } else {
      $_SESSION['form_msg_error'] = 'Ops! Aconteceu um problema e não foi possível excluir esse lançamento.';
    }

    financeiroFechaCompromisso(intval(base64_decode(GetParam(4))));
    header('LOCATION:' . GetLink(GetPage() . '/edit/' . GetParam(1)));

  }

} elseif(GetParam(0) == 'add' || GetParam(0) == 'edit'){ // INSERIR E EDITAR

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
