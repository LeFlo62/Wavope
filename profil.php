<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/styleProfil.css"/>
</head>

<body>

	<?php include 'navbar.php' ?>
	<svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

	<div class="blockInformation">
		<div class="information">
			<h1> Gérer son profil </h1>
			<form id="profil" method="post" action="php/profil.php" class="profileForm">
				<div class="blockText">
					<label for="firstname">Prénom
					<input class="fieldInput" type="text" name="firstname" id="nameUtilisateur" placeholder="Jean"/></label>
				</div>

				<div class="blockText">
					<label for="lastname">Nom
					<input class="fieldInput" type="text" name="lastname" id="nameUtilisateur" placeholder="Dupont"/></label>
				</div>

				<div class="blockText">
					<label for="birthdate">Date de naissance
					<input class="fieldInput" type="date" name="birthdate" id="nameUtilisateur"/></label>
				</div>
			
				<div class="button">
            		<input type="submit" class="buttonModif" name="buttonModified" value="Modifier"/>
            	</div>
			</form>
		</div>
	</div>

</body>

</html>