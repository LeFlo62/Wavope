<!DOCTYPE html>
<head>
  <html lang="fr">
  <link rel="stylesheet" href="./css/styleSwiperCard.css">
  <link rel="stylesheet" href="./css/styleAnimationOnScroll.css">
</head>
<body>
<?php include 'navbar.php' ?>
<div class="blockAll">
  <div class="titre">
      <h1>Titre du jeu</h1>
      <p class="descriptionJeu">Description Jeu </p>
      <h2>Questions </h2>
    </div>
  <div class="jeu">
    <ul>Question 1:
      <li>Intitulé question 1 :</li>
      <li><button class= "yesbutton">oui</button></li>
      <li><button class= "nobutton">non</button></li>
        Question 2:
      <li>Intitulé question 2 :</li>
      <li><button class= "yesbutton">oui</button></li>
      <li><button class= "nobutton">non</button></li>
    </ul>
  </div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" class="svgWave" viewBox="0 0 1440 320"><path class="svgWaveCaracteristique" d="M 0 160 L 48 160 C 96 160 192 160 288 181.3 C 384 203 480 245 576 229.3 C 672 213 768 139 864 96 C 960 53 1056 43 1152 48 C 1248 53 1344 75 1392 85.3 L 1440 96 L 1440 320 L 1392 320 C 1344 320 1248 320 1152 320 C 1056 320 960 320 864 320 C 768 320 672 320 576 320 C 480 320 384 320 288 320 C 192 320 96 320 48 320 L 0 320 Z" /></svg>

  <!--?php include 'footer.php'  ?-->

</body>
    
<style>
  html, body{
    height: 100%;
}

body{
        
    padding: 0px;
    margin: 0px;
   

}
.titre{
  display:flex;
  margin-bottom: 33px;
  border-radius: 12px;

}
h1{
  position: absolute;
    color: rgb(118, 177, 100);
    font-family: 'Roboto', sans-serif;
    text-align: center;
    top:22%;
  margin-bottom: 33px;
    border-radius: 12px;
}
h2{
  position: absolute;
    color: rgb(118, 177, 100);
    font-family: 'Roboto', sans-serif;
    text-align: center;
    top:22%
    padding:3%;
    margin-bottom: 33px;
    border-radius: 12px;
}
.svgWave{

    position: absolute;
    bottom: 0px;

}
.svgWaveCaracteristique{

    fill:rgb(118, 177, 100);
    fill-opacity:1;
}
.blockAll{

    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

}
.jeu{
  font-size:larger;
  font-family: 'Roboto', sans-serif;
}
.descriptionJeu{
  justify-content: center;
  align-items: center;
  padding:10% ;
  
}
.yesbutton{
  display:inline-block;
  position: absolute;
  background-color:rgb(118, 177, 100);
  border: none;
  display: inline-block;
  border-radius: 25px;
  width: 40px;
  text-decoration:none;
  font-family: sans-serif;
  border-style: solid;
  border-width: thin;
}
.yesbutton:hover{
  color:white;
  transform: scale(1.1);
  transition:0.1s;
}
.nobutton{
  display:inline-block;
  position: absolute;
  background-color:red;
  border: none;
  display: inline-block;
  border-radius: 25px;
  width: 40px;
  text-decoration:none;
  font-family: sans-serif;
  border-style: solid;
  border-width: thin;
}
.nobutton:hover{
  color:white;
  transform: scale(1.1);
  transition:0.1s;
}

  </style>

    
    
    
