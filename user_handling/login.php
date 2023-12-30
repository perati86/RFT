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
    <img src="user-icon-person-icon-client-symbol-login-head-sign-icon-design-vector.jpg" alt="Login icon" style="height: 10%; width: 10%; margin-left: 45%;">
    <form action="" method="POST" style="margin-left: 42%; margin-top: 3%;">
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
</body>
</html>
