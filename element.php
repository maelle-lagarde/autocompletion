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

    // récupération de la valeur de l'ID depuis la requête GET.
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        // requête SQL pour récupérer les informations de l'élément.
        $stmt = $pdo->prepare("SELECT * FROM animal WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch();
            echo "<p style='color:white'>ID : ".$row['id']."</p><br>";
            echo "<p style='color:white'>Nom : ".$row['name']."</p><br>";
        } else {
            echo "Aucun élément trouvé.";
        }
    }