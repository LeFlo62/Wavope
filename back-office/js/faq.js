$(document).on('click', '.control', function(){
    var up = $(this).hasClass('fa-caret-up');
    var elem = $(this).parent().parent();
    var id = elem.attr('qa-id');

    var switchElement = up ? elem.prev() : elem.next();
    var switchId = switchElement.attr('qa-id');

    
    var action = 'order';
    $.post('/back-office/php/faq.php', {action: action, elem_id: id, switch_id: switchId});
    
    var height = (up ? 1 : -1) * switchElement.outerHeight(true);

    elem.css({'box-shadow': '0 0 12px 0 grey'});
    
    switchElement.animate({'top': height.toString() + 'px'}, function(){
        switchElement.css({'top': ''});
    });

    elem.animate({'top': (-height).toString() + 'px'}, function(){
        elem.css({'top': ''});

        if(up){
            switchElement.before(elem);
        } else {
            switchElement.after(elem);
        }
        elem.css({'box-shadow': ''});
        if(elem.attr('qa-id') === $('.question-answer:' + (up ? 'first' : 'last')).attr('qa-id')){
            elem.find('.fa-caret-' + (up ? 'up' : 'down') + '').hide();
        } else{
            elem.find('.fa-caret-up').show();
            elem.find('.fa-caret-down').show();
        }

        if(switchElement.attr('qa-id') === $('.question-answer:' + (up ? 'last' : 'first')).attr('qa-id')){
            switchElement.find('.fa-caret-' + (up ? 'down' : 'up') + '').hide();
        } else{
            switchElement.find('.fa-caret-up').show();
            switchElement.find('.fa-caret-down').show();
        }
    });
});

$(document).on('click', '.delete-button', function(){
    $('#modal-background').fadeIn();

    $('#modal').css({'display': 'flex'})
    .html('<p class="modal-title" style="color: red;">Suppression ?</p><p>Voulez-vous vraiment supprimer cete question ?</p><div class="buttons"><div class="accept" qa-id=' + $(this).parent().attr("qa-id") + '>Confirmer</div><div class="cancel">Annuler</div></div>')
    .animate({'opacity': '1'});
});

$(document).on('click', '.accept', function(){
    var btn = $(this);
    $('#modal-background').fadeOut();
    $('#modal').animate({'opacity': '0'}, function(){
        $("#modal").css({'display': 'none'});
    });

    var qaId = btn.attr('qa-id');

    var action = 'delete';
    $.post('/back-office/php/faq.php', {action: action, elem_id: qaId})
    .done(function(response){
        alert(response);
        var responseObj = JSON.parse(response);
        $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
        setTimeout(function(){
            $('#snackbar').removeClass(['show', responseObj.return_type]);
        }, 3000);

        if(responseObj.return_type == 'success'){
            var elem = $('.question-answer[qa-id=' + qaId + ']');
            if(qaId === $('.question-answer:last').attr('qa-id')){
                elem.remove();
                $('.question-answer:last .fa-caret-down').hide();
            } else {
                elem.remove();
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