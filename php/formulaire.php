<?php
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';


    
    if(isset($_POST) && isset($_POST['formFormulaire'])){
        if(isset($_POST['nameTextField']) && isset($_POST['emailTextField']) && isset($_POST['objectTextField']))
            && !empty($_POST['nameTextField']) && !empty($_POST['emailTextField']) && !empty($_POST['objectTextField']){

                $nameTextField = sanitize($_POST['nameTextField']);
                $emailTextField = sanitize($_POST['emailTextField']);
                $objectTextField = sanitize($_POST['objectTextField']);
                sendFormulaire($emailTextField, $nameTextField,$objectTextField);
            }
        }
            
            

            
    function sendFormulaire($email, $name,$objectTextField){
        sendMail($email, $name, "Nouveau formulaire",
        '<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <center style="
                font-family: "Roboto", sans-serif;
                font-size: 1rem;
                padding: 0px;
                margin: 0px;
                background-color: white;">
            <img style="width: 150px; height: auto;" src="https://i.imgur.com/6CFLqM7.png" />
            <br/>
            <p>'.$objectTextField.'</p><br/>
            <br/>
            <br/>
            <p style="font-size: 0.75rem;">Cette demande ne vient pas de vous ?  <p>'. $objectTextField.'</p><br/></p><br/>
            <br/>
            <br/>
           
            </center>
        <style type="text/css">
            center{
            }
        
            #confirm{
            }
        </style>',
        );
    }


?>