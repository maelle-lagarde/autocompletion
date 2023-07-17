<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Autocomplete</title>
</head>
<body>

</body>
</html>

<?php

    // connexion à la BDD.
    $dbhost = 'localhost';
    $dbname = 'autocompletion';
    $dbuser = 'root';
    $dbpass = 'root';

    try {
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        exit();
    }

    // récupération de la valeur de recherche.
    if(isset($_POST["query"])){
        $search = $_POST["query"];

        // requête SQL pour récupérer les résultats correspondants à la recherche.
        $stmt = $pdo->prepare("SELECT * FROM animal WHERE name LIKE :search");
        $stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<li>".$row['name']."</li>";
            }
        } else {
            echo "<li>Aucun résultat trouvé.</li>";
        }
    }
