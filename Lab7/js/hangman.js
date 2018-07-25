//VARIABLES
/*global $*/
/*global location*/
var selectedWord = "";
var selectedHint = "";
var board = [];
var remainingGuesses = 6;
var words = [{word: "snake", hint: "It's a reptile"},
             {word: "monkey", hint: "It's a mammal"},
             {word: "beetle", hint: "It's an insect"}];
var hintRevealed = false;

// Creating an array of available letters
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

//FUNCTIONS
function startGame() {
    pickWord();
    initBoard();
    updateBoard();
    createLetters();
}

function pickWord() {
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}

function updateBoard () {
    $("#word").empty();
    
    for (var i=0; i < board.length; i++) {
        $("#word").append(board[i]+ " ");
    }
    
    $("#word").append("<br />");
    $("#word").append("<span class='hint'>Hint: " + selectedHint + "</span>");
    
    if(hintRevealed) {
        $(".hint").show();
    }
}

function initBoard() {
    //Fill the board with underscores
    for(var letter of selectedWord) {
        board.push("_");
    }
}

function createLetters() {
    for (var letter of alphabet) {
        $("#letters").append("<button class='letter btn' id='" + letter + "'>" + letter + "</button>");
    }
}

function updateWord(positions, letter) {
    for (var pos of positions) {
        board[pos] = letter;
    }
    
    updateBoard();
}

// Checks to see if the selected letter exists in the selectedWord
function checkLetter(letter) {
    var positions = new Array();
    
    //Put all the positions the letter exists in an array
    for (var i = 0; i < selectedWord.length; i++) {
        console.log(selectedWord);
        if (letter == selectedWord[i]) {
            positions.push(i);
        }
    }
    
    if (positions.length > 0) {
        updateWord(positions, letter);
        
        $("#" + letter).attr("class", "btn btn-success");
        
        if(!board.includes('_')) {
            endGame(true);
        }
    } else {
        remainingGuesses -= 1;
        updateMan();
    }
    
    if (remainingGuesses <= 0) {
        endGame(false);
    }
}

function updateMan() {
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}

function endGame(win) {
    $("#letters").hide();
    $(".hintbtn").hide();
    
    if(win) {
        $('#won').show();
    } else {
        $('#lost').show();
    }
}

function disableBtn(btn) {
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger");
}

//LISTENERS
window.onload = startGame();

$(".letter").click(function() {
    disableBtn($(this));
    checkLetter($(this).text());
});

$("#hintbtn").on("click", function() {
    checkLetter(0);
    $(".hintbtn").hide();
    $(".hint").show();
    hintRevealed = true;
});

$(".replayBtn").on("click", function() {
    location.reload();
});

