<?php
    if(isset($_GET["pid"]))
    {
        if(!empty(trim($_GET["pid"])))
        {
            $pid=mysqli_real_escape_string($connection,$_GET["pid"]);
            $deletePostQuery="delete from post where post_id={$pid}";
            mysqli_query($connection,$deletePostQuery);
            setSuccess(1);
            $_SESSION["delete"]=1;
            header("Location:posts.php");
            exit();
        }
    }
?>