<?php 
require('../functions/userFunctions.php'); 
require('../functions/genericFunctions.php'); 
require('../functions/databaseFunctions.php'); 

startSession();

if (isRequestMethodPost()) {
    $postID = $_POST['postID'];        

    $sql = "SELECT *
            FROM posts
            WHERE id = {$postID}";

    $data = selectFromDbSimple($sql);      

    if (!empty($data)) {        
        $sql = "DELETE FROM posts WHERE id = {$postID};";          

        executeQuery($sql);           
       
        echo '<script>alert("Post deleted successfully!");window.location.href = "../adminPage.php";</script>';
    } else {
        echo '<script>alert("Post ID not Found.Try Again");window.location.href = "../adminPage.php";</script>';
    }
} else {
    setError("Tried to send data without 'Post' Method!");
    redirectTo("../errorPage.php");
}
