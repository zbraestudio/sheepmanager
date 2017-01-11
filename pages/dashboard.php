<?
set_config('TITLE', 'Painel');
template_getHeader();
?>

<div class="wrapper wrapper-content">
            <div class="row">

                <?
                /* MEMBROS - Até o momento */

                $sql = "SELECT COUNT(ID) TOTAL FROM Membros WHERE Situacao = 'MEM' AND Igreja = " . $login->church_id;
                $res = $db->LoadObjects($sql);
                $reg = $res[0];
                $membrosTotal = intval($reg->TOTAL);

                ?>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">no momento</span>
                            <h5>Membros</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= $membrosTotal; ?></h1>
                            <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-level-down"></i></div>-->
                            <small>até o momento</small>
                        </div>
                    </div>
                </div>

                <?
                /* VISITANTES - Últimos 3 meses */
                $sql   = "SELECT YEAR(Data) ANO, MONTH(Data) ANO, (SUM(VisitantesAdultos) + SUM(VisitantesCriancas)) TOTAL";
                $sql .= " FROM Cultos WHERE Data >= '" . date('Y-m-d', strtotime('-3 month')) . "'";

                $res = $db->LoadObjects($sql);
                $reg = $res[0];
                $visitantes = intval($reg->TOTAL);


                $sql  = "SELECT YEAR(Data) ANO, MONTH(Data) ANO, (SUM(VisitantesAdultos) + SUM(VisitantesCriancas)) TOTAL";
                $sql .= " FROM Cultos WHERE Data >= '" . date('Y-m-d', strtotime('-6 month')) . "' AND Data < '" . date('Y-m-d', strtotime('-3 month')) . "'";

                $res = $db->LoadObjects($sql);
                $reg = $res[0];
                $visitantesAnteriores = intval($reg->TOTAL);

                if($visitantesAnteriores > 0)
                    $visitantes_perc = ceil( ( ($visitantes - $visitantesAnteriores) / $visitantesAnteriores) * 100);
                else
                    $visitantes_perc = 100;

                ?>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">últ. 3 meses</span>
                            <h5>Visitas</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= $visitantes; ?></h1>
                            <div class="stat-percent font-bold text-info"><?= $visitantes_perc; ?>% <i class="fa fa-level-<?= $visitantes_perc > 0?'up':'down'; ?>"></i></div>
                            <small>até o momento</small>
                        </div>
                    </div>
                </div>

                <?
                /* CULTOS */
                $sql = 'SELECT COUNT(ID) TOTAL FROM Cultos';
                $sql .= " WHERE YEAR(Data) = '" . date('Y') . "'";
                $res = $db->LoadObjects($sql);
                $reg = $res[0];
                $cultosTotal = intval($reg->TOTAL);
                ?>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">esse ano</span>
                            <h5>Cultos</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= $cultosTotal; ?></h1>
                            <!--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>-->
                            <small>até o momento</small>
                        </div>
                    </div>
                </div>

                <?
                /* Aniversariantes do Mês */
                $sql = 'SELECT COUNT(ID) TOTAL FROM Membros';
                $sql .= " WHERE Situacao = 'MEM' AND MONTH(DataNascimento) = MONTH(CURDATE())";
                $res = $db->LoadObjects($sql);
                $reg = $res[0];
                $aniversariantesTotal = intval($reg->TOTAL);

                $aniversariantes_perc = ceil($aniversariantesTotal * 100 / $membrosTotal);
                $a
                ?>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">Esse mês</span>
                            <h5>Aniversariantes</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= $aniversariantesTotal; ?></h1>
                            <div class="stat-percent font-bold text-danger"><?= $aniversariantes_perc; ?>% <i class="fa fa-birthday-cake"></i></div>
                            <small>janeiro</small>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Financeiro</h5>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-white active">Hoje</button>
                                    <button type="button" class="btn btn-xs btn-white">Mês</button>
                                    <button type="button" class="btn btn-xs btn-white">Ano</button>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                    </div>
                                </div>

                                <?
                                $emConta = financeiroContaSaldo();
                                $totalEntradas = financeiroTotalEntradaUltimos3meses();
                                $totalSaidas = financeiroTotalSaidasUltimos3meses();


                                ?>
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins ">R$ <?= number_format($emConta, 2, ',', '.'); ?></h2>
                                            <span class="label label-info">Em conta</span>

                                        </li>
                                        <li>
                                            <h2 class="no-margins">R$ <?= number_format($totalEntradas, 2, ',', '.'); ?></h2>
                                            <span class="label label-success">Total de Entradas (últ. 3 meses)</span>
                                            <!--<div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>-->
                                            <!--<div class="progress progress-mini">
                                                <div style="width: 48%;background-color: #1c84c6;" class="progress-bar"></div>
                                            </div>-->
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">R$ <?= number_format($totalSaidas, 2, ',', '.'); ?></h2>
                                            <span class="label label-danger">Total de Saídas (últ. 3 meses)</span>
                                            <!--<div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>-->
                                            <!--<div class="progress progress-mini">
                                                <div style="width: 60%; background-color: #ed5565;" class="progress-bar"></div>
                                            </div>-->
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Próximos Eventos</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-hover no-margins">
                                        <thead>
                                        <tr>
                                            <th>Descrição</th>
                                            <th>Data</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td><span class="label label-primary">Hoje</span> Culto Missionário</td>
                                            <td><i class="fa fa-calendar"></i> 26 de janeiro de 2016</td>
                                        </tr>

                                        <tr>
                                            <td><span class="label label-warning">Nos próximos dias</span> Programa de Jovens</td>
                                            <td><i class="fa fa-calendar"></i> 15-16 de janeiro de 2017</td>
                                        </tr>
                                        <tr>
                                            <td><span class="label label-warning">Nos próximos dias</span> Encontro de Mulheres</td>
                                            <td><i class="fa fa-calendar"></i> 15-16 de janeiro de 2017</td>
                                        </tr>
                                        <tr>
                                            <td><span class="label label-warning">Nos próximos dias</span> Culto com Santa Ceia</td>
                                            <td><i class="fa fa-calendar"></i> 15-16 de janeiro de 2017</td>
                                        </tr>
                                        <tr>
                                            <td><span class="label label-warning">Nos próximos dias</span> Congresso de Missões Urbanas</td>
                                            <td><i class="fa fa-calendar"></i> 15-16 de janeiro de 2017</td>
                                        </tr>

                                        <tr>
                                            <td><small>NEXT - CULTO (Ritos e Tradições)</small> </td>
                                            <td><i class="fa fa-calendar"></i> 05 de fevereiro 2017</td>
                                        </tr>
                                        <tr>
                                            <td><small>NEXT - CULTO (Ritos e Tradições)</small> </td>
                                            <td><i class="fa fa-calendar"></i> 05 de fevereiro 2017</td>
                                        </tr>
                                        <tr>
                                            <td><small>NEXT - CULTO (Ritos e Tradições)</small> </td>
                                            <td><i class="fa fa-calendar"></i> 05 de fevereiro 2017</td>
                                        </tr>
                                        <tr>
                                            <td><small>NEXT - CULTO (Ritos e Tradições)</small> </td>
                                            <td><i class="fa fa-calendar"></i> 05 de fevereiro 2017</td>
                                        </tr>
                                        <tr>
                                            <td><small>NEXT - CULTO (Ritos e Tradições)</small> </td>
                                            <td><i class="fa fa-calendar"></i> 05 de fevereiro 2017</td>
                                        </tr>

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
template_getFooter();
?>


<script>
    $(document).ready(function () {
        $('.chart').easyPieChart({
            barColor: '#f8ac59',
            //                scaleColor: false,
            scaleLength: 5,
            lineWidth: 4,
            size: 80
        });

        $('.chart2').easyPieChart({
            barColor: '#1c84c6',
            //                scaleColor: false,
            scaleLength: 5,
            lineWidth: 4,
            size: 80
        });

        var data_saidas =
            [<?
            $sql  = 'SELECT C.Tipo, YEAR(L.Data) ANO, MONTH(L.Data) MES, DAY(L.Data) DIA, WEEK(L.Data) SEMANA, SUM(L.Valor) SUBTOTAL';
            $sql .= " FROM FinanceiroLancamentos L";
            $sql .= ' JOIN FinanceiroCompromissos C ON(C.ID = L.Compromisso)';
            $sql .= " WHERE L.Igreja = " . $login->church_id . " AND C.Igreja = " . $login->church_id . " AND C.Tipo = 'SAI' AND L.Data > '" . date("Y-m-d", strtotime("-3 month")) . "'";
            $sql .= ' GROUP BY ANO, SEMANA';
            $saidas = $db->LoadObjects($sql);

            foreach($saidas as $x=>$saida){

            if($x > 0)
              echo(',');

              echo('[gd(' . $saida->ANO . ', ' . $saida->MES . ', ' . date('d', StartOfDayWeek($saida->SEMANA, $saida->ANO)) . '), ' . $saida->SUBTOTAL . ']');

            }
            ?>];

        var data_entradas =
            [<?
            $sql  = 'SELECT C.Tipo, YEAR(L.Data) ANO, MONTH(L.Data) MES, DAY(L.Data) DIA, WEEK(L.Data) SEMANA, SUM(L.Valor) SUBTOTAL';
            $sql .= " FROM FinanceiroLancamentos L";
            $sql .= ' JOIN FinanceiroCompromissos C ON(C.ID = L.Compromisso)';
            $sql .= " WHERE L.Igreja = " . $login->church_id . " AND C.Igreja = " . $login->church_id . " AND C.Tipo = 'ENT' AND L.Data > '" . date("Y-m-d", strtotime("-3 month")) . "'";
            $sql .= ' GROUP BY ANO, SEMANA';

            $entradas = $db->LoadObjects($sql);

            foreach($entradas as $x=>$entrada){

            if($x > 0)
              echo(',');

              echo('[gd(' . $entrada->ANO . ', ' . $entrada->MES . ', ' . date('d', StartOfDayWeek($saida->SEMANA, $saida->ANO)) . '), ' . $entrada->SUBTOTAL . ']');

            }
            ?>];


        var dataset = [
            {
                label: "Entradas",
                data: data_entradas,
                color: "#1c84c6",
                lines: {
                    lineWidth: 1,
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.2
                        }, {
                            opacity: 0.4
                        }]
                    }
                }

            }, {
                label: "Saídas",
                data: data_saidas,
                yaxis: 2,
                color: "#ed5565",
                lines: {
                    lineWidth: 1,
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.2
                        }, {
                            opacity: 0.4
                        }]
                    }
                },
                splines: {
                    show: false,
                    tension: 0.6,
                    lineWidth: 1,
                    fill: 0.1
                },
            }
        ];


        var options = {
            xaxis: {
                mode: "time",
                tickSize: [3, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                position: "left",
                max: 1070,
                color: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3
            }, {
                position: "right",
                clolor: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: ' Arial',
                axisLabelPadding: 67
            }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        var previousPoint = null, previousLabel = null;

        $.plot($("#flot-dashboard-chart"), dataset, options);

        var mapData = {
            "US": 298,
            "SA": 200,
            "DE": 220,
            "FR": 540,
            "CN": 120,
            "AU": 760,
            "BR": 550,
            "IN": 200,
            "GB": 120,
        };

        $('#world-map').vectorMap({
            map: 'world_mill_en',
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    "fill-opacity": 0.9,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 0
                }
            },

            series: {
                regions: [{
                    values: mapData,
                    scale: ["#1ab394", "#22d6b1"],
                    normalizeFunction: 'polynomial'
                }]
            },
        });
    });
</script>
