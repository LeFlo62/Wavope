<link rel="stylesheet" href="/back-office/css/faq.css">
<script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>

<?php
    foreach($faq as $qa){
        $ordering = $qa['ordering'];
        echo '<div qa-id="'. $qa['id'] .'" class="question-answer">
                <p class="question">'. $qa['question'] . '<i class="control fa-solid fa-caret-down" '. ($ordering === count($faq)-1 ? 'style="display:none;"' : '') .'></i><i class="control fa-solid fa-caret-up" '. ($ordering === 0 ? 'style="display: none;"' : '') . '></i></p>
                <p class="answer">'. $qa['answer'] .'</p>
            </div>';
    }

?>

<script>
    $(document).on('click', '.control', function(){
        var up = $(this).hasClass('fa-caret-up');
        var elem = $(this).parent().parent();
        var id = elem.attr('qa-id');

        var switchElement = up ? elem.prev() : elem.next();
        var switchId = switchElement.attr('qa-id');

        var height = (up ? 1 : -1) * switchElement.outerHeight(true);

        elem.css({'box-shadow': '0 0 12px 0 grey'});

        //TODO update order, and carets

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
</script>