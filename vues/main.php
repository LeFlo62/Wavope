<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="./Images/infinitemeasures.ico">
        <title>Wavope</title>
        <link rel="stylesheet" href="./css/styleButton.css">
        <link rel="stylesheet" href="./css/styleSwiperCard.css">
        <link rel="stylesheet" href="./css/styleMain.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <?php include 'navbar.php' ?>

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

                <?php
                    foreach($cards as $card){
                        echo '<div class="card">
                        <p class="card-title"> '. $card['title'] .'</p>
                        <p class="card-date"> ' . $card['date'] . '</p>
                        <p class="card-preview">' . $card['content'] . '</p>
                    </div>';
                    }
                ?>

            </div>
        </div>


        <script type="text/javascript" src="./js/revealDefilementScript.js"> </script>
    </body>
    <?php include 'footer.php' ?>
</html>



