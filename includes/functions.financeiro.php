<?
function financeiroContaSaldo($idConta = 0){

  global $login, $db;

  $sql  = 'SELECT SUM(SUBTOTAL) TOTAL FROM (';
  $sql .= "  SELECT SUM(IF(C.Tipo = 'ENT', L.Valor, L.Valor * -1)) SUBTOTAL";
  $sql .= '  FROM FinanceiroLancamentos L';
  $sql .= '  JOIN FinanceiroCompromissos C ON(C.ID = L.Compromisso)';
  $sql .= "  WHERE L.Igreja = " . $login->church_id . " AND C.Igreja = " . $login->church_id;

  if($idConta > 0)
    $sql .= " AND L.Conta = " . $idConta;

  $sql .= ' UNION ALL';

  $sql .= '  SELECT SUM(Valor * -1) SUBTOTAL';
  $sql .= '  FROM FinanceiroTransferencias';
  $sql .= "  WHERE Igreja = " . $login->church_id;

  if($idConta > 0)
    $sql .= " AND DeConta = " . $idConta;

  $sql .= ' UNION ALL';

  $sql .= '  SELECT SUM(Valor) SUBTOTAL';
  $sql .= '  FROM FinanceiroTransferencias';
  $sql .= "  WHERE Igreja = " . $login->church_id;

  if($idConta > 0)
    $sql .= " AND ParaConta = " . $idConta;

  $sql .= ') `x`';

  $res = $db->LoadObjects($sql);

  return floatval($res[0]->TOTAL);
}

function financeiroContaInternaSaldo($idContaInterna){

  global $login, $db;

  $sql  = 'SELECT SUM(SUBTOTAL) TOTAL FROM (';
  $sql .= "  SELECT SUM(IF(C.Tipo = 'ENT', L.Valor, L.Valor * -1)) SUBTOTAL";
  $sql .= '  FROM FinanceiroLancamentos L';
  $sql .= '  JOIN FinanceiroCompromissos C ON(C.ID = L.Compromisso)';
  $sql .= "  WHERE L.Igreja = " . $login->church_id . " AND C.Igreja = " . $login->church_id . " AND L.ContaInterna = " . $idContaInterna;

  $sql .= ' UNION ALL';

  $sql .= '  SELECT SUM(Valor * -1) SUBTOTAL';
  $sql .= '  FROM FinanceiroTransferencias';
  $sql .= "  WHERE Igreja = " . $login->church_id . " AND DeContaInterna = " . $idContaInterna;

  $sql .= ' UNION ALL';

  $sql .= '  SELECT SUM(Valor) SUBTOTAL';
  $sql .= '  FROM FinanceiroTransferencias';
  $sql .= "  WHERE Igreja = " . $login->church_id . " AND ParaContaInterna = " . $idContaInterna;

  $sql .= ') `x`';

  //die($sql);
  $res = $db->LoadObjects($sql);

  return floatval($res[0]->TOTAL);
}

function financeiroLancamentosTotal($idCompromisso){

  global $login, $db;

  if(!empty($idCompromisso)) {
    $sql = 'SELECT SUM(Valor) TOTAL FROM FinanceiroLancamentos';
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


function financeiroTotalEntradaUltimos3meses(){

  global $login, $db;

  $sql = "SELECT SUM(L.Valor) TOTAL";
  $sql .= ' FROM FinanceiroLancamentos L';
  $sql .= ' JOIN FinanceiroCompromissos C ON(C.ID = L.Compromisso)';
  $sql .= " WHERE L.Igreja = " . $login->church_id . " AND (C.Tipo = 'ENT') AND C.Igreja = " . $login->church_id;
  $sql .= " AND L.Data > '" . date("Y-m-d", strtotime("-3 month")) . "'";

  $res = $db->LoadObjects($sql);

  return floatval($res[0]->TOTAL);
}
function financeiroTotalSaidasUltimos3meses(){

  global $login, $db;

  $sql = "SELECT SUM(L.Valor) TOTAL";
  $sql .= ' FROM FinanceiroLancamentos L';
  $sql .= ' JOIN FinanceiroCompromissos C ON(C.ID = L.Compromisso)';
  $sql .= " WHERE L.Igreja = " . $login->church_id . " AND (C.Tipo = 'SAI') AND C.Igreja = " . $login->church_id;
  $sql .= " AND L.Data > '" . date("Y-m-d", strtotime("-3 month")) . "'";

  $res = $db->LoadObjects($sql);

  return floatval($res[0]->TOTAL);
}
?>