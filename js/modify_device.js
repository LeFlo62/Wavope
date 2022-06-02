
$("#validInput").click(function(){
    var data=$("#productName").val();
    var productNumber=$(this).attr("pn");

    $.post("/php/modifydevice.php", {product_number: productNumber, data: data})
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
