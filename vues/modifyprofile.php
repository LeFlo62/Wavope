<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/styleProfil.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="box">
            <?php include 'navbar.php' ?>
            <div class="blockInformation">
                <?php
                    if(isset($_GET['success'])){
                        echo '<p class="success">Informations modifiées !</p>';
                    }
                    
                    if(isset($_GET['error'])){
                        echo '<p class="error">';
                        switch($_GET['error']){
                            case 'completion':
                                echo 'Vous devez compléter tous les champs !';
                                break;
                            case 'validation':
                                echo 'Vous devez passer par ce formulaire !';
                                break;
                        }
                        echo '</p>';
                    }
                ?>
                <div class="information">
                    <h1>GERER SON PROFIL</h1>
                    <form class="profileForm" action="/php/modifyprofile.php" method="post">
                        <div class="blockText">
                            <label for="firstnameField">Prénom</label>
                            <input class="fieldInput" type="text" id="firstname" name="firstname" required placeholder="Jean" value="<?php
                                    echo $userdata['firstname'];
                                ?>">
                        </div>


                        <div class="blockText">
                            <label for="lastnameField">Nom</label>
                            <input class="fieldInput" type="text" id="lastname" name="lastname" required placeholder="Dupont" value="<?php
                                    echo $userdata['lastname'];
                                ?>">
                        </div>

                        <div class="blockText">
                            <label for="birthdateField">Date de naissance</label>
                            <input class="fieldInput" type="date" id="birthdate" name="birthdate" value="<?php
                                    echo $userdata['birthdate'];
                                ?>" required>
                        </div>

                        <div class="blockText">
                            <div class="sublinks">
                                <a href="/resetpassword?r=r">Changer de mot de passe</a><br/>
                            </div>
                        </div>

                        <div class="button">
                            <input type="submit" name="buttonModified" class="buttonModif" value="MODIFIER"/>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </body>
    <?php include 'footer.php' ?>
</html>