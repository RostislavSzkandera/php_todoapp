<?php

require "assets/database.php";
require "assets/functions.php";


$connection = connectionDB();

$sql = "SELECT * FROM task";

$result = mysqli_query($connection, $sql);

if($result === false){
    echo mysqli_error($connection);
}   else {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']); 
        deleteTask($connection, $id); 
    } 
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoapp</title>
</head>
<body>
    
    <main>
        <h2>Seznam úkolů</h2>
        <?php if(empty($tasks)): ?>
            <p>Žádný úkol nenalezen</p>
        <?php else: ?>
            <ul>
                <?php foreach($tasks as $one_task): ?>
                    <li>
                        <?php echo $one_task["title"]. " " . $one_task["status"] ?>
                        <form method="POST" ">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($one_task['id']) ?>">
                            <button type="submit" onclick="return confirm('Opravdu chcete smazat tento úkol?');">Smazat</button>
                        </form>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
        
    </main>


</body>
</html>