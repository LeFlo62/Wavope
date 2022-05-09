var step=0;
var userAnswers=[];
const questions=["Combient de temps met une bouteille en plastique pour se décomposer ?","Quel est le pourcentage d'énergies renouvelables dans le mix énergétique français ?","Combien de membres compte la convention citoyenne sur le climat ?","combien d'hectares sont brulés chaque année par les incendies (en moyenne) ?",""]
const answers= [["10-20 ans","20-50 ans","100-1000 ans*"],["9,3 %","25,3 %*","32,1 %"],["110","127","150*"],["200 000 000","350 000 000 ","454 000 000"],["","",""]]

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
