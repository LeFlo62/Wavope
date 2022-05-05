<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styleProduct.css">
    <link rel="stylesheet" href="./css/styleProductMobileVersion.css">

    <script src="./js/npmchartjs.js"></script>
    <script type="text/javascript" src="./js/functionDrawGraph.js"></script>

</head>
<body>

<<<<<<< Updated upstream
    <?php include 'navbar.php'; ?>
    <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

=======
>>>>>>> Stashed changes

    <div class="blockProfil">
        <div class="blockProfilImage">
            <img class="imageProfil" src="./images/Maxime.png">
        </div>
        <div class="blockProfilGestion">
            <span class="profilName">Maxime NIGRIS</span>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Modifier le mot de passe</a>
        </div>
    </div>
    <?php
        class Sensor {
            protected $sensorType; //type string
            protected $x; //type array
            protected  $y; //type array
            protected  $graphDisplay;
            function __construct($sensorType, $x, $y,$graphDisplay="line") {
                $this->sensorType = $sensorType;
                $this->x = $x;
                $this->y = $y;
                $this->graphDisplay = $graphDisplay; 
            }
            public function getX(){
                return implode(",", $this->x) ;
            }
            public function getY(){
                return implode(",", $this->y);
            }
            public function getType(){
                return $this->sensorType;
            }
            public function getGraphDisplay(){
                return $this->graphDisplay;
            }
        }

        function displayGraphs($sensors){
            for ($i =0; $i < count($sensors); $i++) {
                $sensorType=$sensors[$i]->getType();
                echo "<section class='blockGraph'>
                            <div class='blockCanvasMyChart'>
                                <canvas class='myChart' id='{$sensorType}' ></canvas>
                            </div>
                        </section>
                        <script>
                            drawChart('{$sensorType}',[{$sensors[$i]->getX()}],[{$sensors[$i]->getY()}],'Capteur {$sensorType} ',chartType='{$sensors[$i]->getGraphDisplay()}');
                        </script>";
            }
        };
        $temperatureSensor = new Sensor("température",array("2022-04-29","2022-04-27","2022-05-02","2022-05-04","2022-04-29","2022-04-27"),array(20.5,21,16,18,19,19.5));
        $sonoreSensor = new Sensor("Sonore",array("2022-05-05","2022-05-04","2022-05-03","2022-05-02","2022-05-04","2022-04-29","2022-04-27"),array(20.5,21,14,16,18,19,19.5),"bar");
        $heartbeatSensor = new Sensor("Cardiaque",array("2022-05-05","2022-05-04","2022-05-03","2022-05-02","2022-05-04","2022-04-29","2022-04-27"),array(51,56,81,75,72,60,58));
        $sensors=[$temperatureSensor,$sonoreSensor,$heartbeatSensor];
        displayGraphs($sensors);
    ?>
    
</body>
</html>


<style>

</style>