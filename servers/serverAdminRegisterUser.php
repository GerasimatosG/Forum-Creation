<?php 
require('../functions/userFunctions.php'); 
require('../functions/genericFunctions.php'); 
require('../functions/databaseFunctions.php'); 

startSession();

if(isRequestMethodPost()) {
    $userData = [
        'username' => $_POST['username'],
        'email'     => $_POST['email'],
        'role'      => $_POST['adminORuser'],
        'password'  => $_POST['password']
    ];    
  //to check username
    $username = $userData['username'];
    $sql = "SELECT id
            FROM users
            WHERE username = '{$username}'";
    $data = selectFromDbSimple($sql);

    if(!empty($data)) {
        echo '<script>';
        echo 'alert("This Username is already in use");';
        echo 'window.location.href = "../adminPage.php";';
        echo '</script>';
        exit();
    }

  //to check email
    $emailToCheck = $_POST['email'];
    $sql2 = "SELECT email 
             FROM users 
             WHERE email = '$emailToCheck'";     
    $data2 = selectFromDbSimple($sql2);
    
    if(!empty($data2)) {
        echo '<script>';
        echo 'alert("This Email already exists");';
        echo 'window.location.href = "../adminPage.php";';
        echo '</script>';
        exit();
    }
   
    $fields = "";
    $values = "";

    foreach($userData as $field => $value) {
        if(!empty($value)) {
            $fields .= "$field, ";
            $values .= "'$value', ";
        }
    }       
    $fields = rtrim($fields, ', ');
    $values = rtrim($values, ', ');

    $sql = "INSERT INTO users ({$fields}) 
            VALUES ({$values})";      
           
    if(insertPostQuery($sql)){
        echo '<script>';
        echo 'alert("User Created Successfully");';
        echo 'window.location.href = "../adminPage.php";';
        echo '</script>';
    }
 
} 
?>