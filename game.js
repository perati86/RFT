const cells = document.querySelectorAll(".cell");
let gameContainer = document.getElementById("gameContainer");
let TwoPlayerInput = document.getElementById("TwoPlayerInput");
let OnePlayerInput = document.getElementById("OnePlayerInput");
let selection = document.getElementById("selection");
let heading = document.getElementById("heading");
let botStartText = document.getElementById("botStartText");
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
let middleNumbers = [1,3,5,7];
let corners = [0,2,6,8];
let currentPlayer = "X";
let options = ["", "", "", "", "", "", "", "", ""];
let running = true;
let botIncluded = false;
let botIndex;

function TwoPlayerGame(){
    NewGame();
}

function OnePlayerGame(){
    NewGame();
    botIncluded = true;
    botStartText.style.visibility = "visible";
    let start = Math.random();
    if (start < 0.4)
    {
        let firstMove = Math.floor(Math.random() * middleNumbers.length);
        CellClicked(cells[middleNumbers[firstMove]], firstMove);
        botIndex = "X";
        botStartText.innerHTML = "Elvesztetted a pénzfeldobást, O-val vagy"
    }
    else if(start <= 0.5)
    {
        CellClicked(cells[4], 4);
        botIndex = "X";
        botStartText.innerHTML = "Elvesztetted a pénzfeldobást, O-val vagy"
    }
    else
    {
        botIndex = "O";
        botStartText.innerHTML = "Te nyerted a pénzfeldobást, X-szel vagy"
    }
}

function BotMove(){
    botStartText.style.visibility = "collapse";
    let opponentIndexes = getIndexesOfOpponent();
    let botIndexes = getIndexesOfBot();
    let moveIndex = -1;
    switch(opponentIndexes.length + botIndexes.length)
    {
        case 1:
            if (corners.includes(opponentIndexes[0]))
                moveIndex = 4;
            else
                moveIndex = corners[Math.floor(Math.random() * corners.length)];
            break;
        case 2:
            if (options[4] === "")
                moveIndex = 4;
    }
    if (moveIndex >= 0)
        CellClicked(cells[moveIndex], moveIndex);
}

function countNonEmptyElements(array){
    let count = 0;
    for(let i = 0; i < array.length; i++)
    {
        if (array[i] != "")
            count++;
    }
    return count;
}

function getIndexesOfOpponent(){
    let array = [];
    for(let i = 0; i < options.length; i++)
    {
        if (options[i] != "" && options[i] != botIndex)
            array.push(i);    
    }
    return array;
}

function getIndexesOfBot(){
    let array = [];
    for(let i = 0; i < options.length; i++)
    {
        if (options[i] == botIndex)
            array.push(i);
    }
    return array;
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
    gameContainer.style.visibility = 'visible';
    selection.style.visibility = 'hidden';
    running = true;
    heading.innerHTML = "A következő játékos: ".concat(currentPlayer);
}
async function changePlayer(){
    if(currentPlayer=="X") 
    {
        currentPlayer = "O";
    }
    else currentPlayer = "X";
    heading.innerHTML = "A következő játékos: ".concat(currentPlayer);
    await delay(500);
    if (botIncluded && currentPlayer == botIndex)
    {
        BotMove();
    }    
}

function delay(milliseconds){
    return new Promise(resolve => {
        setTimeout(resolve, milliseconds);
    });
}