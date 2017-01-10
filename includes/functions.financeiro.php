<?
function financeiroContaSaldo($idConta){

  global $login, $db;

  $sql = "SELECT SUM(IF(C.Tipo = 'ENT', L.Valor, L.Valor * -1)) TOTAL FROM FinanceiroCompromissosLancamentos L";
  $sql .= " JOIN FinanceiroCompromissos C ON(C.ID = L.Compromisso)";
  $sql .= "WHERE L.Igreja = " . $login->church_id . " AND C.Igreja = " . $login->church_id . " AND L.Conta = " . $idConta;

  $res = $db->LoadObjects($sql);

  return floatval($res[0]->TOTAL);
}

function financeiroContaInternaSaldo($idContaInterna){

  global $login, $db;

  $sql = "SELECT SUM(IF(C.Tipo = 'ENT', L.Valor, L.Valor * -1)) TOTAL FROM FinanceiroCompromissosLancamentos L";
  $sql .= " JOIN FinanceiroCompromissos C ON(C.ID = L.Compromisso)";
  $sql .= "WHERE L.Igreja = " . $login->church_id . " AND C.Igreja = " . $login->church_id . " AND L.ContaInterna = " . $idContaInterna;

  $res = $db->LoadObjects($sql);

  return floatval($res[0]->TOTAL);
}

function financeiroLancamentosTotal($idCompromisso){

  global $login, $db;

  if(!empty($idCompromisso)) {
    $sql = 'SELECT SUM(Valor) TOTAL FROM FinanceiroCompromissosLancamentos';
    $sql .= " WHERE Igreja = " . $login->church_id . " AND Compromisso = " . $idCompromisso;
    $res = $db->LoadObjects($sql);

    return floatval($res[0]->TOTAL);
  } else {
    return 0.00;
  }
}


function financeiroFechaCompromisso($idCompromisso){
  global $db;

  $compromisso = LoadRecord('FinanceiroCompromissos', $idCompromisso);
  $lancamentos = financeiroLancamentosTotal($idCompromisso);

  $post = new girafaTablePost();
  $post->table = 'FinanceiroCompromissos';
  $post->id = $idCompromisso;

  $post->AddFieldString('ValorLancado', decimalToDB($lancamentos));
  $post->AddFieldString('Situacao', ($lancamentos >= floatval($compromisso->ValorPrevisto))?'PAG':'NAO');

  $db->Execute($post->GetSql());

}
?>