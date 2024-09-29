<?php 

require "assets/database.php";

$connection = connectionDB();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["title"]) && isset($_POST["description"])){
        $title = htmlspecialchars($_POST["title"]);
        $description = htmlspecialchars($_POST["description"]);
       
    } elseif  (!isset($_POST["title"]) || !isset($_POST["description"])){
            echo "Nějaké údaje nebyly zadány";
        }

    $sql = "INSERT INTO task (title, description) VALUES (?, ?)";

    $statement = mysqli_prepare($connection, $sql);

    if($statement === false){
        echo mysqli_error($connection);
    }   else {
        mysqli_stmt_bind_param($statement, "ss", $title, $description);

        if(mysqli_stmt_execute($statement)){
            mysqli_stmt_close($statement);
            header("Location: index.php");
            exit();
        }     else {
            // Kontrola chybějících polí
            if (!isset($_POST["title"])) {
                echo "Název úkolu nebyl zadán.";
            }
    
            if (!isset($_POST["description"])) {
                echo "Popis úkolu nebyl zadán.";
            }}}
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require "includes/header.php"; ?>

    <main>
        <h2>Přidání úkolu</h2>
        <form method="POST">
            <input required type="text" name="title" placeholder="Název úkolu"><br>
            <textarea required cols="25" rows="8" name="description" placeholder="Popis úkolu"></textarea><br>
            <input type="submit" value="Přidat">
        </form>
    </main>

</body>
</html>