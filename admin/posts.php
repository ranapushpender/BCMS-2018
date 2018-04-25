<?php include "../Include/sessions.php";
isLoggedInAdmin();
?>
<?php include "../Include/connection.php"; ?>
<?php
    //Handling Submits
    if(isset($_POST["addpostsubmit"]))
    {
        $nameString="0123456789abcdefghijklmnopqrstuvwxyz";
        $imgName='';
        for($i=0;$i<20;$i++)
        {
            $rno=rand(0,34);
         
            $imgName=$imgName.($nameString[$rno]);
        }
        
            // echo $imgName;die();
        $postDate=date('d-m-y');
        $postCat=mysqli_real_escape_string($connection,$_POST["categories"]);
        $postCatNum="";
        for($i=0;$i<strlen($postCat);$i++)
        {
            if($postCat[$i]==".")
            {
                break;
            }
            else{
                $postCatNum=$postCatNum.$postCat[$i];
            }
        }
         $postTitle=mysqli_real_escape_string($connection,$_POST["posttitle"]);
        $postAuthor=mysqli_real_escape_string($connection,$_POST["postauthor"]);
        $postContent=mysqli_real_escape_string($connection,$_POST["postcontent"]);
        $postTags=mysqli_real_escape_string($connection,$_POST["posttags"]);
        $postStatus=mysqli_real_escape_string($connection,$_POST["poststatus"]);
        $addPostQuery="insert into post(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status,post_user) values($postCatNum,'{$postTitle}','{$postAuthor}','{$postDate}','{$imgName}','{$postContent}','{$postTags}',0,'{$postStatus}','me')";
        //echo $addPostQuery; 
        if(!mysqli_query($connection,$addPostQuery))
        {
            echo mysqli_error($connection);
        }
        $tmpImgName=$_FILES["postimage"]["tmp_name"];
        move_uploaded_file($tmpImgName,"../Images/{$imgName}");
        setSuccess(1);
        $_SESSION["add"]=1;
        header("Location:posts.php");
        exit();
    }
    if(isset($_POST["editpostsubmit"]))
    {
       if(isset($_POST["posttitle"]) && isset($_POST["postauthor"]) && isset($_POST["categories"]) && isset($_POST["poststatus"]) && isset($_POST["postcontent"]) && isset($_POST["posttags"]) && isset($_GET["pid"]))
       {
           if((empty(trim($_POST["posttitle"])) || empty(trim($_POST["postauthor"])) || empty(trim($_POST["categories"])) || empty(trim($_POST["poststatus"])) || empty(trim($_POST["postcontent"])) || empty(trim($_POST["posttags"])) || empty($_GET["pid"]))){
               header("Location:posts.php?tasker=edit&pid=".$_GET["pid"]);    
               setFailure(1);
                exit();
               
           }
           else
            {
               $postTitle=mysqli_real_escape_string($connection,$_POST["posttitle"]);
               $postAuthor=mysqli_real_escape_string($connection,$_POST["postauthor"]);
               $postContent=mysqli_real_escape_string($connection,$_POST["postcontent"]);
               $postTags=mysqli_real_escape_string($connection,$_POST["posttags"]);
               $postStatus=mysqli_real_escape_string($connection,$_POST["poststatus"]);
               $postCat=mysqli_real_escape_string($connection,$_POST["categories"]);
               $pid=mysqli_real_escape_string($connection,$_GET["pid"]);
               $postCatNum="";
               setSuccess(1);
               $_SESSION["edit"]=1;
               for($i=0;$i<strlen($postCat);$i++)
               {       
                    if($postCat[$i]==".")
                    {
                        break;
                    }
                    else{
                        $postCatNum=$postCatNum.$postCat[$i];
                    }
                }
               if(is_uploaded_file($_FILES["postimage"]["tmp_name"]))
               {
                    
                    $nameString="0123456789abcdefghijklmnopqrstuvwxyz";
                    $imgName='';
                    for($i=0;$i<20;$i++)
                    {
                        $rno=rand(0,34);
         
                        $imgName=$imgName.($nameString[$rno]);
                    }
                    $tmpImgName=$_FILES["postimage"]["tmp_name"];
                    move_uploaded_file($tmpImgName,"../Images/{$imgName}");
                   
                    
                   $updatePostQuery="update post set post_title='{$postTitle}',post_author='{$postAuthor}',post_content='{$postContent}',post_tags='{$postTags}',post_status='{$postStatus}',post_image='{$imgName}',post_category_id={$postCatNum} where post_id={$pid}";
                   mysqli_query($connection,$updatePostQuery);
               }
               else
               {
                   $updatePostQuery="update post set post_title='{$postTitle}',post_author='{$postAuthor}',post_content='{$postContent}',post_tags='{$postTags}',post_status='{$postStatus}',post_category_id={$postCatNum} where post_id={$pid}";
                   mysqli_query($connection,$updatePostQuery);
               } 
            }
       }
       else
       {
           header("Location:posts.php");     
           exit();
       }
    }
    //Handling Submits End
?>
<?php 
        if(isset($_GET["tasker"])){
            switch(($_GET["tasker"]))
            {
                case 1:
                    include 'Include/header.php';
                    include "Include/add-post.php";
                    break;
                case "delete":
                    include "Include/delete-post.php";
                    break;
                case "edit":
                    include 'Include/header.php';
                    include "Include/edit-post.php";
                    break;
            }
        }
        else{
            include 'Include/header.php';
        
    ?>  
                <h1><i class="fa fa-clipboard" aria-hidden="true"></i>Posts</h1>
                <hr>
                <?php
                    if(isset($_SESSION["edit"]) && successMessage())
                    {
                ?>
                    <div class="msg msg-success">Post edited sucessfully</div>
                <?php
                        unset($_SESSION["edit"]);
                        setSuccess(0);
                    }
                ?>
                <?php
                //======================================
                    if(isset($_SESSION["add"]) && successMessage())
                    {
                ?>
                    <div class="msg msg-success">Post added sucessfully</div>
                <?php
                        unset($_SESSION["add"]);
                        setSuccess(0);
                    }
                ?>
                <?php
                //=====================================
                    if(isset($_SESSION["delete"]) && successMessage())
                    {
                ?>
                    <div class="msg msg-success">Post deleted sucessfully</div>
                <?php
                        unset($_SESSION["delete"]);
                        setSuccess(0);
                    }
                ?>
                <a href="posts.php?tasker=1" class="btn btn-blue"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Add Post</a>
                <div class='mt-2 table-responsive'>
                    <table class='table-responsive' style='overflow:auto;'>
                        <thead>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Images</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Views</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </thead>
                        <?php
                        $showPostsQuery="select * from post";
                        $result=mysqli_query($connection,$showPostsQuery);
                        while($row=mysqli_fetch_array($result))
                        {                            
                            $getCategoryQuery="select * from category where cat_id={$row["post_category_id"]}";
                            //echo $getCategoryQuery;
                            $rowCategory=mysqli_query($connection,$getCategoryQuery);
                       ?>
                            <tr>
                                <td><?php echo $row["post_id"];?></td>
                                <td><?php echo $row["post_author"];?></td>
                                <td><?php echo $row["post_title"];?></td>
                                <td><?php echo mysqli_fetch_array($rowCategory)["cat_title"] ;?></td>
                                <td><?php echo $row["post_status"];?></td>
                                <td><img height="100px" width="300px" src='../Images/<?php echo $row["post_image"];?>'/></td>
                                <td><?php echo $row["post_comment_count"];?></td>
                                <td><?php echo $row["post_date"];?></td>
                                <td><?php echo $row["post_views_count"]; ?></td>
                                <td><a href="posts.php?tasker=delete&pid=<?php echo $row["post_id"] ?>" class='btn-icon btn-icon-red'><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                <td><a href="posts.php?tasker=edit&pid=<?php echo $row["post_id"] ?>" class='btn-icon btn-icon-yellow'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php } ?>
                    </table>
                </div>

    <?php
        }
    ?>    
<?php include "Include/footer.php" ?>