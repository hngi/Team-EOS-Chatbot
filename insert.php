<?php

    session_start();
    $name= 'askname';
    if(isset($_SESSION['askname']))
    {
        echo 'What is your name: ' . $_SESSION['askname'];
    }
    else
    {
        echo 'Welcome .$askname ';
        $_SESSION['name'] = 'This is great.';
    }

?>