<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="./styling/styleRegisterLoginPage.css"/>

    </head>
<body>
    <div class="headerRegistration">
        <h1>EchoCode Community</h1>
        <h3>Programmer's best Friend in a single Forum!</h3>
        <h4>Want to Join?</h4>
    </div>

    <div class="registrationForm">
        <form action="./servers/serverRegister.php" method="POST">
            <label for="username">Username</label>
            <input type="text" class="formInputs" id="registerUsername" name = "Username" required>

            <label for="email">Email</label>
            <input type="email" class="formInputs" id="registerEmail" name = "email" required>

            <label for="password">Password</label>
            <input type="password" class="formInputs" id="registerPassword"   name = "password" required>

            <label for="passwordConf">Confirm Password</label>
            <input type="password" class="formInputs" id="passwordConf"  name = "passwordConf" required>

            <button type="Submit" onclick="confirmPassword();">Register</button>
        </form>
    </div>   

        <div id="footerBox">
            <div class="footer">
                <h3>Already a user?</h3>
                <a href="./login.php"> <p>Login</p></a>     
            </div>      
            
            <div class="footer">
                <h3>Just Visiting?</h3>
                <a href="./forum_main.php">Enter as Guest</a>
            </div>
        </div>

 <script>
    function confirmPassword(){
        var password = document.getElementById("registerPassword").value;
        var passwordConf = document.getElementById("passwordConf").value;

        if(password === passwordConf){
            return true;
        }else{
            alert("Password and Password Confirmation do not match \nPlease try again");
            event.preventDefault();
        }
    }        
  </script>
</body>
</html>