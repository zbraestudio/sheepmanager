<?

class girafaFORM{

  private $title;
  private $html;
  private $script_action;
  private $boxes = array();
  private $table;
  private $fieldLegend;

  public $reg;
  public $linkVoltar;

  function girafaFORM($title, $script_action, $table, $fieldLegend){
    global $login, $db;

    $this->script_action = $script_action;
    $this->table = $table;
    $this->fieldLegend = $fieldLegend;
    $this->title = $title;

    if (GetParam(GetParamsCount()-2) == 'edit') {
      $sql = 'SELECT * FROM `' . $this->table . '` WHERE ID = ' . intval(base64_decode(GetParam(GetParamsCount()-1))) . ' AND Igreja = ' . $login->church_id;
      //die($sql);
      $res = $db->LoadObjects($sql);

      if (count($res) <= 0) {
        die('<h4>o registro não foi encontrado ou você não tem permissão pra visualizá-lo.</h4>' . $sql);
      }

      $this->reg = $res[0];
    }

    //Título
    $html = "<div class=\"row wrapper border-bottom white-bg page-heading\">";
    $html .= "  <div class=\"col-lg-12\">";
    $html .= "    <h2>" . $this->title . "</h2>";
    $html .= "    <ol class=\"breadcrumb\">";
    $html .= "      <li><a href=\"" . GetLink(GetPage()) . "\">" . $this->title . "</a></li>";

    if (GetParam(GetParamsCount()-1) == 'add') {
      $html .= "      <li class=\"active\">";
      $html .= "        <strong>Adicionando Novo</strong>";
      $html .= "      </li>";
    } else {
      $html .= "      <li>Editando</li>";
      $html .= "      <li class=\"active\"><strong>" . $this->reg->$fieldLegend . "</strong></li>";
    }
    $html .= "      </ol>";
    $html .= "  </div>";
    $html .= "</div>";
    $this->html .= $html;

  }

  function AddBox($girafaFORM_box){

    $this->boxes[] = $girafaFORM_box;

  }

  function PrintHTML(){

    //Tem mensagem pra exibir?
    if(isset($_SESSION['form_msg'])) {
      $html  = "<div class=\"wrapper wrapper-content msg-form\">";
      $html .= "  <div class=\"alert alert-success\" role=\"alert\">" . $_SESSION['form_msg'] . "</div>";
      $html .= "</div>";
      $this->html .= $html;
      unset($_SESSION['form_msg']);
    }


    //Tem mensagem pra exibir?
    if(isset($_SESSION['form_msg_error'])) {
      $html  = "<div class=\"wrapper wrapper-content msg-form\">";
      $html .= "  <div class=\"alert alert-danger\" role=\"alert\">" . $_SESSION['form_msg_error'] . "</div>";
      $html .= "</div>";
      $this->html .= $html;
      unset($_SESSION['form_msg_error']);
    }


    // Content..
    $html  = "<div class=\"wrapper wrapper-content animated fadeInRight\">";
    $html .= "  <div class=\"row\">";
    $html .= "    <form method=\"post\" class=\"form-horizontal\" action=\"" . get_config('SITE_URL') . "/script/" . $this->script_action . "\">";

    //Se for edição, adiciona campo oculto com ID
    if(isset($this->reg->ID)){
      $html .= "<input name=\"id\" value=\"" . $this->reg->ID . "\" type=\"hidden\">";
    }

    // BOXES
    foreach($this->boxes as $box){
      $html .= $box->GetHTML();
    }


    //Ações
    $html .= "<div class=\"clearboth\"></div>";
    $html .= "<!-- ACTIONS -->";
    $html .= "<div class=\"col-lg-12\">";
    $html .= "  <div class=\"form-group\">";
    $html .= "    <div class=\"pull-right btn-actions\">";

    if(GetParam(GetParamsCount()-2) == 'edit'){
      $html .= "      <a href=\"" . GetLink(GetPage())  . "/add\" class=\"btn btn-info btn-xs\" type=\"submit\">Adicionar novo</a>";
    }

    if(empty($this->linkVoltar))
      $this->linkVoltar = GetLink(GetPage());

    $html .= "      <a href=\"" . $this->linkVoltar  . "\" class=\"btn btn-white\" type=\"submit\">Voltar</a>";
    $html .= "      <button class=\"btn btn-primary\" type=\"submit\">" . ( (GetParam(GetParamsCount()-1) == 'add')?'Adicionar':'Atualizar' ) . "</button>";
    $html .= "    </div>";
    $html .= "  </div>";
    $html .= "</div>";


    $html .= "    </form>";
    $html .= "   </div>";
    $html .= "</div>";
    $this->html .= $html;

    echo($this->html);
  }

}

class girafaFORM_box{
  private $cols = 12;
  private $title;
  private $subtitle;
  private $content_html = null;

  function girafaFORM_box($title, $subtitle = null, $cols = 12){
    $this->title = $title;
    $this->subtitle = $subtitle;
    $this->cols = $cols;
  }

  public function AddContent($html){
    $this->content_html .= $html;
  }

  public function AddContentLine(){
    $html = '<br><div class="hr-line-dashed"></div><br>';
    $this->AddContent($html);
  }

  public function AddContentBreakLine(){
    $html = '<div class="clearboth"></div>';
    $this->AddContent($html);
  }

  public function GetHTML(){

    $html = "<div class=\"col-lg-" . $this->cols . "\">";
    $html .= "  <div class=\"ibox float-e-margins\">";
    $html .= "    <div class=\"ibox-title\">";
    $html .= "      <h5>" . $this->title . " <small>" . $this->subtitle . "</small></h5>";
    $html .= "      <div class=\"ibox-tools\">";
    $html .= "        <a class=\"collapse-link\">";
    $html .= "          <i class=\"fa fa-chevron-up\"></i>";
    $html .= "        </a>";
    $html .= "      </div>";
    $html .= "    </div>";
    $html .= "    <div class=\"ibox-content\">";

    $html .= $this->content_html;

    $html .= "      <div style=\"clear:both;\"></div>";
    $html .= "    </div>";
    $html .= "  </div>";
    $html .= "</div>";

    return $html;
  }
}
?>