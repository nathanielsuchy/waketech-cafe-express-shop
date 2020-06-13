<?php

    $baseUrl = "http://localhost:8080";
    // $baseUrl = "https://wcet3.waketech.edu/nrsuchy/WEB260/eos/";

    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=web260", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

        session_start();

        if (isset($_SESSION['ipaddress']))
        {
            if ($_SERVER['REMOTE_ADDR'] != $_SESSION['ipaddress'])
            {
                session_unset();
                session_destroy();
            }
		}
        else
        {
            $_SESSION['ipaddress'] = $_SERVER['REMOTE_ADDR'];
		}

        if (isset($_SESSION['lastaccess']))
        {
            if (time() > ($_SESSION['lastaccess'] + 3600))
            {
              session_unset();
              session_destroy();
            }
            else
            {
              $_SESSION['lastaccess'] = time();
            }
		}
        else
        {
            $_SESSION['lastaccess'] = time();  
		}   
?>