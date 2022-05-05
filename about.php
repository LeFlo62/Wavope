<!DOCTYPE html>
<html lang="en" style="scroll-behavior:smooth;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styleAbout.css">
    <link rel="stylesheet" href="./css/styleButton.css">
</head>

<body>

<section class="blockAll">
    <?php include 'navbar.php' ?>
    <svg class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique"  d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,229.3C672,213,768,139,864,96C960,53,1056,43,1152,48C1248,53,1344,75,1392,85.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>


    <div class="topPage">
        <div class="blockText"> <div class="text">Une équipe.</div></div>
        <div class="blockText"> <div class="text second">Unie. </div></div>
        <div class="blockText"> <div class="text third">Forte. </div></div>
        <br><br><br>
        <a href="#middlePage" id="button" class="square_btn1 fourth" style="background-color: #8cfd7d;;color:white;" >Voir l'équipe ↓</a>
    </div>
    
    <div id="middlePage" class="middlePage">
    <div class="blockProfil">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/florentin-leclercq-b874a021b/"><img src="./Images/Florentin.jpeg" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Entré à l'ISEP en première année du cycle ingénieur cette année, Florentin est le développeur de notre équipe. Il maitrise les dernières technologies du moment</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/qiulin-chen"><img src="./Images/Qiulin.jpg" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>lorem ipsum amet, consectetur adipiscing elit. Integer vel</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/raphael-gradus/"><img src="./Images/Raphael.png" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>lorem ipsum amet, consectetur adipiscing elit. Integer vel</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/raphael-gradus/"><img src="./Images/Maxime.png" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>lorem ipsum amet, consectetur adipiscing elit. Integer vel</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/hugo-pabich-89a23519a/"><img src="./Images/Hugo.jpg" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>lorem ipsum amet, consectetur adipiscing elit. Integer vel</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/yves-le-dauphin-62852a220/"><img src="./Images/Yves.png" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>lorem ipsum amet, consectetur adipiscing elit. Integer vel</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>
    </div>
</section>
</div>

</div>

<script>
    document.getElementById("button").style.animation="buttonAnimation 3s linear infinite";
        
    const ratio = .3
    const options = {
    root: null,
    rootMargin: '0px',
    threshold:ratio
    }
    const handleIntersect = function (entries, observer) {
    entries.forEach(function (entry) {
        if (entry.intersectionRatio > ratio) {
        entry.target.classList.add('reveal-visible')
        observer.unobserve(entry.target)
        }
    })
    }
    const observer = new IntersectionObserver(handleIntersect, options)
    document.querySelectorAll('[class*="reveal"]').forEach(function (re) {
        observer.observe(re)
    })
 

</script>
</body>
</html>