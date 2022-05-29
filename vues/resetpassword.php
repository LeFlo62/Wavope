<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Changement de mot de passe</title>
        
        <link rel="stylesheet" href="/css/styleResetpassword.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>

    </head>
    <body>	
        <?php include 'navbar.php'; ?>
        <div id="snackbar"></div>

        <div class="box">
            <div class="blockFormulaire">
                <?php
                    if(isset($_GET['error'])){
                        echo '<p class="error">';
                        switch($_GET['error']){
                            case 'completion':
                                echo 'Vous devez compléter tous les champs !';
                                break;
                            case 'validation':
                                echo 'Vous devez passer par ce formulaire !';
                                break;
                            case 'match':
                                echo 'Les mots de passe doivent correspondre !';
                                break;
                        }
                        echo '</p>';
                    }

                    if($_GET['r'] === 'f'){
                        echo '<h1>Changement de mot de passe</h1>
                    
                        <div class="blockTextInput">
                            <label for="emailField">Email*</label>
                            <input class="fieldInput" type="email" id="emailField" name="email" required>
                        </div>
        
                        <div class="blockButtonSendMessage">
                            <input type="submit" name="login" class="square_btn2" value="Envoyer" onclick="sendMail()" />
                        </div>
                        <script>
                            function sendMail(){
                                if($("#emailField").val() != ""){
                                    var method = "f";
                                    var email = $("#emailField").val();

                                    $.post("/php/resetpassword.php", {method: method, email: email})
                                    .done(function(response){
                                        var responseObj = JSON.parse(response);
                                        $("#snackbar").html(responseObj.message).addClass(["show", responseObj.return_type]);
                                        setTimeout(function(){
                                            $("#snackbar").removeClass(["show", responseObj.return_type]);
                                        }, 3000);
                                    })
                                    .fail(function(){
                                        alert("error");
                                    });
                                } else {
                                    window.location.href = "?r=f&error=completion";
                                }
                            }
                        </script>';
                    } else if($_GET['r'] === 'r' && (isset($_SESSION['id']) || isset($_GET['token']))){
                        echo '<h1>Changement de mot de passe</h1>
                    
                        <div class="blockTextInput">
                            <label for="passwordField">Mot de passe*</label>
                            <input class="fieldInput" type="password" id="passwordField" name="password" required>
                        </div>

                        <div class="blockTextInput">
                            <label for="passwordCheck" required>Confirmation du Mot de passe</label>
                            <input class="fieldInput" name="password_check" id="passwordCheck" type="password" />
                        </div>
        
                        <div class="blockButtonSendMessage">
                            <input type="submit" name="login" class="square_btn2" value="Envoyer" onclick="changePass()" />
                        </div>
                        <script>
                            function changePass(){
                                if($("#passwordField").val() != "" && $("#passwordCheck").val() != ""){
                                    if($("#passwordField").val() == $("#passwordCheck").val()){
                                        var method = "r";
                                        var password = $("#passwordField").val();';

                        if(isset($_SESSION['id'])){
                            echo 'var id = '. $_SESSION['id'] .';
                            var params = {method: method, password: password, id: id};';
                        } else {
                            echo 'var token = "'. $_GET['token'] .'";
                            var params = {method: method, password: password, token: token};';
                        }
                        

                        echo            '$.post("/php/resetpassword.php", params)
                                        .done(function(response){
                                            alert(response);
                                            var responseObj = JSON.parse(response);
                                            $("#snackbar").html(responseObj.message).addClass(["show", responseObj.return_type]);
                                            setTimeout(function(){
                                                $("#snackbar").removeClass(["show", responseObj.return_type]);
                                            }, 3000);
                                        })
                                        .fail(function(){
                                            alert("error");
                                        });
                                    } else {
                                        window.location.href = "?r=r&error=match'. ((isset($_GET['token'])) ? ('&token='. $_GET['token']) : '') .'";
                                    }
                                } else {
                                    window.location.href = "?r=r&error=completion'. ((isset($_GET['token'])) ? ('&token='. $_GET['token']) : '') .'";
                                }
                            }
                        </script>';
                    } else if($_GET['r'] === 'c' && isset($_GET['token'])){
                        echo '<h1>Nous sommes navrés...</h1><p>Cette requête de modification de mot de passe a été annulée.</p>
                        <script>
                            var method = "c";
                            var token = "'. $_GET['token'] .'";
                            $.post("/php/resetpassword.php", {method: method, token: token})
                            .done(function(response){
                                alert(response);
                                var responseObj = JSON.parse(response);
                                $("#snackbar").html(responseObj.message).addClass(["show", responseObj.return_type]);
                                setTimeout(function(){
                                    $("#snackbar").removeClass(["show", responseObj.return_type]);
                                }, 3000);
                            })
                            .fail(function(){
                                alert("error");
                            });
                        </script>';
                    } else {
                        header("Location: /logi.php");
                        exit;
                    }
                ?>
            </div>
		</div>
    </body>
    <?php include 'footer.php' ?>
</html>