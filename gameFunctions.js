var isRunning=false; 
        var startTime;
        console.log(isRunning);
        document.addEventListener('keyup', event => {
        if ( event.code === 'Space' && isRunning==false) {
            console.log('start');
            startGame(); 
        }
        if (event.code === 'Space' && isRunning==true) {
            jump("playerSprite");
        }
    })

    function displayPoint(){
            console.log(document.getElementById("point").innerHTML= (Date.now() - startTime));
            if (isRunning==true){
                setInterval( function() { displayPoint(); }, 10 );
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

    function isCollapsed(firstIdName,secondIdName){
        
        let firstElement = document.getElementById(firstIdName).getBoundingClientRect();
        let secondElement = document.getElementById(secondIdName).getBoundingClientRect();
        if (firstElement.left + firstElement.width > secondElement.left &&
        firstElement.left < secondElement.left + secondElement.width &&
        firstElement.top < secondElement.top + secondElement.height &&
        firstElement.height + firstElement.top > secondElement.top) {
            document.getElementById("obstacle").style.animation="none";
            stopGame();
            alert("Game over");
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
