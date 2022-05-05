<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu</title>
    <link rel="stylesheet" href="./css/styleQuizz.css">
    <script src="./js/gameFunctions.js"></script>
    <link rel="stylesheet" href="./css/styleGame.css">
</head>
<body>
    <?php include 'navbar.php' ?>
    <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>


    <section class="blockAllQuizz">
        <div class="blockQuizz">
            <div class="progress-container">
                <progress id="progressBar" max="100" value="0"></progress>
              </div>
              <span id="percentage">0%</span>
            <div id="question"></div>
            <div id ="answerBlock" class="answerBlock"> 
            </div>
        </div>
    </section>

    <section class="blockGameWindow">
        <h1> Bienvenue sur le jeu ! (touche "espace" pour commencer)</h1>
        <div class="gameWindow">
            <div class="blockPoint">
                vous avez : <span id="point">0</span> point(s)
            </div>
            <img id="playerSprite" src="" alt="playerSprite">
            <img id="obstacle" src="./Images/gameSprite/plastic.png">
        </div>
    </section>


    <script type="text/javascript" src="./js/functionQuizz.js"></script>

</body>
</html>