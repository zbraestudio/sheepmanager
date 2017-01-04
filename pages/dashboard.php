<?
set_config('TITLE', 'Painel');
template_getHeader();
?>

<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">trimestre</span>
                            <h5>Membros</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">6</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-level-down"></i></div>
                            <small>até o momento</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">trimestre</span>
                            <h5>Visitantes</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">86</h1>
                            <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                            <small>até o momento</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">Trimestre</span>
                            <h5>Discipuladores</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">8</h1>
                            <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                            <small>até o momento</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">Esse mês</span>
                            <h5>Aniversariantes</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">2</h1>
                            <div class="stat-percent font-bold text-danger">10% <i class="fa fa-birthday-cake"></i></div>
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
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins ">R$2.000,00</h2>
                                            <small style="color: #1ab394;">Em conta</small>

                                        </li>
                                        <li>
                                            <h2 class="no-margins">R$5.543,00</h2>
                                            <small>Total de Entradas</small>
                                            <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;background-color: #1c84c6;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">R$2.123,02</h2>
                                            <small>Total de Saídas</small>
                                            <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 60%; background-color: #ed5565;" class="progress-bar"></div>
                                            </div>
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

        var data2 = [
            [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
            [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
            [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
            [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
            [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
            [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
            [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
            [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
        ];

        var data3 = [
            [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
            [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
            [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
            [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
            [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
            [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
            [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
            [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
        ];


        var dataset = [
            {
                label: "Entradas",
                data: data3,
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
                data: data2,
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
