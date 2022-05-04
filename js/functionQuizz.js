var step=0;
var userAnswers=[];
const questions=["Qu’est-ce qui peut faire le tour du monde en restant dans son coin ?","Quel est l’ami qu’on ne peut pas supporter ?","J’ai un chapeau, mais pas de tête. J’ai un pied mais pas de chaussures. Qui suis-je?"]
const answers= [["Un timbre","lorem2","lorem3"],["La migraine","lorem2","lorem3","lorem4"],["Un champignon","lorem2","lorem3"]]

function nextStepQuizz(){
    let percentageValue=100*step/(questions.length);
    document.getElementById("percentage").innerHTML= percentageValue+"%";
    document.documentElement.style.setProperty('--h', percentageValue+ '%') //Change the progressBar Value
    if (percentageValue==100){
        newQuestion("Vous avez terminé le quizz",[]);
        console.log("Réponse de l'utilisateur:" + userAnswers);
    }
    else{
        newQuestion(questions[step],answers[step])
        step+=1;
    }
}
function newQuestion(question,answers){
    document.getElementById("answerBlock").innerHTML = ''; //Delete the previous Question/Answer
    document.getElementById("question").innerHTML=question;
    for(var i=0;i<answers.length;i++){
        let  newAnswer = document.createElement("div");
        newAnswer.classList.add("answer");
        let newContent = document.createTextNode(answers[i]);
        newAnswer.appendChild(newContent);
        document.getElementById('answerBlock').appendChild(newAnswer);
    }
    let answerElement = document.getElementsByClassName("answer");
    for (var i = 0; i < answerElement.length; i++) {
        answerElement[i].addEventListener('click', function(){
            userAnswers.push(this.innerHTML);
            nextStepQuizz();
        }, false);
    }
}
nextStepQuizz();
