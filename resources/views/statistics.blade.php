<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Statistics</title>
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 1100px;
            margin: 1em auto;
        }

        #container {
            height: 420px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
        .btn-parent button {
            cursor: pointer;
            width: 200px;
            height: 40px;
            background: #f26a6c;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-parent{
            width: 100%;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

<div style="width: 1100px; margin: auto; height: auto; display: flex; justify-content: space-between">
    <h1>Score - {{$data["score"]}}%</h1>
    <h1>Danger - {{$data["danger"]}}%</h1>
</div>

    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>

    <form action="{{route('send-data')}}" method="GET">
        @csrf
        <div class="btn-parent">
            <button type="submit">go to "home" page</button>
        </div>
    </form>

</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
    let colorRed = []
    let colorOrange = []
    let colorGreen = []
    let colorBlue = []
    let categories = []

    @foreach($data["red"] as $r)
        colorRed.push([{{$r[1]}}, {{$r[2]}}])
        categories.push(`{{$r[0]}}`)
    @endforeach

    @foreach($data["orange"] as $o)
        colorOrange.push([{{$o[1]}}, {{$o[2]}}])
    @endforeach

    @foreach($data["green"] as $g)
        colorGreen.push([{{$g[1]}}, {{$g[2]}}])
    @endforeach

    @foreach($data["blue"] as $b)
        colorBlue.push([{{$b[1]}}, {{$b[2]}}])
    @endforeach


    Highcharts.chart('container', {
        chart: {
            type: 'arearange'
        },
        accessibility: {
            point: {
                valueDescriptionFormat: '{index}. {point.category}, {point.y:,.0f} millions, {point.percentage:.1f}%.'
            }
        },
        xAxis: {
            categories: categories,
            tickmarkPlacement: 'on',
            title: {
                enabled: true
            },
            tickInterval: 1
        },
        yAxis: {
            labels: {
                format: ' '
            },
            title: {
                enabled: false
            }
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f} millions)<br/>',
            split: true
        },
        plotOptions: {
            area: {
                stacking: 'percent',
                lineColor: '#ffffff',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#ffffff'
                }
            }
        },
        series: [
            {
                name: 'red',
                color: '#F0393A',
                data: colorRed
            },
            {
                name: 'orange',
                color: '#F4B439',
                data: colorOrange
            },
            {
                name: 'green',
                color: '#A5EB96',
                data: colorGreen
            },
            {
                name: 'blue',
                color: '#96C0EB',
                data: colorBlue
            }
        ]
    });
</script>
</html>
