<link rel="stylesheet" href="./back-office/css/faq.css">
<script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>

<?php
    foreach($faq as $qa){
        $ordering = $qa['ordering'];
        echo '<div qa-id="'. $qa['id'] .'" class="question-answer">
                <p class="question">'. $qa['question'] . ($ordering === count($faq)-1 ? '' : '<i class="control fa-solid fa-caret-down"></i>') . ($ordering === 0 ? '' : '<i class="control fa-solid fa-caret-up"></i>') .'</p>
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

        var height = switchElement.outerHeight(true);

        elem.css({'box-shadow': '0 0 12px 0 grey'});

        //TODO update order, and carets

        switchElement.animate({'top': height.toString() + 'px'}, function(){
            switchElement.css({'top': ''});
            elem.after(switchElement);
            elem.css({'box-shadow': ''});
        });

        elem.animate({'top': (-height).toString() + 'px'}, function(){
            elem.css({'top': ''});
            switchElement.before(elem);
            elem.css({'box-shadow': ''});
        });
    });
</script>