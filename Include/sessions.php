<?php
    session_start();
    /*if(!(isset($_SESSION["user"])))
    {
        header("Location:../login.php");
        exit();
    }*/
    function isLoggedInAdmin()
    {
        if(!(isset($_SESSION["user"])))
        {
            header("Location:../login.php");
            die();
        }
        if($_SESSION["user_role"]=="subscriber")
        {
            header("Location:../user");
            die();
        }

    }
    function isLoggedInMember()
    {
        if(!(isset($_SESSION["user"])))
        {
            header("Location:../login.php");
            die();
        }
        if($_SESSION["user_role"]=="admin")
        {
            header("Location:../admin");
            die();
        } 
    }
    function successMessage()
    {
        if($_SESSION["success"]==1)
        {
            $_SESSION["success"]==0;
            return true;
        }
        else{
            return false;
        }
    }
    function failureMessage()
    {
        if($_SESSION["failure"]==1)
        {
            $_SESSION["failure"]==0;
            return true;
        }
        else{
            return false;
        }
    }
    function setSuccess($val)
    {
        $_SESSION["success"]=$val;
    }
    function setFailure($val)
    {
        $_SESSION["failure"]=$val;
    }
    function getId()
    {
        return $_SESSION["user_id"];
    }
?>