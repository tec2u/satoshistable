@extends('layouts.header')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/sankey.js"></script>
<script src="https://code.highcharts.com/modules/organization.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>
    .Inactive {
        stroke: #ff0000;
    }

    .PreRegistration {
        stroke: #3700ff;
    }

    .AllCards {
        stroke: #15ff00;
    }

    .details-view {
        display: none !important;
    }

    .edit-wrapper {
        display: none !important;
    }

    .boc-edit-form {
        display: none !important;
    }

    .boc-edit-form-fields {
        display: none !important;
    }
</style>

{{-- condição para dados de rede, remover depois --}}
@if (isset($networks))
<main id="main" class="main" style="position: relative;">
    <div class="d-flex justify-content-between mb-2">
        <button onclick="zoomOut()" class="btn btn-primary zoom-btn">Zoom Out 25%</button>
        <button onclick="zoomIn()" class="btn btn-primary zoom-btn">Zoom In 100%</button>
    </div>
    {{-- <div id="tree" /> --}}
    <figure class="highcharts-figure" style="max-width: 100% !important;">
        <div onclick="updateChartsByLogin('{{auth()->user()->login}}')" class="btn btn-outline-primary btn-inicio-rede">Inicio Rede</div>
        <div id="container" style="height: 800px;">
        </div>
    </figure>
</main>

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> --}}

<style>
    .highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
}

.btn-inicio-rede {
    position: absolute;
    z-index: 1;
    margin-top: 15px;
    margin-left: 15px;
}
.highcharts-credits {
    display: none !important;
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

#container h4 {
    text-transform: none;
    font-size: 14px;
    font-weight: normal;
}

#container p {
    font-size: 13px;
    line-height: 16px;
}

@media screen and (max-width: 600px) {
    #container h4 {
        font-size: 2.3vw;
        line-height: 3vw;
    }

    #container p {
        font-size: 2.3vw;
        line-height: 3vw;
    }
}
.container-loading {
    position: absolute;top:0;left:0;height:100%;width:100%;background-color: #0000002e;
}
.icon-active {
    color: #ffdc00;
    font-size: 12px;
}
</style>
<script>

    let networks = {!!$networks!!}
    console.log(networks)
    let pointNameFirst = '{!!auth()->user()->login!!}'
    let levelUsuarioFirst = 0

    let pointNameUsuarioLogado = pointNameFirst
    let rede_size = {}
    let formattedData = []
    let fontsizeWidth = '15px'
    let niveisPorVez = 3
    let nodeWidthSize = 200

    let contadorNivel = 6
    let sizeRedeWidth = 600;
    let sizeRedeHeight = 600;

    let usersById = [];
    let levelsConfig = [];
    let nodesConfig = [];
    let networksFormatted =  networks.filter(item => item.level <= 6);


    function getDiretos(login){
        console.log('level atual: ' + levelUsuarioFirst)
        let level = (parseInt(levelUsuarioFirst) + niveisPorVez)
        console.log('level atual: ' + level)
        let diretos = networksFormatted.filter(item => item.referred == login && item.level > levelUsuarioFirst && item.level < level );
        if(diretos.length > 0) {
            diretos.forEach((direto) => {
                formattedData.push([direto.referred, direto.login])
                getDiretos(direto.login)
            })
        }
    }

    function getDiretosCalc(login){
        rede_size[login] = 0
        let principal = networksFormatted.filter(item => item.login == login)[0];
        let diretos = networksFormatted.filter(item => item.referred == login);

        if(diretos.length > 0) {
            diretos.forEach((direto) => {
                rede_size[login]++
                rede_size[direto.login] = 0
                getDiretosCalc(direto.login)
                rede_size[login] += rede_size[direto.login]
            })
        }
    }

    function getCalcRede(login){
        rede_size[login] = 0
        let principal = networksFormatted.filter(item => item.login == login)[0];
        let diretos = networksFormatted.filter(item => item.referred == login);

        diretos.forEach((direto) => {
            rede_size[login]++
            rede_size[direto.login] = 0
            getDiretosCalc(direto.login)
            rede_size[login] += rede_size[direto.login]
        })
    }

    function getFormattedData(login){
        let diretos = networksFormatted.filter(item => item.referred == login);

        diretos.forEach((direto) => {
            formattedData.push([direto.referred, direto.login])
            getDiretos(direto.login)
        })

        getCalcRede(login)
    }

    function formatData(){
        formattedData = []

        console.log(window.innerWidth)
        if(window.innerWidth <= 400) {
            fontsizeWidth = '11px'
            niveisPorVez = 2
            nodeWidthSize = 150
        } else {
            fontsizeWidth = '15px'
            niveisPorVez = 3
            nodeWidthSize = 200
        }

        getFormattedData(pointNameFirst);
        console.log('level atual: ' + levelUsuarioFirst)
        console.log(formattedData)
        if(formattedData.length >= 300) {
            sizeRedeWidth = formattedData.length * 5
            sizeRedeHeight = formattedData.length * 30
        } else if(formattedData.length >= 100) {
            sizeRedeWidth = formattedData.length * 15
            sizeRedeHeight = formattedData.length * 20
        } else {
            sizeRedeWidth = ''
            sizeRedeHeight = ''
        }

        for (let i = 1; i < 10; i++) {
            const levelConfig = {
                level: i,
                levelIsConstant: i == 1 ? false : true,
                colorByPoint: i == 2 ? true : false,
                colorVariation: {
                            key: 'brightness',
                            to: i == 3 ? -0.5 : i > 3 ? 0.5 : -0.5
                        },
            };

            levelsConfig.push(levelConfig);
        }

        nodesConfig = formattedData.map((network, index) => ({
            id: network.login,
            name: network.login,
            color: index == 0 ? '#C4B1A0' : '#DEDDCF', // Exemplo de configuração específicacolorByPoint: false,
            dataLabels: {
                color: 'white'
            },
            borderColor: '#919191',
        }));



        return true;
    }
    function calculateMargin(formattedDataLength, screenSize) {
        const maxMargin = (800 * 40) / 100;
        const minMargin = 20;

        if (formattedDataLength <= 3) {
            return maxMargin;
        }

        const margin = maxMargin - ((formattedDataLength - 3) * ((maxMargin - minMargin) / 26));

        return Math.max(minMargin, Math.round(margin));
    }

    async function renderizarHighCharts(){
       await formatData()
        const marginTopBottom = calculateMargin(formattedData.length);

        Highcharts.chart('container', {
            chart: {
                inverted: false,
                marginBottom: marginTopBottom,
                marginTop: marginTopBottom,
                height: 800,
                width: sizeRedeWidth,
            },

            title: {
            text: 'Rede'
        },

        plotOptions: {
                series: {
                    dataLabels: {
                        nodeFormatter: function() {
                            let user_now = networks.filter( item => item.login == this.point.name )
                            var html = '<div class="highcharts-node-content funct-search-by-login" title="'+this.point.name+'" ' +
                                'style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;display:flex; align-items: center; height: 100%; justify-content: center;">' +
                                '<b style="margin-right: 20px; font-size: '+fontsizeWidth+';">' + this.point.name + '</b>' +
                                '<b style="font-size: '+fontsizeWidth+';" class="d-flex align-items-center"><i class="fas fa-network-wired mr-2"></i> <span>'+ (rede_size[this.point.name]  <= 0 ? 0 : rede_size[this.point.name]) + '</span>'+(user_now[0].active ? '<i class="fas fa-star icon-active ml-2" title="Ativo"></i>': '')+'</b>' +
                                '</div>';
                            return html;
                        }
                    }
                }
            },

            accessibility: {
                point: {
                    descriptionFormat: '{toNode.name} ' +
                        '{#if (eq toNode.level 1 )} is a distinct family within the ' +
                        'order of {fromNode.id}. {toNode.custom.info}{/if}' +
                        '{#if (eq toNode.level 2 )} is a genus within the {fromNode.id}. ' +
                        '{toNode.custom.info} {/if}' +
                        '{#if (eq toNode.level 3 )} is a species within the ' +
                        '{fromNode.id}. {toNode.custom.info} {/if}'
                }
            },


        series: [{
            type: 'organization',
            name: 'Highsoft',
            keys: ['from', 'to'],
            data: formattedData,
            levels: levelsConfig,
            nodes: nodesConfig,
            colorByPoint: false,
            color: '#007ad0',
            dataLabels: {
                color: 'white'
            },
            borderColor: 'white',
            nodeWidth: nodeWidthSize,
        }],
        tooltip: {
            outside: true
        },
        exporting: {
            allowHTML: true,
            sourceWidth: 800,
            sourceHeight: 600
        }
        });
        setTimeout(() => {
            document.getElementById('container').style.overflow = 'visible';
        }, 3000);

        const allChartCards = document.querySelectorAll('.funct-search-by-login');
            allChartCards.forEach((elemento) => {
            elemento.addEventListener('click', function() {
                updateChartsByLogin(this.title);
            });
        });
    }


    function zoomOut() {
        const element = document.getElementById('container');
        element.style.zoom = 0.25
    }

    function zoomIn() {
        const element = document.getElementById('container');
        element.style.zoom = 1
    }

    renderizarHighCharts()

    function updateChartsByLogin(login){
        console.log(login + ': ' + rede_size[login])
        if(rede_size[login] > 0 && pointNameFirst != login){
            pointNameFirst = login

            levelUsuarioFirst = networks.filter(item => item.login === pointNameFirst).map(item => item.level);

            renderizarHighCharts()

        }
    }

</script>
@endif

@stop
