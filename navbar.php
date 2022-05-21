<!-- menuBAR : DEBUT    -->
<?php
    include_once $_SERVER["DOCUMENT_ROOT"]. '/php/variables.php';

    if(!isset($_SESSION)) { 
		session_start(); 
	}
?>
<head>
    <link rel="stylesheet" href="/css/menuBar/styleMenuBar.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
</head>
<nav  class="blockmenuBar">
        <div class="logoMenuBar">
            <img src="/Images/infinitemeasures.png"></img>
        </div>
        <div class="menuBar">
            <a class="itemMenuBar" href="/">Wavope</a>
            <a class="itemMenuBar" href="/formulaire/">Contact</a>
            <?php
                if(isset($_SESSION['id'])){
                    echo '<a class="itemMenuBar" href="/game/">Jeu</a>';
                }
            ?>
            <a class="itemMenuBar" href="/faq/">FAQ</a>
            

            <?php
                if(isset($_SESSION['id'])){
                    echo '<div class="itemMenuBar dropdown">
                            <a class="dropdown-activator">'
                                .  $_SESSION["firstname"] 
                            .'</a>
                            <div class="dropdown-content dropdown-content-right">'
                                .(RANK_POWER[$_SESSION['user_rank']] > RANK_POWER['user'] ? '<a href="/backoffice/users/">Back-Office</a>' : '')
                             . '<a href="/product/">Mes appareils</a>
                                <a href="/modifyprofile/">Paramètres</a>
                                <a class="disconnection" href="/disconnect/">Se déconnecter</a>
                            </div>
                        </div>';
                } else {
                    echo '<a class="itemMenuBar" href = "/login/">Se connecter</a>';
                }
            ?>
        </div>

        <a href="javascript:void(0)" id="hamburger" onclick="openNavbar()">☰</a>

        <script>
            function openNavbar(){
                if($(".menuBar").css("display") == "none"){
                    $(".menuBar").css({"display": "flex"});
                    $("#hamburger").html("╳");
                } else {
                    $(".menuBar").css({"display": "none"});
                    $("#hamburger").html("☰");
                }
            }
        </script>
    </nav>
    <!-- menuBAR : FIN    -->