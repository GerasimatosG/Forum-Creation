<?php
require('../functions/databaseFunctions.php');
require('../functions/genericFunctions.php');
require('../functions/userFunctions.php');

startSession();
$conn = defaultConnectToDatabase();

if (isRequestMethodPost()) {
    $title = $_POST['threadTitle'];
    $content = $_POST['threadContent'];

    if (empty($title) || empty($content)) {
        echo '<script>alert("Please fill in both title and content before submitting.");window.location.href = "../createThread.php";</script>';
        exit();
    }

    $username = $_SESSION['username'];

    $sql = "INSERT INTO threads (title, creator_username, content) VALUES ('$title', '$username', '$content');";
    $sql .= "INSERT INTO posts (thread_id, content, author_username) VALUES (LAST_INSERT_ID(), '$content', '$username');";

    $success = $conn->multi_query($sql);

    if ($success) {
        echo '<script>alert("Thread created successfully!");window.location.href = "../forum_main.php";</script>';
    } else {
        echo '<script>alert("Error creating thread. Please try again.");window.location.href = "../createThread.php";</script>';
    }
} else {
    redirectTo("../createThread.php");
}

$conn->close();
?>
