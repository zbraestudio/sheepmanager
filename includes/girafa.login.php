<?
class girafaLOGIN{

  public $user_name;
  public $user_mail;
  public $user_id;
  public $church_name;
  public $church_slug;
  public $church_id;


  function girafaLOGIN(){
    $this->loadSession();
  }
  private function saveSession(){

    $_SESSION['SM_login'] = array(
      'user_id'     => $this->user_id,
      'user_mail'   => $this->user_mail,
      'user_name'   => $this->user_name,
      'church_name' => $this->church_name,
      'church_slug' =>  $this->church_slug,
      'church_id'   =>  $this->church_id
    );
  }

  private function loadSession(){
    //print_r($_SESSION['SM_login']);
    if(isset($_SESSION['SM_login'])){

      $this->user_id =      $_SESSION['SM_login']['user_id'];
      $this->user_mail =    $_SESSION['SM_login']['user_mail'];
      $this->user_name =    $_SESSION['SM_login']['user_name'];
      $this->church_name =  $_SESSION['SM_login']['church_name'];
      $this->church_slug =  $_SESSION['SM_login']['church_slug'];
      $this->church_id =    $_SESSION['SM_login']['church_id'];

    }
  }

  private function destroySession(){
    unset($_SESSION['SM_login']);
  }

  public function login($mail, $pass){

    global $db;

    //criptografa senha
    $pass = md5($pass);

    $sql = 'SELECT Usuarios.*, Igrejas.Nome IgrejaNome, Igrejas.slug IgrejaSlug, Igrejas.ID IgrejaID FROM Usuarios';
    $sql .= ' JOIN Igrejas ON(Igrejas.ID = Usuarios.Igreja)';
    $sql .= " WHERE Usuarios.Email = '$mail' AND Usuarios.Senha = '$pass' AND Usuarios.Ativo = 'S'";
    $res = $db->LoadObjects($sql);

    if(count($res) > 0){

      $reg = $res[0];

      $this->user_id = $reg->ID;
      $this->user_mail = $reg->Email;
      $this->user_name = $reg->Nome;
      $this->church_name = $reg->IgrejaNome;
      $this->church_slug = $reg->IgrejaSlug;
      $this->church_id = $reg->IgrejaID;

      $this->saveSession();

      return true;

    } else
      return false;

  }

  public function logout(){
    $this->user_id = null;
    $this->user_mail = null;
    $this->user_name = null;
    $this->church_name = null;
    $this->church_slug = null;
    $this->church_id = null;

    $this->destroySession();
  }

  public function verify(){

    global $login;

    if(!isset($_SESSION['SM_login']['user_id'])){

      $login->logout();
      $_SESSION['login_msg'] = 'Você não está logado para acessar esse link';
      header('LOCATION: ' . GetLink('login'));

    }

    return true;

  }


}


?>