<?
class TablePost{
  private $fields = array();

  public $table;
  public $id = -1;

  public function GetSql(){

    //Inserчуo ou Atualizaчуo..
    if($this->id > 0){

      $sql   = 'UPDATE ' . $this->table . ' SET ';

      foreach ($this->fields as $x=>$field) {

        if($x > 0)
          $sql .= ', ';

        $sql .= '`' . $field[0] . '` = ' . $field[1];
      }

      $sql .= ' WHERE ID = ' . $this->id;

    } else {

      $sql  = 'INSERT INTO ' . $this->table;

      $fields = array();
      $values = array();
      foreach ($this->fields as $field) {
        $fields[]  = '`' . $field[0] . '`';
        $values[] = $field[1];
      }

      $sql .= '(' . implode(', ', $fields) . ')';
      $sql .= ' VALUES(' . implode(', ', $values) . ')';
    }

    return $sql;
  }

  public function AddFieldString($fieldName, $value){

    if($value == null)
      $field = array($fieldName, "NULL");
    else
      $field = array($fieldName, "'" . $value . "'");

    $this->fields[] = $field;
  }

  public function AddFieldInteger($fieldName, $value){
    $field = array($fieldName, intval($value));
    $this->fields[] = $field;
  }

}
?>