
<!DOCTYPE html>
<html lang="fr" style="scroll-behavior:smooth;">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>

        <link rel="stylesheet" href="./css/styleRegister.css">
    </head>
    <body>
        <?php include 'navbar.php' ?>
        <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg> 

        <div class="box">
           

            <div class="blockFormulaire">
                <h1>Inscrivez-vous !</h1>
                
                <form id="inscription" method="post" action="php/inscription.php" class="formulaire">
                        <div class="blockTextInput">
                            <label for="email">E-mail*</label>
                            <input class="fieldInput" type="email" name="email" id="email" placeholder="mail@example.com"/>
                        </div>
                        <div class="blockTextInput">
                            <label for="firstname">Prénom*</label>
                            <input class="fieldInput" type="text" name="firstname" id="firstname" placeholder="Jean"/>
                        </div>
                        <div class="blockTextInput">
                            <label for="lastname">Nom*</label>
                            <input class="fieldInput" type="text" name="lastname" id="nameUtilisateur" placeholder="Dupont"/>
                        </div>
                        <div class="blockTextInput">
                            <label for="birthdate">Date de naissance*</label>
                            <input class="fieldInput" type="date" name="birthdate" id="birthdate"/>
                        </div>
                        <div class="blockTextInput">
                            <label for="password">Mot de passe*</label>
                            <input class="fieldInput" name="password" id="password" type="password" />
                        </div>
                        <div class="blockTextInput">
                            <label for="passwordCheck">Confirmation du Mot de passe*</label>
                            <input class="fieldInput" id="passwordCheck" type="password" />
                        </div>

                        <div class=boiteCheck>
                            <input class="checkboxClass"  type="checkbox" id="chbox2" name="cgu">
                            <label for="chbox2" > J'accepte la politique de confidentialité * </label>
                        </div>
                        
                        <div class="divbtnCo">
                            <input type="submit" name="forminscription" class="square_btn2" value="S'INSCRIRE"/>
                        </div>
                </form>
                <p class="alreadySubscrire">Deja inscrit? <a href="logementInscription.php">Se connecter</a></p>
            </div>
        </div>
    </body>    
</html>
    
