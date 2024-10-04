document.addEventListener('DOMContentLoaded', () => {
    
    const question = document.querySelector(".question");
    const quest_num = document.querySelector(".quest_num");
    const quest_count = document.querySelector(".quest_count");
    const quiz = document.querySelector('.quiz');
    const boxReponses = document.querySelector('.box_reponses');
    const timerElement = document.querySelector(".box-timer");
    const next_btn = document.querySelector(".nextBtn");
    const valid_btn = document.querySelector(".validBtn");

    let currentQuestionIndex = 0
    let timeValue =  30;
    var timer;
    let questions = [];
    let correctAnswers = 0;

    async function loadQuestions() {
        try {
            const response = await fetch('/api/questions');
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            questions = data.questions;
            showQuestions(currentQuestionIndex);
            startTimer(timeValue);
        } catch (error) {
            console.error(error);
            window.location.href = '/home';
        }
    }

    // function loadQuestions() {
    //     fetch('/api/questions')
    //         .then(response => response.json())
    //         .then(data => {
    //             console.log(data);
    //             questions = data.questions;
    //             startTimer(timeValue);
    //             showQuestions(currentQuestionIndex);
    //         })
    //         .catch(error => console.error(error));
    // }

    // localStorage.setItem('totalQuestions',totalQuestions);

    function showQuestions(index){
        const currentQuestion = questions[index];
        quest_num.innerHTML = currentQuestion.quest_id;
        quest_count.innerHTML = questions.length;
        question.innerHTML = currentQuestion.question;

        boxReponses.innerHTML = `
                ${currentQuestion.reponses.map((reponse, i) => `
                    <div class="card p-3 mb-4">
                        <label class="form-check-label fw-semibold d-flex justify-content-between align-items-center" for="reponse${reponse.id}q${i}">
                            <span>${reponse.texte}</span>
                            <div class="radiobtn">
                                <input type="radio" class="form-check-input rounded-circle" value="${reponse.texte}" name="question${currentQuestion.quest_id}" id="reponse${reponse.id}q${i}">
                                <span class="">
                                    <svg class="checked" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </label>
                    </div>
                `).join('')}`;

                // disabled les inputs
                quiz.querySelectorAll('input').forEach(input => {input.disabled = false;});
    }

    function startTimer(duration) {
        let timerValue = duration;
        timerElement.textContent = timerValue;
        setTimeout(() => {
            timer = setInterval(() => {
                if (timerValue > 0) {
                    timerElement.textContent = --timerValue;
                }
                else {
                    clearInterval(timer);
                    handleSubmit();
                }
            }, 1000);
        },500);
    }

    function handleSubmit() {
        clearInterval(timer);

        const currentQuestion = questions[currentQuestionIndex];

        const selectedValue = boxReponses.querySelector('input[type="radio"]:checked')?.value || null;
        // const selectedValue = selectedOption ? selectedOption.value : null;

        const cards = boxReponses.querySelectorAll('.card');

        const correctAnswer = currentQuestion.reponses.find(rep => rep.is_correct).texte;       

        cards.forEach(card => {
            card.classList.remove('correct', 'incorrect');
        });

        const selectedCard = Array.from(cards).find(card => card.querySelector(`input[value="${selectedValue}"]`));
        const correctCard = Array.from(cards).find(card => card.querySelector(`input[value="${correctAnswer}"]`));

        if (selectedValue) {
            if (selectedValue === correctAnswer) {
                correctAnswers++;
                console.log("true");
                if (selectedCard) selectedCard.classList.add('correct');
            } else {
                console.log("false");
                if (selectedCard) selectedCard.classList.add('incorrect');
                if (correctCard) correctCard.classList.add('correct');
            }
        } else {
            console.log("rien");
            if (correctCard) correctCard.classList.add('correct');
        }
    
        console.log(correctAnswers);

        const inputs = quiz.querySelectorAll('input');
        inputs.forEach(input => {
            input.disabled = true;
        });
    
        next_btn.classList.remove('d-none');
        valid_btn.classList.add('d-none');
    }
    
    function saveScore(score) {

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/score', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                score: score
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }

            return response.json();
        })
        .then(result => {
            console.log('Score enregistré:', result);
            window.location.href = '/reponse';
        })
        .catch(error => console.error('Erreur lors de l\'enregistrement du score:', error));
    }

    // valider
    valid_btn.addEventListener('click',  handleSubmit);
    
    // next question
    next_btn.addEventListener('click', () => {
        
        const cards = boxReponses.querySelectorAll('.card');
        
        // cards.forEach(card => {
        //     card.classList.remove('correct', 'incorrect');
        //     console.log('Classes removed');
        // });

        quiz.querySelectorAll('input').forEach(input => input.disabled = false);

        window.scrollTo(0,0);

        if (currentQuestionIndex < questions.length - 1) {
            currentQuestionIndex++;
            next_btn.classList.add('d-none');
            valid_btn.classList.remove('d-none');    
            startTimer(timeValue);
            showQuestions(currentQuestionIndex);
        } else {
            // console.log(correctAnswers);
            saveScore(correctAnswers);
        }
    });
        
    loadQuestions();
    window.scrollTo(0,-1);  
});

