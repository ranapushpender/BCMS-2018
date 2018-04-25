<?php include "../Include/sessions.php";
isLoggedInAdmin();
?>
<?php
    include "../Include/connection.php";
    if(isset($_GET["tasker"]))
    {
        switch($_GET["tasker"])
        {
            case "approve":
                include "Include/approve-comment.php";
                break;
            case "delete":
                include "Include/delete-comment.php";
                break;
            case "unapprove":
                include "Include/unapprove-comment.php";
                break;
            default:
                header("Location:comments.php");

        }
    }
?>
<?php
    include "Include/header.php";
?>
<?php
    $getAllApprovedComments="select * from comments where comment_approved=1";
    $approvedComments=mysqli_query($connection,$getAllApprovedComments);
?>
            <h1><span class="mr-2"><i class="fa fa-commenting" aria-hidden="true"></i></span>Comments</h1>
            <hr>
            <div class="wrapper" >
                <div class="card my-3 border-green">
                    <div class="card-header">
                        <h6 class="text-green"><i class="fa fa-check mr-2" aria-hidden="true"></i>Approved Comments</h6>
                    </div>
                    <div class="card-table">
                    <div class="table-responsive">
                        <table class="table-responsive" >
                            
                            <th class='border-top-none'>Comment User</th>
                            <th>Comment Data</th>
                            <th>Comment Date</th>
                            <th>Post</th>
                            <th>Disapprove</th>
                            <th>Delete</th>
                            <?php
                            while($row=mysqli_fetch_array($approvedComments))
                            {
                            ?>
                            <tr>
                                
                                <td><?php echo $row["comment_user"] ?></td>
                                <td><?php echo $row["comment_content"] ?></td>
                                <td><?php echo $row["comment_date"] ?></td>
                                <td><?php 
                                    $getCommentPostQuery="select * from post where post_id={$row["comment_post_id"]}";
                                    $res=mysqli_query($connection,$getCommentPostQuery);
                                echo mysqli_fetch_array($res)["post_title"] ?></td>
                                <td><a class="btn-icon btn-icon-red" href="comments.php?tasker=unapprove&cid=<?php echo $row["comment_id"];?>"><i class="fa fa-times" aria-hidden="true"></i>
</a></td>
                                <td><a  class="btn-icon btn-icon-yellow" href="comments.php?tasker=delete&cid=<?php echo $row["comment_id"];?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php 
                            } 
                            ?>
                        </table>
                     </div>
                </div>
                </div>
                <!---unapproved Comments-->
                    <?php
                        $getAllUnApprovedComments="select * from comments where comment_approved=0";
                        $unapprovedComments=mysqli_query($connection,$getAllUnApprovedComments);
                    ?>
                <div class="card my-3 border-red">
                <div class="card-header">
                    <h6 class="text-red"><i class="fa fa-times mr-2" aria-hidden="true"></i>Disapproved Comments</h6>
                </div>
                    <div class="table-responsive">
                        <table class="table-responsive">
                            
                            <th>Comment User</th>
                            <th>Comment Data</th>
                            <th>Comment Date</th>
                            <th>Post</th>
                            <th>Approve</th>
                            <th>Delete</th>
                            <?php
                            while($row=mysqli_fetch_array($unapprovedComments))
                            {
                            ?>
                            <tr>
                                
                                <td><?php echo $row["comment_user"] ?></td>
                                <td><?php echo $row["comment_content"] ?></td>
                                <td><?php echo $row["comment_date"] ?></td>
                                <td><?php 
                                    $getCommentPostQuery="select * from post where post_id={$row["comment_post_id"]}";
                                    $res=mysqli_query($connection,$getCommentPostQuery);
                                echo mysqli_fetch_array($res)["post_title"] ?></td>
                                <td><a class="btn-icon btn-icon-green" href="comments.php?tasker=approve&cid=<?php echo $row["comment_id"];?>"><i class="fa fa-check" aria-hidden="true"></i>
</a></td>
                                <td><a  class="btn-icon btn-icon-yellow" href="comments.php?tasker=delete&cid=<?php echo $row["comment_id"];?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php 
                            } 
                            ?>
                        </table>
                     </div>
            </div>

<?php
    include "Include/footer.php";
?>