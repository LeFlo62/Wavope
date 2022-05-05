<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }

    if(isset($_SESSION['id'])) { 
        header("Location: /");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <link rel="stylesheet" href="./css/styleLogin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>	
        <?php include 'navbar.php'; ?>
        <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

        <div class="box">
            <div class="blockFormulaire">
                <?php
                    if(isset($_GET['registrationSuccess'])){
                        echo '<p class="registrationInfo">Confirmez votre compte dans votre e-mail.</p>';
                    }

                    if(isset($_GET['error'])){
                        echo '<p class="error">';
                        switch($_GET['error']){
                            case 'completion':
                                echo 'Vous devez compléter tous les champs !';
                                break;
                            case 'missing':
                                echo 'Ce compte n\'existe pas !';
                                break;
                            case 'validation':
                                echo 'Vous devez passer par ce formulaire !';
                                break;
                            case 'password':
                                echo 'Mot de passe incorrecte !';
                                break;
                            case 'confirmation':
                                echo 'Votre compte n\'a pas été confirmé !';
                                break;
                        }
                        echo '</p>';
                    }
                ?>
                <h1>CONNECTEZ-VOUS</h1>
                <form class="formulaire" action="php/login.php" method="post">
                    
                    <div class="blockTextInput">
                        <label for="emailField">Email*</label>
                        <input class="search-input" type="email" id="emailField" name="email" required>
                    </div>


                    <div class="blockTextInput">
                        <label for="passwordField">Mot de passe*</label>
                        <input class="search-input" type="password" id="passwordField" name="password" required>
                    </div>

                    <div class="blockButtonSendMessage">
                        <input type="submit" name="login" class="square_btn2" value="SE CONNECTER"/>
                        
                        <div class="sublinks">
                            <a href="resetpassword.php?r=f">Mot de passe oublié ?</a><br/>
                            <a href="inscription.php">Pas encore inscrit?</a>
                        </div>
                    </div>
                </form>
            </div>
		</div>
    </body>
</html>