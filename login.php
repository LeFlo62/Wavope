<?php

	include 'navbar.php';
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

    <link rel="stylesheet" href="./css/styleSwiperCard.css">
    <link rel="stylesheet" href="./css/styleAnimationOnScroll.css">
    <link rel="stylesheet" href="./css/styleLogin.css">
</head>
<body>
	
<section class="SectionTopPage">
<svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>
<div class="box">
<h2>CONNECTEZ-VOUS</h2>
<div class="blockFormulaire">
            <form action="#" method="post">
                
                <div class="blockTextInput">
                    <label for="emailField">Email*  </label>
                    <input class="search-input" type="text" id="emailField" name="emailTextField" required
                        minlength="4" maxlength="8" size="10">
                </div>


                <div class="blockTextInput">
                    <label for="passwordField">Mot de passe*</label>
                    <input class="search-input" type="text" id="passwordField" name="passwordField" required
                        minlength="4" maxlength="8" size="10">
                </div>

                
                <!-- </div> -->
                <div class="blockButtonSendMessage">
					
                    <a href="#" class="square_btn2">SE CONNECTER</a>
					
					<div class="pasIncrit"><a href="inscription.php">Pas encore inscrit?</a></div>
                </div>
            </form>
        </div>
		</div>

</body>
</html>