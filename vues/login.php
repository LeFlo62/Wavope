<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="icon" type="image/x-icon" href="/Images/infinitemeasures.ico">

        <link rel="stylesheet" href="/css/styleLogin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>	
        <?php include 'navbar.php'; ?>
        
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
                            case 'banned':
                                echo 'Votre compte est banni.';
                                break;
                        }
                        echo '</p>';
                    }
                ?>
                <h1>CONNECTEZ-VOUS</h1>
                <form class="formulaire" action="/php/login.php" method="post">
                    
                    <div class="blockTextInput">
                        <label for="emailField">Email</label>
                        <input class="search-input" type="email" id="emailField" name="email" required>
                    </div>


                    <div class="blockTextInput">
                        <label for="passwordField">Mot de passe</label>
                        <input class="search-input" type="password" id="passwordField" name="password" required>
                    </div>

                    <div class="blockButtonSendMessage">
                        <input type="submit" name="login" class="square_btn2" value="SE CONNECTER"/>
                        
                        <div class="sublinks">
                            <a href="/resetpassword?r=f">Mot de passe oublié ?</a><br/>
                            <a href="/inscription">&nbsp;&nbsp;Pas encore inscrit?</a>
                        </div>
                    </div>
                </form>
            </div>
		</div>
    </body>
    <?php include 'footer.php' ?>
</html>