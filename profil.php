<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/styleProfil.css"/>
</head>

<body>

	<?php include 'navbar.php' ?>

	<div class="manage">
		<h1> Gérer son profil </h1>

		<form id="profil" method="post" action="php/profil.php" class="profileForm">
			<label class="fieldInput">Adresse e-mail actuelle*<input type="email" name="email" id="nameUtilisateur" placeholder="mail@example.com"/></label>
			<label class="fieldInput">Mot de passe actuelle*<input name="password" id="passwordUtilisateur" type="password" /></label>
			<label class="fieldInput">Modifier son prénom*<input type="text" name="firstname" id="nameUtilisateur" placeholder="Dupont"/></label>
			<label class="fieldInput">Modifier son nom*<input type="text" name="lastname" id="nameUtilisateur" placeholder="Dupont"/></label>
	</div>

</body>

</html>