<?
function form_field_string($name, $value, $lendth, $default = null, $required = true, $mask = null, $class = null){

  $html = '<input type="text" ';

  $html .= ' name="' . $name . '"';
  $html .= ' maxlength="' . $lendth . '"';

  $html .= ' class="form-control ' . $class . (!empty($mask)?' mask':null) .'"';

  if(!empty($mask))
    $html .= ' mask="' . $mask . '"';

  if(!isset($value))
    $value = $default;

  $html .= ' value="' . $value . '"';

  if($required)
    $html .= ' required';

  $html .= ' >';

  return $html;

}


function form_field_integer($name, $value, $default = null, $min = 0, $max = 9999, $required = true, $class = null){

  $html = '<input type="number" ';

  $html .= ' name="' . $name . '"';

  $html .= ' min="' . $min . '"';
  $html .= ' max="' . $max . '"';

  $html .= ' class="form-control ' . $class . '"';

  if(!isset($value))
    $value = $default;

  $html .= ' value="' . $value . '"';

  if($required)
    $html .= ' required';

  $html .= ' >';

  return $html;

}

function form_field_date($name, $value, $default = null, $required = true, $class = null){
  $html = '<input type="text" ';

  $html .= ' name="' . $name . '"';

  $html .= ' class="form-control mask ' . $class . '"';

  $html .= ' mask="00/00/0000"';

  if(GetParam(0) == 'add')
    $value = $default;

  $html .= ' value="' . dataYYYYMMDDtoDDMMYYYY($value) . '"';

  if($required)
    $html .= ' required';

  $html .= ' >';

  return $html;
}

function form_field_list($name, $options = array(), $value, $default = null, $required = true, $class = null){

  $html = '<select ';
  $html .= ' class="form-control m-b ' . $class . '"';
  $html .= ' name="' . $name . '"';

  if($required)
    $html .= ' required';

  if(GetParam(0) == 'add')
    $value = $default;

  $html .= '>';

  $html .= '<option value=""></option>';

  foreach($options as $k=>$otp){
    $html .= '<option value="' . $k . '" ' . (($value == $k)?'selected':null) . '>' . $otp . '</option>';
  }


  $html .= '</select>';

  return $html;

}
?>