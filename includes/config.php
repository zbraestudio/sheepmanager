<?
function set_config($key, $val){
  $GLOBALS[$key] = $val;
}

function get_config($key){
  return $GLOBALS[$key];
}


/* Caminhos */
if( $_SERVER['HTTP_HOST'] == 'localhost'){

  set_config('SITE_URL'         , 'http://localhost/github/deepmanager/');
  set_config('SITE_PATH'        , 'D:/github/deepmanager/');

} else {
}

set_config('TITLE',                   '');
set_config('SYSTEM_TITLE',            'Sheep Manager');
set_config('FOOTER_TEXT',            '<strong>Sheep Manager</strong> v1 - &copy; 2017 - Todos os Direitos Reservados.');

/* Banco de Dados */
if( $_SERVER['HTTP_HOST'] == 'localhost')
  set_config('DB_HOST'          , 'nbz.net.br');
else
  set_config('DB_HOST'          , 'localhost');

set_config('DB_USER'          , 'root');
set_config('DB_PASS'          , 'nwtiago');
set_config('DB_DB'            , 'deepmanager');