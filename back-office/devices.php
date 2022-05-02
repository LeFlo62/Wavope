<?php
    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';

    if(!isset($_SESSION)) { 
        session_start(); 
    }

    if(!isset($_SESSION['id'])) { 
		header("Location: /login.php");
        exit;
	}

    if(RANK_POWER[$_SESSION['user_rank']] < 1){
        header("Location: /");
        exit;
    }
?>
<link rel="stylesheet" href="./back-office/css/devices.css">
<script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>

<div class="devices-table">
    <div class="devices-table-row title">
        <div class="devices-table-col">
            Numéro produit
        </div>
        <div class="devices-table-col">
            Nom du produit
        </div>
        <div class="devices-table-col">
            Compte
        </div>
    </div>
    <?php
        include_once './php/mysql.php';

        $bdh = new DBHandler();

        $reqdata = $bdh->getInstance()->prepare("SELECT product_number,name,firstname,lastname,user_rank,products.user_id FROM products JOIN user_data ON products.user_id = user_data.user_id");
        $reqdata->execute();
        $data = $reqdata->fetchAll();

        foreach($data as $row){
            $modifiable = $row['user_id'] === $_SESSION['id'] || RANK_POWER[$row['user_rank']] < RANK_POWER[$_SESSION['user_rank']];

            echo '<div class="devices-table-row">
            <div class="devices-table-col">
                <p class="hint">Numéro produit: </p><p>'. $row['product_number'] .'</p>
            </div>
            <div class="devices-table-col">
                <p class="hint">Nom du produit: </p><p>'. $row['name'] .'</p>' . ($modifiable ? ' <i data-type="name" product-number="'. $row['product_number'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="devices-table-col">
                <p class="hint">Compte: </p><p>'. $row['firstname'] . ' ' . $row['lastname'] .'</p>' . '
            </div>
        </div>';
        }
    ?>
    <div id="snackbar"></div>
    <script>
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
    </script>
</div>