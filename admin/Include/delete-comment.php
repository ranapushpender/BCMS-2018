<?php
    if(isset($_GET["cid"]))
    {
        
        if(empty($_GET["cid"]))
        {
            header("Location:comments.php");
            exit();
        }
        else{
            $cid=mysqli_real_escape_string($connection,$_GET["cid"]);
            $deleteQuery="delete from comments where comment_id={$cid}";
            mysqli_query($connection,$deleteQuery);
            if(isset($_GET["fromdash"]))
            {
                header("Location:dashboard.php");
                exit();    
            }
            header("Location:comments.php");
            exit();
        }
    }
    else{
        header("Location:comments.php");
        exit();
    }
?>