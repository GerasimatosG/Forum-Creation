<?php 
require('../functions/userFunctions.php'); 
require('../functions/genericFunctions.php'); 
require('../functions/databaseFunctions.php'); 

startSession();

if (isRequestMethodPost()) {
    $threadID = $_POST['threadID'];        

    $sql = "SELECT *
            FROM threads
            WHERE thread_id = {$threadID}";

    $data = selectFromDbSimple($sql);      

    if (!empty($data)) {
        $sql = "DELETE FROM posts WHERE thread_id = {$threadID};";
        $sql .= "DELETE FROM threads WHERE thread_id = {$threadID};";            

        executeMultiQuery($sql);           
       
        echo '<script>alert("Thread deleted successfully!");window.location.href = "../adminPage.php";</script>';
    } else {
        echo '<script>alert("Thread ID not Found.Try Again");window.location.href = "../adminPage.php";</script>';
    }
} else {
    setError("Tried to send data without 'Post' Method!");
    redirectTo("../errorPage.php");
}

?>