<?php 
require('./header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./styling/styleForAdminPage.css" />
</head>
<body>   

<div class="adminPage">
    <div class="createUserForm">
        <form id="createUser" action="servers/serverAdminRegisterUser.php" method="POST"> 
           <h2>Create New User</h2>
            <label>User Name <br>
                <input type="text" id="username" name="username" placeholder="User Name" required>
            </label>
            <br/>

            <label>Email <br>
                <input type="text" id="email" name="email" placeholder="Email" required>
            </label>
            <br/>   

            <label for="role" id="role">Role <br>
                            <select name="adminORuser" id="adminORuser">  
                                <option value="user">User</option>                      
                                <option value="admin">Admin</option>                        
                            </select> 
            </label>
            <br>

            <label>Password <br>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </label>
            <br>

            <button type="submit">CREATE</button>
        </form>
    </div>
    

    <div class="deleteThreadPost">
            <form id="deleteThread" class="centerForms" action="./servers/serverAdminDeleteThread.php" method="POST"> 

                <label>DELETE THREAD <br><br>
                    <input type="number" id="threadID" name="threadID" placeholder="threadID" required>
                </label>
                <br/>       
                <button type="submit">DELETE</button>
               
            </form>
            <!-- <hr style="border-color:yellow; border-width:5px;" > -->

            <form id="deletePost" class="centerForms" action="./servers/serverAdminDeletePost.php" method="POST"> 

                <label>DELETE POST <br><br>
                    <input type="number" id="postID" name="postID" placeholder="postID" required>
                </label>
                <br/>       
                <button type="submit">DELETE</button>
            </form>
    </div>
</div>

</body>
</html>