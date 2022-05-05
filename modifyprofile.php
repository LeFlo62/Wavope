<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        header("Location: /login.php");
        exit;
    }

    include_once './php/mysql.php';

    $bdh = new DBHandler();
    $requserdata = $bdh->getInstance()->prepare('SELECT * FROM user_data WHERE user_id = :user_id');
    $requserdata->bindparam('user_id', $_SESSION['id'], PDO::PARAM_INT);
    $requserdata->execute();
    $userdata = $requserdata->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/styleProfil.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="box">
            <?php include 'navbar.php' ?>
            <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

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

                        <div class="button">
                            <input type="submit" name="buttonModified" class="buttonModif" value="MODIFIER"/>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>