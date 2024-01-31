<?php

require('./functions/databaseFunctions.php');
require('./functions/genericFunctions.php');
require('./functions/userFunctions.php');
require('./header.php');
startSession(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styling/styleForViewThread.css" />  
    <script src="https://cdn.tiny.cloud/1/1zsx5bpnfvk0ao7kwqyyp483xatr91ykl41t1u1q56ihnwrd/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
         selector: ".content",
         setup: function (editor) {
         editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
});
    </script>
     
</head>
<body>

<?php
$threadId = $_GET['thread_id'];

if ($threadId) {
    $thread = getThreadById($threadId);
        if ($thread) {          

            $posts = getRepliesForThread($threadId);
            if ($posts) {
                foreach ($posts as $post) {
                    $postID = $post['id'];
                    $postAuthor = $post['author_username'];
                    $postDate = $post['created_at'];
                    $postContent = $post['content'];
    
                    echo '<div class="post">';
                    if(isUserAdmin()){
                    echo '<p class="postInfo">' .$postID . '. By ' . $postAuthor . ' on ' . $postDate . '</p>';
                    }else{ 
                        echo '<p class="postInfo"> By ' . $postAuthor . ' on ' . $postDate . '</p>';
                     };
                    echo '<h2>' . $postContent . '</h2>';
                    echo '</div>';
                    echo '<hr style="border-color:yellow; border-width:5px;">';
                }
            } else {
                echo '<p>No replies found.</p>';
            }
    
            echo '</div>';
            } else {
                echo '<p>Thread not found.</p>';
                }
} else{
    echo '<p>Invalid thread ID.</p>';
      }  
        ?>

        <div class="answerField">
            <form action="./servers/serverPostReply.php" method="POST">
                <input type="hidden" name="threadId" value="<?php echo $threadId; ?>">
                <textarea name="reply" class="content"  cols="100" rows="10" placeholder="Enter your Reply"></textarea>
                <div id="btnSubmit">
                    <button type="submit" class="btn btn-success" onclick="redirectToCreateThread()"  id="submitThread">Submit</button>
                </div>
            </form>
        </div>

        <script>
        function redirectToCreateThread() {    
            <?php if (!existsLoggedUser()) : ?>     
                alert("Please log in to post a reply");
                event.preventDefault();               
            <?php endif; ?>
        }       
    </script>
    
</body>
</html>



