
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
        <div class="blockmarks">
            <div id="mark">Votre score : <span id="realmark">0</span> point(s)</div>
            <div id="podium"> 
                
        </div>
    </section>

    <section class="blockGameWindow">
        <h1 font-family= "Roboto", sans-serif> Bienvenue sur le jeu ! (touche "espace" pour commencer)</h1>
        <div class="gameWindow">
            <div class="blockPoint">
                vous avez : <span id="point">0</span> point(s)
            </div>
            <img id="playerSprite" src="./Images/gameSprite/playerSprite.png" alt="playerSprite">
            <img id="obstacle" src="./Images/gameSprite/plastic.png">
        </div>
    </section>


    <script type="text/javascript" src="./js/functionQuizz.js"></script>

</body>
</html>