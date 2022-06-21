<link rel="stylesheet" href="/back-office/css/faq.css">
<script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
<div class="button" id="add-question">Ajouter une question</div>
<?php
    foreach($faq as $qa){
        $ordering = $qa['ordering'];
        echo '<div qa-id="'. $qa['id'] .'" class="question-answer">
                <p class="question">'. $ordering .' '. $qa['question'] . '<i class="control fa-solid fa-caret-down" '. ($ordering == count($faq)-1 ? 'style="display:none;"' : '') .'></i><i class="control fa-solid fa-caret-up" '. ($ordering == 0 ? 'style="display: none;"' : '') . '></i></p>
                <p class="answer">'. $qa['answer'] .'</p>
                <div class="button modify-button">Modifier</div><div class="button delete-button">Supprimer</div>
            </div>';
    }

?>
<script src="/back-office/js/faq.js"></script>
<div id="snackbar"></div>
<div id="modal-background"></div>
<div id="modal"></div>