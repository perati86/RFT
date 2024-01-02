<?php require_once('config.php'); ?>
<?php require_once('database_manager.php'); ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <h1 style="text-align: center ; margin-top: 5%;">Bejelentkezés</h1>
    <br>
    <img src="../images/user-icon-person-icon-client-symbol-login-head-sign-icon-design-vector.jpg" alt="Login icon" style="height: 10%; width: 10%; margin-left: 45%;">
    <form action="" method="POST" style="margin-left: 42%; margin-top: 3%; ">
        <label for="username">Felhasználónév:</label>
        <br>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Jelszó:</label>
        <br>
        <input type="password" id="password" name="password" required>
        <br>
        <a href="main.html"><input type="submit" id="submit" value="Bejelentkezés"></a>
    </form>
    <a href="login.php">Még nem regisztráltam</a>


    <?php
        $username = '';
        $password = '';
        $errorList = [];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(array_key_exists('username',$_POST) && !empty($_POST['username'])) $username=$_POST['username'];
            else $errorList[] = 'Nincs megadva felhasználónév';

            if(array_key_exists('password',$_POST) && !empty($_POST['password'])) $password=$_POST['password'];
            else $errorList[] = 'Nincs megadva jelszó';
        
            if(count($errorList) == 0) {

                $result = [];
                $query = 'SELECT username,password FROM users WHERE users.username = \''.$username.'\';';
                $result = select($query);

                if (empty($result)) $errorList[] = 'Nincs regisztálva ilyen felhasználónév';
                else if($result[0]['password'] != crypt($password,'p8a6')) {
                    $errorList[] = 'Hibás jelszó';
                }
                else {
                    header('Refresh:0; url=http://localhost/rft_amoba/RFT/main.html');
                }
            }
            }
                
    ?>
    
    <?php if(count($errorList) > 0): ?>
                <p>Az alábbi hibák merültek fel:</p>
                <ul>
                    <?php for($i = 0; $i < count($errorList); $i++): ?>
                        <li><?=$errorList[$i]?></li>
                    <?php endfor;?>
                </ul>
            <?php endif; ?>
</body>
</html>
