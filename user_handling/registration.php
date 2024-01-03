<?php require_once('config.php'); ?>
<?php require_once('database_manager.php'); ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Registration</title>
</head>
<body>
    <h1 style="text-align: center ; margin-top: 5%;">Regisztráció</h1>
    <br>
    <img src="../images/user-icon-person-icon-client-symbol-login-head-sign-icon-design-vector.jpg" alt="Login icon" style="height: 10%; width: 10%; margin-left: 45%;">
    <form action="" method="POST" style="margin-left: 43%; margin-top: 3%; margin-bottom: 2%;">
        <label for="username">Felhasználónév:</label>
        <br>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Jelszó:</label>
        <br>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="password">Jelszó ismét:</label>
        <br>
        <input type="password" id="rep_password" name="rep_password" required>
        <br>
        <a href="../main.html" style="margin-top: 1%;"><input type="submit" id="submit" value="Regisztráció"></a>
    </form>
    <a href="login.php" style="margin-left: 43%;">Már regisztráltam</a>

    <?php
        $username = '';
        $password = '';
        $errorList = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(array_key_exists('username',$_POST) && !empty($_POST['username'])) {
                $username=$_POST['username'];
                if (!preg_match('/[a-zA-Z]/', $username[0])) $errorList[] = 'A felhasználónév csak betűvel kezdődhet';
                if (strlen($username) < 6) $errorList[] = 'A felhasználónévnek legalább 6 karakter hosszúnak kell lennie';
            }
            else $errorList[] = 'Nincs megadva felhasználónév';

            if(array_key_exists('password',$_POST) && !empty($_POST['password'])) {

                $password=$_POST['password'];

                if (strlen($password) < 8) $errorList[] = 'A jelszónak legalább 8 karakter hosszúnak kell lennie';

                $hasUppercase = false;
                $hasNumber = false;
                for($i=0;$i<strlen($password);$i=$i+1) {
                    if (preg_match('/[A-Z]/', $password[$i])) $hasUppercase = true;
                    if (is_numeric($password[$i])) $hasNumber = true;
                }
                if (!$hasNumber) $errorList[] = 'A jelszónak tartalmaznia kell legalább egy számot';
                if (!$hasUppercase) $errorList[] = 'A jelszónak tartalmaznia kell legalább egy nagybetűt';

                if(array_key_exists('rep_password',$_POST) && !empty($_POST['rep_password'])){
                    $rep_password=$_POST['rep_password'];
                    if($password != $rep_password) $errorList[] = 'Az ismételt jelszó nem egyezik az eredetivel';
                }
                else $errorList[] = 'Az ismételt jelszó nincs megadva';
            }
            else{
                $errorList[] = 'Nincs megadva jelszó';
            }

            
        
        
            if(count($errorList) == 0) {

                $result = [];
                $query = 'SELECT username,password FROM users WHERE users.username = \''.$username.'\';';
                $result = select($query);

                if (!empty($result)) $errorList[] = 'Ez a felhasználónév már regisztrálva van';
                else {
                    $insertQuery = 'INSERT INTO users(username,password) VALUES(\''.$username.'\', \''.crypt($password,'p8a6').'\');';
                    select($insertQuery);
                    session_start();
                    $_SESSION['username'] = $username;
                    echo 'Sikeres regisztráció!';
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