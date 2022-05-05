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

    <?php include 'navbar.php'; ?>
    <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>


    <div class="blockProfil">
        <div class="blockProfilImage">
            <img class="imageProfil" src="./images/moi.png">
        </div>
        <div class="blockProfilGestion">
            <span class="profilName">Maxime NIGRIS</span>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Modifier le mot de passe</a>
        </div>
    </div>
    
    <section class="blockGraph">
        <div class="blockCanvasMyChart">
            <canvas id="myChart" ></canvas>
        </div>
    </section>

    <section class="blockGraph">

        <div class="blockCanvasMyChart">
            <canvas id="myChartt" ></canvas>
        </div> 
    </section>
        <script>
            drawChart("myChart",["Apr 11 2022", "Apr 12 2022","Thu Apr 12 2022", "Thu Apr 13 2022","Thu Apr 14 2022", "Thu Apr 12 2022"],[12, 19, 3, 50, 200, 300],"Evolution du stress")
        </script>
   
</body>
</html>


<style>

</style>