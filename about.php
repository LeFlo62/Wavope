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
            <p>Arrivé en première année du cycle ingénieur de l’ISEP, c’est notre développeur en Chef. Il maîtrise parfaitement chacun des langages informatiques utilisés et saura intégrer des fonctionnalités dans vos projets. Avec lui rigueur, travail et excellence sont de misent. </p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/qiulin-chen"><img src="./Images/Qiulin.jpg" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Issue du cycle intégré international de l’ISEP, il est le chargé du développement international du projet. Maîtrisant parfaitement la langue la plus parlée du monde, il saura exporter vos projets aux mondes entiers pour séduire de nouveaux marchés.</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/raphael-gradus/"><img src="./Images/Raphael.png" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Issue du cycle intégré international de l’ISEP, il est le chargé du développement commercial du projet. Il saura vous écouter afin de vous proposer les meilleurs fonctionnalités pour votre projet. </p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/raphael-gradus/"><img src="./Images/Maxime.png" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Arrivé en première année du cycle ingénieur de l’ISEP, il est nôtre développeur web. Aucune langage ne lui fait peur. Il saura s’adapter et innover afin de de transformer vos simples projets en réussite mondiale. </p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/hugo-pabich-89a23519a/"><img src="./Images/Hugo.jpg" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Issu du cycle préparatoire associé de l’ISEP, il est celui qui étudier la faisabilité de votre projet et saura vous conseiller sur ce qui est essentiel pour la réussite de votre projet.</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/yves-le-dauphin-62852a220/"><img src="./Images/Yves.png" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Issu du cycle préparatoire associé de l’ISEP, il incarne le Chef de Projet de notre équipe. Il est celui qui fera que votre projet arrive à son terme dans les temps et avec la qualité GOOD Corp.</p>
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