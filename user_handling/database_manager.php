<?php
function getConnection() {
    $dsn = DB_TYPE.':dbname='.DB_NAME.';host='.DB_HOST;
    $user = DB_USER;
    $password = DB_PASS;

    $connection = new PDO($dsn, $user, $password);
    return $connection;
}

function select($query, $params = []) {
    $connection = getConnection();
    $statement = $connection->prepare($query);
    $success = $statement->execute($params);

    $results = [];

    if($success) {
        $results = $statement->fetchAll();
    }
    else {
        die("Sikertelen végrehajtás");
    }

    $statement->closeCursor();
    $connection = NULL;

    return $results;
}

