
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <title>IoTProject</title>
        
        <link rel="stylesheet" href="css/jquery.mobile-1.4.2.min.css" />
        <script src="js/jquery.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>

        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body> 
        <script type="text/javascript" src="test.json"></script>
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

        <div id='Trangdieukhien' data-role='page'>
            <div data-role='header'>
                <h1>IoTProject</h1>
            </div>

            <div data-role="content">
                <h1>Data</h1>
                <h4>
                    <a style="margin-left:8%; color: #050505" class="ui-link"> Nhiệt độ(°C) </a>
                    <a style="margin-left: 5%;color: #050505" class="ui-link"> Độ ẩm(%) </a>
                    <a style="margin-left: 5%;color: #050505" class="ui-link"> Ánh sáng(lx) </a>
                </h4>

                <div id = 'CamBienSHT31'>
                    <a  id='NoiDungGiamSat1'>
                        <h2>
                            <!-- <a id="HienThiGiaTriNhietDo" style="margin-left:12%" class="ui-link"></a><a id="HienThiGiaTriDoAm" style="margin-left:24%" class="ui-link"></a><a id="HienThiGiaTriAnhSang" style="margin-left:36%" class="ui-link"></a></h2></a><h2><a id="NoiDungGiamSat1" class="ui-link"></a> -->
                            <a id="GiaTriNhietDo" style="margin-left:10%" class="ui-link">0</a>
                            <a id="GiaTriDoAm" style="margin-left: 10%;" class="ui-link">0</a>
                            <a id="GiaTriAnhSang" style="margin-left: 10%;" class="ui-link">0</a>
                        </h2>
                    </a>

                    <!-- <button class="button" onclick="window.location.href='toggle.php'" style="color: white; background-color: black">Toggle Relay</button> -->
                </div>

                <!-- <form name="form" id="ButtonRelay1"> -->
                <?php
                    require('connectdb.php');

                    $sql = "SELECT * FROM `DataModeIoTProject` WHERE 1";
                
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $Relay = $row["K1"];
                            if($Relay == 1){
                ?>
                                <!-- <button id="ButtonRelay1" class="button" onclick="ToggleRelay()" style="color: white; background-color: black">ON</button> -->
                                <button onclick="ToggleRelay()" style="color: white; background-color: white">
                                    <img id="ButtonRelay1" src="/img/BtnOn.png" width="100" height="100">
                                </button>
                                
                                <!-- <div class="center" id="ButtonRelay1">
                                    <div class="outer1 circle">
                                        <button onclick="ToggleRelay()">ON</button>
                                    </div>
                                </div> -->
                <?php
                            }
                            else if($Relay == 0){
                ?>
                                <button onclick="ToggleRelay()" style="color: white; background-color: white">
                                    <img id="ButtonRelay1" src="/img/BtnOff.png" width="100" height="100">
                                </button>

                                <!-- <img id="ButtonRelay1" src="/img/BtnOff.png" width="60" height="60"> -->
                                <!-- <button id="ButtonRelay1" class="button" onclick="ToggleRelay()" style="color: white; background-color: black">OFF</button> -->
                                <!-- <div class="center" id="ButtonRelay1">
                                    <div class="outer circle">
                                        <button onclick="ToggleRelay()">OFF</button>
                                    </div>
                                </div> -->
                <?php
                            }
                        }
                        $result->free();
                    }
                
                    $conn->close();	
                ?>
                <!-- </form> -->

                
                
                <!-- <button class="button" onclick="ToggleRelay()" style="color: white; background-color: black">Toggle</button> -->

            </div>

            <div data-role='footer' class='ui-footer ui-footer-fixed'>
                <div data-role='navbar'>
                    <ul class='cam'>
                        <li><a id='cam' onclick="window.location.href='download.php'" class='ui-btn ui-shadow ui-corner-all ui-btn-icon-top ui-icon-check'>Download</a></li>
                        <li><a id='cam' onclick='ToggleRelay()' class='ui-btn ui-shadow ui-corner-all ui-btn-icon-top ui-icon-check'>Toggle</a></li>
                    </ul>
                </div>
            </div>

            <script>
                CapNhatGiaTriCamBien();
                var myVar = setInterval(myTimer, 500);
                function myTimer() {
                    CapNhatGiaTriCamBien();
                }
            </script>
        </div>  
        
        

    </body>
</html>