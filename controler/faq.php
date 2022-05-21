<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user();
?>
<!DOCTYPE html>
<html lang="fr" style="scroll-behavior:smooth;">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>

        <link rel="stylesheet" href="/css/styleFaq.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
    </head>
    <body>
        <?php include 'navbar.php' ?>
        <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg> 

        <div class="box">
           

            <div class="faq">
                <?php
                    include_once 'php/mysql.php';

                    $bdh = new DBHandler();

                    $reqfaq = $bdh->getInstance()->prepare("SELECT question,answer FROM faq");
                    $reqfaq->execute();
                    $faq = $reqfaq->fetchAll();

                    foreach($faq as $row){
                        echo '<div class="question-answer">
                                <p class="question">'. $row['question'] .'<i class="fa-solid fa-caret-down"></i></p>
                                <p class="answer">'. $row['answer'] .'</p>
                              </div>';
                    }
                ?>
            </div>
        </div>
    </body>
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
</html>
    
