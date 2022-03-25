
<!DOCTYPE html>
<html lang="en" style="scroll-behavior:smooth;">
<head>
    <meta charset="UTF-8"/>  
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>INSCRIPTION</title>
    
    <link rel="stylesheet" href="/css/styleInscription.css"/>
    

</head>
<body>

    <?php include 'navbar.php' ?>
    
    <div class="block">
        <div class="block1"></div>   
        <p id="ErrorMdp">Les mots de passe ne correspondent pas !</p>
        <p id="ChampIncomplet">Tous les champs obligatoires ne sont pas renseignés.</p>
        
        <div class="block2">

            <h1>Inscrivez-vous !</h1>
            
            <form id="inscription" method="post" action="php/inscription.php"  class="InscriptionForm">
            
                <label class="fieldInput">E-mail*<input type="email" name="username" id="nameUtilisateur" placeholder=" exemple.mail@gmail.fr"/></label>
                <label class="fieldInput">Mot de passe*<input name="password" id="passwordUtilisateur" type="password" /></label>
                <label class="fieldInput">Confirmation du Mot de passe*<input id="nameUtilisateur2" type="password" /></label>
            
                <div class=boiteCheck>
                    <input class="checkboxClass"  type="checkbox" id="chbox1" name="chbox1">
                    <label class="checkboxClass" for="chbox1"> Je souhaite recevoir la newsletter </label><br>
                    <input class="checkboxClass"  type="checkbox" id="chbox2" name="chbox2">
                    <label for="chbox2" > J'accepte la politique de confidentialité * </label>  
                </div>
                
                <div class="divbtnCo">
                    <input id="btnCo" type="submit" name="forminscription" value="S'inscrire" onclick="errorMdp()"/>
                </div>
            </form>
            <p class="alreadySubscrire">Deja inscrit? <a href="logementInscription.php">Se connecter</a></p>
        </div>
    </div>
      <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg> 
</body>
    
</html>
    
