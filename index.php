<?php

require "assets/database.php";

$connection = connectionDB();

$sql = "SELECT * FROM task";

$result = mysqli_query($connection, $sql);

if($result === false){
    echo mysqli_error($connection);
}   else {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                <?php foreach($tasks as $task): ?>
                    <li>
                        <?php echo $task["title"]. " " . $task["status"] ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </main>


</body>
</html>