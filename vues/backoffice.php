<!DOCTYPE html>
<html lang="fr" style="scroll-behavior:smooth;">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Back-Office</title>

        <link rel="stylesheet" href="/css/styleBackOffice.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

        <script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
    </head>
    <body>
        <div id="masthead">
            <div id="topbar-corner">
                <p id="master-page-title">Back-Office</p>
                <a id="back-to-site" href="/">Retours à Wavope</a>
            </div>
            <div id="middle-bar">
                <?php
                    if($params['page'] !== 'cards' && $params['page'] !== 'faq'){
                        echo '<input type="text" class="search" placeholder="Recherche"></input>';
                    }
                ?>
            </div>
        </div> 
        <div class="navbar">
            <div class="masthead-spacer"></div>
            <a <?php if($params['page'] === 'cards') { echo 'class="selected"';} ?> href="/backoffice/cards">Cartes</a>
            <a <?php if($params['page'] === 'faq') { echo 'class="selected"';} ?> href="/backoffice/faq">FAQ</a>
            <a <?php if($params['page'] === 'users') { echo 'class="selected"';} ?> href="/backoffice/users">Utilisateurs</a>
            <a <?php if($params['page'] === 'devices') { echo 'class="selected"';} ?> href="/backoffice/devices">Appareils</a>

        </div>
        <div class="content">
            <?php
                switch($params['page']){
                    case 'cards':
                        include './back-office/cards.php';
                        break;
                    default:
                    case 'users':
                        include './back-office/users.php';
                        break;
                    case 'devices':
                        include './back-office/devices.php';
                        break;
                    case 'faq':
                        include './back-office/faq.php';
                        break;
                }
            ?>
        </div>
        <script>
            jQuery.extend(jQuery.expr[':'], { 
                "starts-with-lowercase" : function(el, i, p, n) {
                    return (el.textContent || el.innerText).toLowerCase().indexOf(p[3].toLowerCase()) === 0;
                }
            });
            <?php $p = $params['page']; ?>
            $('input.search').on('change input paste keyup', function(){
                var value = $(this).val();
                if(value != ''){
                    $('.<?php echo $p; ?>-table').children(".<?php echo $p; ?>-table-row").not('.title').css({'display': 'none'});
                    var findings = $('.<?php echo $p; ?>-table').children('.<?php echo $p; ?>-table-row:has(p:starts-with-lowercase("' + value + '"))');

                    if(findings.length == 0){
                        findings = $('.<?php echo $p; ?>-table').children('.<?php echo $p; ?>-table-row:contains("' + value + '")');
                    }

                    findings.css({'display': 'flex'});
                } else {
                    $('.<?php echo $p; ?>-table').children('.<?php echo $p; ?>-table-row').css({'display': 'flex'});
                }
            });
        </script>
    </body>    
</html>