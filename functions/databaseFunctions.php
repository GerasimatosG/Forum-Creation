<?php

function defaultConnectToDatabase() {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "forum";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function checkEmptyInput($parameter, $message = '') {
    if(empty($parameter)) {
        echo $message . "<br>";
        
        return true;
    }
}

function exitOnEmptyInput($parameter, $message = ''): void {
    if(empty($parameter)) {
        exit($message);
    }
}

function selectFromDbSimple($sql):array 
{
    exitOnEmptyInput($sql, "Empty 'select' query in line: " . __LINE__);

    $conn   = defaultConnectToDatabase();
    $result = $conn->query($sql);
    $data   = [];  

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    $conn->close();

    return $data;
}

function executeQuery($sql) 
{
    exitOnEmptyInput($sql, "Empty query in line: " . __LINE__);

    $conn   = defaultConnectToDatabase();
    $result = $conn->query($sql);

    if(empty($result)) {
        echo "Query execution failure!" . "<br>" . $sql . "<br>";};
   
    $conn->close();
}


function getThreads(){
    $conn = defaultConnectToDatabase();
    $threads = array();

    $sql = "SELECT thread_id, title, creator_username, created_at FROM threads ORDER BY thread_id DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $threads[] = $row;
        }
    }
    $conn->close();
    return $threads;
}

function getThreadById($threadId) {
    $conn = defaultConnectToDatabase();
  
    $threadId = $conn->real_escape_string($threadId);
    $sql = "SELECT * FROM threads WHERE thread_id = '$threadId'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $thread = $result->fetch_assoc();
        $conn->close();
        return $thread;
    } else {
        $conn->close();
        return false; 
    }
}

function getPostCountForThread($threadId) {
    
    $conn =  defaultConnectToDatabase();
    $sql = "SELECT COUNT(*) AS postCount FROM posts WHERE thread_id = $threadId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        return max(0, $row['postCount']);
    }

    return 1; 
}


function insertPostQuery($sql) {
    exitOnEmptyInput($sql, "Empty query in line: " . __LINE__);

    $conn = defaultConnectToDatabase();
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Query execution failure!" . "<br>" . mysqli_error($conn) . "<br>";
        $conn->close();
        return false;
    }

    $conn->close();
    return true;
}

function getRepliesForThread($threadId) {
    $conn = defaultConnectToDatabase();
    $threadId = $conn->real_escape_string($threadId);    
    $sql = "SELECT * FROM posts WHERE thread_id = '$threadId' ORDER BY created_at";
    $result = $conn->query($sql);
    $replies = array();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $replies[] = $row;
        }
    }
    $conn->close();
    return $replies;
}

function executeMultiQuery($sql) 
{
    exitOnEmptyInput($sql, "Empty query in line: " . __LINE__);

    $conn   = defaultConnectToDatabase();
    $result = $conn->multi_query($sql);

    if ($result === true) {       
        $conn->close();
        return true;
    } else {        
        echo "Query execution failure!" . "<br>" . $conn->error . "<br>" . $sql . "<br>";
        $conn->close();
        return false;
    }
}

?>
