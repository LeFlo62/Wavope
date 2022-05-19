var options = "";

ranks.forEach(rank => {
    options += '<option value="' + rank + '"' + (rank === 'user' ? 'selected' : '') + '>' + rank  + '</option>';
});

$('.modify-pen').click(function() {
    var pen = $(this);
    var type = pen.attr("data-type");
    var id = pen.attr("user-id");
    
    var column = pen.closest(".users-table-col");
    var field = column.find("p:not(.hint)");

    $('.modify-pen').hide();
    var oldData = field.html();

    if(type == 'user_rank'){
        $('<select id="modifying">'+ options +'</select>').insertBefore(pen);
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