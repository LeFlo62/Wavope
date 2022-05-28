$(document).on('click', '.delete-button:not(#cancel-new-card, #cancel-modify-card)', function(){
    $('#modal-background').fadeIn();

    $('#modal').css({'display': 'flex'})
    .html('<p class="modal-title" style="color: red;">Suppression ?</p><p>Voulez-vous vraiment supprimer cete carte ?</p><div class="buttons"><div class="accept" card-id=' + $(this).closest('.card').attr("card-id") + '>Confirmer</div><div class="cancel">Annuler</div></div>')
    .animate({'opacity': '1'});
});

$(document).on('click', '.accept', function(){
    var btn = $(this);
    $('#modal-background').fadeOut();
    $('#modal').animate({'opacity': '0'}, function(){
        $("#modal").css({'display': 'none'});
    });

    var cardId = btn.attr('card-id');

    var action = 'delete';
    $.post('/back-office/php/cards.php', {action: action, id: cardId})
    .done(function(response){
        var responseObj = JSON.parse(response);
        $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
        setTimeout(function(){
            $('#snackbar').removeClass(['show', responseObj.return_type]);
        }, 3000);

        if(responseObj.return_type == 'success'){
            var elem = $('.card[card-id=' + cardId + ']');
            elem.remove();
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

$(document).on('click', '#add-card', function(){
    $(this).addClass('disabled');
    var date = new Date();
    var newLine = $(`<div class="card">
                        <p class="card-title"><input type="text" id="card-title-text"></input></p>
                        <p class="card-date">` + date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate() + `</p>
                        <p class="card-preview"><textarea id="card-preview-text"></textarea></p>
                        <div class="card-buttons">
                            <div id="add-new-card" class="button modify-button">Enregistrer</div>
                            <div id="cancel-new-card" class="button delete-button">Annuler</div>
                        </div>
                    </div>`);

    newLine.insertBefore('.card:first');
});

$(document).on('click', '#cancel-new-card', function(){
    $(this).closest('.card').remove();
    $('#add-card').removeClass('disabled');
});

$(document).on('click', '#add-new-card', function(){
    var date = new Date();

    var titleField = $('#card-title-text');
    var previewField = $('#card-preview-text');

    var titleParagraph = titleField.parent();
    var previewParagraph = previewField.parent();

    var title = titleField.val();
    var preview = previewField.val();

    if(title.length != 0 && preview.length != 0){
        var action = 'add';
        $.post('/back-office/php/cards.php', {action: action, title: title, preview: preview})
        .done(function(response){
            var responseObj = JSON.parse(response);
            $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
            setTimeout(function(){
                $('#snackbar').removeClass(['show', responseObj.return_type]);
            }, 3000);

            if(responseObj.return_type == 'success'){
                var id = responseObj.data[0];
                var card = titleParagraph.parent();

                card.attr('card-id', id);

                $('#add-new-card').html('Modifier').removeAttr('id');
                $('#cancel-new-card').html('Supprimer').removeAttr('id');

                titleField.remove();
                previewField.remove();

                titleParagraph.prepend(title);
                previewParagraph.prepend(preview);

                $('#add-card').removeClass('disabled');
            }
        })
        .fail(function(){
            alert("error");
        });
    } else {
        if(title.length == 0){
            titleField.addClass('empty-field');
        }
        if(preview.length == 0){
            previewField.addClass('empty-field');
        }
    }
});

$(document).on('click', '.modify-button:not(#add-new-card, #modify-card, .disabled)', function(){
    var card = $(this).closest('.card');
    var id = card.attr('card-id');

    var greenButton = $(this);
    var redButton = card.find('.delete-button');

    greenButton.attr('id', 'modify-card').html('Enregistrer');
    redButton.attr('id', 'cancel-modify-card').html('Annuler');

    var titleParagraph = card.find('.card-title');
    var previewParagraph = card.find('.card-preview');

    titleParagraph.html('<input type="text" id="card-title-text" placeholder="Titre" old-value="' + titleParagraph.text() + '" value="' + titleParagraph.text() + '"></input>');
    previewParagraph.html('<textarea id="card-preview-text" rows="15" maxlength="1000" placeholder="Contenu" old-value="' + previewParagraph.html() + '">' + previewParagraph.html() + '</textarea>');

    $('.modify-button:not(#modify-card)').addClass('disabled');
});

$(document).on('click', '#cancel-modify-card', function(){
    var card = $(this).closest('.card');
    var id = card.attr('card-id');

    var greenButton = card.find('.modify-button');
    var redButton = $(this);

    var titleParagraph = card.find('.card-title');
    var previewParagraph = card.find('.card-preview');

    var oldTitle = $('#card-title-text').attr('old-value');
    var oldPreview = $('#card-preview-text').attr('old-value');
    titleParagraph.html(oldTitle);
    previewParagraph.html(oldPreview);

    greenButton.removeAttr('id').html('Modifier');
    redButton.removeAttr('id').html('Supprimer');

    $('.modify-button').removeClass('disabled');
});

$(document).on('click', '#modify-card', function(){
    var card = $(this).closest('.card');
    var id = card.attr('card-id');

    var greenButton = $(this);
    var redButton = card.find('.delete-button');

    var titleParagraph = card.find('.card-title');
    var previewParagraph = card.find('.card-preview');

    var titleField = $('#card-title-text');
    var previewField = $('#card-preview-text');

    var title = titleField.val();
    var preview = previewField.val();
    alert(title + ' ' + preview);
    if(title.length != 0 && preview.length != 0){
        var action = 'modify';
        $.post('/back-office/php/cards.php', {action: action, id: id, title: title, preview: preview})
        .done(function(response){
            var responseObj = JSON.parse(response);
            $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
            setTimeout(function(){
                $('#snackbar').removeClass(['show', responseObj.return_type]);
            }, 3000);

            if(responseObj.return_type == 'success'){
                greenButton.html('Modifier').removeAttr('id');
                redButton.html('Supprimer').removeAttr('id');

                titleField.remove();
                previewField.remove();

                titleParagraph.prepend(title);
                previewParagraph.prepend(preview);

                $('.modify-button').removeClass('disabled');
            }
        })
        .fail(function(){
            alert("error");
        });
    } else {
        if(title.length == 0){
            titleField.addClass('empty-field');
        }
        if(preview.length == 0){
            previewField.addClass('empty-field');
        }
    }
});