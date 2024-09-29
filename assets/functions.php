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
                    exit();
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