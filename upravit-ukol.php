<?php

require "assets/database.php";
require "assets/functions.php";

$connection = connectionDB();

if ( isset($_GET["id"]) ){
    $task = getTask($connection, $_GET["id"]);

    if ($task) {
        $title = $task["title"];
        $description = $task["description"];
        $status = $task["status"];
        $id = $task["id"];

    } else {
        die("Úkol nenalezen");
    }

} else {
    die("ID není zadáno,  úkol nebyl nalezen");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $status = $_POST["status"];
    

    updateTask($connection, $title, $description, $status, $id);

    
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
    <main>
            <form method="POST" >
                <input  type="text" 
                        name="title" 
                        value="<?= htmlspecialchars($title)  ?>"
                        required
                >
                <br>
                <textarea name="description" id=""><?= htmlspecialchars($description)  ?></textarea>
                <br>        
                <label for="status">Vyberte možnost:</label>
                <select id="status" name="status">
                <option value="nedokončeno">Nedokončeno</option>
                <option value="hotovo">Hotovo</option>
                </select>
                <br>
                <input  type="submit" 
                        value="Uložit"
                >   
            </form>
    </main>
</body>
</html>