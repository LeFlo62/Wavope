<!DOCTYPE html>
<html lang="fr" style="scroll-behavior:smooth;">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FAQ</title>

        <link rel="stylesheet" href="/css/styleFaq.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
    </head>
    <body>
        <?php include 'navbar.php' ?>
        <div class="box">
            <div class="faq">
                <?php
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
    <script src="/js/faq.js"></script>
    <?php include 'footer.php' ?>
</html>