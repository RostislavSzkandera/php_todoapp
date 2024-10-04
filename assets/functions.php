<?php 
function deleteTask($connection, $id){
    $sql = "DELETE
            FROM task
            WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if($stmt === false){
        echo mysqli_error($connection);
        return false;
        }   else {
            mysqli_stmt_bind_param($stmt,"i", $id);
    
            if (mysqli_stmt_execute($stmt)) {
            
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "Úkol byl úspěšně odstraněn.";
                    header("Location: index.php");
                    return true;
                    } else {
                    
                    echo "Chyba při mazání úkolu: ";
                    return false;
                    }
            } else {
             echo "Chyba při vykonání dotazu: " . mysqli_stmt_error($stmt);
                return false; 
        }
    
       
    }  
    
}


function getTask($connection, $id) {
    $sql = "SELECT * FROM task WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if($stmt === false) {
        echo mysqli_error($connection);

    }   else {
        mysqli_stmt_bind_param($stmt,"i", $_GET["id"]);
    }
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
            
        } else {
            echo mysqli_stmt_error($stmt);
            return false;
        }
}



function updateTask($connection, $title, $description, $status, $id){
    $sql = "UPDATE task
            SET title = ?, description = ?, status = ?
            WHERE id = ?";
       
    $stmt = mysqli_prepare($connection, $sql);

    if($stmt === false) {
        echo mysqli_error($connection);
    }   else {
        mysqli_stmt_bind_param($stmt,  "sssi", $title, $description, $status, $id);         
    }   
    if(mysqli_stmt_execute($stmt)){
        header("Location: index.php");
    }   else {
        echo mysqli_stmt_error($stmt);
    }
    
}