<?php
    require $_SERVER["DOCUMENT_ROOT"]. '/php/model.php';
    require $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';
    

    
    if(isset($_POST) && isset($_POST['formFormulaire'])){
        if(isset($_POST['nameTextField']) && isset($_POST['emailTextField']) && isset($_POST['objectTextField']) && isset($_POST['descriptionText'])   )
            && !empty($_POST['nameTextField']) && !empty($_POST['emailTextField']) && !empty($_POST['objectTextField']) && !empty($_POST['descriptionText']){

                $emailTextField = sanitize($_POST['emailTextField']);
                $nameTextField = sanitize($_POST['nameTextField']);
                $objectTextField = sanitize($_POST['objectTextField']);
                $descriptionText = sanitize($_POST['descriptionText']);
                sendFormulaire($emailTextField, $nameTextField,$objectTextField,$descriptionText);
            }
        }
            

    function sendFormulaire($emailTextField, $nameTextField, $objectTextField,$descriptionText){
        sendMail("noreply.wavope@gmail.com", "", "Nouveau formulaire",'Email envoyé par:'. $emailTextField. '<br/>
         nom de l\'expéditeur: '. $nameTextField  .'<br/>
         Objet de l\'email: '.$objectTextField. '<br/>
         Contenu : ' .$descriptionText);
    }


?>