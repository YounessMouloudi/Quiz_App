document.addEventListener('DOMContentLoaded', () => {
    
    const scoreText = document.querySelector('.score');
    const totalText = document.querySelector('.total');
    const messageText = document.querySelector('.message');
    
    const score = parseInt(scoreText.textContent);
    const totalQuestions = parseInt(totalText.textContent);
    const currentUrl = window.location.pathname;

    if (!isNaN(score) && !isNaN(totalQuestions)) {
        if(currentUrl === '/reponse') {
            if ((score === totalQuestions) && score > 0 && totalQuestions > 0 ) {
                messageText.textContent = "Félicitations ! Vous avez répondu à toutes les questions.";
            } 
            else if (score === 0) {
                messageText.textContent = "Pas de chance cette fois-ci ! Vous n'avez répondu à aucune question.";
            } else {
                messageText.textContent = `Bien joué ! Vous avez répondu correctement à ${score} question(s). Continuez à vous améliorer !`;
            }
        }
        else if (currentUrl === '/score') {
            if ((score === 10) && score > 0 ) {
                messageText.textContent = "Wow ! Vous avez réussi brillamment ce quiz !";
            } 
            else if (score === 0) {
                messageText.textContent = "Oups ! Aucune réponse correcte, mais ne désespérez pas !";
            } else {
                messageText.textContent = "Bravo ! Vous êtes sur la bonne voie, continuez à pratiquer !";
            }
        }
    }
});