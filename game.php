<?php require_once('user_handling/config.php'); ?>
<?php require_once('user_handling/database_manager.php'); ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <script src="game.js" defer></script>
    <title>Játék</title>
</head>

<body class="game_hatter">
    <h1 class="felirat" id="heading" style="text-align: center; margin-top: 3%;margin-bottom: 3%;">Válassz játékmódot</h1>
    <h6 class="felirat" id="botStartText" style="text-align: center; visibility: collapse;"></h6>
    <table id="selection" style="margin-left: 40%; visibility: visible;">
        <tr>
            <td style="padding-right: 70px;"><input type="submit" id="TwoPlayerInput" value="2 játékos mód"></td>
            <td><input type="submit" id="OnePlayerInput" value="Játék gép ellen"></td>
        </tr>
    </table>

    <div id="gameContainer" style="text-align: center;   margin-top: 3%;
     margin-bottom: 3%; margin-right: 48%;">
        <table id="gameTable" style="margin: 0 auto; border: solid white; font-family: Permanent Marker, cursive; font-size: xx-large; height: 420px; width: 420px;">
            <tr style="border: solid white;">
                <td onclick="CellClicked(this, 0)" id="0" class="cell" style="border: solid white;"></td>
                <td onclick="CellClicked(this, 1)" id="1" class="cell" style="border: solid white;"></td>
                <td onclick="CellClicked(this, 2)" id="2" class="cell" style="border: solid white;"></td>
            </tr>
            <tr style="border: solid white;">
                <td onclick="CellClicked(this, 3)" id="3" class="cell" style="border: solid white;"></td>
                <td onclick="CellClicked(this, 4)" id="4" class="cell" style="border: solid white;"></td>
                <td onclick="CellClicked(this, 5)" id="5" class="cell" style="border: solid white;"></td>
            </tr>
            <tr style="border: solid white;">
                <td onclick="CellClicked(this, 6)" id="6" class="cell" style="border: solid white;"></td>
                <td onclick="CellClicked(this, 7)" id="7" class="cell" style="border: solid white;"></td>
                <td onclick="CellClicked(this, 8)" id="8" class="cell" style="border: solid white;"></td>
            </tr>
        </table>
    
        <br>
          <table style="margin-left: 20%;">
            <tr>
                <td >
                    <a href="game.php"><input onclick="NewGame()" type="submit" id="newgame" value="Új játék"></a>
                </td>
            </tr>
            <tr>
                <td>
                     <a href="main.html"><input type="submit" id="exittomenu" value="Főmenü"></a>
                </td>
            </tr>
          </table>
    </div>
    <?php
        if(isset($_POST['gameMode'])) {
            session_start();
            $username = $_SESSION['username'];
            $gameMode = $_POST['gameMode'];
            $result = $_POST['result'];
            $insertQuery = 'INSERT INTO stats(username, gameMode, result) 
                            VALUES(\''.$username.'\', \''.$gameMode.'\', \''.$result.'\');';
            select($insertQuery);
        }
    ?>
    
    
</body>
</html>
