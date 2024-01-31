<?php
require_once('./functions/userFunctions.php'); 
require_once('./functions/genericFunctions.php'); 
require_once('./functions/databaseFunctions.php');

startSession();

$displayButton = isUserAdmin() ? 'block' : 'none';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" type="text/css" href="./styling/styleForHeaderPage.css" />
    
    <title>EchoCode Community</title>
</head>
<body>
    <div class="forumTitle">        
        <div class="leftButtons">
            <a href="./forum_main.php"><button>Main Page</button></a> 
            <a href="./register.php"><button  onclick="showLoggedInMessageAtRegister(event)">Register</button></a>
        </div>

        <div class="rightButtons">
            <a href="./login.php"><button onclick="showLoggedInMessage(event)">Log In</button></a> 
            <a href="./logout.php"><button onclick=" userIsNotLoggedMessage(event)">Log Out</button></a>            
        </div> 

        <div class="connectMenu"><button id="adminButton" onclick="userIsAdmin()" style="display: <?php echo $displayButton; ?>"><a href="./adminPage.php">Admin Page</a></button></div>

        <div id="centerHeading">  
             <h1>EchoCode Forums</h1>
             <h2>From Programmers - For Programmers</h2>
        </div>      
    </div>   


    <script>
        const userIsLoggedIn = <?php echo existsLoggedUser() ? 'true' : 'false'; ?>; 
        function showLoggedInMessage(event) {          
            if (userIsLoggedIn) {
                alert("You are already logged in.");                
                window.location.href = 'forum_main.php';
                if (event) {
                    event.preventDefault();
                }
            }
        }

        function showLoggedInMessageAtRegister(event){
            if (userIsLoggedIn) {
                alert("You already have an account\nLog out if you want to make a new one");                
                window.location.href = 'forum_main.php';
                if (event) {
                    event.preventDefault();
                }
            }
        }

        function userIsNotLoggedMessage(event){
            if (!userIsLoggedIn) {
                alert("No user is logged in");                
                window.location.href = 'forum_main.php';
                if (event) {
                    event.preventDefault();
                }
            }
        }       

        function userIsAdmin(){
            <?php if (!isUserAdmin()) :?>     
                alert("You can't access tihs content");
                event.preventDefault();               
            <?php endif; ?>
        }
    </script>
</body>
</html>