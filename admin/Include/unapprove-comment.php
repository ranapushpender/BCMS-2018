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
            $approveQuery="update comments set comment_approved=0 where comment_id={$cid}";
            mysqli_query($connection,$approveQuery);
            header("Location:comments.php");
            exit();
        }
    }
    else{
        header("Location:comments.php");
        exit();
    }
?>