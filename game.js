const cells = document.querySelectorAll(".cell");
let gameContainer = document.getElementById("gameContainer");
let TwoPlayerInput = document.getElementById("TwoPlayerInput");
let OnePlayerInput = document.getElementById("OnePlayerInput");
let selection = document.getElementById("selection");
let heading = document.getElementById("heading");
TwoPlayerInput.addEventListener("click", TwoPlayerGame);
OnePlayerInput.addEventListener("click", OnePlayerGame);

const winConditions = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
];
let currentPlayer = "X";
let options = ["", "", "", "", "", "", "", "", ""];
let running = true;

function TwoPlayerGame(){
    gameContainer.style.visibility = 'visible';
    selection.style.visibility = 'hidden';
    running = true;
    heading.innerHTML = "A következő játékos: ".concat(currentPlayer);
}

function OnePlayerGame(){
    alert("1");
}

function CellClicked(cell, index){
    if(cell.innerHTML != "X" && cell.innerHTML != "O" && running)
    {
        cell.innerHTML = currentPlayer;
        options[index] = currentPlayer;

        checkOutcome();
        if(running)
        {
            changePlayer();
        }
    }
}

function checkOutcome(){
    for(let i = 0; i < winConditions.length; i++){
        const condition = winConditions[i];
        const cell1 = options[condition[0]];
        const cell2 = options[condition[1]];
        const cell3 = options[condition[2]];

        if(cell1 == cell2 && cell2 == cell3 && (cell1 == "X" || cell1 == "O")){
            heading.innerHTML = "A játék győztese: ".concat(currentPlayer);
            running = false;
            break;
        }
    }

    if(!options.includes("") && running){
        heading.innerHTML = "Döntetlen!";
        running = false;
    }
}

function NewGame(){
    
}
function changePlayer(){
    if(currentPlayer=="X") 
    {
        currentPlayer = "O";
    }
    else currentPlayer = "X";
    heading.innerHTML = "A következő játékos: ".concat(currentPlayer);
}

function delay(milliseconds){
    return new Promise(resolve => {
        setTimeout(resolve, milliseconds);
    });
}