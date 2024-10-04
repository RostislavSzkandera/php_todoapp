<?php 

require "assets/database.php";
require "assets/functions.php";

$connection = connectionDB();

if(isset($_GET["id"]) and is_numeric($_GET["id"])){
    $task = getTask($connection, $_GET["id"]);
}   else {
    $task = null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); 
     if (deleteTask($connection, $id)) {
        header("Location: index.php");
        exit();
    }
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
        <?php if($task === null): ?>
            <p>Úkol nenalezen</p>
        <?php else: ?>
            <h2>Název: <?= htmlspecialchars($task["title"])?></h2>
            <p>Popis: <?= htmlspecialchars($task["description"])?></p>
            <p>Status: <?= htmlspecialchars($task["status"])?></p>
            <p>Přidáno : <?= htmlspecialchars($task["created_at"])?></p>
            <form method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
                <button type="submit" onclick="return confirm('Opravdu chcete smazat tento úkol?');">Smazat</button>
            </form>
            <a href="index.php">Zpět</a>
            <a href="upravit-ukol.php?id=<?= $task['id'] ?>">Upravit</a>
        <?php endif ?>   
    </main>
</body>
</html>