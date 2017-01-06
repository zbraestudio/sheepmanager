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

function GeraLinkAmigavel($texto)
{

  $texto = trim($texto);

  //Tira acentos
  $comAcento = array('O','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','O','�','�','�','�','&', '�', '�', '%');
  $semAcento = array('o','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','0','U','U','U','Y','e', 'a', 'o', 'perc');
  $texto = str_replace($comAcento, $semAcento, $texto);

  //Anula alguns acaracters
  $texto = str_replace(array('?', '!', ':', ';', '~', '`', '�', '{', '}', '[', ']', '/', '\\', ',', '(', ')', '"'), '', $texto);

  //Substitui espa�os
  $texto = str_replace(' ', '-', $texto);

  //Eleminia �fens duplicados
  $texto = str_replace('--', '-', $texto);

  //Passa pra min�sculo
  $texto = strtolower($texto);

  return $texto;
}

function dataDDMMYYYYtoYYYYMMDD($data){

  if(empty($data))
    return null;

  return substr($data, 6, 4) . '-' . substr($data, 3, 2) . '-' . substr($data, 0, 2);

}

function dataYYYYMMDDtoDDMMYYYY($data){
  if(empty($data))
    return null;

  return substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4);

}

function decimalToDB($var){
  return number_format($var, 2, '.', '');
}

function decimalFromDB($var){
  return number_format($var, 2, '.', '');
}

?>