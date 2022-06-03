<!DOCTYPE html>
<html lang="fr" style="scroll-behavior:smooth;">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="icon" type="image/x-icon" href="/Images/infinitemeasures.ico">
        
        <link rel="stylesheet" href="/css/styleRegister.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
        <script src="/js/functionVerifPaswordInscription.js"></script>
    </head>
    <body>
        <?php include 'navbar.php' ?>
        <div class="box">
           

            <div class="blockFormulaire">
                <?php
                    if(isset($_GET['error'])){
                        echo '<p class="error">';
                        switch($_GET['error']){
                            case 'completion':
                                echo 'Vous devez compléter tous les champs !';
                                break;
                            case 'user_exists':
                                echo 'Un compte existe déjà avec cette adresse E-Mail !';
                                break;
                            case 'product_number':
                                echo 'Le Numéro Produit est invalide !';
                                break;
                            case 'number_registered':
                                echo 'Ce numéro produit est déjà enregistré !';
                                break;
                            case 'passwords':
                                echo 'Les mots de passes ne sont pas identiques !';
                                break;
                        }
                        echo '</p>';
                    }
                ?>
                <h1>Inscrivez-vous !</h1>
                
                <form id="inscription" method="post" action="/php/inscription.php">
                        <div class="blockTextInput">
                            <label for="email" required>E-mail</label>
                            <input class="fieldInput" type="email" name="email" id="email" placeholder="mail@example.com"/>
                        </div>
                        <div class="blockTextInput">
                            <label for="firstname" required>Prénom</label>
                            <input class="fieldInput" type="text" name="firstname" id="firstname" placeholder="Jean"/>
                        </div>
                        <div class="blockTextInput">
                            <label for="lastname" required>Nom</label>
                            <input class="fieldInput" type="text" name="lastname" id="nameUtilisateur" placeholder="Dupont"/>
                        </div>
                        <div class="blockTextInput">
                            <label for="birthdate" required>Date de naissance</label>
                            <input class="fieldInput" type="date" name="birthdate" id="birthdate"/>
                        </div>
                        <div class="blockTextInput">
                            <label for="password" required>Mot de passe</label>
                            <input class="fieldInput" name="password" id="password" type="password" />
                            <span id= "span1"style="color: red;">&nbsp; </span>
                        </div>
                        <div class="blockTextInput">
                            <label for="passwordCheck" required>Confirmation du Mot de passe</label>
                            <input class="fieldInput" name="password_check" id="passwordCheck" type="password" />
                            <span id= "span2"style="color: red;">&nbsp;&nbsp; </span>
                        </div>
                        <div class="blockTextInput">
                            <label for="productnumber" required>Numéro Produit</label>
                            <input class="fieldInput" type="text" name="productnumber" id="productnumber" placeholder="123456789"/>
                        </div>
                        <div class=boiteCheck>
                            <input class="checkboxClass"  type="checkbox" id="chbox2" name="cgu">
                            <label for="chbox2" required> J'accepte la politique de confidentialité</label>
                        </div>
                        
                        <div class="register">
                            <input type="submit" name="forminscription" class="submit_btn" value="S'INSCRIRE"/>
                        </div>
                </form>
                <p class="alreadySubscrire">Deja inscrit? <a href="/login">Se connecter</a></p>
            </div>
            <script src="/js/inscription.js"></script>
        </div>
    </body>
    <?php include 'footer.php' ?>
</html>