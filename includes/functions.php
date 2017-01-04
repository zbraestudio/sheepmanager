<?
function GetPage($extension = false)
{
  global $params;
  $page = $params[0];

  if($extension)
    $page .= '.php';

  return $page;
}

function GetLink($link){
  return get_config('SITE_URL') . $link;
}

function GetParamsArray(){
  global $params;

  if(count($params) >= 1) {
    $p = $params;
    array_shift($p);
    return $p;
  } else {
    return null;
  }

}

function GetParam($key){
  $p = GetParamsArray();
  return @$p[$key];
}

function nl2p($string)
{
  $string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);

    return '<p>'.preg_replace("/([\n]{1,})/i", "</p>\n<p>", trim($string)).'</p>';
}

function template_getHeader(){
  include(get_config('SITE_PATH') . 'includes/html.head.php');
  include(get_config('SITE_PATH') . 'includes/html.header.php');
}

function template_getFooter(){
  include(get_config('SITE_PATH') . 'includes/html.footer.php');
  include(get_config('SITE_PATH') . 'includes/html.foot.php');
}



?>