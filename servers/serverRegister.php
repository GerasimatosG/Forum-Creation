<?php

require('../functions/databaseFunctions.php');
require('../functions/genericFunctions.php');
require('../functions/userFunctions.php');

startSession();

if(isRequestMethodPost()) {
    $userData = [
        'userName' => $_POST['Username'],
        'email'     => $_POST['email'],       
        'password'  => $_POST['password']
    ];


        $username = $userData['userName'];
        $sql = "SELECT id
            FROM users
            WHERE userName = '{$username}'";

         $data = selectFromDbSimple($sql);         
     

         if (!empty($data)) {
            echo '<script>';
            echo 'alert("Username already exists");';
            echo 'window.location.href = "../register.php";'; 
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
            executeQuery($sql);
            $userRole = 'user';
            logUserIn($username, $userRole);
            header("Location:../forum_main.php");

            } else {
                setError("Tried to send data without 'Post' Method!");
                redirectTo("../register.php");
            }
            