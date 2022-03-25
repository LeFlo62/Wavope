<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styleButton.css">
    <link rel="stylesheet" href="./css/styleContactForm.css">
</head>
<body>
    <section class="contactSection">
        <div class="blockAll">
            <div class="blockInformation">
                <div class="blockTitreInformation"><h1>Contactez-Nous</h1></div>
                <div class="blockTextInformation">
                    <div class="textInformation">
                        <h2>Téléphone: 06 66 66 66 66</h2>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt autem necessitatibus officia doloribus aliquam neque voluptate sed sit repudiandae facilis, reiciendis atque quis eum accusamus est ut eveniet explicabo itaque.
                        <h3>Wavope: wavope@gmail.com</h3>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt autem necessitatibus officia doloribus aliquam neque voluptate sed sit repudiandae facilis, reiciendis atque quis eum accusamus est ut eveniet explicabo itaque.
                    </div>
                </div>
            </div>
        <div class="blockFormulaire">
            <form action="#" method="post">
                <div class="blockTextInput">
                    <label for="nameField">Nom </label>
                    <input class="search-input" type="text" id="nameField" name="nameTextField" required
                        minlength="4" maxlength="8" size="10">
                </div>
                <div class="blockTextInput">
                    <label for="emailField">Email </label>
                    <input class="search-input" type="text" id="emailField" name="emailTextField" required
                        minlength="4" maxlength="8" size="10">
                </div>


                <div class="blockTextInput">
                    <label for="objectTextField">Objet </label>
                    <input class="search-input" type="text" id="objectTextField" name="objectTextField" required
                        minlength="4" maxlength="8" size="10">
                </div>
                <!-- <div class="textField"> -->
                    <div class="blockAllTextArea">
                        <textarea   onkeydown="lenghtText(400,'descriptionAnnonceInput','NbCaractere')" id="descriptionAnnonceInput" 
                                    placeholder="Entrez votre message" maxlength="2000" 
                                    name="descriptionText"></textarea>
                        <span id="NbCaractere">0/600</span>
                    </div>
                <!-- </div> -->
                <div class="blockButtonSendMessage">
                    <a href="#" class="square_btn1">Envoyer</a>
                </div>
            </form>
        </div>
        </div>
    </section>
    
</body>
</html>