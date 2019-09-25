<?php

    session_start();
    
    $_SESSION["username"] = "name"
    if(isset($_SESSION['chat']))
    {
        echo "Welcome. '$_SESSION['username']' ";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>