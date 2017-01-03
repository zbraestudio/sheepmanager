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


set_config('TITLE',            'Sheep Manager v1');
set_config('FOOTER_TEXT',            'Sheep Manager v1 - 2016 - Todos os Direitos Reservados.');

/* Banco de Dados */
if( $_SERVER['HTTP_HOST'] == 'localhost')
  set_config('DB_HOST'          , 'nbz.net.br');
else
  set_config('DB_HOST'          , 'localhost');

set_config('DB_USER'          , 'root');
set_config('DB_PASS'          , 'nwtiago');
set_config('DB_DB'            , 'deepmanager');