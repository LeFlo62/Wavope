$('.delete').click(function(){
    $('#modal-background').fadeIn();

    $('#modal').css({'display': 'flex'})
    .html('<p class="modal-title" style="color: red;">Suppression ?</p><p>Voulez-vous vraiment supprimer ce compte ?</p><div class="buttons"><div class="accept" action="delete" user-id=' + $(this).attr("user-id") + '>Confirmer</div><div class="cancel">Annuler</div></div>')
    .animate({'opacity': '1'});
});

$('.ban').click(function(){
    $('#modal-background').fadeIn();

    $('#modal').css({'display': 'flex'})
    .html('<p class="modal-title" style="color: red;">' + ($(this).hasClass('fa-gavel') ? "B" : "Déb") +'annissement ?</p><p>Voulez-vous vraiment bannir ce compte ?</p><div class="buttons"><div class="accept" action="ban" user-id=' + $(this).attr("user-id") + '>Confirmer</div><div class="cancel">Annuler</div></div>')
    .animate({'opacity': '1'});
});

$(document).on('click', '.accept', function(){
    var btn = $(this);
    $('#modal-background').fadeOut();
    $('#modal').animate({'opacity': '0'}, function(){
        $("#modal").css({'display': 'none'});
    });

    var userId = btn.attr('user-id');
    var action = btn.attr('action');

    $.post("./back-office/php/sanctionuser.php", {user_id: userId, action: action})
        .done(function(response){
            var responseObj = JSON.parse(response);
            $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
            setTimeout(function(){
                $('#snackbar').removeClass(['show', responseObj.return_type]);
            }, 3000);

            if(responseObj.return_type == 'success'){
                if(responseObj.message.includes('débanni')){
                    $('.ban[user-id='+ userId +']').closest('.users-table-row').removeClass('banned');
                    $('.ban[user-id='+ userId +']').addClass('fa-gavel').removeClass('fa-hands-praying');
                } else if(responseObj.message.includes('banni')){
                    $('.ban[user-id='+ userId +']').closest('.users-table-row').addClass('banned');
                    $('.ban[user-id='+ userId +']').removeClass('fa-gavel').addClass('fa-hands-praying');
                } else if(responseObj.message.includes('supprimé')){
                    $('.ban[user-id='+ userId +']').closest('.users-table-row').remove();
                }
            }
        })
        .fail(function(){
            alert("error");
        });
});

$(document).on('click', '.cancel', function(){
    $('#modal-background').fadeOut();
    $('#modal').animate({'opacity': '0'}, function(){
        $("#modal").css({'display': 'none'});
    });
});