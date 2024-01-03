<?php
    require_once('user_handling/config.php');
    require_once('user_handling/database_manager.php');

    $query = 'SELECT * FROM stats ORDER BY gameTime DESC';
    $results = select($query);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <title>Statisztika</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        </style>
</head>
<body class="stat_hatter">
    <h1 style="text-align: center;">Statisztika</h1>
    <table>
        <tr>
            <th>Név</th>
            <th>Játék mód</th>
            <th>Időpont</th>
            <th>Végeredmény</th>
        </tr>
        <?php foreach($results as $row) :?>
            <tr>
                <td><?=$row['username']?></td>
                <td><?=$row['gameType']?></td>
                <td><?=$row['gameTime']?></td>
                <td><?=$row['result']?></td>
            </tr>
        <?php endforeach;?>
        
    </table>
    <a href="main.html"><button type="button" class="btn btn-primary" style="margin-left: 47%; margin-top: 3%;">Fő Menü</button></a>
</body>
</html>
