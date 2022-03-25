<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/button">
</head>
<body>
    <section>
        <div class="blockAll">
            <div class="blockInformation">
                <div class="blockTitreInformation"><h1>Contactez-Nous</h1></div>
                <div class="blockTextInformation">
                    <div class="textInformation">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt autem necessitatibus officia doloribus aliquam neque voluptate sed sit repudiandae facilis, reiciendis atque quis eum accusamus est ut eveniet explicabo itaque.
                    </div>
                </div>
            </div>
        <div class="blockFormulaire">
            <form action="#" method="post">
                <div class="blocknameField"></div>
                <div class="blockemailField"></div>
                <div class="blockobjectTextField">
                    <label for="objectTextField">Objet:</label>

                    <input type="text" id="objectTextField" name="objectTextField" required
                        minlength="4" maxlength="8" size="10">
                </div>
                <div class="textField">
                    <div class="blockAllTextArea">
                        <textarea   onkeydown="lenghtText(400,'descriptionAnnonceInput','NbCaractere')" id="descriptionAnnonceInput" 
                                    placeholder="description" maxlength="2000" 
                                    name="descriptionText"></textarea>
                        <span id="NbCaractere">0/600</span>
                    </div>
                </div>
                <div class="blockButtonSendMessage">
                    <a href="#" class="square_btn">BUTTON</a>
                </div>
            </form>
        </div>
        </div>
    </section>
    
</body>
</html>