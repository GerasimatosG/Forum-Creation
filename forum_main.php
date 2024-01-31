<?php

require('./functions/databaseFunctions.php');
require('./functions/genericFunctions.php');
require('./functions/userFunctions.php');
require('./header.php');

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">   
    <link rel="stylesheet" type="text/css" href="./styling/styleForMainPage.css" />
 </head>
   <body>
    <div class="createThreadButton">
        <button onclick="redirectToCreateThread()" id="newThreadButton">New Thread</button>
    </div>   
        
        <div class="threadTitleBar">
            <div class="empty-space-titlebar"></div>
            <div class="thread-title-titlebar">Topic</div>
            <div class="thread-author-titlebar">Author</div>
            <div class="thread-date-titlebar">Posted at</div>
            <div class="thread-posts-titlebar">Posts</div>
        </div>      
      
    
        <?php
         startSession();

         $threads = getThreads();    
         
         if ($threads) {
             foreach ($threads as $thread) {
                 $threadId = $thread['thread_id'];
                 $title = $thread['title'];
                 $creator = $thread['creator_username'];
                 $creationDate = $thread['created_at'];  
                 $postCount = getPostCountForThread($threadId);                   
                    echo '<div class="thread">';           
                    echo '<div class="empty-space"></div>';       
                    if(isUserAdmin()){  
                    echo '<span class="thread-title"><a href="viewThread.php?thread_id='.$threadId.'">'.$threadId .'.' .$title.'</a></span>';}
                    else{
                        echo '<span class="thread-title"><a href="viewThread.php?thread_id='.$threadId.'">'.$title.'</a></span>';
                    }
                    echo '<span class="thread-author"> '.$creator.'</span>';
                    echo '<span class="thread-date"> '.$creationDate.'</span>';
                    echo '<span class="thread-posts">' .$postCount. '</span>';                   
                    echo '</div>';
                    echo '<hr class="hrStyle">';
                                      
                    
             }
         } else {
             echo '<p>No threads found.</p>';
         }
         ?>
    
   

   
    <script>
        function redirectToCreateThread() {    
            <?php if (existsLoggedUser()) : ?>       
                window.location.href = "./createThread.php";
            <?php else : ?>        
                alert("Please log in to create a thread");
            <?php endif; ?>
        }       
    </script>
    
 </body>
 </html>
