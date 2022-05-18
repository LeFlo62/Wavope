$.expr[':'].emptyVal = function(obj){
    return obj.value === '';
};

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
    var rank = $('#ac-rank').find(':selected').text();

    $.post("./back-office/php/createuser.php", {firstname: firstname, lastname: lastname, email: email, birthdate: birthdate, rank: rank})
    .done(function(response){
        var responseObj = JSON.parse(response);
        $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
        setTimeout(function(){
            $('#snackbar').removeClass(['show', responseObj.return_type]);
        }, 3000);

        if(responseObj.return_type === 'success'){
            var id = responseObj.data[0];
            $('.users-table').append(`<div class="users-table-row">
            <div class="users-table-col">
                <p class="hint">Id: </p><p>`+ id +`</p>
            </div>
            <div class="users-table-col">
                <p class="hint">Prénom: </p><p>`+ firstname +`</p><i data-type="firstname" user-id="`+ id +`" class="modify-pen fa-solid fa-pen"></i>
            </div>
            <div class="users-table-col">
                <p class="hint">Nom: </p><p>`+ lastname +`</p><i data-type="lastname" user-id="`+ id +`" class="modify-pen fa-solid fa-pen"></i>
            </div>
            <div class="users-table-col">
                <p class="hint">E-Mail: </p><p>`+ email +`</p><i data-type="email" user-id="`+ id +`" class="modify-pen fa-solid fa-pen"></i>
            </div>
            <div class="users-table-col">
                <p class="hint">Date de naissance: </p><p>`+ birthdate +`</p><i data-type="birthdate" user-id="`+ id +`" class="modify-pen fa-solid fa-pen"></i>
            </div>
            <div class="users-table-col">
                <p class="hint">Type: </p><p>`+ rank +`</p><i data-type="user_rank" user-id="`+ id +`" class="modify-pen fa-solid fa-pen"></i>
            </div>
            <div class="users-table-col">
                <p class="hint">Contrôles: </p><i user-id="`+ id +`" class="delete fa-solid fa-xmark"></i><i user-id="`+ id +`" class="ban fa-solid fa-gavel"></i>
            </div>
        </div>`);
        }
    })
    .fail(function(){
        alert("error");
    });
});

$('#add-account').click(function(){
    $(this).addClass('disabled');

    var options = "";

    ranks.forEach(rank => {
        options += '<option value="' + rank + '"' + (rank === 'user' ? 'selected' : '') + '>' + rank  + '</option>';
    });

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
                    <select id="ac-rank">`+ options + `</select>
                    </div>
                    <div class="users-table-col">
                        <div id="ac-confirm" class="button disabled">Enregistrer</div>
                    </div>
                </div>`;
    
    $(newLine).insertAfter('.users-table .users-table-row.title');
});