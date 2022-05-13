var step=0;
var userAnswers=[];
const questions=["Combient de temps met une bouteille en plastique pour se décomposer ?","Quel est le pourcentage d'énergies renouvelables dans le mix énergétique français ?","Combien de membres compte la convention citoyenne sur le climat ?","Combien d'hectares sont brulés chaque année par les incendies (en moyenne) ?","Quelle est l'activité humaine qui émet le plus de gaz à effet de serre en France ?","Pour une tonne de plastique recyclée on économise,...","De combien de mètres augmentera le niveau de la mer si les glaces du Groënlande fondent ?","En 2050, quelle serait, selon les estimations, la hausse en moyenne sur le globe ?","Quel est le rendement théorique maximum des panneaux solaires ?","Combien y a-t-il d'installations hydroéléctriques en France ?"]
const answers= [["10-20 ans","20-50 ans","100-1000 ans*"],["9,3 %","25,3 %*","32,1 %"],["110","127","150*"],["200 000 000","350 000 000* ","454 000 000"],["Le chauffage","L'agriculture","Les déplacements motorisés*","L'industrie"],["100kg de pétrole brut","800kg de pétrole brut*","1 tonne de pétrole brut","100 tonnes de pétrole brut"],["1 m","3 m","6 m*","8 m"],["1°C","2°C","3°C*","4°C"],["20 %","31 %*","38 %","43 %"],["2300*","2600","3000","3087"]]

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
