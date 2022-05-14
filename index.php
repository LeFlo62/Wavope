<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wavope</title>
        <link rel="stylesheet" href="./css/styleButton.css">
        <link rel="stylesheet" href="./css/styleSwiperCard.css">
        <link rel="stylesheet" href="./css/styleAnimationOnScroll.css">
        <link rel="stylesheet" href="./css/styleMain.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <?php include 'navbar.php' ?>
        <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

        <div class="jumbotron">
            <div class="home">
                <div class="title reveal">
                    <h1>WAVOPE</h1>
                </div>
                <div class="description reveal duration1" >
                    La société InfiniteMeasure développe un système complet de mesure de la qualité environnementale des personnes. 
                    Les différentes données sont récoltées et présentées dans le site. Des conseils de professionnels sont également disponibles
                    et vous pourrez avoir accès à un jeu ludique vous permettant de vous instruire sur cette thématique.
                </div>

                <?php
                    if(!isset($_SESSION['id'])) { 
                        echo '<div class="buttons">
                        <a href="inscription.php" class="register_button" >S\'INSCRIRE</a>
                        <a href="login.php" class="login_button">SE CONNECTER</a>
                            </div>';
                    }
                ?>    
            </div>

            <div class="cards">
                <div class="card">
                    <p class="card-title">Titre de la carte</p>
                    <p class="card-date">Le 18/05/2022</p>
                    <p class="card-preview">Le saviez-vous ? Pendant longtemp la femme la plus vielle du monde était française, mais ce titre est de plus en plus attribué aux femmes chinoises. Cette différence de longévité n'est pas encore connu de manière certaine. Cependant, nous pouvons attribuer cela au fait que en comparant la population, on remarque que la population chinoise est 20 fois suppérieure à celle de la France. Une personne sur cinq est chinoise.</p>
                </div>
                <div class="card">
                    <p class="card-title">Titre de la carte</p>
                    <p class="card-date">Le 18/05/2022</p>
                    <p class="card-preview">Le saviez-vous ? Pendant longtemp la femme la plus vielle du monde était française, mais ce titre est de plus en plus attribué aux femmes chinoises. Cette différence de longévité n'est pas encore connu de manière certaine. Cependant, nous pouvons attribuer cela au fait que en comparant la population, on remarque que la population chinoise est 20 fois suppérieure à celle de la France. Une personne sur cinq est chinoise.</p>
                </div>
                <div class="card">
                    <p class="card-title">Titre de la carte</p>
                    <p class="card-date">Le 18/05/2022</p>
                    <p class="card-preview">Le saviez-vous ? Pendant longtemp la femme la plus vielle du monde était française, mais ce titre est de plus en plus attribué aux femmes chinoises. Cette différence de longévité n'est pas encore connu de manière certaine. Cependant, nous pouvons attribuer cela au fait que en comparant la population, on remarque que la population chinoise est 20 fois suppérieure à celle de la France. Une personne sur cinq est chinoise.</p>
                </div>
            </div>
        </div>


        <script type="text/javascript" src="./js/revealDefilementScript.js"> </script>
    </body>
</html>



