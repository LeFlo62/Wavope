<?php
    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';

    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';

    if(is_ajax()){
        check_user(1, true);
    
        if(isset($_POST) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['birthdate']) && isset($_POST['rank'])
            && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['birthdate']) && !empty($_POST['rank'])){
            $firstname = sanitize($_POST['firstname']);
            $lastname = sanitize($_POST['lastname']);
            $email = sanitize($_POST['email']);
            $birthdate = sanitize($_POST['birthdate']);
            $rank = sanitize($_POST['rank']);
            
            if(RANK_POWER[$rank] >= RANK_POWER[$_SESSION['user_rank']]){
                echo json_encode(array('return_type' => 'error', 'message' => 'Vous n\'avez pas la permission de faire cela.'));
                exit;
            }

            if(!userExistsByMail($email)){
                $rand_token = openssl_random_pseudo_bytes(64);
                $password = password_hash(base_convert($rand_token, 2, 36), PASSWORD_BCRYPT);

                $createdId = createUser($email, $password, $firstname, $lastname, $birthdate, $rank);

                echo json_encode(array('return_type' => 'success', 'message' => 'Utilisateur créé. Mot de passe aléatoire attribué.', 'data' => array($createdId)));

                sendCreationMail($email, $firstname . ' ' . $lastname);
            } else {
                echo json_encode(array('return_type' => 'error', 'message' => 'Un utilisateur existe déjà avec cette adresse e-mail.'));
            }
        } else {
            echo json_encode(array('return_type' => 'error', 'message' => 'Aucune donnée transmise'));
        }
    } else {
        echo json_encode(array('return_type' => 'error', 'message' => 'Mauvais protocol'));
    }

    function sanitize($donne){   
        $donne = trim($donne);
        $donne = stripslashes($donne);
        $donne = strip_tags($donne);
        $donne = htmlspecialchars($donne);
        return $donne;
    }

    /**
     * 
     * @return BOOl, true if ajax, false if regular way
     */
    function is_ajax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']);
    }

    function sendCreationMail($email, $name){
        sendMail($email,
                 $name,
                 'Création de compte sur Wavope. Changez votre mot de passe.',
                 '<link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
                <center style = "font-family: "Roboto", sans-serif;
                        font-size: 1rem;
                        padding: 0px;
                        margin: 0px;
                        background-color: white;">
                    <img style="width: 150px; height: auto;" src="https://i.imgur.com/6CFLqM7.png" />
                    <p>Un compte sur Wavope vous a été créé. Vous devez changer votre mot de passe afin d\'y accéder</p><br/>
                    <a href="http://localhost/resetpassword.php?r=f" style="padding: 12px 20px;
                            margin: 15px 15px;
                            border-radius: 25px;
                            text-decoration: none;
                            font-family: sans-serif;
                            border-color: #3a3a3a;
                            color: white;
                            background-color: rgb(118, 177, 100);">DEMANDER LE CHANGEMENT DE MOT DE PASSE</a><br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <img src="https://i.imgur.com/C5sVWQi.png" />
                </center>
                <style type="text/css">
                </style>',
                     'Vous avez demandé à changer de mot de passe. Allez à l\'adresse http://localhost/resetpassword.php?r=f pour poursuivre.');
   }
?>