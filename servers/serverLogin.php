<?php 
require('../functions/userFunctions.php'); 
require('../functions/genericFunctions.php'); 
require('../functions/databaseFunctions.php'); 

startSession();

if(isRequestMethodPost()) {
    $userName = addslashes($_POST['Username']);
    $password = addslashes($_POST['password']);

    if(isset($userName) && isset($password)) {
        $sql = "SELECT username, role
                FROM users
                WHERE username = '{$userName}' AND password = '{$password}'";
                
        $data = selectFromDbSimple($sql);
    
        if(!empty($data)) {
            foreach($data as $userCredentials) {
                
                $loginOutcome = logUserIn($userCredentials['username'], $userCredentials['role']);

                if($loginOutcome) {
                    $_SESSION['username'] = $userCredentials['username'];
                   header("Location:../forum_main.php");
                } else {
                    echo '<script>';
                    echo 'alert("A User is already logged in");';
                    echo 'window.location.href = "../forum_main.php";'; 
                    echo '</script>';
                }
            }
        } else {
            echo '<script>';
            echo 'alert("Username and Password do not match \nPlease try again");';
            echo 'window.location.href = "../login.php";'; 
            echo '</script>';
        }
    }
} else {
    setError("Tried to send data without 'Post' Method!");
    redirectTo("../login.php");
}
?>