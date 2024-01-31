<?php
require('../functions/databaseFunctions.php');
require('../functions/genericFunctions.php');
require('../functions/userFunctions.php');
startSession();

if (isRequestMethodPost()) {
    $threadId = $_POST['threadId'];
    $postContent = $_POST['reply']; 
    $username = $_SESSION['username'];  

    
    $sql = "INSERT INTO posts (thread_id, content, author_username, created_at) VALUES ('$threadId', '$postContent', '$username', NOW())";
    $success = insertPostQuery($sql);

    if ($success) {        
        redirectTo("../viewThread.php?thread_id=$threadId");
    } else {
        echo '<p>Error posting reply. Please try again.</p>';
    }
} else {
    
    setError("Invalid request method.");
    redirectTo("main_forum.php"); 
}
?>