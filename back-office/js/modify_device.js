$('.modify-pen').click(function() {
    var pen = $(this);
    var type = pen.attr("data-type");
    var productNumber = pen.attr("product-number");
    
    var field = pen.closest(".devices-table-col").find("p:not(.hint)");

    $('.modify-pen').hide();
    var oldData = field.html();
    
    field.html('<input id="modifying" type="text" value="'+ field.html() +'">');

    $('#modifying').focus();

    var done = false;
    $('#modifying').bind("validate_modify",function(e) {
        if(done){
            return;
        }
        done = true;
        var data = $(this).val();

        $(this).remove();
        $('.modify-pen').show();

        if(data == oldData){
            field.html(data);
            return;
        }

        $.post("./back-office/php/modifydevice.php", {product_number: productNumber, data_type: type, data: data})
        .done(function(response){
            var responseObj = JSON.parse(response);
            $('#snackbar').html(responseObj.message).addClass(['show', responseObj.return_type]);
            setTimeout(function(){
                $('#snackbar').removeClass(['show', responseObj.return_type]);
            }, 3000);

            if(responseObj.return_type == 'success'){
                field.html(data);
            } else {
                field.html(oldData);
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