<?php
    require_once $_SERVER["DOCUMENT_ROOT"]. '/php/check_user.php';

    check_user(1, true);
?>
<link rel="stylesheet" href="./back-office/css/users.css">
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
        include_once './php/mysql.php';

        $bdh = new DBHandler();

        $reqdata = $bdh->getInstance()->prepare("SELECT id,firstname,lastname,email,birthdate,user_rank,banned FROM users JOIN user_data ON users.id = user_data.user_id GROUP BY users.id;");
        $reqdata->execute();
        $data = $reqdata->fetchAll();

        foreach($data as $row){
            $modifiable = $row['id'] === $_SESSION['id'] || RANK_POWER[$row['user_rank']] < RANK_POWER[$_SESSION['user_rank']];
            $banned = $row['banned'];
            echo '<div class="users-table-row'. ($banned ? ' banned' : '') .'">
            <div class="users-table-col">
                <p class="hint">Id: </p><p>'. $row['id'] .'</p>
            </div>
            <div class="users-table-col">
                <p class="hint">Prénom: </p><p>'. $row['firstname'] .'</p>' . ($modifiable ? ' <i data-type="firstname" user-id="'. $row['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">Nom: </p><p>'. $row['lastname'] .'</p>' . ($modifiable ? ' <i data-type="lastname" user-id="'. $row['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">E-Mail: </p><p>'. $row['email'] .'</p>' . ($modifiable ? ' <i data-type="email" user-id="'. $row['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">Date de naissance: </p><p>'. $row['birthdate'] .'</p>' . ($modifiable ? ' <i data-type="birthdate" user-id="'. $row['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">Type: </p><p>'. $row['user_rank'] . '</p>' . ($row['id'] !== $_SESSION['id'] && $modifiable ? ' <i data-type="user_rank" user-id="'. $row['id'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="users-table-col">
                <p class="hint">Contrôles: </p>'. ($row['id'] !== $_SESSION['id'] && $modifiable ? '<i user-id="'. $row['id'] .'" class="delete fa-solid fa-xmark"></i><i user-id="'. $row['id'] .'" class="ban fa-solid '. ($banned ? 'fa-hands-praying' : 'fa-gavel') .'"></i>' : '')
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
<script>
    $('.modify-pen').click(function() {
        var pen = $(this);
        var type = pen.attr("data-type");
        var id = pen.attr("user-id");
        
        var column = pen.closest(".users-table-col");
        var field = column.find("p:not(.hint)");

        $('.modify-pen').hide();
        var oldData = field.html();

        if(type == 'user_rank'){
            $('<select id="modifying"><?php
                foreach(RANK_POWER as $rank => $power){
                    if($power < RANK_POWER[$_SESSION['user_rank']]){
                        echo '<option value="'. $rank .'">'. $rank .'</option>';
                    }
                }
            ?></select>').insertBefore(pen);
            $('#modifying option:contains("' + oldData + '")').prop('selected', true);
        } else if(type == 'birthdate'){
            $('<input id="modifying" type="date" value="'+ field.html() +'">').insertBefore(pen);
        } else {
            $('<input id="modifying" type="text" value="'+ field.html() +'">').insertBefore(pen);
        }

        field.remove();
        
        $('#modifying').focus();

        var done = false;
        $('#modifying').bind("validate_modify",function(e) {
            if(done){
                return;
            }
            done = true;
            var data;
            if(type == 'user_rank'){
                data = $(this).find(':selected').text();
            } else {
                data = $(this).val();
            }

            $(this).remove();
            $('.modify-pen').show();

            if(data == oldData){
                $('#modifying').remove();
                $('<p>' + data + '</p>').insertBefore(pen);
                return;
            }

            $.post("./back-office/php/modifyuser.php", {user_id: id, data_type: type, data: data})
            .done(function(response){
                var responseObj = JSON.parse(response);
                $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
                setTimeout(function(){
                    $('#snackbar').removeClass(['show', responseObj.return_type]);
                }, 3000);

                $('#modifying').remove();
                if(responseObj.return_type == 'success'){
                    $('<p>' + data + '</p>').insertBefore(pen);
                } else {
                    $('<p>' + oldData + '</p>').insertBefore(pen);
                }
            })
            .fail(function(){
                alert("error");
            });

        });

        $('#modifying').keyup(function(e){
            if(e.keyCode == 13){
                $(this).trigger("validate_modify");
            }
        });
        $('#modifying').focusout(function(){
            $(this).trigger("validate_modify");
        });
    });
</script>

<div id="modal-background"></div>
<div id="modal"></div>