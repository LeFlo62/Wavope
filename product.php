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