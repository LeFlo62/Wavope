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
            <a href="https://www.linkedin.com/in/zakia-kazi-aoul-0a29ab8/"><img src="./Images/zakia_kazi_aoul.png" alt="image 1" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Zakia Kazi-Aoul est une enseignante-chercheuse et responsable du domaine informatique de l'ISEP.</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href=""><img src="./Images/mariam_camara.png" alt="image 2" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Mariam Camara est une enseignante-chercheuse de l'ISEP.</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/fr%C3%A9d%C3%A9ric-amiel-911a5a20/"><img src="./Images/frederic_amiel.png" alt="image 3" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Frédéric Amiel est un enseignant-chercheur et responsable du domaine électronique de l'ISEP.</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/florence-rossant-37469962/"><img src="./Images/florence_rossant.png" alt="image 4" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Florence Rossant est une enseignante-chercheuse de l'ISEP. Elle est responsable du groupe DASSIP et possède une Habilitation à Diriger les Recherches (HDR).</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/samiaoukemeni/"><img src="./Images/samia_oukemeni.png" alt="image 5" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Samia Oukemeni est une enseignante-chercheuse de l'ISEP.</p>
        </div>
        <a class="square_btn1">Voir plus </a>
    </div>

    <div class="blockProfil reveal duration1">
        <div class="blockProfilImage">
            <a href="https://www.linkedin.com/in/ahmed-messaoudi-29147a112/"><img src="./Images/ahmed_messaoudi.png" alt="image 6" class="imageProfil"></a>
        </div>
        <div class="blockProfilDescription">
            <p>Ahmed Messaoudi est un enseignant de l'ISEP.</p>
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