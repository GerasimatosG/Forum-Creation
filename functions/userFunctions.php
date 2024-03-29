<?php

function existsActiveUserSession() 
{
    return session_status() === 2;
}

function existsLoggedUser()
{
    return isset($_SESSION['loggedUserName']) && isset($_SESSION['loggedUserRole']);
}

function isUserAdmin() 
{    
    if (existsLoggedUser()) {
        return $_SESSION['loggedUserRole'] === 'admin';
    }
    
    return false;
}

function showLoggedUser() 
{    
    if(existsLoggedUser()) {
        echo "Logged in user" . "<br>"
            . "UserName: " . $_SESSION['loggedUserName']
            . " Role: " . $_SESSION['loggedUserRole']  . "<br>" . "<br>";
    } else {
        echo "No logged in user!"  . "<br>" . "<br>";
    }
}

function logUserIn($userName, $userRole)
{
    if(!existsLoggedUser()) {
        $_SESSION['loggedUserName'] = $userName;
        $_SESSION['loggedUserRole'] = $userRole;

        return true;
    }

    return false;    
}

function logUserOut()
{
    if (existsLoggedUser()) {
        $userName = $_SESSION['loggedUserName'];
        
        unset($_SESSION['loggedUserName']);
        unset($_SESSION['loggedUserRole']);

        if(existsLoggedUser()) {
            echo "Failed to log out user: $userName";
        } else {
            echo "Successfully logget user out" . "<br>" . $userName;
        }
    } else {
        echo "No user to log out!"  . "<br>";
    }
}

?>