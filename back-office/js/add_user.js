$(document).on('change input paste keyup', '.account-creation', function(){
    if($('.account-creation:emptyVal').length === 0){
        $('#ac-confirm').removeClass('disabled');
    } else {
        $('#ac-confirm').addClass('disabled');
    }
});

$(document).on('click', '#ac-confirm', function(){
    var firstname = $('#ac-firstname').val();
    var lastname = $('#ac-lastname').val();
    var email = $('#ac-email').val();
    var birthdate = $('#ac-birthdate').val();
    var rank = $('#ac-rank:selected').text();
    $.post("./back-office/php/createuser.php", {firstname: firstname, lastname: lastname, email: email, birthdate: birthdate, rank: rank})
    .done(function(response){
        alert(response);
        var responseObj = JSON.parse(response);
        $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
        setTimeout(function(){
            $('#snackbar').removeClass(['show', responseObj.return_type]);
        }, 3000);
    })
    .fail(function(){
        alert("error");
    });
});

$('#add-account').click(function(){
    $(this).addClass('disabled');

    var newLine = `<div class="users-table-row">
                    <div class="users-table-col">
                        #
                    </div>
                    <div class="users-table-col">
                        <input class="account-creation" type="text" id="ac-firstname"/>
                    </div>
                    <div class="users-table-col">
                        <input class="account-creation" type="text" id="ac-lastname"/>
                    </div>
                    <div class="users-table-col">
                        <input class="account-creation" type="email" id="ac-email"/>
                    </div>
                    <div class="users-table-col">
                        <input class="account-creation" type="date" id="ac-birthdate"/>
                    </div>
                    <div class="users-table-col">
                    <select id="ac-rank"><?php
                        foreach(RANK_POWER as $rank => $power){
                            if($power < RANK_POWER[$_SESSION['user_rank']]){
                                echo '<option value="'. $rank .'"'. ($rank === 'user' ? 'selected' : '') .'>'. $rank .'</option>';
                            }
                        }
                    ?></select>
                    </div>
                    <div class="users-table-col">
                        <div id="ac-confirm" class="button disabled">Enregistrer</div>
                    </div>
                </div>`;
    
    $(newLine).insertAfter('.users-table .users-table-row.title');
});