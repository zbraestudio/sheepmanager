<?

class girafaGRID
{
  private $table;
  private $title;
  private $code;
  private $fields;
  private $reg;

  public $fnc_before;

  public $filters = array();

  public $sqlWheres = null;

  function girafaGRID($table, $title){
    $this->table = $table;

    $this->title = $title;
    $this->code = GeraLinkAmigavel($title);

  }

  private function load(){
      global $login, $db;

    $sql  = 'SELECT * FROM ' . $this->table;

    //WHERES...
      $sql .= ' WHERE (Igreja = ' . $login->church_id  . ')';

    //Campo Pesquisas...
    if(isset($_POST['s'])){

      if(!empty($_POST['s'])) {
        $sql .= ' AND (';

        foreach ($this->fields as $x => $field) {

          if ($x > 0)
            $sql .= ' OR ';

          $sql .= $field->field . ' LIKE "%' . addslashes($_POST['s']) . '%"';
        }

        $sql .= ')';
      }
    }

    //Pelos filtros (select) DEFAULT
    if(isset($_POST['filter_list'])){

      if(!empty($_POST['filter_list']))
        $sql .= ' AND (' . $_POST['filter_list'] . ')';

    } else {

      foreach ($this->filters as $filter) {
        if ($filter['default'])
          $sql .= ' AND (' . $filter['sqlWhere'] . ')';
      }

    }

    //Pelo objeto..
      if(!empty($this->sqlWheres))
          $sql .= ' AND (' . $this->sqlWheres . ')';

    //ORDERS..
    $o = array();

    foreach($this->fields as $f){

      if(!empty($f->order)){
        $o[] = $f->field . ' ' . $f->order;
      }

    }

    if(count($o) > 0)
      $sql .= ' ORDER BY ' . implode($o, ', ');


    //echo($sql);

    $this->reg = $db->LoadObjects($sql);

  }

  public function addFields($fields)
  {
      $this->fields = $fields;
  }

  public function AddFilter($legend, $sqlWhere, $default = false){
    $this->filters[] = array(
      'legend' => $legend,
      'sqlWhere' => $sqlWhere,
      'default'  => $default
    );
  }

  public function PrintHTML()
  {
    ?>



      <div class="row wrapper border-bottom white-bg page-heading table-header">
        <div class="col-lg-10">
          <h2><?= $this->title; ?></h2>
          <ol class="breadcrumb">
            <li>
              <a><?= $this->title; ?></a>
            </li>
            <li class="active">
              <strong>Ver todos</strong>
            </li>
          </ol>
        </div>
        <div class="col-lg-2">
          <a href="<?= GetLink(GetPage() . '/add'); ?>" class="btn btn-success btn-novo pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        </div>
      </div>

      <?
    if (isset($_SESSION['grid_msg'])) {
      ?>
      <div class="wrapper wrapper-content msg-form">
        <div class="alert alert-success" role="alert"><?= $_SESSION['grid_msg']; ?></div>
      </div>
      <?
      unset($_SESSION['grid_msg']);
    }

    if (isset($_SESSION['grid_msg_error'])) {
      ?>
      <div class="wrapper wrapper-content msg-form">
        <div class="alert alert-danger" role="alert"><?= $_SESSION['grid_msg_error']; ?></div>
      </div>
      <?
      unset($_SESSION['grid_msg_error']);
    }
    ?>

      <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
              <div class="col-lg-12">
                  <div class="ibox float-e-margins">

                      <div class="ibox-content grid">
                          <div class="row">
                              <form action="<?= GetLink(GetPage()); ?>" method="post" id="filters">
                                  <div class="col-sm-4 col-sm-offset-5 m-b-xs">
                                  <?
    if (count($this->filters) > 0) {
      ?>
      <select class="input-sm form-control input-s-sm inline" id="filter_list"
              name="filter_list" placeholder="Faça um filtro...">
        <option value="">Todos os registros</option>

        <?

        foreach ($this->filters as $filter) {
          ?>
          <option value="<?= $filter['sqlWhere']; ?>" <?

          if (isset($_POST['filter_list'])) {

            if ($_POST['filter_list'] == $filter['sqlWhere']) {
              echo(' selected');
            }

          } elseif ($filter['default']) {
            echo(' selected');
          }


          ?>><?= $filter['legend']; ?></option>
        <?
        }
        ?>

      </select>

    <?
    }
    ?>
                                  </div>

                                  <div class="col-sm-3">
                                      <div class="input-group">
                                      <input type="text" name="s" id="s" placeholder="Pesquisar" value="<?= @$_POST['s']; ?>" class="input-sm form-control"> <span class="input-group-btn">
                                      <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search" aria-hidden="true"></i></button> </span></div>
                                  </div>
                              </form>
                          </div>
                          <div class="table-responsive">
                              <table class="table table-striped">
                                  <thead>
                                  <tr>
                                      <?
    /* LEGENDAS */
    foreach ($this->fields as $legenda) {

      switch ($legenda->align) {
        case 'L':
        default:
          $align = 'left';
          break;
        case 'C':
          $align = 'center';
          break;
        case 'R':
          $align = 'right';
          break;
      }

      if($legenda->type == 'money'){
        if(empty($legenda->align))
          $align = 'right';

      } elseif($legenda->type == 'date'){

        if(empty($legenda->align))
          $align = 'center';

        if(empty($legenda->width))
          $legenda->width = 135;

      }

      echo('<th style="text-align: ' . $align . ';' . (($legenda->width > 0) ? 'width:' . $legenda->width . 'px;' : null) . '">');
      echo($legenda->legend);

      if (!empty($legenda->order))
        echo(' <i class="fa fa-caret-' . ($legenda->order == 'ASC' ? 'up' : 'down') . '" aria-hidden="true"></i>');

      echo('</th>');
    }
    ?>
                                      <th style="width: 80px;text-align: center;">Ações</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?

    //registros
    $this->load();

    if (count($this->reg) == 0) {
      echo('<td colspan="' . count($this->fields) . '" style="text-align: center;">Nenhum registro encontrado.</td>');
    } else {

      foreach ($this->reg as $reg) {

        $id = $reg->ID;

        echo('<tr>');

        foreach ($this->fields as $field) {

          switch ($field->align) {
            case 'L':
            default:
              $align = 'left';
              break;
            case 'C':
              $align = 'center';
              break;
            case 'R':
              $align = 'right';
              break;
          }



          if ($field->type == 'custom') {

            $value = $field->field;

            //macro..
            if (function_exists('macro_grid_before')) {
              $return = macro_grid_before($field->field, $reg);

              if(!empty($return))
                $value = $return;

            }


          } elseif ($field->type == 'mail') {

            $fieldName = $field->field;
            $value = $value = $reg->$fieldName;
            $value = '<a href="mailto:' . $value . '">' . $value . '</a>';

          } elseif ($field->type == 'list') {

            $fieldName = $field->field;
            $value = $reg->$fieldName;

            if (isset($field->type_list_options[$value]))
              $value = $field->type_list_options[$value];

          } elseif ($field->type == 'money') {

            $fieldName = $field->field;
            $value = $reg->$fieldName;

            if(empty($field->align))
              $align = 'right';

            $value = 'R$ ' . $value;


          } elseif($field->type == 'date') {

            $fieldName = $field->field;
            $value = $reg->$fieldName;

            if(!empty($value)) {
              $data = new girafaDate($value);
              $value = $data->GetFullDateForShorten() . ' (' . $data->GetDayOfWeekShorten() . ')';
            }

            if (empty($field->align))
              $align = 'center';

          } elseif($field->type == 'table'){

            $fieldName = $field->field;
            $value = $reg->$fieldName;

            $r = LoadRecord($field->type_table_name, $value);
            $fieldName = $field->type_table_fieldname;
            $value = $r->$fieldName;


          } else {


            $fieldName = $field->field;
            $value = $reg->$fieldName;
          }

          echo('<td style="text-align:' . $align . ';">');
          echo($value);
          echo('</td>');
        }

        //Ações
        echo('  <td class="grid_action" style="text-align: center;">');
        echo('<a href="' . GetLink(GetPage() . '/edit/' . base64_encode($id)) . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>');
        echo('<a href="' . GetLink(GetPage() . '/del/' . base64_encode($id)) . '" data-toggle="confirmation" data-popout="true" data-singleton="true" data-title="Tem certeza que deseja excluir esse registro?"><i class="fa fa fa-trash" aria-hidden="true"></i></a>');
        echo('  </td>' . "\r\n");

        echo('</tr>');
      }
      ?>

                                  </tbody>


                              </table>
                          </div>

                      </div>
                  </div>
              </div>

          </div>
      </div>
  </div>
      <?

    }
  }

}
class girafaGRID_field{

  public $field;
  public $legend;
  public $align = null;
  public $width = 0;
  public $order = null;
  public $type = 'string';

  public $type_list_options = array();
  public $type_table_name;
  public $type_table_fieldname;

  function girafaGRID_field($field, $legend = null){
      $this->field = $field;

      if(empty($legend))
          $legend = $field;

      $this->legend = $legend;
  }

  function alignLeft(){
      $this->align = 'L';
  }
  function alignCenter(){
      $this->align = 'C';
  }
  function alignRight(){
      $this->align = 'R';
  }

  function orderAsc(){
      $this->order = 'ASC';
  }
  function orderDesc(){
      $this->order = 'DESC';
  }

  function isMoney(){
      $this->type = 'money';
  }
  function isDate(){
      $this->type = 'date';
  }

  function isCustom(){
    $this->type = 'custom';
  }

  function isTable($tableName, $fieldName){
    $this->type = 'table';
    $this->type_table_name = $tableName;
    $this->type_table_fieldname = $fieldName;
  }

  function isMail(){
    $this->type = 'mail';
  }

  function isList($options){
    $this->type = 'list';
    $this->type_list_options = $options;
  }

}

?>