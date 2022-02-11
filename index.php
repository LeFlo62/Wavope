<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wavope</title>
    <link rel="stylesheet" href="./css/menuBar/styleMenuBar.css">
    <link rel="stylesheet" href="./css/styleButton.css">
    <link rel="stylesheet" href="./css/styleSwiperCard.css">
    <link rel="stylesheet" href="./css/styleAnimationOnScroll.css">
    <link rel="stylesheet" href="./css/styleMain.css">
    
</head>
<body>

    <!-- menuBAR : DEBUT    -->
    <nav  class="blockmenuBar">
        <div class="menuBar">
            <div class="itemMenuBar">— Wavope —</div>
            <div class="itemMenuBar">Se connecter</div>
            <div class="itemMenuBar">Nous contacter</div>
            <div class="itemMenuBar">Autres</div>
        </div>

        <div id="hamburger">
            <nav role="navigation"> 
                <div id="menuToggle">
                    <input type="checkbox" />

                    <span></span>
                    <span></span>
                    <span></span>

                    <ul id="menuHamburger">
                    <a href="#"><li>Rechercher</li></a>
                    <a href="#"><li>Se connecter</li></a>
                    <a href="" target="_blank"><li>Informations</li></a>
                    </ul>
                   
                </div>
            </nav>
        </div>
    </nav>
    <!-- menuBAR : FIN    -->



    <section class="SectionTopPage">
        <div class="blockTextPhoneTop" id="leftblockTextPhone">
            <div class="titreBlockTextPhoneTop reveal">
                <h1>WAVOPE</h1>
            </div>
            <div class="TextPhoneTop reveal duration1" >
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, 
                adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, 
                semper congue, euismod non, mi.
            </div>
            <div class="blockButtonTop">
                <a href="#" class="square_btn1">S'INSCRIRE</a>
                <a href="#" class="square_btn2">SE CONNECTER</a>
            </div>
        </div>

        <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    </section>

        <script type="text/javascript" src="./js/revealDefilementScript.js"> </script>
</body>
</html>



