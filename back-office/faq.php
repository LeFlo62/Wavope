<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(1, true);
?>
<link rel="stylesheet" href="./back-office/css/faq.css">
<script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>

<div class="question-answer">
    <p class="question">Pourquoi faire cette section ?<i class="fa-solid fa-caret-down"></i></p>
    <p class="answer">Nous nous devons de faire une section qui soit capable de répondre à toutes vos question ! Faire ce genre de section nécessite du temps, si bien pour la coder ou encore la fournir de toute sorte de questions ! Bien sûr cette question ne sera pas dans la version finale de la FAQ, j'en ai juste besoin pour remplir l'espace et avoir quelque chose de crédible dans un paragraphe :)</p>
</div>

<div class="question-answer">
    <p class="question">Pourquoi faire cette section ?<i class="fa-solid fa-caret-down"></i></p>
    <p class="answer">Nous nous devons de faire une section qui soit capable de répondre à toutes vos question ! Faire ce genre de section nécessite du temps, si bien pour la coder ou encore la fournir de toute sorte de questions ! Bien sûr cette question ne sera pas dans la version finale de la FAQ, j'en ai juste besoin pour remplir l'espace et avoir quelque chose de crédible dans un paragraphe :)</p>
</div>

<div class="question-answer">
    <p class="question">Pourquoi faire cette section ?<i class="fa-solid fa-caret-down"></i></p>
    <p class="answer">Nous nous devons de faire une section qui soit capable de répondre à toutes vos question ! Faire ce genre de section nécessite du temps, si bien pour la coder ou encore la fournir de toute sorte de questions ! Bien sûr cette question ne sera pas dans la version finale de la FAQ, j'en ai juste besoin pour remplir l'espace et avoir quelque chose de crédible dans un paragraphe :)</p>
</div>

<script>
    $('.question').click(function(){
        var questionAnswer = $(this).closest('.question-answer');
        var answer = questionAnswer.find('.answer');
        var caret = questionAnswer.find('i');
        if(answer.css('display') === 'none'){
            answer.slideDown();
            caret.removeClass('fa-caret-down').addClass('fa-caret-up');
        } else {
            answer.slideUp();
            caret.addClass('fa-caret-down').removeClass('fa-caret-up');
        }
    });
</script>