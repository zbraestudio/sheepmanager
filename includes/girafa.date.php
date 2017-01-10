<?
class girafaDate
{
    # VARIÁVEIS PRIVADAS

    private $_mktime = false;
    private $_language;

    private function _setDate($ano, $mes, $dia, $hora, $minuto, $segundo)
    {
        $ano         = intval($ano);
        $mes         = intval($mes);
        $dia         = intval($dia);
        $hora        = intval($hora);
        $minuto      = intval($minuto);
        $segundo     = intval($segundo);

        $this->_mktime = mktime($hora, $minuto, $segundo, $mes, $dia, $ano);

        //Verifica se foi atribuído valor corretamente ao mktime
        if($this->_mktime === false)
            throw new Exception('girafaDate::O valor especificado não pôde ser atribuído corretamente.');
    }

    private function _checkData()
    {
        if($this->_mktime === false)
            throw new Exception('girafaDate::Você não pode executar esta ação sem antes setar uma data ao objeto.');

        return true;
    }

    function __construct($date, $format = ENUM_DATE_FORMAT::YYYY_MM_DD)
    {

        switch ($format)
        {
            case ENUM_DATE_FORMAT::YYYY_MM_DD:
                $date = explode('-', $date);
                $this->_setDate($date[0], $date[1], $date[2], 0, 0, 0);
                break;

            case ENUM_DATE_FORMAT::YYYY_MM_DD_HH_II_SS:
                $date = str_replace(' ', '-', $date);
                $date = str_replace(':', '-', $date);
                $date = explode('-', $date);
                $this->_setDate($date[0], $date[1], $date[2], $date[3], $date[4], $date[5]);
                break;

            case ENUM_DATE_FORMAT::DD_MM_YYYY:
                $date = str_replace('/', '-', $date);
                $date = explode('-', $date);
                $this->_setDate($date[2], $date[1], $date[0], 0, 0, 0);
                break;

            case ENUM_DATE_FORMAT::DD_MM_YYYY_DD_II_SS:
                $date = str_replace(' ', '-', $date);
                $date = str_replace('/', '-', $date);
                $date = str_replace(':', '-', $date);
                $date = explode('-', $date);
                $this->_setDate($date[2], $date[1], $date[0], $date[3], $date[4], $date[5]);
                break;

            default:
                throw new Exception('girafaDate::Formado de data ainda não implemtado na classe.');
        }
    }

    public function GetDate($format)
    {
        //Verifica se a data foi setada
        $this->_checkData();

        return date($format, $this->_mktime);
    }

    public function GetMonthNameLong()
    {
        //Verifica se a data foi setada
        $this->_checkData();

        $mes = intval($this->GetDate('m'));

        switch ($mes)
        {
            case 1:  return 'Janeiro';
            case 2:  return 'Fevereiro';
            case 3:  return 'Março';
            case 4:  return 'Abril';
            case 5:  return 'Maio';
            case 6:  return 'Junho';
            case 7:  return 'Julho';
            case 8:  return 'Agosto';
            case 9:  return 'Setembro';
            case 10: return 'Outubro';
            case 11: return 'Novembro';
            case 12: return 'Dezembro';
        }
    }

    public function GetMonthNameShorten()
    {
        //Verifica se a data foi setada
        $this->_checkData();

        $mes = $this->GetMonthNameLong();
        $mes = strtolower($mes);
        $mes = substr($mes, 0, 3);
        return $mes;
    }

    public function GetDayOfWeekLong()
    {
        //Verifica se a data foi setada
        $this->_checkData();

        $dia = intval($this->GetDate('N'));

        switch ($dia)
        {
            case 1:  return 'Segunda-feira';
            case 2:  return 'Terça-feira';
            case 3:  return 'Quarta-feira';
            case 4:  return 'Quinta-feira';
            case 5:  return 'Sexta-feira';
            case 6:  return 'Sábado';
            case 7:  return 'Domingo';
        }
    }

    public function GetDayOfWeekShorten()
    {
        //Verifica se a data foi setada
        $this->_checkData();

        $dia = $this->GetDayOfWeekLong();
        $dia = utf8_decode($dia);
        $dia = strtolower($dia);
        $dia = substr($dia, 0, 3);
        $dia = utf8_encode($dia);
        return $dia;
    }

    public function GetFullDateForLong()
    {
        //Verifica se a data foi setada
        $this->_checkData();

        $dia = $this->GetDate('d');
        $mes = $this->GetMonthNameLong();
        $ano = $this->GetDate('Y');

        return $dia . ' de ' . $mes . ' de ' . $ano;
    }

    public function GetFullDateForShorten()
    {
        //Verifica se a data foi setada
        $this->_checkData();

        $dia = $this->GetDate('d');
        $mes = $this->GetMonthNameShorten();
        $ano = $this->GetDate('y');

        return $dia . '/' . $mes . '/' . $ano;
    }

}

#ENUMARADORES
class ENUM_DATE_FORMAT{
    const YYYY_MM_DD = 'Y-m-d';
    const YYYY_MM_DD_HH_II_SS = 'Y-m-d H:i:s';
    const DD_MM_YYYY = 'd/m/Y';
    const DD_MM_YYYY_DD_II_SS = 'd/m/Y H:i:s';
}
?>
