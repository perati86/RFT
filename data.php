<?php require_once('user_handling/config.php'); ?>
<?php require_once('user_handling/database_manager.php'); ?>

<?php
        if(isset($_POST['gameMode'])) {
            session_start();
            $username = $_SESSION['username'];
            $gameMode = $_POST['gameMode'];
            $result = $_POST['result'];
            $insertQuery = 'INSERT INTO stats(username, gameMode, gameTime, result) 
                            VALUES(\''.$username.'\', \''.$gameMode.'\', SYSTIMESTAMP, \''.$result.'\');';
            select($insertQuery);
        }
        header("Location", "http://localhost/rft_amoba/RFT/game.php")
    ?>