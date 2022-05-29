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
    <?php include 'footer.php' ?>
</html>