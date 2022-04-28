<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr" style="scroll-behavior:smooth;">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Back-Office</title>

        <link rel="stylesheet" href="./css/styleBackOffice.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    </head>
    <body>
        <div id="masthead">
            <div id="topbar-corner">
                <p id="master-page-title">Back-Office</p>
                <a id="back-to-site" href="/">Retours à Wavope</a>
            </div>
        </div> 
        <div class="navbar">
            <div class="masthead-spacer"></div>
            <a <?php if($_GET['p'] === 'cards') { echo 'class="selected"';} ?> href="?p=cards">Cartes</a>
            <a <?php if($_GET['p'] === 'users') { echo 'class="selected"';} ?> href="?p=users">Utilisateurs</a>
            <a <?php if($_GET['p'] === 'devices') { echo 'class="selected"';} ?> href="?p=devices">Appareils</a>
        </div>
        <div class="content">
            Test
        </div>
    </body>    
</html>