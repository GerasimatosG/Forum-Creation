<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="./styling/styleRegisterLoginPage.css" /> 
    </head>
<body>
    <div class="headerRegistration">
        <h1>EchoCode Community</h1>
        <h3>Programmer's best Friend in a single Forum!</h3>
        <h4>Already a User?</h4>
    </div>

    <div class="registrationForm">
        <form action="./servers/serverLogin.php" method="POST">
            <label for="username">Username</label>
            <input type="text" class="formInputs" id="loginUsername" name = "Username" required>
            
            <label for="password">Password</label>
            <input type="password" class="formInputs" id="loginPassword"   name = "password" required>
            

            <button type="Submit">Log In</button>
        </form>
    </div>

        <div id="footerBox">
            <div class="footer">
                <h3>New Here?</h3>
                <a href="./register.php"> <p>Sign Up</p></a>     
            </div>      
            
            <div class="footer">
                <h3>Just Visiting?</h3>
                <a href="./forum_main.php">Enter as Guest</a>
            </div>
        </div>