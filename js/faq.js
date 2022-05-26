$('.question').click(function(){
    var questionAnswer = $(this).closest('.question-answer');
    var answer = questionAnswer.find('.answer');
    var caret = questionAnswer.find('i');
    if(answer.css('display') === 'none'){
        answer.slideDown();
        caret.removeClass('fa-caret-down').addClass('fa-caret-up');
    } else {
        answer.slideUp();
        caret.addClass('fa-caret-down').removeClass('fa-caret-up');
    }
});