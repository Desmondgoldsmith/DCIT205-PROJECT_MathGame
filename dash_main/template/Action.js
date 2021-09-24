//javascript.js
var playing = false;
var score;
var score1;
var action;
var message;
var timeremaining;
// hide the textbox and endgame button
hide("getit");
hide("submit");
hide("namex");
//if we click on the start/reset
document.getElementById("startreset").onclick = function() {

    //if we are playing

    if (playing == true) {

        location.reload(); //reload page

    } else { //if we are not playing

        //change mode to playing

        playing = true;

        //set score to 0

        score = 0;
        document.getElementById("scorevalue").innerHTML = score;
        score1 = 0;
        document.getElementById("getit").value = score1;

        //show countdown box 

        show("timeremaining");
        timeremaining = 60;
        document.getElementById("timeremainingvalue").innerHTML = timeremaining;

        //hide game over box

        hide("gameOver");

        //change button to reset
        // document.getElementById("startreset").innerHTML = "Reset Game";
        hide("startreset");

        //start countdown

        startCountdown();

        //generate a new Q&A

        generateQA();
    }

}

//Clicking on an answer box

for (i = 1; i < 5; i++) {
    document.getElementById("box" + i).onclick = function() {
        //check if we are playing     
        if (playing == true) { //yes
            if (this.innerHTML == correctAnswer) {
                //correct answer

                //increase score by 1
                score++;
                document.getElementById("scorevalue").innerHTML = score;
                score1++;
                document.getElementById("getit").value = score1;

                //hide wrong box and show correct box
                hide("wrong");
                show("correct");
                setTimeout(function() {
                    hide("correct");
                }, 1000);

                //Generate new Q&A

                generateQA();
            } else {
                //wrong answer
                hide("correct");
                show("wrong");
                setTimeout(function() {
                    hide("wrong");
                }, 1000);
            }
        }
    }
}
//if we click on answer box
//if we are playing
//correct?
//yes
//increase score
//show correct box for 1sec
//generate new Q&A
//no
//show try again box for 1sec


//functions

//start counter

function startCountdown() {
    action = setInterval(function() {
        timeremaining -= 1;
        document.getElementById("timeremainingvalue").innerHTML = timeremaining;
        if (timeremaining == 0) { // game over
            stopCountdown();
            // show the  gameover panel
            show("gameOver");
            // show the endgame button
            show("submit");
            // setting a message
            if (score >= 15) {
                message = "GOOD JOB 💪💪💪💪";
            } else if (score < 15) {
                message = "YOU FAILED 😪😫😥😭, TRY AGAIN";
            }
            document.getElementById("gameOver").innerHTML = "<p><b style='color:red;background-color:black;font-size:20px'>Game over!⌛⌚</b></p><p><b style='color:black;font-size:20px'>Your score is " + score + ". <br style='color:white;font-size:30px'>" + message + " </b></p>";
            document.getElementById("gameOver1").value = score;

            hide("timeremaining");
            hide("correct");
            hide("wrong");
            playing = false;
            document.getElementById("startreset").innerHTML = "Start Game";
        }
    }, 1000);
}

//stop counter

function stopCountdown() {
    clearInterval(action);
}

//hide an element

function hide(Id) {
    document.getElementById(Id).style.display = "none";
}

//show an element

function show(Id) {
    document.getElementById(Id).style.display = "block";
}

//generate question and multiple answers

function generateQA() {
    var x = 1 + Math.round(9 * Math.random());
    var y = 1 + Math.round(9 * Math.random());
    correctAnswer = x * y;
    document.getElementById("question").innerHTML = x + "x" + y;
    var correctPosition = 1 + Math.round(3 * Math.random());
    document.getElementById("box" + correctPosition).innerHTML = correctAnswer; //fill one box with the correct answer

    //fill other boxes with wrong answers

    var answers = [correctAnswer];

    for (i = 1; i < 5; i++) {
        if (i != correctPosition) {
            var wrongAnswer;
            do {
                wrongAnswer = (1 + Math.round(9 * Math.random())) * (1 + Math.round(9 * Math.random())); //a wrong answer
            } while (answers.indexOf(wrongAnswer) > -1)
            document.getElementById("box" + i).innerHTML = wrongAnswer;
            answers.push(wrongAnswer);
        }
    }
}