var isRunning=false; 
var startTime;
console.log(isRunning);
document.addEventListener('keydown', event => {
if ( event.code === 'Space' && isRunning==false) {
    console.log('start');
    startGame(); 
}
if (event.code === 'Space' && isRunning==true) {
    jump("playerSprite");
}
if (event.key === 'ArrowLeft') {
    leftMove("playerSprite");
}
if (event.key === 'ArrowRight') {
    rightMove("playerSprite");
    }

})

function displayPoint(){
        document.getElementById("point").innerHTML= (Date.now() - startTime)/10;
        if (isRunning==true){
            setInterval( function() { displayPoint(); }, 100 );
        }   
        else{
            document.getElementById("point").innerHTML= 0;
        }
    }

    function jump(idName){      
        document.getElementById(idName).animate([
            { transform: 'translateY(0px)' },
            { transform: 'translateY(-80px)' },
            { transform: 'translateY(-140px)' },
            { transform: 'translateY(-80px)' },
            { transform: 'translateY(0px)' }
            ], {
            duration: 600,
            });
    }

    function rightMove(idName){
        console.log("right");
    }

    function leftMove(idName){
        console.log("left");
    }

function isCollapsed(firstIdName,secondIdName){
    
    let firstElement = document.getElementById(firstIdName).getBoundingClientRect();
    let secondElement = document.getElementById(secondIdName).getBoundingClientRect();
    if (firstElement.left + firstElement.width > secondElement.left &&
    firstElement.left < secondElement.left + secondElement.width &&
    firstElement.top < secondElement.top + secondElement.height &&
    firstElement.height + firstElement.top > secondElement.top) {
        document.getElementById("obstacle").style.animation="none";
        stopGame();
        alert("Game over: arretez d'utiliser des bouteilles en plastiques !!");
    }
    else{
        setInterval( function() { isCollapsed(firstIdName,secondIdName); }, 10 );
    }
}

function startGame(){
    startTime= Date.now();
    isRunning=true;
    document.getElementById("obstacle").style.animation="obstacleAnimation 2s linear infinite";
    displayPoint();
    isCollapsed("playerSprite","obstacle");
}

function stopGame(){
    isRunning=false;
    console.log(document.getElementById("point").innerHTML= Date.now() - startTime);
}
