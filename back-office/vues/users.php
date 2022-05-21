<link rel="stylesheet" href="/back-office/css/users.css">
<script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
<div class="button" id="add-account">Ajouter un compte</div>
<div class="users-table">
    <div class="users-table-row title">
        <div class="users-table-col">
            Id
        </div>
        <div class="users-table-col">
            Prénom
        </div>
        <div class="users-table-col">
            Nom
        </div>
        <div class="users-table-col">
            E-Mail
        </div>
        <div class="users-table-col">
            Date de naissance
        </div>
        <div class="users-table-col">
            Type
        </div>
        <div class="users-table-col">
            Contrôles
        </div>
    </div>
    <?php
        foreach($users as $user){
            $modifiable = $user['id'] === $_SESSION['id'] || RANK_POWER[$user['user_rank']] < RANK_POWER[$_SESSION['user_rank']];
            $banned = $user['banned'];
            echo '<div class="users-table-row'. ($banned ? ' banned' : '') .'">
            <div class="users-table-col">
                <p class="hint">Id: </p><p>'. $user['id'] .'</p>
            </div>
            <div class="users-table-col">
                <p class="hint">Prénom: </p><p>'. $user['firstname'] .'</p>' . ($modifiable ? ' <i data-type="firstname" user-id="'. $user['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">Nom: </p><p>'. $user['lastname'] .'</p>' . ($modifiable ? ' <i data-type="lastname" user-id="'. $user['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">E-Mail: </p><p>'. $user['email'] .'</p>' . ($modifiable ? ' <i data-type="email" user-id="'. $user['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">Date de naissance: </p><p>'. $user['birthdate'] .'</p>' . ($modifiable ? ' <i data-type="birthdate" user-id="'. $user['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">Type: </p><p>'. $user['user_rank'] . '</p>' . ($user['id'] !== $_SESSION['id'] && $modifiable ? ' <i data-type="user_rank" user-id="'. $user['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">Contrôles: </p>'. ($user['id'] !== $_SESSION['id'] && $modifiable ? '<i user-id="'. $user['id'] .'" class="delete fa-solid fa-xmark"></i><i user-id="'. $user['id'] .'" class="ban fa-solid '. ($banned ? 'fa-hands-praying' : 'fa-gavel') .'"></i>' : '')
            .'</div>
        </div>';
        }
    ?>
</div>

<div id="snackbar"></div>
<script>
    let ranks = [<?php foreach(RANK_POWER as $rank => $power){
                    if($power < RANK_POWER[$_SESSION['user_rank']]){
                        echo '"' . $rank . '", ';
                    }
                } ?>];
</script>
<script src="/back-office/js/add_user.js"></script>
<script src="/back-office/js/sanction_user.js"></script>
<script src="/back-office/js/modify_user.js"></script>

<div id="modal-background"></div>
<div id="modal"></div>