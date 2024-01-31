<?php
require('./header.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Thread</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    
    <link rel="stylesheet" type="text/css" href="./styling/styleForNewThreadPage.css" />
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
    <h1 id="newThread">New Thread</h1>
    <div id="writeThread">  
        <form action="./servers/serverNewThread.php" method="POST">     
            <div class="mb-3">
                <h2>Title</h2>
                <label for="threadTitle" class="form-label">Title</label>
                <input type="text" class="form-control" name="threadTitle" id="threadTitle" placeholder="Title for your Thread" required>
            </div>
            <div class="mb-3">
                <h2>Content</h2>
                <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                <textarea class="form-control content" name="threadContent" rows="6" placeholder="Your Content" required></textarea>
            </div>
                <div id="btnSubmit">
                    <button type="submit" class="btn btn-success"  id="submitThread">Submit</button>
                </div>
        </form>         
    </div>
   
    <div id="exitButtonDiv">
         <a href="./forum_main.php" id="cancelThread"><button>Back to Forum</button></a>
    </div>
</body>
</html>