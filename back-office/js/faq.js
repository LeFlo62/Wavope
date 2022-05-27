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

$(document).on('click', '.delete-button:not(#cancel-new-question, #cancel-modify-question)', function(){
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

$(document).on('click', '#add-question', function(){
    $(this).addClass('disabled');

    var newLine = $(`<div class="question-answer">
                        <p class="question"><input type="text" id="question-text" placeholder="Question"></input><i class="control fa-solid fa-caret-down" style="display:none;"></i><i class="control fa-solid fa-caret-up" style="display: none;"></i></p>
                        <p class="answer"><textarea id="answer-text" placeholder="Réponse"></textarea></p>
                        <div class="button modify-button" id="add-new-question">Enregristrer</div><div class="button delete-button" id="cancel-new-question">Annuler</div>
                    </div>`);

    newLine.insertAfter('.question-answer:last');
    newLine[0].scrollIntoView();
});

$(document).on('click', '#cancel-new-question', function(){
    $(this).parent().remove();
    $('#add-question').removeClass('disabled');
});

$(document).on('click', '#add-new-question', function(){
    var questionField = $('#question-text');
    var answerField = $('#answer-text');

    var questionParagraph = questionField.parent();
    var answerParagraph = answerField.parent();

    var question = questionField.val();
    var answer = answerField.val();

    if(question.length != 0 && answer.length != 0){
        var action = 'add';
        $.post('/back-office/php/faq.php', {action: action, question: question, answer: answer})
        .done(function(response){
            var responseObj = JSON.parse(response);
            $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
            setTimeout(function(){
                $('#snackbar').removeClass(['show', responseObj.return_type]);
            }, 3000);

            if(responseObj.return_type == 'success'){
                var id = responseObj.data[0];
                var questionAnswer = questionParagraph.parent();

                questionAnswer.attr('qa-id', id);

                $('#add-new-question').html('Modifier').removeAttr('id');
                $('#cancel-new-question').html('Supprimer').removeAttr('id');

                questionField.remove();
                answerField.remove();

                questionParagraph.prepend(question);
                answerParagraph.prepend(answer);

                questionAnswer.find('.fa-caret-up').show();
                questionAnswer.prev().find('.fa-caret-down').show();

                $('#add-question').removeClass('disabled');
            }
        })
        .fail(function(){
            alert("error");
        });
    } else {
        if(question.length == 0){
            questionField.addClass('empty-field');
        }
        if(answer.length == 0){
            answerField.addClass('empty-field');
        }
    }
});

$(document).on('click', '.modify-button:not(#add-new-question, #modify-question, .disabled)', function(){
    var questionAnswer = $(this).parent();
    var id = questionAnswer.attr('qa-id');

    var greenButton = $(this);
    var redButton = questionAnswer.find('.delete-button');

    greenButton.attr('id', 'modify-question').html('Enregistrer');
    redButton.attr('id', 'cancel-modify-question').html('Annuler');

    var questionParagraph = questionAnswer.find('.question');
    var answerParagraph = questionAnswer.find('.answer');

    questionParagraph.html('<input type="text" id="question-text" placeholder="Question" old-value="' + questionParagraph.text() + '" value="' + questionParagraph.text() + '"></input><i class="control fa-solid fa-caret-down" style="display:none;"></i><i class="control fa-solid fa-caret-up" style="display: none;"></i>');
    answerParagraph.html('<textarea id="answer-text" placeholder="Réponse" old-value="' + answerParagraph.html() + '">' + answerParagraph.html() + '</textarea>');

    $('.modify-button:not(#modify-question)').addClass('disabled');
});

$(document).on('click', '#cancel-modify-question', function(){
    var questionAnswer = $(this).parent();
    var id = questionAnswer.attr('qa-id');

    var greenButton = questionAnswer.find('.modify-button');
    var redButton = $(this);

    var questionParagraph = questionAnswer.find('.question');
    var answerParagraph = questionAnswer.find('.answer');

    var controls = '<i class="control fa-solid fa-caret-down" '+ (id == $('.question-answer:last').attr('qa-id') ? 'style="display:none;"' : '') +'></i><i class="control fa-solid fa-caret-up" '+ (id == $('.question-answer:first').attr('qa-id') ? 'style="display:none;"' : '') + '></i>';

    var oldQuestion = $('#question-text').attr('old-value');
    var oldAnswer = $('#answer-text').attr('old-value');
    questionParagraph.html(oldQuestion + controls);
    answerParagraph.html(oldAnswer);

    greenButton.removeAttr('id').html('Modifier');
    redButton.removeAttr('id').html('Supprimer');

    $('.modify-button').removeClass('disabled');
});

$(document).on('click', '#modify-question', function(){
    var questionAnswer = $(this).parent();
    var id = questionAnswer.attr('qa-id');

    var greenButton = $(this);
    var redButton = questionAnswer.find('.delete-button');

    var questionParagraph = questionAnswer.find('.question');
    var answerParagraph = questionAnswer.find('.answer');

    var questionField = $('#question-text');
    var answerField = $('#answer-text');

    var question = questionField.val();
    var answer = answerField.val();

    if(question.length != 0 && answer.length != 0){
        var action = 'modify';
        $.post('/back-office/php/faq.php', {action: action, id: id, question: question, answer: answer})
        .done(function(response){
            alert(response);
            var responseObj = JSON.parse(response);
            $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
            setTimeout(function(){
                $('#snackbar').removeClass(['show', responseObj.return_type]);
            }, 3000);

            if(responseObj.return_type == 'success'){
                greenButton.html('Modifier').removeAttr('id');
                redButton.html('Supprimer').removeAttr('id');

                questionField.remove();
                answerField.remove();

                questionParagraph.prepend(question);
                answerParagraph.prepend(answer);

                if(id != $('.question-answer:last').attr('qa-id')){
                    questionAnswer.find('.fa-caret-down').show();
                }
                if(id != $('.question-answer:first').attr('qa-id')){
                    questionAnswer.find('.fa-caret-up').show();
                }

                $('.modify-button').removeClass('disabled');
            }
        })
        .fail(function(){
            alert("error");
        });
    } else {
        if(question.length == 0){
            questionField.addClass('empty-field');
        }
        if(answer.length == 0){
            answerField.addClass('empty-field');
        }
    }
});