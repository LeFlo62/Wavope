<link rel="stylesheet" href="/back-office/css/cards.css">
<script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
<div class="button" id="add-card">Ajouter une carte</div>
<div class="cards">
    <?php
        foreach($cards as $card){
            echo '<div class="card" card-id="'. $card['id'] .'">
                    <p class="card-title"> '. $card['title'] .'</p>
                    <p class="card-date"> ' . $card['date'] . '</p>
                    <p class="card-preview">' . $card['content'] . '</p>
                    <div class="card-buttons">
                        <div class="button modify-button">Modifier</div>
                        <div class="button delete-button">Supprimer</div>
                    </div>
                </div>';
        }
    ?>
</div>
<script src="/back-office/js/cards.js"></script>
<div id="snackbar"></div>
<div id="modal-background"></div>
<div id="modal"></div>