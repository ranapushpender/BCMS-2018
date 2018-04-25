<!--<div class="card">-->
<?php
    
    session_start();
    //$_SESSION["isError"]=0;
    include "Include/connection.php";
    $postId=mysqli_real_escape_string($connection,$_GET["pid"]);
    //submit comment
    if(isset($_POST["commentsubmit"]))
    {
        
       $commentUser=mysqli_real_escape_string($connection,$_POST["commentName"]);
        $commentContent=mysqli_real_escape_string($connection,$_POST["commentData"]);
       if(empty(trim($_POST["commentData"]))||empty(trim($_POST["commentName"])))
       {
           $_SESSION["isError"]=1;
           ob_start();
          header("Location:view.php?pid=".$postId);
           exit();
           
           
           
       }
       else if($commentUser==" "||$commentContent==" ")
       {
           $_SESSION["isError"]=1;
          header("Location:view.php?pid=".$_GET["pid"]);
           exit();
       }
       else{ $commentPostId=mysqli_real_escape_string($connection,$_GET["pid"]);
        $commentDate=date('d-m-y');
        $addCommentQuery="insert into comments(comment_user,comment_content,comment_date,comment_approved,comment_post_id) VALUES('{$commentUser}','{$commentContent}','{$commentDate}',0,{$commentPostId})";
        //echo "krr rha hu";
       // die();
        mysqli_query($connection,$addCommentQuery);
           }
        $_SESSION["commSuccess"]=true;
       header("Location:view.php?pid=".$postId);
        exit();
    }
    //include header
    include "Include/header.php";
    if(isset($_GET["pid"]))
    {   
        $getPostQuery="select * from post where post_id={$postId}";
        $resultgetPostQuery=mysqli_query($connection,$getPostQuery);
        while($row=mysqli_fetch_array($resultgetPostQuery))
        {
?>
    <div class="p-3 mt-5 mb-3" style="background-color:white;border-radius:8px;">
    <?php
            //echo session_id();
            //echo "ISError".$_SESSION["isError"];
    if(isset($_SESSION["isError"]))
    {
        
        if($_SESSION["isError"]==1)
        {
            
            
    ?>
        <div class="alert alert-danger alert-dismissable">Please Dont leave the fields blank
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
    <?php
            $_SESSION["isError"]=0;
        }
        
    } 
    if(isset($_SESSION["commSuccess"]))
    {
        
        if($_SESSION["commSuccess"]==1)
        {
            
            
    ?>
        <div class="alert alert-success alert-dismissable">Comment Added Sucessfully
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
    <?php
            $_SESSION["commSuccess"]=0;
        }
        
    } 
        
        ?>
    <div class="wrapper">
        <h1 class="mb-3"><?php echo $row["post_title"] ?></h1>    
        <img src="Images/<?php echo $row["post_image"] ?>" style="width:100%;height:400px;"/>
        <h6 class="my-3">Author:<a href="#"><?php echo $row["post_author"] ?></a></h6>
        <br>
        <div class="post-text">
            <div class="card bg-light">
                <div class="card-body">
                    <p class="card-text"><?php echo str_replace("../","",str_replace('\"','"',$row["post_content"])) ?></p>
                </div>
            </div>
        </div>
    </div>
<?php    
        }
    }
    
?>

<div class="card mt-3">
    <div class="card-header">
        Comments
    </div>
   
        <ul class="list-group list-group-flush">
        <?php
            $getCommentsQuery="select * from comments where comment_post_id={$postId} and comment_approved=1";
            $resultGetCommentsQuery=mysqli_query($connection,$getCommentsQuery);
            while($row=mysqli_fetch_array($resultGetCommentsQuery))
            {
        ?>    
        <li class="list-group-item">
            <h6 class="card-title"><?php echo $row["comment_user"] ?></h6>
            <div class="card-text"><?php echo $row["comment_content"] ?></div>
        </li>
        <?php
            }
        ?>    
    </ul>
    
</div>
<form method="post" class="mt-3 mb-3" action="view.php?pid=<?php echo $postId?>">
    
    <div class="form-group">
        Name
        <input type="text" class="form-control" name="commentName"/>
        Comment
        <textarea class="form-control" name="commentData"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="commentsubmit">Submit</button>
</form>
</div>
<?php
    $updateViewQuery="update post set post_views_count=post_views_count+1 where post_id={$postId}";
     // echo $updateViewQuery;
    mysqli_query($connection,$updateViewQuery);
    include "Include/footer.php";
?>