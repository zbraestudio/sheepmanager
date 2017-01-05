<?

class girafaGRID{

    private $title;
    private $code;

    public $legends = array();
    private $values = array();

    public $html = null;

    function girafaGRID($title){

        $this->title = $title;
        $this->code = GeraLinkAmigavel($title);

        //Cabeçalho
        $html  = '<div class="row wrapper border-bottom white-bg page-heading table-header">' . "\r\n";
        $html .= '  <div class="col-lg-10">' . "\r\n";
        $html .= '    <h2>' . $this->title . '</h2>' . "\r\n";
        $html .= '    <ol class="breadcrumb">' . "\r\n";
        $html .= '      <li>' . "\r\n";
        $html .= '        <a>' . $this->title . '</a>' . "\r\n";
        $html .= '      </li>' . "\r\n";
        $html .= '      <li class="active">' . "\r\n";
        $html .= '        <strong>Ver todos</strong>' . "\r\n";
        $html .= '      </li>' . "\r\n";
        $html .= '    </ol>' . "\r\n";
        $html .= '  </div>' . "\r\n";
        $html .= '  <div class="col-lg-2">' . "\r\n";
        $html .= '<a href="' . GetLink(GetPage() . '/add') . '" class="btn btn-success btn-novo pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>' . "\r\n";
        $html .= '  </div>' . "\r\n";
        $html .= '</div>' . "\r\n";

        $this->html .= $html;

        if(isset($_SESSION['grid_msg'])) {

            $this->html .= '<div class="wrapper wrapper-content msg-form">';
            $this->html .= '  <div class="alert alert-success" role="alert">' . $_SESSION['grid_msg'] . '</div>';
            $this->html .= '</div>';

            unset($_SESSION['grid_msg']);
        }

    }

    public function addValues($values, $id = -1){
        $this->values[] = array(
            'id' => $id,
            'values' => $values
        );
    }

    public function PrintHTML(){


        //inicia tabela..
        $html  = '<div class="wrapper wrapper-content animated fadeInRight">' . "\r\n";
        $html .= '  <div class="row">' . "\r\n";
        $html .= '    <div class="col-lg-12">' . "\r\n";
        $html .= '      <div class="ibox float-e-margins">' . "\r\n";
        $html .= '        <div class="ibox-content">' . "\r\n";
        $html .= '          <div class="table-responsive">' . "\r\n";
        $html .= '            <table class="table table-striped table-bordered table-hover grid_' . $this->code . '">' . "\r\n";
        $this->html .= $html;

        //legendas do início
        $html  = '<thead>' . "\r\n";
        $html .= '  <tr>' . "\r\n";
        foreach($this->legends as $legend) {
            $html .= '    <th>' . $legend . '</th>' . "\r\n";
        }
        $html .= '    <th style="width: 40px;">Ações</th>' . "\r\n";
        $html .= '  </tr>' . "\r\n";
        $html .= '</thead>' . "\r\n";
        $this->html .= $html;

        //registros
        $html = '<tbody>' . "\r\n";

        foreach($this->values as $value) {

            $fields = $value['values'];
            $id = $value['id'];

            $html .= '<tr class="gradeX">' . "\r\n";

            foreach($fields as $field) {

                switch($field->align) {
                    case 'L':
                        $align = 'left';
                        break;
                    case 'C':
                        $align = 'center';
                        break;
                    case 'R':
                        $align = 'right';
                        break;
                }

                if(intval($field->width) <= 0)
                    $style_width = null;
                else {
                    $style_width = 'width:' . intval($field->width) . 'px;';
                }

                $html .= '  <td style="text-align:' . $align . ';' . $style_width . '">';
                $html .= $field->value;
                $html .= '</td>' . "\r\n";
            }

            //Ações
            $html .= '  <td class="grid_action" style="text-align: center;">';
            $html .= '<a href="' . GetLink(GetPage() . '/edit/' . base64_encode($id)) . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
            $html .= '<a href="' . GetLink(GetPage() . '/del/' . base64_encode($id)) . '" data-toggle="confirmation" data-popout="true" data-singleton="true" data-title="Tem certeza que deseja excluir esse registro?"><i class="fa fa fa-trash" aria-hidden="true"></i></a>';
            $html .= '  </td>' . "\r\n";

            $html .= '</tr>' . "\r\n";
        }

        $html .= '</tbody>' . "\r\n";
        $this->html .= $html;

        //legendas do final
        $html  = '<tfoot>' . "\r\n";
        $html .= '  <tr>' . "\r\n";
        foreach($this->legends as $legend) {
            $html .= '    <th>' . $legend . '</th>' . "\r\n";
        }
        $html .= '    <th>Ações</th>' . "\r\n";

        $html .= '  </tr>' . "\r\n";
        $html .= '</tfoot>' . "\r\n";
        $this->html .= $html;

        //finaliza tabela..
        $html  = '            </table>' . "\r\n";
        $html .= '          </div>' . "\r\n";
        $html .= '        </div>' . "\r\n";
        $html .= '      </div>' . "\r\n";
        $html .= '    </div>' . "\r\n";
        $html .= '  </div>' . "\r\n";
        $html .= '</div>' . "\r\n";
        $this->html .= $html;

        //imprime na tela
        echo($this->html);


        //imprime JS..
        $this->printJS();

    }


    private function printJS(){
        ?>
        <!-- Imprime JS do GRID -->
        <script>
            $(document).ready(function(){
                $('.grid_<?= $this->code; ?>').DataTable({
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},

                        {extend: 'print',
                            customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ],

                    "language": {
                        "sLengthMenu": "Mostrar _MENU_ registro(s)",
                        "search": "Pesquisar",
                        "info": "Exibindo página _PAGE_ de _PAGES_",
                        "emptyTable": "Nenhum registro.",
                        "paginate": {
                            first:      "Primeiro",
                            previous:   "Anterior",
                            next:       "Próximo",
                            last:       "Último"
                        },
                    },

                });



            });

        </script>

        <?
    }


}


class girafaGRID_field{

    public $value;
    public $align = 'L';
    public $width = 0;

    function girafaGRID_field($value){
        $this->value = $value;
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


}

?>