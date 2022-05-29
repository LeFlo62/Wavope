<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmation d'inscription</title>
        
        <link rel="stylesheet" href="/css/styleResetpassword.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>

    </head>
    <body>	
        <?php include 'navbar.php'; ?>
        <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        <div id="snackbar"></div>

        <div class="box">
            <div class="blockFormulaire">
                <?php
                    if(isset($success)){
                        echo '<h1>Inscription confirmée</h1>
                        <p>Merci d\'avoir confirmé votre inscription sur Wavope !</p>';
                    } else if(isset($cancel)){
                        echo '<h1>Inscription annulée</h1>
                        <p>Nous sommes désolé de l\'inconvénient.</p>';
                    } else {
                        echo '<h1>Une erreur est survenue...</h1>
                        <p>Il est probable que le token d\'inscription soit invalide.</p>';
                    }
                ?>
            </div>
		</div>
    </body>
</html>