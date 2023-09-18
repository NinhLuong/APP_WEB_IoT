<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <title>IoTProject</title>


        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        
        <link rel="stylesheet" href="css/jquery.mobile-1.4.2.min.css" />
        <script src="js/jquery.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>
        <!-- <link rel="stylesheet" href="css/index.css"> -->

        <style>
            .highcharts-figure,
            .highcharts-data-table table {
            min-width: 320px;
            max-width: 800px;
            margin: 1em auto;
            }
            #container {
                height: 400px;
                background-color: transparent;
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

            .button {
                display: inline-block;
                padding: 15px 25px;
                font-size: 24px;
                cursor: pointer;
                text-align: center;
                text-decoration: none;
                outline: none;
                color: #fff;
                background-color: #4CAF50;
                border: none;
                border-radius: 15px;
                box-shadow: 0 9px #999;
            }

            .button:hover {background-color: #3e8e41}

            .button:active {
                background-color: #3e8e41;
                box-shadow: 0 5px #666;
                transform: translateY(4px);
            }

            #backgroundimage
            {
                height: 100%;
                left: 0;
                margin: 0;
                padding: 0;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: -1;
            }  
            #mainpage
            {
                background-image: url('/img/bg.png');  
                background-size: 100vw 60vh;
                background-repeat: no-repeat; 

                background-color: #e7f1fd
            }
            
            #PageHeader
            {
                background-color: transparent;
                border: 0;
            }

            table, th, td {
                border:0px solid black;
                border-spacing: 10px;
            }

            #TableChart
            {
                border-spacing: 0px;
            }

        </style>

    </head>
    <body align="center"> 
        <script src="js/index.js"></script>
        <!-- Khóa chức năng viewsource -->
        <script>
            document.addEventListener('contextmenu', event => event.preventDefault());
            document.addEventListener('keydown', function (event){
                if (event.ctrlKey){
                    event.preventDefault();
                }
                if(event.keyCode == 123){
                    event.preventDefault();
                }
            });

            node.addEventListener('contextmenu', function(e){
                e.preventDefault();
            });
        </script>
        <!-- Khóa chức năng viewsource -->
        
        <div id = "mainpage" data-role='page' style='display: inherit'>
            <div id = "PageHeader" data-role='header' style="color:white; width:100%; text-align: center">
                <h1 id="TenThietBi" style="color:white;">Thiết Bị</h1>
            </div>

            <div data-role="content">
                <table style="width:100%">
                    <tr >
                        <th style="background:white; border-radius: 20px; width:33%; height: 150px;">
                            <div style="width:100%; height: 100%;">

                                <div style="width:100%; height: 15px;"></div>
                                <div style="width:100%; height: 20px; font-size: 15px;">
                                    Nhiệt Độ
                                </div>

                                <div style="width:100%; height: 50px; text-align:center;">
                                    <img src="/img/Temp.png" width="50px" height="50px">
                                </div>

                                <div style="width:100%; height: 5px;"></div>
                                <div id="GiaTriNhietDo" style="width:100%; height: 20px; font-size: 18px;">0</div>
                                <div style="width:100%; height: 5px;"></div>
                                <div style="width:100%; height: 20px;">(°C)</div>
                                
                            </div> 
                            
                        </th>
                        <th style="background:white; border-radius: 20px; width:33%; height: 150px;">

                            <div style="width:100%; height: 100%;">
                                
                                <div style="width:100%; height: 15px;"></div>
                                <div style="width:100%; height: 20px; font-size: 15px;">
                                    Độ Ẩm
                                </div>

                                <div style="width:100%; height: 50px; text-align:center;">
                                    <img src="/img/doam.png" width="50px" height="50px">
                                </div>

                                <div style="width:100%; height: 5px;"></div>
                                <div id="GiaTriDoAm" style="width:100%; height: 20px; font-size: 18px;">0</div>
                                <div style="width:100%; height: 5px;"></div>
                                <div style="width:100%; height: 20px;">(%)</div>
                                
                            </div>

                        </th>
                        <th style="background:white; border-radius: 20px; width:33%; height: 150px;">
                            
                        <div style="width:100%; height: 100%;">
                                
                                <div style="width:100%; height: 15px;"></div>
                                <div style="width:100%; height: 20px; font-size: 15px;">
                                    Ánh Sáng
                                </div>

                                <div style="width:100%; height: 50px; text-align:center;">
                                    <img src="/img/anhsang.png" width="50px" height="50px">
                                </div>

                                <div style="width:100%; height: 5px;"></div>
                                <div id="GiaTriAnhSang" style="width:100%; height: 20px; font-size: 18px;">0</div>
                                <div style="width:100%; height: 5px;"></div>
                                <div style="width:100%; height: 20px;">(lx)</div>
                                
                            </div>    
                        </th>
                    </tr>
                </table>

                <div style="background:white; border-radius: 20px; width:100%; height: 260px;">
                    <div style="width:95%; height: 10px; margin-left: auto; margin-right: auto;"> </div>
                    <div id="Chart1" style="background:black; width:95%; height: 240px; margin-left: auto; margin-right: auto; "> </div>
                    <!-- <div id="Chart1" style="width:90%; height: 240px; position: absolute; top: 56%; left: 50%; transform: translate(-50%, -50%); "></div> -->
                </div>

                <br>

                <div style="background:white; border-radius: 20px; width:100%;">
                    <img id="ButtonRelay1" src="/img/IMGBtnOn.png" onclick="ToggleRelay()" width="100" height="100">
                </div>
            </div>
            <div data-role='footer' class='ui-footer ui-footer-fixed'>
            </div>
        </div> 

        <script>
            Highcharts.chart('Chart1', {
                chart: {
                    // height: 240,
                    type: 'spline',
                    animation: Highcharts.svg, // don't animate in old IE
                    marginRight: 10,
                    events: {
                        load: function () {
                            // set up the updating of the chart each second
                            var seriesNhietDo = this.series[0];
                            var seriesDoAm = this.series[1];
                            var seriesAnhSang = this.series[2];
                    
                            var lastx;
                            setInterval(function () {
                                var url = 'data.php';
                                $.getJSON(url).done(function(data) {
                                    $.each(data, function (index, json) {  
                                        var thietbi = json.ThietBi;
                                        $("#TenThietBi").html("IMEI: " + thietbi);

                                        var giatrithoigian = json.ThoiGian;
                                        var date = new Date(giatrithoigian);
                                        var x = date.getTime();
                                        
                                        var giatrinhietdo = parseFloat(json.NhietDo);
                                        $("#GiaTriNhietDo").html(giatrinhietdo);
                                        var giatridoam	= parseFloat(json.DoAm);
                                        $("#GiaTriDoAm").html(giatridoam);
                                        var giatrianhsang = parseFloat(json.AnhSang);
                                        $("#GiaTriAnhSang").html(giatrianhsang);
                                        console.log(giatrithoigian);
                                        console.log(x);
                                        console.log(giatrinhietdo);
                                        console.log(giatridoam);
                                        console.log(giatrianhsang);
                                        
                                        if(x != lastx){
                                            seriesNhietDo.addPoint([x, giatrinhietdo], true, true);
                                            seriesDoAm.addPoint([x, giatridoam], true, true);
                                            seriesAnhSang.addPoint([x, giatrianhsang], true, true);
                                            lastx = x;
                                        }
                                    });
                                });

                                $.getJSON('relay.php').done(function(data) {
                                    $.each(data, function (index, json) {  
                                        var relay = parseInt(json.Relay1);
                                        if(relay == 1){
                                            console.log("ON");
                                            // $("#ButtonRelay1").html("ON");
                                            document.getElementById('ButtonRelay1').src = '/img/IMGBtnOn.png';
                                        }
                                        else if(relay == 0){
                                            console.log("OFF");
                                            // $("#ButtonRelay1").html("OFF");
                                            document.getElementById('ButtonRelay1').src = '/img/IMGBtnOff.png';
                                        } 
                                    });
                                });

                            }, 1000);
                        }
                    }
                },
                time: {
                    useUTC: false
                },
                title: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true,
                        minAnnounceInterval: 15000,
                        announcementFormatter: function (allSeries, newSeries, newPoint) {
                            if (newPoint) {
                                return 'New point added. Value: ' + newPoint.y;
                            }
                            return false;
                        }
                    }
                },

                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 40
                },

                yAxis: {
                    title: {
                        text: ''
                    }
                },

                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: false
                        },
                        enableMouseTracking: true
                    }
                },

                tooltip: {
                    fontSize: '14px',
                    xDateFormat: 'Ngày: %d/%m/%Y <br> Thời gian: %H:%M:%S',
                    shared: true
                },

                //Enable label
                legend: {
                    enabled: true,
                    itemStyle: {
                        fontSize:'10px',
                        // font: '20pt Trebuchet MS, Verdana, sans-serif',
                        // color: '#A0A0A0'
                    }
                },
                //Tắt dấu =
                exporting: {
                    enabled: false
                },

                series: [{
                    name: 'Nhiệt Độ(°C)',
                    data: (function () {
                    // generate an array of random data
                        var data = [], time = (new Date()).getTime(), i;
                        for (i = -19; i <= 0; i += 1) {
                            data.push({
                                x: time + i * 1000,
                                y: 0
                            });
                        }
                        return data;
                    }())
                },{
                    name: 'Độ Ẩm(%)',
                    data: (function () {
                    // generate an array of random data
                        var data = [], time = (new Date()).getTime(), i;
                        for (i = -19; i <= 0; i += 1) {
                            data.push({
                                x: time + i * 1000,
                                y: 0
                            });
                        }
                        return data;
                    }())
                },{
                    name: 'Ánh Sáng(lx)',
                    data: (function () {
                    // generate an array of random data
                        var data = [], time = (new Date()).getTime(), i;
                        for (i = -19; i <= 0; i += 1) {
                            data.push({
                                x: time + i * 1000,
                                y: 0
                            });
                        }
                        return data;
                    }())
                }]
            });
        </script> 
    </body>
</html>