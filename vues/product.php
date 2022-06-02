<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link rel="icon" type="image/x-icon" href="/Images/infinitemeasures.ico">

    <link rel="stylesheet" href="/css/styleProduct.css">
    <link rel="stylesheet" href="/css/styleProductMobileVersion.css">
    <link rel="stylesheet" href="/css/styleDialogBox.css">

    <script src="/js/npmchartjs.js"></script>
    <script type="text/javascript" src="/js/functionDrawGraph.js"></script>

</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="blockProfil">
        <div class="blockProfilImage">
            <img class="imageProfil" src="/Images/maxime.png">
        </div>
        <div class="blockProfilGestion">
            <span class="profilName"><?php echo  $_SESSION['firstname'];?></span>
            <p onclick="openDialogBox('dialogContainer')">Modifier le nom du produit</p>
        </div>
    </div>
    <?php
        function displayGraphs($sensors) {
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
        // $temperatureSensor = new Sensor("température",array("2022-04-29","2022-04-27","2022-05-02","2022-05-04","2022-04-29","2022-04-27"),array(20.5,21,16,18,19,19.5));
        // $sonoreSensor = new Sensor("Sonore",array("2022-05-05","2022-05-04","2022-05-03","2022-05-02","2022-05-04","2022-04-29","2022-04-27"),array(20.5,21,14,16,18,19,19.5),"bar");
        // $heartbeatSensor = new Sensor("Cardiaque",array("2022-05-05","2022-05-04","2022-05-03","2022-05-02","2022-05-04","2022-04-29","2022-04-27"),array(51,56,81,75,72,60,58));
        // $sensors=[$temperatureSensor,$sonoreSensor,$heartbeatSensor];
        // print_r($temperatureSensor);
        // print_r($sonoreSensor);
        displayGraphs($sensors);
    ?>


    <!-- DIALOG BOX : DEBUT -->
    <form action="/php/updateProductName" method="post">
    <input type="hidden" name="actualProductName" value="<?php echo '39544932';?>">
<div class="dialogBoxContainer" id="dialogContainer">

<div class="dialogBox">
<div class="blockTitre">
    Nouveau nom du produit
</div>
<div class="blockField">
    <input type="field" name="productName" class="field">
</div>

    
    <div class="blockButtons">
        <a  class="square_btn1"  onclick="closeDialogBox('dialogContainer')" >Annuler</a>
        <input type="submit" name="formProductName" class="square_btn1" value="Valider">
    </div>
</div>
</div>
</form>
<!-- DIALOG BOX : FIN -->
<script type="text/javascript" src="/js/functionDialogBox.js"></script>
    
</body>
</html>